<?php
    require_once __DIR__ . '/../../config/config.php';
    require_once '../../controllers/clases/Cl_Noticias.php';

    //Comprobar si existe una sesión activa y en caso de que no así la crearemos
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //Redirigir al LOGIN si el usuario no ha iniciaco sesión (es decir, si no existe user_id)
    if(!isset($_SESSION['user_data_all']) && $_SESSION['user_data_all']['rol'] !== 'admin'){
        $_SESSION["mensaje_error"] = "Lo sentimos, debes iniciar sesión primero";
        header("Location: ../login.php");
        exit();
    }

    $noticiaObj = new Noticia();
    $noticias = $noticiaObj->leerNoticia($mysqli_connection);

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
                        <li><a class="out" href="../../index.php">Inicio</a></li>
                        <li><a class="out" href="../noticias.php">Noticias</a></li>
                        <li><a class="out" href="usuariosAdmin.php">User Admin</a></li>
                        <li><a class="out" href="citasAdmin.php">Citas Admin</a></li>
                        <li><a class="inn" href="#">Noticias Admin</a></li>
                        <li><a class="out" href="../users/perfil.php">Perfil</a></li>
                        <li><a class="out" href="../../controllers/cerrar_sesion.php">Cerrar sesión</a></li>
                    </ul>
                </nav>

            </div>
        </header>

        <!--Comenzamos con Main. Consta de XXX secciones:-->
        <main>
            <div class="main_cabecera">
                <div class="cartel_login">
                    <h2>Noticias Admin</h2>
                </div>
                <nav class="main_nav_content">
                    <ul class="main_navLinks">
                        <li><a class="out_login" href="noticiasAdmin.php">Insertar</a></li>
                        <li><a class="inn_login" href="#">Modificar y Borrar</a></li>
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

            <div class="citas_pendientes">
                <?php if($noticias){
                    foreach($noticias as $noticia){
                        ?>
                        <div class="cita">
                            <form class="form_citas" id="form_noticias" name="form_noticias" method="POST" action="../../controllers/c_noticiasAdmin.php">
                                <input type="hidden" name="idNoticia" value="<?php echo $noticia['idNoticia']; ?>">
                                <input type="hidden" name="idImagen" value="<?php echo $noticia['idImagen']; ?>">
                                <input type="hidden" name="idUser" value="<?php echo $noticia['identUser']; ?>">
                                <div class="infoForm-container">
                                <div class="input-container">
                                    <label for="titulo">Título:</label>
                                    <input type="text" id="titulo" name="titulo" value="<?php echo $noticia['NotiTitulo']; ?>">
                                </div>
                                <div class="input-container">
                                    <label for="texto">Texto:</label>
                                    <textarea name="texto" rows="6"><?php echo $noticia['texto']; ?></textarea>
                                </div>
                                <div class="input-container">
                                    <label for="fcreacion">Fecha de creación:</label>
                                    <input type="date" id="fcreacion" name="fcreacion" value="<?php echo $noticia['fecha_creacion']; ?>">
                                </div>
                                <div class="input-container">
                                    <label for="idUser">Creador:</label>
                                    <input type="text" id="creador" name="creador" value="<?php echo $noticia['userNombre'] . ' ' . $noticia['apellidos']; ?>" disabled>
                                </div>
                                <div class="input-container">
                                    <label for="imagen">Imagen:</label>
                                    <input type="text" id="imagen" name="imagen" value="<?php echo $noticia['imaNombre']; ?>">
                                    <small class="error" id="imagenError"></small>
                                </div>
                                <div class="input-container">
                                    <label for="alternativo">Título alternativo (alt):</label>
                                    <input type="text" id="alternativo" name="alternativo" value="<?php echo $noticia['alt']; ?>">
                                    <small class="error" id="alternativoError"></small>
                                </div>
                                <div class="input-container">
                                    <label for="anchura">Anchura imagen::</label>
                                    <input type="text" id="anchura" name="anchura" value="<?php echo $noticia['width']; ?>">
                                    <small class="error" id="anchuraError"></small>
                                </div>
                                <div class="input-container">
                                    <label for="altura">Altura imagen:</label>
                                    <input type="text" id="altura" name="altura" value="<?php echo $noticia['heigth']; ?>">
                                    <small class="error" id="alturaError"></small>
                                </div>
                                    <div class="button-container_gestion_citas">
                                        <input type="submit" name="actualizar" value="Modificar noticia">
                                        <input type="submit" name="borrar" value="Borrar noticia">
                                    </div>
                                </div>
                            </form>
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

        <script src="../../assets/scripts/validacion_citas.js"></script>
    </body>
</html>