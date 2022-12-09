<?php
class conexion{
    function conectar(){
        $path = "datos.ini";
        $ar = parse_ini_file($path) or
            die("No se pudo abrir el archivo");
        $host = $ar['host'];
        $usuario = $ar['usuario'];
        $contrBd = $ar['contrasenia'];
        $nombreBd = $ar['dbname'];
        //$con = new PDO("myqsl:host = $host; dbname = $nombreBd", $usuario, $contrBd);
        try {
            $conexion = new PDO("mysql:host=$host;dbname=$nombreBd", $usuario, $contrBd);      
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          }
     
      catch(PDOException $e)
          {
          echo "La conexión ha fallado: " . $e->getMessage();
          }
        //$con = mysqli_connect($host, $usuario, $contrBd, $nombreBd);
        return $conexion;
    }
}
?>