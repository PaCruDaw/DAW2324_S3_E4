<?php
session_start();
require_once '../includes/head.php';
include '../controladores/controladorFormCms.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/table_cms.js" rel="script"></script>
    <title>Administrador de Cms</title>
</head>

<style>
    body {
        background-color: #f8f9fa; /* Set your desired background color */
    }
</style>
<body>
    <div class="cms" style="width:80%; margin-left:20%; display:flex; flex-direction:column;">
        <h1>CMS</h1>

                  
        <table class="table" id="tableCms">
            <thead>
                
                <tr>
                    <th>Id Cms</th>
                    <th>Id Política</th>
                    <th>Contingut</th>
                    <th>Editar</th>

                </tr>
            
            </thead>
            <tbody>
                

            </tbody>
        </table>
    </div>

</body>
</html>