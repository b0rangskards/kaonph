<!--content-->
<div class="col-md-9 basic">

<!--head-->
@include('layouts.partials.sm-menu-header')

<!--Header section-->
<div class="header_section">

    <img src="{{$restaurant->logo ? asset('images/restaurants').'/'.$restaurant->logo : asset('images/c_logo.jpg')}}" alt="">

    <h1>{{$restaurant->present()->prettyName}}</h1>
    <ul>
        <li><a href="#">{{$restaurant->present()->prettyType}}</a></li>
    </ul>


    @if(!$restaurant->isOwner())
        <div class="pull-right dropup check-in-button-group">
          <button class="btn-green-border dropdown-toggle" type="button" id="checkin-btn" data-toggle="dropdown">
           <div class="ui active small inline loader checkin-loader" style="display:none"></div> Check In
          </button>
          <ul class="dropdown-menu" data-restaurant-id="{{$restaurant->id}}">
            <li data-value="3"><a href="#"><i class="fa fa-heart-o"></i> Loved it!</a></li>
            <li data-value="2"><a href="#"><i class="fa fa-thumbs-o-up"></i> Just Fine.</a></li>
            <li data-value="1"><a href="#"><i class="fa fa-thumbs-o-down"></i> Nahh!</a></li>
          </ul>
        </div>
    @endif

</div>

<!--Phone info-->
<div class="phone_email">
    <span>
        <i class="fa fa-phone"></i>{{$restaurant->contact_no}}
    </span>
</div>
<!--icon description block-->
<div class="icon_descr_block">
    <div class="cols">
        <div class="icons id_orange">
            <span class="ic"><i class="fa fa-comments-o"></i></span>
            <span class="num">1034</span>
        </div>
        <div class="icons id_green" data-toggle="tooltip" data-placement="top" title="{{$visitorsList}}">
            <a href="#" data-toggle="modal" data-target="#visitors_modal">
                <span class="ic"><i class="fa fa-users"></i></span>
                <span class="num">{{$visitors->count()}}</span>
            </a>
        </div>
        <div class="icons id_blue">
            <span class="ic"><i class="fa fa-globe"></i></span>
            <span class="num">1034</span>
        </div>
    </div>

    <div class="cols">
        @if( !$restaurant->isOwner())
            <a href="{{URL::route('foods.index', $restaurant->id)}}" class="btn-green-border pull-right" >Show Food Menu</a>
        @else
            <a href="{{URL::route('foods.editmenu', $restaurant->id)}}" class="btn-green-border pull-right" >Edit Food Menu</a>
        @endif
    </div>

</div>

<!--Features info instead show foods here -->
<div class="features_block">
<div>
<ul>
<li>Hours: <b>Closed until 8:00am</b></li>
<li>Reservations: <b>No</b></li>
<li>Menus: <b>Brunch</b></li>
</ul>
</div>
<div>
<ul>
<li>Credit Cards: <b>Yes (incl. Visa & MasterCard)</b></li>
<li>Wi-Fi: <b>Yes</b></li>
<li>Outdoor Seating: <b>No</b></li>
</ul>
</div>
</div>

<!--Share this place btn and total visitors-->
<div class="share_block">
<div>
{{--<a href="#" class="green_button">Share this place</a>--}}
</div>
<div>
<div>
<span>Total Visitors</span>
419 total
</div>
<div>
<span>Total Visitors</span>
419 total
</div>
</div>
</div>

{{--<!--Check in-->--}}
{{--<div class="check_in">--}}
{{--<div>--}}
{{--<a href="03.html">Vlad Mickh</a> likes this place. Your Swarm friend <a href="03.html">Mattew</a> has checked in here.--}}
{{--<div class="users_group">--}}
{{--<!--user-->--}}
{{--<a href="03.html" class="user_avatars">--}}
{{--<div class="user_go">--}}
{{--<i class="fa fa-link"></i>--}}
{{--</div>--}}
{{--<img src="{{asset('images/avatar/ava_3.jpg')}}" alt=""></a>--}}
{{--<!--user-->--}}
{{--<a href="03.html" class="user_avatars">--}}
{{--<div class="user_go">--}}
{{--<i class="fa fa-link"></i>--}}
{{--</div>--}}
{{--<img src="{{asset('images/avatar/ava_4.jpg')}}" alt=""></a>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--<!--Mobile visibli-->--}}
{{--<div class="mobile_place">--}}
{{--<div class="address">--}}
{{--Mordovceva street, 6 (Up on"Semenovskaya"), 690091, Vladivostok</div>--}}
{{--<div class="similar">--}}
{{--<h3>Similar Restaurants:</h3>--}}
{{--<div>--}}
{{--<img src="{{asset('images/avatar/ava_11.jpg')}}" alt="#">--}}
{{--<a href="#">Cafe "Oki-Doki"</a>--}}
{{--<i class="icon-heart"></i>34 likes--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

    <div class="flickr_photo">
        <h4>Customer Activities</h4>
        <ul id="basicuse" class="thumbs"></ul>
    </div>

    <div class="reviews">
        <!--reviews-->
        <h4>145 Reviews:</h4>
            <!--review-->
            <div class="rev">
                <div class="user">
                        <!--user avatar-->
                        <a href="03.html" class="user_avatars">
                    <div class="user_go">
                        <i class="fa fa-link"></i>
                    </div>
                    <img src="{{asset('images/avatar/ava_4.jpg')}}" alt=""></a>
                </div>
                <div class="texts">
                    <div class="head_rev"><a href="03.html">Mattew An</a> <span>12.09.2008</span></div>
                    <div class="text_rev">Get a history lesson</div>
                </div>
            </div>
    <!--review end-->
<!--add comment-->
        <div class="add_comment">
            <h4>Add comment</h4>
            <textarea></textarea>
            <a href="#" class="btn btn-success">Add comment</a>
        </div>
    </div>
</div>