<div class="modal fade custom-modal" id="visitors_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Visitors<span></span></h3>
      </div>
      <div class="modal-body">

          <div class="list-group">
                @foreach($visitors as $visitor)
                    <a href="#" class="list-group-item">
                        {{$visitor->user()->first()->email}}
                        <span style="color:darkgray;font-size: small">{{Carbon::parse($visitor->date_visited)->diffForHumans()}}</span>

                        <p class="list-group-item-text">...</p>
                    </a>
                @endforeach
          </div>

      </div>
    </div>
  </div>
</div>