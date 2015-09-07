<div class="modal fade custom-modal" id="similar_restaurants_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Similar Places<span></span></h3>
      </div>
      <div class="modal-body">

      {{--<div class="col-md-6 sidebar">--}}
        <div class="similar">
            @foreach($similar as $restau)
                <div>
                    <img src="{{$restau->logo ? asset('images/restaurants').'/'.$restau->logo : asset('images/avatar/ava_11.jpg')}}" width="30" alt="#">
                    <a href="{{URL::route('restaurants.show', $restau->id)}}">{{$restau->present()->prettyName}}</a>
                    @if(!$restau->getLovedCustomers()->isEmpty())
                        {{$restau->getLovedCustomers()->count()}} users <i class="fa fa-heart-o"></i> this
                    @endif
                </div>
            @endforeach
        </div>
      {{--</div>--}}

      </div>
    </div>
  </div>
</div>