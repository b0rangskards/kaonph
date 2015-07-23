
$(function(){

    'use strict';

    $('#modal_new_restaurant,#modal_update_restaurant').on('shown.bs.modal', function() {

        var latlng = $(this).find('form input[name=coordinates]').val();

        var lat  = GMAP.coords.lat,
            lng  = GMAP.coords.lng;

        // update coordinates if updating the restaurant
        if (latlng != '')
        {
            var latlngArr = latlng.split(',');
            lat = latlngArr[0];
            lng = latlngArr[1];
        }

        $('div.map-location-picker').gmap3({
            trigger: 'resize',
            map: {
                options: {
                    center: [lat, lng],
                    zoom: GMAP.zoom,
                    disableDefaultUI: true
                }
            },
            marker: {
                latLng: [lat, lng],
                options: {
                    draggable: true,
                    icon: GMAP.defaultMarker
                },
                events: {
                    dragend: function (marker, event, context) {
                        var newLatLng = {
                          lat: marker.position.A,
                          lng: marker.position.F
                        };

                        updateMapCenter(this, newLatLng);

                        $('input[name="coordinates"]').val(newLatLng.lat + ',' + newLatLng.lng);
                    }
                }
            }
        });
    }).on('hidden.bs.modal', function(){

        var form = $('form#new-restaurant-form');

        resetForm(form);

        $('div.map-location-picker').gmap3('destroy');
    }).on('show.bs.modal', function(){

        $('div.map-location-picker').gmap3();

    });

     /* End of modal shown init map - location picker*/

});