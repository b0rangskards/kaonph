<div class="lg_modal_container none" id="modal_register_owner">
    <div class="lg_modal_form">
        <i class="fa fa-times close_window close_modal"></i>
        <h3>Register <br/><h4 style="text-align: center">Promote Your Restaurant</h4><span></span></h3>

        <div class="col-md-12">
            {{Form::open(['route' => 'registration.owner', 'data-form-remote'])}}

                <div class="form-group">
                    <label>Name :
                        <div>
                             <input name="firstname" type="text" class="col-md-6" placeholder="Firstname"/>
                             <input name="lastname" type="text" class="col-md-6" placeholder="Lastname"/>
                        </div>
                    </label>
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        <label>Birthdate</label>
                        <input name="birthdate" type="text" class=" birthdate" required/>
                    </div>

                    <div class="col-md-6">
                     <label class="lbl-gender">Gender</label>
                        <div class="btn-group" role="group">
                            <select name="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Occupation :<input type="text" name="occupation" placeholder="Optional"></label>
                    <p class="help-block"></p>
                </div>

                <fieldset>
                   <legend></legend>

                    <div class="form-group">
                        <label>Email :<input type="email" name="email" required></label>
                        <p class="help-block"></p>
                    </div>

                    <div class="form-group">
                        <label>Password :<input type="password" name="password" required></label>
                        <p class="help-block"></p>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password :<input type="password" name="password_confirmation" required></label>
                    </div>

                </fieldset>

                {{Form::submit('REGISTER', ['class' => 'green_btn_header'])}}

            {{Form::close()}}
        </div>
    </div>
</div>