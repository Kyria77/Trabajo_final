<?php
    require_once __DIR__ . '/../../config/config.php';

    # Comprobar si existe una sesión activa y en caso de que no así la crearemos
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    # Redirigir al LOGIN si el usuario no ha iniciaco sesión (es decir, si no existe user_id)
    if(isset($_SESSION['user_data_all'])){
        $user_data = $_SESSION['user_data_all'];

        print_r($user_data);

        /*foreach($user_data as $key => $value){
            echo "$key: $value <br>";
        }*/
    }else{
        $_SESSION["mensaje_error"] = "Lo sentimos, debes iniciar sesión primero";
        header("Location: ../../views/login.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Steam&Co</title>
        <meta name="description" content="Página de acompañamiento educativo para docentes científicos">
        <meta name="Author" content="Verónica Montero">
        <meta name="keywords" content="docente, acompañamiento, alumno, ciencias, biologia, tecnologia, fisica, ideas clases, competenciales, actividad">
        <meta name="revisit-after" content="2 days">

        <link rel="stylesheet" href="../../assets/css/style.css">
        <link rel="stylesheet" href="../../assets/css/style_others.css">
        <link rel="icon" type="image/png" href="../../favicon.png">
    </head>
    <body>
        <!--Comenzamos con Header, nuetra cabecera con el logo, la barra de navegación e introducción-->
        <header>
            <div class="logo">
                <img src="../../assets/images/Steam_blanco.png" alt="logo steam&Co" width="414" height="216" title="Logo">
            </div>
            <div class="header_content">
                <nav class="nav_content">
                    <ul class="navLinks">
                        <li><a class="out" href="../../index.php">INICIO</a></li>
                        <li><a class="out" href="../steam_dia.php">STEAM AL DÍA</a></li>
                        <li><a class="out" href="inspirate.php">INSPÍRATE</a></li>
                        <li><a class="out" href="agenda.php">AGENDA</a></li>
                        <li><a class="inn" href="#">PERFIL</a></li>
                        <li><a class="out" href="cerrar_sesion.php">CERRAR SESIÓN</a></li>
                        <li>
                            <a href="https://www.instagram.es" title="Enlace a Instagram">
                                <img src="../../assets/images/instagram.png" alt="icono de Instagram" width="32" height="32" title="icono Instagram">
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com" title="Enlace a YouTube">
                                <img src="../../assets/images/youtube.png" alt="icono de YouTube" width="32" height="32" title="icono YouTube">
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="presentation_content">
                    <h1>Únete</h1>
                    <p>Regístrate para beneficiarte de todo lo que ofrecemos</p>
                    <p>¿Nos acompañamos?</p>
                </div>
            </div>
        </header>

        <!--Comenzamos con Main. Consta de XXX secciones:-->
        <main>
            <div class="main_cabecera">
                <div class="cartel_login">
                    <h2>PERFIL</h2>
                </div>
                <nav class="main_nav_content">
                    <ul class="main_navLinks">
                        <li><a class="inn_login" href="#">Perfil</a></li>
                        <li><a class="out_login" href="citas.php">Citas</a></li>
                        <li><a class="out_login" href="cerrar_sesion.php">Cerrar sesión</a></li>
                    </ul>
                </nav>
            </div>

            <div class="aviso_registro">
                    <?php
                        //Comprobar si hay mensajes de error
                        if(isset($_SESSION["mensaje_error"])){
                            echo "<span class='error_message'>" . $_SESSION['mensaje_error'] . "</span>";

                            //Eliminar el mensaje de error
                            unset($_SESSION["mensaje_error"]);
                        }
                            

                        //Comprobar si hay mensajes de exito
                        if(isset($_SESSION["mensaje_exito"])){
                            echo "<span class='success_message'>" . $_SESSION['mensaje_exito'] . "</span>";

                            //Eliminar el mensaje de error
                            unset($_SESSION["mensaje_exito"]);
                        }
                    ?>
                </div>

                <div class="formulario-container">
                    <form class="form_actualizar" id="form_actualizar" name="form_actualizar" method="POST" action="../controllers/c_registro.php">
                        <div class="infoForm-container">
                            <div class="input-container">
                                <label for="nombre">Nombre:</label>
                                <input type="text" id="nombre" name="nombre">
                                <small class="error" id="nombreError"></small>
                            </div>
                            <div class="input-container">
                                <label for="apellidos">Apellidos:</label>
                                <input type="text" id="apellidos" name="apellidos">
                                <small class="error" id="apellidosError"></small>
                            </div>
                            <div class="input-container">
                                <label for="telefono">Teléfono:</label>
                                <input type="tel" id="telefono" name="telefono">
                                <small class="error" id="telefonoError"></small>
                            </div>
                            <div class="input-container">
                                <label for="email">Email:</label>
                                <input type="text" id="email" name="email" placeholder="Deshabilitado" disabled>
                                <small class="error" id="emailError"></small>
                            </div>
                            <div class="input-container">
                                <label for="password">Contraseña:</label>
                                <input type="password" id="password" name="password">
                                <small class="error" id="passwordError"></small>
                            </div>
                            <div class="input-container">
                                <label for="fnac">Fecha de nacimiento:</label>
                                <input type="date" id="fnac" name="fnac">
                                <small class="error" id="fnacError"></small>
                            </div>
                            <div class="input-container">
                                <label for="direccion">Dirección:</label>
                                <input type="text" id="direccion" name="direccion">
                                <small class="error" id="direccionError"></small>
                            </div>
                            <div class="input-container">
                                <label for="sexo">Sexo:</label>
                                <select id="selectFormacion" name="sexo">
                                    <option value="Prefiero no responder" selected>Prefiero no responder</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Masculino">Masculino</option>
                                </select>
                            </div>
                            <div class="input_container password_show">
                                <label for="check_password">Mostrar contraseña</label>
                                <input type="checkbox" id="check_password">
                            </div>
                            <div class="input-container">
                                <label for="privacidad">He leído la política de privacidad:</label>
                                <input type="checkbox" id="privacidad" name="privacidad">
                                <small class="error" id="privacidadError"></small>
                            </div>
                            <div class="button-container_login">
                                <input type="submit" name="registro" value="Actualizar datos">
                            </div>
                        </div>
                    </form>
                </div>
            
        </main>

        <!--Comenzamos con el Footer, con los derechos, datos de la empresa, iconos redes sociales-->
        <footer>
            <div class="footer_sociales">
                <ul class="redes">
                    <li>
                        <a href="https://www.instagram.es" title="Enlace a Instagram">
                            <img src="../../assets/images/instagram.png" alt="icono de Instagram" width="32" height="32" title="icono Instagram">
                        </a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com" title="Enlace a YouTube">
                            <img src="../../assets/images/youtube.png" alt="icono de YouTube" width="32" height="32" title="icono YouTube">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer_copyright">
                <h3>Contáctanos:</h3>
                    <p>Steam&Co</p>
                    <p>Calle la Colegiata, Nº 7 Nava (Asturias)</p>
                    <p>Teléfono móvil: 670 80 90 50</p>
                    <p>&copy; Steam&Co</p>
                    <p>Aviso Legal | Política de Cookies | Política de Privacidad</p>
            </div>
            <div class="footer_logo">
                <img src="../../assets/images/steam_footer.png" alt="logo steam&Co" width="166" height="81" title="Logo">
            </div>
        </footer>
    </body>
</html>