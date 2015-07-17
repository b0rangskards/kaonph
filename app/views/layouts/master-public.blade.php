<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>#kaonPH</title>

    {{ HTML::style('css/vendor.min.css'); }}
    {{ HTML::style('css/style.min.css'); }}
</head>
<body class="promo">
    @yield('content')

    {{ HTML::script('https://maps.googleapis.com/maps/api/js?v=3.exp'); }}
    {{ HTML::style('css/vendor.min.css'); }}
    {{ HTML::style('css/script.min.css'); }}
</body>
</html>