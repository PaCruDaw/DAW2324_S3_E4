<?php
session_start();
require_once '../includes/head.php';
?>

    <style>
        body {
            background-color: #f8f9fa; /* Set your desired background color */
        }
    </style>
<body>
    <div class="traducciones" style="width:80%; margin-left:15%; display:flex; flex-direction:column;">
        <h1>Lista de Traducciones</h1>
        
      
            <select class="form-select my-5 container" name="idioma" id="idioma">
                <option value="">Todos los idiomas</option>
                <option value="ESP">Español</option>
                <option value="ENG">Inglés</option>
                <option value="CAT">Català</option>
                <!-- Agrega más opciones para otros idiomas según tu base de datos -->
            </select>
          
        
        <table class="table" id = "table_translate">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Original</th>
                    <th>Traducción</th>
                    <th>Lugar</th>
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