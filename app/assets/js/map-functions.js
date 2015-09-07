/**
 * Created by Wayne on 7/15/2015.
 */
'use strict';

function addCSSRule(sheet, selector, rules, index) {
    if ("insertRule" in sheet) {
        sheet.insertRule(selector + "{" + rules + "}", index);
    } else if ("addRule" in sheet) {
        sheet.addRule(selector, rules, index);
    }
}

function initMarkerBackground(id, marker, markerImage)
{
    addCSSRule(document.styleSheets[0],
        'img[src="' + marker + id + '"]',
        'background:url("' + markerImage + '") no-repeat 4px 4px'
    );
}

function clearOverlays (overlays) {
    if(overlays.length == 0) return false;

    for(i=0;i<overlays.length; i++){
        overlays.pop().setMap(null);
    }
};

function clearMarkers(markers) {
    if(markers.length == 0) return false;

    markers.forEach(function (marker) {
        marker.setMap(null);
    });
}

function toggleMarkers (markers, map) {
	closeInfoBox();

	if(markers.length == 0) return false;

	markers.forEach(function (marker)
    {
        if(marker.getMap() == null) {
            marker.setMap(map);
            marker.setAnimation(google.maps.Animation.DROP);
        }

	});
};

function toggleDrawingMode(map, drawingManager, markers, overlays )
{
    closeInfoBox();

    var currentDrawingMode = drawingManager.getDrawingMode();

    if (currentDrawingMode == google.maps.drawing.OverlayType.MARKER ||
        currentDrawingMode == null) {
        drawingManager.setDrawingMode(google.maps.drawing.OverlayType.CIRCLE);
        showActionGrowl('Drawing Mode');
    }
    else if (currentDrawingMode == google.maps.drawing.OverlayType.CIRCLE) {
        drawingManager.setDrawingMode(null);
        clearOverlays(overlays);
        toggleMarkers(markers, map);
        showActionGrowl('Pan Mode');
    }
    return drawingManager.getDrawingMode();
}

function removeMarkerWithAnimation(marker) {
    marker.setAnimation(google.maps.Animation.BOUNCE);

    setTimeout(function () {
        marker.setMap(null);
    }, 1000);
}

function closeInfoBox() {
	$('div.infoBox').remove();
};

function getInfoBox(item) {
	return new InfoBox({
		content:
		'<div class="marker_info none" id="marker_info">' +
		'<div class="info" id="info">'+
		'<img src="' + item.image + '" class="logotype" alt="" height="100px"/>' +
		'<h3>'+ item.name +'<span></span></h3>' +
        '<span class="type"><i class="fa fa-spoon"></i> '+ item.type +'</span>' +
		'<span class="address">'+ item.address +'</span>' +
        '<div class="rate_info">' +
        '<span><i class="fa fa-heart-o flat-red"></i>'+item.loved_percentage+'%</span>' +
        '<span><i class="fa fa-thumbs-up flat-blue"></i>'+item.liked_percentage+'%</span>' +
        '<span><i class="fa fa-thumbs-down flat-yellow"></i>'+item.disliked_percentage+'%</span>' +
        '</div>' +
		'<a href="'+ item.url_more_info + '" class="green_btn">More info</a>' +
        '<a href="#" data-restaurant-id="'+item.id+'" data-toggle="modal" data-target="#get_directions_modal" class="white_btn get_directions_btn">Get Directions</a>' +
		'<span class="arrow"></span>' +
		'</div>' +
		'</div>',
		disableAutoPan: true,
		maxWidth: 0,
		pixelOffset: new google.maps.Size(33, -215),
        closeBoxMargin: "3px 3px 3px 3px",
		isHidden: false,
		pane: 'floatPane',
		enableEventPropagation: true
	});
}; /* End function getInfoBox(item) */

function updateMapCenter(map, newLatLng) {
    $(map).gmap3({
        map: {
            options: {
                center: [newLatLng[0], newLatLng[1]]
            }
        }
    });
}

function setDrawingManagerOptions(drawingManager)
{
    drawingManager.setOptions({
        drawingMode: google.maps.drawing.OverlayType.MARKER,
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.BOTTOM_LEFT,
            drawingModes: [google.maps.drawing.OverlayType.CIRCLE]
        },
        circleOptions: {
            fillColor: '#2ecc71',
            fillOpacity: 0.3,
            strokeWeight: 0,
            clickable: true,
            editable: true,
            zIndex: 1
        }
    });
}

function checkGeolocationSupport()
{
    // If the browser supports the Geolocation API
    if (typeof navigator.geolocation == "undefined") {
        showErrorMessage("Your browser doesn't support the Geolocation API", "We're sorry for the inconvience.");
        return false;
    }
    return true;
}

function resetZoom(map)
{
    if (map.getZoom() == GMAP.zoom) return;

    map.setZoom(GMAP.zoom);
}