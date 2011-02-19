	/**
	* Geolocation Module
	* 
	* @author Pedro Prez
	* @link http://community.elgg.org/pg/profile/pedroprez
	* @copyright (c) Keetup 2009-2010
	* @link http://www.keetup.com/
	* @license GNU General Public License (GPL) version 2
	*/

	//Hack for manage the markers
	google.maps.Map.prototype.markers = new Array();
	
	google.maps.Map.prototype.getMarkers = function() {
	    return this.markers
	};
	
	google.maps.Map.prototype.clearMarkers = function() {
	    for(var i=0; i<this.markers.length; i++){
	        this.markers[i].setMap(null);
	    }
	    this.markers = new Array();
	};
	
	google.maps.Marker.prototype._setMap = google.maps.Marker.prototype.setMap;
	
	google.maps.Marker.prototype.setMap = function(map) {
	    if (map) {
	        map.markers[map.markers.length] = this;
	    }
	    this._setMap(map);
	}