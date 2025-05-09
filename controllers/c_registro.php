<?php
    require_once 'db_conn.php';
    require_once 'validationData.php';
    require_once __DIR__ . '/../config/config.php';
    require_once __DIR__ . '/clases/Cl_Usuarios.php';

    //Comprobamos si existe una sesión activa, y si no hay, la creamos.
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }


    //Comprobamos que la información nos llega por POST y por el formulario 'registro'.
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registro'])){

        //Saneamos los datos
        $nombre = htmlspecialchars($_POST['nombre']);
        $apellidos = htmlspecialchars($_POST['apellidos']);
        $telefono = htmlspecialchars($_POST['telefono']);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars($_POST['password']);
        $fnac = htmlspecialchars($_POST['fnac']);
        $direccion = htmlspecialchars($_POST['direccion']);
        $sexo = $_POST['sexo'];


        //Ejecutamos la función de validar el formulario de registro que está en el archivo valodationData.php
        $errores_validacion = validacion_registro($nombre, $apellidos, $telefono, $email, $password, $fnac, $direccion);


        //Si hay errores de validación, los metemos en una variable de sesión
        if(!empty($errores_validacion)){
            $text_error = "";

            foreach($errores_validacion as $clave=>$error){
                $text_error .= $error . "<br>";
            }

            $_SESSION['text_error'] = $text_error;

            header('Location: ../views/registro.php');
            exit();
        }

        $pass = password_hash($password, PASSWORD_BCRYPT);

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
                }else{
                    $_SESSION['mensaje_error'] = "El usuario no se ha podido registrar";
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