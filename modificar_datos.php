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
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXgHRpfbWc77RiiA9ns4Wgo5Ea2SDSR0E"></script>
  <script src="./JavaScript/maps.js"></script>
</head>
<body>
<header class="bar">
        <a class="img" href="./index.html">
            <img src="https://github.com/Darkseson12/Proyecto-R/blob/main/pymenfinder.png?raw=true" alt="pymenfinder">
        </a>
        <div class="box_nav">
            
        </div>
    </header>




<div class="cerrar_sesion">

<h2>Bienvenido</h2>
<h2>
        <?php echo isset($datos_actuales['propietario']) ? $datos_actuales['propietario'] : ''; ?>
        </h2>
        <div class="salir_btn">

            <form action="./php/logout.php" method="POST">
                <input id="Salir_perfil" type="submit" name="cerrar_sesion" value="Cerrar Sesión">
            </form>
        </div>
</div>

</div>



<section class="Perfil_Empresa">
    
    <div class="Perfil_Datos">


        <div class="Imagen_Perfil">
        <?php
    if (!empty($datos_actuales['imagen'])) {
        echo '<img class="imagen-perfil" src="data:image/*;base64,' . base64_encode($datos_actuales['imagen']) . '" alt="Imagen actual">';
    } else {
        echo '<p>No hay imagen disponible</p>';
    }
    ?>
        </div>

        <div class="Datos_Perfil">
            
        <h2>
        <?php echo isset($datos_actuales['nombre_comercial']) ? $datos_actuales['nombre_comercial'] : ''; ?>
        </h2>
        <form action="./php/Modificar_foto.php" method="post" enctype="multipart/form-data">
        <div class="Botones_perfil">
    <label for="nueva_imagen" class="input-file-label">
        <input type="file" name="nueva_imagen" id="nueva_imagen" accept="image/*" class="input-file">
        Seleccionar foto
    </label>
    <input type="submit" value="Guardar" class="submit-button">
</div>

         </form>

        </div>


    </div>

    
    <div class="Imagenes_E">  
        <h3>Descripcion</h3>

    <form action="./php/Descripcion.php" method="POST" enctype="multipart/form-data">

        <textarea name="descripcion" id="descripcion" required><?php echo isset($datos_actuales['descripcion']) ? $datos_actuales['descripcion'] : ''; ?></textarea><br><br>
        <input  type="submit" value="Guardar">

        </form>
    </div>
</section>


<section class="Datos_Lugar">

<div class="Datos_Form">
    <div class="Form_box">
    <h2>Tus Datos A Mostrar</h2>

    <form action="./php/modifica_empresa.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="nombre_comercial" id="nombre_comercial" placeholder="Nombre Comercial" required value="<?php echo isset($datos_actuales['nombre_comercial']) ? $datos_actuales['nombre_comercial'] : ''; ?>"><br><br>
        
            <input type="email" name="correo_electronico" id="correo_electronico" placeholder="Correo Electronico" required value="<?php echo isset($datos_actuales['correo_electronico']) ? $datos_actuales['correo_electronico'] : ''; ?>"><br><br>
        
            <input type="tel" name="telefono" id="telefono"  placeholder="Telefono Del Local" required value="<?php echo isset($datos_actuales['telefono']) ? $datos_actuales['telefono'] : ''; ?>"><br><br>
        
            <input type="text" name="ubicacion" id="ubicacion"  placeholder="Donde Se Ubica" required value="<?php echo isset($datos_actuales['ubicacion']) ? $datos_actuales['ubicacion'] : ''; ?>"><br><br>
        
            <input type="text" name="propietario" id="propietario"  placeholder="Propietario" required value="<?php echo isset($datos_actuales['propietario']) ? $datos_actuales['propietario'] : ''; ?>"><br><br>
    
         <input type="hidden" id="lat" name="latitud" readonly>
        <input type="hidden" id="lng" name="longitud" readonly>
        
        
            <input id="Boton_Datos" type="submit" value="Guardar">
        </form>
</div>
</div>

<div class="Maps_Lugar">
<div id="map" style="height: 350px; width: 100%;"></div>

  <button id="BTN_MAPS" onclick="centerMapToUserLocation()">Mi Ubicación</button>
 
</div>


</section>













  <script>initMap();</script>

</body>
</html>
