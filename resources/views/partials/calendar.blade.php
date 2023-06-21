<div class="card card-primary card-outline">
    <div class="card-body p-3">
        <div class="d-flex flex-sm-row flex-column justify-content-between mb-2">
            <div class="">
                <div class="btn-group">
                    <button wire:click="setDate('desc')" type="button" title="Anterior" class="btn btn-primary">
                        <span class="fa fa-chevron-left"></span>
                    </button>
                    <button wire:click="setDate('asc')" type="button" title="Próximo" class="btn btn-primary">
                        <span class="fa fa-chevron-right"></span>
                    </button>
                </div>
            </div>
            <div class="row">
                {{-- @include('partials.inputs.date', [
                'columnSize' => 12,
                'label' => '',
                'model' => 'date',
                ])  --}}
                <div class="form-group mt-2">
                    <input style="font-weight:bold;" type="month" wire:model="date" class="form-control input-custom">
                </div>
                {{-- <h2 class=""><strong>{{ $planning->description }} {{ $planning->year }}</strong></h2> --}}
            </div>
            <div class="">
                <div class="btn-group">
                    <button wire:click="setToday()" type="button" title="Hoje" class="btn btn-primary active">Hoje
                    </button>
                    {{-- <button type="button" title="week view" aria-pressed="false" class="btn btn-primary">semana
                    </button>
                    <button type="button" title="day view" aria-pressed="false" class="btn btn-primary">dia
                    </button>  --}}
                </div>
            </div>
        </div>
        <div class="" style="">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Segunda</th>
                        <th>Terça</th>
                        <th>Quarta</th>
                        <th>Quinta</th>
                        <th>Sexta</th>
                        <th>Sábado</th>
                        <th>Domingo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($planning->weeks as $week)
                    <tr>
                        @foreach ($week as $day)
                        <td class="calendar-day {{ $day->date == now()->format('Y-m-d') ? 'bg-primary' : '' }}">
                            <div class="text-center">
                                <p>
                                    @if($day->isInMonth)
                                    <strong>{{ $day->number }}</strong>
                                    @else
                                    {{ $day->number }}
                                    @endif
                                </p>
                            </div>
                            <div>
                                @if(count($day->demands) > 0)
                                @foreach ($day->demands as $demand)
                                <div class="d-flex">
                                    <span style="background-color: {{ $demand->demandStatusColor }}!important;" class="right badge badge-danger mt-1 w-100">
                                        <p class="p-1">{{ $demand->demandStatusDescription }}
                                            @if($demand->totalFiles > 0)
                                            <i class="fas fa-paperclip ml-1" aria-hidden="true"></i>
                                            @endif
                                        </p>
                                    </span>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
