var map, infoWindow, service, myInfoWindow;
var markers = {}, distances = {}, times = {};
function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: -34.397, lng: 150.644},
		zoom: 10
	});
	var markerArray = [];
	// Instantiate a directions service.
	var directionsService = new google.maps.DirectionsService;
	var geocoder = new google.maps.Geocoder();

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
			var marker = new google.maps.Marker({
				position: pos,
				map: map
			});

			geocoder.geocode({
				'location': pos
			}, function (results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					if (results[0]) {
						console.log(pos);
						console.log(results[0].formatted_address);
						$('#start').val(results[0].formatted_address);
			google.maps.event.addListener(marker, 'click', function() {
				myInfoWindow.setContent('<div><strong>You\'re here</strong><br>' +
				//	results[0].formatted_address + 
					'</div>');
				myInfoWindow.open(map, this);
			});

			// Create a renderer for directions and bind it to the map.
			var directionsDisplay = new google.maps.DirectionsRenderer({map: map});
			// Instantiate an info window to hold step text.
			var stepDisplay = new google.maps.InfoWindow;

			// Listen to change events from the start and end lists.
			var onChangeHandler = function () {
				$('.box-search-one').each(function () {
					k = $(this).attr('id');
					$('#end').val(placesName[k]);
					calDistance(directionsDisplay, directionsService, markerArray, stepDisplay, map, k);
				});
				if ($('.box-search-one.selected').length) {
					id = $('.box-search-one.selected').attr('id');
					$('#end').val(placesName[id]);
					calculateAndDisplayRoute(directionsDisplay, directionsService, markerArray, stepDisplay, map);
				}
			};
			document.getElementById('travelMode').addEventListener('change', onChangeHandler);

//			service = new google.maps.places.PlacesService(map);
			$('.box-search-one').each(function () {
				k = $(this).attr('id');
				$('#end').val(placesName[k]);
				calDistance(directionsDisplay, directionsService, markerArray, stepDisplay, map, k);
				$(this).click(function () {
					myInfoWindow.open(null);
					var selectedID = $('.box-search-one.selected').attr('id');
					var id = $(this).attr('id');
					$('.box-search-one').removeClass('selected');
					$(this).addClass('selected');
/*					if (!placesID[id]) alert('Không thể hiển thị địa điểm trên map');
					else {
*/						$('#end').val(placesName[id]);
						calculateAndDisplayRoute(directionsDisplay, directionsService, markerArray, stepDisplay, map);
//					}
				})
			}); // end each

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

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	infoWindow.setPosition(pos);
	infoWindow.setContent(browserHasGeolocation ?
				'Error: The Geolocation service failed.' :
				'Error: Your browser doesn\'t support geolocation.'
		);
	infoWindow.open(map);
}

function calDistance (directionsDisplay, directionsService, markerArray, stepDisplay, map, id) {
	// First, remove any existing markers from the map.
/*	for (var i = 0; i < markerArray.length; i++) {
		markerArray[i].setMap(null);
	}
*/	// Retrieve the start and end locations and create a DirectionsRequest using
	// {travelMode} directions.
	directionsService.route({
		origin: document.getElementById('start').value,
		destination: document.getElementById('end').value,
		travelMode: document.getElementById('travelMode').value // DRIVING | BICYCLING | TRANSIT | WALKING
	}, function(response, status) {
		// Route the directions and pass the response to a function to create
		// markers for each step.
		if (status === 'OK') {
			var distance = response.routes[0].legs[0].distance.text;
			var time = response.routes[0].legs[0].duration.text;
			$('.box-search-one#'+id+' .box-search-one-distance').text(distance);
			$('.box-search-one#'+id+' .box-search-one-time').text(time);
			$('.box-search-one#'+id+' .box-search-one-route').show();
		}
	});
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
/*			var distance = response.routes[0].legs[0].distance.text;
			var time = response.routes[0].legs[0].duration.text;
			$('.box-search-one.selected .box-search-one-distance').text(distance);
			$('.box-search-one.selected .box-search-one-time').text(time);
			$('.box-search-one.selected .box-search-one-route').show();
*/		} else {
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

$(window).scroll(function () {
//	console.log($(window).scrollTop()+'~'+$(document).height()+'~'+$(window).height())
	if (window.location.href.indexOf('box') > -1) {
		if ($(window).scrollTop() > 100 && $(window).scrollTop() < $(window).height()) {
			$('.map-side').addClass('fixed')
		} else {
			$('.map-side').removeClass('fixed')
		}
	}
});
