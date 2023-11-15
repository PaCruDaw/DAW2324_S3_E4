<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=>, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script> -->    
    <title>LOGIN</title>
    <link href="estilos/signin.css" rel="stylesheet">

        <!-- Favicons -->
    <link rel="icon" href="./img/logoArtee.png">
    <meta name="theme-color" content="#7952b3">
</head>
<body class="text-center">  
<header>
  <div class="imageBox"> 
    <img src="./img/logoArtee.png" alt="Logo Artee" class="rounded-circle mb4"  width="100" height="100">
  </div>  
</header>
<main class="form-signin">

      <div id="boxLoginForm">
      <div class="contenedor">
        <div class="cabecera">
      <form id="formulario" action="./controladores/controladorlogin.php" method="post" class="loginForm">
          <h1 class="h3 mb-3 fw-normal">LOGIN</h1>
          <!--Formulario que se ve si el usuario quiere recuperar la contraseña-->
          <div id="recoveryTittle" style="display: none;">
          <h2>Recuperación de Contraseña</h1>
        </div>
        <!--Informa fallo all usuario-->
        <?php
            if(isset($_GET["fallo"]) && $_GET["fallo"] == 'true')
            {
                echo "<div style='color:red'> Usuario o contraseña incorrectos </div>";
            }
        ?>
        <div class="form-control">
          <label for="email">Email</label>
          <input id="email" name="email" type="email">
          <p></p>
        </div>
        <div class="form-control">
          <label for="password">Password</label>
          <input id="password" name= password type="password">
          <p></p>
        </div>
        <div class="text-left">
          <a href="#" id="lost-pass"><p>Olvidé mi contraseña</p></a>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me">Recuerdame
          </label>
        
      </div>
      </form>
      </div>
        </div>
      </div>
      
      <!--Formulario que se abre al clickear en he olvidado mi contraseña-->
      <div id="recoveryForm" style="display: none;">
        <label for="recoveryEmail">Ingrese su correo electrónico:</label>
        <input type="email" id="recoveryEmail" name="recoveryEmail" required>
        <button type="submit" id="submit"name="recoverPassword">Enviar</button>
      </div>
      <div id="submitMessage" style="display:none;">
        <p>¡Te hemos enviado un mensaje a tu correo electrónico!</p>
        <a href="index.php"><p>Volver al Login</p></a>
      </div>
</main>
  <p class="mt-5 mb-3 text-muted">ARTEE 2023</p> 
  <script>
    $(document).ready(function() {
        $("#lost-pass").click(function(e) {
            e.preventDefault();
            $("#login-tittle").hide();
            $("#boxLoginForm").hide();
            $("#submitMessage").hide();
            $("#recoveryTittle").show();
            $("#recoveryForm").show();
            
        });
        $("#submit").click(function(e){
            e.preventDefault();
            $("#login-tittle").hide();
            $("#boxLoginForm").hide();
            $("#recoveryTittle").hide();
            $("#recoveryForm").hide();
            $("#submitMessage").show();
        });
 
    });
</script> 
<script src="./js/validacionlogin.js"></script>

</body>
</html>