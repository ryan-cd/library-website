var map;
function initThodeMap() {
    var thode = {lat: 43.2609475, lng: -79.9222869};
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: thode
    });
    
    var marker = new google.maps.Marker({
        position: thode,
        map: map
    });
}

function initComboMap() {
    var thode = {lat: 43.2609475, lng: -79.9222869};
    var healthSci = {lat: 43.260151, lng: -79.9204577};
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: healthSci
    });
    
    var thodeMarker = new google.maps.Marker({
        position: thode,
        map: map,
        title: 'Thode Library'
    });
    
    var healthSciMarker = new google.maps.Marker({
        position: healthSci,
        map: map
    });
    
    var contentString = '<div id="content">' +
                            '<div id="siteNotice">' +
                                '<h2 id="firstHeading" class="firstHeading">H.G. Thode Library</h1>' +
                                '<div id="bodyContent">' +
                                    '<p>Engineering and Sciences Library</p>' +
                                '</div>' + 
                            '</div>' +
                        '</div>';
    var infoWindow = new google.maps.InfoWindow({
        content: contentString
    });
    
    thodeMarker.addListener('click', function() {
        infoWindow.open(map, thodeMarker);
    });
    
    healthSciMarker.addListener('click', function() {
        infoWindow.open(map, healthSciMarker);
    });
}