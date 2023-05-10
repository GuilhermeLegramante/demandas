<div wire:ignore.self class="card cursor-pointer">
    <div class="card-header" data-card-widget="collapse">
        <div class="row mt-1">
            <div class="col-md-4">
                <h3 class="card-title cardTitleCustom"><strong> LISTAGEM GERAL DE DEMANDAS</strong>
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
            @foreach ($demands as $demand)
            {{-- @if(!$demand->isFavorite)  --}}
            <div class="col-md-3">
                @include('partials.cards.demand-card')
            </div>
            {{-- @endif  --}}
            @endforeach
        </div>

        @if ($demands->isEmpty())
        <div class="d-flex justify-content-center">
            <h3>Nenhum registro encontrado.</h3>
        </div>
        @else
        @if ($demands->lastItem() != $demands->total())
        <div class="row">
            <div class="col-12 text-center">
                <a href="#topo" data-toggle="tooltip" title="VOLTAR AO TOPO" class="btn btn-primary btn-sm">
                    <i class="fas fa-chevron-up"></i>
                </a>
                <a href="" wire:click.prevent="load('30')" data-toggle="tooltip" title="VER MAIS" class="btn btn-primary btn-sm">
                    <i class="fas fa-chevron-down"></i>
                </a>
                {{-- <a wire:click="load('30')" data-toggle="tooltip" title="VER MAIS"
                        class="btn btn-primary btn-sm">
                        <i class="fas fa-chevron-down"></i>
                    </a> --}}
            </div>
        </div>
        @endif

        <div class="d-flex mb-3">
            <div class="mr-auto">
                <p>Mostrando de {{ $demands->firstItem() }} até {{ $demands->lastItem() }} de
                    {{ $demands->total() }} registros.</p>
            </div>
            <div class="p-2">
                <p>{{ $demands->links() }}</p>
            </div>
        </div>
        @endif
    </div>
</div>
