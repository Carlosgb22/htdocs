<?php
include_once("php/cabezera.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="/Bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/Bootstrap/css/style.css">
</head>

<body>
  <br>
  <div class="container">
    <div class="card" style="width: 50%; margin: auto;">
      <br>
      <img src="img/cerveza-indice.jpg" class="rounded mx-auto d-block" alt="Cerveceria" style="height: 50%; width: 50%;">
      <div class="card-body">
        <h5 class="card-title" style="text-align:center;">Cerveceria Carlos</h5>
        <form action="php/login.php" method="post">
          <div class="form-group">
            <label for="inputEmail">Correo Electronico</label>
            <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Introduzca email" name="email">
            <small id="emailHelp" class="form-text text-muted">No compartiremos tu email con terceros.</small>
          </div>
          <div class="form-group">
            <label for="inputPassword">Contraseña</label>
            <input type="password" class="form-control" id="inputPassword" placeholder="Introduzca contraseña" name="contrasenia">
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="check" name="mantener">
            <label class="form-check-label" for="check">Mantener sesion iniciada</label>
          </div>
          <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
      </div>
    </div>
    <div>
      <small>
        <p style="text-align: center;">¿No tienes una cuenta? <a href="registro.php">Registrate</a></p>
      </small>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>