<?php
    # Comprobar si existe una sesión activa y en caso de que no así la crearemos
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    # Redirigir al LOGIN si el usuario no ha iniciaco sesión (es decir, si no existe user_id)
    if(!isset($_SESSION['user_data_all'])){
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
                <?php
                    if(isset($_SESSION['user_data_all']) && $_SESSION['user_data_all']['rol'] == 'user'){
                    ?>
                        <ul class="navLinks">
                            <li><a class="out" href="../../index.php">INICIO</a></li>
                            <li><a class="out" href="../steam_dia.php">STEAM AL DÍA</a></li>
                            <li><a class="inn" href="#">INSPÍRATE</a></li>
                            <li><a class="out" href="agenda.php">AGENDA</a></li>
                            <li><a class="out" href="perfil.php">PERFIL</a></li>
                            <li><a class="out" href="../../controllers/cerrar_sesion.php">CERRAR SESIÓN</a></li>
                            <li>
                                <a href="https://www.instagram.com" title="Enlace a Instagram">
                                    <img src="../../assets/images/instagram.png" alt="icono de Instagram" width="32" height="32" title="icono Instagram">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com" title="Enlace a YouTube">
                                    <img src="../../assets/images/youtube.png" alt="icono de YouTube" width="32" height="32" title="icono YouTube">
                                </a>
                            </li>
                        </ul>
                    <?php
                    }
                    ?>
                </nav>
            </div>
        </header>

        <!--Comenzamos con Main. Consta de XXX secciones:-->
        <main>
            <div class="main_cabecera">
                <div class="cartel_inspirate">
                    <h2>INSPÍRATE</h2>
                </div>
                <nav class="main_nav_content">
                    <ul class="main_navLinks">
                        <li><a class="out" href="ideas.php">Ideas</a></li>
                        <li><a class="out" href="arte.php">Arte</a></li>
                        <li><a class="inn_inspirate" href="#">Comunidad</a></li>
                    </ul>
                </nav>
            </div>
            <div class="noticias_content">
                <div class="noticia">
                    <h2>Envíanos tus inventos para las clases</h2>
                    <div class="noticia_grueso">
                        <div class="noticia_texto">
                            <p>Esta es una sección dedicada a crear una estupenda comunidad en la que podamos compartir las ideas e inventos de ccada uno de nosotros en nuestras clases.</p>
                        </div>
                        <div class="noticia_img">
                            <img src="../../assets/images/comunidad.png" alt="grupo juntando las manos" width="672" height="494" title="grupo juntando las manos">
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
                        <a href="https://www.instagram.com" title="Enlace a Instagram">
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