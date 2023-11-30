<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="stylesheet" href="../css/detalles.css">
    <link rel="stylesheet" href="../css/fooder.css">

    <link rel="shortcut icon" href="../assets/LOGOPAGE.png" type="image/x-icon">

</head>
<body>
<header class="Bar_Buscador">
        <a class="img" href="../index.html">
            <img src="https://github.com/Darkseson12/Proyecto-R/blob/main/pymenfinder.png?raw=true" alt="pymenfinder">
        </a>
       
       <div class="Buscador_Text">
    <input id="bucaid" type="text">
    <div class="sugerencias"></div>
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
?>
            <div class='Resultado_Buscar'>
                <h1><?php echo $lugar; ?></h1>
            </div>
            
            <section class="MegaBox">
<?php
            foreach ($resultados as $row) {
                $nombre = $row['nombre_comercial'];
                $imagen = $row['imagen'];
                $id = $row['id'];
?>

                <div class='Box_Contenido' id="Box_Contenido" style='background-image: url(data:image/*;base64,<?php echo base64_encode($imagen); ?>)'>
                    <div class='Box_ContenidoF'>
                    <h2><?php echo $lugar; ?></h2>

                        <h2>'<?php echo $nombre; ?>'</h2>
                        <a href='./detalles.php?id=<?php echo $id; ?>'>Ver detalles</a>
                        <br>
                    </div>
                </div>
<?php
            }
?>
            </section>
<?php
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