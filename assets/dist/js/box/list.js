var map, infoWindow, service, myInfoWindow;
function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: -34.397, lng: 150.644},
		zoom: 10
	});

	myInfoWindow = new google.maps.InfoWindow;
	infoWindow = new google.maps.InfoWindow;

	// Try HTML5 geolocation.
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var pos = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};
			map.setCenter(pos);
/*			var marker = new google.maps.Marker({
				position: pos,
				map: map
			});
*/			
			myInfoWindow.setPosition(pos);
			myInfoWindow.setContent("You're here.");
			myInfoWindow.open(map);

			$.each(placesID, function (i, place_ID) {
				service = new google.maps.places.PlacesService(map);
				service.getDetails({
					placeId: place_ID
				}, function(place, status) {
					if (status === google.maps.places.PlacesServiceStatus.OK) {
						var marker = new google.maps.Marker({
							map: map,
							position: place.geometry.location
						});
						google.maps.event.addListener(marker, 'click', function() {
							infoWindow.setContent('<div><strong>' + boxesName[i] + '</strong><br>' +
							place.formatted_address + '</div>');
							infoWindow.open(map, this);
						});
					}
				});
			}); // end each

		}, function() {
			handleLocationError(true, infoWindow, map.getCenter());
		});
	} else {
	// Browser doesn't support Geolocation
	handleLocationError(false, infoWindow, map.getCenter());
	}
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	infoWindow.setPosition(pos);
	infoWindow.setContent(browserHasGeolocation ?
				'Error: The Geolocation service failed.' :
				'Error: Your browser doesn\'t support geolocation.'
		);
	infoWindow.open(map);
}

$(document).ready(function () {
	$('.sb-form').submit(function () {
		location.href = '?mode=search&key='+$('[name="key"]').val();
		return false
	})
})
