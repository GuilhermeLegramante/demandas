<div wire:ignore.self class="card cursor-pointer">
    <div class="card-header" data-card-widget="collapse">
        <div class="row mt-1">
            <div class="col-md-4">
                <h3 class="card-title cardTitleCustom"><strong> LISTA DE DEMANDAS FAVORITAS/FIXAS</strong>
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
            @foreach ($favorites as $demand)
            <div class="col-md-3">
                @include('partials.cards.demand-card')
            </div>
            @endforeach
        </div>
    </div>
</div>
