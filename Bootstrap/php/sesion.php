<?php
require("conexion.php");
class sesion implements SessionHandlerInterface{
    private $con;
    private $sessionId;
    /**
     * Constructor para inicializar la conexión a la base de datos
     */
    public function __construct()
    {
        $conex = new conexion();
        $this->con = $conex->conectar();
    }
    /**
     * Callback que es llamado cuando se inicia la sesión
     * Devuelve true si ha sido posible crear la conexión a la bbdd
     */
    public function open($savePath, $sessionName):bool
    {
        $this-> sessionId = $_COOKIE[$sessionName];
        if($this->con)
            return true;
        return false;
    }
    /**
     * Callback invocado cuando se llama a las funciones session_destroy
     * o session_regenerate_id. Eliminamos los datos de la sesión en caso
     * de que existan.
     */
    public function destroy($sessionId):bool
    {
        try {
            $stmt = $this->con->prepare("DELETE FROM sessions WHERE session_id = ?");
            $stmt->bind_param("s", $sessionId);
            $stmt->execute();
            $stmt->close();
 
            return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    }
    /**
     * Este callback se invoca después de realizar una escritura en la sesión. Actúa como
     * un destructor de la clase. En nuestro ejemplo no hacemos nada especial.
     */
    public function close(): bool{
        echo "Se ha llamado a cerrar la sesión".$this->sessionId;
        return true;
    }
    /**
     * Callback invocado por el recolector de basura de PHP. Las sesiones tienen
     * un tiempo de vida máximo configurado en el fichero php.ini. Este método
     * recibe como argumento el máximo tiempo de vida de las sesiones y después
     * elimina aquellas que están caducadas.
     */
    public function gc(int $max_lifetime): int|false{
        $past = time() - $max_lifetime;
 
        try {
            $stmt = $this->con->prepare("UPDATE usuario SET sesion = null WHERE 'creado' < ?");
            $stmt->bind_param("i", $past);
            $stmt->execute();
            $stmt->close();
 
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    /**
     * Callback llamado después de abrir la sesión (open). Este método recibe
     * el id de la sesión. Se comprobará si el id de la sesión existe en la tabla
     * sessions. Si existe la sesión se devuelven los datos almacenados en la misma
     * en caso contrario se devuelve una cadena vacía
     */
    public function read(string $id): string|false{
        try {
            $stmt = $this->con->prepare("SELECT 'sesion' FROM usuario WHERE 'sesion' = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $stmt->bind_result($sessionData);
            $stmt->fetch();
            $stmt->close();
            if($sessionData == null){
                $sql = "INSERT INTO usuario('sesion') VALUES (?,)";
                $sentencia = $this->con->prepare($sql);
                $sentencia->bind_param("s", $sessionId);
                $sentencia->execute();
            }
            return $sessionData ? $sessionData : '';
        } catch (Exception $e) {
            return FALSE;
        }
    }
    /**
     * Callback invocado cada vez que se guarda una variable en la sesión
     * Recibe como parámetros el id de la sesión y los datos. Se ejecuta
     * un REPLACE para garantizar que si existe el campo clave en algún registro
     * de la tabla, se actualizan el resto de campos. En caso contrario
     * se crea un nuevo registro
     */
    public function write(string $id, string $data): bool{
        try {
            $stmt = $this->con->prepare("REPLACE INTO sessions('session_id', 'creado', 'session_data') VALUES(?, ?, ?)");
            $time = time();
            $stmt->bind_param('sis',$id, $time, $data);
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>