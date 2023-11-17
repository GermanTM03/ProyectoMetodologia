<?php
session_start(); // Inicia la sesión si no se ha iniciado aún

// Cierra la sesión actual
session_destroy();

// Redirige a alguna página después de cerrar la sesión
header("Location: ../index.html"); // Cambia "index.php" por la página a la que quieras redirigir
exit();
?>
