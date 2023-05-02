@extends('template.page')

@section('page_header')
@include('partials.header.default')
@endsection

@section('page_content')

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
            'model' => 'filterStatus',
            'options' => [
            ['value' => 1, 'description' => 'NA FILA'],
            ['value' => 2, 'description' => 'EM PRODUÇÃO'],
            ['value' => 3, 'description' => 'ENVIADO'],
            ['value' => 3, 'description' => 'APROVADO'],
            ['value' => 3, 'description' => 'POSTADO'],
            ],
            ])

            @include('partials.inputs.select', [
            'columnSize' => 3,
            'label' => 'Tipo de Demanda',
            'model' => 'filterStatus',
            'options' => [
            ['value' => 1, 'description' => 'NORMAL'],
            ['value' => 2, 'description' => 'EXTRA'],
            ],
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
            'options' => [
            ['value' => 1, 'description' => 'CLIENTE A'],
            ['value' => 2, 'description' => 'CLIENTE B'],
            ['value' => 3, 'description' => 'CLIENTE C'],
            ],
            ])
        </div>
    </div>
</div>



{{-- <div wire:ignore.self class="card card-outline card-primary collapsed-card">
    <div class="card-header" data-card-widget="collapse">
        <h2 class="text-center"><strong>Abril 2023</strong></h2>
        <div class="card-tools mt-n3">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="p-2">
            <table class="table table-bordered cel-hover">
                <thead>
                    <tr>
                        <th class="text-center bg-light">Domingo</th>
                        <th class="text-center bg-info">Segunda</th>
                        <th class="text-center bg-info">Terça</th>
                        <th class="text-center bg-info">Quarta</th>
                        <th class="text-center bg-info">Quinta</th>
                        <th class="text-center bg-info">Sexta</th>
                        <th class="text-center bg-light">Sábado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="height: 6rem;" class="h-20 text-center">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>1</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                    </tr>
                    <tr style="height: 6rem;" class="h-20 text-center">
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>2</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>3</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>4</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>5</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>6</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>7</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>8</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                    </tr>
                    <tr style="height: 6rem;" class="h-20 text-center">
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>9</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>10</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>11</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>12</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>13</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>14</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>15</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                    </tr>
                    <tr style="height: 6rem;" class="h-20 text-center">
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>16</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>17</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>18</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>19</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>20</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>21</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>22</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                    </tr>
                    <tr style="height: 6rem;" class="h-20 text-center">
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>23</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>24</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>25</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>26</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>27</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>28</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>29</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                    </tr>
                    <tr style="height: 6rem;" class="h-20 text-center">
                        <td style="cursor: pointer;">
                            <h2 class="mt-3"><strong>30</strong></h2>
                            <span class="float-center badge bg-primary mb-1"> 5</i>
                            </span>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div> --}}

