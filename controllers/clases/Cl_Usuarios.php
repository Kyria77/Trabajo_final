<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../db_conn.php';

class Usuario{
    public function __construct(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    //Función para comprobar si existe o no el usuario en la tabla users_data de la base de datos 
    public function comprobarUsuario($email, $mysqli_connection, &$exception_error){
        $select_stmt = null;

        try{
            //Sentencia SQL
            $select_stmt = $mysqli_connection->prepare('SELECT email FROM users_data WHERE email = ?');

            if($select_stmt === false){
                error_log("No se preparó la sentencia: " . $mysqli_connection->error);
                $exception_error = true;
                echo "No he preparado la sentencia";
                return false;
            }

            $select_stmt->bind_param("s", $email);

            //Comprobamos si podemos ejecutar la sentencia
            if(!$select_stmt->execute()){
                error_log(("No se ejecutó la sentencia: ") . $select_stmt->error);
                $exception_error = true;
                return false;
            }

            //Guardamos el resultado de la sentencia
            $select_stmt->store_result();

            //Devolvemos true si se ha encontrado usuario o false si no se ha encontrado
            return $select_stmt->num_rows > 0;
        }catch(Exception $e){
            error_log(("Error en la función comprobarUsuario: " . $e->getMessage()));
            $exception_error = true;
            return false;
        }finally{
            if($select_stmt !== null){
                $select_stmt->close();
            }
        }
    }
    
    
    //Función para buscar a un usuario y sus datos a través del email en la tabla users_data de la base de datos
    public function leerUsuarioByEmail($email, $mysqli_connection, &$exception_error){
        $select_stmt = null;

        try{
            //Sentencia SQL
            $select_stmt = $mysqli_connection->prepare('SELECT * FROM users_data WHERE email = ?');

            if($select_stmt === false){
                error_log("No se preparó la sentencia: " . $mysqli_connection->error);
                $exception_error = true;
                echo "No he preparado la sentencia";
                return false;
            }

            $select_stmt->bind_param("s", $email);

            //Comprobamos si podemos ejecutar la sentencia
            if(!$select_stmt->execute()){
                error_log(("No se ejecutó la sentencia: ") . $select_stmt->error);
                $exception_error = true;
                return false;
            }

            //Guardamos el resultado de la sentencia
            $result = $select_stmt->get_result();
            if($result->num_rows > 0){
                $user = $result->fetch_assoc();
                return $user;
            }else{
                return false;
            }

        }catch(Exception $e){
            error_log(("Error en la función comprobarUsuario: " . $e->getMessage()));
            $exception_error = true;
            return false;
        }finally{
            if($select_stmt !== null){
                $select_stmt->close();
            }
        }
    }

    //Función para buscar a un usuario y sus datos a través del id en la tabla users_data de la base de datos
    public function leerUsuarioById($id, $mysqli_connection, &$exception_error){
        $select_stmt = null;

        try{
            //Sentencia SQL
            $select_stmt = $mysqli_connection->prepare('SELECT * FROM users_data WHERE idUser = ?');

            if($select_stmt === false){
                error_log("No se preparó la sentencia: " . $mysqli_connection->error);
                $exception_error = true;
                echo "No he preparado la sentencia";
                return false;
            }

            $select_stmt->bind_param("s", $id);

            //Comprobamos si podemos ejecutar la sentencia
            if(!$select_stmt->execute()){
                error_log(("No se ejecutó la sentencia: ") . $select_stmt->error);
                $exception_error = true;
                return false;
            }

            //Guardamos el resultado de la sentencia
            $result = $select_stmt->get_result();
            if($result->num_rows > 0){
                $user = $result->fetch_assoc();
                return $user;
            }else{
                return false;
            }

        }catch(Exception $e){
            error_log(("Error en la función comprobarUsuario: " . $e->getMessage()));
            $exception_error = true;
            return false;
        }finally{
            if($select_stmt !== null){
                $select_stmt->close();
            }
        }
    }

    //Función para buscar a un usuario y sus datos a través del email en la tabla users_login de la base de datos
    public function read_user_login($email, $mysqli_connection, &$exception_error){
        $select_stmt = null;

        try{
            //Sentencia SQL
            $select_stmt = $mysqli_connection->prepare('SELECT * FROM users_login WHERE email = ?');

            if($select_stmt === false){
                error_log("No se preparó la sentencia: " . $mysqli_connection->error);
                $exception_error = true;
                echo "No he preparado la sentencia";
                return false;
            }

            $select_stmt->bind_param("s", $email);

            //Comprobamos si podemos ejecutar la sentencia
            if(!$select_stmt->execute()){
                error_log(("No se ejecutó la sentencia: ") . $select_stmt->error);
                $exception_error = true;
                return false;
            }

            //Guardamos el resultado de la sentencia
            $result = $select_stmt->get_result();
            if($result->num_rows > 0){
                $user = $result->fetch_assoc();
                return $user;
            }else{
                return false;
            }

        }catch(Exception $e){
            error_log(("Error en la función comprobarUsuario: " . $e->getMessage()));
            $exception_error = true;
            return false;
        }finally{
            if($select_stmt !== null){
                $select_stmt->close();
            }
        }
    }
    
}




?>