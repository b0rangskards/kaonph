@extends('layouts.un-master')


@include('foods.partials._new-menu-modal')

@section('content')

    @include('foods.partials._cancelled-foods-list-modal')

    @include('foods.partials._edit-menu-modal')

    @include('foods.partials._edit-menu-body')


@stop