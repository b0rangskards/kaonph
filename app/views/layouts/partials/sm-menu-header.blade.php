@include('public.partials._register-modal')


<div class="head">
    <a href="{{URL::route('home')}}" class="logo"><img src="{{asset('images/logo1.png')}}" alt=""/></a>

    @if(Auth::check())
        @if(Auth::user()->isOwner())
            <a href="#" class="green_btn_header add-menu-btn" data-toggle="modal" data-target="#modal_new_menu">
            <i class="fa fa-plus"></i>
            </a>
        @endif
    @else
        <a href="#" class="green_btn_header" id="register_btn" >
            <i class="fa fa-user-plus"></i>
        </a>
    @endif

    <input type="text" class="search" placeholder="search">
</div>