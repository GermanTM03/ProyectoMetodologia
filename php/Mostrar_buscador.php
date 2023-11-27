<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="stylesheet" href="../css/detalles.css">
</head>
<body>
<header class="Bar_Buscador">
        <a class="img" href="../index.html">
            <img src="https://github.com/Darkseson12/Proyecto-R/blob/main/pymenfinder.png?raw=true" alt="pymenfinder">
        </a>
        <div class="Buscador_Text">
        <input id="bucaid" type="text">
        <div class="boton_buscar">
            <a href="#" id="mostrarMas">Buscar</a>

        </div>
    </div>
    </header>

    <div class="Respuesta">

    </div>



<?php
try {
    require_once('../includes/conexion.php');

    // Obtener el valor del lugar desde la URL
    if (isset($_GET['lugar'])) {
        $lugar = $_GET['lugar'];

        // Consulta SQL para seleccionar los elementos con similitudes en el nombre del lugar
        $sql = "SELECT id, nombre_comercial, imagen FROM datos_empresa WHERE nombre_comercial LIKE :lugar";
    
        // Preparar y ejecutar la consulta
        $stmt = $conexion->prepare($sql);
        $parametro = "%$lugar%"; // Agregar comodines para buscar similitudes antes y después del valor
        $stmt->bindParam(':lugar', $parametro, PDO::PARAM_STR);
        $stmt->execute();

        // Obtener los resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($resultados) > 0) {
            echo "<h1>Resultados para: $lugar</h1>";
            foreach ($resultados as $row) {
                $nombre = $row['nombre_comercial'];
                $imagen = $row['imagen'];
                $id = $row['id'];

                // Agregar un enlace con el id del elemento
                echo "<div class='Box_Contenido' style='background-image: url(data:image/*;base64," . base64_encode($imagen) . ")'>";
                echo "<div class='Box_ContenidoF'>";
                echo "<h2>$lugar</h2>";

                echo "<h2>'$nombre'</h2>";
                echo "<a href='./detalles.php?id=$id'>Ver detalles</a>";
                echo "<br>";
                echo "</div>";
                echo "</div>";

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
<script src="../JavaScript/buscador_bar.js"></script>
   
</body>
</html>