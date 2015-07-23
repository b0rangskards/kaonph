<div class="modal fade custom-modal" id="closed_restaurants_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Your Closed Restaurants<span></span></h3>

      </div>
      <div class="modal-body">


        <ul class="list-group">
            @foreach($closedRestaurants as $restaurant)
                <li class="list-group-item" style="height: 50px;">
                    <a href="">
                        <span>{{$restaurant->present()->prettyName}}
                            <small style="color: grey"><i class="fa fa-spoon"></i> {{$restaurant->present()->prettyType}}</small>
                        </span>
                    </a>
                    {{Form::open(['route' => ['restaurants.reopen', $restaurant->id], 'method' => 'PUT', 'class' => 'inline-block pull-right', 'data-form-remote'])}}
                         <button class="btn btn-success" type="submit" data-toggle="tooltip" data-placement="top" title="Re-Open Restaurant">
                         <i class="fa fa-history"></i> Re-open</button>
                    {{Form::close()}}
                    <br/>
                    <span style="color:#808080"><i class="fa fa-map-marker"></i><small> {{$restaurant->present()->prettyAddress}}</small></span>
                </li>
            @endforeach
        </ul>



      </div>
    </div>
  </div>
</div>