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
    public $icon = 'fas fa-users';
    public $searchFieldsLabel = 'Código ou Nome';
    public $hasForm = true;

    public $headerColumns = [
        ['field' => 'id', 'label' => 'Código', 'css' => 'text-center w-15'],
        ['field' => 'name', 'label' => 'Nome', 'css' => 'w-40'],
        ['field' => 'email', 'label' => 'E-mail', 'css' => 'w-20'],
        ['field' => 'phone', 'label' => 'Telefone', 'css' => 'w-20'],
        ['field' => null, 'label' => 'Ações', 'css' => 'w-5 text-center'],
    ];

    public $bodyColumns = [
        ['field' => 'id', 'type' => 'string', 'css' => 'text-center'],
        ['field' => 'name', 'type' => 'string', 'css' => 'pl-12px'],
        ['field' => 'email', 'type' => 'string', 'css' => 'pl-12px'],
        ['field' => 'phone', 'type' => 'string', 'css' => 'pl-12px'],
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

        return view('livewire.client-table', compact('data', 'buttons'));
    }
}
