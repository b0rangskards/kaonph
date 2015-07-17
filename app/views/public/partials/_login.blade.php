<div class="modal_container none" id="modal_login">
<div class="modal_form login_form">
<i class="fa fa-times close_window close_modal"></i>
<h3>Login<span></span></h3>
{{Form::open(['route' => 'sessions.store', 'data-form-remote'])}}

    <div class="form-group">
        <label>Email:<input type="text" name="email" required></label>
        <p class="help-block"></p>
    </div>

    <div class="form-group">
        <label>Password:<input type="password" name="password" required></label>
        <p class="help-block"></p>
    </div>

    {{Form::submit('Log In', ['class' => 'btn btn-success'])}}
{{Form::close()}}
</div>
</div>