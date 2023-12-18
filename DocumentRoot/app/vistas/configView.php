<?php
session_start();
include('../controladores/configController.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("../includes/sidebar.php"); ?>
    <title>Artee</title>
    <script>
        function validateForm() {
            var preferencia = document.forms["preferenciaForm"]["preferencia"].value;

            if (preferencia === 'logoApp') {
                var foto = document.forms["preferenciaForm"]["foto"].value;
                if (foto === "") {
                    alert("Por favor, seleccione una imagen para la preferencia.");
                    return false;
                }
            } else {
                var nuevoValor = document.forms["preferenciaForm"]["nuevo_valor"].value;
                if (nuevoValor === "") {
                    alert("Por favor, ingrese un valor para la preferencia.");
                    return false;
                }
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="content" style="width:80%; margin-left:20%; display:flex; flex-direction:column;">
        <div class="titulo">
            <h1>Actualizar Valores</h1>
        </div>
        <div class="table-responsive" style="margin-top:3%;"> 
            <table class="table">
                <thead>
                    <tr>
                        <th>Preferencia</th>
                        <th>Valor Actual</th>
                        <th>Actualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $manager) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($manager['preferencia']) . "</td>";
                        echo '<td>' . htmlspecialchars($manager['valor']) . '</td>';
                        echo '<td>
                                <form name="preferenciaForm" action="vistaPreferencias.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                                    <input type="hidden" name="preferencia" value="' . htmlspecialchars($manager['preferencia']) . '">';

                        if ($manager['preferencia'] == 'logoApp') {
                            echo '<input class="form-control" type="file" name="foto" accept="image/jpeg, image/jpg">';
                        } else {
                            echo '<input class="form-control" type="text" name="nuevo_valor" placeholder="Nuevo Valor" value="' . htmlspecialchars($manager['valor']) . '">';
                        }

                        echo '<input class="btn btn-primary mt-2" type="submit" value="Actualizar">
                                </form>
                              </td>';
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
