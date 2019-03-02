window.lat = 30.0444;
window.lng = 31.2357;
function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(updatePosition);
	}
	return null;
};
function updatePosition(position) {
	if (position) {
		window.lat = position.coords.latitude;
		window.lng = position.coords.longitude;
		updateLocation({lat: position.coords.latitude, lng: position.coords.longitude});
	}
}
setInterval(function(){updatePosition(getLocation());}, 1000);

function currentLocation() {
	return {lat:window.lat, lng:window.lng};
};

var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
var map;
var mark;
var lineCoords = [];
var initialize = function() {
	map  = new google.maps.Map(document.getElementById('map-canvas'), {center:{lat:lat,lng:lng},zoom:12});
	mark = new google.maps.Marker({
		position:{lat:lat, lng:lng}, 
		icon: iconBase + 'bus.png',
		map:map});
};
window.initialize = initialize;

var redraw = function(payload) {
	lat = payload.message.lat;
	lng = payload.message.lng;
	map.setCenter({lat:lat, lng:lng, alt:0});
	mark.setPosition({lat:lat, lng:lng, alt:0});


	lineCoords.push(new google.maps.LatLng(lat, lng));
	var lineCoordinatesPath = new google.maps.Polyline({
		path: lineCoords,
		geodesic: true,
		strokeColor: '#2E10FF'
	});
	lineCoordinatesPath.setMap(map);
};

var pnChannel = "Map-Channel";
var pubnub = new PubNub({
	publishKey:   'pub-c-86846c0b-089a-45da-bbbf-40b08fc33d36',
	subscribeKey: 'sub-c-7673c6b4-3c50-11e9-82f9-d2a672cc1cb7'
});
pubnub.subscribe({channels: [pnChannel]});
pubnub.addListener({message:redraw});

setInterval(function() {
	pubnub.publish({channel:pnChannel, message:currentLocation()});
}, 5000);

function updateLocation(position)
{
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$.ajax({
		type: 'POST',
		url: url+'/location/update',
		data: {lat: position.lat, lng: position.lng, location_id: user_location}, 
		success: function (data) {
		}
	});
}