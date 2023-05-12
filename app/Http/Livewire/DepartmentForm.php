<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Traits\WithForm;
use App;
use App\Http\Livewire\Traits\SelectMultipleUser;
use App\Repositories\DepartmentRepository;
use App\Repositories\UserRepository;

class DepartmentForm extends Component
{
    use WithForm, SelectMultipleUser;

    public $pageTitle = 'Setor';
    public $icon = 'fas fa-building';
    public $basePath = 'department.table';
    public $previousRoute = 'department.table';
    public $method = 'store';
    public $formTitle = 'DADOS DO SETOR';

    protected $repositoryClass = 'App\Repositories\DepartmentRepository';

    public $name;
    public $note;

    protected $inputs = [
        ['field' => 'recordId', 'edit' => true],
        ['field' => 'name', 'edit' => true, 'type' => 'string'],
        ['field' => 'note', 'edit' => true, 'type' => 'string'],
        ['field' => 'users', 'edit' => true],
    ];

    protected $validationAttributes = [
        'description' => 'Descrição',
        'note' => 'Observação',
    ];

    protected $listeners = [
        'selectMultipleUser',
    ];

    public $filter = [
        'usersToSelect' => [],
        'selectedUsers' => [],
        'usersDescriptions' => [],
    ];

    public function rules()
    {
        return [
            'name' => ['required'],
        ];
    }

    public function mount($id = null)
    {
        $repository = new UserRepository();
        $users = $repository->allSimplified()->toArray();

        foreach ($users as $value) {
            $user['value'] = $value->id;
            $user['description'] = $value->name;
            array_push($this->filter['usersToSelect'], $user);
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

        $this->note = $data->note;

        $repository = new DepartmentRepository();

        $users = $repository->users($data->id);

        foreach ($users as $user) {
            array_push($this->filter['usersDescriptions'], $user->name);
            array_push($this->filter['selectedUsers'], $user->userId);
        }
    }

    public function customValidate()
    {
        $this->users = $this->filter['selectedUsers'];

        return true;
    }

    public function customDeleteValidate()
    {
        return true;
    }

    public function render()
    {
        return view('livewire.department-form');
    }
}
