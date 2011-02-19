	/**
	* Geolocation Module
	* 
	* @author Pedro Prez
	* @link http://community.elgg.org/pg/profile/pedroprez
	* @copyright (c) Keetup 2009-2010
	* @link http://www.keetup.com/
	* @license GNU General Public License (GPL) version 2
	*/

	function updatePositionLastMarker(element, e){
		$('input[name="geolocation"]').val('(' + element.getPosition().toUrlValue(7) + ')');
		goToAddressByLatLng(element.getPosition());
	}

	function setNullPosition() {
		location_input = $('input[name="location"]'); 
		location_input.val($('.unknow_error').html());
		location_input.select();
		location_input.focus();
		location_input.removeAttr('readonly');
		$('small.map_message_error').show('slow'); 
		$('small.map_message_error').animate({opacity: 1.0}, 3000);
		$('small.map_message_error').fadeOut('slow');
	}

	function goToAddressByLatLng(latLng) {
		geocoder = new google.maps.Geocoder();
	    if (geocoder) {
            geocoder.geocode({'latLng': latLng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                	//Add readonly attribute
                	if ($('input[name="location"][readonly="readonly"]').length == 0){
                		$('input[name="location"]').attr("readonly", "readonly");
                	}
                	
                	try {
						geoposition = results[0];
                    	$('input[name="location"]').val(geoposition.formatted_address);
                	} catch(e) {
                    	//Do something if happend some wrong
                    } 	
                } else {
                    setNullPosition();
                }
            });
		}
	}

	function drawPoint(objectMap, options){
		var defaults = {
			lat: 0,
			lng: 0,
			draggable: true,
			center: true,
			title: "",
			geolocation_input: "geolocation",
			location_input: "location",
		};
		var opts = $.extend(defaults, options);

		var latlng = new google.maps.LatLng(opts.lat, opts.lng);

		var point = new google.maps.Marker({
       		position: latlng, 
       		map: objectMap,
       		title: opts.title,
       		draggable: opts.draggable,
   		});

		//Add Event for draggable point
		if (opts.draggable) {
			google.maps.event.addListener(point, 'dragend', function(e) {
				updatePositionLastMarker(this, e)	
			});
		}
		//Center the point on the map
		if (opts.center) {
			objectMap.setCenter(latlng);
		}
		
		if (opts.geolocation_input) {
			$('input[name="' + opts.geolocation_input + '"]').val(latlng);
		}
		
		if (opts.location_input) {
			$('input[name="' + opts.location_input + '"]').val(opts.title);
		}
	}

	function goToAddress(address, objectMap) {
		geocoder = new google.maps.Geocoder();
	    if (geocoder) {
            geocoder.geocode({'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					//Clear the map
                	google.maps.Map.prototype.clearMarkers();
                	//Add readonly attribute
                	if ($('input[name="location"][readonly="readonly"]').length == 0) {
                		$('input[name="location"]').attr("readonly", "readonly");
                	}
                	
                	//Set a zoom
                	objectMap.setZoom(7);
                	try {
                    	geoposition = results[0];

                	    //Draw the point
                	    drawPoint(objectMap, {
							lat: geoposition.geometry.location.lat(),
							lng: geoposition.geometry.location.lng(),
							title: geoposition.formatted_address 
                    	});
                	} catch(e) {
                    	//Do something if happend some wrong
                    }
				} else {
					setNullPosition();
				}
			});
		}
	} 