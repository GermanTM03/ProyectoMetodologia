<?php
try {
    require_once('./includes/conexion.php');

    // Obtener el valor del lugar desde la URL
    if (isset($_GET['lugar'])) {
        $lugar = $_GET['lugar'];

        // Consulta SQL para seleccionar los elementos con el nombre del lugar
        $sql = "SELECT nombre, imagen_url FROM LugaresInteres WHERE estados = :lugar";
    
        // Preparar y ejecutar la consulta
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':lugar', $lugar, PDO::PARAM_STR);
        $stmt->execute();

        // Obtener los resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($resultados) > 0) {
            echo "<h1>Resultados para $lugar</h1>";
            foreach ($resultados as $row) {
                echo "<h2>Nombre: " . $row['nombre'] . "</h2>";
                echo "<img src='" . $row['imagen_url'] . "' alt='Imagen del lugar'>";
                echo "<br>";
            }
        } else {
            echo "No se encontraron resultados para $lugar.";
        }
    } else {
        echo "Lugar no especificado en la URL.";
    }
} catch (PDOException $ex) {
    echo "Error al consultar la base de datos: " . $ex->getMessage();
}
?>
