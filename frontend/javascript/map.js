var map;
var infoWindow;

/* If no map exists, this will create a map with a marker at Thode. Otherwise it will
just add the Thode marker to the existing map */
function initThodeMap() {
    addMarker({lat: 43.2609475, lng: -79.9222869}, createInfoString('H.G. Thode Library', 'Engineering and Sciences Library'));
}

function initHealthSciMap() {
    addMarker({lat: 43.260336, lng: -79.918174}, createInfoString('Health Sciences Library', 'This library is for studying health sciences.'));
}

/* If no map exists, this will create a map with a marker at the specified location
with the specified description. Otherwise it will just add the marker to the existing map */
function addMarker(coords, info) {
    var thode = {lat: 43.2609475, lng: -79.9222869};
    if (map === undefined) {
        // Create a map object
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: coords
        });
    }
    if (infoWindow === undefined) {
        // Create the blank marker information token
        infoWindow = new google.maps.InfoWindow({});
    }
    
    // Make a marker object on the map at the target location
    var marker = new google.maps.Marker({
        position: coords,
        map: map
    });
    
    //Set the marker to activate the appropriate description on click
    marker.addListener('click', function() {
        infoWindow.open(map, marker);
        infoWindow.setContent(info);
    });
}

/* This function will create a map and draw both library markers onto it */
function drawMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {lat: 43.2593068, lng: -79.92134}
    });
    
    initThodeMap();
    initHealthSciMap();
}

/* Returns a formatted marker information string with the appropriate name/description */
function createInfoString (name, description) {
    return '<div id="content">' +
                '<div id="siteNotice">' +
                    '<h2><a href="individual_sample.php">' + name + '</a></h1>' +
                    '<div>' +
                        '<p>' + description + '</p>' +
                    '</div>' + 
                '</div>' +
            '</div>';
}