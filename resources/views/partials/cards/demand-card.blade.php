<div wire:ignore.self class="card card-outline collapsed-card">
    <div data-card-widget="collapse" style="border-top: 3px solid {{ $demand->demandStatusColor }}; cursor: pointer; " class="card-header">
        <h3 class="card-title"><strong>{{ $demand->clientName }}</strong></h3><br>
        <p><strong>{{ Str::words($demand->title, 4) }}</strong></p>
        @if($demand->publicationDate != '0000-00-00 00:00:00' && $demand->publicationDate != null)
        <p style="color: {{ $demand->daysRemaining <= 2 ? 'red' : '' }};"><small>Publicar em {{ date('d/m \\à\\s H:i', strtotime($demand->publicationDate)) }} restando {{ $demand->daysRemaining }} dia(s) </small></p>
        @else
        <p><small>Data de Publicação não definida</small></p>
        @endif

        <p class="mt-1"><small>{{ date('d/m/Y \\à\\s H:i', strtotime($demand->createdAt)) }} por {{ $demand->username }}</small></p>

        <div class="card-tools mt-2">
            <span style="background-color: {{ $demand->demandStatusColor }}!important;" class="right badge badge-danger mt-2">
                {{ $demand->demandStatusDescription }}
                @if($demand->totalFiles > 0)
                <i class="fas fa-paperclip ml-1" aria-hidden="true"></i>
                @endif
            </span>
        </div>
    </div>
    <div class="card-body">
        <p class="text-center"><strong>TÍTULO</strong></p>
        <p class="text-justify">
            {{$demand->title}}
        </p>
        <hr>
        @if(isset($demand->subtitle) && $demand->subtitle != '')
        <p class="text-center"><strong>INFORMAÇÕES NA ARTE</strong></p>
        <p class="text-justify">
            {{$demand->subtitle}}
        </p>
        <hr>
        @endif
        @if (isset($demand->description) && $demand->description != '')
        <p class="text-center"><strong>REDAÇÃO</strong></p>
        <p class="text-justify">{{$demand->description}}</p>
        <hr>
        @endif
        @if($demand->publicationDate != '0000-00-00 00:00:00' && $demand->publicationDate != null)
        <div class="p-0 info-box {{ $demand->daysRemaining <= 2 ? 'bg-danger' : 'bg-light' }}">
            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-number"><small>Data para Publicação</small></span>
                <span class="info-box-number">{{ date('d/m \\à\\s H:i', strtotime($demand->publicationDate)) }}</span>
                <div class="progress">
                    <div class="progress-bar" style="width: calc(100% - ({{ $demand->daysRemaining }} * 10%))"></div>
                </div>
                <span class="progress-description">
                    <small>Restando {{ $demand->daysRemaining }} dia(s)</small>
                </span>
            </div>
        </div>
        <hr>
        @endif
    </div>
    <div class="card-footer text-center">
        @if($demand->totalFiles > 0)
        <button wire:click.prevent="showFiles({{ $demand->id }})" type="submit" title="Ver anexos" wire:loading.attr="disabled" class="btn btn-light btn-sm">
            <i class="fas fa-paperclip" aria-hidden="true"></i>
        </button>
        @endif
        <button wire:click.prevent="showForm({{ $demand->id }})" title="Editar a demanda" type="submit" wire:loading.attr="disabled" class="btn btn-light btn-sm">
            <i class="fas fa-edit" aria-hidden="true"></i>
        </button>
        <button wire:click.prevent="setFavorite({{ $demand->id }}, {{ $demand->isFavorite }})" title="Adicionar/Remover das favoritas" class="btn btn-light btn-sm">
            @if($demand->isFavorite)
            <i class="fas fa-star"></i>
            @else
            <i class="far fa-star"></i>
            @endif
        </button>
        <button wire:click.prevent="setDemandId({{ $demand->id }})" data-toggle="modal" data-toggle="tooltip" data-placement="top" title="Excluir a demanda" data-target="#modal-delete" class="btn btn-light btn-sm" wire:key="delete" wire:loading.attr="disabled">
            <i class="fas fa-trash-alt"></i>
        </button>
    </div>
</div>
