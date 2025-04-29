<?php
//Incluimos el archivo con las constantes necesarias para la conexión a la base de datos.
require_once '.env.php';

//Incluimos la ruta absoluta al directorio config.php con la seguridad.
require_once __DIR__ . '/../config/config.php';

//Función para conectarnos a la base de datos
function db_conn(){
    static $mysqli_conn = null;

    //Si no existe ninguna conexión, crearemos una
    if($mysqli_conn == null){
        try{
            //Conexión a BBDD
            $mysqli_conn = new mysqli(SERVER_HOST, USER, PASSWORD, DATABASE_NAME);

            //Comprobar que la conexión se haya realizado
            if($mysqli_conn -> connect_errno){
                //Registramos el error en el archivo log
                error_log("Fallo al conectar a la base de datos: " . $mysqli_conn -> connect_errno);
                return null;
            }else{
                echo "La conexión ha funcionado correctamente";
            }
        } catch(Exception $e){
            //Registramos la excepción en el archivo log
            error_log("Error de conexión a la base de datos: " . $e->getMessage());
            return null;
        }
    }

    return $mysqli_conn;
}

//Ejecutamos la función de conexión
$mysqli_connection = db_conn();

//Si la función retorna un null, enviamos al usuario a nuestra página de error.
if($mysqli_connection == null){
    header('Location: ../views/errors/error500.html');
}

?>