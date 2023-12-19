<?php

require_once 'head.html';
include '../controladores/controladorusuaris.php'

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Usuarios</title>
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

<table class="table" id="tableUsuaris">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Traducción</th>
                    <th>Original</th>
                    <th>Idioma</th>
                    <th>Actualizar</th>
                    <th>Actualizar</th>
                    <th>Actualizar</th>
                    <th>Actualizar</th>
                </tr>
            </thead>
            <tbody>
                

            </tbody>
        </table>

        <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Detalles del Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Aquí se mostrará la información del usuario -->
                <div id="userInfo"></div>
              </div>
            </div>
          </div>
        </div>

<script>
    var table;
    $.ajax({
                url: 'http://localhost/controladores/controladorusuaris.php',
                method: 'GET',
                dataType: 'json',
                success: function(datos) {
                table = $('#tableUsuaris').DataTable({
                data: datos,
                columns: [
                    { data: "id" },
                    { data: "nombre" },
                    { data: "apellido" },
                    { data: "email" },
                    { data: "contrasena" },
                    { data: "username" },
                    { data: "es_admin" },
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

            $('#tableUsuaris tbody').on('click', '.btn-editar', function () {
              var tr = $(this).closest('tr');
              var rowData = table.row(tr).data();

              var modalContent = `
                <form method="post" action="#" style="margin-top:3%;">
                <input type="hidden" id="accion" name="accion" value="">
                <input type="hidden" id="idUsuario" name="idUsuario" value="${rowData.id}">

                <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="${rowData.nombre}">
                <!-- Mensaje de error para el nombre -->
                <div class="error-message" id="error-nombre"></div>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="${rowData.apellido}">
                <!-- Mensaje de error para el apellido -->
                <div class="error-message" id="error-apellido"></div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="${rowData.email}">
                <!-- Mensaje de error para el correo electrónico -->
                <div class="error-message" id="error-email"></div>
            </div>

            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" value="${rowData.contrasena}">
                <!-- Mensaje de error para la contraseña -->
                <div class="error-message" id="error-contrasena"></div>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Nombre de usuario:</label>
                <input type="text" class="form-control" id="username" name="username" value="${rowData.username}">
                <!-- Mensaje de error para el nombre de usuario -->
                <div class="error-message" id="error-username"></div>
            </div>

            <div class="mb-3">
                <label for="es_admin" class="form-label">¿Es administrador?</label>
                <select class="form-select" id="es_admin" name="es_admin" value="${rowData.es_admin}">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
                <!-- Mensaje de error para la selección de administrador -->
                <div class="error-message" id="error-es_admin"></div>
            </div>

            <button type="submit" class="btn btn-primary" name="accion" value="agregar">Guardar Usuario</button>
        </form>`

        $('#userInfo').empty();

        $('#userInfo').html(modalContent);
              
        var infoModal = new bootstrap.Modal(document.getElementById('infoModal'));
        infoModal.show();
        });

</script>

</body>
</html>



