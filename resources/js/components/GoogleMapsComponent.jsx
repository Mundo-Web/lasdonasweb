import React, { useEffect, useRef } from 'react';

const GoogleMapsComponent = ({ managezipCode }) => {
  const mapRef = useRef(null);
  const markerRef = useRef(null);

  useEffect(() => {
    if (!window.google) {
      console.error('Google Maps JavaScript API not loaded');
      return;
    }

    const mapElement = document.getElementById('map');
    const inputElement = document.getElementById('pac-input');

    if (!mapElement || !inputElement) {
      console.error('Map or input element not found');
      return;
    }

    if (!mapRef.current) {
      mapRef.current = new window.google.maps.Map(mapElement, {
        center: { lat: -12.121, lng: -77.029 },
        zoom: 11,
      });
    }

    const autocomplete = new window.google.maps.places.Autocomplete(inputElement);

    const placeMarker = (location) => {
      if (markerRef.current) {
        markerRef.current.setPosition(location);
      } else {
        markerRef.current = new window.google.maps.Marker({
          position: location,
          map: mapRef.current,
        });
      }
    };

    autocomplete.addListener('place_changed', () => {
      console.log('place_changed event triggered');
      const place = autocomplete.getPlace();
      if (place.geometry) {
        mapRef.current.setCenter(place.geometry.location);
        placeMarker(place.geometry.location);

        // Obtener el código postal
        let postalCode = '';
        for (const component of place.address_components) {
          if (component.types.includes('postal_code')) {
            postalCode = component.long_name;
            break;
          }
        }

        // Pasar el lugar y el código postal a la función managezipCode
        managezipCode(place, postalCode);
      }
    });

    mapRef.current.addListener('click', (event) => {
      console.log('map click event triggered');
      const location = event.latLng;
      placeMarker(location);

      // Usar el servicio Geocoder para obtener la dirección y el código postal
      const geocoder = new window.google.maps.Geocoder();
      geocoder.geocode({ location: location }, (results, status) => {
        if (status === 'OK' && results[0]) {
          const place = results[0];
          let postalCode = '';
          for (const component of place.address_components) {
            if (component.types.includes('postal_code')) {
              postalCode = component.long_name;
              break;
            }
          }
          managezipCode(place, postalCode);
          console.log('Geocoder results:', place, postalCode);
        }
      });
    });

    console.log('Event listeners added');
  }, [managezipCode]);

  return (
    <div>
      <input id="pac-input" className="controls w-full mb-5 gap-2 self-stretch px-6 py-4 mt-4  text-sm tracking-wide rounded-3xl border border-solid border-stone-300 max-md:px-5 max-md:max-w-full" type="text" placeholder="Ingresa una ubicacion" />
      <div id="map" style={{ height: '400px', width: '100%' }}></div>
    </div>
  );
};

export default GoogleMapsComponent;