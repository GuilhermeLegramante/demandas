@extends('template.page')

@section('page_header')
@include('partials.header.default')
@endsection

@section('page_content')

<div wire:ignore.self class="card card-primary card-outline">
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
            @include('partials.inputs.number', [
            'columnSize' => 6,
            'label' => 'Data Inicial',
            'model' => 'startYear',
            ])

            @include('partials.inputs.number', [
            'columnSize' => 6,
            'label' => 'Data Final',
            'model' => 'finalYear',
            ])
        </div>

    </div>
</div>



<div wire:ignore.self class="card card-outline card-primary collapsed-card">
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
</div>

<div wire:ignore.self class="card">
    <div class="card-header" data-card-widget="collapse">
        <div class="row mt-1">
            <div class="col-md-4">
                <h3 class="card-title cardTitleCustom"><strong> DEMANDAS: 01/04/2023</strong>
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
                <div wire:ignore.self class="card card-outline card-secondary collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>PORTO SUSHI - Título do Post</strong></h3>
                        <div class="card-tools mt-2">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-center"><strong>INFORMAÇÕES NA ARTE</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum convallis elit non elit iaculis</p>
                        <hr>
                        <p class="text-center"><strong>REDAÇÃO</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus. Vestibulum convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus</p>
                        <hr>
                        <p class="text-center"><strong>ANEXOS</strong></p>
                        <a href="">anexo_01.png</a><br>
                        <a href="">anexo_02.png</a><br>
                        <a href="">anexo_03.png</a><br>
                        <hr>
                        <div class="info-box bg-danger">
                            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-number">30/04</span>
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
                </div>
            </div>
            <div class="col-md-3">
                <div wire:ignore.self class="card card-outline card-primary collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>PORTO SUSHI - Título do Post</strong></h3>
                        <div class="card-tools mt-2">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <p class="text-center"><strong>INFORMAÇÕES NA ARTE</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum convallis elit non elit iaculis</p>
                        <hr>
                        <p class="text-center"><strong>REDAÇÃO</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus. Vestibulum convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus</p>
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
                        <h3 class="card-title"><strong>MARCA E SINAL - Título do Post</strong></h3>
                        <div class="card-tools mt-2">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <p class="text-center"><strong>INFORMAÇÕES NA ARTE</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum convallis elit non elit iaculis</p>
                        <hr>
                        <p class="text-center"><strong>REDAÇÃO</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus. Vestibulum convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus</p>
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
                        <h3 class="card-title"><strong>ZEFERINO - Título do Post</strong></h3>
                        <div class="card-tools mt-2">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-center"><strong>INFORMAÇÕES NA ARTE</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum convallis elit non elit iaculis</p>
                        <hr>
                        <p class="text-center"><strong>REDAÇÃO</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus. Vestibulum convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus</p>
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
                        <h3 class="card-title"><strong>PORTO SUSHI - Título do Post</strong></h3>
                        <div class="card-tools mt-2">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-center"><strong>INFORMAÇÕES NA ARTE</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum convallis elit non elit iaculis</p>
                        <hr>
                        <p class="text-center"><strong>REDAÇÃO</strong></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus. Vestibulum convallis elit non elit iaculis, ac egestas tortor malesuada. Suspendisse id augue feugiat, tristique sem non, euismod risus</p>
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

<style>
    .cel-hover th:hover,
    td:hover {
        background: lightgray;
    }

</style>

@endsection
