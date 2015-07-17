
<div class="container-fluid header">
    <div class="row">
        <div class="col-md-12"><a href="{{URL::route('index')}}" class="logo"><img src="{{asset('images/logo1.png')}}" alt=""/></a>
            <input type="text" class="search" placeholder="search">
            @if(Auth::check() && Auth::user()->isOwner())
                <a href="#" class="green_btn_header add-restaurant-btn" data-toggle="modal" data-target="#modal_new_restaurant">New Restaurant</a>
            @endif
        </div>
    </div>
</div>