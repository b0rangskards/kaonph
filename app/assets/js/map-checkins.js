$(function () {

    var mapObject,
        markers = [];

    function initialize() {
        var mapOptions = {
            zoom: GMAP.zoom,
            center: new google.maps.LatLng(GMAP.coords.lat, GMAP.coords.lng),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true
        };
        var marker,
            mapObject = new google.maps.Map(document.getElementById('map_visits'), mapOptions);

        $.get('/checkins/getdata', function (data) {
            var items = data.data;

            $.each(items, function (key, item) {

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(item.lat, item.lng),
                    map: mapObject,
                    icon: data.marker + item.id,
                    optimized: false
                });

                addCSSRule(document.styleSheets[0],
                    'img[src="' + data.marker + item.id + '"]',
                    'background:url("' + item.marker_image + '") no-repeat 4px 4px'
                );

                google.maps.event.addListener(marker, 'click', (function () {
                    closeInfoBox();
                    getInfoBox(item).open(mapObject, this);
                    mapObject.setCenter(new google.maps.LatLng(item.lat, item.lng));
                }));
            });
        });

    };
    /* End function initialize() */

    var map_index = document.getElementById("map_visits");

    if (map_index != null) initialize();

});







