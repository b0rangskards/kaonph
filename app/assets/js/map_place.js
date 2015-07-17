$(function() {

    function initialize()
    {
        var href = location.href;
        var restauId = href.substr(href.lastIndexOf('/') + 1);
        var url = '/restaurants/getdata/' + restauId;

        var deffered = $.get(url);

        deffered
            .done( function (response) {
                var item = response.data;

                var mapOptions_place = {
                    zoom: GMAP.zoom,
                    center: new google.maps.LatLng(item.lat, item.lng),
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    disableDefaultUI: true
                }
                //map
                var map_place = new google.maps.Map(document.getElementById("map_place"), mapOptions_place);

                var coords = new google.maps.LatLng(item.lat, item.lng);

                marker = new google.maps.Marker({
                    position: coords,
                    map: map_place,
                    icon: response.marker + item.id,
                    optimized: false
                });

                initMarkerBackground(item.id, response.marker, item.marker_image);
        });
    };

    var map_place = document.getElementById("map_place");

    if(map_place != null) initialize();

});
