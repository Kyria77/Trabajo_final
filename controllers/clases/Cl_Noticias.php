<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../db_conn.php';

class Noticia{
    public function __construct(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    //Función para buscar y leer todas las noticias de la base de datos con todos sus datos.
    public function leerNoticia($mysqli_connection){
        $select_stmt = null;
    
        try{
            $select_stmt = $mysqli_connection->prepare('SELECT n.titulo AS NotiTitulo, n.texto, n.fecha_creacion, n.idNoticia, i.idImagen, i.nombre AS imaNombre, i.alt, i.width, i.heigth, i.titulo AS imaTitulo, ud.idUser AS identUser, ud.nombre AS userNombre, ud.apellidos FROM noticias n JOIN imagenes i ON i.idImagen = n.idImagen JOIN users_data ud ON ud.idUser = n.idUser;');
    
            if($select_stmt === false){
                error_log("No se pudo preparar la sentencia" . $mysqli_connection->error);
                return false;
            }
    
            if(!$select_stmt->execute()){
                error_log(("No se pudo ejecutar la sentencia " . $mysqli_connection->error));
                return false;
            }
    
            $result = $select_stmt->get_result();
            $noticias = [];
    
            if($result->num_rows > 0){
                while($fila = $result->fetch_assoc()){
                    $noticias[] = $fila;
                }
                return $noticias;
            }else{
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

    //Función para INSERTAR una nueva imagen de un admin en la base de datos
    public function insertarImagen($nombre, $alt, $width, $heigth, $mysqli_connection, &$exception_error){
        $insert_stmt = null;

        try{
            $query = "INSERT INTO imagenes(nombre, alt, width, heigth, titulo) VALUES (?, ?, ?, ?, ?)";
            $insert_stmt = $mysqli_connection->prepare($query);

            if(!$insert_stmt){
                error_log("No se preparó la sentencia de inserción: " . $mysqli_connection->error);
                $exception_error = true;
                return false;
            }else{
                $insert_stmt->bind_param("sssss", $nombre, $alt, $width, $heigth, $alt);

                if(!$insert_stmt->execute()){
                    error_log(("No se ejecutó la sentencia de inserción: ") . $insert_stmt->error);
                    $exception_error = true;
                    return false;
                }else{
                    $idImagen = $insert_stmt->insert_id;
                    return $idImagen;
                }
            }
        }catch(Exception $e){
            error_log(("Error en la función insertarUsuario: " . $e->getMessage()));
            header('Location: ../../views/errors/error500.html');
        }
    }
    //Función para INSERTAR una nueva noticia de un admin en la base de datos
    public function insertarNoticia($titulo, $idImagen, $texto, $fecha_creacion, $idUser, $mysqli_connection, &$exception_error){
        $insert_stmt = null;

        try{
            $query = "INSERT INTO noticias(titulo, idImagen, texto, fecha_creacion, idUser) VALUES (?, ?, ?, ?, ?)";
            $insert_stmt = $mysqli_connection->prepare($query);

            if(!$insert_stmt){
                error_log("No se preparó la sentencia de inserción: " . $mysqli_connection->error);
                $exception_error = true;
                return false;
            }else{
                $insert_stmt->bind_param("sissi", $titulo, $idImagen, $texto, $fecha_creacion, $idUser);

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

    //Función para actualizar los datos de una noticia de la tabla noticias de la base de datos
    public function actualizarNoticia($idNoticia, $titulo, $idImagen, $texto, $fcreacion, $idUser, $mysqli_connection){
        $insert_stmt = null;

        try{
            $query = "UPDATE noticias SET titulo = ?, idImagen = ?, texto = ?, fecha_creacion = ?, idUser = ? WHERE idNoticia = ?";
            $insert_stmt = $mysqli_connection->prepare($query);

            if(!$insert_stmt){
                error_log("No se preparó la sentencia de actualización: " . $mysqli_connection->error);
                return false;
            }else{
                $insert_stmt->bind_param("sissii", $titulo, $idImagen, $texto, $fcreacion, $idUser, $idNoticia);

                if(!$insert_stmt->execute()){
                    error_log(("No se ejecutó la sentencia de actualización: ") . $insert_stmt->error);
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

    //Función para actualizar los datos de una imagen de la tabla imágenes de la base de datos
    public function actualizarImagen($idImagen, $nombre, $alt, $width, $heigth, $mysqli_connection){
        $insert_stmt = null;

        try{
            $query = "UPDATE imagenes SET nombre = ?, alt = ?, width = ?, heigth = ?, titulo = ? WHERE idImagen = ?";
            $insert_stmt = $mysqli_connection->prepare($query);

            if(!$insert_stmt){
                error_log("No se preparó la sentencia de actualización: " . $mysqli_connection->error);
                return false;
            }else{
                $insert_stmt->bind_param("sssssi", $nombre, $alt, $width, $heigth, $alt, $idImagen);

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


    //Función para borrar una noticia en la tabla noticias de la base de datos
    public function borrarNoticia($idNoticia, $mysqli_connection){
        $insert_stmt = null;

        try{
            $query = "DELETE FROM noticias WHERE idNoticia = ?";
            $insert_stmt = $mysqli_connection->prepare($query);

            if(!$insert_stmt){
                error_log("No se preparó la sentencia de borrado: " . $mysqli_connection->error);
                return false;
            }else{
                $insert_stmt->bind_param("i", $idNoticia);

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
    //Función para borrar una imagen en la tabla imágenes de la base de datos
    public function borrarImagen($idImagen, $mysqli_connection){
        $insert_stmt = null;

        try{
            $query = "DELETE FROM imagenes WHERE idImagen = ?";
            $insert_stmt = $mysqli_connection->prepare($query);

            if(!$insert_stmt){
                error_log("No se preparó la sentencia de borrado: " . $mysqli_connection->error);
                return false;
            }else{
                $insert_stmt->bind_param("i", $idImagen);

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