<?php
class conexion{
    function conectar(){
        $path = "../datos.txt";
        $ar = fopen($path, "r") or
            die("No se pudo abrir el archivo");
        $host = fgets($ar);
        $host = str_replace("\n", "", $host);
        $usuario = fgets($ar);
        $usuario = str_replace("\n", "", $usuario);
        $contrBd = fgets($ar);
        $contrBd = str_replace("\n", "", $contrBd);
        $nombreBd = fgets($ar);
        fclose($ar);
        $con = mysqli_connect($host, $usuario, $contrBd, $nombreBd);
        return $con;
}
}
?>