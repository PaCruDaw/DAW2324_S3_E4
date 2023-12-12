<?php
    require_once "head.php";
?>

<body>
    <div class="sidebar">
        <h1>Artee</h1>
        <div class="info-menu-lateral">
        <div class="imageBox"> 
            <img src="../img/logoArtee.png" class="rounded-circle mb4"  width="100" height="100">
            </div>
        </div>
        <ul>
            <li><a href="../main.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="../vistas/vistatraducciones.php"><i class="fas fa-chart-bar"></i> Traducciones</a></li>
            <li><a href="../controladores/controladorcms.php"><i class="fas fa-users"></i> CMS</a></li>
            <li><a href="../vistas/vistaEstadisticas.php"><i class="fas fa-cog"></i> Estadisticas</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Paises</a></li>
            <li><a href="../vistas/vistaProductos.php"><i class="fas fa-cog"></i> Productos/Margen</a></li>
            <li><a href="../vistas/vistaPreferencias.php"><i class="fas fa-cog"></i> Preferencias</a></li>
            <li><a href="../vistas/vistaUsuarios.php"><i class="fas fa-cog"></i> Usuarios</a></li>
        </ul>
        <section class="logout">
            <a href="../index.php"><i class="fas fa-cog"></i> LOG OUT</a>
        </section>
    </div>
</body>
</html>
