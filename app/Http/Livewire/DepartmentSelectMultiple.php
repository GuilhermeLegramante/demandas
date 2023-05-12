<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Traits\WithSelect;

class DepartmentSelectMultiple extends Component
{
    use WithSelect;

    public $title = 'SETORES';
    public $modalId = 'modal-select-multiple-department';
    public $searchFieldsLabel = 'Código ou Nome';

    public $closeModal = 'closeMultipleDepartmentModal';
    public $selectModal = 'selectMultipleDepartment';
    public $showModal = 'showMultipleDepartmentModal';

    protected $repositoryClass = 'App\Repositories\DepartmentRepository';

    public function mount()
    {
        $this->headerColumns = [
            ['field' => null, 'label' => 'checkbox', 'css' => 'text-center w-10'],
            ['field' => 'name', 'label' => 'Descrição', 'css' => 'w-50'],
        ];

        $this->bodyColumns = [
            ['field' => 'id', 'label' => 'name', 'type' => 'checkbox', 'css' => 'text-center'],
            ['field' => 'name', 'type' => 'string', 'css' => 'pl-12px'],
        ];

        $this->type = 'multiple';
    }

    public function render()
    {
        $this->modalActionButtons = null;

        $this->search();

        $data = $this->data;

        return view('livewire.department-select-multiple', compact('data'));
    }
}
