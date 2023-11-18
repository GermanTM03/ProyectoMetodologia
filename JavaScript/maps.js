let map;
let marker;
let latInput;
let lngInput;

function initMap() {
  const cancunLatLng = { lat: 21.1619, lng: -86.8515 }; // Coordenadas de Cancún, México

  map = new google.maps.Map(document.getElementById("map"), {
    center: cancunLatLng,
    zoom: 12,
  });

  marker = new google.maps.Marker({
    position: cancunLatLng,
    map: map,
    draggable: true // Permite arrastrar el marcador
  });

  latInput = document.getElementById("lat");
  lngInput = document.getElementById("lng");

  // Evento al soltar el marcador
  marker.addListener('dragend', function() {
    const position = marker.getPosition(); // Obtiene la posición del marcador
    latInput.value = position.lat(); // Actualiza el valor del campo de entrada de latitud
    lngInput.value = position.lng(); // Actualiza el valor del campo de entrada de longitud
  });

  // Evento al hacer doble clic en el mapa
  google.maps.event.addListener(map, 'dblclick', function(event) {
    marker.setPosition(event.latLng); // Coloca el marcador en la posición del doble clic
    latInput.value = event.latLng.lat(); // Actualiza el valor del campo de entrada de latitud
    lngInput.value = event.latLng.lng(); // Actualiza el valor del campo de entrada de longitud
  });

  // Obtener la ubicación actual del usuario
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      const userLatLng = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      map.setCenter(userLatLng);
      marker.setPosition(userLatLng);
      latInput.value = userLatLng.lat;
      lngInput.value = userLatLng.lng;
    }, function() {
      console.error('Error: The Geolocation service failed.');
    });
  } else {
    console.error('Error: Your browser doesn\'t support geolocation.');
  }
}

function centerMapToUserLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      const userLatLng = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      map.setCenter(userLatLng);
      marker.setPosition(userLatLng);
      latInput.value = userLatLng.lat;
      lngInput.value = userLatLng.lng;
    }, function() {
      console.error('Error: The Geolocation service failed.');
    });
  } else {
    console.error('Error: Your browser doesn\'t support geolocation.');
  }
}