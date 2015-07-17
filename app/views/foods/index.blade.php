@extends('layouts.un-master')

@section('content')

    @include('layouts.partials.sm-menu-header')

    @include('foods.partials._new-menu-modal')

    @include('foods.partials._foods-list')

@stop