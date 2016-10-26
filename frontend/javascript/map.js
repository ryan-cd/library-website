var map;
function initMap() {
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