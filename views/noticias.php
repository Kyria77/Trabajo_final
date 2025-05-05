<?php
    require_once '../controllers/clases/Cl_Noticias.php';
    $noticiaObj = new Noticia();
    $noticias = $noticiaObj->leerNoticia($mysqli_connection);

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
                    }else if(isset($_SESSION['user_data_all']) && $_SESSION['user_data_all']['rol'] == 'admin'){
                    ?>
                        <ul class="navLinks">
                            <li><a class="out" href="../index.php">Inicio</a></li>
                            <li><a class="inn" href="#">Noticias</a></li>
                            <li><a class="out" href="admin/usuariosAdmin.php">User Admin</a></li>
                            <li><a class="out" href="admin/citasAdmin.php">Citas Admin</a></li>
                            <li><a class="out" href="admin/noticiasAdmin.php">Noticias Admin</a></li>
                            <li><a class="out" href="users/perfil.php">Perfil</a></li>
                            <li><a class="out" href="../controllers/cerrar_sesion.php">Cerrar sesión</a></li>
                        </ul>
                    <?php
                    }else{
                    ?>
                        <ul class="navLinks">
                            <li><a class="out" href="../index.php">INICIO</a></li>
                            <li><a class="inn" href="#">STEAM AL DÍA</a></li>
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
            <div class="main_cabecera">
                <div class="cartel_steamAlDia">
                    <h2>STEAM AL DÍA</h2>
                </div>
                <nav class="main_nav_content">
                    <ul class="main_navLinks">
                        <li><a class="inn" href="#">Noticias</a></li>
                        <li><a class="out" href="perfiles.php">Perfiles</a></li>
                        <li><a class="out" href="biblioteca.php">Biblioteca</a></li>
                    </ul>
                </nav>
            </div>
            <div class="noticias_content">
                <?php if($noticias){
                    foreach($noticias as $noticia){
                        ?>
                        <div class="noticia">
                            <h2><?php echo $noticia['NotiTitulo']; ?></h2>
                            <h3><?php echo $noticia['userNombre']; ?></h3>
                            <h5><?php echo (date('d/m/y', strtotime($noticia['fecha_creacion']))) ?></h5>
                            <div class="noticia_grueso">
                                <div class="noticia_texto">
                                    <?php
                                        $parrafos = preg_split('/\r\n|\r|\n/', $noticia['texto']);
                                        foreach($parrafos as $p){
                                            if(trim($p) !== ''){
                                                echo "<p>" . trim($p) . "</p>";
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="noticia_img">
                                    <img src="../assets/images/<?php echo $noticia['imaNombre'] ?>" alt="<?php echo $noticia['alt'] ?>" width="<?php echo $noticia['width'] ?>" height="<?php echo $noticia['heigth'] ?>" title="<?php echo $noticia['imaTitulo'] ?>">
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                <?php
                }
                ?>
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