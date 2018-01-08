'use strict';

var map,
    allMarkers = [],
    infoBoxContainer;

function initMap() {
    if (typeof mapSettings === 'undefined') return;

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: mapSettings.center.lat, lng: mapSettings.center.lng},
        zoom: mapSettings.zoom,
        disableDefaultUI: true
    });
    infoBoxContainer = document.getElementById('info-box-container');

    setMarkers();

    document.addEventListener('change.tabs', function () {
        var currCenter = map.getCenter();
        google.maps.event.trigger(map, 'resize');
        map.setCenter(currCenter);
    }, false);
}

function setMarkers() {
    mapSettings.points.forEach(function (point) {
        var marker = new google.maps.Marker({
            id: point.id,
            position: {lat: Number(point.lat), lng: Number(point.lng)},
            map: map,
            icon: point.icon,
            title: point.title,
            zIndex: point.zIndex,
            animation: google.maps.Animation.DROP
        });

        var infoBox = document.getElementById('info-box-' + point.id);

        allMarkers.push(marker);

        marker.addListener('click', function () {
            var curPoint = this,
                isActive = curPoint.showInfo;

            toggleBounce(curPoint);
            
            resetInfoBox();

            if (!infoBoxContainer || !infoBox) return;

            if (!isActive) {
                this.showInfo = true;

                updateContentInfoBox(curPoint);
                updatePosInfoBox(curPoint, infoBoxContainer);

                infoBoxContainer.style.visibility = 'visible';
                infoBoxContainer.style.opacity = 1;

                map.addListener('center_changed', function () {
                    updatePosInfoBox(curPoint, infoBoxContainer);
                })
            }
        });
    });

    // document.addEventListener('scroll', function () {
    //     resetBounce();
    //     resetInfoBox();
    // });
    map.addListener('zoom_changed', function () {
        resetBounce();
        if (infoBoxContainer) resetInfoBox();
    });
    google.maps.event.addDomListener(map, 'click', function () {
        resetBounce();
        if (infoBoxContainer) resetInfoBox();
    });
}

function resetBounce() {
    allMarkers.forEach(function (marker) {
        marker.setAnimation(null);
    })
}

function toggleBounce(marker) {
    if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
    } else {
        for (var i = 0; i < allMarkers.length; i++) {
            allMarkers[i].setAnimation(null);
        }
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}

function resetInfoBox() {
    infoBoxContainer.style.visibility = 'hidden';
    infoBoxContainer.style.opacity = 0;
    allMarkers.forEach(function (marker) {
        marker.showInfo = false;
    });
}

function updateContentInfoBox(point) {
    infoBoxContainer.innerHTML = document.getElementById('info-box-' + point.id).innerHTML
}

function updatePosInfoBox(point, infoBoxContainer) {
    var pointPos = fromLatLngToPoint(point.getPosition(), map);
    infoBoxContainer.style.left = pointPos.x + 'px';
    infoBoxContainer.style.top = pointPos.y + 'px';
}

function fromLatLngToPoint(latLng, map) {
    var topRight = map.getProjection().fromLatLngToPoint(map.getBounds().getNorthEast());
    var bottomLeft = map.getProjection().fromLatLngToPoint(map.getBounds().getSouthWest());
    var scale = Math.pow(2, map.getZoom());
    var worldPoint = map.getProjection().fromLatLngToPoint(latLng);
    return new google.maps.Point((worldPoint.x - bottomLeft.x) * scale, (worldPoint.y - topRight.y) * scale);
}