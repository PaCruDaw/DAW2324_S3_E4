function escapeHTML(text) {
    const parser = new DOMParser();
    const doc = parser.parseFromString(text, 'text/html');
    return doc.body.textContent || "";
}

document.addEventListener('DOMContentLoaded', function () {
    const formularios = document.querySelectorAll('form[name="form_traducciones"]');
    
    formularios.forEach(function (formulario) {
        const nombreInput = formulario.querySelector('#nuevatraduccion');
        const nombreError = formulario.querySelector('#voidError');

        nombreInput.addEventListener('blur', function () {
            const nombreValue = nombreInput.value.trim();
            const sanitizedValue = escapeHTML(nombreValue);

            if (nombreValue === '') {
                nombreError.textContent = 'Este campo no puede estar vacío';
            } else if (nombreValue !== sanitizedValue) {
                nombreError.textContent = 'No se permiten etiquetas HTML en el campo.';
            } else {
                nombreError.textContent = '';
            }
        });

        formulario.addEventListener('submit', function (e) {
            const nombreValue = nombreInput.value.trim();
            const sanitizedValue = escapeHTML(nombreValue);

            if (nombreValue === '') {
                nombreError.textContent = 'Este campo no puede estar vacío';
                e.preventDefault(); // Evita que el formulario se envíe si hay errores
            }else if (nombreValue !== sanitizedValue) {
                nombreError.textContent = 'No se permiten etiquetas HTML en el campo.';
                e.preventDefault();
            }else {
                nombreError.textContent = '';
            }
        });
    });
});