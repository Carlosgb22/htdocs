<?php 
require("conexion.php");

$email = htmlspecialchars($_REQUEST['email']);
$contrasenia = htmlspecialchars($_REQUEST['contrasenia']);
$contrasenia2 = htmlspecialchars($_REQUEST['contrasenia2']);
if($contrasenia == "" || strcasecmp($contrasenia, $contrasenia2) != 0){
    header("Location: http://localhost/Bootstrap/registro.html");
}else{
    $conexion = new conexion();
    $con = $conexion->conectar();
    if(!$con){
        echo("Fallo al conectar con la base de datos");
    }
    $pass = md5($contrasenia);
    $sql = "INSERT INTO usuario (nombre, contrasenia) VALUES (?,?)";
    $sentencia = $con->prepare($sql);
    $sentencia->bind_param("ss", $email, $pass);
    $sentencia->execute();
    $sentencia->close();
    header("Location: http://localhost/Bootstrap/index.html");
}
?>