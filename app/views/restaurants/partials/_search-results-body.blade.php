<!--content-->
<div class="col-md-12 basic">

    @include('layouts.partials.sm-header')

    <div class="place_li_cont">
        <div>
            <h1>Search Results <small> you search for "{{$query}}"</small></h1>
        </div>
        {{--<p class="lead">Taste you world with wonderful food experience.</p>--}}

             @if($results->count() == 0)
                     <div class="no-results-panel">
                         <h2>No results found.</h2>
                     </div>
             @else
                @foreach($results as $restaurant)

                <div class="pg style_list">
                    <!--features-->
                    <img src="{{$restaurant->logo ? URL::asset('images/restaurants')."/$restaurant->logo" : Config::get('constants.DEFAULT_RESTAURANT_LOGO_URL')}}" alt="">

                    <div class="con">
                        <div class="col-md-11 restaurant-details">
                            <h3><a href="{{URL::route('restaurants.show', $restaurant->id)}}">{{$restaurant->present()->prettyName}}</a>

                            <small><i class="fa fa-spoon"></i>  {{$restaurant->present()->prettyType}}</small><span></span></h3>

                            <span><i class="fa fa-map-marker"></i><small>  {{$restaurant->present()->prettyAddress}}</small></span>

                            <span><i class="fa fa-phone"><small> {{$restaurant->contact_no}}</small></i></span>
                        </div>
                    </div>
                </div>
                @endforeach
             @endif

    </div>

    <!--morebtn-->
{{--    @if($restaurant->menu()->count() > 3)--}}
        <a href="#" class="more_btn">Load more</a>
    {{--@endif--}}

</div>