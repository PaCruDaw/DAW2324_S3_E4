// Verificar si la cookie de aceptación de política está establecida
$(document).ready(function () {
    if (!getCookie('policyAccepted')) {
        // La cookie no está establecida, mostrar el aviso de cookies
        $('#cookie-notice').fadeIn();
    }
});

// Manejar el clic en el botón de aceptar cookies
$('#accept-cookies').click(function () {
    // Establecer la cookie de aceptación de política
    setCookie('policyAccepted', 'true', 365);
    
    // Lógica para establecer la cookie de idioma solo si se aceptan las condiciones
    if (getCookie('policyAccepted')) {
        var userLanguage = navigator.language || navigator.userLanguage;
        if (!getCookie('lang')) {
            if (userLanguage === "es-ES") {
                setCookie('lang', 'ESP', 365);
            } else if (userLanguage === "ca-CA") {
                setCookie('lang', 'CAT', 365);
            } else {
                setCookie('lang', 'ENG', 365);
            }
        }
    }

    // Ocultar el aviso de cookies
    $('#cookie-notice').fadeOut();

    // Recargar la página
    location.reload();
});

// Función auxiliar para obtener el valor de una cookie por nombre
function getCookie(nombre) {
    const valor = `; ${document.cookie}`;
    const partes = valor.split(`; ${nombre}=`);
    if (partes.length === 2) return partes.pop().split(';').shift();
}

// Función auxiliar para establecer una cookie
function setCookie(nombre, valor, dias) {
    const fecha = new Date();
    fecha.setTime(fecha.getTime() + (dias * 24 * 60 * 60 * 1000));
    const expira = `expires=${fecha.toUTCString()}`;
    document.cookie = `${nombre}=${valor}; ${expira}; path=/`;
}