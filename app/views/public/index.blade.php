<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>#kaonPH</title>

    {{ HTML::style('css/vendor.min.css'); }}
    {{ HTML::style('css/style.min.css'); }}
</head>
<body class="promo">

       @include('public.partials._register-modal')
       {{--@include('registration._registration-modal')--}}

       @include('public.partials._register-owner-modal')
       @include('public.partials._login')


          <nav class="navbar navbar-default navbar-fixed-top transparent-nav">
                <div class="container-fluid">
                    <div class="nav navbar-right pad-top30 animated fadeInDownBig">
                        {{HTML::link('#', 'Already Registered?', ['class' => 'white_border btn-no-border log_btn', 'id' => 'index_login_btn'])}}
                    </div>
                </div>
          </nav>
       <div class="start_descrition option animated fadeInDownBig">

          <a href="#" class="start_logo"><img width="120"src="images/logo.png" alt=""></a>
          <h1>welcome to #kaonPH!<span></span></h1>
          <span>Tour with the finest restaurants on Metro Cebu</span>

            <div class="btns">
            {{HTML::link(URL::route('home'), 'Get started', ['class' => 'green'])}}
            {{HTML::link('#', 'Have Restaurant?', ['class' => 'white_border', 'id' => 'register_owner_btn'])}}
            {{HTML::link('#', 'Register', ['class' => 'green', 'id' => 'register_btn'])}}
{{--            {{HTML::link('#', 'Register', ['class' => 'green', 'data-toggle' => 'modal', 'data-target' => '#register_public_modal'])}}--}}
            </div>
        </div>
        <div class="bgg"></div>


    {{ HTML::script('https://maps.googleapis.com/maps/api/js?v=3.exp'); }}
    {{ HTML::script('js/vendor.min.js'); }}
    {{ HTML::script('js/script.min.js'); }}
</body>
</html>