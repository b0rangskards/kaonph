@extends('layouts.un-master')

    @include('public.partials._register-modal')

@section('content')

    <!-- Left column-->
    @include('restaurants.partials._left-column')

    @include('restaurants.partials._visitors-modal')

    @include('foods.partials._new-menu-modal')

    @include('restaurants.partials._show-content')

@stop