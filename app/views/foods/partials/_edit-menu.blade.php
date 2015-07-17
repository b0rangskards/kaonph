<!--content-->
<div class="col-md-12 basic">

<!--head-->
@include('layouts.partials.sm-menu-header')

    <div class="place_li_cont">
    <!--headlines-->
    <h1>Update Menu <small> {{$restaurant->present()->prettyName}}</small></h1>
    <p class="lead">Publish and Share your food experience.</p>

     @if($restaurant->menu()->count() == 0)
        <div class="no-results-panel">
            <h2>You have no foods on your menu yet.</h2>
            <p>click {{HTML::link('#', 'here', ['data-toggle' => 'modal', 'data-target' => '#modal_new_menu'])}} to add one. </p>
        </div>
     @else
     <div class="editable-food-menu">
        @foreach(array_chunk($restaurant->getDistinctFoodTypes(), 3) as $typeSet)
            <div class="row">
                @foreach($typeSet as $type)
                    <div class="col-md-4 food-type-group">

                        <h2>{{ucwords($type->name)}}</h2>
                        <ul class="list-group">
                            @foreach($restaurant->menu()->get() as $food)
                                @if($food->type_id == $type->id)
                                    <a href="#" class="list-group-item">{{$food->present()->prettyName}}
                                        <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Cancel Food">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Update Food">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        @if( !$restaurant->hasFoodSpecialty())
                                            {{Form::open(['route' => ['foods.specialty', $restaurant->id], 'class' => 'inline-block'])}}
                                                {{Form::hidden('food_id', $food->id)}}
                                                <button class="btn btn-xs btn-info" type="submit" data-toggle="tooltip" data-placement="top" title="Make This Dish as Our Specialty">
                                                    <i class="fa fa-star-o"></i>
                                                </button>
                                            {{Form::close()}}
                                        @elseif( $food->isASpecialty())
                                             {{Form::open(['route' => ['foods.despecialty', $restaurant->id], 'class' => 'inline-block'])}}
                                                 {{Form::hidden('food_id', $food->id)}}
                                                 <button class="btn btn-xs btn-warning" type="submit" data-toggle="tooltip" data-placement="top" title="Cancel Specialty">
                                                     <i class="fa fa-star-half-o"></i>
                                                 </button>
                                             {{Form::close()}}
                                        @endif
                                        <span class="pull-right price">{{$food->present()->prettyPrice}}</span>
                                    </a>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        @endforeach
     </div>
     @endif
    </div>

</div>

<script>
    $('#flash-overlay-modal').modal();
</script>