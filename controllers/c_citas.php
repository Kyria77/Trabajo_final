<?php
    require_once 'db_conn.php';
    require_once 'validationData.php';
    require_once __DIR__ . '/../config/config.php';
    require_once __DIR__ . '/clases/Cl_Citas.php';

    if(session_status() == PHP_SESSION_NONE){
        session_start();
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

?>