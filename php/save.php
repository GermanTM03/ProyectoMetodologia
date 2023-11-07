<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Recopilar los datos del formulario
        $nombre = $_POST["nombre"];
        $coordenadas = $_POST["coordenadas"]; // Modificamos la variable para las coordenadas
        $ubicacion = $_POST["ubicacion"];
        $historia = $_POST["historia"];
        $estado = $_POST["estados"];
        $imagen_url = $_POST["imagen_url"]; // Agregamos la URL de la imagen

        // Conexión a la base de datos (usando PDO)
        require_once('../includes/conexion.php'); // Asegúrate de incluir tu archivo de parámetros

        // Consulta SQL para insertar datos en la tabla LugaresInteres
        $sql = "INSERT INTO LugaresInteres (nombre, ubicacion, historia, estados, imagen_url, coordenadas)         
        VALUES (:nombre, :ubicacion, :historia, :estado, :imagen_url, :coordenadas)";

        // Preparar la consulta
        $stmt = $conexion->prepare($sql);

        // Enlazar los parámetros con los valores
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ubicacion', $ubicacion);
        $stmt->bindParam(':historia', $historia);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':imagen_url', $imagen_url);
        $stmt->bindParam(':coordenadas', $coordenadas); // Enlazamos las coordenadas

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Datos almacenados correctamente en la base de datos.";
        } else {
            echo "Error al ejecutar la consulta.";
        }
    } catch (PDOException $ex) {
        echo "Error al almacenar los datos en la base de datos: " . $ex->getMessage();
    }
}
?>
