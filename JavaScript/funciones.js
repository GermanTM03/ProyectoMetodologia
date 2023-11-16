function toggleIcon() {
    var queryInput = document.getElementById('query');
    var searchIcon = document.getElementById('search-icon');
  
    if (queryInput.value.trim() !== '') {
      searchIcon.style.display = 'none';
    } else {
      searchIcon.style.display = 'inline-block';
    }
  
    }


  /* Nav */

  function search() {
    var query = $("#query").val().trim();

    // Ocultar el contenedor si el campo de búsqueda está vacío
    if (query === '') {
        $("#results-container").hide();
    } else {
        $.ajax({
            type: "GET",
            url: "./php/buscar.php",
            data: { query: query },
            success: function (response) {
                // Mostrar el contenedor solo si hay resultados
                if (response.trim() !== '') {
                    $("#results-container").html(response).show();
                } else {
                    $("#results-container").hide();
                }
            },
            error: function (error) {
                console.error("Error en la solicitud AJAX: " + error.responseText);
            }
        });
    }
}

