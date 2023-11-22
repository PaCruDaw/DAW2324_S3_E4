<?php
include('../controladores/usuarios.php');
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
<script>
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
</script>

        <body>

        <div class="content" style="width:80%; margin-left:20%; display:flex; flex-direction:column;">
        <div class="container">
        <div class="titulo">
                    <h1>Agregar Usuarios</h1>
                </div>

            <!-- Formulario para agregar/editar usuarios -->
            <form method="post" action="" onsubmit="return validarFormulario();" style="margin-top:3%;>
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

    <h2>Lista de Usuarios</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Username</th>
                <th>Es Admin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaUsuarios">
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= $usuario['nombre'] ?></td>
                    <td><?= $usuario['apellido'] ?></td>
                    <td><?= $usuario['email'] ?></td>
                    <td><?= $usuario['username'] ?></td>
                    <td><?= $usuario['es_admin'] == 1 ? 'Sí' : 'No' ?></td>
                    <td>
                    
                        <form method="post" action="">
                        <input type="hidden" name="accion" value="editar">
                        <input type="hidden" name="idUsuario" value="<?= $usuario['id'] ?>">
                        <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $usuario['nombre'] ?>">
        <!-- Mensaje de error para el nombre -->
        <div class="error-message" id="error-nombre-edicion"></div>
    </div>

                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" value="<?= $usuario['apellido'] ?>">
                            <!-- Mensaje de error para el apellido -->
                            <div class="error-message" id="error-apellido-edicion"></div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $usuario['email'] ?>">
                            <!-- Mensaje de error para el correo electrónico -->
                            <div class="error-message" id="error-email-edicion"></div>
                        </div>

                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena">
                            <!-- Mensaje de error para la contraseña -->
                            <div class="error-message" id="error-contrasena-edicion"></div>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de usuario:</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $usuario['username'] ?>">
                            <!-- Mensaje de error para el nombre de usuario -->
                            <div class="error-message" id="error-username-edicion"></div>
                        </div>

                        <div class="mb-3">
                            <label for="es_admin" class="form-label">¿Es administrador?</label>
                            <select class="form-select" id="es_admin" name="es_admin">
                                <option value="1" <?= $usuario['es_admin'] == 1 ? 'selected' : '' ?>>Sí</option>
                                <option value="0" <?= $usuario['es_admin'] == 0 ? 'selected' : '' ?>>No</option>
                            </select>
                            <!-- Mensaje de error para la selección de administrador -->
                            <div class="error-message" id="error-es_admin-edicion"></div>
                        </div>

                        <button type="submit">Guardar Usuario</button>
                    </form>

                            <form method="post" action="vistaUsuarios.php">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="idUsuario" value="<?= $usuario['id'] ?>">
                            <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">Borrar</button>
                        </form>
                    
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>    
    </table>
</div>
</div>
</body>
</html>



