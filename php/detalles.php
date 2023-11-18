<?php
try {
    require_once('../includes/conexion.php');

    // Obtener el valor del ID desde la URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Consulta SQL para seleccionar los campos especificados del lugar de interés con el ID proporcionado
        $sql = "SELECT nombre_comercial, descripcion, latitud, longitud, imagen FROM datos_empresa WHERE id = :id";
    
        // Preparar y ejecutar la consulta
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            echo "<h1>Detalles del Lugar de Interés</h1>";
            echo "<h2>Nombre: " . $row['nombre_comercial'] . "</h2>";
            echo "<p>Historia: " . $row['descripcion'] . "</p>";
            echo "<img src='" . $row['imagen'] . "' alt='Imagen del lugar'>";
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
        var latitud = <?= $row['latitud'] ?>; // Obtener la latitud
        var longitud = <?= $row['longitud'] ?>; // Obtener la longitud

        var coordenadas = { lat: latitud, lng: longitud };

        var mapa = new google.maps.Map(document.getElementById('map'), {
            center: coordenadas,
            zoom: 20  // Puedes ajustar el nivel de zoom según tus preferencias
        });

        // Marcador en las coordenadas
        var marcador = new google.maps.Marker({
            position: coordenadas,
            map: mapa,
            title: 'Ubicación de ejemplo'
        });
    }
</script>
    
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXgHRpfbWc77RiiA9ns4Wgo5Ea2SDSR0E&callback=initMap"></script>
