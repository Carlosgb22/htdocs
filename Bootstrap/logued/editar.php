<?php
include_once('../php/cabezera.php');
require_once("../php/conexion.php");
$conex = new conexion();
$con = $conex->conectar();
$email = $_COOKIE['email'];
$sql = "SELECT * FROM usuario where email = ?";
$sentencia = $con->prepare($sql);
$sentencia->bindParam(1, $email, PDO::PARAM_STR);
$sentencia->execute();
$result = $sentencia->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Cuenta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="/Bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/Bootstrap/css/style.css">
</head>

<body>
  <div class="container">
    <div class="card" style="width: 50%; margin: auto;">
      <div class="card-body">
        <h5 class="card-title" style="text-align:center;">Editar Cuenta</h5>
        <form action="edit.php" method="post">
          <div class="form-group">
            <label for="inputFoto">Foto de Perfil</label>
            <img width="50" src="data:image/png;base64,<?php echo  base64_encode($result['imagen']); ?>">
            <input type="file" accept="image/png" id="inputFoto" name="imagen" />
          </div>
          <div class="form-group">
            <label for="inputNombre">Nombre</label>
            <input type="text" class="form-control" required id="inputNombre" placeholder="Introduzca nombre" name="nombre" value="<?php echo ($result['nombre']) ?>">
          </div>
          <div class="form-group">
            <label for="inputApellidos">Apellidos</label>
            <input type="text" class="form-control" required id="inputApellidos" placeholder="Introduzca apellidos" name="apellidos" value="<?php echo ($result['apellidos']) ?>">
          </div>
          <div class="form-group">
            <label for="inputEmail">Correo Electronico</label>
            <input type="email" class="form-control" disabled required id="inputEmail" aria-describedby="emailHelp" placeholder="Introduzca email" name="email" value="<?php echo ($result['email']) ?>">
          </div>
          <div class="form-group">
            <label for="inputDireccion">Direccion</label>
            <input type="text" class="form-control" required id="inputDireccion" placeholder="Introduzca su direccion" name="direccion" value="<?php echo ($result['direccion']) ?>">
          </div>
          <div class="form-group">
            <label for="inputTelefono">Telefono</label>
            <input type="tel" pattern="[0-9]{9}" title="Un numero de telefono valido consiste en 9 digitos" required class="form-control" id="inputTelefono" placeholder="Introduzca su telefono" name="telefono" value="<?php echo ($result['telefono']) ?>">
          </div>
          <button type="submit" class="btn btn-primary">Editar</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>