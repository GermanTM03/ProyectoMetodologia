<!DOCTYPE html>
<html>
<head>
  <title>Obtener Latitud y Longitud de un Marcador - Google Maps API</title>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXgHRpfbWc77RiiA9ns4Wgo5Ea2SDSR0E"></script>
  <script src="./JavaScript/maps.js"></script>
</head>
<body>
  <div id="map" style="height: 400px; width: 50%;"></div>
  <label for="lat">Latitud:</label>
  <input type="text" id="lat" readonly><br>
  <label for="lng">Longitud:</label>
  <input type="text" id="lng" readonly><br>
  <button onclick="centerMapToUserLocation()">Mi Ubicación</button>
  <script>initMap();</script>
</body>
</html>
