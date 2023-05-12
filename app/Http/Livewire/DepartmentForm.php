<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Traits\WithForm;
use App;
use App\Http\Livewire\Traits\SelectMultipleStatus;
use App\Http\Livewire\Traits\SelectMultipleUser;
use App\Repositories\DemandStatusRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\UserRepository;
use App\Services\ArrayHandler;

class DepartmentForm extends Component
{
    use WithForm, SelectMultipleUser, SelectMultipleStatus;

    public $pageTitle = 'Setor';
    public $icon = 'fas fa-building';
    public $basePath = 'department.table';
    public $previousRoute = 'department.table';
    public $method = 'store';
    public $formTitle = 'DADOS DO SETOR';

    protected $repositoryClass = 'App\Repositories\DepartmentRepository';

    public $name;
    public $note;
    public $status;

    protected $inputs = [
        ['field' => 'recordId', 'edit' => true],
        ['field' => 'name', 'edit' => true, 'type' => 'string'],
        ['field' => 'note', 'edit' => true, 'type' => 'string'],
        ['field' => 'users', 'edit' => true],
        ['field' => 'status', 'edit' => true],
    ];

    protected $validationAttributes = [
        'description' => 'Descrição',
        'note' => 'Observação',
    ];

    protected $listeners = [
        'selectMultipleUser',
        'selectMultipleStatus',
    ];

    public $filter = [
        'usersToSelect' => [],
        'selectedUsers' => [],
        'usersDescriptions' => [],
        'statusToSelect' => [],
        'selectedStatus' => [],
        'statusDescriptions' => [],
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

        $repository = new DemandStatusRepository();
        $this->statusToFilter = ArrayHandler::setSelect($repository->allSimplified(), 'id', 'description');

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

        $status = $repository->status($data->id);

        foreach ($status as $value) {
            array_push($this->filter['statusDescriptions'], $value->description);
            array_push($this->filter['selectedStatus'], $value->statusId);
        }
    }

    public function customValidate()
    {
        $this->users = $this->filter['selectedUsers'];

        $this->status = $this->filter['selectedStatus'];

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
