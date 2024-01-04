<?php
session_start();
require_once 'head.html';
include '../controladores/controladorFormUsuaris.php';

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

            <!-- Formulario para agregar -->
            <form method="post" action="#" style="margin-top:3%;">
                
            <div class="mb-3">
                <input type="hidden" id="action" name="action" value="add">
                <label for="status" class="form-label">Estatus:</label>
                <select class="form-select" id="idstatus" name="idstatus">
                    <option value="1">Estatus 1</option>
                    <option value="2">Estatus 2</option>
                    <option value="3">Estatus 3</option>
                </select>
                <div class="error-message" id="error-status"></div>
            </div>
            
            <div class="mb-3">
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
                    <option value="1">País 1</option>
                    <option value="2">País 2</option>
                    <option value="3">País 3</option>
                </select>
                <div class="error-message" id="error-idCountry"></div>
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
                    
                    <th>Estatus cliente</th>
                    <th>Nombre</th>
                    <th>Apellidos/s</th>
                    <th>Nombre Usuario</th>
                    <th>Contraseña</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Direcció</th>
                    <th>Código Postal</th>
                    <th>País</th>
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

<script>
    var table;
    $.ajax({
                url: 'http://localhost/controladores/controladorMostrarUsuaris.php',
                method: 'GET',
                dataType: 'json',
                success: function(datos) {
                table = $('#tableUsuaris').DataTable({
                data: datos,
                columns: [
                    
                    { data: "idCS" },
                    { data: "name" },
                    { data: "surnames" },
                    { data: "username" },
                    { data: "password" },
                    { data: "mail" },
                    { data: "phone" },
                    { data: "address" },
                    { data: "postcode" },
                    { data: "idCountry" },
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
                
                <div class="mb-3">
                    <input type="hidden" id="idClientU" name="idClientU" value="${rowData.idClient}">
                    <input type="hidden" id="action" name="action" value="update">
                    <label for="status" class="form-label">Estatus:</label>
                    <select class="form-select" id="idstatusU" name="idstatusU" value="${rowData.idCS}">
                        <option value="1">Estatus 1</option>
                        <option value="2">Estatus 2</option>
                        <option value="3">Estatus 3</option>
                    </select>
                    <div class="error-message" id="error-idstatusU"></div>
                </div>
                
                <div class="mb-3">
                    <label for="nameU" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nameU" name="nameU" value="${rowData.name}">
                    <div class="error-message" id="error-nameU"></div>
                </div>
    
                <div class="mb-3">
                    <label for="surnameU" class="form-label">Apellido/s:</label>
                    <input type="text" class="form-control" id="surnameU" name="surnameU" value="${rowData.surname}">
                    <div class="error-message" id="error-surnameU"></div>
                </div>
    
                <div class="mb-3">
                    <label for="usernameU" class="form-label">Nombre de usuario:</label>
                    <input type="text" class="form-control" id="usernameU" name="usernameU" value="${rowData.username}">
                    <div class="error-message" id="error-usernameU"></div>
                </div>
    
                <div class="mb-3">
                    <label for="passwordU" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="passwordU" name="passwordU" value="${rowData.password}">
                    <!-- Mensaje de error para la contraseña -->
                    <div class="error-message" id="error-passwordU"></div>
                </div>
                
                <div class="mb-3">
                    <label for="emailU" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="emailU" name="emailU" value="${rowData.mail}">
                    <!-- Mensaje de error para el correo electrónico -->
                    <div class="error-message" id="error-emailU"></div>
                </div>
    
                <div class="mb-3">
                    <label for="phoneU" class="form-label">Teléfono:</label>
                    <input type="text" class="form-control" id="phoneU" name="phoneU" value="${rowData.phone}">
                    <!-- Mensaje de error para el nombre de usuario -->
                    <div class="error-message" id="error-phoneU"></div>
                </div>
    
                <div class="mb-3">
                    <label for="addressU" class="form-label">Dirección:</label>
                    <input type="text" class="form-control" id="addressU" name="addressU" value="${rowData.address}">
                    <!-- Mensaje de error para el nombre de usuario -->
                    <div class="error-message" id="error-addressU"></div>
                </div>
    
                <div class="mb-3">
                    <label for="postcodeU" class="form-label">Codigo postal:</label>
                    <input type="text" class="form-control" id="postcodeU" name="postcodeU" value="${rowData.postcode}">
                    <!-- Mensaje de error para el nombre de usuario -->
                    <div class="error-message" id="error-postcodeU"></div>
                </div>
    
                <div class="mb-3">
                    <label for="idCountryU" class="form-label">Pais:</label>
                    <select class="form-select" id="idCountryU" name="idCountryU" value="${rowData.idCountry}">
                        <option value="1">País 1</option>
                        <option value="2">País 2</option>
                        <option value="3">País 3</option>
                    </select>
                    <div class="error-message" id="error-idCountryU"></div>
                </div>
    
                <button type="submit" class="btn btn-primary" name="accion" value="actualizar">Guardar Usuario</button>
            </form>
            `
        $('#userInfo').empty();

        $('#userInfo').html(modalContent);
              
        var infoModal = new bootstrap.Modal(document.getElementById('infoModal'));
        infoModal.show();
        });

</script>

</body>
</html>



