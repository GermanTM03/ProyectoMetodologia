<!DOCTYPE html>
<html>
<head>
    <title>Mapa de Google</title>
    <!-- Reemplaza 'TU_CLAVE_DE_API' con tu clave de API de Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCSGqr3iWtatierUX06POxHAWTByyl16s"></script>
</head>
<body>
    <h1>Mapa de Google</h1>
    
    <div id="map" style="width: 100%; height: 400px;"></div>

    <script>
        function initMap() {
            // Coordenadas de ejemplo (puedes cambiarlas)
            var coordenadas = { lat: 20.6534, lng: -87.0708 };

            var mapa = new google.maps.Map(document.getElementById('map'), {
                center: coordenadas,
                zoom: 12  // Puedes ajustar el nivel de zoom según tus preferencias
            });

            // Marcador en las coordenadas
            var marcador = new google.maps.Marker({
                position: coordenadas,
                map: mapa,
                title: 'Ubicación de ejemplo'
            });
        }
    </script>
    
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCSGqr3iWtatierUX06POxHAWTByyl16s&callback=initMap"></script>
</body>
</html>
