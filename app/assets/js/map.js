$(function(){

var	mapObject,
    overlays = [],
    markers = [],
    currentDrawingMode = null,
    mapOptions = {
        zoom: GMAP.zoom,
        center: new google.maps.LatLng(GMAP.coords.lat, GMAP.coords.lng),
        disableDefaultUI: true
    };

    function initialize () {
            // Show Instructions on map
            showInfoGrowl('Right Click to Toggle Drawing Tools');

  			var marker;

            mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);

            // get ajax request to get all restaurants
            var deffered = $.get('/restaurants/getdata');

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
            if (e.button == 2) {
                currentDrawingMode = toggleDrawingMode(mapObject, drawingManager, markers, overlays);
            }
        });

        drawingManager.set('drawingMode');
        drawingManager.setMap(mapObject);
  	}; /* End function initialize() */

    // initialize map
    if( document.getElementById("map") != null) initialize();


    // Search function for map index
    $('.search-map>input').typeahead({
        source: function(q, process)
        {
            var deffered =  $.ajax({
                method: 'GET',
                url: '/search',
                data: {q: q},
                beforeSend: function(){
                    resetZoom(mapObject);
                    $('.search-map-spinner').fadeIn(100);
                }
            });

            deffered
                .done( function(response){
                    var data = [],
                        results = response.data;

                    if(response.message != undefined) return process(data);

                    closeInfoBox();

                    results.forEach(function(item){
                       data.push(item.id + '#' + item.name + '#' + item.type + '#' + item.marker_image + '#' + item.address);
                    });
                    return process(data);
                })
                .always(function(){
                    $('.search-map-spinner').fadeOut(100);
                });
        },
        highlighter: function (itemRaw) {
            var item = itemRaw.split('#');

            var html = '<div class="typeahead">';
            html += '<div class="pull-left"><img src="'+item[3]+'" width="32" height="32" class="img-rounded"></div>';
            html += '<div class="pull-left margin-small">';
            html += '<div class="text-left">';
            html += '<strong>'+item[1]+'</strong>';
            html += '<span class="text-type">' + item[2] + ' <i class="fa fa-spoon"></i></span>';
            html += '</div>';
            html += '<div class="text-left text-address">' + item[4] + '</div>';
            html += '</div>';
            html += '<div class="clearfix"></div>';
            html += '</div>';

            return html;
        },
        updater: function (itemRaw) {
            var item = itemRaw.split('#');
            return item[1];
        },
        afterSelect: renderResultOnMap
    });

    // show all markers if value on search input is null
    $('.search-map>input').on('input', function(){
        var value = $(this).val();

        if(value != '') return;

        toggleMarkers(markers, mapObject);
    });

    $('.categories-container ul.categories-list li').on('click', function() {
       var typeClicked = $(this).data('value');

        closeInfoBox();

        var deffered = $.get('resturants/getbytype', {'type': typeClicked});

        deffered.done(function(response)
        {
            if (response.message != undefined) {
                toggleMarkers(markers, mapObject);
                showInfoMessage(response.message, 'Restaurant of type '+typeClicked+' not found.');
                return;
            }

            clearMarkers(markers);

            $.each(response.data, function(key, item){

                markers.forEach(function (marker) {
                    var itemId = marker.icon.split('#')[1];
                    if (itemId == undefined) return;
                    // Show marker if found
                    if (itemId == item.id) {
                        marker.setMap(mapObject);
                        marker.setAnimation(google.maps.Animation.DROP);
                        mapObject.panTo(new google.maps.LatLng(item.lat, item.lng));
                    }
                });
            });
        });
    });

    $('button#btn-loved-all').on('click', function(){
        var url = '/restaurants/getallloved';

        var deffered = $.get(url);
        deffered.done(function(response)
        {
            if (response.message != undefined) {
                toggleMarkers(markers, mapObject);
                showInfoMessage(response.message, 'No Loved Restaurant found.');
                return;
            }
            clearMarkers(markers);

            $.each(response.data, function (key, item) {

                markers.forEach(function (marker) {
                    var itemId = marker.icon.split('#')[1];
                    if (itemId == undefined) return;
                    // Show marker if found
                    if (itemId == item.id) {
                        marker.setMap(mapObject);
                        marker.setAnimation(google.maps.Animation.DROP);
                        mapObject.panTo(new google.maps.LatLng(item.lat, item.lng));
                    }
                });
            });
        });
    });

    $('#btn-loved').on('click', function(){
        var url = '/restaurants/getloved';

        var deffered = $.get(url);
        deffered.done(function (response) {
            if (response.message != undefined) {
                toggleMarkers(markers, mapObject);
                showInfoMessage(response.message, 'No Loved Restaurant found.');
                return;
            }
            clearMarkers(markers);

            $.each(response.data, function (key, item) {

                markers.forEach(function (marker) {
                    var itemId = marker.icon.split('#')[1];
                    if (itemId == undefined) return;
                    // Show marker if found
                    if (itemId == item.id) {
                        marker.setMap(mapObject);
                        marker.setAnimation(google.maps.Animation.DROP);
                        mapObject.panTo(new google.maps.LatLng(item.lat, item.lng));
                    }
                });
            });
        });
    });

    $('#btn-liked').on('click', function(){
        var url = '/restaurants/getliked';

        var deffered = $.get(url);
        deffered.done(function (response) {
            if (response.message != undefined) {
                toggleMarkers(markers, mapObject);
                showInfoMessage(response.message, 'No Loved Restaurant found.');
                return;
            }
            clearMarkers(markers);

            $.each(response.data, function (key, item) {

                markers.forEach(function (marker) {
                    var itemId = marker.icon.split('#')[1];
                    if (itemId == undefined) return;
                    // Show marker if found
                    if (itemId == item.id) {
                        marker.setMap(mapObject);
                        marker.setAnimation(google.maps.Animation.DROP);
                        mapObject.panTo(new google.maps.LatLng(item.lat, item.lng));
                    }
                });
            });
        });
    });

    $('#btn-disliked').on('click', function () {
        var url = '/restaurants/getdisliked';

        var deffered = $.get(url);
        deffered.done(function (response) {
            if (response.message != undefined) {
                toggleMarkers(markers, mapObject);
                showInfoMessage(response.message, 'No Loved Restaurant found.');
                return;
            }
            clearMarkers(markers);

            $.each(response.data, function (key, item) {

                markers.forEach(function (marker) {
                    var itemId = marker.icon.split('#')[1];
                    if (itemId == undefined) return;
                    // Show marker if found
                    if (itemId == item.id) {
                        marker.setMap(mapObject);
                        marker.setAnimation(google.maps.Animation.DROP);
                        mapObject.panTo(new google.maps.LatLng(item.lat, item.lng));
                    }
                });
            });
        });
    });

        function renderResultOnMap(selectedRestaurant)
    {
        var deffered = $.get('/restaurants/getbyname/', {name: selectedRestaurant});
        deffered
            .done(function (response) {
                var item = response.data,
                    found = false;

                if(response.message != undefined) {
                    showErrorMessage(response.message, 'Couldnt render result on map.');
                    return;
                }

                // Check the id of item if already exists in markers array
                markers.forEach(function(marker){
                   var itemId = marker.icon.split('#')[1];
                   if(itemId == undefined) return;
                   // Show marker if found
                   if(itemId == item.id) {
                       found = true;
                       mapObject.panTo(new google.maps.LatLng(item.lat, item.lng));
                       getInfoBox(item).open(mapObject, marker);
                   }
                });

                if( !found)
                {
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(item.lat, item.lng),
                        map: mapObject,
                        icon: response.marker + item.id,
                        optimized: false
                    });

                    marker.setAnimation(google.maps.Animation.DROP);

                    markers.push(marker);

                    initMarkerBackground(item.id, response.marker, item.marker_image);

                    google.maps.event.addListener(marker, 'click', (function () {
                        closeInfoBox();
                        getInfoBox(item).open(mapObject, this);
                        mapObject.panTo(new google.maps.LatLng(item.lat, item.lng));
                    }));
                }
            });
    }

}); /* End of Jquery ready */







