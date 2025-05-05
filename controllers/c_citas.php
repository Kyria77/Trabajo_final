<?php
    require_once 'db_conn.php';
    require_once 'validationData.php';
    require_once __DIR__ . '/../config/config.php';
    require_once __DIR__ . '/clases/Cl_Citas.php';

    //Comprobamos si existe una sesión activa, y si no hay, la creamos.
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //echo "He iniciado sesión";

    //Comprobamos que la información nos llega por POST y por el formulario 'registro'.
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
            $usuarioObj = new Usuario();

            //Si el resultado de comprobarUsuario es true, ese usuario ya existe
            if($usuarioObj->comprobarUsuario($email, $mysqli_connection, $exception_error)){
                $_SESSION['mensaje_error'] = "El usuario ya existe en la base de datos";
                header("Location: ../views/registro.php");
                exit();
            }else{
                if($usuarioObj->insertarUsuario($nombre, $apellidos, $email, $telefono, $fnac, $direccion, $sexo, $mysqli_connection, $exception_error)){
                    $_SESSION['mensaje_exito'] = "El usuario se ha registrado en data perfectamente";
                    //header("Location: ../views/registro.php");
                    //exit();
                }else{
                    $_SESSION['mensaje_error'] = "El usuario no se ha podido registrar";
                    //header('Location: ../views/errors/error500.html');
                    //exit();
                }

                $datosUsuario = $usuarioObj->leerUsuarioByEmail($email, $mysqli_connection, $exception_error);
                if($datosUsuario){
                    $id = $datosUsuario['idUser'];
                    $rol = "user";
                    if($usuarioObj->insert_user_login($id, $email, $pass, $rol, $mysqli_connection, $exception_error)){
                        $_SESSION['mensaje_exito'] = "El usuario se ha registrado correctamente";
                        header("Location: ../views/login.php");
                        exit();
                    }else{
                        $_SESSION['mensaje_error'] = "El usuario no se ha podido registrar";
                        header('Location: ../views/errors/error500.html');
                        exit();
                    }
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