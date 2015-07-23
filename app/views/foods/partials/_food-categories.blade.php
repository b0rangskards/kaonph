<!--Food category-->
    @if($foods->count() > 0)
        <ul id="menu-filter" class="blog_cat">
            <li><a data-filter="*" href="#">All</a></li>
            <li><a data-filter="specialty" href="#">Specialty</a></li>
        @foreach($foods as $food)
             <li><a data-filter=".{{Str::slug(strtolower($food->type->name))}}" href="#">{{$food->type->name}}</a></li>
        @endforeach
        </ul>
    @endif