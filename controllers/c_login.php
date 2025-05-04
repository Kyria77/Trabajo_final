<?php
    require_once 'db_conn.php';
    require_once 'validationData.php';
    require_once __DIR__ . '/../config/config.php';
    require_once __DIR__ . '/clases/Cl_Usuarios.php';

    //Comprobamos si existe una sesión activa, y si no hay, la creamos.
    if(session_status() == PHP_SESSION_NONE){
        session_start();
        //exit;
    }

    //var_dump($_POST);
    //echo "He iniciado sesión";

    //Comprobamos que la información nos llega por POST y por el formulario 'registro'.
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_origen']) && $_POST['form_origen'] === 'login'){

        //Saneamos los datos
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars($_POST['password']);

        //echo "He saneado el formulario";

        //Ejecutamos la función de validar el formulario de registro que está en el archivo valodationData.php
        $errores_validacion = validar_login($email, $password);

        //echo "HE validado el formulario";

        //Si hay errores de validación, los metemos en una variable de sesión
        if(!empty($errores_validacion)){
            $text_error = "";

            foreach($errores_validacion as $clave=>$error){
                $text_error .= $error . "<br>";
            }

            $_SESSION['mensaje_error'] = $text_error;

            header('Location: ../views/login.php');
            exit();
        }

        //Comprobamos el inicio de sesión
        try{
            $exception_error = false;
            $usuarioObj = new Usuario();
            $user = $usuarioObj->read_all_user_info($email, $mysqli_connection, $exception_error);

            if($exception_error){
                $_SESSION['mensaje_error'] = "Algo no fue bien. Por favor, inténtelo un poco más tarde.";
                header('Location: ../views/login.php');
                exit();
            }

            if($user){
                //Si ha encontyrado usuario, comprobamos su contraseña
                if(password_verify($password, $user['pass'])){
                    $_SESSION['user_data_all'] = $user;
                    $_SESSION['mensaje_exito'] = "Inicio de sesión correcto. Welcome, " . $user['nombre'] . "!";
                    header('Location: ../views/users/perfil.php');
                    exit();
                }else{
                    //Si la contraseña no coincide
                    $_SESSION['mensaje_error'] = "La contraseña no es correcta";
                    header('Location: ../views/login.php');
                    exit();
                }
            }else{
                //Si no encuentra a nadie con ese email
                $_SESSION['mensaje_error'] = "No se encontró a ningún usuario con ese correo electrónico";
                header('Location: ../views/login.php');
                exit();
            }
        }catch(Exception $e){
            error_log("Error en iniciar sesión: " . $e->getMessage());
            header('Location ../views/errors/error500.html');
            exit();
        }finally{
            if($mysqli_connection){
                $mysqli_connection->close();
            }
        }

    }

?>