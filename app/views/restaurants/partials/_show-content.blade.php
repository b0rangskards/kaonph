<!--content-->
<div class="col-md-9 basic">

<!--head-->
@include('layouts.partials.sm-menu-header')

<!--Header section-->
<div class="header_section" style="background-image: url('{{Config::get('constants.DEFAULT_RESTAURANT_LOGO_URL')}}');-webkit-background-size: cover;">

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
        <div class="icons id_red" data-toggle="tooltip" data-html="true" data-placement="top" title="{{$lovedCustomersList}}">
            <span class="ic"><i class="fa fa-heart-o flat-red"></i></span>
            <span class="num">{{$ratings['loved_perc'] or '0'}}%</span>
        </div>
        <div class="icons id_blue" data-toggle="tooltip" data-html="true" data-placement="top" title="{{$justFineCustomersList}}">
            <span class="ic"><i class="fa fa-thumbs-up flat-blue"></i></span>
            <span class="num">{{$ratings['liked_perc']  or '0'}}%</span>
        </div>
        <div class="icons id_yellow" data-toggle="tooltip" data-html="true" data-placement="top" title="{{$dislikeCustomersList}}">
            <span class="ic"><i class="fa fa-thumbs-down flat-yellow"></i></span>
            <span class="num">{{$ratings['disliked_perc']  or '0'}}%</span>
        </div>
        {{--<div class="icons id_green" data-toggle="tooltip" data-placement="top" title="{{$visitorsList}}">--}}
            {{--<a href="#" data-toggle="modal" data-target="#visitors_modal">--}}
                {{--<span class="ic"><i class="fa fa-users"></i></span>--}}
                {{--<span class="num">{{$visitors->count()}}</span>--}}
            {{--</a>--}}
        {{--</div>--}}
    </div>

    <div class="cols">
        @if( !$restaurant->isOwner())
            <a href="{{URL::route('foods.index', $restaurant->id)}}" class="btn-green-border pull-right">Show Food Menu</a>
        @else
            <a href="{{URL::route('restaurants.visitorshistory', $restaurant->id)}}" class="btn-green-solid pull-right">Visitors History</a>
            <a href="{{URL::route('foods.editmenu', $restaurant->id)}}" class="btn-green-border pull-right" >Edit Food Menu</a>
        @endif
    </div>

</div>

<!--Features info instead show foods here -->
{{--<div class="features_block">--}}
{{--<div>--}}
{{--<ul>--}}
{{--<li>Hours: <b>Closed until 8:00am</b></li>--}}
{{--<li>Reservations: <b>No</b></li>--}}
{{--<li>Menus: <b>Brunch</b></li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--<div>--}}
{{--<ul>--}}
{{--<li>Credit Cards: <b>Yes (incl. Visa & MasterCard)</b></li>--}}
{{--<li>Wi-Fi: <b>Yes</b></li>--}}
{{--<li>Outdoor Seating: <b>No</b></li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--</div>--}}

<!--Share this place btn and total visitors-->
<div class="share_block">
<div>
{{--<a href="#" class="green_button">Share this place</a>--}}
</div>
<div style="padding: 10px 20px;">
        <span>Visitors</span> <br/>
        @forelse($visitors as $index => $visitor)
            @if($index == 1)
                and <a href="#" data-toggle="modal" data-target="#visitors_modal" style="margin: 0px;">{{$visitors->count()-1}} {{Str::plural('other',$visitors->count()-1)}}</a>
                @break
            @endif
            <span><a href="" class="inline-block" style="margin: 0px;" data-toggle="modal" data-target="#visitors_modal">{{ $visitor->user->present()->fullName }}</a></span>
        @empty
            <span><a href="">Currently no visitors</a></span>
        @endforelse
        {{--<span data-toggle="tooltip" data-placement="top" title="{{$visitorsList}}"><a href="#" data-toggle="modal" data-target="#visitors_modal">{{$visitors->count()}} total</a></span>--}}
</div>
</div>

    {{--<div class="flickr_photo">--}}
        {{--<h4>Customer Activities</h4>--}}
        {{--<ul id="basicuse" class="thumbs"></ul>--}}
    {{--</div>--}}

    {{--<div class="reviews">--}}
        {{--<!--reviews-->--}}
        {{--<h4>145 Reviews:</h4>--}}
            {{--<!--review-->--}}
            {{--<div class="rev">--}}
                {{--<div class="user">--}}
                        {{--<!--user avatar-->--}}
                        {{--<a href="03.html" class="user_avatars">--}}
                    {{--<div class="user_go">--}}
                        {{--<i class="fa fa-link"></i>--}}
                    {{--</div>--}}
                    {{--<img src="{{asset('images/avatar/ava_4.jpg')}}" alt=""></a>--}}
                {{--</div>--}}
                {{--<div class="texts">--}}
                    {{--<div class="head_rev"><a href="03.html">Mattew An</a> <span>12.09.2008</span></div>--}}
                    {{--<div class="text_rev">Get a history lesson</div>--}}
                {{--</div>--}}
            {{--</div>--}}
    {{--<!--review end-->--}}
{{--<!--add comment-->--}}
        {{--<div class="add_comment">--}}
            {{--<h4>Add comment</h4>--}}
            {{--<textarea></textarea>--}}
            {{--<a href="#" class="btn btn-success">Add comment</a>--}}
        {{--</div>--}}
    {{--</div>--}}
</div>