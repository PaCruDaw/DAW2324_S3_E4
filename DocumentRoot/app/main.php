<?php
session_start();
if (isset($_SESSION['username'])) {

require_once "./modelos/LoginManager.php";
require_once "./includes/head.php";

?>

<body>


    <div class="container mt-5" >
    <div class="d-flex justify-content-center">
      <table class="table-responsive table-bordered ">
        <thead>
          <tr>
            <th colspan="2" class="text-center">
                <h1>¡Bienvenido a CustomAIze!</h1>
                <h2>Estas son las estadísticas de <?php echo date('F')?></h2>

            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
                <h2 class="mb-3">Productos Populares</h2>
                <canvas id="chart1"></canvas>
            </td>
            <td>
                <table class="table" id="tablemain1">
                <thead>
                    
                    <tr>
                        <th>Id Política</th>
                        <th>Contingut</th>

                    </tr>
                </thead>
                <tbody>
                    

                </tbody>
                </table>
            </td>
          </tr>
          <tr>
            <td>
                <table class="table" id="tablemain2">
                <thead>
                    <tr>
                        <th>Id Política</th>
                        <th>Contingut</th>

                    </tr>
                </thead>
                    <tbody>
                    </tbody>
                </table>
            </td>
            <td>
                <h2 class="mb-3">Ventas por países </h2>
                <canvas id="chart4"></canvas>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div id="cookie-notice">
    <p>Este sitio web utiliza cookies para garantizar que obtenga la mejor experiencia en nuestra página.</p>
    <button id="accept-cookies">Aceptar</button>
</div>

    <link rel="stylesheet" href="./estilos/main.css">

    <script src="https://cc.cdn.civiccomputing.com/9/cookieControl-9.x.min.js"></script>
    <script src="./js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/js/grafiquesmain.js"></script>
</body>
</html>


<?php
} else {
?>
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=accessDenied.html">
<?php
}

?>