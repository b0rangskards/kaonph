$(function(){

var	mapObject,
    overlays = [],
    markers = [];

    function initialize () {
  			var mapOptions = {
  				zoom: GMAP.zoom,
  				center: new google.maps.LatLng(GMAP.coords.lat, GMAP.coords.lng),
  				mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true
  			};
  			var marker,
  			    mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);

            // get ajax request to get all restaurants
            var deffered = $.get(window.location.origin+'/restaurants/getdata');

            deffered
                .done( function( data ) {
                    var items = data.data;

                    $.each(items, function(key, item)
                    {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(item.lat, item.lng),
                            map: mapObject,
                            icon: data.marker + item.id,
                            optimized: false
                        });

                        marker.setAnimation(google.maps.Animation.DROP);

                        markers.push(marker);

                        initMarkerBackground(item.id, data.marker, item.marker_image);

                        google.maps.event.addListener(marker, 'click', (function () {
                            closeInfoBox();
                            getInfoBox(item).open(mapObject, this);
                            mapObject.panTo(new google.maps.LatLng(item.lat, item.lng));
                        }));
                    });
            });

        google.maps.event.addListener(mapObject, 'click', (function () {
            closeInfoBox();
        }));


        var drawingManager = new google.maps.drawing.DrawingManager();
        setDrawingManagerOptions(drawingManager);

        google.maps.event.addListener(drawingManager, 'circlecomplete', function (circle) {
            clearOverlays(overlays);

            overlays.push(circle);

            var bounds = circle.getBounds();

            $.each(markers, function (key, marker) {
                if( ! bounds.contains(marker.getPosition()))
                {
                    removeMarkerWithAnimation(marker);
                }else
                {
                    marker.setMap(mapObject);
                }
            });

            drawingManager.setDrawingMode(null);
            clearOverlays(overlays);
        });

        // Listens to Right click button
        // Toggles drawing mode from pan to circle
        $(document).mousedown(function (e)
        {
            if (e.button == 2)
            {
                closeInfoBox();

                var currentDrawingMode = drawingManager.getDrawingMode();

                if (currentDrawingMode == google.maps.drawing.OverlayType.MARKER ||
                    currentDrawingMode == null) {
                    drawingManager.setDrawingMode(google.maps.drawing.OverlayType.CIRCLE);
                }
                else if (currentDrawingMode == google.maps.drawing.OverlayType.CIRCLE) {
                    drawingManager.setDrawingMode(null);
                    clearOverlays(overlays);
                    toggleMarkers(markers, mapObject);
                }
                return false;
            }
            return true;
        });

        drawingManager.set('drawingMode');
        drawingManager.setMap(mapObject);
  	}; /* End function initialize() */

    if( document.getElementById("map") != null) initialize();

});







