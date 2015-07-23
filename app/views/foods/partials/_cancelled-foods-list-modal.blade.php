<div class="modal fade custom-modal" id="modal_cancelled_foods_list" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Cancelled Foods<span></span></h3>

      </div>
      <div class="modal-body">


        <ul class="list-group">
            @foreach($cancelledFoods as $food)
                <li class="list-group-item">
                    <a href="">
                        <span>{{$food->present()->prettyName}}
                           <small style="color: grey">{{$food->type->name}}</small>

                           {{Form::open(['route' => ['foods.restore', $food->restaurant_id], 'method' => 'PUT', 'class' => 'inline-block', 'data-form-remote'])}}
                               {{Form::hidden('food_id', $food->id)}}
                                <button class="btn btn-success" type="submit" data-toggle="tooltip" data-placement="top" title="Offer Food">
                                <i class="fa fa-history"></i> Offer Food</button>
                           {{Form::close()}}
                        </span>
                        <span class="pull-right price">{{$food->present()->prettyPrice}}</span>
                    </a>
                    <br/>
                    {{--<span style="font-size: 11px; font-color:grey; padding-top: 0px;">{{$food->type->name}}</span>--}}
                </li>
            @endforeach
        </ul>



      </div>
    </div>
  </div>
</div>