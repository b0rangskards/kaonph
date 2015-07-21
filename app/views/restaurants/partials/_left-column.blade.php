<!-- Left column-->
<div class="col-md-3 mobile_none sidebar">
	<!--map place point-->
	<div id="map_place" class="map_place"></div>
	<div class="address">
		{{$restaurant->address}}
	</div>

@if($similar->count() > 0)
	<!--Similar Place-->
	<div class="similar">
		<h3>Similar places:</h3>

        @foreach($similar as $restau)
            <div>
                <img src="{{$restau->logo ? asset('images/restaurants').'/'.$restau->logo : asset('images/avatar/ava_11.jpg')}}" alt="#">
                <a href="#">{{$restau->present()->prettyName}}</a>
                @if(!$restau->getLovedCustomers()->isEmpty())
                    {{$restau->getLovedCustomers()->count()}} users <i class="fa fa-heart-o"></i> this
                @endif
            </div>
		@endforeach
	</div>
@endif

</div>