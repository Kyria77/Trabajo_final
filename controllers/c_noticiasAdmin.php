<?php
    require_once 'db_conn.php';
    require_once 'validationData.php';
    require_once __DIR__ . '/../config/config.php';
    require_once __DIR__ . '/clases/Cl_Noticias.php';

    # Comprobar si existe una sesión activa y en caso de que no así la crearemos
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    # Redirigir al LOGIN si el usuario no ha iniciaco sesión (es decir, si no existe user_id)
    if(!isset($_SESSION['user_data_all']) && $_SESSION['user_data_all']['rol'] !== 'admin'){
        $_SESSION["mensaje_error"] = "Lo sentimos, debes iniciar sesión primero";
        header("Location: ../../views/login.php");
        exit();
    }else{
        $user_data = $_SESSION['user_data_all'];
    }


    //Comprobamos que la información nos llega por POST y por el formulario 'crearNoticia'.
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crearNoticia'])){

        //Recogemos los datos
        $titulo = $_POST["titulo"];
        $texto = $_POST["texto"];
        $fcreacion = $_POST["fcreacion"];
        $imagen = $_POST["imagen"];
        $alternativo = $_POST["alternativo"];
        $anchura = $_POST["anchura"];
        $altura = $_POST["altura"];
        $idUser = $_SESSION['user_data_all']['idUser'];

        try{
            $exception_error = false;
            $noticiaObj = new Noticia();

            $idImagen = $noticiaObj->insertarImagen($imagen, $alternativo, $anchura, $altura, $mysqli_connection, $exception_error);
            if($idImagen){
                if($noticiaObj->insertarNoticia($titulo, $idImagen, $texto, $fcreacion, $idUser, $mysqli_connection, $exception_error)){
                    $_SESSION['mensaje_exito'] = "La noticia se ha registrado correctamente";
                    header("Location: ../views/admin/noticiasAdmin.php");
                    exit();
                }else{
                    $_SESSION['mensaje_error'] = "La noticia no se ha podido registrar";
                    header('Location: ../views/errors/error500.html');
                    exit();
                }
            }
        }catch(Exception $e){
            error_log("Error en registro: " . $e->getMessage());
            header('Location ../views/errors/error500.html');
        }finally{
            if($mysqli_connection){
                $mysqli_connection->close();
            }
        }

    }

    //Comprobamos que la información nos llega por POST y por el formulario 'actualizar'.
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar'])){

        $titulo = htmlspecialchars($_POST['titulo']);
        $texto = htmlspecialchars($_POST['texto']);
        $imagen = htmlspecialchars($_POST['imagen']);
        $alternativo = htmlspecialchars($_POST['alternativo']);
        $anchura = htmlspecialchars($_POST['anchura']);
        $altura = htmlspecialchars($_POST['altura']);
        $fcreacion = $_POST['fcreacion'];
        $idNoticia = $_POST['idNoticia'];
        $idImagen = $_POST['idImagen'];
        $idUser = $_POST['idUser'];

        try{
            $noticiaObj = new Noticia();

            if($noticiaObj->actualizarImagen($idImagen, $imagen, $alternativo, $anchura, $altura, $mysqli_connection)){
                if($noticiaObj->actualizarNoticia($idNoticia, $titulo, $idImagen, $texto, $fcreacion, $idUser, $mysqli_connection)){
                    $_SESSION['mensaje_exito'] = "La cita se ha actualizado correctamente";
                    header("Location: ../views/admin/modificarCitas.php");
                    exit();
                }else{
                    $_SESSION['mensaje_error'] = "La cita no se ha podido registrar";
                    header('Location: ../views/errors/error500.html');
                    exit();
                }
            }
        }catch(Exception $e){
            error_log("Error en registro: " . $e->getMessage());
            header('Location ../views/errors/error500.html');
        }finally{
            if($mysqli_connection){
                $mysqli_connection->close();
            }
        }

    }


    //Comprobamos que la información nos llega por POST y por el formulario 'borrar'.
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['borrar'])){

        try{
            $noticiaObj = new Noticia();
            $idNoticia = $_POST['idNoticia'];
            $idImagen = $_POST['idImagen'];

            if($noticiaObj->borrarImagen($idImagen, $mysqli_connection)){
                if($noticiaObj->borrarNoticia($idNoticia, $mysqli_connection)){
                    $_SESSION['mensaje_exito'] = "La cita se ha borrado correctamente";
                    header("Location: ../views/admin/modificarCitas.php");
                    exit();
                }else{
                    $_SESSION['mensaje_error'] = "La cita no se ha podido borrar";
                    header('Location: ../views/errors/error500.html');
                    exit();
                }
            }
        }catch(Exception $e){
            error_log("Error en registro: " . $e->getMessage());
            header('Location ../views/errors/error500.html');
        }finally{
            if($mysqli_connection){
                $mysqli_connection->close();
            }
        }

    }


    ?>