<div wire:ignore.self class="card">
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
            <div class="col-md-3">
                <div style="border-top: 3px solid {{ $statusColor }};" wire:ignore.self class="card card-outline card-secondary collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>PORTO SUSHI</strong></h3>
                        <div class="card-tools mt-2">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <br>
                        <p><small><strong>TÍTULO DO POST AQUI</strong></small></p>
                    </div>
                    <div class="card-body">
                        <p class="text-center"><strong>INFORMAÇÕES NA ARTE</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
                            convallis elit non elit iaculis</p>
                        <hr>
                        <p class="text-center"><strong>REDAÇÃO</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
                            convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat,
                            tristique sem non, euismod risus. Vestibulum convallis elit non elit iaculis, ac egestas
                            tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus</p>
                        <hr>
                        <p class="text-center"><strong>ANEXOS</strong></p>
                        <a href="">anexo_01.png</a><br>
                        <a href="">anexo_02.png</a><br>
                        <a href="">anexo_03.png</a><br>
                        <hr>
                        <div class="info-box bg-danger">
                            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-number">30/04 às 10:30</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 90%"></div>
                                </div>
                                <span class="progress-description">
                                    <small>Restando 2 dia(s)</small>
                                </span>
                            </div>
                        </div>
                        <hr>
                        <div class="card text-center bg-secondary">
                            <div class="p-2">
                                <span><strong>NA FILA</strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button wire:click.prevent="showForm(1)" type="submit" wire:loading.attr="disabled" class="btn btn-outline-primary btn-sm">
                            <strong> EDITAR &nbsp;</strong>
                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div wire:ignore.self class="card card-outline card-primary collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>PORTO SUSHI</strong></h3>
                        <div class="card-tools mt-2">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <br>
                        <p><small><strong>TÍTULO DO POST AQUI</strong></small></p>
                    </div>

                    <div class="card-body">
                        <p class="text-center"><strong>INFORMAÇÕES NA ARTE</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
                            convallis elit non elit iaculis</p>
                        <hr>
                        <p class="text-center"><strong>REDAÇÃO</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
                            convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat,
                            tristique sem non, euismod risus. Vestibulum convallis elit non elit iaculis, ac egestas
                            tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus</p>
                        <hr>
                        <p class="text-center"><strong>ANEXOS</strong></p>
                        <a href="">anexo_01.png</a><br>
                        <a href="">anexo_02.png</a><br>
                        <a href="">anexo_03.png</a><br>
                        <hr>
                        <div class="info-box bg-light">
                            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-number">20/04 às 14:00</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>
                                <span class="progress-description">
                                    <small>Restando 10 dia(s)</small>
                                </span>
                            </div>
                        </div>
                        <hr>
                        <div class="card text-center bg-primary">
                            <div class="p-2">
                                <span><strong>EM PRODUÇÃO</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div wire:ignore.self class="card card-outline card-warning collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>MARCA E SINAL</strong></h3>
                        <div class="card-tools mt-2">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <br>
                        <p><small><strong>TÍTULO DO POST AQUI</strong></small></p>
                    </div>

                    <div class="card-body">
                        <p class="text-center"><strong>INFORMAÇÕES NA ARTE</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
                            convallis elit non elit iaculis</p>
                        <hr>
                        <p class="text-center"><strong>REDAÇÃO</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
                            convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat,
                            tristique sem non, euismod risus. Vestibulum convallis elit non elit iaculis, ac egestas
                            tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus</p>
                        <hr>
                        <p class="text-center"><strong>ANEXOS</strong></p>
                        <a href="">anexo_01.png</a><br>
                        <a href="">anexo_02.png</a><br>
                        <a href="">anexo_03.png</a><br>
                        <hr>
                        <div class="info-box bg-light">
                            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-number">20/04</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>
                                <span class="progress-description">
                                    <small>Restando 10 dia(s)</small>
                                </span>
                            </div>
                        </div>
                        <hr>
                        <div class="card text-center bg-warning">
                            <div class="p-2">
                                <span><strong>ENVIADO</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div wire:ignore.self class="card card-outline card-info collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>ZEFERINO</strong></h3>
                        <div class="card-tools mt-2">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <br>
                        <p><small><strong>TÍTULO DO POST AQUI</strong></small></p>
                    </div>
                    <div class="card-body">
                        <p class="text-center"><strong>INFORMAÇÕES NA ARTE</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
                            convallis elit non elit iaculis</p>
                        <hr>
                        <p class="text-center"><strong>REDAÇÃO</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
                            convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat,
                            tristique sem non, euismod risus. Vestibulum convallis elit non elit iaculis, ac egestas
                            tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus</p>
                        <hr>
                        <p class="text-center"><strong>ANEXOS</strong></p>
                        <a href="">anexo_01.png</a><br>
                        <a href="">anexo_02.png</a><br>
                        <a href="">anexo_03.png</a><br>
                        <hr>
                        <div class="info-box bg-light">
                            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-number">20/04 às 15:00</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>
                                <span class="progress-description">
                                    <small>Restando 10 dia(s)</small>
                                </span>
                            </div>
                        </div>
                        <hr>
                        <div class="card text-center bg-info">
                            <div class="p-2">
                                <span><strong>APROVADO</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div wire:ignore.self class="card card-outline card-success collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>PORTO SUSHI</strong></h3>
                        <div class="card-tools mt-2">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <br>
                        <p><small><strong>TÍTULO DO POST AQUI</strong></small></p>
                    </div>
                    <div class="card-body">
                        <p class="text-center"><strong>INFORMAÇÕES NA ARTE</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
                            convallis elit non elit iaculis</p>
                        <hr>
                        <p class="text-center"><strong>REDAÇÃO</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
                            convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat,
                            tristique sem non, euismod risus. Vestibulum convallis elit non elit iaculis, ac egestas
                            tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus</p>
                        <hr>
                        <p class="text-center"><strong>ANEXOS</strong></p>
                        <a href="">anexo_01.png</a><br>
                        <a href="">anexo_02.png</a><br>
                        <a href="">anexo_03.png</a><br>
                        <hr>
                        <div class="info-box bg-light">
                            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-number">20/04</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>
                                <span class="progress-description">
                                    <small>Restando 10 dia(s)</small>
                                </span>
                            </div>
                        </div>
                        <hr>
                        <div class="card text-center bg-success">
                            <div class="p-2">
                                <span><strong>POSTADO</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="menu-rapido" class="fab z-index-9999999">
    <button class="main"></button>
    <ul>
        <li>
            <label>Incluir Demanda</label>
            <button id="opcao3" wire:click="showForm()">
                <i class="fas fa-plus" aria-hidden="true"></i>
            </button>
        </li>
    </ul>
