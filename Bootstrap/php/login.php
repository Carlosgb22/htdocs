<?php
require("conexion.php");

$email = htmlspecialchars($_REQUEST['email']);
$contrasenia = htmlspecialchars($_REQUEST['contrasenia']);
$mantener = htmlspecialchars($_REQUEST['mantener']);
if($mantener == ""){
    $mantener = 0;
}else{
    $mantener = 1;
}
$conexion = new conexion();
$con = $conexion->conectar();
$pass = md5($contrasenia);
$sql = "SELECT email, contrasenia FROM usuario where email = ?";
$sentencia = $con->prepare($sql);
$sentencia->bindParam(1, $email, PDO::PARAM_STR);
$sentencia->execute();
$result = $sentencia->fetch(PDO::FETCH_ASSOC);
if(strcmp($pass, $result['contrasenia']) == 0){
    header("Location: http://localhost/Bootstrap/index.php");
}else{
    header("Location: http://localhost/Bootstrap/login.php");
}
?>