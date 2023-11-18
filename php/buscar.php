<?php
try {
    require_once('../includes/conexion.php');

    // Obtener el valor de la consulta desde la solicitud AJAX
    if (isset($_GET['query'])) {
        $query = htmlspecialchars($_GET['query']); // Validar y limpiar el valor

        // Consulta SQL para seleccionar los elementos que coinciden con la consulta
        $sql = "SELECT id, nombre_comercial, imagen FROM datos_empresa WHERE nombre_comercial LIKE :query";

        // Preparar y ejecutar la consulta
        $stmt = $conexion->prepare($sql);
        $parametro = '%' . $query . '%'; // Usar comodines para buscar resultados parciales
        $stmt->bindParam(':query', $parametro, PDO::PARAM_STR);
        $stmt->execute();

        // Obtener los resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($resultados) > 0) {
            echo "<ul>";
            foreach ($resultados as $row) {
                $nombre = $row['nombre_comercial'];
                $imagen_url = $row['imagen'];
                $id = $row['id'];

                // Agregar un enlace con el id del elemento
                echo "<h2>Nombre: $nombre</h2>";
                echo "<img src='$imagen_url' alt='Imagen del lugar'>"; 
             echo "<a href='./php/detalles.php?id=$id'>Ver detalles</a>";
                echo "<br>";
            }
            echo "</ul>";
        } else {
            echo "<p>No se encontraron resultados para '$query'.</p>";
        }
    } else {
        echo "<p>Consulta no especificada en la solicitud AJAX.</p>";
    }
} catch (PDOException $ex) {
    echo "<p>Error al consultar la base de datos: " . $ex->getMessage() . "</p>";
}
?>
