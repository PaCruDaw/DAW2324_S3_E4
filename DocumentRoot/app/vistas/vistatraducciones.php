<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" initial-scale="1.0">
    <script src="../js/validaciontraducciones.js" rel="script"></script>
    <?php include('../includes/sidebar.php'); ?>
    <title>Document</title>
</head>
<style>
        body {
            background-color: #f8f9fa; /* Set your desired background color */
        }
    </style>
<body>
    <div class="traducciones" style="width:80%; margin-left:20%; display:flex; flex-direction:column;">
        <h1>Lista de Traducciones</h1>
        
        <form method="POST" action="../controladores/controladortraducciones.php">
            <div class="mb-3" style="margin-top:3%;">
                <label for="idioma" class="form-label">Filtrar por Idioma:</label>
                <select class="form-select" name="idioma" id="idioma">
                    <option value="">Todos los idiomas</option>
                    <option value="ESP">Español</option>
                    <option value="ENG">Inglés</option>
                    <option value="CAT">Català</option>
                    <!-- Agrega más opciones para otros idiomas según tu base de datos -->
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Traducción</th>
                    <th>Original</th>
                    <th>Idioma</th>
                    <th>Actualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($traducciones)){
                    foreach ($traducciones as $traduccion) {
                        echo "<tr>";
                        echo "<td>{$traduccion['TraduccionIdiomaID']}</td>";
                        echo "<td>{$traduccion['Traduccion']}</td>";
                        echo "<td>{$traduccion['TextoOriginal']}</td>";
                        echo "<td>{$traduccion['Idioma']}</td>";
                        echo "<td>
                                <form method='POST' name='form_traducciones' action='../controladores/controladortraducciones.php'>
                                    <div class='mb-3'>
                                        <input type='text' class='form-control' id='nuevatraduccion' name='nueva_traduccion' placeholder='Nueva traducción'>
                                        <input type='hidden' name='traduccion_id' value='{$traduccion['TraduccionIdiomaID']}'>
                                    </div>
                                    <span style='color: red' id='voidError' class='error-message'></span><br>
                                    <button type='submit' class='btn btn-primary'>Actualizar</button>
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
