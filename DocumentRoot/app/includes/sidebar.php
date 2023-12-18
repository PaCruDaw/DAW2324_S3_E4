<?php
    require_once "/var/www/html/controladores/traductor.php";
?>

<body>

<div class="d-flex justify-content-end mt-2">
    <div class="btn-group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-globe"></i> Idioma
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" onclick="cambiarIdioma(event,'esp')"><i class="fas fa-flag"></i> Español</a></li>
            <li><a class="dropdown-item" href="#" onclick="cambiarIdioma(event,'eng')"><i class="fas fa-flag"></i> Inglés</a></li>
            <li><a class="dropdown-item" href="#" onclick="cambiarIdioma(event,'cat')"><i class="fas fa-flag"></i> Catalán</a></li>
            <li><a class="dropdown-item" href="#" onclick="cambiarIdioma(event,'ita')"><i class="fas fa-flag"></i> Italiano</a></li>
        </ul>
    </div>
</div>
    <div class="sidebar">
        <h1>Artee</h1>
        <div class="info-menu-lateral">
        <div class="imageBox"> 
            <img src="../img/logoArtee.png" class="rounded-circle mb4"  width="100" height="100">
            </div>
        </div>
        <ul>
            <li><a href="../main.php"><i class="fas fa-home"></i><?php echo TranslateTextPage::pageTranslate('Inicio', 'sidebar', $lang);?></a></li>
            <li><a href="../vistas/vistatraducciones.php"><i class="fas fa-chart-bar"></i> Traducciones</a></li>
            <li><a href="../controladores/controladorcms.php"><i class="fas fa-users"></i> CMS</a></li>
            <li><a href="../vistas/vistaEstadisticas.php"><i class="fas fa-cog"></i> Estadisticas</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Paises</a></li>
            <li><a href="../vistas/vistaProductos.php"><i class="fas fa-cog"></i> Productos/Margen</a></li>
            <li><a href="../vistas/vistaPreferencias.php"><i class="fas fa-cog"></i> Preferencias</a></li>
            <li><a href="../vistas/vistaUsuarios.php"><i class="fas fa-cog"></i><?php echo TranslateTextPage::pageTranslate('Usuarios', 'sidebar', $lang);?></a></li>
        </ul>
        <section class="logout">
            <a href="../index.php"><i class="fas fa-cog"></i> LOG OUT</a>
        </section>
    </div>
    <script src="../js/sidebar.js" rel="script"></script>

</body>
</html>

