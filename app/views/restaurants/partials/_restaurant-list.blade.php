<!--content-->
<div class="col-md-12 basic">

<!--head-->
@include('layouts.partials.sm-header')

    <div class="place_li_cont">
    <!--headlines-->
    <div>
        <h1>My Restaurants</h1>

        @if($closedRestaurants->count() > 0)
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#closed_restaurants_modal" style="margin-right: 20px;">Closed Restaurants</button>
        @endif
    </div>
        <p class="lead">Publish and Share your food experience.</p>

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
                <img src="{{$restaurant->logo ? URL::asset('images/restaurants')."/$restaurant->logo" : Config::get('constants.DEFAULT_RESTAURANT_LOGO_URL')}}" alt="">

                <div class="con">
                    <div class="col-md-11 restaurant-details">
                        <h3><a href="{{URL::route('restaurants.show', $restaurant->id)}}">{{$restaurant->present()->prettyName}}</a>

                        <small><i class="fa fa-spoon"></i>  {{$restaurant->present()->prettyType}}</small><span></span></h3>

                        <span><i class="fa fa-map-marker"></i><small>  {{$restaurant->present()->prettyAddress}}</small></span>

                        <span><i class="fa fa-phone"><small> {{$restaurant->contact_no}}</small></i></span>
                    </div>
                    <div class="pull-right restaurant-tools">
                        <span>
                             {{Form::open(['route' => ['restaurants.destroy', $restaurant->id], 'method' =>  'DELETE', 'class' => 'inline-block', 'data-form-remote'])}}
                                 <button class="btn btn-xs btn-danger" data-confirm="Are you sure to close restaurant?" data-confirm-yes="Yes! Close Restaurant" data-toggle="tooltip" data-placement="top" title="Close Restaurant">
                                     <i class="fa fa-times"></i>
                                 </button>
                             {{Form::close()}}
                             <button class="btn btn-xs btn-success update-restaurant-btn" data-id="{{$restaurant->id}}">
                                 <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Update Restaurant Information"></i>
                             </button>
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    </div>

</div>