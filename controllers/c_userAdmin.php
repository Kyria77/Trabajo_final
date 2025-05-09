<?php
    require_once 'db_conn.php';
    require_once 'validationData.php';
    require_once __DIR__ . '/../config/config.php';
    require_once __DIR__ . '/clases/Cl_Usuarios.php';

    //Comprobamos si existe una sesión activa, y si no hay, la creamos.
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //Redirigir al LOGIN si el usuario no ha iniciaco sesión (es decir, si no existe user_id)
    if(!isset($_SESSION['user_data_all']) && $_SESSION['user_data_all']['rol'] !== 'admin'){
        $_SESSION["mensaje_error"] = "Lo sentimos, debes iniciar sesión primero";
        header("Location: ../views/login.php");
        exit();
    }


    //Comprobamos que la información nos llega por POST y por el formulario 'insertarAdmin'.
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['insertarAdmin'])){

        //Saneamos los datos
        $nombre = htmlspecialchars($_POST['nombre']);
        $apellidos = htmlspecialchars($_POST['apellidos']);
        $telefono = htmlspecialchars($_POST['telefono']);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars($_POST['password']);
        $fnac = htmlspecialchars($_POST['fnac']);
        $direccion = htmlspecialchars($_POST['direccion']);
        $sexo = $_POST['sexo'];
        $rol = $_POST['rol'];

        //Ejecutamos la función de validar el formulario de registro que está en el archivo valodationData.php
        $errores_validacion = validacion_registro($nombre, $apellidos, $telefono, $email, $password, $fnac, $direccion);

        //Si hay errores de validación, los metemos en una variable de sesión
        if(!empty($errores_validacion)){
            $text_error = "";

            foreach($errores_validacion as $clave=>$error){
                $text_error .= $error . "<br>";
            }

            $_SESSION['mensaje_error'] = $text_error;

            header('Location: ../views/admin/usuariosAdmin.php');
            exit();
        }

        $pass = password_hash($password, PASSWORD_BCRYPT);

        try{
            $exception_error = false;
            $usuarioObj = new Usuario();

            //Si el resultado de comprobarUsuario es true, ese usuario ya existe
            if($usuarioObj->comprobarUsuario($email, $mysqli_connection, $exception_error)){
                $_SESSION['mensaje_error'] = "El usuario ya existe en la base de datos";
                header("Location: ../views/admin/usuariosAdmin.php");
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
                    if($usuarioObj->insert_user_login($id, $email, $pass, $rol, $mysqli_connection, $exception_error)){
                        $_SESSION['mensaje_exito'] = "El usuario se ha registrado correctamente";
                        header("Location: ../views/admin/usuariosAdmin.php");
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

    //Comprobamos que la información nos llega por POST y por el formulario 'actualizar'.
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar'])){

        $idUser = $_POST['idUser'];
        $_SESSION['idUser'] = $idUser;
        header('Location: ../views/admin/modificarUser.php');

    }



    //Comprobamos que la información nos llega por POST y por el formulario 'actualizar'.
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizarUserAdmin'])){

        //Saneamos los datos
        $nombre = htmlspecialchars($_POST['nombre']);
        $apellidos = htmlspecialchars($_POST['apellidos']);
        $telefono = htmlspecialchars($_POST['telefono']);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $fnac = htmlspecialchars($_POST['fnac']);
        $direccion = htmlspecialchars($_POST['direccion']);
        $sexo = $_POST['sexo'];
        $rol = $_POST['rol'];
        $idUser = $_POST['idUser'];


        try{
            $usuarioObj = new Usuario();

            if($usuarioObj->actualizarUsuario($idUser, $nombre, $apellidos, $telefono, $fnac, $direccion, $sexo, $mysqli_connection) && $usuarioObj->update_user_login_admin($idUser,$rol, $mysqli_connection)){
                
                $_SESSION['mensaje_exito'] = "El usuario se ha actualizado correctamente";
                header("Location: ../views/admin/modificarUser.php");
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


    //Si ha pinchado en Borrar usuario
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['borrar'])){

        try{
            $userObj = new Usuario();
            $idUser = $_POST['idUser'];

            $borrado_login = $userObj->borrar_user_login($idUser, $mysqli_connection);
            $borrado_data = $userObj->borrar_user_data($idUser, $mysqli_connection);

            if($borrado_login && $borrado_data){
                $_SESSION['mensaje_exito'] = "La cita se ha borrado correctamente";
                header("Location: ../views/admin/updateDelete.php");
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