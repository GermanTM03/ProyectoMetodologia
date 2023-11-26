<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    // El usuario no ha iniciado sesión, redirigir a la página de inicio de sesión o mostrar un mensaje de error
    header("Location: ./ruta_a_tu_pagina_de_inicio_de_sesion.php");
    exit;
}

// Obtener el ID del usuario de la sesión
$registro_id = $_SESSION['usuario_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Recopilar los datos del formulario
        $nombre_comercial = $_POST["nombre_comercial"];
        $correo_electronico = $_POST["correo_electronico"];
        $telefono = $_POST["telefono"];
        $ubicacion = $_POST["ubicacion"];
        $propietario = $_POST["propietario"];
        $latitud = $_POST["latitud"]; // Obtener la latitud del formulario
        $longitud = $_POST["longitud"]; // Obtener la longitud del formulario

        // Conexión a la base de datos (usando PDO)
        require_once('../includes/conexion.php'); // Asegúrate de incluir tu archivo de parámetros

        // Verificar si existen datos de la empresa para este registro_id
        $consulta_existencia = "SELECT id FROM datos_empresa WHERE registro_id = :registro_id";
        $stmt_existencia = $conexion->prepare($consulta_existencia);
        $stmt_existencia->bindParam(':registro_id', $registro_id);
        $stmt_existencia->execute();
        $datos_existentes = $stmt_existencia->fetch();

        if ($datos_existentes) {
            // Si ya existen datos, actualiza los existentes
            $sql_actualizar = "UPDATE datos_empresa SET nombre_comercial = :nombre_comercial, correo_electronico = :correo_electronico, telefono = :telefono, ubicacion = :ubicacion, propietario = :propietario, latitud = :latitud, longitud = :longitud WHERE registro_id = :registro_id";
            $stmt_actualizar = $conexion->prepare($sql_actualizar);
            $stmt_actualizar->bindParam(':nombre_comercial', $nombre_comercial);
            $stmt_actualizar->bindParam(':correo_electronico', $correo_electronico);
            $stmt_actualizar->bindParam(':telefono', $telefono);
            $stmt_actualizar->bindParam(':ubicacion', $ubicacion);
            $stmt_actualizar->bindParam(':propietario', $propietario);
            $stmt_actualizar->bindParam(':latitud', $latitud); // Vincular la latitud
            $stmt_actualizar->bindParam(':longitud', $longitud); // Vincular la longitud
            $stmt_actualizar->bindParam(':registro_id', $registro_id);

            if ($stmt_actualizar->execute()) {
                echo '<script type="text/javascript">
                        alert("Datos de la empresa actualizados con éxito");
                        window.location.href = "../modificar_datos.php";
                      </script>';
                exit;
            } else {
                echo "Error al actualizar los datos de la empresa.";
            }
        } else {
            // Si no existen datos, realiza una inserción
            $sql_insertar = "INSERT INTO datos_empresa (registro_id, nombre_comercial, correo_electronico, telefono, ubicacion, propietario, latitud, longitud)         
            VALUES (:registro_id, :nombre_comercial, :correo_electronico, :telefono, :ubicacion, :propietario, :latitud, :longitud)";
            $stmt_insertar = $conexion->prepare($sql_insertar);
            $stmt_insertar->bindParam(':registro_id', $registro_id);
            $stmt_insertar->bindParam(':nombre_comercial', $nombre_comercial);
            $stmt_insertar->bindParam(':correo_electronico', $correo_electronico);
            $stmt_insertar->bindParam(':telefono', $telefono);
            $stmt_insertar->bindParam(':ubicacion', $ubicacion);
            $stmt_insertar->bindParam(':propietario', $propietario);
            $stmt_insertar->bindParam(':latitud', $latitud); // Vincular la latitud
            $stmt_insertar->bindParam(':longitud', $longitud); // Vincular la longitud

            if ($stmt_insertar->execute()) {
                echo '<script type="text/javascript">
                        alert("Datos de la empresa guardados con éxito");
                        window.location.href = "../modificar_datos.php";
                      </script>';
                exit;
            } else {
                echo "Error al insertar los datos de la empresa.";
            }
        }
    } catch (PDOException $ex) {
        echo "Error al almacenar los datos en la base de datos: " . $ex->getMessage();
    }
}
?>
