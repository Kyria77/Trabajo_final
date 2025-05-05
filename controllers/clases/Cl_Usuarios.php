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
        }/*finally{
            if($select_stmt !== null){
                $select_stmt->close();
            }
        }*/
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

    //Función para INSERTAR a un usuario y sus datos en la tabla users_data de la base de datos
    public function insertarUsuario($nombre, $apellidos, $email, $telefono, $fnac, $direccion, $sexo, $mysqli_connection, &$exception_error){
        $insert_stmt = null;

        try{
            $query = "INSERT INTO users_data(nombre, apellidos, email, telefono, fnac, direccion, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insert_stmt = $mysqli_connection->prepare($query);

            if(!$insert_stmt){
                error_log("No se preparó la sentencia de inserción: " . $mysqli_connection->error);
                $exception_error = true;
                echo "No he preparado la sentencia";
                return false;
            }else{
                $insert_stmt->bind_param("sssssss", $nombre, $apellidos, $email, $telefono, $fnac, $direccion, $sexo);

                if(!$insert_stmt->execute()){
                    error_log(("No se ejecutó la sentencia de inserción: ") . $insert_stmt->error);
                    $exception_error = true;
                    return false;
                }else{
                    return true;
                }
            }
        }catch(Exception $e){
            error_log(("Error en la función insertarUsuario: " . $e->getMessage()));
            header('Location: ../../views/errors/error500.html');
        }/*finally{
            if(isset($insert_stmt) && ($insert_stmt)){
                $insert_stmt->close();
            }

            if(isset($mysqli_connection) && ($mysqli_connection)){
                $mysqli_connection->close();
            }
        }*/
    }

    //Función para actualizar los datos de un usuario en la tabla users_data de la base de datos
    public function actualizarUsuario($idUser, $nombre, $apellidos, $telefono, $fnac, $direccion, $sexo, $mysqli_connection){
        $insert_stmt = null;

        try{
            $query = "UPDATE users_data SET nombre = ?, apellidos = ?, telefono = ?, fnac = ?, direccion = ?, sexo = ? WHERE idUser = ?";
            $insert_stmt = $mysqli_connection->prepare($query);

            if(!$insert_stmt){
                error_log("No se preparó la sentencia de actualización: " . $mysqli_connection->error);
                return false;
            }else{
                $insert_stmt->bind_param("sssssss", $nombre, $apellidos, $telefono, $fnac, $direccion, $sexo, $idUser);

                if(!$insert_stmt->execute()){
                    error_log(("No se ejecutó la sentencia de inserción: ") . $insert_stmt->error);
                    return false;
                }else{
                    return true;
                }
            }
        }catch(Exception $e){
            error_log(("Error en la función insertarUsuario: " . $e->getMessage()));
            header('Location: ../../views/errors/error500.html');
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

    //Función para INSERTAR a un usuario y sus datos en la tabla users_login de la base de datos
    public function insert_user_login($idUser, $email, $password, $rol, $mysqli_connection, &$exception_error){
        $insert_stmt = null;

        try{
            $query = "INSERT INTO users_login(idUser, usuario, pass, rol) VALUES (?, ?, ?, ?)";
            $insert_stmt = $mysqli_connection->prepare($query);

            if(!$insert_stmt){
                error_log("No se preparó la sentencia de inserción user login: " . $mysqli_connection->error);
                $exception_error = true;
                echo "No he preparado la sentencia";
                return false;
            }else{
                $insert_stmt->bind_param("ssss", $idUser, $email, $password, $rol);

                if(!$insert_stmt->execute()){
                    error_log(("No se ejecutó la sentencia de inserción en user login: ") . $insert_stmt->error);
                    $exception_error = true;
                    return false;
                }else{
                    return true;
                }
            }
        }catch(Exception $e){
            error_log(("Error en la función insertarUsuario: " . $e->getMessage()));
            header('Location: ../../views/errors/error500.html');
        }/*finally{
            if(isset($insert_stmt) && ($insert_stmt)){
                $insert_stmt->close();
            }

            if(isset($mysqli_connection) && ($mysqli_connection)){
                $mysqli_connection->close();
            }
        }*/
    }


    //Función para leer todos los datos de un usuario incluidas las dos tablas users_data y users_login
    public function read_all_user_info($email, $mysqli_connection, &$exception_error){
        $select_stmt = null;

        try{
            //Sentencia SQL
            $select_stmt = $mysqli_connection->prepare('SELECT * FROM users_data ud JOIN users_login ul ON ud.idUser = ul.idUser WHERE ud.email = ?;');

            if($select_stmt === false){
                error_log("No se preparó la sentencia: " . $mysqli_connection->error);
                $exception_error = true;
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

    //Función para actualizar los datos de un usuario en la tabla users_login de la base de datos
    public function update_user_login($idUser, $password, $mysqli_connection){
        $insert_stmt = null;

        try{
            $query = "UPDATE users_login SET pass = ? WHERE idUser = ?";
            $insert_stmt = $mysqli_connection->prepare($query);

            if(!$insert_stmt){
                error_log("No se preparó la sentencia de actualización: " . $mysqli_connection->error);
                return false;
            }else{
                $insert_stmt->bind_param("ss", $password, $idUser);

                if(!$insert_stmt->execute()){
                    error_log(("No se ejecutó la sentencia de inserción: ") . $insert_stmt->error);
                    return false;
                }else{
                    return true;
                }
            }
        }catch(Exception $e){
            error_log(("Error en la función insertarUsuario: " . $e->getMessage()));
            header('Location: ../../views/errors/error500.html');
        }
    }
    
}




?>