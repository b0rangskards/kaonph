@extends('layouts.un-master')

    @include('public.partials._register-modal')

@section('content')


    @include('foods.partials._new-menu-modal')

    @include('foods.partials._foods-list')

@stop