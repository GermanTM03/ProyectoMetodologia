document.getElementById('empresaLink').addEventListener('click', function(e) {
    e.preventDefault(); // Previene el comportamiento por defecto del enlace
    var opciones = document.getElementById('opcionesEmpresa');
    if (opciones.style.display === 'none' || opciones.style.display === '') {
        opciones.style.display = 'flex';
    } else {
        opciones.style.display = 'none';
    }
});


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

  

