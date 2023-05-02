<?php

namespace App\Http\Livewire;

use App;
use Livewire\Component;
use App\Http\Livewire\Traits\WithForm;

class DemandTypeForm extends Component
{
    use WithForm;

    public $pageTitle = 'Tipo de Demanda';
    public $icon = 'fas fa-list-alt';
    public $basePath = 'demand-type.table';
    public $previousRoute = 'demand-type.table';
    public $method = 'store';
    public $formTitle = 'DADOS DO TIPO DE DEMANDA';

    protected $repositoryClass = 'App\Repositories\DemandTypeRepository';

    public $description;
    public $note;

    protected $inputs = [
        ['field' => 'recordId', 'edit' => true],
        ['field' => 'description', 'edit' => true, 'type' => 'string'],
        ['field' => 'note', 'edit' => true, 'type' => 'string'],
    ];

    protected $validationAttributes = [
        'description' => 'Descrição',
        'note' => 'Observação',
    ];

    public function rules()
    {
        return [
            'description' => ['required'],
        ];
    }

    public function mount($id = null)
    {
        if (isset($id)) {
            $this->method = 'update';

            $this->isEdition = true;

            $repository = App::make($this->repositoryClass);

            $data = $repository->findById($id);

            if (isset($data)) {
                $this->setFields($data);
            }
        }
    }

    public function setFields($data)
    {
        $this->recordId = $data->id;

        $this->description = $data->description;

        $this->note = $data->note;
    }

    public function customValidate()
    {
        return true;
    }

    public function customDeleteValidate()
    {
        return true;
    }

    public function render()
    {
        return view('livewire.demand-type-form');
    }
}
