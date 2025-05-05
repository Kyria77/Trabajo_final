<?php
    require_once 'db_conn.php';
    require_once 'validationData.php';
    require_once __DIR__ . '/../config/config.php';
    require_once __DIR__ . '/clases/Cl_Usuarios.php';

     if(session_status() == PHP_SESSION_NONE){
        session_start();
    }


    //Comprobamos que la información nos llega por POST y por el formulario 'registro'.
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar'])){

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
        $errores_validacion = validacion_actualizacion($nombre, $apellidos, $telefono, $password, $fnac, $direccion);

        //Si hay errores de validación, los metemos en una variable de sesión
        if(!empty($errores_validacion)){
            $text_error = "";

            foreach($errores_validacion as $clave=>$error){
                $text_error .= $error . "<br>";
            }

            $_SESSION['mensaje_error'] = $text_error;

            header('Location: ../views/users/perfil.php');
            exit();
        }

        $pass = password_hash($password, PASSWORD_BCRYPT);
        $idUser = $_SESSION['user_data_all']['idUser'];

        try{
            $usuarioObj = new Usuario();

            if($usuarioObj->actualizarUsuario($idUser, $nombre, $apellidos, $telefono, $fnac, $direccion, $sexo, $mysqli_connection) && $usuarioObj->update_user_login($idUser,$pass, $mysqli_connection)){
                $_SESSION['user_data_all']['nombre'] = $nombre;
                $_SESSION['user_data_all']['apellidos'] = $apellidos;
                $_SESSION['user_data_all']['telefono'] = $telefono;
                $_SESSION['user_data_all']['fnac'] = $fnac;
                $_SESSION['user_data_all']['pass'] = $pass;
                $_SESSION['user_data_all']['direccion'] = $direccion;
                $_SESSION['user_data_all']['sexo'] = $sexo;
                
                $_SESSION['mensaje_exito'] = "El usuario se ha actualizado correctamente";
                header("Location: ../views/users/perfil.php");
                exit();
            }else{
                $_SESSION['mensaje_error'] = "El usuario no se ha podido actualizar";
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