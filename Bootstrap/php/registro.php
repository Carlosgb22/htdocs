<?php 
require("conexion.php");

$nombre = htmlspecialchars($_REQUEST['nombre']);
$apellidos = htmlspecialchars($_REQUEST['apellidos']);
$email = htmlspecialchars($_REQUEST['email']);
$contrasenia = htmlspecialchars($_REQUEST['contrasenia']);
$contrasenia2 = htmlspecialchars($_REQUEST['contrasenia2']);
$direccion = htmlspecialchars($_REQUEST['direccion']);
$telefono = htmlspecialchars($_REQUEST['telefono']);
if($contrasenia == "" || strcasecmp($contrasenia, $contrasenia2) != 0){
    header("Location: http://localhost/Bootstrap/registro.html");
}else{
    $conexion = new conexion();
    $con = $conexion->conectar();
    if(!$con){
        echo("Fallo al conectar con la base de datos");
    }
    $pass = md5($contrasenia);
    $sql = "INSERT INTO usuario (nombre, apellidos, email, contrasenia, direccion, telefono) VALUES (?,?,?,?,?,?)";
    $sentencia = $con->prepare($sql);
    $sentencia->bind_param("sssssi", $nombre, $apellidos, $email, $pass, $direccion, $telefono);
    $sentencia->execute();
    $sentencia->close();
    header("Location: http://localhost/Bootstrap/index.html");
}
?>)