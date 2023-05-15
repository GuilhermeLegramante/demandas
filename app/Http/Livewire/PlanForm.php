<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\App;
use App\Http\Livewire\Traits\WithForm;
use App\Repositories\PlanRepository;

class PlanForm extends Component
{
    use WithForm;

    public $pageTitle = 'Plano';
    public $icon = 'fas fa-file-alt';
    public $basePath = 'plan.table';
    public $previousRoute = 'plan.table';
    public $method = 'store';
    public $formTitle = 'DADOS DO PLANO';

    protected $repositoryClass = 'App\Repositories\PlanRepository';

    public $name;
    public $note;
    public $hasOfflineMaterial;
    public $weeklyPostsQuantity;

    protected $inputs = [
        ['field' => 'recordId', 'edit' => true],
        ['field' => 'name', 'edit' => true, 'type' => 'string'],
        ['field' => 'note', 'edit' => true, 'type' => 'string'],
        ['field' => 'hasOfflineMaterial', 'edit' => true],
        ['field' => 'weeklyPostsQuantity', 'edit' => true],
    ];

    protected $validationAttributes = [
        'name' => 'Nome',
        'note' => 'Descrição',
        'hasOfflineMaterial' => 'Material Offline',
        'weeklyPostsQuantity' => 'Posts Semanais',
    ];

    public function rules()
    {
        return [
            'name' => ['required'],
            'hasOfflineMaterial' => ['required'],
            'weeklyPostsQuantity' => ['required'],
        ];
    }

    public function mount($id = null)
    {
        $repository = new PlanRepository();

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

        $this->name = $data->name;

        $this->note = $data->note;

        $this->hasOfflineMaterial = $data->hasOfflineMaterial;

        $this->weeklyPostsQuantity = $data->weeklyPostsQuantity;
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
        return view('livewire.plan-form');
    }
}
