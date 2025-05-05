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
                <div class="cartel_inspirate">
                    <h2>INSPÍRATE</h2>
                </div>
                <nav class="main_nav_content">
                    <ul class="main_navLinks">
                        <li><a class="out" href="ideas.php">Ideas</a></li>
                        <li><a class="inn_inspirate" href="#">Arte</a></li>
                        <li><a class="out" href="comunidad.php">Comunidad</a></li>
                    </ul>
                </nav>
            </div>
            <div class="noticias_content">
                <div class="noticia">
                    <h2>La Revolución industrial: máquinas, vapor y velocidad</h2>
                    <div class="noticia_grueso">
                        <div class="noticia_texto">
                            <p>La Revolución industrial fue un proceso de transformaciones económicas y sociales, nunca vistas desde el Neolítico, que modificaron de manera decisiva la historia de la humanidad. Comenzó en Inglaterra en la segunda mitad del siglo XVIII y se extendió rápidamente a los países de Europa occidental y Estados Unidos.</p>
                            <p>Los avances en diversos campos incrementaron la producción de alimentos, mejoraron la alimentación y la higiene y produjeron un crecimiento exponencial de la población. Se construyeron fábricas en las ciudades, que transformaron la organización del trabajo y crearon una sociedad urbana e industrial.</p>
                            <p>Pero el cambio revolucionario llegó cuando se aplicó la energía de la máquina de vapor al transporte terrestre (ferrocarril) y marítimo (barco de vapor) en los años 30 del siglo XIX. En 1814 se construyó la primera locomotora de vapor y en 1829 se realizó la concesión para construir la primera línea de ferrocarril, entre Liverpool y Manchester.</p>
                            <p>La máquina de vapor es un motor de combustión externa que transforma la energía térmica del agua en energía mecánica. Su funcionamiento se basa en un ciclo que consta de dos etapas principales: la generación de vapor (en la que se calienta agua en una caldera cerrada herméticamente, que produce vapor a alta presión) y su conversión en movimiento (dirigiendo el vapor a un cilindro en el que empuja un pistón, conectado con un mecanismo de biela-manivela que transforma el movimiento lineal en rotatorio).</p>
                            <p>Aunque la primera máquina de vapor conocida fue la eolípila, creada por Herón de Alejandría en el siglo I, este artefacto no continuó desarrollándose. Hubo que esperar hasta 1606, año en el que el inventor español Jerónimo de Ayanz y Beaumont patentó por primera vez un dispositivo que lo empleaba para desalojar el agua de las minas. A lo largo del siglo XVII y principios del XVIII, nuevos avances se fueron sucediendo de la mano de Edward Somerset, Thomas Savery y Thomas Newcomen, hasta que en 1769 James Watt patentó su versión mejorada de la máquina de vapor. Esta versión fue un pilar fundamental para impulsar la Revolución industrial y el desarrollo de multitud de tecnologías basadas en ella.</p>
                            <p>El puente sobre el que circula el tren se construyó solo cinco años antes. Todo es nuevo, el mundo se llena de las posibilidades que la tecnología ha ido aportando a lo largo de esos años. Turner plasma, en cierta manera, esta lucha entre la naturaleza, el paisaje y la pintura más clásica contra la máquina, la novedad y la tecnología más puntera de la época. Esto se puede ver muy bien si hacemos zoom sobre las vías, donde una pequeña liebre corre delante de la locomotora. También en el contraste entre la imponente y oscura máquina sobre los raíles y las personas en un endeble bote a remos sobre el río, o al observar el campesino arando de una forma tradicional.</p>
                            <p>Por su parte, la producción en serie, apoyada por los modernos medios de distribución y transporte, puso a disposición de un público cada vez más global, un número casi ilimitado de instrumentos. Todo ello hizo que cambiara la configuración de la orquesta sinfónica y el acompañamiento de la música escénica, así como las posibilidades de la música popular, permitiendo a los compositores afrontar una serie de nuevos retos sonoros que revolucionaron la música para siempre.</p>
                        </div>
                        <div class="noticia_img">
                            <img src="../../assets/images/arte.png" alt="fabrica revolución industrial" width="725" height="491" title="fabrica revolución industrial">
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