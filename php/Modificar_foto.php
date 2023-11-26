<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ./ruta_a_tu_pagina_de_inicio_de_sesion.php");
    exit;
}

$registro_id = $_SESSION['usuario_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if ($_FILES['nueva_imagen']['size'] > 0) {
            $imagen = $_FILES['nueva_imagen'];

            $nombre_temporal = $imagen['tmp_name'];

            require_once('../includes/conexion.php');

            $sql_actualizar_imagen = "UPDATE datos_empresa SET imagen = :imagen WHERE registro_id = :registro_id";
            $stmt_actualizar_imagen = $conexion->prepare($sql_actualizar_imagen);
            $stmt_actualizar_imagen->bindParam(':registro_id', $registro_id);
            $stmt_actualizar_imagen->bindParam(':imagen', file_get_contents($nombre_temporal));

            if ($stmt_actualizar_imagen->execute()) {
                echo '<script type="text/javascript">
                        alert("Imagen de empresa actualizada con éxito");
                        window.location.href = "../modificar_datos.php";
                      </script>';
                exit;
            } else {
                echo "Error al actualizar la imagen de la empresa.";
            }
        } else {
            echo "Por favor, seleccione una imagen.";
        }
    } catch (PDOException $ex) {
        echo "Error al almacenar los datos en la base de datos: " . $ex->getMessage();
    }
}
?>
