document.getElementById('btnAbrirPopup').addEventListener('click', abrirPopup);

function abrirPopup() {
    document.getElementById('miPopup').style.display = 'block';
}

function cerrarPopup() {
    document.getElementById('miPopup').style.display = 'none';
}



function validarFormulario() {
    // Obtener los valores de los campos
    var nombre = document.getElementById('nombre').value.trim();
    var apellido = document.getElementById('apellido').value.trim();
    var email = document.getElementById('email').value.trim();
    var contrasena = document.getElementById('contrasena').value.trim();
    var username = document.getElementById('username').value.trim();
    var es_admin = document.getElementById('es_admin').value;

    // Validar que los campos no estén vacíos
    if (nombre === '') {
        mostrarError('error-nombre', 'El nombre es obligatorio');
        return false; // Detener el envío del formulario
    } else {
        ocultarError('error-nombre');
    }

    if (apellido === '') {
        mostrarError('error-apellido', 'El apellido es obligatorio');
        return false;
    } else {
        ocultarError('error-apellido');
    }

    if (email === '') {
        mostrarError('error-email', 'El correo electrónico es obligatorio');
        return false;
    } else {
        ocultarError('error-email');
    }

    if (contrasena === '') {
        mostrarError('error-contrasena', 'La contraseña es obligatoria');
        return false;
    } else {
        ocultarError('error-contrasena');
    }

    if (username === '') {
        mostrarError('error-username', 'El nombre de usuario es obligatorio');
        return false;
    } else {
        ocultarError('error-username');
    }

    if (es_admin === '') {
        mostrarError('error-es_admin', 'Selecciona si es administrador o no');
        return false;
    } else {
        ocultarError('error-es_admin');
    }


    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Correo electrónico inválido');
        return false; // Detener el envío del formulario
    }

    return true; // Permitir el envío del formulario
}

function mostrarError(id, mensaje) {
    var elementoError = document.getElementById(id);
    elementoError.innerHTML = mensaje;
    elementoError.style.color = 'red';
}

function ocultarError(id) {
    var elementoError = document.getElementById(id);
    elementoError.innerHTML = ''; // Limpiar el mensaje de error
    elementoError.style.color = 'initial';
}