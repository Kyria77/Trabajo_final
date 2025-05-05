<?php
    require_once __DIR__ . '/../config/config.php';

    //Comprobar si existe una sesión activa y en caso de que no así la crearemos
    if(session_status() == PHP_SESSION_NONE){
        session_start();
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

        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/style_others.css">
        <link rel="icon" type="image/png" href="../favicon.png">
    </head>
    <body>
        <!--Comenzamos con Header, nuetra cabecera con el logo, la barra de navegación e introducción-->
        <header>
            <div class="logo">
                <img src="../assets/images/Steam_blanco.png" alt="logo steam&Co" width="414" height="216" title="Logo">
            </div>
            <div class="header_content">
                <nav class="nav_content">
                <?php
                    if(isset($_SESSION['user_data_all']) && $_SESSION['user_data_all']['rol'] == 'user'){
                    ?>
                        <ul class="navLinks">
                            <li><a class="out" href="../index.php">INICIO</a></li>
                            <li><a class="inn" href="#">STEAM AL DÍA</a></li>
                            <li><a class="out" href="users/inspirate.php">INSPÍRATE</a></li>
                            <li><a class="out" href="users/agenda.php">AGENDA</a></li>
                            <li><a class="out" href="users/perfil.php">PERFIL</a></li>
                            <li><a class="out" href="../controllers/cerrar_sesion.php">CERRAR SESIÓN</a></li>
                            <li>
                                <a href="https://www.instagram.es" title="Enlace a Instagram">
                                    <img src="../assets/images/instagram.png" alt="icono de Instagram" width="32" height="32" title="icono Instagram">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com" title="Enlace a YouTube">
                                    <img src="../assets/images/youtube.png" alt="icono de YouTube" width="32" height="32" title="icono YouTube">
                                </a>
                            </li>
                        </ul>
                    <?php
                    }else{
                    ?>
                        <ul class="navLinks">
                            <li><a class="out" href="../index.php">INICIO</a></li>
                            <li><a class="out" href="#">STEAM AL DÍA</a></li>
                            <li><a class="out" href="registro.php">REGISTRARSE</a></li>
                            <li><a class="out" href="login.php">LOGIN</a></li>
                            <li>
                                <a href="https://www.instagram.es" title="Enlace a Instagram">
                                    <img src="../assets/images/instagram.png" alt="icono de Instagram" width="32" height="32" title="icono Instagram">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com" title="Enlace a YouTube">
                                    <img src="../assets/images/youtube.png" alt="icono de YouTube" width="32" height="32" title="icono YouTube">
                                </a>
                            </li>
                        </ul>
                    <?php
                    }
                    ?>
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
            <div class="cartel_steamAlDia">
                <h2>STEAM AL DÍA</h2>
            </div>
            <div class="main_sections_content">
                <div class="steam_dia_noticias">
                    <div class="amarillo">
                        <h2>Actualidad científica</h2>
                        <h3>Noticias</h3>
                        <div class="main_btn">
                            <a href="noticias.php">VER MÁS</a>
                        </div>
                    </div>
                </div>
                <div class="steam_dia_perfiles">
                    <div class="amarillo">
                        <h2>Perfiles</h2>
                        <h3>Mº Carmen Martínez Rodríguez</h3>
                        <div class="main_btn">
                            <a href="perfiles.php">VER MÁS</a>
                        </div>
                    </div>
                </div>
                <div class="steam_dia_biblioteca">
                    <div class="amarillo">
                        <h2>Biblioteca</h2>
                        <h3>Si no funciona, evoluciona</h3>
                        <div class="main_btn">
                            <a href="biblioteca.php">VER MÁS</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!--Comenzamos con el Footer, con los derechos, datos de la empresa, iconos redes sociales-->
        <footer>
            <div class="footer_sociales">
                <ul class="redes">
                    <li>
                        <a href="https://www.instagram.es" title="Enlace a Instagram">
                            <img src="../assets/images/instagram.png" alt="icono de Instagram" width="32" height="32" title="icono Instagram">
                        </a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com" title="Enlace a YouTube">
                            <img src="../assets/images/youtube.png" alt="icono de YouTube" width="32" height="32" title="icono YouTube">
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
                <img src="../assets/images/steam_footer.png" alt="logo steam&Co" width="166" height="81" title="Logo">
            </div>
        </footer>
    </body>
</html>