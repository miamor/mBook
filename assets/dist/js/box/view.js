var map, infoWindow;
var markers = {};
function initMap () {
	var map = new google.maps.Map(document.getElementById('map'), {
//		center: {lat: -33.866, lng: 151.196},
		zoom: 15
	});

	var infowindow = new google.maps.InfoWindow();
	var service = new google.maps.places.PlacesService(map);

	service.getDetails({
		placeId: PLACE_ID
	}, function (place, status) {
		if (status === google.maps.places.PlacesServiceStatus.OK) {
			var marker = new google.maps.Marker({
				map: map,
				position: place.geometry.location
			});
			map.setCenter(place.geometry.location);
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.setContent('<div><strong>' + BOX_TITLE + '</strong><br>' +
					place.formatted_address + '</div>');
				infowindow.open(map, this);
			});
		}
	});

	$('.get-direction').click(function () {
		getDirection();
		$('.get-direction').hide();
	});
	$('.bigger-map').click(function () {
		$('.map-canvas').toggleClass('big');
		return false
	})
}

function getDirection () {
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 15
	});
	var markerArray = [];
	// Instantiate a directions service.
	var directionsService = new google.maps.DirectionsService;
	var geocoder = new google.maps.Geocoder();
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var pos = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};
			map.setCenter(pos);
			var marker = new google.maps.Marker({
				position: pos,
				map: map
			});

			geocoder.geocode({
				'location': pos
			}, function (results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					if (results[0]) {
						$('#start').val(results[0].formatted_address);

			// Create a renderer for directions and bind it to the map.
			var directionsDisplay = new google.maps.DirectionsRenderer({map: map});
			// Instantiate an info window to hold step text.
			var stepDisplay = new google.maps.InfoWindow;

			var onChangeHandler = function () {
				calculateAndDisplayRoute(directionsDisplay, directionsService, markerArray, stepDisplay, map);
			};
			document.getElementById('travelMode').addEventListener('change', onChangeHandler);

						calculateAndDisplayRoute(directionsDisplay, directionsService, markerArray, stepDisplay, map);
					} else {
						alert('No results found');
					}
				} else {
					alert('Geocoder failed due to: ' + status);
				}
			});

		}, function() {
			handleLocationError(true, infoWindow, map.getCenter());
		});
	} else {
		// Browser doesn't support Geolocation
		handleLocationError(false, infoWindow, map.getCenter());
	}
}

function calculateAndDisplayRoute(directionsDisplay, directionsService, markerArray, stepDisplay, map) {
	// First, remove any existing markers from the map.
	for (var i = 0; i < markerArray.length; i++) {
		markerArray[i].setMap(null);
	}

	// Retrieve the start and end locations and create a DirectionsRequest using
	// {travelMode} directions.
	directionsService.route({
		origin: document.getElementById('start').value,
		destination: document.getElementById('end').value,
		travelMode: document.getElementById('travelMode').value // DRIVING | BICYCLING | TRANSIT | WALKING
	}, function(response, status) {
		// Route the directions and pass the response to a function to create
		// markers for each step.
		if (status === 'OK') {
			document.getElementById('warnings-panel').innerHTML = '<b>' + response.routes[0].warnings + '</b>';
			directionsDisplay.setDirections(response);
			showSteps(response, markerArray, stepDisplay, map);
			var distance = response.routes[0].legs[0].distance.text;
			var time = response.routes[0].legs[0].duration.text;
			$('.box-search-one-distance').text(distance);
			$('.box-search-one-time').text(time);
			$('.box-search-one-route').show();
		} else {
			window.alert('Directions request failed due to ' + status);
		}
	});
}

function showSteps (directionResult, markerArray, stepDisplay, map) {
	// For each step, place a marker, and add the text to the marker's infowindow.
	// Also attach the marker to an array so we can keep track of it and remove it
	// when calculating new routes.
	var myRoute = directionResult.routes[0].legs[0];
	for (var i = 0; i < myRoute.steps.length; i++) {
		var marker = markerArray[i] = markerArray[i] || new google.maps.Marker;
		marker.setMap(map);
		marker.setPosition(myRoute.steps[i].start_location);
		attachInstructionText(stepDisplay, marker, myRoute.steps[i].instructions, map);
	}
}

function attachInstructionText(stepDisplay, marker, text, map) {
	google.maps.event.addListener(marker, 'click', function() {
		// Open an info window when the marker is clicked on, containing the text
		// of the step.
		stepDisplay.setContent(text);
		stepDisplay.open(map, marker);
	});
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
	$('.box-one-book').hover(function () {
		var cu;
		setTimeout(function () {
			if (!cu) {
				cu = 1;
				src = $(this).attr('data-back')
			} else 
			$('.box-one-book-thumb').attr('src', src);
		}, 1000);
	})
	
	$('#box_lock').click(function () {
		$.post('?do=lock', function (data) {
			mtip('', 'success', '', 'Updated!');
			if (data == 1) $('#box_lock').html('<i class="fa fa-lock"></i> Khóa box');
			else $('#box_lock').html('<i class="fa fa-unlock"></i> Mở khóa box');
		});
		return false
	});
	$('#box_del').click(function () {
		$.post('?do=delete', function (data) {
			window.location.href = MAIN_URL+'/box';
		});
		return false
	});
	
	$('.btn-borrow').click(function () {
		popup_page('?do=borrow_html');
		return false;
	})

})
