@extends('template.page')

@section('page_header')
@include('partials.header.default')
@endsection

@section('page_content')
@include('partials.cards.demand-filters')

@include('partials.cards.demand-list')

@include('partials.modals.demand-form')

@include('partials.modals.demand-files')

@include('partials.demand-float-menu')
<style>
    .cel-hover th:hover,
    td:hover {
        background: lightgray;
    }

</style>
@endsection
