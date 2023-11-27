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
        $descripcion = $_POST["descripcion"];

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
            $sql_actualizar = "UPDATE datos_empresa SET descripcion = :descripcion WHERE registro_id = :registro_id";
            $stmt_actualizar = $conexion->prepare($sql_actualizar);
            $stmt_actualizar->bindParam(':descripcion', $descripcion);
            $stmt_actualizar->bindParam(':registro_id', $registro_id);

            if ($stmt_actualizar->execute()) {
                echo '<script type="text/javascript">
                        alert("Descripción de la empresa actualizada con éxito");
                        window.location.href = "../modificar_datos.php";
                      </script>';
                exit;
            } else {
                echo "Error al actualizar la descripción de la empresa.";
            }
        } else {
            // Si no existen datos, muestra un mensaje de error
            echo "No se encontraron datos de empresa para actualizar la ahora.";
        }
    } catch (PDOException $ex) {
        echo "Error al almacenar los datos en la base de datos: " . $ex->getMessage();
    }
}
?>
