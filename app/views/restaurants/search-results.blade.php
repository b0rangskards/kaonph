@extends('layouts.un-master')

    @if(!Auth::check())
        @include('public.partials._register-modal')
    @endif

@section('content')

    @include('restaurants.partials._search-results-body')

@stop