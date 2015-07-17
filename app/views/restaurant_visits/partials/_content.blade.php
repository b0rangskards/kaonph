<div class="col-md-9 basic vp">

<!--head-->
@include('layouts.partials.sm-header')

<!--visited places-->
@if($checkedInRestaurants->count() > 0)
    <h1>Visited {{$checkedInRestaurants->count()}} {{Str::plural('Restaurant', $checkedInRestaurants->count())}}</h1>
@endif

<div id="map_visits" class="map_user_visits"></div>
<!--reviews-->
<div class="reviews">
<h4>{{$checkedInRestaurantsHistory->count()}} {{Str::plural('Visit', $checkedInRestaurantsHistory->count())}}:</h4>


@foreach($checkedInRestaurantsHistory as $visit)
<div class="rev">
    <div class="user"><a href="02.html" class="user_avatars">
        <div class="user_go">
            <i class="fa fa-link"></i>
        </div>
        <img src="{{Config::get('constants.DEFAULT_IMG_THUMBNAIL_URL')}}" alt=""></a>
    </div>
    <div class="texts">
        <div class="head_rev">
            <a href="02.html">{{$visit->user()->first()->email}}</a>
            <span>{{Carbon::parse($visit->date_visited)->diffForHumans()}}</span>
                        <span style="margin-left:50px;font-size: 12px;">Checked in@<a href="{{URL::route('restaurants.show', $visit->restaurant_id)}}">{{$visit->restaurant->name}}</a></span>

        </div>
        <div class="text_rev">
            @if($visit->rating == 1)
                <i class="fa fa-thumbs-o-down"></i>
            @elseif($visit->rating == 2)
                <i class="fa fa-thumbs-o-up"></i>
            @else
                <i class="fa fa-heart-o"></i>
            @endif

            {{Config::get('enums.ratings')[$visit->rating]}}
        </div>
    </div>
</div>
@endforeach

</div>

<!--morebtn-->
<a href="#" class="more_btn">Load more</a>
</div>