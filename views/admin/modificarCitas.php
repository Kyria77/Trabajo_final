<?php
    require_once __DIR__ . '/../../config/config.php';
    require_once '../../controllers/clases/Cl_Citas.php';
    require_once '../../controllers/clases/Cl_Usuarios.php';

    //Comprobar si existe una sesión activa y en caso de que no así la crearemos
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //Redirigir al LOGIN si el usuario no ha iniciaco sesión (es decir, si no existe user_id)
    if(isset($_SESSION['user_data_all'])){
        $user_data = $_SESSION['user_data_all'];
    }else{
        $_SESSION["mensaje_error"] = "Lo sentimos, debes iniciar sesión primero";
        header("Location: ../login.php");
        exit();
    }
    if (isset($_SESSION['idUser_citas'])) {
        $citaObj = new Cita();
        $userObj = new Usuario();
        $idUser = $_SESSION['idUser_citas'];
        $citas = $citaObj->leerCitaPendienteAdmin($idUser, $mysqli_connection);
        $usuario = $userObj->leerUsuarioById($idUser, $mysqli_connection);

    } else {
        $_SESSION["mensaje_error"] = "No se ha seleccionado ningún usuario para ver citas.";
        header("Location: ../../views/admin/updateDelete.php");
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
                        <li><a class="out" href="../../index.php">Inicio</a></li>
                        <li><a class="out" href="../noticias.php">Noticias</a></li>
                        <li><a class="out" href="usuariosAdmin.php">User Admin</a></li>
                        <li><a class="inn" href="#">Citas Admin</a></li>
                        <li><a class="out" href="noticiasAdmin.php">Noticias Admin</a></li>
                        <li><a class="out" href="../users/perfil.php">Perfil</a></li>
                        <li><a class="out" href="../../controllers/cerrar_sesion.php">Cerrar sesión</a></li>
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
                <div class="cartel_citas">
                    <h2>CITAS</h2>
                </div>
                <nav class="main_nav_content">
                    <ul class="main_navLinks">
                        <li><a class="out_login" href="citasAdmin.php">Volver</a></li>
                    </ul>
                </nav>
            </div>

            <div class="main_registro_content">
                <div class="registro_presentacion">
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
                    <h2>Solicitar nueva cita</h2>    
                    <form class="form_citas" id="form_citas" name="form_citas" method="POST" action="../../controllers/c_citasAdmin.php">
                    <input type="hidden" name="idUser" value="<?php echo $idUser; ?>">
                        <div class="infoForm-container">
                            <div class="input-container">
                                <label for="nombre_apellidos">Nombre y apellidos:</label>
                                <input type="text" id="nombre_apellidos" name="nombre_apellidos" value="<?php echo $usuario['nombre'] . " " . $usuario['apellidos'] ?>" disabled>
                                <small class="error" id="nombreError"></small>
                            </div>
                            <div class="input-container">
                                <label for="fcita">Fecha:</label>
                                <input type="date" id="fcita" name="fcita">
                                <small class="error" id="fcitaError"></small>
                            </div>
                            <div class="input-container">
                                <label for="asunto">Asunto:</label>
                                <input type="text" id="asunto" name="asunto">
                                <small class="error" id="asuntoError"></small>
                            </div>
                            <div class="button-container_citas">
                                <input type="submit" name="cita" value="Solicitar cita">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="citas_pendientes">
                <?php if($citas){
                    foreach($citas as $cita){
                        ?>
                        <div class="cita">
                            <form class="form_citas" id="form_citas" name="form_citas" method="POST" action="../../controllers/c_citasAdmin.php">
                                <input type="hidden" name="idCita" value="<?php echo $cita['idCita']; ?>">
                                <div class="infoForm-container">
                                    <div class="input-container">
                                        <label for="fcita">Fecha:</label>
                                        <input type="date" id="fcita" name="fcita" value="<?php echo $cita['fecha_cita'] ?>">
                                        <small class="error" id="fcitaError"></small>
                                    </div>
                                    <div class="input-container">
                                        <label for="asunto">Asunto:</label>
                                        <input type="text" id="asunto" name="asunto" value="<?php echo $cita['motivo_cita'] ?>">
                                        <small class="error" id="asuntoError"></small>
                                    </div>
                                    <div class="button-container_gestion_citas">
                                        <input type="submit" name="actualizar" value="Actualizar cita">
                                        <input type="submit" name="borrar" value="Borrar cita">
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

        <script src="../../assets/scripts/validacion_citas.js"></script>
    </body>
</html>