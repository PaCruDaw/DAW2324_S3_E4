<?php
session_start();
require_once '../includes/head.php';
include '../controladores/controladorFormUsuaris.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/tablaformusuarios.js" rel="script"></script>
    <title>Administrador de Usuarios</title>
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

            <!-- Formulario para agregar -->
            <form method="post" action="#" style="margin-top:3%;">
                
            <div class="mb-3">
                <input type="hidden" id="action" name="action" value="add">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name">
                <div class="error-message" id="error-name"></div>
            </div>

            <div class="mb-3">
                <label for="surname" class="form-label">Apellido/s:</label>
                <input type="text" class="form-control" id="surname" name="surname">
                <div class="error-message" id="error-surname"></div>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Nombre de usuario:</label>
                <input type="text" class="form-control" id="username" name="username">
                <div class="error-message" id="error-username"></div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password">
                <!-- Mensaje de error para la contraseña -->
                <div class="error-message" id="error-password"></div>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="mail" name="mail">
                <!-- Mensaje de error para el correo electrónico -->
                <div class="error-message" id="error-mail"></div>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Teléfono:</label>
                <input type="text" class="form-control" id="phone" name="phone">
                <!-- Mensaje de error para el nombre de usuario -->
                <div class="error-message" id="error-phone"></div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Dirección:</label>
                <input type="text" class="form-control" id="address" name="address">
                <!-- Mensaje de error para el nombre de usuario -->
                <div class="error-message" id="error-address"></div>
            </div>

            <div class="mb-3">
                <label for="postcode" class="form-label">Codigo postal:</label>
                <input type="text" class="form-control" id="postcode" name="postcode">
                <!-- Mensaje de error para el nombre de usuario -->
                <div class="error-message" id="error-postcode"></div>
            </div>

            <div class="mb-3">
                <label for="idCountry" class="form-label">Pais:</label>
                <select class="form-select" id="idCountry" name="idCountry">
                    <option value=1>País 1</option>
                    <!-- <option value="2">País 2</option>
                    <option value="3">País 3</option> -->
                </select>
                <div class="error-message" id="error-idCountry"></div>
            </div>

            <div class="mb-3">
                <label for="clientStatus" class="form-label">Status:</label>
                <select class="form-select" id="clientStatus" name="clientStatus">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Banned">Banned</option>
                <option value="Deleted">Deleted</option>
                </select>
                <div class="error-message" id="error-clientStatus"></div>
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
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellidos/s</th>
                    <th>Nombre Usuario</th>
                    <th>Contraseña</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Direcció</th>
                    <th>Código Postal</th>
                    <th>País</th>
                    <th>Fecha creación</th>
                    <th>Estatus cliente</th>
                    <th>Editar</th>

                    
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

</body>
</html>



