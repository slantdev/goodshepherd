import { MDCSelect } from '@material/select';
import { MDCTextField } from '@material/textfield';
import { MDCLinearProgress } from '@material/linear-progress';

export function initServiceLocator() {
    const $ = window.jQuery;
    if (!$) return;

    if (!$('.service_locator-wrap').length) return;

    /**
     * Declare Variables
     */
    let radius_circle;
    let geocoder;
    let markers = [];
    let centerMarker = [];
    let map;
    let markerClusterer;
    let mapCenter = { lat: -24.25, lng: 133.416667 };
    let radius_km = 50;
    let location_distance;
    
    // Asset Paths (Adjusted for new theme structure if needed, or keeping relative)
    // The reference used '/wp-content/themes/goodshep/assets/...'. 
    // I should probably use a dynamic path or relative to site root if possible.
    // Or updated hardcoded paths to the new theme folder 'goodshepherd'.
    let themePath = '/wp-content/themes/goodshepherd'; // Updated folder name
    let markerImage = themePath + '/assets/images/gs_marker.png';
    let centerMarkerImage = themePath + '/assets/images/markerclusterer/bluedot48.png';

    // Helpers
    var addToSessionStorageArray = function (name, value) {
        var existing = sessionStorage.getItem(name);
        existing = existing ? existing.split(',') : [];
        existing.push(value);
        sessionStorage.setItem(name, existing.toString());
    };

    var addToSessionStorageObject = function (name, key, value) {
        var existing = sessionStorage.getItem(name);
        existing = existing ? JSON.parse(existing) : {};
        existing[key] = value;
        sessionStorage.setItem(name, JSON.stringify(existing));
    };

    function setMapHeight() {
        const site_header_height = $('.site-header').outerHeight();
        // const site_nav_height = $('.site-nav').outerHeight(); // Might be inside header now
        const service_locator_form_height = $('.service_locator-form').outerHeight();
        const service_locator_infobar_height = $('#service_locator-info_bar').outerHeight();
        
        // Calculate available height
        // Adjust calculation based on new layout
        const map_height = $(window).height() - site_header_height; 
        
        $('#services-map').css('height', map_height + 'px');
        $('.service_locator-sidebar').css('height', 'auto');
        $('#service_locator-list').css('height', 'auto');

        if (window.matchMedia('(min-width: 992px)').matches) {
            $('.service_locator-sidebar').css('height', map_height + 'px');
            $('#service_locator-list').css(
                'height',
                map_height - service_locator_form_height - service_locator_infobar_height + 'px'
            );
            $('#service_locator-list').show();
            $('.service_locator-map').show();
        }
    }

    setMapHeight();
    $(window).resize(function () {
        setMapHeight();
    });

    // Initialize Map
    window.initMap = function() { // Expose to global for Google Maps callback if needed, though we call it on load
        const mapStyle = [
            { elementType: 'geometry', stylers: [{ color: '#f5f5f5' }] },
            { elementType: 'labels.icon', stylers: [{ visibility: 'off' }] },
            { elementType: 'labels.text.fill', stylers: [{ color: '#616161' }] },
            { elementType: 'labels.text.stroke', stylers: [{ color: '#f5f5f5' }] },
            { featureType: 'administrative', elementType: 'geometry', stylers: [{ visibility: 'off' }] },
            { featureType: 'administrative.land_parcel', elementType: 'labels.text.fill', stylers: [{ color: '#bdbdbd' }] },
            { featureType: 'poi', stylers: [{ visibility: 'off' }] },
            { featureType: 'road', elementType: 'geometry', stylers: [{ color: '#ffffff' }] },
            { featureType: 'road', elementType: 'labels.icon', stylers: [{ visibility: 'off' }] },
            { featureType: 'water', elementType: 'geometry', stylers: [{ color: '#c9c9c9' }] },
            { featureType: 'water', elementType: 'labels.text.fill', stylers: [{ color: '#9e9e9e' }] }
        ];

        map = new google.maps.Map(document.getElementById('services-map'), {
            zoom: 5,
            minZoom: 4,
            maxZoom: 18,
            center: mapCenter,
            styles: mapStyle,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false,
            streetViewControl: false,
            fullscreenControl: false,
            zoomControl: true,
            zoomControlOptions: { position: google.maps.ControlPosition.TOP_RIGHT },
        });

        geocoder = new google.maps.Geocoder();
        let initMapCenter = map.getCenter();
        let providerJson = '/wp-json/wp/v2/service_provider?status=publish';
        putMarkers('', providerJson, initMapCenter);

        $('#service_locator-list').hide();
        serviceLocatorList(providerJson);
        postcodeAutocomplete(providerJson);

        // Reset Session Storage
        sessionStorage.removeItem('service_locator');
        addToSessionStorageObject('service_locator', 'provider_data', providerJson);
        addToSessionStorageObject('service_locator', 'service_category', '');
        addToSessionStorageObject('service_locator', 'pin_address', '');
    }

    // Load Map on Window Load (or immediately if ready)
    if (typeof google !== 'undefined' && google.maps) {
        initMap();
    } else {
        window.addEventListener('load', initMap);
    }

    // Put Markers
    function putMarkers(type, serviceProvider, pinLatLng, radius) {
        let linearProgress = new MDCLinearProgress(document.querySelector('#provider-list-linear-progress'));
        $('#provider-list-linear-progress').animate({ opacity: 1 }, 500);
        $('#service_locator-info_bar').empty();

        $.getJSON(serviceProvider, function (data) {
            let centerDot = new google.maps.Marker({
                position: pinLatLng,
                map: map,
                icon: centerMarkerImage,
                zIndex: 10000,
            });
            centerMarker.push(centerDot);

            let num = 0;
            let nearby_provider_obj = [];

            $.each(data, function (key, value) {
                let provider_id = value.id;
                let locations = value.acf.locations;

                $.each(locations, function (key, location) {
                    let location_row = key;
                    let lat = location.map.lat;
                    let lng = location.map.lng;
                    let latLng = new google.maps.LatLng(lat, lng);
                    let location_name = location.location_site_name;
                    let location_city = location.map.city;
                    let location_postcode = location.map.post_code;

                    if (type == 'nearby') {
                        let distance_from_location = google.maps.geometry.spherical.computeDistanceBetween(pinLatLng, latLng);
                        if (distance_from_location <= radius * 1000) {
                            let list_provider_obj = {
                                id: provider_id,
                                distance: distance_from_location,
                                latitude: lat,
                                longitude: lng,
                                location_row: location_row,
                                location_name: location_name,
                                location_city: location_city,
                                location_postcode: location_postcode,
                            };
                            nearby_provider_obj.push(list_provider_obj);
                            createMarker(latLng, provider_id, location_row);
                            num++;
                        }
                    } else {
                        let distance_from_location = google.maps.geometry.spherical.computeDistanceBetween(pinLatLng, latLng);
                        let list_provider_obj = {
                            id: provider_id,
                            distance: distance_from_location,
                            latitude: lat,
                            longitude: lng,
                            location_row: location_row,
                            location_name: location_name,
                            location_city: location_city,
                            location_postcode: location_postcode,
                        };
                        nearby_provider_obj.push(list_provider_obj);
                        createMarker(latLng, provider_id, location_row);
                        num++;
                    }
                });
            });

            var nearby_provider = nearby_provider_obj.sort((a, b) => a.distance > b.distance ? 1 : -1);

            nearby_provider.forEach((element) => {
                serviceProviderItem(
                    element.id,
                    element.location_row,
                    element.location_name,
                    element.location_city,
                    element.location_postcode,
                    element.distance
                );
            });

            if (typeof MarkerClusterer !== 'undefined') {
                markerClusterer = new MarkerClusterer(map, markers, {
                    imagePath: themePath + '/assets/images/markerclusterer/mc',
                });
                markerClusterer.setStyles(
                    markerClusterer.getStyles().map(function (style) {
                        style.textColor = '#fff';
                        return style;
                    })
                );
                markerClusterer.addMarkers(markers);
            }

            if (type == 'nearby') {
                let text = num === 1 ? 'There is 1 service provider nearby' : (num > 1 ? 'There are ' + num + ' service provider(s) nearby' : 'Sorry, no service providers found.');
                $('#service_locator-info_bar').html(text);
            } else {
                $('#service_locator-info_bar').html('Showing ' + num + ' Service Providers');
            }

        }).done(function (data) {
            $('#provider-list-linear-progress').animate({ opacity: 0 }, 500);
        });
    }

    function createMarker(latLng, provider_id, location_row) {
        let marker = new google.maps.Marker({
            position: latLng,
            map: map,
            icon: markerImage,
        });
        markers.push(marker);
        google.maps.event.addListener(marker, 'click', function (evt) {
            map.panTo(marker.getPosition());
            serviceLocatorPane(provider_id, location_row);
        });
    }

    function getNearestSitesRadius(serviceProvider, pinLatLng, radiusKm) {
        let res = 0;
        let radius = radiusKm;
        for (let i = 0; res < 1; i++) {
            $.ajax({
                url: serviceProvider,
                async: false,
                success: function (data) {
                    let count = 0;
                    $.each(data, function (key, value) {
                        let locations = value.acf.locations;
                        $.each(locations, function (key, location) {
                            let lat = location.map.lat;
                            let lng = location.map.lng;
                            let latLng = new google.maps.LatLng(lat, lng);
                            let distance = google.maps.geometry.spherical.computeDistanceBetween(pinLatLng, latLng);
                            if (distance <= radius * 1000) {
                                count++;
                            }
                        });
                    });
                    res = count;
                    if (res == 0) {
                        radius = radius + 50;
                    } else {
                        res = 1;
                    }
                },
            });
        }
        return radius;
    }

    function serviceLocatorList(serviceProvider) {
        let linearProgress = new MDCLinearProgress(document.querySelector('#provider-list-linear-progress'));
        $('#provider-list-linear-progress').animate({ opacity: 1 }, 500);
        $.getJSON(serviceProvider, function (data) {
            $.each(data, function (key, value) {
                const provider_id = value.id;
                const locations = value.acf.locations;
                $.each(locations, function (key, location) {
                    const location_row = key;
                    const location_name = location.location_site_name;
                    const location_city = location.map.city;
                    const location_postcode = location.map.post_code;
                    serviceProviderItem(provider_id, location_row, location_name, location_city, location_postcode, location_distance);
                });
            });
        }).done(function (data) {
            $('#provider-list-linear-progress').animate({ opacity: 0 }, 500);
        });
    }

    function serviceProviderItem(provider_id, location_row, location_name, location_city, location_postcode, location_distance) {
        let distStr = '';
        if (location_distance) {
            let distKm = location_distance / 1000;
            distStr = '<span class="inline-block">&nbsp;&nbsp;|&nbsp;&nbsp;~' + distKm.toFixed(2) + ' km</span>';
        }
        let provider_item =
            '<a class="provider-link w-full px-8 py-8 flex text-default no-underline border-b" href="#" data-id="' + provider_id + '" data-location="' + location_row + '">' +
            '<div class="flex-auto">' +
            '<h4 class="text-lg font-bold mb-2">' + location_name + '</h4>' +
            '<p class="text-base mb-0 text-gray-500"><span class="inline-block">' + location_city + ', ' + location_postcode + '</span>' + distStr + '</p>' +
            '</div>' +
            '<div class="flex-none"><span class="material-icons">&#xe315</span></div>' +
            '</a>';
        $('#service_locator-list').append(provider_item);
    }

    $(document).on('click', '.provider-link', function (e) {
        e.preventDefault();
        let data_id = $(this).data('id');
        let data_row = $(this).data('location');
        serviceLocatorPane(data_id, data_row);
    });

    function serviceLocatorPane(provider_id, location_row) {
        $('.service_locator-details').addClass('open');
        $('body').addClass('overflow-hidden');
        let linearProgress = new MDCLinearProgress(document.querySelector('#provider-details-linear-progress'));
        $('#provider-details-linear-progress').animate({ opacity: 1 }, 500);

        $.getJSON('/wp-json/wp/v2/service_provider/' + provider_id, function (data) {}).done(function (data) {
            const loc = data.acf.locations[location_row];
            const title = loc.location_site_name;
            const content = data.content.rendered;
            
            // Build Content HTML (Simplified for brevity, matches logic)
            let html = '<div class="px-8 py-8 border-b">';
            if (title) html += '<h4 class="text-lg font-bold mb-2">' + title + '</h4>';
            if (loc.map.post_code) html += '<p class="text-base mb-0 text-gray-500">' + loc.map.city + ', ' + loc.map.post_code + '</p>';
            
            html += '<div class="block text-base mt-4">';
            // Phone, Email, Address, Hours... (Ported logic)
            if (loc.phone) html += `<div class="flex mb-2"><div class="flex-none mr-2"><span class="material-icons text-purple">&#xe0b0</span></div><div class="flex-auto"><a href="tel:${loc.phone.replace(/\s/g, '')}" class="text-body no-underline hover:text-red hover:underline">${loc.phone}</a></div></div>`;
            if (loc.email) html += `<div class="flex mb-2"><div class="flex-none mr-2"><span class="material-icons text-purple">&#xe0e6</span></div><div class="flex-auto"><a href="mailto:${loc.email}" class="text-body no-underline hover:text-red hover:underline">${loc.email}</a></div></div>`;
            if (loc.map.address) html += `<div class="flex mb-2"><div class="flex-none mr-2"><span class="material-icons text-purple">&#xe0c8</span></div><div class="flex-auto">${loc.map.address}</div></div>`;
            
            // Hours
            const hours = loc.opening_hours;
            if (Object.values(hours).some(h => h)) {
                html += '<div class="flex"><div class="flex-none mr-2"><span class="material-icons text-purple">&#xe924</span></div><div class="flex-auto">';
                ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'].forEach(day => {
                    if (hours[day]) html += `<div class="flex"><div class="w-1/3 pr-2 capitalize">${day}</div><div class="w-2/3">${hours[day]}</div></div>`;
                });
                html += '</div></div>';
            }
            html += '</div></div>';
            
            if (content) html += '<div class="px-8 py-8 text-base">' + content + '</div>';
            
            $('#panel_content').html(html);

            // Footer Buttons
            $('#panel_footer').empty();
            let dirLink = 'https://www.google.com/maps/dir/?api=1&destination=' + encodeURIComponent(loc.map.address);
            $('#panel_footer').append(`<a href="${dirLink}" target="_blank" class="text-purple leading-tight no-underline inline-block py-2 px-6 rounded border border-purple mx-1">Get Directions</a>`);
            if (loc.learn_more_link) {
                $('#panel_footer').append(`<a href="${loc.learn_more_link}" target="_blank" class="text-white leading-tight no-underline inline-block py-2 px-6 rounded border border-purple bg-purple mx-1">Learn More</a>`);
            }

            $('#provider-details-linear-progress').animate({ opacity: 0 }, 500);
        });
    }

    $('.service_locator-details_overlay, #service_locator-close_panel').click(function (e) {
        e.preventDefault();
        $('.service_locator-details').removeClass('open');
        $('body').removeClass('overflow-hidden');
        $('#panel_content').empty();
        $('#panel_footer').empty();
    });

    $('#view-as-list').click(function (e) {
        e.preventDefault();
        $(this).addClass('active');
        $('#view-on-map').removeClass('active');
        $('#service_locator-list').show();
        $('.service_locator-map').hide();
    });
    $('#view-on-map').click(function (e) {
        e.preventDefault();
        $(this).addClass('active');
        $('#view-as-list').removeClass('active');
        $('#service_locator-list').hide();
        $('.service_locator-map').show();
    });

    // MDC Components
    const selectEl = document.querySelector('.mdc-select');
    if (selectEl) {
        const select = new MDCSelect(selectEl);
        select.listen('MDCSelect:change', () => {
            let service_provider_category = `${select.value}`;
            let providerJson = '/wp-json/wp/v2/service_provider?status=publish' + (service_provider_category ? '&service_provider_category=' + service_provider_category : '');
            
            addToSessionStorageObject('service_locator', 'service_category', service_provider_category);
            addToSessionStorageObject('service_locator', 'provider_data', providerJson);

            if (radius_circle) {
                radius_circle.setMap(null);
                radius_circle = null;
            }
            deleteMarkers();
            markerClusterer.clearMarkers();
            $('#service_locator-list').empty().hide();
            $('#input-postcode').focus();

            let markCenter = map.getCenter();
            putMarkers('', providerJson, markCenter);
            map.setCenter(mapCenter);
            map.panTo(mapCenter);
            map.setZoom(5);
        });
    }

    const textFieldEl = document.querySelector('.mdc-text-field');
    if (textFieldEl) {
        new MDCTextField(textFieldEl);
    }

    function postcodeAutocomplete(serviceProvider) {
        const input = document.getElementById('input-postcode');
        const autocomplete = new google.maps.places.Autocomplete(input, {
            types: ['(regions)'],
            componentRestrictions: { country: 'au' },
        });

        autocomplete.addListener('place_changed', () => {
            $('#provider-list-linear-progress').animate({ opacity: 1 }, 500);
            let address = $('#input-postcode').val();
            let sessionObj = JSON.parse(sessionStorage.getItem('service_locator'));
            let providerJson = sessionObj.provider_data;
            const place = autocomplete.getPlace();
            if (!place.place_id) return;

            addToSessionStorageObject('service_locator', 'provider_data', providerJson);
            addToSessionStorageObject('service_locator', 'pin_address', address);
            $('#service_locator-list').show();
            showNearbySites(providerJson, address);
        });
    }

    function showNearbySites(serviceProvider, address) {
        if (radius_circle) {
            radius_circle.setMap(null);
            radius_circle = null;
        }
        deleteMarkers();
        markerClusterer.clearMarkers();
        $('#service_locator-list').empty();

        if (geocoder) {
            geocoder.geocode({ address: address }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK && status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                    let pinLatLng = results[0].geometry.location;
                    let radius = getNearestSitesRadius(serviceProvider, pinLatLng, radius_km);
                    
                    radius_circle = new google.maps.Circle({
                        center: pinLatLng,
                        radius: radius * 1000,
                        strokeColor: '#B86AAB',
                        strokeOpacity: 0.6,
                        strokeWeight: 2,
                        fillColor: '#B86AAB',
                        fillOpacity: 0.1,
                        clickable: false,
                        map: map,
                    });
                    map.fitBounds(radius_circle.getBounds());
                    putMarkers('nearby', serviceProvider, pinLatLng, radius);
                }
            });
        }
    }

    function setMapOnAll(map) {
        for (let i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
        for (let x = 0; x < centerMarker.length; x++) {
            centerMarker[x].setMap(map);
        }
    }

    function hideMarkers() {
        setMapOnAll(null);
    }

    function deleteMarkers() {
        hideMarkers();
        markers = [];
    }
}