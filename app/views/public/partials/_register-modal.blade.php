<div class="modal_container none" id="modal_register">
    <div class="modal_form">
        <i class="fa fa-times close_window close_modal"></i>
        <h3>Register<span></span></h3>
            {{Form::open(['route' => 'registration.public', 'data-form-remote'])}}

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

                {{Form::submit('Register', ['class' => 'green_btn_header'])}}
            {{Form::close()}}
    </div>
</div>