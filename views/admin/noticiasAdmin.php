<?php
    require_once __DIR__ . '/../../config/config.php';

    //Comprobar si existe una sesión activa y en caso de que no así la crearemos
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //Redirigir al LOGIN si el usuario no ha iniciaco sesión (es decir, si no existe user_id)
    if(!isset($_SESSION['user_data_all']) && $_SESSION['user_data_all']['rol'] !== 'admin'){
        $_SESSION["mensaje_error"] = "Lo sentimos, debes iniciar sesión primero";
        header("Location: ../login.php");
        exit();
    }else{
        $user_data = $_SESSION['user_data_all'];
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

        <!--Comenzamos con Main. Consta de X secciones:-->
        <main>
            <div class="main_cabecera">
                <div class="cartel_login">
                    <h2>Noticias Admin</h2>
                </div>
                <nav class="main_nav_content">
                    <ul class="main_navLinks">
                        <li><a class="inn_login" href="#">Insertar</a></li>
                        <li><a class="out_login" href="modificarNoticias.php">Modificar y Borrar</a></li>
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
                <h2>Crear noticia nueva</h2>
                <p>Para insertar la imagen, debes solicitar primero que la introduzcan en la carpeta del proyecto, después, cuando rellenes el formulario solamente debes escribir el nombre del archivo, por ejemplo: ejemplo.png</p>
                <form class="form_actualizar" id="form_registro" name="form_insert_admin" method="POST" action="../../controllers/c_noticiasAdmin.php">
                    <div class="infoForm-container">
                        <div class="input-container">
                            <label for="titulo">Título:</label>
                            <input type="text" id="titulo" name="titulo" required>
                            <small class="error" id="tituloError"></small>
                        </div>
                        <div class="input-container">
                            <label for="texto">Texto:</label>
                            <textarea name="texto" rows="6" required></textarea>
                            <small class="error" id="apellidosError"></small>
                        </div>
                        <div class="input-container">
                            <label for="fcreacion">Fecha de creación:</label>
                            <input type="date" id="fcreacion" name="fcreacion" required>
                            <small class="error" id="apellidosError"></small>
                        </div>
                        <div class="input-container">
                            <label for="imagen">Imagen:</label>
                            <input type="text" id="imagen" name="imagen" required>
                            <small class="error" id="imagenError"></small>
                        </div>
                        <div class="input-container">
                            <label for="alternativo">Título alternativo (alt):</label>
                            <input type="text" id="alternativo" name="alternativo">
                            <small class="error" id="alternativoError"></small>
                        </div>
                        <div class="input-container">
                            <label for="anchura">Anchura imagen::</label>
                            <input type="text" id="anchura" name="anchura">
                            <small class="error" id="anchuraError"></small>
                        </div>
                        <div class="input-container">
                            <label for="altura">Altura imagen:</label>
                            <input type="text" id="altura" name="altura">
                            <small class="error" id="alturaError"></small>
                        </div>
                        <div class="button-container_login">
                            <input type="submit" name="crearNoticia" value="Crear noticia">
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

        <script src="../../assets/scripts/show_password.js"></script>
        <script src="../../assets/scripts/validacion_registro.js"></script>
    </body>
</html>