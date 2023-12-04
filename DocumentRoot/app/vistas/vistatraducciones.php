<?php
session_start();
require_once 'head.html';
?>

    <style>
        body {
            background-color: #f8f9fa; /* Set your desired background color */
        }
    </style>
<body>
    <?php include('../includes/sidebar.php'); ?>

    <div class="traducciones" style="width:80%; margin-left:20%; display:flex; flex-direction:column;">
        <h1>Lista de Traducciones</h1>
        
        <form method="POST"  class = "my-3 mx-5">
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
        
        <table class="table" id = "table_translate">
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
                

            </tbody>
        </table>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="../js/validaciontraducciones.js" rel="script"></script>
    <script src="../js/table_translate.js" rel="script"></script>
</body>
</html>
