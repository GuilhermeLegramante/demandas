<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\SelectMultipleStatus;
use App\Http\Livewire\Traits\WithValidation;
use App\Repositories\ClientRepository;
use App\Repositories\DemandRepository;
use App\Repositories\DemandStatusRepository;
use App\Repositories\DemandTypeRepository;
use App\Services\ArrayHandler;
use DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DemandTable extends Component
{
    use WithFileUploads, WithValidation, WithPagination, SelectMultipleStatus;

    public $pageTitle = 'Demandas';
    public $icon = 'fas fa-list';

    public $filterStartDate;
    public $filterFinalDate;
    public $filterStatusId;
    public $filterStatus = [];
    public $filterDemandTypeId;
    public $demandTypesToFilter = [];
    public $filterText;
    public $filterClientId;
    public $clientsToFilter = [];

    public $title;
    public $subtitle;
    public $description;
    public $clientId;
    public $publicationDate;
    public $demandTypeId;
    public $demandStatusId;
    public $files;
    public $demand = [];
    public $demandId;
    public $totalFiles;
    public $storedFiles = [];
    public $keepFiles = true;

    public $sortByList = [];

    public $statusColor = '#2d6a2d';

    public $isEdition = false;

    public $sortBy = 'id';

    public $sortDirection = 'asc';

    public $perPage = '30';

    protected $paginationTheme = 'bootstrap';

    public $iteration = 1;

    protected $listeners = [
        'selectMultipleStatus',
    ];

    public $filter = [
        'statusToSelect' => [],
        'selectedStatus' => [],
        'statusDescriptions' => [],
    ];

    protected $validationAttributes = [
        'title' => 'Título',
        'subtitle' => 'Informações na Arte',
        'description' => 'Redação',
        'clientId' => 'Cliente',
        'publicationDate' => 'Data de Publicação',
        'demandTypeId' => 'Tipo de Demanda',
        'demandStatusId' => 'Status',
    ];

    public function rules()
    {
        return [
            'title' => ['required'],
            // 'demandTypeId' => ['required'],
            'demandStatusId' => ['required'],
            'clientId' => ['required'],
            'publicationDate' => ['after:' . now(), 'nullable'],
        ];
    }

    public function sortBy($field)
    {
        $this->sortDirection == 'asc' ? $this->sortDirection = 'desc' : $this->sortDirection = 'asc';
        return $this->sortBy = $field;
    }

    public function load($value)
    {
        if ($this->perPage >= 10) {
            $this->perPage += $value;

            $this->perPage == 0 ? $this->perPage = 30 : '';

            $this->perPage >= 0 ? $this->perPage = $this->perPage : $this->perPage = 30;
        }
    }

    public function mount()
    {
        $repository = new DemandStatusRepository();
        $this->statusToFilter = ArrayHandler::setSelect($repository->allSimplified(), 'id', 'description');

        $repository = new DemandTypeRepository();
        $this->demandTypesToFilter = ArrayHandler::setSelect($repository->allSimplified(), 'id', 'description');

        $repository = new ClientRepository();
        $this->clientsToFilter = ArrayHandler::setSelect($repository->allSimplified()->sortBy('name'), 'id', 'name');

        // $now = Carbon::now();
        // $this->filterStartDate = $now->startOfWeek()->format('Y-m-d');
        // $this->filterFinalDate = $now->endOfWeek()->format('Y-m-d');

        $this->sortByList = [
            ['value' => 'clientName', 'description' => 'Cliente'],
            ['value' => 'title', 'description' => 'Título'],
            ['value' => 'subtitle', 'description' => 'Info na arte'],
            ['value' => 'description', 'description' => 'Redação'],
            ['value' => 'username', 'description' => 'Usuário'],
            ['value' => 'createdAt', 'description' => 'Data de Criação'],
            ['value' => 'publicationDate', 'description' => 'Data de Publicação'],
        ];
    }

    public function showForm($demandId = null)
    {
        if (isset($demandId)) {
            $this->demandId = $demandId;
            $this->setFields();
        } else {
            $this->resetFields();
        }

        $this->emit('showDemandFormModal');
    }

    private function setFields()
    {
        $this->isEdition = true;

        $repository = new DemandRepository();

        $demand = $repository->findById($this->demandId);

        $this->title = $demand->title;

        $this->subtitle = $demand->subtitle;

        $this->description = $demand->description;

        $this->clientId = $demand->clientId;

        $this->publicationDate = $demand->publicationDate;

        $this->demandTypeId = $demand->demandTypeId;

        $this->demandStatusId = $demand->demandStatusId;

        $this->totalFiles = $demand->totalFiles;

        $this->storedFiles = ArrayHandler::jsonDecodeEncode($demand->files);

        $this->files = null;

        $this->iteration++;
    }

    private function resetFields()
    {
        $this->reset([
            'isEdition', 'title', 'subtitle', 'description',
            'clientId', 'publicationDate', 'demandTypeId', 'demandStatusId', 'files',
        ]);
    }

    public function confirmActionFromModal()
    {
        if ($this->isEdition) {
            $this->update();
        } else {
            $this->store();
        }
    }

    private function customValidate()
    {
        return true;
    }

    private function customDeleteValidate()
    {
        return true;
    }

    private function store()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $this->customValidate();

            $repository = new DemandRepository();

            $data = [
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'description' => $this->description,
                'clientId' => $this->clientId,
                'publicationDate' => $this->publicationDate,
                'demandStatusId' => $this->demandStatusId,
                'demandTypeId' => $this->demandTypeId,
                'files' => $this->files,
            ];

            $repository->save($data);

            session()->flash('success', 'Registro salvo com sucesso');

            DB::commit();

            $this->emit('close');
        } catch (\Exception $error) {
            DB::rollback();

            session()->flash('error-details', $error->getMessage());

            isset($error->errorInfo) && $error->errorInfo[0] == '23000' ? session()->flash('error', config('messages.mysql.' . $error->errorInfo[1])) :
                session()->flash('error', $error->getMessage());
        }
    }

    private function update()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $this->customValidate();

            $repository = new DemandRepository();

            $data = [
                'recordId' => $this->demandId,
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'description' => $this->description,
                'clientId' => $this->clientId,
                'publicationDate' => $this->publicationDate,
                'demandStatusId' => $this->demandStatusId,
                'demandTypeId' => $this->demandTypeId,
                'files' => $this->files,
                'keepFiles' => $this->keepFiles,
            ];

            $repository->update($data);

            session()->flash('success', 'Registro editado com sucesso');

            DB::commit();

            $this->emit('close');
        } catch (\Exception $error) {
            DB::rollback();

            session()->flash('error-details', $error->getMessage());

            isset($error->errorInfo) && $error->errorInfo[0] == '23000' ? session()->flash('error', config('messages.mysql.' . $error->errorInfo[1])) :
                session()->flash('error', $error->getMessage());
        }
    }

    public function showFiles($demandId)
    {
        $repository = new DemandRepository();

        $this->demand = ArrayHandler::jsonDecodeEncode($repository->findById($demandId));

        $this->emit('showDemandFilesModal');
    }

    public function showModalDelete()
    {
        $this->emit('delete');
    }

    public function setDemandId($id)
    {
        $this->demandId = $id;
    }

    public function destroy()
    {
        try {
            DB::beginTransaction();

            $this->customDeleteValidate();

            $repository = new DemandRepository();

            $repository->delete([
                'recordId' => $this->demandId,
            ]);

            session()->flash('success', 'Registro excluído com sucesso');

            DB::commit();

            $this->emit('close');

            // return redirect()->route('demand.table');
        } catch (\Exception $error) {
            DB::rollback();

            $this->emit('close');

            isset($error->errorInfo) && $error->errorInfo[0] == '23000' ? session()->flash('error', config('messages.mysql.' . $error->errorInfo[1])) :
                session()->flash('error', $error->getMessage());
        }
    }

    public function setFavorite($demandId, $isFavorite)
    {
        $repository = new DemandRepository();
        if ($isFavorite == '0') {
            $repository->setFavorite($demandId);
        } else {
            $repository->removeFavorite($demandId);
        }
    }

    public function render()
    {
        if ($this->sortBy == '') {
            $this->sortBy = 'id';
        }

        $repository = new DemandRepository();

        $demands = $repository->all(
            $this->filter['selectedStatus'],
            $this->filterDemandTypeId,
            $this->filterStartDate,
            $this->filterFinalDate,
            $this->filterText,
            $this->filterClientId,
            $this->sortBy,
            $this->sortDirection,
            $this->perPage,
        );

        if ($demands->total() == $demands->lastItem()) {
            $this->emit('scrollTop');
        }

        $favorites = $repository->favorites();

        // dd($this->filter['selectedStatus']);

        return view('livewire.demand-table', compact('demands', 'favorites'));
    }
}
