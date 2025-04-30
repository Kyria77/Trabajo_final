<?php
require_once __DIR__ . '/../config/config.php';
require_once 'db_conn.php';

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
            $select_stmt = $mysqli_connection->prepare('SELECT n.titulo AS NotiTitulo, n.texto, n.fecha_creacion, i.nombre AS imaNombre, i.alt, i.width, i.heigth, i.titulo AS imaTitulo, ud.nombre AS userNombre, ud.apellidos FROM noticias n JOIN imagenes i ON i.idImagen = n.idImagen JOIN users_data ud ON ud.idUser = n.idUser;');
    
            if($select_stmt === false){
                error_log("No se pudo preparar la sentencia" . $mysqli_connection->error);
                //$exception_error = true;
                echo "No se pudo preparar la sentencia";
                return false;
            }
    
            if(!$select_stmt->execute()){
                error_log(("No se pudo ejecutar la sentencia " . $mysqli_connection->error));
                //$exception_error = true;
                echo "No se pudo ejecutar la sentencia";
                return false;
            }
    
            $result = $select_stmt->get_result();
            $noticias = [];
    
            if($result->num_rows > 0){
                while($fila = $result->fetch_assoc()){
                    $noticias[] = $fila;
                    echo "<br>";
                }
                echo "Estoy leyendo las noticias";
                return $noticias;
            }else{
                echo "No hay noticias disponibles";
                return false;
            }
        }catch(Exception $e){
            error_log("Error al ejecutar la función: " . $e->getMessage());
            //$exception_error = true;
            return false;
        } finally{
            if($select_stmt !== null){
                $select_stmt->close();
            }
        }
    }
    
}




?>