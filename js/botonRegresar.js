// Obtener el elemento div
var icon = document.getElementById("icon");

// Función para actualizar el icono según el ancho de la pantalla
function updateIcon() {
  var screenWidth = window.innerWidth;
  if (screenWidth <= 760) {
    icon.innerHTML = "<button onclick='history.back()' name='regresar'><i class='bi bi-arrow-90deg-left'></i></button>";
  } else {
    icon.innerHTML = "<button onclick='history.back()' name='regresar'><i class='bi bi-arrow-90deg-left'></i> Regresar</button>"
  }
}

// Ejecutar la función al cargar la página
updateIcon();

// Ejecutar la función cada vez que cambia el tamaño de la pantalla
window.addEventListener("resize", function() {
  updateIcon();
});