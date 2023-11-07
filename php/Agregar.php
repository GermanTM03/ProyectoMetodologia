<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Estados</title>
    <link rel="stylesheet" href="./css/StylesForm.css">
</head>
<body>
    <h1>Formulario</h1>
    <form action="../php/save.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required><br><br>
        
        <label for="imagen_url">URL de la Imagen:</label>
        <input type="text" name="imagen_url" id="imagen_url" required><br><br>

        <label for="coordenadas">Coordenadas (ejemplo: 21.158008, -86.839792):</label>
        <input type="text" name="coordenadas" id="coordenadas" required><br><br>

        <label for="ubicacion">Ubicación General:</label>
        <input type="text" name="ubicacion" id="ubicacion" required><br><br>

        <label for="historia">Historia:</label>
        <textarea name="historia" id="historia" rows="5" required></textarea><br><br>

        <label for="estados">Estados de México:</label>
        <select name="estados" id="estados" style="height: auto;">
            <option value="Aguascalientes">Aguascalientes</option>
            <option value="Baja California">Baja California</option>
            <option value="Baja California Sur">Baja California Sur</option>
            <option value="Quintana Roo">Quintana Roo</option>
            <option value="Yucatan">Yucatán</option>
            <option value="Campeche">Campeche</option>
            <!-- Agrega opciones para todos los estados de México aquí -->
        </select><br><br>

        <input type="submit" value="Enviar">
    </form>

    <script src="./JavaScript/Seleccionar.js"></script>
</body>
</html>
