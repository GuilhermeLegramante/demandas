<?php

namespace App\Http\Livewire;

use App;
use Livewire\Component;
use App\Http\Livewire\Traits\WithForm;
use App\Services\Mask;

class ClientForm extends Component
{
    use WithForm;

    public $pageTitle = 'Cliente';
    public $icon = 'fas fa-user';
    public $basePath = 'client.table';
    public $previousRoute = 'client.table';
    public $method = 'store';
    public $formTitle = 'DADOS DO CLIENTE';

    protected $repositoryClass = 'App\Repositories\ClientRepository';

    public $name;
    public $email;
    public $phone;

    protected $inputs = [
        ['field' => 'recordId', 'edit' => true],
        ['field' => 'name', 'edit' => true, 'type' => 'string'],
        ['field' => 'email', 'edit' => true],
        ['field' => 'phone', 'edit' => true, 'type' => 'string'],
    ];

    protected $validationAttributes = [
        'name' => 'Nome',
        'email' => 'E-mail',
        'phone' => 'Telefone',
    ];

    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['email'],
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
