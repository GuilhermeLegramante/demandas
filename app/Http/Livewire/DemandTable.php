<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithValidation;
use App\Repositories\ClientRepository;
use App\Repositories\DemandRepository;
use App\Repositories\DemandStatusRepository;
use App\Repositories\DemandTypeRepository;
use App\Services\ArrayHandler;
use App\Services\Mask;
use Carbon\Carbon;
use DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class DemandTable extends Component
{
    use WithFileUploads, WithValidation;

    public $pageTitle = 'Demandas';
    public $icon = 'fas fa-list';

    public $filterStartDate;
    public $filterFinalDate;
    public $filterStatusId;
    public $statusToFilter = [];
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

    public $statusColor = '#2d6a2d';

    public $isEdition = false;

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

    public function mount()
    {
        $repository = new DemandStatusRepository();
        $this->statusToFilter = ArrayHandler::setSelect($repository->allSimplified(), 'id', 'description');

        $repository = new DemandTypeRepository();
        $this->demandTypesToFilter = ArrayHandler::setSelect($repository->allSimplified(), 'id', 'description');

        $repository = new ClientRepository();
        $this->clientsToFilter = ArrayHandler::setSelect($repository->allSimplified()->sortBy('name'), 'id', 'name');

        $now = Carbon::now();
        $this->filterStartDate = $now->startOfWeek()->format('Y-m-d');
        $this->filterFinalDate = $now->endOfWeek()->format('Y-m-d');
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
    }

    private function resetFields()
    {
        $this->reset([
            'isEdition', 'title', 'subtitle', 'description',
            'clientId', 'publicationDate', 'demandTypeId', 'demandStatusId'
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

            return redirect()->route('demand.table');
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

            return redirect()->route('demand.table');
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

            return redirect()->route('demand.table');
        } catch (\Exception $error) {
            DB::rollback();

            $this->emit('close');

            isset($error->errorInfo) && $error->errorInfo[0] == '23000' ? session()->flash('error', config('messages.mysql.' . $error->errorInfo[1])) :
                session()->flash('error', $error->getMessage());
        }
    }

    public function render()
    {
        $repository = new DemandRepository();

        $demands = $repository->all(
            $this->filterStatusId,
            $this->filterDemandTypeId,
            $this->filterStartDate,
            $this->filterFinalDate,
            $this->filterText,
            $this->filterClientId,
        );

        return view('livewire.demand-table', compact('demands'));
    }
}
