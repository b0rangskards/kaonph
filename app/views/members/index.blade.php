@extends('layouts.master')

@section('content')

    @include('restaurants.partials._new-restaurant-modal')

    @include('layouts.partials.categories-menu')

    @include('layouts.partials.map')

    {{-- Side Menu Select Categories --}}
    <div id="filter-box">
        <ul>
            <li class="un-li">
                <button type="button" id="btn-loved" class="btn cat"><i class="fa fa-heart-o flat-red"></i><br/> Loved it!</button>
            </li>
            <li class="un-li">
                <button type="button" id="btn-liked" class="btn cat"><i class="fa fa-thumbs-up flat-blue"></i><br/> Just Fine.</button>
            </li>
            <li class="un-li">
                <button type="button" id="btn-disliked" class="btn cat"><i class="fa fa-thumbs-down flat-yellow"></i><br/>  Nahh!</button>
            </li>
            <li id="me-li"><button id="show-cat" type="button" class="btn show" data-toggle="tooltip" data-placement="right" title="Show Your Preferred Restaurants">Me</button></li>
            <li id="loved-li"><button id="btn-loved-all" type="button" class="btn" data-toggle="tooltip" data-placement="right" title="Show Mostly Loved Restaurants">Loved</button></li>
        </ul>
    </div>

@stop