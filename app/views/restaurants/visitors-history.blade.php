@extends('layouts.un-master')

    @if(!Auth::check())
        @include('public.partials._register-modal')
    @endif

@section('content')

<!--content-->
<div class="col-md-12 basic">

    @include('layouts.partials.sm-header')

    <div class="place_li_cont">
        <div>
            <h1>{{$restaurant->present()->prettyName}} <small> Visitors</small></h1>
        </div>
        {{--<p class="lead">Taste you world with wonderful food experience.</p>--}}

                @if($visitors->count() > 0)
                    <table class="table">
                        <thead>
                            <th>Visitor</th>
                            <th>No of Times Visited</th>
                            <th>Last Visit</th>
                        </thead>
                        <tbody>
                        @foreach($visitors as $visitor)
                            <tr>
                                <td>{{$visitor->user->present()->fullName}}
                                {{Carbon::parse($visitor->user->birthdate)->age}} {{$visitor->user->gender}} {{$visitor->user->occupation}}</td>
                                <td>{{$visitor->timesVisited()}}</td>
                                <td>{{Carbon::parse($visitor->date_visited)->diffForHumans()}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="no-results-panel">
                        <h2>No results found.</h2>
                    </div>
                @endif

    </div>

    <!--morebtn-->
    {{--@if($results->count() > 3)--}}
        {{--<a href="#" class="more_btn">Load more</a>--}}
    {{--@endif--}}

</div>

@stop