<!--content-->
<div class="col-md-12 basic">

    <div class="place_gr_cont">
        <h1>Menu <small> {{$restaurant->present()->prettyName}}</small></h1>
        <p class="lead">Taste you world with wonderful food experience.</p>

             @include('foods.partials._food-categories')

             @if($restaurant->menu()->count() == 0)
                     <div class="no-results-panel">
                         <h2>No foods on the menu yet.</h2>
                     </div>
             @else
                @foreach($restaurant->menu()->get() as $food)
                    <!--place style one-->
                    <div class="pg style_one" onclick="location.href='03.html';">
                        <div class="p_cont">
                        <h2>{{$food->present()->prettyName}} <br/><small>{{$food->present()->prettyPrice}}</small> <span></span></h2>

                        <span>{{$food->present()->prettyDetails}}</span>
                        </div>
                        <img src="{{AssetHelper::getFoodPhotoPath($restaurant->name, $food->picture)}}" alt="">
                        <div class="dar_bg_frid"></div>
                    </div>
                @endforeach
             @endif

    </div>

    <!--morebtn-->
    @if($restaurant->menu()->count() > 3)
        <a href="#" class="more_btn">Load more</a>
    @endif

</div>