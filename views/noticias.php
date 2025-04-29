<?php
    require_once '../controllers/Cl_Noticias.php';
    $noticiaObj = new Noticia();
    $noticias = $noticiaObj->leerNoticia($mysqli_connection);
    //print_r($noticias);
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
                    <ul class="navLinks">
                        <li><a class="out" href="../index.html">INICIO</a></li>
                        <li><a class="inn" href="#">STEAM AL DÍA</a></li>
                        <li><a class="out" href="./registro.html">REGISTRARSE</a></li>
                        <li><a class="out" href="./login.html">LOGIN</a></li>
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
                        <li><a class="out" href="./perfiles.html">Perfiles</a></li>
                        <li><a class="out" href="/views/biblioteca.html">Biblioteca</a></li>
                    </ul>
                </nav>
            </div>
            <div class="noticias_content">
                <?php if($noticias){
                    foreach($noticias as $noticia){
                        ?>
                        <div class="noticia">
                            <h2><?php echo $noticia['titulo']; ?></h2>
                            <h3><?php echo $noticia['idUser']; ?></h3>
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
                                    <img src="../assets/images/<?php echo $noticia['imagen'] ?>" alt="<?php echo $noticia['titulo'] ?>" width="353" height="486" title="<?php echo $noticia['titulo'] ?>">
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                <?php
                }
                ?>
                 
                <div class="noticia">
                    <h2>Un nuevo instrumento español,portátil, de bajo coste, rápido y no invasivocontra las temidas piedras del riñón</h2>
                    <h3>Francisco Pérez - El Mundo</h3>
                    <h5>24/04/2016</h5>
                    <div class="noticia_grueso">
                        <div class="noticia_texto">
                            <p>La medicina conoce como litiasis o nefrolitiasis a la formación de las popularmente conocidas como «piedras del riñón» o «cálculos renales». Estos cuerpos sólidos de formas y composiciones diversas aparecen en la pelvis renal debido a una combinación de varios factores como la genética, la dieta, la ingesta insuficiente de agua, la toma de ciertos medicamentos, las infecciones del aparato urinario o la obesidad, entre otros.</p>
                            <p>Los cálculos renales pueden formarse por la cristalización de sustancias como las sales de calcio, de fósforo, de ácido úrico o de cistina. Si son muy pequeños, suelen eliminarse de manera natural en la micción, algo que suele ser doloroso debido a que los cálculos tienen habitualmente aristas que pueden dañar las paredes del conducto urinario.</p>
                            <p>Pero si alcanzan un diámetro cercano a los 5 mm, obstruyen el uréter y causan un intenso dolor en la espalda o el abdomen. En casos extremos, esos cálculos pueden crecer tanto que ocupan gran parte de la pelvis renal y pueden causar problemas mucho más serios en el aparato urinario.</p>
                            <p>Las consecuencias para la salud de los cálculos renales han impulsado a la medicina a desarrollar tratamientos para eliminarlos, desde medicamentos que favorecen la eliminación natural con reducción del dolor hasta cirugía para los casos más graves. </p>
                            <p>El procedimiento más moderno es la litotricia, que es una técnica no invasiva que emplea haces de ondas de choque de ultrasonidos enfocados sobre los cálculos, para producir vibraciones en ellos que causan su fragmentación en fina arena expulsable por la uretra. La litotricia requiere, por el momento, de equipos de grandes dimensiones que deben ser instalados en una sala de un hospital o de una clínica. El procedimiento es eficaz, pero costoso y no aplicable en consultas externas, ya que el equipo es muy voluminoso. Además, hoy por hoy no está exento de efectos secundarios, ya que la amplitud de las ondas de choque empleadas es grande y a veces se producen daños sobre los tejidos sanos que se encuentran en los alrededores del cálculo.</p>
                            <p>Lithovortex utiliza un nuevo tipo de onda acústica llamada haz de vórtice; que sería como un «remolino de sonido». Esta onda se enrosca y gira sobre sí misma cuando se focaliza sobre la piedra, lo que produce en ella esfuerzos de cizalla de una manera más eficiente que un haz convencional. Es como si dieran un «pellizco microscópico» en el interior de la piedra que hace que se fragmente en trozos muy finos. La operación completa se desarrolla en la mitad del tiempo que necesita una litotricia tradicional, que es de entre una y dos horas.</p>
                            <p>El Servicio de Urología del Hospital La Fe y en concreto su Núcleo de investigación traslacional integrado Urológico de Valencia (NITIUV), ha desarrollado las pruebas iniciales, que han consistido, hasta la fecha, en una fragmentación de cálculos artificiales en un entorno simulado y, ya en colaboración con la Unidad de Litotricia del Hospital de La Fe de València se ha validado su funcionamiento con cálculos reales, pero fuera de un ser vivo.</p>
                        </div>
                        <div class="noticia_img">
                            <img src="../assets/images/Rinnon.png" alt="riñón" width="353" height="486" title="Riñón">
                        </div>
                    </div>
                </div>
                <div class="noticia">
                    <h2>Nuevos modelos del cambio climático:El deshielo del árticoharía más lluviosos a españa y portugal</h2>
                    <h3>Francisco Pérez - El Mundo</h3>
                    <h5>24/04/2016</h5>
                    <div class="noticia_grueso">
                        <div class="noticia_texto">
                            <p>La medicina conoce como litiasis o nefrolitiasis a la formación de las popularmente conocidas como «piedras del riñón» o «cálculos renales». Estos cuerpos sólidos de formas y composiciones diversas aparecen en la pelvis renal debido a una combinación de varios factores como la genética, la dieta, la ingesta insuficiente de agua, la toma de ciertos medicamentos, las infecciones del aparato urinario o la obesidad, entre otros.</p>
                            <p>Los cálculos renales pueden formarse por la cristalización de sustancias como las sales de calcio, de fósforo, de ácido úrico o de cistina. Si son muy pequeños, suelen eliminarse de manera natural en la micción, algo que suele ser doloroso debido a que los cálculos tienen habitualmente aristas que pueden dañar las paredes del conducto urinario.</p>
                            <p>Pero si alcanzan un diámetro cercano a los 5 mm, obstruyen el uréter y causan un intenso dolor en la espalda o el abdomen. En casos extremos, esos cálculos pueden crecer tanto que ocupan gran parte de la pelvis renal y pueden causar problemas mucho más serios en el aparato urinario.</p>
                            <p>Las consecuencias para la salud de los cálculos renales han impulsado a la medicina a desarrollar tratamientos para eliminarlos, desde medicamentos que favorecen la eliminación natural con reducción del dolor hasta cirugía para los casos más graves. </p>
                            <p>El procedimiento más moderno es la litotricia, que es una técnica no invasiva que emplea haces de ondas de choque de ultrasonidos enfocados sobre los cálculos, para producir vibraciones en ellos que causan su fragmentación en fina arena expulsable por la uretra. La litotricia requiere, por el momento, de equipos de grandes dimensiones que deben ser instalados en una sala de un hospital o de una clínica. El procedimiento es eficaz, pero costoso y no aplicable en consultas externas, ya que el equipo es muy voluminoso. Además, hoy por hoy no está exento de efectos secundarios, ya que la amplitud de las ondas de choque empleadas es grande y a veces se producen daños sobre los tejidos sanos que se encuentran en los alrededores del cálculo.</p>
                            <p>Lithovortex utiliza un nuevo tipo de onda acústica llamada haz de vórtice; que sería como un «remolino de sonido». Esta onda se enrosca y gira sobre sí misma cuando se focaliza sobre la piedra, lo que produce en ella esfuerzos de cizalla de una manera más eficiente que un haz convencional. Es como si dieran un «pellizco microscópico» en el interior de la piedra que hace que se fragmente en trozos muy finos. La operación completa se desarrolla en la mitad del tiempo que necesita una litotricia tradicional, que es de entre una y dos horas.</p>
                            <p>El Servicio de Urología del Hospital La Fe y en concreto su Núcleo de investigación traslacional integrado Urológico de Valencia (NITIUV), ha desarrollado las pruebas iniciales, que han consistido, hasta la fecha, en una fragmentación de cálculos artificiales en un entorno simulado y, ya en colaboración con la Unidad de Litotricia del Hospital de La Fe de València se ha validado su funcionamiento con cálculos reales, pero fuera de un ser vivo.</p>
                        </div>
                        <div class="noticia_img">
                            <img src="../assets/images/Rinnon.png" alt="riñón" width="353" height="486" title="Riñón">
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