<?php
require_once("../php/conexion.php");
$conex = new conexion();
$con = $conex->conectar();
//NO FUNCIONA
if(strcmp($_REQUEST['imagen'], '') == 0){
    $stmt = $con->prepare("REPLACE INTO usuario('nombre', 'apellidos', 'direccion', 'telefono') VALUES(?, ?, ?, ?) WHERE 'email' = ?");
    $stmt->bindParam(1, $_REQUEST['nombre'], PDO::PARAM_STR);
    $stmt->bindParam(2, $_REQUEST['apellidos'], PDO::PARAM_STR);
    $stmt->bindParam(3, $_REQUEST['direccion'], PDO::PARAM_STR);
    $stmt->bindParam(4, $_REQUEST['telefono'], PDO::PARAM_INT);
    $stmt->bindParam(5, $_REQUEST['email'], PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
}else{
    $stmt = $con->prepare("REPLACE INTO usuario('nombre', 'apellidos', 'direccion', 'telefono', 'imagen') VALUES(?, ?, ?, ?, ?) WHERE 'email' = ?");
    $stmt->bindParam(1, $_REQUEST['nombre'], PDO::PARAM_STR);
    $stmt->bindParam(2, $_REQUEST['apellidos'], PDO::PARAM_STR);
    $stmt->bindParam(3, $_REQUEST['direccion'], PDO::PARAM_STR);
    $stmt->bindParam(4, $_REQUEST['telefono'], PDO::PARAM_INT);
    $stmt->bindParam(5, $_REQUEST['imagen'], PDO::PARAM_LOB);
    $stmt->bindParam(6, $_REQUEST['email'], PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
}


?>