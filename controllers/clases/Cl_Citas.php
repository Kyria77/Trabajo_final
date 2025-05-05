<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../db_conn.php';

class Cita{
    public function __construct(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    //Función para buscar y leer todas las citas un usuario, que aún no hayan ocurrido.
    public function leerCitaPendiente($idUSer, $mysqli_connection){
        $select_stmt = null;
    
        try{
            $select_stmt = $mysqli_connection->prepare('SELECT * FROM citas WHERE fecha_cita >= CURDATE() AND idUSer = ?');
    
            if($select_stmt === false){
                error_log("No se pudo preparar la sentencia" . $mysqli_connection->error);
                return false;
            }

            $select_stmt->bind_param("s", $idUSer);
    
            if(!$select_stmt->execute()){
                error_log(("No se pudo ejecutar la sentencia " . $mysqli_connection->error));
                return false;
            }
    
            $result = $select_stmt->get_result();
            $citas = [];
    
            if($result->num_rows > 0){
                while($fila = $result->fetch_assoc()){
                    $citas[] = $fila;
                    echo "<br>";
                }
                return $citas;
            }else{
                echo "No hay noticias disponibles";
                return false;
            }
        }catch(Exception $e){
            error_log("Error al ejecutar la función: " . $e->getMessage());
            return false;
        } finally{
            if($select_stmt !== null){
                $select_stmt->close();
            }
        }
    }


    //Función para INSERTAR una nueva cita de un usuario en la base de datos
    public function insertarCita($idUser, $fcita, $asunto, $mysqli_connection, &$exception_error){
        $insert_stmt = null;

        try{
            $query = "INSERT INTO citas(idUser, fecha_cita, motivo_cita) VALUES (?, ?, ?)";
            $insert_stmt = $mysqli_connection->prepare($query);

            if(!$insert_stmt){
                error_log("No se preparó la sentencia de inserción: " . $mysqli_connection->error);
                $exception_error = true;
                return false;
            }else{
                $insert_stmt->bind_param("sss", $idUser, $fcita, $asunto);

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
        }
    }


/*
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


*/


    
}
?>