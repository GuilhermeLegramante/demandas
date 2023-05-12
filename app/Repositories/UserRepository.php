<?php

namespace App\Repositories;

use App\Services\LogService;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    private $table = 'users';

    private $baseQuery;

    public function __construct()
    {
        $this->baseQuery = DB::table($this->table)
            ->select(
                $this->table . '.id AS id',
                $this->table . '.name AS name',
                $this->table . '.name AS description',
                $this->table . '.login AS login',
                $this->table . '.email AS email',
                $this->table . '.is_admin AS isAdmin',
                $this->table . '.created_at AS createdAt',
                $this->table . '.updated_at AS updatedAt',
            );
    }

    public function all(string $search = null, string $sortBy = 'name', string $sortDirection = 'asc', string $perPage = '30')
    {
        return $this->baseQuery
            ->where([
                [$this->table . '.name', 'like', '%' . $search . '%'],
            ])
            ->orWhere([
                [$this->table . '.login', 'like', '%' . $search . '%'],
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

        $userId = DB::table($this->table)
            ->insertGetId(
                [
                    'name' => $data['name'],
                    'login' => $data['login'],
                    'email' => isset($data['email']) ? $data['email'] : null,
                    'password' => sha1($data['password']),
                    'is_admin' => $data['isAdmin'],
                    'created_at' => now(),
                ]
            );

        if (isset($data['departments'])) {
            DB::table('department_users')
                ->where('user_id', $userId)
                ->delete();

            foreach ($data['departments'] as $departmentId) {
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

        return $userId;
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
                    'login' => $data['login'],
                    'email' => isset($data['email']) ? $data['email'] : null,
                    'password' => sha1($data['password']),
                    'is_admin' => $data['isAdmin'],
                    'updated_at' => now(),
                ]
            );

        if (isset($data['departments'])) {
            DB::table('department_users')
                ->where('user_id', $data['recordId'])
                ->delete();

            foreach ($data['departments'] as $departmentId) {
                DB::table('department_users')
                    ->insertGetId(
                        [
                            'user_id' => $data['recordId'],
                            'department_id' => $departmentId,
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
            ->where('user_id', $data['recordId'])
            ->delete();

        DB::table($this->table)
            ->where('id', $data['recordId'])
            ->delete();
    }

    public function departments($userId)
    {
        return DB::table('department_users')
            ->join('departments', 'departments.id', '=', 'department_users.department_id')
            ->select(
                'department_users.user_id AS userId',
                'department_users.department_id AS departmentId',
                'departments.name AS name',
            )
            ->where('department_users.user_id', $userId)
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
