<?php
include('../controladores/preferencias.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<style>
        body {
            background-color: #f8f9fa; /* Set your desired background color */
        }
    </style>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Artee</title>
    <script>
        // JavaScript validations
        function validateForm() {
            // Get form elements
            var preferencia = document.forms["preferenciaForm"]["preferencia"].value;

            // Additional validations based on preferencia
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
    <?php include('../includes/sidebar.php'); ?>

    <div class="content" style="width:80%; margin-left:20%; display:flex; flex-direction:column;">
        <div class="titulo">
            <h1>Actualizar Valores</h1>
        </div>
        <div class="table-responsive" style="margin-top:3%;"> 
            <table class="table">
                <!-- Your table content goes here -->
                <thead>
                    <tr>
                        <th>Preferencia</th>
                        <th>Valor Actual</th>
                        <th>Actualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['preferencia']) . "</td>";
                        echo '<td>' . htmlspecialchars($row['valor']) . '</td>';
                        echo '<td>
                                <form name="preferenciaForm" action="../controladores/preferencias.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                                    <input type="hidden" name="preferencia" value="' . htmlspecialchars($row['preferencia']) . '">';

                        if ($row['preferencia'] == 'logoApp') {
                            echo '<input class="form-control" type="file" name="foto" accept="image/jpeg, image/jpg">';
                        } else {
                            echo '<input class="form-control" type="text" name="nuevo_valor" placeholder="Nuevo Valor" value="' . htmlspecialchars($row['valor']) . '">';
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
