<?php

namespace App\Repositories;

use App\Services\LogService;
use Illuminate\Support\Facades\DB;

class DepartmentRepository
{
    private $table = 'departments';

    private $baseQuery;

    public function __construct()
    {
        $this->baseQuery = DB::table($this->table)
            ->select(
                $this->table . '.id AS id',
                $this->table . '.name AS name',
                $this->table . '.name AS description',
                $this->table . '.note AS note',
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
                [$this->table . '.name', 'like', '%' . $search . '%'],
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

        $departmentId = DB::table($this->table)
            ->insertGetId(
                [
                    'name' => $data['name'],
                    'note' => isset($data['note']) ? $data['note'] : null,
                    'user_id' => session()->get('userId'),
                    'created_at' => now(),
                ]
            );

        if (isset($data['users'])) {
            foreach ($data['users'] as $userId) {
                DB::table('department_users')
                    ->insertGetId(
                        [
                            'user_id' => $userId,
                            'department_id' => $departmentId,
                            'created_at' => now(),
                        ]
                    );
            }
        }

        if (isset($data['status'])) {
            foreach ($data['status'] as $statusId) {
                DB::table('department_status')
                    ->insertGetId(
                        [
                            'status_id' => $statusId,
                            'department_id' => $departmentId,
                            'created_at' => now(),
                        ]
                    );
            }
        }

        return $departmentId;
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
                    'name' => $data['name'],
                    'note' => isset($data['note']) ? $data['note'] : null,
                    'user_id' => session()->get('userId'),
                    'updated_at' => now(),
                ]
            );

        if (isset($data['users'])) {
            DB::table('department_users')
                ->where('department_id', $data['recordId'])
                ->delete();

            foreach ($data['users'] as $userId) {
                DB::table('department_users')
                    ->insertGetId(
                        [
                            'user_id' => $userId,
                            'department_id' => $data['recordId'],
                            'created_at' => now(),
                        ]
                    );
            }
        }

        if (isset($data['status'])) {
            DB::table('department_status')
                ->where('department_id', $data['recordId'])
                ->delete();

            foreach ($data['status'] as $statusId) {
                DB::table('department_status')
                    ->insertGetId(
                        [
                            'status_id' => $statusId,
                            'department_id' => $data['recordId'],
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

        DB::table('department_users')
            ->where('department_id', $data['recordId'])
            ->delete();

        DB::table('department_status')
            ->where('department_id', $data['recordId'])
            ->delete();

        DB::table($this->table)
            ->where('id', $data['recordId'])
            ->delete();
    }

    public function users($departmentId)
    {
        return DB::table('department_users')
            ->join('users', 'users.id', '=', 'department_users.user_id')
            ->select(
                'department_users.user_id AS userId',
                'department_users.department_id AS departmentId',
                'users.name AS name',
            )
            ->where('department_users.department_id', $departmentId)
            ->get();
    }

    public function status($departmentId)
    {
        return DB::table('department_status')
            ->join('demand_status', 'demand_status.id', '=', 'department_status.status_id')
            ->select(
                'department_status.status_id AS statusId',
                'department_status.department_id AS departmentId',
                'demand_status.description AS description',
            )
            ->where('department_status.department_id', $departmentId)
            ->get();
    }

    public function findById($id)
    {
        return $this->baseQuery
            ->where($this->table . '.id', $id)
            ->get()
            ->first();
    }
}
