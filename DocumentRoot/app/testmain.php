<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <title>Dos Divs en Bootstrap</title>
</head>
<body>

  <div class="container mt-5">
    <div class="row">
      <!-- Primer div (arriba a la izquierda) -->
      <div class="col-md-6">
        <div class="bg-primary text-white p-4">
          <h1>Contenido del Primer Div (Arriba a la Izquierda)</h1>
          <p>Este es el contenido del primer div.</p>
        </div>
      </div>

      <!-- Segundo div (arriba a la derecha) -->
      <div class="col-md-6">
        <div class="bg-warning text-dark p-4">
          <h1>Contenido del Segundo Div (Arriba a la Derecha)</h1>
          <p>Este es el contenido del segundo div.</p>
        </div>
      </div>
    </div>

    <!-- Cuatro divs en forma de cuadrícula (abajo) -->
    <div class="row mt-4">
      <div class="col-md-3 mb-4">
        <div class="bg-secondary text-white p-4">
          <h2>Div 1</h2>
          <p>Contenido del primer div de la cuadrícula.</p>
        </div>
      </div>

      <div class="col-md-3 mb-4">
        <div class="bg-secondary text-white p-4">
          <h2>Div 2</h2>
          <p>Contenido del segundo div de la cuadrícula.</p>
        </div>
      </div>

      <div class="col-md-3 mb-4">
        <div class="bg-secondary text-white p-4">
          <h2>Div 3</h2>
          <p>Contenido del tercer div de la cuadrícula.</p>
        </div>
      </div>

      <div class="col-md-3 mb-4">
        <div class="bg-secondary text-white p-4">
          <h2>Div 4</h2>
          <p>Contenido del cuarto div de la cuadrícula.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="d-flex justify-content-center">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="2" class="text-center">Encabezado de la Tabla</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Fila 1, Columna 1</td>
            <td>Fila 1, Columna 2</td>
          </tr>
          <tr>
            <td>Fila 2, Columna 1</td>
            <td>Fila 2, Columna 2</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
