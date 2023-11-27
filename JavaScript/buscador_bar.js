// Espera a que el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function() {
    // Obtener referencia al input y al enlace
    var input = document.getElementById("bucaid");
    var mostrarMas = document.getElementById("mostrarMas");

    // Agregar un evento al hacer clic en el enlace
    mostrarMas.addEventListener("click", function(event) {
        // Obtener el valor del input
        var valorInput = input.value;
        
        // Actualizar el atributo href del enlace con el valor del input
        mostrarMas.href = "../php/Mostrar.php?lugar=" + valorInput;
        
        // Otra opción para abrir la URL después de actualizar el href
        // window.location.href = mostrarMas.href;
    });
});
