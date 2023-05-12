<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\SelectMultipleDepartment;
use Livewire\Component;
use Illuminate\Support\Facades\App;
use App\Http\Livewire\Traits\WithForm;
use App\Repositories\DepartmentRepository;
use App\Repositories\UserRepository;

class UserForm extends Component
{
    use WithForm, SelectMultipleDepartment;

    public $pageTitle = 'Usuário';
    public $icon = 'fas fa-user';
    public $basePath = 'user.table';
    public $previousRoute = 'user.table';
    public $method = 'store';
    public $formTitle = 'DADOS DO USUÁRIO';

    protected $repositoryClass = 'App\Repositories\UserRepository';

    public $name;
    public $login;
    public $password;
    public $password_confirmation;
    public $email;
    public $isAdmin;

    protected $inputs = [
        ['field' => 'recordId', 'edit' => true],
        ['field' => 'name', 'edit' => true, 'type' => 'string'],
        ['field' => 'login', 'edit' => true, 'type' => 'string'],
        ['field' => 'password', 'edit' => true, 'type' => 'string'],
        ['field' => 'email', 'edit' => true],
        ['field' => 'isAdmin', 'edit' => true],
        ['field' => 'departments', 'edit' => true],
    ];

    protected $validationAttributes = [
        'name' => 'Nome',
        'login' => 'Login',
        'password' => 'Senha',
        'email' => 'E-mail',
        'isAdmin' => 'Admin',
    ];

    public function rules()
    {
        return [
            'name' => ['required'],
            'login' => ['required'],
            'password' => ['required', 'confirmed'],
            'isAdmin' => ['required'],
            'email' => ['email', 'nullable'],
        ];
    }

    protected $listeners = [
        'selectMultipleDepartment',
    ];

    public $filter = [
        'departmentsToSelect' => [],
        'selectedDepartments' => [],
        'departmentsDescriptions' => [],
    ];

    public function mount($id = null)
    {
        $repository = new DepartmentRepository();

        $departments = $repository->allSimplified()->toArray();

        foreach ($departments as $value) {
            $department['value'] = $value->id;
            $department['description'] = $value->name;
            array_push($this->filter['departmentsToSelect'], $department);
        }

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

        $this->login = $data->login;

        $this->isAdmin = $data->isAdmin;

        $this->email = $data->email;

        $repository = new UserRepository();

        $departments = $repository->departments($data->id);

        foreach ($departments as $department) {
            array_push($this->filter['departmentsDescriptions'], $department->name);
            array_push($this->filter['selectedDepartments'], $department->departmentId);
        }
    }

    public function customValidate()
    {
        $this->departments = $this->filter['selectedDepartments'];

        return true;
    }

    public function customDeleteValidate()
    {
        return true;
    }

    public function render()
    {
        return view('livewire.user-form');
    }
}
