<?php

namespace App\Repositories;

use App\Services\LogService;
use Illuminate\Support\Facades\DB;

class ClientRepository
{
    private $table = 'clients';

    private $baseQuery;

    public function __construct()
    {
        $this->baseQuery = DB::table($this->table)
            ->leftJoin('plans', 'plans.id', '=', 'clients.plan_id')
            ->leftJoin('users', 'users.id', '=', 'clients.responsible_id')
            ->select(
                $this->table . '.id AS id',
                $this->table . '.name AS name',
                $this->table . '.email AS email',
                $this->table . '.phone AS phone',
                $this->table . '.plan_id AS planId',
                $this->table . '.responsible_id AS responsibleId',
                'plans.name AS plan',
                'plans.weekly_posts_quantity AS weeklyPostsQuantity',
                'plans.has_offline_material AS hasOfflineMaterial',
                'users.name AS responsible',
                $this->table . '.created_at AS createdAt',
                $this->table . '.updated_at AS updatedAt',
                DB::raw("(select ifnull((SELECT (plans.weekly_posts_quantity - count(*)) as totalWeek
                FROM demands AS demands_2
                    WHERE WEEKOFYEAR(DATE(demands_2.publication_date)) = WEEKOFYEAR(CURDATE())
                    AND YEAR(DATE(demands_2.publication_date)) = YEAR(CURDATE()) AND demands_2.client_id = clients.id), 0)) AS availableDemands")
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
                ['users.name', 'like', '%' . $search . '%'],
            ])
            ->orderBy($sortBy, $sortDirection)
            ->paginate($perPage);
    }

    public function allSimplified()
    {
        return $this->baseQuery
            ->orderBy($this->table . '.name', 'asc')
            ->get();
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

        return DB::table($this->table)
            ->insertGetId(
                [
                    'name' => $data['name'],
                    'email' => isset($data['email']) ? $data['email'] : null,
                    'phone' => isset($data['phone']) ? $data['phone'] : null,
                    'plan_id' => isset($data['planId']) ? $data['planId'] : null,
                    'responsible_id' => isset($data['responsibleId']) ? $data['responsibleId'] : null,
                    'user_id' => session()->get('userId'),
                    'created_at' => now(),
                ]
            );
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
                    'email' => isset($data['email']) ? $data['email'] : null,
                    'phone' => isset($data['phone']) ? $data['phone'] : null,
                    'plan_id' => isset($data['planId']) ? $data['planId'] : null,
                    'responsible_id' => isset($data['responsibleId']) ? $data['responsibleId'] : null,
                    'user_id' => session()->get('userId'),
                    'updated_at' => now(),
                ]
            );
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
