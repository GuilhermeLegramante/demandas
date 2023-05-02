<?php

namespace App\Http\Livewire;

use App;
use Livewire\Component;
use App\Http\Livewire\Traits\WithForm;

class StatusForm extends Component
{
    use WithForm;

    public $pageTitle = 'Status';
    public $icon = 'fas fa-clipboard-list';
    public $basePath = 'status.table';
    public $previousRoute = 'status.table';
    public $method = 'store';
    public $formTitle = 'DADOS DO STATUS';

    protected $repositoryClass = 'App\Repositories\DemandStatusRepository';

    public $description;
    public $color;
    public $note;

    protected $inputs = [
        ['field' => 'recordId', 'edit' => true],
        ['field' => 'description', 'edit' => true, 'type' => 'string'],
        ['field' => 'color', 'edit' => true],
        ['field' => 'note', 'edit' => true, 'type' => 'string'],
    ];

    protected $validationAttributes = [
        'description' => 'Descrição',
        'color' => 'Cor',
        'note' => 'Observação',
    ];

    public function rules()
    {
        return [
            'description' => ['required'],
            'color' => ['required'],
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

        $this->color = $data->color;

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
        return view('livewire.status-form');
    }
}
