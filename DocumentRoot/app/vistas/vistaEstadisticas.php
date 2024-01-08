<?php
session_start();
require_once ("../includes/head.php");
?>
<head>
    <title>Estadistiques</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <section >
        <div class="bg-light d-flex align-items-center justify-content-center vh-100">
            <div class="card">
                <div class="card-body">
                    <canvas id="myChart" width="500" height="500"></canvas>
                </div>
            </div>
        </div>
    </section>
    
    <script src="../js/estadisticas.js"></script>
</body>
</html>
