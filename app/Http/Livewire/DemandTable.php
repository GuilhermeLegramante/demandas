<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithValidation;
use App\Repositories\ClientRepository;
use App\Repositories\DemandRepository;
use App\Repositories\DemandStatusRepository;
use App\Repositories\DemandTypeRepository;
use App\Services\ArrayHandler;
use App\Services\Mask;
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
    }

    public function showForm($demandId = null)
    {
        if (isset($demandId)) {
            $this->setFields();
        } else {
            $this->resetFields();
        }

        $this->emit('showDemandFormModal');
    }

    private function setFields()
    {
        $this->isEdition = true;

        $this->title = 'Título do Post';

        $this->subtitle = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum convallis elit non elit iaculis';

        $this->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus. Vestibulum convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus';

        $this->clientId = 1;

        $this->publicationDate = '2022-05-02 10:00:00';

        $this->demandTypeId = 1;

        $this->demandStatusId = 1;
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
            dd('update');
        } else {
            $this->store();
        }
    }

    private function customValidate()
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
                'title' => Mask::normalizeString($this->title),
                'subtitle' => Mask::normalizeString($this->subtitle),
                'description' => Mask::normalizeString($this->description),
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

    public function showFiles($demandId)
    {
        $repository = new DemandRepository();

        $this->demand = ArrayHandler::jsonDecodeEncode($repository->findById($demandId));


        $this->emit('showDemandFilesModal');
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
