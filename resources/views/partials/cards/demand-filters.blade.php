<div wire:ignore.self class="card cursor-pointer">
    <div class="card-header" data-card-widget="collapse">
        <div class="row mt-1">
            <div class="col-md-4">
                <h3 class="card-title cardTitleCustom"><strong> FILTROS</strong>
                </h3>
            </div>
        </div>
        <div class="card-tools mt-n2">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label>Status</label>
                    <div class="input-group">
                        <h3 wire:click="$emit('showMultipleStatusModal')" class="cursor-pointer form-control input-custom  {{ $errors->has('filter.selectedStatus') ? 'is-invalid' : '' }}">
                            @isset($filter['statusDescriptions'])
                            @foreach ($filter['statusDescriptions'] as $status)
                            <small class="badge mt-1">{{ $status }}</small>
                            @endforeach
                            @endisset
                        </h3>
                        <span class="input-group-append">
                            <button type="button" class="btn btn-primary" title="Pesquisar" wire:click="$emit('showMultipleLocaleModal')">
                                <i class="fas fa-search"></i>
                            </button>
                        </span>
                    </div>
                    @error('filter.selectedStatus')
                    <h3 class="text-danger">
                        <strong>{{ $message }}</strong>
                    </h3>
                    @enderror
                </div>
            </div>
            @include('partials.inputs.select', [
            'columnSize' => 3,
            'label' => 'Tipo de Demanda',
            'model' => 'filterDemandTypeId',
            'options' => $demandTypesToFilter,
            ])

            @include('partials.inputs.date', [
            'columnSize' => 2,
            'label' => 'Data Inicial',
            'model' => 'filterStartDate',
            ])

            @include('partials.inputs.date', [
            'columnSize' => 2,
            'label' => 'Data Final',
            'model' => 'filterFinalDate',
            ])
        </div>

        <div class="row">
            @include('partials.inputs.text', [
            'columnSize' => 12,
            'label' => 'Busca textual (título, info na arte ou redação)',
            'model' => 'filterText',
            'maxLenght' => 100,
            ])
        </div>

        <div class="row">
            @include('partials.inputs.select', [
            'columnSize' => 12,
            'label' => 'Cliente',
            'model' => 'filterClientId',
            'options' => $clientsToFilter,
            ])
        </div>
        <div class="row">
            @include('partials.inputs.select', [
            'columnSize' => 4,
            'label' => 'Ordenar por',
            'model' => 'sortBy',
            'options' => $sortByList,
            ])
            @include('partials.inputs.select', [
            'columnSize' => 4,
            'label' => 'Ordem',
            'model' => 'sortDirection',
            'options' => [
            ['value'=> 'asc', 'description' => 'Ascendente'],
            ['value'=> 'desc', 'description' => 'Descendente'],
            ],
            ])
            @include('partials.inputs.select', [
            'columnSize' => 4,
            'label' => 'Itens por Página',
            'model' => 'perPage',
            'options' => [
            ['value'=> '10', 'description' => '10'],
            ['value'=> '30', 'description' => '30'],
            ['value'=> '50', 'description' => '50'],
            ['value'=> '100', 'description' => '100'],
            ],
            ])
        </div>

    </div>
</div>
