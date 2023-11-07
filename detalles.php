<?php
try {
    require_once('./includes/conexion.php');

    // Obtener el valor del ID desde la URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Consulta SQL para seleccionar los campos especificados del lugar de interés con el ID proporcionado
        $sql = "SELECT nombre, historia, longitud, latitud, imagen_url FROM LugaresInteres WHERE id = :id";
    
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
            echo "<p>Longitud: " . $row['longitud'] . "</p>";
            echo "<p>Latitud: " . $row['latitud'] . "</p>";
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
