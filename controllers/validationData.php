<?php
//Declaramos las expresiones regulares como constantes.
define("NOMBRE_VAL", "/^[a-zA-Z ]{2,30}$/");
define("APELLIDOS_VAL", "/^[a-zA-Z ]{2,60}$/");
define("TELEFONO_VAL", "/^[0-9]{1,12}$/");
define("PASSWORD_VAL", "/^(?=.*[A-Z])(?=.*\d)(?=.*[.,_\-])[a-zA-Z\d.,_\-]{4,10}$/");
define("DIRECCION_VAL", "/^[a-zA-Z0-9 ,º]{1,150}$/");

//Definimos la función para validar nuestro formulario de registro
function validacion_registro($nombre, $apellidos, $telefono, $email, $password, $fnac, $direccion){
    $errores = [];

    //Validamos el nombre
    if(!preg_match(NOMBRE_VAL, $nombre)){
        $errores['nombre'] = "- El nombre deberá contener entre 2 y 30 caracteres.";
    }

    //Validamos los apellidos
    if(!preg_match(APELLIDOS_VAL, $apellidos)){
        $errores['apellidos'] = "- Los apellidos deberán contener entre 2 y 60 caracteres.";
    }

    //Validamos el teléfono
    if(!preg_match(TELEFONO_VAL, $telefono)){
        $errores['telefono'] = "- El teléfono solo podrá contener números, con un máximo de 12 números.";
    }

    //Validamos el correo
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errores['email'] = "- El formato del correo electrónico no es válido";
    }

    //Validamos la password
    if(!preg_match(PASSWORD_VAL, $password)){
        $errores['password'] = "- La contraseña deberá contener entre 4 y 10 caracteres e incluir una letra mayúscula, una minúscula, un número y un símbolo (.,_-).";
    }

    //Validamos fecha nacimiento
    $validaciionFnac = validarFnac($fnac);
    if(!$validaciionFnac){
        $errores['fnac'] = $validaciionFnac;
    }

    //Validamos la dirección
    if(!preg_match(DIRECCION_VAL, $direccion)){
        $errores['direccion'] = "- La dirección podrá contener 150 caracteres entre letras y números.";
    }

    return $errores;
}

//Definimos función para validar la fecha de nacimiento
function validarFnac($fecha){
    //Verifica que tenga el formato correcto
    $fecha_obj = DateTime::createFromFormat('Y-m-d', $fecha);

    if(!$fecha_obj){
        return "Formato de fecha inválido.";
    }

    //Compara con la fecha actual
    $hoy = new DateTime();
    if($fecha_obj > $hoy){
        return "La fecha no puede ser futura.";
    }
    return true;
}


//Definimos la función para validar el login
function validar_login($email, $password){
    //Declarar un array asociativo
    $errores = [];

    //Validación del correo electrónico
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errores['email'] = "- El formato del correo electrónico no es válido";
    }

    //Validación de la contraseña haciendo uso de la constante CONTRASENA_REGEX
    if(!preg_match(PASSWORD_VAL, $password)){
        $errores['password'] = "- La contraseña deberá contener entre 4 y 10 caracteres e incluir de forma obligatoria una letra mayúscula, un número y un símbolo (.,_-)";
    }

    return $errores;
}


?>
