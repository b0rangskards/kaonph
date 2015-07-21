<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>#kaonPH</title>

    {{ HTML::style('css/vendor.min.css'); }}
    {{ HTML::style('css/style.min.css'); }}
</head>
<body class="indexpage">

    @if(!is_null($currentUser))
        @include('layouts.partials.nav')
    @endif

    <div class="site-overlay"></div>

    @include('layouts.partials.header')

{{--    @include('layouts.partials.categories-menu')--}}
    @yield('content')

    {{ HTML::script('https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=drawing,places'); }}
    {{ HTML::script('js/vendor.min.js'); }}
    {{ HTML::script('js/script.min.js'); }}
</body>
</html>