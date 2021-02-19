var Map;

(function ($) {

    Map = {
        map:null,
        markers:[],
        init:function (config) {

            var settings = {
                lat_selector:'#lat',
                long_selector:'#long',
                default_lat:50.443513052458044,
                default_long:30.498046875,
                edit_zoom:12,
                pick_zoom:7,
                onComplete:false
            };

            if (window.parent.$.coordinate_picker && window.parent.$.coordinate_picker.settings) {
                $.extend(settings, window.parent.$.coordinate_picker.settings);
            }

            //todo: save this in coockies
            var zoom = settings.edit_zoom; // town level

            var coord_lat = 0, coord_long = 0;
            // try to load coords from inputs
            var v;
            if ($(settings.long_selector, window.parent.document).length) {
                coord_long = parseFloat($(settings.long_selector, window.parent.document).attr('value')) || 0;
            }

            if ($(settings.lat_selector, window.parent.document).length) {
                coord_lat = parseFloat($(settings.lat_selector, window.parent.document).attr('value')) || 0;
            }

            // Kyiv Coords
            if (Math.abs(coord_lat) < 0.0000000001 && Math.abs(coord_long) < 0.0000000001) {
                coord_lat = settings.default_lat;
                coord_long = settings.default_long;
                zoom = settings.pick_zoom; // counry level
            }


            console.log(window.location.hash);
            if (google.maps.ClientLocation) {
                zoom = 12;
                coord_lat = google.maps.ClientLocation.latitude;
                coord_long = google.maps.ClientLocation.longitude;
            }

            var latlng = new google.maps.LatLng(coord_lat, coord_long);

            var options = {
                zoom:zoom,
                center:latlng,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };

            Map.map = new google.maps.Map($('#map_canvas').get(0), options);

            google.maps.event.addListener(Map.map, 'dragend', Map.update_marker);
            google.maps.event.addListener(Map.map, 'zoom_changed', Map.update_marker);


            var geocoderService = new google.maps.Geocoder();
            Map.add_marker(latlng);
            Map.update();

            $('#search_map').focus();
            $('#search_map').input_hint();

            $('#search_address_button').click(function () {
                $(this).parents('form').submit();
            });

            $('#search_map_form').submit(function (e) {
                e.preventDefault();
                geocoderService.geocode({'address':$('#search_map').val()}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {

                        var latlng = results[0].geometry.location;
                        Map.add_marker(latlng);
                        Map.update();
                        Map.map.fitBounds(results[0].geometry.viewport);
                    }
                    else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
                        alert('Address not found');
                    }
                    else {
                        alert('Address lookup failed');
                    }
                });

            });

            $('#select_coords_button').click(function (e) {
                var coords = {'lat':$('#lat').val(), 'long':$('#long').val()};
                if ($(settings.long_selector, window.parent.document).length) {
                    $(settings.long_selector, window.parent.document).attr('value', coords.long);
                }

                if ($(settings.lat_selector, window.parent.document).length) {
                    $(settings.lat_selector, window.parent.document).attr('value', coords.lat);
                }
                if ($.isFunction(settings.onComplete)) {
                    settings.onComplete(coords);
                }
                // If using smodal box, close it.
                if (window.parent.$.smodal) {
                    window.parent.$.smodal.close();
                }
                // try closing this window
                else {
                    window.self.close();
                }
            });

        },

        add_marker:function (latlng) {
            Map.reset_markers();

            var marker = new google.maps.Marker({
                map:Map.map,
                position:latlng,
                draggable:true
            });

            Map.markers.push(marker);
            google.maps.event.addListener(marker, 'dragend', function (e) {
                Map.map.panTo(e.latLng);
                Map.update();
            });

            return marker;
        },

        reset_markers:function () {
            if (Map.markers) {
                for (i in Map.markers) {
                    Map.markers[i].setMap(null);
                }
                Map.markers = [];
            }
        },

        update_marker:function () {
            var latlng = Map.map.getCenter();
            Map.add_marker(latlng);
            Map.update();
        },

        update:function () {
            var marker = Map.markers[0];
            var markerLatLng = marker.getPosition();

            var lat = markerLatLng.lat(), lng = markerLatLng.lng();
            $('#long').val(lng);
            $('#lat').val(lat);
            $('#on_long').text(lng.toFixed(3));
            $('#on_lat').text(lat.toFixed(3));
        }

    };


})(jQuery);

jQuery(function ($) {
    Map.init();
});
