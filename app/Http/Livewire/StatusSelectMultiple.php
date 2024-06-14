<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Traits\WithSelect;

class StatusSelectMultiple extends Component
{
    use WithSelect;

    public $title = 'STATUS';
    public $modalId = 'modal-select-multiple-status';
    public $searchFieldsLabel = 'Código ou Descrição';

    public $closeModal = 'closeMultipleStatusModal';
    public $selectModal = 'selectMultipleStatus';
    public $showModal = 'showMultipleStatusModal';

    protected $repositoryClass = 'App\Repositories\DemandStatusRepository';

    public function mount()
    {
        $this->headerColumns = [
            ['field' => null, 'label' => 'checkbox', 'css' => 'text-center w-10'],
            ['field' => 'color', 'label' => 'Cor', 'css' => 'text-center w-5'],
            ['field' => 'sequential', 'label' => 'Sequencial', 'css' => 'text-center w-5'],
            ['field' => 'description', 'label' => 'Descrição', 'css' => 'w-50'],
        ];

        $this->bodyColumns = [
            ['field' => 'id', 'label' => 'description', 'type' => 'checkbox', 'css' => 'text-center'],
            ['field' => 'color', 'type' => 'color', 'css' => 'text-center'],
            ['field' => 'sequential', 'type' => 'string', 'css' => 'text-center'],
            ['field' => 'description', 'type' => 'string', 'css' => 'pl-12px'],
        ];

        $this->type = 'multiple';
    }

    public function render()
    {
        $this->modalActionButtons = null;

        $this->search();

        $data = $this->data;

        return view('livewire.status-select-multiple', compact('data'));
    }
}
