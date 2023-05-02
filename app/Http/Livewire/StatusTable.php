<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Http\Livewire\Components\Button;
use App\Http\Livewire\Traits\WithDatatable;
use Livewire\Component;
use App\Services\SessionService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;


class StatusTable extends Component
{
    use WithDatatable, WithPagination;

    public $entity = 'status';
    public $pageTitle = 'Status';
    public $icon = 'fas fa-clipboard-list';
    public $searchFieldsLabel = 'Código ou Descrição';
    public $hasForm = true;

    public $headerColumns = [
        ['field' => 'id', 'label' => 'Código', 'css' => 'text-center w-5'],
        ['field' => 'color', 'label' => 'Cor', 'css' => 'text-center w-15'],
        ['field' => 'description', 'label' => 'Descrição', 'css' => 'w-70'],
        ['field' => null, 'label' => 'Ações', 'css' => 'w-5 text-center'],
    ];

    public $bodyColumns = [
        ['field' => 'id', 'type' => 'string', 'css' => 'text-center'],
        ['field' => 'color', 'type' => 'color', 'css' => 'text-center'],
        ['field' => 'description', 'type' => 'string', 'css' => 'pl-12px'],
    ];

    protected $repositoryClass = 'App\Repositories\DemandStatusRepository';

    public function mount()
    {
        SessionService::start();
    }

    public function rowButtons(): array
    {
        return [
            Button::create('Selecionar')
                ->method('showForm')
                ->class('btn-primary')
                ->icon('fas fa-search'),
        ];
    }

    public function render()
    {
        $repository = App::make($this->repositoryClass);

        $data = $repository->all($this->search, $this->sortBy, $this->sortDirection, $this->perPage);

        if ($data->total() == $data->lastItem()) {
            $this->emit('scrollTop');
        }

        $buttons = $this->rowButtons();

        return view('livewire.status-table', compact('data', 'buttons'));
    }
}
