<!--content-->
<div class="col-md-12 basic">

<!--head-->
@include('layouts.partials.sm-header')

    <div class="place_li_cont">
    <!--headlines-->
    <h1>My Restaurants</h1>
    <p class="lead">Publish and Share your food experience.</p>

        <!--Blog category-->
        {{--@include('restaurants.partials._blg-category')--}}

    @if($restaurants->count() == 0)
        <div class="no-results-panel">
            <h2>You have no restaurants yet.</h2>
            <p>click {{HTML::link('#', 'here', ['data-toggle' => 'modal', 'data-target' => '#modal_new_restaurant'])}} to add one. </p>
        </div>
    @else
        @foreach($restaurants as $restaurant)
            <!--place style list-->
            <div class="pg style_list">
            <!--features-->
            <img src="{{$restaurant->logo ? URL::asset('images/restaurants')."/$restaurant->logo" : URL::asset('images/pl2.jpg')}}" alt="">
            <div class="con">

            <h2><a href="{{URL::route('restaurants.show', $restaurant->id)}}">{{$restaurant->present()->prettyName}}</a>

            <small><i class="fa fa-spoon"></i>  {{$restaurant->present()->prettyType}}</small><span></span></h2>

            <span><i class="fa fa-map-marker"></i><small> {{$restaurant->present()->prettyAddress}}</small></span>

            <span>You can use all Bootstrap plugins purely through the markup API without writing a single line of JavaScript. This is Bootstrap's first-class API and should be your first consideration when using a plugin.</span>
            {{--<a href="02.html" class="comm"><i class="fa fa-comments"></i>234 Comments</a>--}}
            </div>
            </div>
        @endforeach
    @endif
    </div>

</div>