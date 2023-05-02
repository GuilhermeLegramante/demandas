@extends('adminlte::page')

@section('content')
<div>
    @livewire('demand-type-form', ['id' => $id])
</div>
@endsection
