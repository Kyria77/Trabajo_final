<?php
    require_once 'db_conn.php';
    require_once 'validationData.php';
    require_once __DIR__ . '/../config/config.php';
    require_once __DIR__ . '/clases/Cl_Citas.php';

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //Redirigir al LOGIN si el usuario no ha iniciaco sesión (es decir, si no existe user_id)
    if(!isset($_SESSION['user_data_all'])){
        $_SESSION["mensaje_error"] = "Lo sentimos, debes iniciar sesión primero";
        header("Location: ../views/login.php");
        exit();
    }
    

    //Comprobamos que la información nos llega por POST y por el formulario 'citas'.
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cita'])){

        //Saneamos los datos
        $asunto = htmlspecialchars($_POST['asunto']);
        $fcita = htmlspecialchars($_POST['fcita']);

        //Ejecutamos la función de validar el formulario de registro que está en el archivo valodationData.php
        $errores_validacion = validacion_citas($asunto, $fcita);

        //Si hay errores de validación, los metemos en una variable de sesión
        if(!empty($errores_validacion)){
            $text_error = "";

            foreach($errores_validacion as $clave=>$error){
                $text_error .= $error . "<br>";
            }

            $_SESSION['mensaje_error'] = $text_error;

            header('Location: ../views/users/citas.php');
            exit();
        }

        try{
            $exception_error = false;
            $citaObj = new Cita();
            $idUser = $_SESSION['user_data_all']['idUser'];

            if($citaObj->insertarCita($idUser, $fcita, $asunto, $mysqli_connection, $exception_error)){
                $_SESSION['mensaje_exito'] = "La cita se ha registrado correctamente";
                header("Location: ../views/users/citas.php");
                exit();
            }else{
                $_SESSION['mensaje_error'] = "La cita no se ha podido registrar";
                header('Location: ../views/errors/error500.html');
                exit();
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

        //Saneamos los datos
        $asunto = htmlspecialchars($_POST['asunto']);
        $fcita = htmlspecialchars($_POST['fcita']);
        $idCita = $_POST['idCita'];

        //Ejecutamos la función de validar el formulario de registro que está en el archivo valodationData.php
        $errores_validacion = validacion_citas($asunto, $fcita);

        //Si hay errores de validación, los metemos en una variable de sesión
        if(!empty($errores_validacion)){
            $text_error = "";

            foreach($errores_validacion as $clave=>$error){
                $text_error .= $error . "<br>";
            }

            $_SESSION['mensaje_error'] = $text_error;

            header('Location: ../views/users/citas.php');
            exit();
        }

        try{
            $citaObj = new Cita();

            if($citaObj->actualizarCita($idCita, $fcita, $asunto, $mysqli_connection)){
                $_SESSION['mensaje_exito'] = "La cita se ha actualizado correctamente";
                header("Location: ../views/users/citas.php");
                exit();
            }else{
                $_SESSION['mensaje_error'] = "La cita no se ha podido registrar";
                header('Location: ../views/errors/error500.html');
                exit();
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
            $citaObj = new Cita();
            $idCita = $_POST['idCita'];

            if($citaObj->borrarCita($idCita, $mysqli_connection)){
                $_SESSION['mensaje_exito'] = "La cita se ha borrado correctamente";
                header("Location: ../views/users/citas.php");
                exit();
            }else{
                $_SESSION['mensaje_error'] = "La cita no se ha podido borrar";
                header('Location: ../views/errors/error500.html');
                exit();
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