<?php
session_start();
include('../db.php');
include('../modelos/PreferenceManager.php');

$manager = new PreferenceManager($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $preferencia = isset($_POST['preferencia']) ? $_POST['preferencia'] : null;

    // Verifica si la preferencia es "logoApp"
    if ($preferencia === 'logoApp') {
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            // Configura las validaciones para el archivo
            $allowedExtensions = ["jpeg", "jpg"];
            $maxFileSize = 500 * 1024; // 500 KB (tamaño máximo permitido)

            $file = $_FILES['foto'];
            $fileInfo = pathinfo($file['name']);
            $fileExtension = strtolower($fileInfo['extension']);

            // Verifica si la extensión del archivo está permitida
            if (in_array($fileExtension, $allowedExtensions)) {
                // Verifica si el tamaño del archivo está dentro del límite permitido
                if ($file['size'] <= $maxFileSize) {
                    // Mueve el archivo a la ubicación de almacenamiento
                    $rutaArchivo = '../img/' . $file['name']; // Reemplaza con la ruta adecuada
                    move_uploaded_file($file['tmp_name'], $rutaArchivo);
                
                    // Actualiza la base de datos con la nueva ruta
                    if ($manager->updatePreferenceValueByName('logoApp', $rutaArchivo)) {
                        header("Location: ../vistas/vistaPreferencias.php");
                        echo "Imagen subida y ruta guardada en la base de datos correctamente.";
                    } else {
                        echo "Error al actualizar la ruta en la base de datos.";
                    }
                } else {
                    echo "El tamaño del archivo supera el límite permitido (500 KB).";
                }
            } else {
                echo "Tipo de archivo no permitido. Se permiten solo archivos JPEG/JPG.";
            }
        } else {
            echo "Ocurrió un error al cargar la imagen.";
        }
    } else {
        // Para las preferencias que no son "logoApp," verifica si se proporcionó un nuevo valor numérico para actualizar
        $nuevoValor = $_POST['nuevo_valor'];
        if ($preferencia != 'logoApp' && empty($nuevoValor)) {
            header("Location: ../vistas/vistaPreferencias.php");
            // or redirect back to the form with an error message
            exit();
        }        
        if (is_numeric($nuevoValor)) {
            if ($manager->updatePreferenceValueByName($preferencia, $nuevoValor)) {
                header("Location: ../vistas/vistaPreferencias.php");
            } else {
                echo "Error al actualizar el registro.";
            }
        }
    }
}

$result = $manager->getPreferences();
?>

