{{--@include('public.partials._register-modal')--}}

<div class="head">
    <a href="{{URL::route('home')}}" class="logo"><img src="{{asset('images/logo1.png')}}" alt=""/></a>

    @if(Auth::check())
        @if(Auth::user()->isOwner())
            <a href="#" class="green_btn_header add-restaurant-btn" data-toggle="modal" data-target="#modal_new_restaurant">
                <i class="fa fa-plus"></i>
            </a>
        @endif
    @else
         <a href="#" class="green_btn_header" id="register_btn" >
            <i class="fa fa-user-plus"></i>
        </a>
    @endif

        <div class="search-map" id="search-list">
            <input class="form-control" type="text" data-provide="typeahead" placeholder="Find a Restaurant" />
            <i class="fa fa-spinner fa-spin search-map-spinner"></i>
        </div>
</div>