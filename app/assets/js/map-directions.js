$(function(){

    'use strict';

    $('#get_directions_modal').on('shown.bs.modal', function (e) {

        var triggerBtn = $(e.relatedTarget),
            restaurantId = triggerBtn.data('restaurant-id'),
            url = '/restaurants/getdata/' + restaurantId,
            currentLocation = null;

        var deffered = $.get(url);


        // Check HTML5 Geolocation Support
        if (!checkGeolocationSupport()) {
            setTimeout(function () {
                $('#get_directions_modal').modal('hide');
            }, 1000);
        }

        deffered
            .done(function(response)
            {
                var item = response.data;

                $('span#restaurant-name').text(item.name);
                $('span#restaurant-address').text(item.address);

                $('div#map_get_directions').gmap3({
                    trigger: 'resize',
                    map: {
                        options: {
                            center: [item.lat, item.lng],
                            zoom: GMAP.zoom
                        }
                    },
                    marker: {
                        latLng: [item.lat, item.lng],
                        options: {
                            icon: response.marker + item.id,
                            optimized: false
                        }
                    }
                });

                navigator.geolocation.getCurrentPosition(function (position)
                {
                    var currentLocation = [position.coords.latitude, position.coords.longitude];

                    $('div#map_get_directions').gmap3({
                        marker: {
                            latLng: currentLocation,
                            options: {
                                icon: GMAP.defaultMarker
                            }
                        },
                        map: {
                            options: {
                                center: currentLocation
                            }
                        },
                        getroute: {
                            options: {
                                origin: currentLocation,
                                destination: [item.lat, item.lng],
                                travelMode: google.maps.DirectionsTravelMode.DRIVING
                            },
                            callback: function (results) {
                                if(!results) return;
                                $(this).gmap3({
                                    directionsrenderer: {
                                        options: {
                                            directions: results,
                                            suppressMarkers: true,
                                            polylineOptions: {
                                                strokeColor: '#2ecc71',
                                                strokeOpacity: 0.8,
                                                strokeWeight: 5
                                            }
                                        }
                                    }
                                });
                            }
                        }
                    });
                },
                function(positionError) {
                    showErrorMessage("Error: " + positionError.message, 'Location Error');
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10 * 1000 // 10 seconds
                });

                initMarkerBackground(item.id, response.marker, item.marker_image);
            })
            .always(function()
            {
                Loading.destroy();
            });

    }).on('hidden.bs.modal', function () {
        $('div#map_get_directions').gmap3('destroy');
    }).on('show.bs.modal', function () {
        Loading.enable('circular-square');
        $('div#map_get_directions').gmap3();
    });

});