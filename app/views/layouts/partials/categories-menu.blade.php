<!--categories menu-->
<div class="container-fluid menu mobile categories-container">
    <div class="row">
        <div class="col-md-12">
            <span>Categori menu</span>
            <i class="fa fa-times" id="close_menu"></i>
                <ul class="categories-list">
                    @foreach(Config::get('enums.restauTypes') as $value => $type)
                        <li data-toggle="tooltip" data-placement="right" data-value="{{$value}}" title="{{$type['name']}}">
                        <a href="javascript:;" class="{{Str::slug($value)}}">
                            <img
                            src="{{Config::get('constants.RESTAURANT_ICON_URL') . $type['icon'] . '.png'}}"
                            alt=""/>
                        </a>
                        </li>
                    @endforeach
                </ul>
        </div>
    </div>
</div>