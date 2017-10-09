PLACE_ID = $('[name="place_id"]').val();
$('#pac-input').val($('[name="location"]').val());

function initMap () {
	var map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: -33.8688, lng: 151.2195},
		zoom: 13
	});

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

	var input = document.getElementById('pac-input');

	var autocomplete = new google.maps.places.Autocomplete(input);
	autocomplete.bindTo('bounds', map);

	map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

	var infowindow = new google.maps.InfoWindow();
	var infowindowContent = document.getElementById('infowindow-content');
	infowindow.setContent(infowindowContent);
	var marker = new google.maps.Marker({
		map: map
	});
	marker.addListener('click', function() {
		infowindow.open(map, marker);
	});

	autocomplete.addListener('place_changed', function() {
		infowindow.close();
		var place = autocomplete.getPlace();
		if (!place.geometry) {
				return;
		}

		if (place.geometry.viewport) {
			map.fitBounds(place.geometry.viewport);
		} else {
			map.setCenter(place.geometry.location);
			map.setZoom(17);
		}

		// Set the position of the marker using the place ID and location.
		marker.setPlace({
			placeId: place.place_id,
			location: place.geometry.location
		});
		marker.setVisible(true);

		infowindowContent.children['place-name'].textContent = place.name;
		infowindowContent.children['place-id'].textContent = place.place_id;
		infowindowContent.children['place-address'].textContent =	place.formatted_address;
		infowindow.open(map, marker);
	});
}
