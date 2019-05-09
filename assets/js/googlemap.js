if( (document.getElementById("infos_adresse"))&&(document.getElementById("infos_codepostal"))) {
  var geocoder;
  var map;
  var myLatlng;
  var adresse = document.getElementById("infos_adresse").innerHTML;
  var codepostal = document.getElementById("infos_codepostal").innerHTML;
  var styles = [
    {
        "featureType": "landscape",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "stylers": [
            {
                "hue": "#00aaff"
            },
            {
                "saturation": -100
            },
            {
                "gamma": 2.15
            },
            {
                "lightness": 12
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "lightness": 24
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry",
        "stylers": [
            {
                "lightness": 57
            }
        ]
    }
];
function initialize() {
  var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});
  geocoder = new google.maps.Geocoder();
  geocoder.geocode({address: adresse + codepostal +',FRANCE',},function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();
        var myLatlng = new google.maps.LatLng(latitude, longitude);
        var mapOptions = {
          zoom: 11,
          center: myLatlng,
          panControl: false, //enable pan Control
          scrollwheel: false,
          zoomControl: true, //enable zoom control
          scaleControl: true, // enable scale control
          disableDefaultUI: true
        }
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        map.mapTypes.set('map_style', styledMap);
        map.setMapTypeId('map_style');
        overlay = new CustomMarker(
		      myLatlng, 
		      map,
		      {
		        marker_id: 'my_marker'
		      }
	);
      }else{
        alert('Geocode was not successful for the following reason: ' + status);
      }
  });
}
google.maps.event.addDomListener(window, 'resize', initialize);
google.maps.event.addDomListener(window, 'load', initialize);
}

function CustomMarker(latlng, map, args) {
	this.latlng = latlng;	
	this.args = args;	
	this.setMap(map);	
}

CustomMarker.prototype = new google.maps.OverlayView();
CustomMarker.prototype.draw = function() {
	var self = this;
	var div = this.div;	
	if (!div) {
		div = this.div = document.createElement('div');	
		div.className = 'pin bounce';
		div.style.position = 'absolute';
		div.style.cursor = 'pointer';
    innerDiv = document.createElement('div');
		innerDiv.className = 'pulse';
		div.appendChild(innerDiv);		
		if (typeof(self.args.marker_id) !== 'undefined') {
			div.dataset.marker_id = self.args.marker_id;
		}
		
		google.maps.event.addDomListener(div, "click", function(event) {
			alert('You clicked on a custom marker!');			
			google.maps.event.trigger(self, "click");
		});
		
		var panes = this.getPanes();
		panes.overlayImage.appendChild(div);
	}
	
	var point = this.getProjection().fromLatLngToDivPixel(this.latlng);
	
	if (point) {
		div.style.left = (point.x - 10) + 'px';
		div.style.top = (point.y - 20) + 'px';
	}
};

CustomMarker.prototype.remove = function() {
	if (this.div) {
		this.div.parentNode.removeChild(this.div);
		this.div = null;
	}	
};

CustomMarker.prototype.getPosition = function() {
	return this.latlng;	
};