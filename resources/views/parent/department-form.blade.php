@extends('adminlte::page')

@section('content')
<div>
    @livewire('department-form', ['id' => $id])
</div>
@endsection
