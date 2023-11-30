<?php
try {
    require_once('../includes/conexion.php');

    // Obtener el valor del ID desde la URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Consulta SQL para seleccionar los campos especificados del lugar de interés con el ID proporcionado
        $sql = "SELECT nombre_comercial, descripcion,ubicacion, latitud, telefono, correo_electronico, longitud, imagen FROM datos_empresa WHERE id = :id";

        // Preparar y ejecutar la consulta
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $ex) {
    echo "Error al consultar la base de datos: " . $ex->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PYME</title>
    <link rel="stylesheet" href="../css/pyme.css">
    <link rel="stylesheet" href="../css/fooder.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="shortcut icon" href="../assets/LOGOPAGE.png" type="image/x-icon">

</head>
<body>
<header class="Header">
    <a class="img" href="../index.html">
        <img src="https://github.com/Darkseson12/Proyecto-R/blob/main/pymenfinder.png?raw=true" alt="pymenfinder">
    </a>
    <div class="opciones" id="opciones">
        
        <a id="btn" class="btn"href="../index">Inicio</a>
        <a id="back" class="back" href="javascript:history.go(-1)">Regresar</a>
    </div>
</header>

   

<!-- Telefono -->

<?php if ($row): ?>
    <section class="contenedor_detallesT" >
    


       
<div class="imagen_contenidot" id="imagen_contenido" >

     <?php if ($row['imagen']): ?>
                    <img class="imagen-perfil" src="data:image/*;base64,<?= base64_encode($row['imagen']) ?>" alt="Imagen actual">
             <?php else: ?>
                    <p>No se encontró ninguna imagen para este lugar de interés.</p>
             <?php endif; ?>
 </div>
 <div class="textot">

<h2>' <?= $row['nombre_comercial'] ?>'</h2>
<div class="linea"></div>
</div>
<div class="des">
<p> <?= $row['descripcion'] ?></p>

</div>
<div class="Box_Contactot">

<div class="Contacto">
    <h2>Contacto</h2>
</div>

<div class="Telefono">

                <div class="icono">
                    <i class="fa-solid fa-phone fa-2x"  style="color: #ffffff;"></i>

                </div>
                <div class="Contenido_contactos">

                    <h3>Telefono</h3>
                    <p><?= $row['telefono'] ?></p>
                </div>
</div>
<div class="Telefono">

                <div class="icono">
                <i class="fa-solid fa-envelope fa-2x" style="color: #fcfcfc;"></i> <!-- Cuádruple del tamaño original -->

                </div>
                <div class="Contenido_contactos">

                    <h3>Correo</h3>
                    <p><?= $row['correo_electronico'] ?></p>                </div>
</div>
<div class="Telefono">

                <div class="icono">
                <i class="fa-solid fa-location-dot fa-2x" style="color: #ffffff;"></i>

                </div>
                <div class="Contenido_contactos">

                    <h3>Ubicacion</h3>
                    <p> <?= $row['ubicacion'] ?></p>                </div>
</div>

</div>






</div>

<div class="UBI">
    <h2>Nuestra ubicacion</h2>
</div>
    </section>
<?php else: ?>
    <p>No se encontraron resultados para el ID proporcionado.</p>
<?php endif; ?>



<!-- PC -->
<?php if ($row): ?>
    <section class="contenedor_detalles" id="contenedor_detalles">
        <div class="box_uno" id="box_uno">
            <div class="imagen_contenido" >

                <?php if ($row['imagen']): ?>
                    <img class="imagen-perfil" src="data:image/*;base64,<?= base64_encode($row['imagen']) ?>" alt="Imagen actual">
                <?php else: ?>
                    <p>No se encontró ninguna imagen para este lugar de interés.</p>
                <?php endif; ?>
            </div>

            <div class="Box_Contacto">

                <div class="Contacto_Tx">
                    
                    <h2>Contacto</h2>
                </div>
                <div class="Info_box">
                    
                <div class="Telefono_box">

                    <i class="fa-solid fa-phone fa-2x"  style="color: #ffffff;"></i>
                    <p><?= $row['telefono'] ?></p>
                </div>
                
                <div class="Correo_box">
                    
                    <i class="fa-solid fa-envelope fa-2x" style="color: #fcfcfc;"></i> <!-- Cuádruple del tamaño original -->
                    <p><?= $row['correo_electronico'] ?></p>
                    
                </div>
                
                <div class="Ubi_box">
                    <i class="fa-solid fa-location-dot fa-2x" style="color: #ffffff;"></i>
                    <p> <?= $row['ubicacion'] ?></p>
                </div>
                
            </div>
            </div>
        </div>
<div class="box_dos" id="box2">
    <div class="texto">

        <h2>' <?= $row['nombre_comercial'] ?>'</h2>
        <p> <?= $row['descripcion'] ?></p>
    </div>
    <div class="mapa" >

        <div id="map" style="width: 80%; height: 400px;"></div>
    </div>

</div>
    </section>
<?php else: ?>
    <p>No se encontraron resultados para el ID proporcionado.</p>
<?php endif; ?>





<!-- Maps -->

<script>
    function initMap() {
        <?php if ($row): ?>
            var latitud = <?= $row['latitud'] ?>;
            var longitud = <?= $row['longitud'] ?>;
            var coordenadas = { lat: latitud, lng: longitud };

            var mapa = new google.maps.Map(document.getElementById('map'), {
                center: coordenadas,
                zoom: 20
            });

            var marcador = new google.maps.Marker({
                position: coordenadas,
                map: mapa,
                title: 'Ubicación de ejemplo'
            });
        <?php endif; ?>
    }
</script>



<footer class="footer">
        <div class="container">
            <div class="rights">
                <p>Todos los derechos reservados © 2023</p>
            </div>
            <div class="university">
                <p>Universidad Tecnológica de Cancún</p>
            </div>
            <div class="members">
                <p>Integrantes:</p>
                <ul>
                    <li>Torres Matos German</li>
                    <li>Hernández Córdova Yadira
                    </li>
                    <li> Vasquez Rodríguez Gabriel Jairo </li>
                    <li>Mendez Torres Odalys</li>
                </ul>
            </div>
        </div>
    </footer>


<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXgHRpfbWc77RiiA9ns4Wgo5Ea2SDSR0E&callback=initMap"></script>

</body>
</html>
