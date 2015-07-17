<!--navigation swipe-->
<div class="menu-btn"><i class="fa fa-bars"></i></div>

<nav class="pushy pushy-left">
    <div class="profile">
    <div class="avatar"><img src="{{asset('images/default-avatar.png')}}" alt="#"></div>
    <h5 style="text-align: center"><a href="#">{{$currentUser->email}}</a></h5>

     {{-- Logout Button --}}
    {{Form::open(['method' => 'DELETE', 'route' => 'sessions.destroy', 'data-form-remote-no-message-success'])}}
        {{Form::submit('Logout', ['class' => 'log_btn btn-no-border', 'id' => 'logout_btn'])}}
    {{Form::close()}}

    </div>

    <ul class="side_menu">
        <li><a href="{{URL::route('home')}}"><i class="fa fa-bookmark-o"></i>Home</a></li>
        @if(Auth::check() && Auth::user()->isOwner())
            <li><a href="{{URL::route('restaurants.index')}}"><i class="fa fa-list"></i>My Restaurants</a></li>
        @endif
        <li><a href="{{URL::route('restaurant_visits.index')}}"><i class="fa fa-building-o"></i>Restaurants Visited</a></li>
    </ul>
</nav>