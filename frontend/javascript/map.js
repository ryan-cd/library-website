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
        map: map
    });
    
    var healthSciMarker = new google.maps.Marker({
        position: healthSci,
        map: map
    });
}