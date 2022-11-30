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
$sentencia->bind_param("s", $email);
$sentencia->execute();
$result = $sentencia->get_result();
foreach($result as $row){
    if(strcmp($pass, $row["contrasenia"]) == 0){
        header("Location: http://localhost/Bootstrap/index.php");
    }else{
        header("Location: http://localhost/Bootstrap/login.html");
    }
}
?>