<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>#kaonPH</title>

    {{ HTML::style('css/vendor.min.css'); }}
    {{ HTML::style('css/style.min.css'); }}
</head>
<body>
    @if(!is_null($currentUser))
        @include('layouts.partials.nav')
    @endif

    @include('restaurants.partials._new-restaurant-modal')

    <div class="container contant">
        <div class="row">

            <div class="site-overlay"></div>

            @yield('content')

        </div>
    </div>

    {{ HTML::script('https://maps.googleapis.com/maps/api/js?v=3.exp'); }}
    {{ HTML::script('js/vendor.min.js'); }}
    {{ HTML::script('js/script.min.js'); }}
</body>
</html>