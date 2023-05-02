<?php

namespace App\Repositories;

use App\Services\LogService;
use Illuminate\Support\Facades\DB;

class DemandRepository
{
    private $table = 'demands';

    private $baseQuery;

    public function __construct()
    {
        $this->baseQuery = DB::table($this->table)
            ->join('users', 'users.id', '=', 'demands.user_id')
            ->join('demand_status', 'demand_status.id', '=', 'demands.demand_status_id')
            ->join('demand_types', 'demand_types.id', '=', 'demands.demand_type_id')
            ->select(
                $this->table . '.id AS id',
                $this->table . '.title AS title',
                $this->table . '.subtitle AS subtitle',
                $this->table . '.description AS description',
                $this->table . '.user_id AS userId',
                'users.name AS username',
                $this->table . '.demand_status_id AS demandStatusId',
                'demand_status.description AS demandStatusDescription',
                'demand_status.color AS demandStatusColor',
                $this->table . '.demand_type_id AS demandTypeId',
                'demand_types.color AS demandTypeDescription',
                $this->table . '.created_at AS createdAt',
                $this->table . '.updated_at AS updatedAt',
            );
    }

    public function all(string $search = null, string $sortBy = 'id', string $sortDirection = 'asc', string $perPage = '30')
    {
        return $this->baseQuery
            ->where([
                [$this->table . '.id', 'like', '%' . $search . '%'],
            ])
            ->orWhere([
                [$this->table . '.description', 'like', '%' . $search . '%'],
            ])
            ->orWhere([
                [$this->table . '.note', 'like', '%' . $search . '%'],
            ])
            ->orderBy($sortBy, $sortDirection)
            ->paginate($perPage);
    }

    public function allSimplified()
    {
        return $this->baseQuery->get();
    }

    public function save($data)
    {
        LogService::saveLog(
            session()->get('userId'),
            $this->table,
            'I',
            date('Y-m-d H:i:s'),
            json_encode($data),
            null
        );

        $demandId = DB::table($this->table)
            ->insertGetId(
                [
                    'title' => $data['title'],
                    'subtitle' => isset($data['subtitle']) ? $data['subtitle'] : null,
                    'description' => $data['description'],
                    'user_id' => session()->get('userId'),
                    'demand_status_id' => $data['demandStatusId'],
                    'demand_type_id' => $data['demandTypeId'],
                    'created_at' => now(),
                ]
            );

        if (isset($data['files'])) {
            foreach ($data['files'] as $path) {
                DB::table('demand_files')
                    ->insertGetId(
                        [
                            'path' => $path,
                            'user_id' => session()->get('userId'),
                            'demand_id' => $data['recordId'],
                            'created_at' => now(),
                        ]
                    );
            }
        }
    }

    public function update($data)
    {
        $oldData = $this->findById($data['recordId']);

        LogService::saveLog(
            session()->get('userId'),
            $this->table,
            'U',
            date('Y-m-d H:i:s'),
            json_encode($oldData),
            json_encode($data)
        );

        DB::table($this->table)
            ->where('id', $data['recordId'])
            ->update(
                [
                    'title' => $data['title'],
                    'subtitle' => isset($data['subtitle']) ? $data['subtitle'] : null,
                    'description' => $data['description'],
                    'user_id' => session()->get('userId'),
                    'demand_status_id' => $data['demandStatusId'],
                    'demand_type_id' => $data['demandTypeId'],
                    'updated_at' => now(),
                ]
            );

        if (isset($data['files'])) {
            DB::table('demand_files')
                ->where('demand_id', $data['recordId'])
                ->delete();

            foreach ($data['files'] as $path) {
                DB::table('demand_files')
                    ->insertGetId(
                        [
                            'path' => $path,
                            'user_id' => session()->get('userId'),
                            'demand_id' => $data['recordId'],
                            'created_at' => now(),
                        ]
                    );
            }
        }
    }

    public function delete($data)
    {
        $oldData = $this->findById($data['recordId']);

        LogService::saveLog(
            session()->get('userId'),
            $this->table,
            'D',
            date('Y-m-d H:i:s'),
            json_encode($oldData),
            null
        );

        DB::table('demand_files')
            ->where('demand_id', $data['recordId'])
            ->delete();

        DB::table($this->table)
            ->where('id', $data['recordId'])
            ->delete();
    }

    public function findById($id)
    {
        return $this->baseQuery
            ->where($this->table . '.id', $id)
            ->get()
            ->first();
    }
}
