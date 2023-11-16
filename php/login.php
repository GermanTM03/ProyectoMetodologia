<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Recopilar los datos del formulario
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Conexión a la base de datos (usando PDO)
        require_once('../includes/conexion.php'); // Asegúrate de incluir tu archivo de parámetros

        // Consulta SQL para obtener la contraseña almacenada asociada al correo electrónico
        $sql = "SELECT contrasena FROM registro WHERE correo_electronico = :email";

        // Preparar la consulta
        $stmt = $conexion->prepare($sql);

        // Enlazar el parámetro con el valor
        $stmt->bindParam(':email', $email);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar la contraseña
        if ($resultado && password_verify($password, $resultado['contrasena'])) {
            // Contraseña válida, el usuario ha iniciado sesión con éxito
            echo '<script type="text/javascript">
                    alert("Inicio de sesión exitoso");
                    window.location.href = "../index.html"; // Redirigir a la página de inicio
                  </script>';
            exit;
        } else {
            echo "Correo electrónico o contraseña incorrectos.";
        }
    } catch (PDOException $ex) {
        echo "Error al realizar la consulta: " . $ex->getMessage();
    }
}
?>
