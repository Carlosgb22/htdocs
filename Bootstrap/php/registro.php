<?php
require("conexion.php");

$nombre = htmlspecialchars($_REQUEST['nombre']);
$apellidos = htmlspecialchars($_REQUEST['apellidos']);
$email = htmlspecialchars($_REQUEST['email']);
$contrasenia = htmlspecialchars($_REQUEST['contrasenia']);
$contrasenia2 = htmlspecialchars($_REQUEST['contrasenia2']);
$direccion = htmlspecialchars($_REQUEST['direccion']);
$telefono = htmlspecialchars($_REQUEST['telefono']);
if ($contrasenia == "" || strcasecmp($contrasenia, $contrasenia2) != 0) {
    header("Location: http://localhost/Bootstrap/registro.php");
} else {
    $conexion = new conexion();
    $con = $conexion->conectar();
    if (!$con) {
        echo ("Fallo al conectar con la base de datos");
    }
    $pass = md5($contrasenia);
    $sql = "INSERT INTO usuario (nombre, apellidos, email, contrasenia, direccion, telefono) VALUES (?,?,?,?,?,?)";
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(1, $nombre, PDO::PARAM_STR);
    $sentencia->bindParam(2, $apellidos, PDO::PARAM_STR);
    $sentencia->bindParam(3, $email, PDO::PARAM_STR);
    $sentencia->bindParam(4, $pass, PDO::PARAM_STR);
    $sentencia->bindParam(5, $direccion, PDO::PARAM_STR);
    $sentencia->bindParam(6, $telefono, PDO::PARAM_INT);
    $sentencia->execute();
    $sentencia->closeCursor();
    header("Location: http://localhost/Bootstrap/index.php");
}
?>)