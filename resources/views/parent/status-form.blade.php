@extends('adminlte::page')

@section('content')
<div>
    @livewire('status-form', ['id' => $id])
</div>
@endsection
