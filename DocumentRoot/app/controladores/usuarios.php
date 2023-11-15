<?php
session_start();
include('../db.php');
include('../modelos/UserManager.php');

// Crear una instancia del AdministradorUsuarios con tu conexión PDO
$administradorUsuarios = new AdministradorUsuarios($pdo);

// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se envió el formulario para agregar o editar usuarios
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        if ($accion == 'agregar') {
            // Validar que los campos no estén vacíos
            if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['email']) || empty($_POST['contrasena']) || empty($_POST['username']) || !isset($_POST['es_admin'])) {
                // Campos vacíos, puedes manejar el error de alguna manera, por ejemplo, redireccionar con un mensaje de error
                header("Location: vistaUsuarios.php");
                exit();
            }

            // Obtener los datos del formulario y agregar el usuario
            $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
            $apellido = htmlspecialchars($_POST['apellido'], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
            $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
            $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
            $es_admin = $_POST['es_admin'];

            // Validar el formato del correo electrónico
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // El correo electrónico no tiene un formato válido
                // Puedes manejar el error de alguna manera, por ejemplo, redireccionar con un mensaje de error
                header("Location: vistaUsuarios.php");                
                exit();
            }

            $datosUsuario = [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'email' => $email,
                'contrasena' => $contrasena,
                'username' => $username,
                'es_admin' => $es_admin
            ];

            $administradorUsuarios->agregarUsuario($datosUsuario);
        } elseif ($accion == 'editar') {
            // Validar que los campos no estén vacíos
            if (empty($_POST['idUsuario']) || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['email']) || empty($_POST['contrasena']) || empty($_POST['username']) || !isset($_POST['es_admin'])) {
                // Campos vacíos, puedes manejar el error de alguna manera, por ejemplo, redireccionar con un mensaje de error
                header("Location: vistaUsuarios.php");                
                exit();
            }

            // Obtener los datos del formulario y actualizar el usuario
            $idUsuario = $_POST['idUsuario'];
            $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
            $apellido = htmlspecialchars($_POST['apellido'], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
            $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
            $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
            $es_admin = $_POST['es_admin'];

            // Validar el formato del correo electrónico
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // El correo electrónico no tiene un formato válido
                // Puedes manejar el error de alguna manera, por ejemplo, redireccionar con un mensaje de error
                header("Location: vistaUsuarios.php");                
                exit();
            }

            $datosUsuario = [
                'idUsuario' => $idUsuario,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'email' => $email,
                'contrasena' => $contrasena,
                'username' => $username,
                'es_admin' => $es_admin
            ];

            $administradorUsuarios->actualizarUsuario($datosUsuario);
        }
    }

    // Verificar si se envió una solicitud para eliminar usuario
    if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar' && isset($_POST['idUsuario'])) {
        // Validar que el campo del ID no esté vacío
        if (empty($_POST['idUsuario'])) {
            // Campo vacío, puedes manejar el error de alguna manera, por ejemplo, redireccionar con un mensaje de error
            header("Location: vistaUsuarios.php");                
            exit();
        }

        // Obtener el ID del usuario a eliminar y ejecutar la función
        $idUsuarioEliminar = $_POST['idUsuario'];
        $administradorUsuarios->eliminarUsuario($idUsuarioEliminar);
    }
}

// Obtener todos los usuarios
$usuarios = $administradorUsuarios->obtenerTodosLosUsuarios();
?>
