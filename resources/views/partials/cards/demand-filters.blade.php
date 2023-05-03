<div wire:ignore.self class="card">
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
            @include('partials.inputs.select', [
            'columnSize' => 3,
            'label' => 'Status',
            'model' => 'filterStatusId',
            'options' => $statusToFilter,
            ])

            @include('partials.inputs.select', [
            'columnSize' => 3,
            'label' => 'Tipo de Demanda',
            'model' => 'filterDemandTypeId',
            'options' => $demandTypesToFilter,
            ])

            @include('partials.inputs.date', [
            'columnSize' => 3,
            'label' => 'Data Inicial',
            'model' => 'filterStartDate',
            ])

            @include('partials.inputs.date', [
            'columnSize' => 3,
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
    </div>
</div>
