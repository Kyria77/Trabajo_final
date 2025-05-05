<?php
    require_once __DIR__ . '/config/config.php';

    # Comprobar si existe una sesión activa y en caso de que no así la crearemos
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

        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="icon" type="image/png" href="favicon.png">
    </head>
    <body>
        <!--Comenzamos con Header, nuetra cabecera con el logo, la barra de navegación e introducción-->
        <header>
            <div class="logo">
                <img src="./assets/images/Steam_blanco.png" alt="logo steam&Co" width="414" height="216" title="Logo">
            </div>
            <div class="header_content">
                <nav class="nav_content">
                <?php
                    if(isset($_SESSION['user_data_all']) && $_SESSION['user_data_all']['rol'] == 'user'){
                    ?>
                        <ul class="navLinks">
                            <li><a class="inn" href="#">INICIO</a></li>
                            <li><a class="out" href="views/steam_dia.php">STEAM AL DÍA</a></li>
                            <li><a class="out" href="views/users/inspirate.php">INSPÍRATE</a></li>
                            <li><a class="out" href="views/users/agenda.php">AGENDA</a></li>
                            <li><a class="out" href="views/users/perfil.php">PERFIL</a></li>
                            <li><a class="out" href="controllers/cerrar_sesion.php">CERRAR SESIÓN</a></li>
                            <li>
                                <a href="https://www.instagram.es" title="Enlace a Instagram">
                                    <img src="assets/images/instagram.png" alt="icono de Instagram" width="32" height="32" title="icono Instagram">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com" title="Enlace a YouTube">
                                    <img src="assets/images/youtube.png" alt="icono de YouTube" width="32" height="32" title="icono YouTube">
                                </a>
                            </li>
                        </ul>
                    <?php
                    }else if(isset($_SESSION['user_data_all']) && $_SESSION['user_data_all']['rol'] == 'admin'){
                    ?>
                        <ul class="navLinks">
                            <li><a class="inn" href="#">Inicio</a></li>
                            <li><a class="out" href="views/noticias.php">Noticias</a></li>
                            <li><a class="out" href="views/admin/usuariosAdmin.php">User Admin</a></li>
                            <li><a class="out" href="views/admin/citasAdmin.php">Citas Admin</a></li>
                            <li><a class="out" href="views/admin/noticiasAdmin.php">Noticias Admin</a></li>
                            <li><a class="out" href="views/users/perfil.php">Perfil</a></li>
                            <li><a class="out" href="controllers/cerrar_sesion.php">Cerrar sesión</a></li>
                        </ul>
                    <?php
                    }else{
                    ?>
                        <ul class="navLinks">
                            <li><a class="inn" href="#">INICIO</a></li>
                            <li><a class="out" href="views/steam_dia.php">STEAM AL DÍA</a></li>
                            <li><a class="out" href="views/registro.php">REGISTRARSE</a></li>
                            <li><a class="out" href="views/login.php">LOGIN</a></li>
                            <li>
                                <a href="https://www.instagram.es" title="Enlace a Instagram">
                                    <img src="assets/images/instagram.png" alt="icono de Instagram" width="32" height="32" title="icono Instagram">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com" title="Enlace a YouTube">
                                    <img src="assets/images/youtube.png" alt="icono de YouTube" width="32" height="32" title="icono YouTube">
                                </a>
                            </li>
                        </ul>
                    <?php
                    }
                    ?>
                </nav>
                <div class="presentation_content">
                    <h1>Nuestra misión</h1>
                    <p>¿Eres profesor de ciencias, tecnología o matemáticas?</p>
                    <p>¿Te has embarcado en la apasionante misión de divulgarlas?</p>
                    <p>Nos hemos propuesto acompañarte en la admirable tarea de enseñar las áreas STEAM, ofreciéndote ideas frescas para tus clases, recursos innovadores, creativos o motivadores, y sugerencias para sacar más partido a los materiales de tus libros de texto y hacer tu día a día más sencillo y lleno de inspiración. Si te registras en la web, de forma gratuita, podrás acceder a contenido para tus clases y concertar una cita con un asesor para comenzar tu acompañamiento.</p>
                    <p>¿Nos acompañamos?</p>
                </div>
            </div>
        </header>

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

        <!--Comenzamos con Main. Consta de XXX secciones:-->
        <main>

            <div class="main_sections_content">
                <div class="steam_dia">
                    <div class="amarillo">
                        <h2>STEAM AL DÍA</h2>
                        <h3>Noticias</h3>
                        <p>Lignosat, el satélite hecho de madera; la lectura y las matemáticas...</p>
                        <p>Un nuevo instrumento español,portátil, de bajo coste, rápido y no invasivo contra las temidas piedras del riñón...</p>
                        <h3>Perfiles</h3>
                        <p>M.ª Carmen Martínez Fernández</p>
                        <h3>Biblioteca</h3>
                        <p>Si no funciona ¡evoluciona!</p>
                        <div class="main_btn">
                            <a href="views/steam_dia.php">VER MÁS</a>
                        </div>
                    </div>
                </div>
                <div class="inspirate">
                    <div class="azul">
                        <h2>INSPÍRATE</h2>
                        <h3>Ideas para tus clases</h3>
                        <p>Duelo de barbudos.</p>
                        <p>Un juego de mesa inventado hace 5000años.</p>
                        <h3>Con A de STEAM</h3>
                        <p>La revolución industrial: máquinas de vapor y velocidad</p>
                        <h3>Haz comunidad</h3>
                        <div class="main_btn">
                            <a href="views/noticias.php">VER MÁS</a>
                        </div>
                    </div>
                </div>
                <div class="agenda">
                    <div class="rosa">
                        <h2>AGENDA</h2>
                        <h3>Eventos</h3>
                        <p>4º Congreso de Ciberseguridad de Andalucía - Málaga.</p>
                        <p>Exposición: Cazadores de dragones.</p>
                        <h3>Agenda</h3>
                        <p>Aniversario del nacimiento de Marie Anne Victoire Gillain Boivin</p>
                        <p>Día Internacional de la Tierra</p>
                        <div class="main_btn">
                            <a href="views/noticias.php">VER MÁS</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main_sections_content">
                <div class="text_presentation">
                    <h2>Nuestra misión</h2>
                    <h3>¿Quiénes somos?</h3>
                    <p>El equipo de STEAM & CO está formado por <span class="bold">profesionales</span> de perfiles muy diversos, <span class="bold">que colaboran constantemente</span> para dejar huella en la educación y la cultura, y encontrar la mejor manera de enseñar y aprender materias del ámbito STEM.</p>
                    <p>Somos profesionales en la <span class="bold">enseñanza de las ciencias y la edición</span> de materias tan diversas y apasionantes como las <span class="bold">matemáticas, la biología y geología, la física y química, la tecnología y digitalización, la cultura científica …</span>; y también contamos con especialistas en <span class="bold">bellas artes, en diseño gráfico, en comunicación audiovisual…</span></p>
                    <p>El equipo que hacemos posible STEAM & CO <span class="bold">crece cada día</span>, al igual que los contenidos de este espacio.
                        Cuando nos descubras más, seguro que <span class="bold">tú también entrarás a formar parte del equipo</span>.</p>
                </div>
                <div class="img_presentation">
                    <img src="assets/images/presentation_img.png" alt="mujer con una niña realizando un experimento" width="436" height="555">
                </div>
            </div>
            
        </main>

        <!--Comenzamos con el Footer, con los derechos, datos de la empresa, iconos redes sociales-->
        <footer>
            <div class="footer_sociales">
                <ul class="redes">
                    <li>
                        <a href="https://www.instagram.es" title="Enlace a Instagram">
                            <img src="assets/images/instagram.png" alt="icono de Instagram" width="32" height="32" title="icono Instagram">
                        </a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com" title="Enlace a YouTube">
                            <img src="assets/images/youtube.png" alt="icono de YouTube" width="32" height="32" title="icono YouTube">
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
                <img src="assets/images/steam_footer.png" alt="logo steam&Co" width="166" height="81" title="Logo">
            </div>
        </footer>
    </body>
</html>