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
    <form action="./php/save.php" method="POST">
        <label for="nombre">Nombre Comercial</label>
        <input type="text" name="nombre" id="nombre" required><br><br>
    
        <label for="email">Correo Electrónico</label>
        <input type="email" name="email" id="email" required><br><br>
    
        <label for="tel">Número de Teléfono</label>
        <input type="tel" name="tel" id="tel" required><br><br>
    
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required><br><br>
    
        <label for="confirm_password">Repetir Contraseña</label>
        <input type="password" name="confirm_password" id="confirm_password" required><br><br>
    
        <input type="submit" value="Enviar">
    </form>
    

</body>
</html>
