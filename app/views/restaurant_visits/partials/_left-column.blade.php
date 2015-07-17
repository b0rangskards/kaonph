<!-- Left column-->
<div class="col-md-3 mobile_none">
<!--avatar-->
<div class="user_avatar">
<img src="{{Config::get('constants.DEFAULT_IMG_THUMBNAIL_URL')}}" alt="#">
<span>{{Str::limit(Auth::user()->email, 18)}}</span>
</div>

</div>