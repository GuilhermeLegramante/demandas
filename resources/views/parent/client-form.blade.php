@extends('adminlte::page')

@section('content')
<div>
    @livewire('client-form', ['id' => $id])
</div>
@endsection
