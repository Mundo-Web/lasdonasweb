import React, { useEffect, useRef } from 'react';

const GoogleMapsComponent = ({ managezipCode, addressRef, datosFinales }) => {
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

    const autocomplete = new window.google.maps.places.Autocomplete(inputElement, {
      componentRestrictions: { country: 'pe' },
      bounds: new window.google.maps.LatLngBounds(
        new window.google.maps.LatLng(-12.200, -77.150), // Suroeste de Lima y Callao
        new window.google.maps.LatLng(-11.800, -76.850)  // Noreste de Lima y Callao
      ),
      strictBounds: true
    });

    const placeMarker = (location) => {
      const lat = location.lat() || 0;
      const lng = location.lng() || 0;
      if (markerRef.current) {
        markerRef.current.setPosition(location);
      } else {
        markerRef.current = new window.google.maps.Marker({
          position: { lat, lng },
          map: mapRef.current,
        });
      }
    };

    // autocomplete.addListener('place_changed', () => {
    //   const place = autocomplete.getPlace();
    //   if (place.geometry) {
    //     mapRef.current.setCenter(place.geometry.location);
    //     placeMarker(place.geometry.location);
    //   }
    // });

    autocomplete.addListener('place_changed', () => {

      const place = autocomplete.getPlace();
      if (place.geometry) {
        mapRef.current.setCenter(place.geometry.location);
        placeMarker(place.geometry.location);

        // Obtener el cÃ³digo postal
        let postalCode = '';
        for (const component of place.address_components) {
          if (component.types.includes('postal_code')) {
            postalCode = component.long_name;
            break;
          }
        }

        // Pasar el lugar y el cÃ³digo postal a la funciÃ³n managezipCode

        managezipCode(place, postalCode);
      }
    });

    mapRef.current.addListener('click', (event) => {
      const location = event.latLng;
      placeMarker(location);

      const lat = location.lat() || 0;
      const lng = location.lng() || 0;

      // Usar el servicio Geocoder para obtener la dirección y el código postal
      const geocoder = new window.google.maps.Geocoder();
      geocoder.geocode({ location: { lat, lng } }, (results, status) => {
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
        }
      });
    });
  }, [managezipCode]);

  useEffect(() => {
    // if (!datosFinales?.address?.id) return;

    const lat = Number(datosFinales.address?.coordinates?.latitude);
    const lng = Number(datosFinales.address?.coordinates?.longitude);
    const position = { lat, lng };

    // Borrar el marcador anterior, si existe
    if (markerRef.current) {
      markerRef.current.setMap(null);
    }

    // Crear el nuevo marcador
    if (lat != 0 || lng != 0) {
      markerRef.current = new window.google.maps.Marker({
        position,
        map: mapRef.current,
      });
      mapRef.current.setCenter(position);
    } else if (lat == 0 && lng == 0) {
      markerRef.current = new window.google.maps.Marker({
        map: mapRef.current,
      });
      mapRef.current.setCenter({
        lat: -12.121,
        lng: -77.029
      });
    }

    // Enfocar el mapa en la posición del nuevo marcador

  }, [datosFinales]);


  return (
    <div>
      <input id="pac-input" className="controls w-full mb-5 gap-2 self-stretch px-6 py-4 mt-4  text-sm tracking-wide rounded-2xl border border-solid border-stone-300 max-md:px-5 max-md:max-w-full" type="text" placeholder="Ingresa una ubicacion" />
      <div id="map" style={{ height: '400px', width: '100%' }}></div>
    </div>
  );
};

export default GoogleMapsComponent;