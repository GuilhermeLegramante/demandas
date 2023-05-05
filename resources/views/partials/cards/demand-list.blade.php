<div wire:ignore.self class="card cursor-pointer">
    <div class="card-header" data-card-widget="collapse">
        <div class="row mt-1">
            <div class="col-md-4">
                <h3 class="card-title cardTitleCustom"><strong> LISTA DE DEMANDAS</strong>
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
            <div class="col-md-3">
                <div wire:ignore.self class="card card-outline collapsed-card">
                    <div data-card-widget="collapse" style="border-top: 3px solid {{ $demand->demandStatusColor }}; cursor: pointer; " class="card-header">
                        <h3 class="card-title"><strong>{{ $demand->clientName }}</strong></h3><br>
                        <p><strong>{{ $demand->title }}</strong></p>
                        <p><small>{{ date('d/m/Y \\à\\s H:i', strtotime($demand->createdAt)) }} por {{ $demand->username }}</small></p>

                        <div class="card-tools mt-2">
                            <span style="background-color: {{ $demand->demandStatusColor }}!important;" class="right badge badge-danger mt-2">{{ $demand->demandStatusDescription }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-center"><strong>INFORMAÇÕES NA ARTE</strong></p>
                        <p class="text-justify">{{$demand->subtitle}}</p>
                        <hr>
                        <p class="text-center"><strong>REDAÇÃO</strong></p>
                        <p class="text-justify">{{$demand->description}}</p>
                        <hr>
                        @if($demand->totalFiles > 0)
                        <div class="text-center">
                            <button wire:click.prevent="showFiles({{ $demand->id }})" type="submit" wire:loading.attr="disabled" class="btn btn-block btn-dark btn-sm">
                                <strong> ANEXOS &nbsp;</strong>
                                <i class="fas fa-paperclip" aria-hidden="true"></i>
                            </button>
                        </div>
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
                        <button wire:click.prevent="setDemandId({{ $demand->id }})" data-toggle="modal" data-toggle="tooltip" data-placement="top" title="Excluir o registro" data-target="#modal-delete" class="btn btn-light btn-sm" wire:key="delete" wire:loading.attr="disabled">
                            <strong> EXCLUIR &nbsp;</strong>
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <button wire:click.prevent="showForm({{ $demand->id }})" type="submit" wire:loading.attr="disabled" class="btn btn-dark btn-sm">
                            <strong> EDITAR &nbsp;</strong>
                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @include('partials.table.links', ['data' => $demands])
    </div>
</div>
