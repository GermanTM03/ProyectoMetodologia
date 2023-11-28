document.addEventListener("DOMContentLoaded", function() {
    var input = document.getElementById("bucaid");
    var mostrarMas = document.getElementById("mostrarMas");

    mostrarMas.addEventListener("click", function(event) {
        var valorInput = input.value.trim();

        if (valorInput === "") {
            event.preventDefault();
            alert("Ingresa un término de búsqueda");
        } else {
            mostrarMas.href = "./php/Mostrar.php?lugar=" + encodeURIComponent(valorInput);
            // Realizar la redirección después de actualizar el href
            window.location.href = mostrarMas.href;
        }
    });
});
