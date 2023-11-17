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

// Obtener los datos actuales si existen en la base de datos para el usuario en sesión
$datos_actuales = [];
try {
    require_once('./includes/conexion.php'); // Asegúrate de incluir tu archivo de parámetros

    // Consultar los datos actuales en la tabla datos_empresa para el usuario en sesión
    $consulta_datos = "SELECT * FROM datos_empresa WHERE registro_id = :registro_id";
    $stmt_datos = $conexion->prepare($consulta_datos);
    $stmt_datos->bindParam(':registro_id', $registro_id);
    $stmt_datos->execute();
    $datos_actuales = $stmt_datos->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    echo "Error al obtener los datos de la empresa: " . $ex->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de la Empresa</title>
    <link rel="stylesheet" href="./css/StylesForm.css">
</head>
<body>
    <h1>Formulario - Datos de la Empresa</h1>
    <form action="./php/modifica_empresa.php" method="POST" enctype="multipart/form-data">
        <label for="nombre_comercial">Nombre Comercial</label>
        <input type="text" name="nombre_comercial" id="nombre_comercial" required value="<?php echo isset($datos_actuales['nombre_comercial']) ? $datos_actuales['nombre_comercial'] : ''; ?>"><br><br>
    
        <label for="correo_electronico">Correo Electrónico</label>
        <input type="email" name="correo_electronico" id="correo_electronico" required value="<?php echo isset($datos_actuales['correo_electronico']) ? $datos_actuales['correo_electronico'] : ''; ?>"><br><br>
    
        <label for="telefono">Número de Teléfono</label>
        <input type="tel" name="telefono" id="telefono" required value="<?php echo isset($datos_actuales['telefono']) ? $datos_actuales['telefono'] : ''; ?>"><br><br>
    
        <label for="ubicacion">Ubicación</label>
        <input type="text" name="ubicacion" id="ubicacion" required value="<?php echo isset($datos_actuales['ubicacion']) ? $datos_actuales['ubicacion'] : ''; ?>"><br><br>
    
        <label for="propietario">Propietario</label>
        <input type="text" name="propietario" id="propietario" required value="<?php echo isset($datos_actuales['propietario']) ? $datos_actuales['propietario'] : ''; ?>"><br><br>
    
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion" required><?php echo isset($datos_actuales['descripcion']) ? $datos_actuales['descripcion'] : ''; ?></textarea><br><br>
    
        <!-- Input para el archivo de imagen -->
        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" id="imagen"><br><br>
    
        <input type="submit" value="Enviar">
    </form>


            <!-- HTML del botón destructor -->
<form action="./php/logout.php" method="POST">
    <input type="submit" name="cerrar_sesion" value="Cerrar Sesión">
</form>
</body>
</html>
