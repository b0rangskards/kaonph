@extends('layouts.un-master')

@section('content')

    <!-- Left column-->
    @include('restaurants.partials._left-column')

    @include('restaurants.partials._visitors-modal')
    @include('foods.partials._new-menu-modal')

    @include('restaurants.partials._show-content')

@stop