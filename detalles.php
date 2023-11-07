<?php
try {
    require_once('./includes/conexion.php');

    // Obtener el valor del ID desde la URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Consulta SQL para seleccionar los campos especificados del lugar de interés con el ID proporcionado
        $sql = "SELECT nombre, historia, coordenadas, imagen_url FROM LugaresInteres WHERE id = :id";
    
        // Preparar y ejecutar la consulta
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            echo "<h1>Detalles del Lugar de Interés</h1>";
            echo "<h2>Nombre: " . $row['nombre'] . "</h2>";
            echo "<p>Historia: " . $row['historia'] . "</p>";
            echo "<img src='" . $row['imagen_url'] . "' alt='Imagen del lugar'>";
        } else {
            echo "No se encontraron resultados para el ID proporcionado.";
        }
    } else {
        echo "ID no especificado en la URL.";
    }
} catch (PDOException $ex) {
    echo "Error al consultar la base de datos: " . $ex->getMessage();
}
?>

<!-- Maps -->
<h1>Mapa de Google</h1>
    
<div id="map" style="width: 100%; height: 400px;"></div>

<script>
    function initMap() {
        var coordenadas = "<?= $row['coordenadas'] ?>"; // Obtener las coordenadas como una cadena
        var coordenadasArray = coordenadas.split(', '); // Dividir las coordenadas en un array

        var latitud = parseFloat(coordenadasArray[0]);
        var longitud = parseFloat(coordenadasArray[1]);

        var coordenadas = { lat: latitud, lng: longitud };

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
