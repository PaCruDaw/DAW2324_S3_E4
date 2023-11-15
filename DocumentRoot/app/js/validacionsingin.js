// Definir las reglas de validación
var constraints = {
    name: {
      presence: true,
    },
    password: {
      presence: true,
      length: {
        minimum: 6,
        maximum: 12,
        tooShort: "debe tener al menos %{count} caracteres",
        tooLong: "no debe tener más de %{count} caracteres"
      },
      format: {
        pattern: /^(?=.*[a-z])(?=.*[A-Z])/,
        message: "debe contener al menos una letra mayúscula y una letra minúscula"
      }
    }
  };
  
  // Agregar un controlador de eventos para la validación
  document.getElementById('myForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Evitar el envío del formulario por defecto
  
    var formData = {
      name: document.querySelector('[name="name"]').value,
      password: document.querySelector('[name="password"]').value
    };
  
    var errors = validate(formData, constraints);
  
    if (errors) {
      // Mostrar errores en rojo
      document.getElementById('errorName').textContent = errors.name ? errors.name[0] : '';
      document.getElementById('errorPassword').textContent = errors.password ? errors.password[0] : '';
    } else {
      // Si no hay errores, enviar el formulario
      this.submit();
    }
  });