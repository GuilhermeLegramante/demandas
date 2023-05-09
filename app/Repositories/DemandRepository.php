<?php

namespace App\Repositories;

use App\Services\LogService;
use Illuminate\Support\Facades\DB;
use Storage;

class DemandRepository
{
    private $table = 'demands';

    private $baseQuery;

    public function __construct()
    {
        $this->baseQuery = DB::table($this->table . ' AS demands')
            ->join('users', 'users.id', '=', 'demands.user_id')
            ->join('clients', 'clients.id', '=', 'demands.client_id')
            ->join('demand_status', 'demand_status.id', '=', 'demands.demand_status_id')
            ->join('demand_types', 'demand_types.id', '=', 'demands.demand_type_id')
            ->select(
                $this->table . '.id AS id',
                $this->table . '.title AS title',
                $this->table . '.subtitle AS subtitle',
                $this->table . '.description AS description',
                $this->table . '.publication_date AS publicationDate',
                $this->table . '.user_id AS userId',
                'users.name AS username',
                $this->table . '.client_id AS clientId',
                'clients.name AS clientName',
                $this->table . '.demand_status_id AS demandStatusId',
                'demand_status.description AS demandStatusDescription',
                'demand_status.color AS demandStatusColor',
                $this->table . '.demand_type_id AS demandTypeId',
                'demand_types.description AS demandTypeDescription',
                $this->table . '.created_at AS createdAt',
                $this->table . '.updated_at AS updatedAt',
                DB::raw("abs((SELECT DATEDIFF('" . now() . "', demands.publication_date))) AS daysRemaining"),
                DB::raw("(select COUNT(`demand_files`.`id`) from demands AS demands_2 inner join `demand_files` on `demand_files`.`demand_id` = `demands_2`.`id` where demands.id = demands_2.id
                ) as totalFiles"),
                DB::raw("(select ifnull((select 1 as isFavorite from demands as demands_3 inner join favorites on demands_3.id = favorites.demand_id where demands_3.id = demands.id), 0)) as isFavorite")
            );
    }

