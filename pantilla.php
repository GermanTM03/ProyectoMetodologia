<!DOCTYPE html>
<html>
<head>
    <title>Mapa de Google con Coordenadas Personalizadas</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=TU_CLAVE_DE_API"></script>
</head>
<body>
    <h1>Ingresa tus coordenadas:</h1>
    <form action="" method="post">
        Latitud: <input type="text" name="latitud" id="latitud">
        Longitud: <input type="text" name="longitud" id="longitud">
        <input type="submit" value="Mostrar Mapa">
    </form>
    
    <div id="map" style="width: 100%; height: 400px;"></div>

    <script>
        function initMap() {
            var mapa = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 0, lng: 0 },
                zoom: 8
            });

            // Verifica si se enviaron coordenadas desde el formulario
            var latitud = parseFloat(document.getElementById('latitud').value);
            var longitud = parseFloat(document.getElementById('longitud').value);

            if (!isNaN(latitud) && !isNaN(longitud) && latitud >= -90 && latitud <= 90 && longitud >= -180 && longitud <= 180) {
                var miCoordenada = { lat: latitud, lng: longitud };

                mapa.setCenter(miCoordenada);

                var marcador = new google.maps.Marker({
                    position: miCoordenada,
                    map: mapa,
                    title: 'Tu Ubicación'
                });
            }
        }
    </script>
    
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=TU_CLAVE_DE_API&callback=initMap"></script>
</body>
</html>
