function cambiarIdioma(event,idioma) {
    event.preventDefault();
    // Realizar la petición AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../controladores/traductor.php?lang=' + idioma, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Manejar la respuesta JSON
            var respuesta = JSON.parse(xhr.responseText);
            if (respuesta.success) {
                // Recargar la página o actualizar dinámicamente el contenido según tus necesidades
                location.reload(); // Recargar la página en este ejemplo
            } else {
                alert('Error al cambiar el idioma: ' + respuesta.message);
            }
        }
    };
    xhr.send();
}