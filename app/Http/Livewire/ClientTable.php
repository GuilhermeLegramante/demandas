<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Http\Livewire\Components\Button;
use App\Http\Livewire\Traits\WithDatatable;
use Livewire\Component;
use App\Services\SessionService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;


class ClientTable extends Component
{
    use WithDatatable, WithPagination;

    public $entity = 'client';
    public $pageTitle = 'Clientes';
    public $icon = 'fas fa-user-tag';
    public $searchFieldsLabel = 'Código, Nome do Cliente ou Nome do Responsável';
    public $hasForm = true;

    public $headerColumns = [
        ['field' => 'id', 'label' => 'Código', 'css' => 'text-center w-5'],
        ['field' => 'name', 'label' => 'Nome', 'css' => 'w-20'],
        ['field' => 'plan', 'label' => 'Plano', 'css' => 'w-20'],
        ['field' => 'plan', 'label' => 'Responsável', 'css' => 'w-20'],
        ['field' => 'hasOfflineMaterial', 'label' => 'Material Offline', 'css' => 'text-center w-10'],
        ['field' => 'weeklyPostsQuantity', 'label' => 'Posts do Plano', 'css' => 'text-center w-10'],
        ['field' => 'availableDemands', 'label' => 'Posts Disponíveis', 'css' => 'text-center w-10'],
        ['field' => null, 'label' => 'Ações', 'css' => 'w-5 text-center'],
    ];

    public $bodyColumns = [
        ['field' => 'id', 'type' => 'string', 'css' => 'text-center'],
        ['field' => 'name', 'type' => 'string', 'css' => 'pl-12px'],
        ['field' => 'plan', 'type' => 'string', 'css' => 'pl-12px'],
        ['field' => 'responsible', 'type' => 'string', 'css' => 'pl-12px'],
        ['field' => 'hasOfflineMaterial', 'type' => 'boolean', 'css' => 'text-center'],
        ['field' => 'weeklyPostsQuantity', 'type' => 'string', 'css' => 'text-center'],
        ['field' => 'availableDemands', 'type' => 'availablePosts', 'css' => 'text-center'],
    ];

    protected $repositoryClass = 'App\Repositories\ClientRepository';

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

        // dd($data);

        return view('livewire.client-table', compact('data', 'buttons'));
    }
}
