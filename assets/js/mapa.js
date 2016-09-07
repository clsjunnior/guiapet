/**
 * Created by Windows 10 on 07/09/2016.
 */


/*window.initMap = function initMap() {
    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -21.673391, lng: -49.747130},
        scrollwheel: true,
        zoom: 14
    });
};*/

var map;

function initialize() {
    var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);

    var options = {
        zoom: 5,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("mapa"), options);
}

initialize();

// Função para carregamento assíncrono
/*function loadScript() {
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyA_cPiH8zBAbz360dlO4I1wrrqVgKvN4z4&amp;sensor=false";
    document.body.appendChild(script);
}
window.onload = loadScript;*/

