@extends('adminlte::page')

@section('content')
<div>
    @livewire('plan-form', ['id' => $id])
</div>
@endsection
