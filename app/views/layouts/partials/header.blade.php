
<div class="container-fluid header">
    <div class="row">
        <div class="col-md-12"><a href="{{URL::route('index')}}" class="logo"><img src="{{asset('images/logo1.png')}}" alt=""/></a>
            
            {{--<div id="location-box" class="col-md-4">--}}
                {{--<button class="btn"><i class="fa fa-location-arrow"></i></button>--}}
                {{--<select name="" id="select2-location">--}}
                    {{--<option value="AL">Alabama</option>--}}
                {{--</select>--}}
            {{--</div>--}}

            <div class="search-map" id="search-restaurant-map">
                 {{--<button class="btn"><i class="fa fa-location-arrow"></i></button>--}}
                <input class="form-control" type="text" data-provide="typeahead" placeholder="Find a Restaurant" />
                <i class="fa fa-spinner fa-spin search-map-spinner"></i>
            </div>

            @if(Auth::check() && Auth::user()->isOwner())
                <a href="#" class="green_btn_header add-restaurant-btn" data-toggle="modal" data-target="#modal_new_restaurant">New Restaurant</a>
            @endif
        </div>
    </div>
</div>

