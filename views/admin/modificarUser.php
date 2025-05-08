<?php
    require_once __DIR__ . '/../../config/config.php';
    require_once '../../controllers/clases/Cl_Usuarios.php';

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
        $idUser = $_SESSION['idUser'];
    }

    $userObj = new Usuario();
    $usuario = $userObj->leerUsuarioById($idUser, $mysqli_connection);
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
                        <li><a class="inn" href="#">User Admin</a></li>
                        <li><a class="out" href="citasAdmin.php">Citas Admin</a></li>
                        <li><a class="out" href="noticiasAdmin.php">Noticias Admin</a></li>
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
                    <h2>User Admin</h2>
                </div>
                <nav class="main_nav_content">
                    <ul class="main_navLinks">
                        <li><a class="out" href="updateDelete.php">Volver</a></li>
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
                <form class="form_actualizar" id="form_registro" name="form_actualizar" method="POST" action="../../controllers/c_userAdmin.php">
                <input type="hidden" name="idUser" value="<?php echo $idUser; ?>">
                    <div class="infoForm-container">
                        <div class="input-container">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>">
                            <small class="error" id="nombreError"></small>
                        </div>
                        <div class="input-container">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" id="apellidos" name="apellidos" value="<?php echo $usuario['apellidos']; ?>">
                            <small class="error" id="apellidosError"></small>
                        </div>
                        <div class="input-container">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" id="telefono" name="telefono" value="<?php echo $usuario['telefono']; ?>">
                            <small class="error" id="telefonoError"></small>
                        </div>
                        <div class="input-container">
                            <label for="email">Email:</label>
                            <input type="text" id="email" name="email" value="<?php echo $usuario['email']; ?>" disabled>
                            <small class="error" id="emailError"></small>
                        </div>
                        <div class="input-container">
                            <label for="fnac">Fecha de nacimiento:</label>
                            <input type="date" id="fnac" name="fnac" value="<?php echo $usuario['fnac']; ?>">
                            <small class="error" id="fnacError"></small>
                        </div>
                        <div class="input-container">
                            <label for="direccion">Dirección:</label>
                            <input type="text" id="direccion" name="direccion" value="<?php echo $usuario['direccion']; ?>">
                            <small class="error" id="direccionError"></small>
                        </div>
                        <div class="input-container">
                            <label for="sexo">Sexo:</label>
                            <select id="selectFormacion" name="sexo">
                                <option value="Prefiero no responder" <?php echo ($usuario['sexo'] == 'Prefiero no responder') ? 'selected' : ''; ?>>Prefiero no responder</option>
                                <option value="Femenino" <?php echo ($usuario['sexo'] == 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
                                <option value="Masculino" <?php echo ($usuario['sexo'] == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                            </select>
                        </div>
                        <div class="input-container">
                            <label for="rol">Rol:</label>
                            <select id="selectFormacion" name="rol">
                                <option value="user" <?php echo ($usuario['rol'] == 'user') ? 'selected' : ''; ?>>User</option>
                                <option value="admin" <?php echo ($usuario['rol'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                            </select>
                        </div>
                        <div class="input_container password_show">
                            <label for="check_password">Mostrar contraseña</label>
                            <input type="checkbox" id="check_password">
                        </div>
                        <div class="button-container_login">
                            <input type="submit" name="actualizarUserAdmin" value="Modificar usuario">
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