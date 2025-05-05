<?php
    require_once __DIR__ . '/../config/config.php';

    //Iniciamos la sesión para acceder a las variables de sesión
    session_start();

    //Limpiar todas las variables de sesión
    $_SESSION = array();

    //Borramos la cookie y sesión.
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    //Destruimos sesión.
    session_destroy();

    header("Location: ../index.php");
    exit();
?>