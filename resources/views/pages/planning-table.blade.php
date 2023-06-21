@extends('template.page')

@section('page_header')
@include('partials.header.default')
@endsection

@section('page_content')

<div class="row mt-4">
    <div class="col-sm-3">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title"><strong>CLIENTES</strong></h5>
            </div>
            <div style="overflow-y: auto; height: 39rem;" class="card-body">
                <div class="">
                    <nav class="">
                        <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column " data-widget="treeview" role="menu">
                            @foreach ($filterClients as $client)
                            <li class="nav-item">
                                <a class="nav-link cursor-pointer {{ $client['id'] == $filterClientId  ? 'active' : ''}}" wire:click="setClient({{ $client['id'] }})">
                                    <p>
                                        <strong>{{ Str::words($client['name'], 4) }}</strong>
                                        <span style="font-size: 95%;" class="right badge {{ $client['weeklyPostsQuantity'] < 1 ? 'badge-danger' : 'badge-success' }}">
                                            <small>
                                                @if($client['weeklyPostsQuantity'] == 0 || $client['weeklyPostsQuantity'] == null)
                                                0
                                                @else
                                                {{ $client['weeklyPostsQuantity']}}
                                                @endif
                                            </small>
                                        </span>
                                    </p>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        @include('partials.calendar')

    </div>
</div>



{{-- @include('partials.table.float-menu')  --}}
@endsection
