<div class="modal fade custom-modal" id="modal_new_menu" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">New Menu<span></span></h3>

      </div>
      <div class="modal-body">

      {{Form::open(['route' => 'foods.store',
                    'class' => 'form-horizontal',
                    'files' => true,
                    'role'  => 'form',
                    'data-form-files-remote'])}}

         {{Form::hidden('restaurant', Request::segment(2))}}

          <div class="col-md-6">
              <div class="form-group">
                  {{Form::label('name', 'Name of Food', ['class' => 'control-label col-md-4'])}}
                  <div class="col-md-8">
                      {{Form::text('name', null, ['class' => 'form-control']) }}
                      <p class="help-block"></p>
                  </div>
              </div>

              <div class="form-group">
                  {{Form::label('type', 'What Type of Food: ', ['class' => 'control-label col-md-4'])}}
                  <div class="col-md-8">
                      <select name="type" class="form-control">
                         @foreach(FoodType::lists('name','id') as $id => $type)
                            <option value="{{$id}}">{{$type}}</option>
                         @endforeach
                      </select>
                      <p class="help-block"></p>
                  </div>
              </div>

              <div class="form-group">
                  {{Form::label('price', 'How much?', ['class' => 'control-label col-md-4'])}}
                  <div class="col-md-8">

                      <div class="input-group">
                        <div class="input-group-addon">PHP</div>
                        <input type="text" name="price" class="form-control" placeholder="Amount in Peso">
                      </div>

                      <p class="help-block"></p>
                  </div>
              </div>

              <div class="form-group">
                  {{Form::label('details', 'Other Details/Ingredients', ['class' => 'control-label col-md-4'])}}
                  <div class="col-md-8">
                      {{Form::textarea('details', null, ['class' => 'form-control', 'rows' => '5']) }}
                      <p class="help-block"></p>
                  </div>
              </div>

          </div>

          <div class="col-md-6">
                <div class="form-group">
                    {{Form::label('logo', 'Make This As Specialty', ['class' => 'control-label'])}}
                      <input type="checkbox" name="is_specialty" />
                      <p class="help-block"></p>
                </div>

                <div class="form-group">
                    {{Form::label('logo', 'Upload Photo', ['class' => 'control-label'])}}
                    <div class="fileupload fileinput-new margin-bottom-10" data-provides="fileinput">
                        {{--<div class="col-md-12">--}}
                          <div class="fileinput-new thumbnail" data-trigger="fileinput">
                                <img src="{{asset('/images/no_img.png')}}" alt="" style="height: 160px;"/>
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 160px;"></div>
                        {{--</div>--}}
                        <div class="upload-btns">
                             <span class="btn btn-round btn-default btn-file">
                                 <span class="fileinput-new"><i class="fa fa-paperclip"></i></span>
                                 <span class="fileinput-exists"><i class="fa fa-paperclip"></i></span>
                                 {{Form::file('picture', ['class' => 'default'])}}
                             </span>
                             <a href="#" class="btn btn-round btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i></a>
                             <small><span class="label label-danger">NOTE!</span></small>
                             <small><i>Optional. Only image files are allowed to upload.</i></small>
                        </div>
                    </div>
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