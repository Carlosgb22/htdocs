<?php
require("conexion.php");
class sesion implements SessionHandlerInterface
{
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
    public function open($savePath, $sessionName): bool
    {
        $this->sessionId = $_COOKIE[$sessionName];
        if ($this->con)
            return true;
        return false;
    }
    /**
     * Callback invocado cuando se llama a las funciones session_destroy
     * o session_regenerate_id. Eliminamos los datos de la sesión en caso
     * de que existan.
     */
    public function destroy($sessionId): bool
    {
        try {
            $stmt = $this->con->prepare("DELETE FROM sessions WHERE session_id = ?");
            $stmt->bindParam(1, $sessionId, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();

            return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    }
    /**
     * Este callback se invoca después de realizar una escritura en la sesión. Actúa como
     * un destructor de la clase. En nuestro ejemplo no hacemos nada especial.
     */
    public function close(): bool
    {
        return true;
    }
    /**
     * Callback invocado por el recolector de basura de PHP. Las sesiones tienen
     * un tiempo de vida máximo configurado en el fichero php.ini. Este método
     * recibe como argumento el máximo tiempo de vida de las sesiones y después
     * elimina aquellas que están caducadas.
     */
    public function gc(int $max_lifetime): int|false
    {
        $past = time() - $max_lifetime;

        try {
            $stmt = $this->con->prepare("UPDATE usuario SET sesion = null WHERE 'creado' < ?");
            $stmt->bindParam(1, $past, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();

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
    public function read(string $id): string|false
    {
        try {
            $stmt = $this->con->prepare("SELECT 'session_data' FROM sessions WHERE 'session_id' = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_STR);
            $stmt->execute();
            $sessionData = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            if ($sessionData == null) {
                $sql = "INSERT INTO sessions(session_id, creado) VALUES (?,?)";
                $sentencia = $this->con->prepare($sql);
                $sessionId = $this->sessionId;
                $time = time();
                $sentencia->bindParam(1, $sessionId, PDO::PARAM_STR);
                $sentencia->bindParam(2, $time, PDO::PARAM_INT);
                try {
                    $sentencia->execute();
                } catch (PDOException $error) {
                    echo $error;
                }
                $sql = "INSERT INTO usuario(sesion) VALUES (?)";
                $sentencia = $this->con->prepare($sql);
                $sentencia->bindParam(1, $sessionId, PDO::PARAM_STR);
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
    public function write(string $id, string $data): bool
    {
        try {
            $stmt = $this->con->prepare("REPLACE INTO sessions('session_id', 'creado', 'session_data') VALUES(?, ?, ?)");
            $time = time();
            $stmt->bindParam(1, $id, PDO::PARAM_STR);
            $stmt->bindParam(2, $time, PDO::PARAM_INT);
            $stmt->bindParam(3, $data, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>_param