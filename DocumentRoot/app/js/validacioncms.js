function contieneScript(texto) {
    var scriptRegex = /<\s*script.*?>/i;
    return scriptRegex.test(texto);
}

document.addEventListener('DOMContentLoaded', function () {
    const formularios = document.querySelectorAll('form[name="formulario_cms"]');
    
    formularios.forEach(function (formulario) {
        const nombreInput = formulario.querySelector('#nuevocms');
        const nombreError = formulario.querySelector('#errorcms_id');

        nombreInput.addEventListener('blur', function () {
            const nombreValue = nombreInput.value.trim();

            if (nombreValue === '') {
                nombreError.textContent = 'Este campo no puede estar vacío';
            } else if (contieneScript(nombreValue)) {
                nombreError.textContent = 'No se permiten etiquetas <script> en el campo';
            } else {
                nombreError.textContent = '';
            }
        });

        formulario.addEventListener('submit', function (e) {
            const nombreValue = nombreInput.value.trim();
            

            if (nombreValue === '') {
                nombreError.textContent = 'Este campo no puede estar vacío';
            
            }else if (contieneScript(nombreValue)) {
                e.preventDefault()
                nombreError.textContent = 'No se permiten etiquetas <script> en el campo';
            }else {
                e.preventDefault
                nombreError.textContent = '';

            }
        });
    });
    
   
});