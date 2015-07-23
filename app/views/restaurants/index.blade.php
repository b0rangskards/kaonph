@extends('layouts.un-master')

@section('content')

    @include('restaurants.partials._closed-restaurants-modal')

    @include('restaurants.partials._update-restaurant-modal')

    @include('restaurants.partials._restaurant-list')

@stop