window.lat = 30.0444;
window.lng = 31.2357;

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


function updatePosition(position) {
	if (position) {
		window.lat = position.lat;
		window.lng = position.lng;
	}

	map.setCenter({lat:lat, lng:lng, alt:0});
	mark.setPosition({lat:lat, lng:lng, alt:0});

	lineCoords.push(new google.maps.LatLng(lat, lng));
	var lineCoordinatesPath = new google.maps.Polyline({
		path: lineCoords,
		geodesic: true,
		strokeColor: '#2E10FF'
	});
	lineCoordinatesPath.setMap(map);
}

setInterval(function(){updateLocation();}, 1000);

function updateLocation(position)
{
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$.ajax({
		type: 'POST',
		url: url+'/location/get',
		data: {location_id: user_location},
		success: function (data) {
			updatePosition(data);
		}
	});
}