<?php
    require_once 'db_conn.php';
    require_once 'validationData.php';
    require_once __DIR__ . '/../config/config.php';
    require_once __DIR__ . '/clases/Cl_Usuarios.php';

    //Comprobamos si existe una sesión activa, y si no hay, la creamos.
    if(session_status() == PHP_SESSION_NONE){
        session_start();
        var_dump($_POST);
        //exit;
    }

    //echo "He iniciado sesión";

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

        //echo "He saneado el formulario";

        //Ejecutamos la función de validar el formulario de registro que está en el archivo valodationData.php
        $errores_validacion = validacion_registro($nombre, $apellidos, $telefono, $email, $password, $fnac, $direccion);

        //echo "HE validado el formulario";

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

    }

?>