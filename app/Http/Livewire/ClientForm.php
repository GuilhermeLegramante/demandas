<?php

namespace App\Http\Livewire;

use App;
use App\Http\Livewire\Traits\WithForm;
use App\Repositories\PlanRepository;
use App\Repositories\UserRepository;
use App\Services\ArrayHandler;
use App\Services\Mask;
use Livewire\Component;

class ClientForm extends Component
{
    use WithForm;

    public $pageTitle = 'Cliente';
    public $icon = 'fas fa-user-tag';
    public $basePath = 'client.table';
    public $previousRoute = 'client.table';
    public $method = 'store';
    public $formTitle = 'DADOS DO CLIENTE';

    protected $repositoryClass = 'App\Repositories\ClientRepository';

    public $name;
    public $email;
    public $phone;
    public $note;

    public $planId;
    public $responsibleId;

    public $plans = [];
    public $users = [];

    protected $inputs = [
        ['field' => 'recordId', 'edit' => true],
        ['field' => 'name', 'edit' => true, 'type' => 'string'],
        ['field' => 'email', 'edit' => true],
        ['field' => 'phone', 'edit' => true, 'type' => 'string'],
        ['field' => 'note', 'edit' => true, 'type' => 'string'],
        ['field' => 'planId', 'edit' => true],
        ['field' => 'responsibleId', 'edit' => true],
    ];

    protected $validationAttributes = [
        'name' => 'Nome',
        'email' => 'E-mail',
        'phone' => 'Telefone',
        'note' => 'Observações',
        'planId' => 'Plano',
        'responsibleId' => 'Responsável',
    ];

    public function rules()
    {
        return [
            'name' => ['required'],
        ];
    }

    public function mount($id = null)
    {
        $repository = new PlanRepository();
        $this->plans = ArrayHandler::setSelect($repository->allSimplified()->sortBy('name'), 'id', 'name');

        $repository = new UserRepository();
        $this->users = ArrayHandler::setSelect($repository->allSimplified()->sortBy('name'), 'id', 'name');

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

    public function updatedPhone()
    {
        $this->phone = Mask::phone($this->phone);
    }

    public function setFields($data)
    {
        $this->recordId = $data->id;

        $this->name = $data->name;

        $this->phone = $data->phone;

        $this->email = $data->email;

        $this->note = $data->note;

        $this->planId = $data->planId;

        $this->responsibleId = $data->responsibleId;
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
        return view('livewire.client-form');
    }
}
