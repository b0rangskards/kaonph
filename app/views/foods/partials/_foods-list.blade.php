<!--content-->
<div class="col-md-12 basic">

    @include('layouts.partials.sm-header')

    <div class="place_gr_cont">
        <h1>Menu <small> {{$restaurant->present()->prettyName}}</small></h1>
        <p class="lead">Taste you world with wonderful food experience.</p>

             @include('foods.partials._food-categories')

             @if($restaurant->menu()->count() == 0)
                     <div class="no-results-panel">
                         <h2>No foods on the menu yet.</h2>
                     </div>
             @else
                <div id="menu-container">
                @foreach($restaurant->menu()->get() as $food)
                    <div class="pg style_one menu-item {{Str::slug(strtolower($food->type->name))}}" onclick="javascript:;">
                        <div class="p_cont">
                        <span class="type">{{$food->type->name}} <i class="fa fa-spoon"></i></span>

                        <h2>{{$food->present()->prettyName}}
                        @if($food->isASpecialty())
                            <small><i class="fa fa-star" style="color:#f1c40f"></i> </small>
                        @endif
                        <br/>
                            <small>{{$food->present()->prettyPrice}}</small>
                            <span></span>
                        </h2>
                        <span>{{$food->present()->prettyDetails}}</span>
                        </div>
                        <img src="{{AssetHelper::getFoodPhotoPath($restaurant->name, $food->picture)}}" alt="">
                        <div class="dar_bg_frid"></div>
                    </div>
                @endforeach
                </div>
             @endif

    </div>

    <!--morebtn-->
    @if($restaurant->menu()->count() > 3)
        <a href="#" class="more_btn">Load more</a>
    @endif

</div>