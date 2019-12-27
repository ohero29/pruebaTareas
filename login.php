<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset ="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/stylelogin.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset = "utf-8"></script>
  </head>
  <body>
        <!-- Login -->
        <form action="" method="POST" class="login-form">
          <?php
              if(isset($errorLogin)){
                  echo $errorLogin;
              }
          ?>

            <h1>Login</h1>
            <!-- Username -->
            <div class="txtb">
                <label>Usuario: </label>
                <input type= "text" id="user" name="username">
            </div>
            <!-- Password -->
            <div class="txtb">
                <label>Contraseña</label>
                <input type= "password" id="pass" name="password">
            </div>
            <!-- Boton ingreso -->
            <input type="submit" class="logbtn" value="Iniciar Sesión" name="login">
        </form>

        <script type="text/javascript">

        </script>
  </body>
</html>
