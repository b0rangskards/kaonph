<!-- Left column-->
<div class="col-md-3 mobile_none sidebar">
	<!--map place point-->
	<div id="map_place" class="map_place"></div>
	<div class="address">
		{{$restaurant->present()->prettyAddress}}
	</div>

@if($similar->count() > 0)
    @include('restaurants.partials._similar-restaurants')

	<!--Similar Place-->
	<div class="similar">
		<h3>Similar places:</h3>

        @foreach($similar->chunk(3) as $index => $chunksRestau)
           @if($index == 0)
                @foreach($chunksRestau as $restau)
                <div>
                    <img src="{{$restau->logo ? asset('images/restaurants').'/'.$restau->logo : asset('images/avatar/ava_11.jpg')}}" alt="#">
                    <a href="{{URL::route('restaurants.show', $restau->id)}}">{{$restau->present()->prettyName}}</a>
                    @if(!$restau->getLovedCustomers()->isEmpty())
                        <span class="inline-block">{{$restau->getLovedCustomers()->count()}} {{Str::plural('users', $restau->getLovedCustomers()->count())}} <i class="fa fa-heart-o"></i>this</span>
                    @endif
                </div>
                @endforeach
           @endif
            @if($index == 1)
                <a href="" style="padding-left: 30%;" data-toggle="modal" data-target="#similar_restaurants_modal">Show all</a>
            @endif
		@endforeach
	</div>
@endif

</div>