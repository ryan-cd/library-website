var map;
var infoWindow;

function initThodeMap() {
    addMarker({lat: 43.2609475, lng: -79.9222869}, createInfoString('H.G. Thode Library', 'Engineering and Sciences Library'));
}

function initHealthSciMap() {
    addMarker({lat: 43.260336, lng: -79.918174}, createInfoString('Health Sciences Library', 'This library is for studying health sciences.'));
}

function addMarker(coords, info) {
    var thode = {lat: 43.2609475, lng: -79.9222869};
    if (map === undefined) {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: coords
        });
    }
    if (infoWindow === undefined) {
        infoWindow = new google.maps.InfoWindow({});
    }
    
    var marker = new google.maps.Marker({
        position: coords,
        map: map
    });
    
    marker.addListener('click', function() {
        infoWindow.open(map, marker);
        infoWindow.setContent(info);
    });
}

function drawMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {lat: 43.2593068, lng: -79.92134}
    });
    
    initThodeMap();
    initHealthSciMap();
}

function createInfoString (name, description) {
    return '<div id="content">' +
                '<div id="siteNotice">' +
                    '<h2><a href="../html/individual_sample.html">' + name + '</a></h1>' +
                    '<div>' +
                        '<p>' + description + '</p>' +
                    '</div>' + 
                '</div>' +
            '</div>';
}