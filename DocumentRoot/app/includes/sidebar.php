<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="../img/logoArtee.png">
    <title>Artee</title>
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 20%;
            background-color: #000000;
            padding: 20px;
            color: #fff;
        }

        .sidebar h1 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .sidebar .info-menu-lateral {
            margin-bottom: 20px;
            text-align: center;
        }

        .sidebar .info-menu-lateral img {
            width: 95px;
            height: 57px;
            margin-bottom: 10px;
            border-radius: 50%;
        }

        .sidebar .info-menu-lateral a {
            display: block;
            margin-bottom: 5px;
            color: #ffc107; /* Color amarillo de Bootstrap */
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
        }

        .sidebar a:hover {
            text-decoration: underline;
        }

        .logout {
            position: absolute;
            bottom: 20px;
        }

        .logout a {
            display: block;
            color: #ffffff; 
        }

        .logout a:hover {
            text-decoration: underline;
        }
    </style>
</head>
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
            <li><a href="../controladores/controladortraducciones.php"><i class="fas fa-chart-bar"></i> Traducciones</a></li>
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