</div>

<div wire:ignore.self class="modal fade z-index-99999" id="modal-demand-form" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <p><strong>Incluir Demanda</strong></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @include('partials.inputs.text', [
                    'columnSize' => 12,
                    'label' => 'Título',
                    'model' => 'title',
                    'maxLenght' => 100,
                    ])
                </div>

                <div class="row">
                    @include('partials.inputs.text', [
                    'columnSize' => 12,
                    'label' => 'Informações na arte',
                    'model' => 'subtitle',
                    'maxLenght' => 100,
                    ])
                </div>

                <div class="row">
                    @include('partials.inputs.textarea', [
                    'columnSize' => 12,
                    'label' => 'Redação',
                    'model' => 'description',
                    'rows' => 6,
                    'maxLength' => 5000,
                    ])
                </div>

                <div class="row">
                    @include('partials.inputs.select', [
                    'columnSize' => 12,
                    'label' => 'Cliente',
                    'model' => 'clientId',
                    'options' => [
                    ['value' => 1, 'description' => 'CLIENTE A'],
                    ['value' => 2, 'description' => 'CLIENTE B'],
                    ['value' => 3, 'description' => 'CLIENTE C'],
                    ],
                    ])
                </div>

                <div class="row">
                    @include('partials.inputs.select', [
                    'columnSize' => 12,
                    'label' => 'Tipo de Demanda',
                    'model' => 'demandTypeId',
                    'options' => [
                    ['value' => 1, 'description' => 'NORMAL'],
                    ['value' => 2, 'description' => 'EXTRA'],
                    ],
                    ])
                </div>

                <div class="row">
                    @include('partials.inputs.select', [
                    'columnSize' => 12,
                    'label' => 'Status',
                    'model' => 'demandStatusId',
                    'options' => [
                    ['value' => 1, 'description' => 'NA FILA'],
                    ['value' => 2, 'description' => 'EM PRODUÇÃO'],
                    ['value' => 3, 'description' => 'ENVIADO'],
                    ['value' => 3, 'description' => 'APROVADO'],
                    ['value' => 3, 'description' => 'POSTADO'],
                    ],
                    ])
                </div>

                <div class="row">
                    @include('partials.inputs.date', [
                    'columnSize' => 12,
                    'label' => 'Data e Hora da publicação',
                    'model' => 'publicationDate',
                    'isDatetime' => true,
                    ])
                </div>

                <div class="row">
                    @include('partials.inputs.file', [
                    'columnSize' => 12,
                    'label' => 'Anexos',
                    'model' => 'files',
                    'multiple' => true,
                    ])
                </div>

                @if($isEdition)
                <div class="row">
                    <div class="col-md-12">
                        <a href="">anexo_01.png</a><br>
                        <a href="">anexo_02.png</a><br>
                        <a href="">anexo_03.png</a><br>
                    </div>
                </div>
                @endif

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal" wire:loading.attr="disabled">
                    <i class="fas fa-times" aria-hidden="true"></i>
                    <strong> CANCELAR &nbsp;</strong>
                </button>
                <button wire:click.prevent="selectMultiple" wire:key="selectMultiple" type="submit" wire:loading.attr="disabled" class="btn btn-primary btn-sm">
                    <strong> CONFIRMAR &nbsp;</strong>
                    <i class="fas fa-check" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</div>





<style>
    .cel-hover th:hover,
    td:hover {
        background: lightgray;
    }

</style>

@endsection

@push('scripts')
<script>
    window.livewire.on('showDemandFormModal', () => {
        $('#modal-demand-form').modal('show');
    });

</script>

@endpush
