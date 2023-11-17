<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Recopilar los datos del formulario
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $tel = $_POST["tel"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // Verificar si las contraseñas coinciden
        if ($password !== $confirm_password) {
            echo "Las contraseñas no coinciden.";
            exit;
        }

        // Conexión a la base de datos (usando PDO)
        require_once('../includes/conexion.php'); // Asegúrate de incluir tu archivo de parámetros

        // Consulta SQL para insertar datos en la tabla registro
        $sql = "INSERT INTO registro (nombre_comercial, correo_electronico, telefono, contrasena)         
        VALUES (:nombre, :email, :tel, :password)";

        // Preparar la consulta
        $stmt = $conexion->prepare($sql);

        // Enlazar los parámetros con los valores
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tel', $tel);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashed_password); // Guardar la contraseña de forma segura

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redireccionar a la página de éxito
            echo '<script type="text/javascript">
                    alert("Registro realizado con éxito");
                    window.location.href = "../index.html";
                  </script>';
            exit;
        } else {
            echo "Error al ejecutar la consulta.";
        }
    } catch (PDOException $ex) {
        echo "Error al almacenar los datos en la base de datos: " . $ex->getMessage();
    }
}
?>
