<div class="modal fade custom-modal" id="modal_new_restaurant" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">New Restaurant<span></span></h3>

      </div>
      <div class="modal-body">

      {{Form::open(['route' => 'restaurants.store',
                    'class' => 'form-horizontal',
                    'files' => true,
                    'role'  => 'form',
                    'id'    => 'new-restaurant-form',
                    'data-form-files-remote'])}}

          <div class="col-md-6">
              <div class="form-group">
                  {{Form::label('name', 'Name', ['class' => 'control-label col-md-4'])}}
                  <div class="col-md-8">
                      {{Form::text('name', null, ['class' => 'form-control']) }}
                      <p class="help-block"></p>
                  </div>
              </div>

              <div class="form-group">
                  {{Form::label('address', 'Address', ['class' => 'control-label col-md-4'])}}
                  <div class="col-md-8">
                      {{Form::textarea('address', null, ['class' => 'form-control', 'rows' => '2']) }}
                      <p class="help-block"></p>
                  </div>
              </div>

              <div class="form-group">
                  {{Form::label('type', 'What Type of Restaurant: ', ['class' => 'control-label col-md-4'])}}
                  <div class="col-md-8">
                      <select name="type" class="form-control">
                         @foreach(Config::get('enums.restauTypes') as $unformatted => $formattedType)
                            <option value="{{$unformatted}}">{{$formattedType}}</option>
                         @endforeach
                      </select>
                      <p class="help-block"></p>
                  </div>
              </div>

              <div class="form-group">
                  {{Form::label('contact_no', 'Contact No.', ['class' => 'control-label col-md-4'])}}
                  <div class="col-md-8">
                      {{Form::text('contact_no', null, ['class' => 'form-control']) }}
                      <p class="help-block"></p>
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-md-4">
                      {{Form::label('logo', 'Upload your Logo', ['class' => 'control-label'])}}
                      <small><span class="label label-danger">NOTE!</span></small>
                      <small><i>Optional. Only image files are allowed to upload.</i></small>
                  </div>

                  <div class="col-md-7">
                      <div class="fileupload fileinput-new margin-bottom-10" data-provides="fileinput">
                          <div class="col-md-10">
                            <div class="fileinput-new thumbnail" data-trigger="fileinput">
                                  <img src="{{asset('/images/no_img.png')}}" alt="" />
                                  </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail"></div>
                          </div>
                          <div class="col-md-1">
                              <div class="upload-btns">
                                   <span class="btn btn-round btn-default btn-file">
                                       <span class="fileinput-new"><i class="fa fa-paperclip"></i></span>
                                       <span class="fileinput-exists"><i class="fa fa-paperclip"></i></span>
                                       {{Form::file('logo', ['class' => 'default'])}}
                                   </span>
                                   <a href="#" class="btn btn-round btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i></a>
                              </div>
                          </div>
                      </div>
                      <p class="help-block"></p>
                  </div>
              </div>

          </div>

          <div class="form-group col-md-6 mg-rt0 mg-lf0">
              <div class="map-location-picker"></div>
              <div>
                {{Form::hidden('coordinates', null, ['id' => 'coords_field', 'class' => 'form-control'])}}
                <p class="help-block"></p>
              </div>
          </div>

          <div class="form-group mg-btm0">
              {{Form::submit('Save', ['class' => 'green_btn_header'])}}
          </div>
      {{Form::close()}}
      </div>
    </div>
  </div>
</div>