    public function all(
        $status = null,
        $demandType = null,
        string $startDate = null,
        string $finalDate = null,
        string $search = null,
        $clientId = null,
        string $sortBy = 'id',
        string $sortDirection = 'asc',
        string $perPage = '30'
    ) {
        $demands = $this->baseQuery;

        if ($status != null) {
            $demands->whereIn($this->table . '.demand_status_id', $status);
        }

        if ($demandType != null) {
            $demands->where($this->table . '.demand_type_id', $demandType);
        }

        if ($startDate != null && $finalDate != null) {
            $demands
                ->whereDate($this->table . '.created_at', '>=', $startDate)
                ->whereDate($this->table . '.created_at', '<=', $finalDate);
        }

        if ($clientId != null) {
            $demands->where($this->table . '.client_id', $clientId);
        }

        if ($search != null) {
            $demands = $demands->where(function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where($this->table . '.title', 'like', '%' . $search . '%');
                })
                    ->orWhere(function ($query) use ($search) {
                        $query->where($this->table . '.subtitle', 'like', '%' . $search . '%');
                    })
                    ->orWhere(function ($query) use ($search) {
                        $query->where($this->table . '.description', 'like', '%' . $search . '%');
                    });
            });
        }

        return $demands
            ->orderBy($sortBy, $sortDirection)
            ->paginate($perPage);
    }

    public function favorites()
    {
        return DB::table($this->table . ' AS demands')
            ->join('users', 'users.id', '=', 'demands.user_id')
            ->join('clients', 'clients.id', '=', 'demands.client_id')
            ->join('demand_status', 'demand_status.id', '=', 'demands.demand_status_id')
            ->join('demand_types', 'demand_types.id', '=', 'demands.demand_type_id')
            ->join('favorites', 'favorites.demand_id', '=', 'demands.id')
            ->select(
                $this->table . '.id AS id',
                $this->table . '.title AS title',
                $this->table . '.subtitle AS subtitle',
                $this->table . '.description AS description',
                $this->table . '.publication_date AS publicationDate',
                $this->table . '.user_id AS userId',
                'users.name AS username',
                $this->table . '.client_id AS clientId',
                'clients.name AS clientName',
                $this->table . '.demand_status_id AS demandStatusId',
                'demand_status.description AS demandStatusDescription',
                'demand_status.color AS demandStatusColor',
                $this->table . '.demand_type_id AS demandTypeId',
                'demand_types.description AS demandTypeDescription',
                $this->table . '.created_at AS createdAt',
                $this->table . '.updated_at AS updatedAt',
                DB::raw("abs((SELECT DATEDIFF('" . now() . "', demands.publication_date))) AS daysRemaining"),
                DB::raw("(select COUNT(`demand_files`.`id`) from demands AS demands_2 inner join `demand_files` on `demand_files`.`demand_id` = `demands_2`.`id` where demands.id = demands_2.id
                ) as totalFiles"),
                DB::raw("(select ifnull((select 1 as isFavorite from demands as demands_3 inner join favorites on demands_3.id = favorites.demand_id where demands_3.id = demands.id), 0)) as isFavorite")
            )
            ->where('favorites.user_id', session()->get('userId'))
            ->groupBy('demands.id')
            ->get();
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
                    'publication_date' => isset($data['publicationDate']) ? $data['publicationDate'] : null,
                    'client_id' => $data['clientId'],
                    'user_id' => session()->get('userId'),
                    'demand_status_id' => $data['demandStatusId'],
                    'demand_type_id' => $data['demandTypeId'],
                    'created_at' => now(),
                ]
            );

        if (isset($data['files'])) {
            $this->uploadFiles($data['files'], $demandId);
        }
    }

    private function uploadFiles($files, $demandId)
    {
        foreach ($files as $file) {
            $path = '_lsmarketing/demandas';

            $s3Path = Storage::disk('s3')->put($path, $file);

            DB::table('demand_files')
                ->insertGetId(
                    [
                        'path' => $s3Path,
                        'user_id' => session()->get('userId'),
                        'demand_id' => $demandId,
                        'created_at' => now(),
                    ]
                );
        }
    }

    private function deleteFiles($demandId)
    {
        $repository = new DemandRepository();

        $demand = $repository->findById($demandId);

        if ($demand->totalFiles > 0) {
            foreach ($demand->files as $file) {
                Storage::disk('s3')->delete($file->path);
            }

            DB::table('demand_files')
                ->where('demand_id', $demandId)
                ->delete();
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
                    'publication_date' => isset($data['publicationDate']) ? $data['publicationDate'] : null,
                    'client_id' => $data['clientId'],
                    // 'user_id' => session()->get('userId'),
                    'demand_status_id' => $data['demandStatusId'],
                    'demand_type_id' => $data['demandTypeId'],
                    'updated_at' => now(),
                ]
            );

        if ($data['keepFiles'] == false) {
            $this->deleteFiles($data['recordId']);
        }

        if (isset($data['files'])) {
            $this->uploadFiles($data['files'], $data['recordId']);
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

        $this->deleteFiles($data['recordId']);

        DB::table($this->table)
            ->where('id', $data['recordId'])
            ->delete();
    }

    public function findById($id)
    {
        $demand = $this->baseQuery
            ->where($this->table . '.id', $id)
            ->get()
            ->first();

        $files = DB::table('demands')
            ->join('demand_files', 'demand_files.demand_id', '=', 'demands.id')
            ->where('demands.id', $id)
            ->select(
                'demand_files.id AS id',
                'demand_files.path AS path',
            )->get();

        $demand->files = $files;

        return $demand;
    }

    public function setFavorite($demandId)
    {
        DB::table('favorites')
            ->insert([
                'user_id' => session()->get('userId'),
                'demand_id' => $demandId,
                'created_at' => now(),
            ]);
    }

    public function removeFavorite($demandId)
    {
        DB::table('favorites')
            ->where('demand_id', $demandId)
            ->where('user_id', session()->get('userId'))
            ->delete();
    }
}
