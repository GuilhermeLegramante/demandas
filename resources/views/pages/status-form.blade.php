@extends('template.page')

@section('page_header')
@include('partials.header.default')
@endsection

@section('page_content')
@include('partials.cards.status')

@include('partials.footer.crud')
@endsection
