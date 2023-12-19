<?php


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Usuarios</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php include('../includes/sidebar.php'); ?>
</head>
<style>
        body {
            background-color: #f8f9fa; /* Set your desired background color */
        }
    </style>

        <body>

        <div class="content" style="width:80%; margin-left:20%; display:flex; flex-direction:column;">
        <div class="container">
        <div class="titulo">
                    <h1>Agregar Usuarios</h1>
                </div>

            <!-- Formulario para agregar/editar usuarios -->
            <form method="post" action="#" style="margin-top:3%;">
                <input type="hidden" id="accion" name="accion" value="">
                <input type="hidden" id="idUsuario" name="idUsuario" value="">

                <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
                <!-- Mensaje de error para el nombre -->
                <div class="error-message" id="error-nombre"></div>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido">
                <!-- Mensaje de error para el apellido -->
                <div class="error-message" id="error-apellido"></div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
                <!-- Mensaje de error para el correo electrónico -->
                <div class="error-message" id="error-email"></div>
            </div>

            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena">
                <!-- Mensaje de error para la contraseña -->
                <div class="error-message" id="error-contrasena"></div>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Nombre de usuario:</label>
                <input type="text" class="form-control" id="username" name="username">
                <!-- Mensaje de error para el nombre de usuario -->
                <div class="error-message" id="error-username"></div>
            </div>

            <div class="mb-3">
                <label for="es_admin" class="form-label">¿Es administrador?</label>
                <select class="form-select" id="es_admin" name="es_admin">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
                <!-- Mensaje de error para la selección de administrador -->
                <div class="error-message" id="error-es_admin"></div>
            </div>

            <button type="submit" class="btn btn-primary" name="accion" value="agregar">Guardar Usuario</button>
        </form>
    <hr>
    <!-- <?php foreach ($usuariosid as $item){
        var_dump($item);
    } ?> -->

<a id="editform" href="#popup1">Let me Pop up</a>


<div id="popup1" class="overlay">
	<div class="popup">
		<a class="close" href="#">&times;</a>
		<div class="content">
    <form id="formpop" method="post" action="#">
                <input type="hidden" id="accionpop" name="accionpop" value="">
                <input type="hidden" id="idUsuariopop" name="idUsuariopop" value="">

                <div class="mb-3">
                <label for="nombrepop" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombrepop" name="nombrepop">
                <!-- Mensaje de error para el nombre -->
                <div class="error-message" id="error-nombre"></div>
            </div>

            <div class="mb-3">
                <label for="apellidopop" class="form-label">Apellido:</label>
                <input type="text" class="form-control" id="apellidopop" name="apellidopop">
                <!-- Mensaje de error para el apellido -->
                <div class="error-message" id="error-apellido"></div>
            </div>

            <div class="mb-3">
                <label for="emailpop" class="form-label">Email:</label>
                <input type="email" class="form-control" id="emailpop" name="emailpop">
                <!-- Mensaje de error para el correo electrónico -->
                <div class="error-message" id="error-email"></div>
            </div>

            <div class="mb-3">
                <label for="contrasenapop" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="contrasenapop" name="contrasenapop">
                <!-- Mensaje de error para la contraseña -->
                <div class="error-message" id="error-contrasena"></div>
            </div>

            <div class="mb-3">
                <label for="usernamepop" class="form-label">Nombre de usuario:</label>
                <input type="text" class="form-control" id="usernamepop" name="usernamepop">
                <!-- Mensaje de error para el nombre de usuario -->
                <div class="error-message" id="error-username"></div>
            </div>

            <div class="mb-3">
                <label for="es_adminpop" class="form-label">¿Es administrador?</label>
                <select class="form-select" id="es_adminpop" name="es_adminpop">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
                <!-- Mensaje de error para la selección de administrador -->
                <div class="error-message" id="error-es_admin"></div>
            </div>

            <button type="submit" class="btn btn-primary" name="accionpop" value="agregarpop">Editar Usuario</button>
        </form>
		</div>
	</div>
</div>

<style>
.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin: 2.5% auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: sticky;
  transition: all 5s ease-in-out;
}

.popup .close {
  position: absolute;
  top: 10px;
  right: 30px;
  transition: all 2s;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
</style>
<script>
        document.getElementById('editform').addEventListener('click', function(event) {
        var formulario = document.getElementById('formpop');
        
        $.ajax({
                url: 'http://localhost/controladores/controladorusuaris.php',
                method: 'GET',
                dataType: 'json',
                success: function(datos) {
                table = $('#tableUsuaris').DataTable({
                data: data,
                columns: [
                    { data: "id" },
                    { data: "nombre" },
                    { data: "apellido" },
                    { data: "email" },
                    { data: "contrasena" },
                    { data: "username" },
                    { data: "es_admin" },
                    { data: "fecha_alta" },
                    { data: "estado_id" },
                    {
                      data: null,
                      render: function(data, type, row) {
                          return '<button class="btn btn-warning btn-editar">Editar</button>';
                      }
                    }
                        ],
                    keys: true
                });
                },
                error: function(error) {
                    console.error('Error en la petición:', error);
                }
            });

        // Cambia el valor del campo 'nombre' al hacer clic en el enlace
        formulario.elements.nombrepop.value = "Nuevo Nombre";
        formulario.elements.apellidopop.value = "Nuevo Nombre";
        formulario.elements.emailpop.value = "Nuevo Nombre";
        formulario.elements.contrasenapop.value = "Nuevo Nombre";
        formulario.elements.usernamepop.value = "Nuevo Nombre";
        formulario.elements.es_adminpop.value = 0;
    });
</script>

</body>
</html>



