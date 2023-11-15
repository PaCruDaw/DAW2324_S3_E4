<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" initial-scale="1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
    <script src="../js/validacioncms.js"></script>
    <?php include('../includes/sidebar.php'); ?>
    <title>Document</title>
</head>
<style>
        body {
            background-color: #f8f9fa; /* Set your desired background color */
        }
    </style>
<body>
    <div class="cms" style="width:80%; margin-left:20%; display:flex; flex-direction:column;">
        <h1>Lista de CMS</h1>
        
        <table class="table" style="margin-top:3%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Página</th>
                    <th>Contenido página</th>
                    <th>Actualizar valores</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if(isset($cms)){
                    foreach ($cms as $cms) {
                        echo "<tr>";
                        echo "<td>{$cms['id']}</td>";
                        echo "<td>{$cms['politica']}</td>";
                        echo "<td>{$cms['valor_politica']}</td>";
                        echo "<td>
                                <form id='formulariocms' name='formulario_cms' method='POST' action='../controladores/controladorcms.php'>
                                    <textarea class='form-control' id='nuevocms' name='nuevo_cms' placeholder='Nueva traducción'></textarea>
                                    <input type='hidden' name='cms_id' value='{$cms['id']}'><br>
                                    <span style='color: red' id='errorcms_id' class='error-message'>";

                        if (isset($errorcms[$cms['id']]))
                            echo $errorcms[$cms['id']];

                        echo "</span><br>
                                    <input class='btn btn-primary' id='submitcms' type='submit' value='Actualizar'>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>

            </tbody>
        </table>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
