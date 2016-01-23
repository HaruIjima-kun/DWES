<?php
require 'clases/AutoCarga.php';
$sesion = new Session();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Material Login Form</title>
        <link rel="stylesheet" href="css/reset.css">
        <!--<link rel='stylesheet prefetch' href='css/fonts.css'>-->
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link rel='stylesheet prefetch' href='css/font-awesome.min.css'>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <!-- Mixins-->
        <!-- Pen Title-->
        <!--        <div class="pen-title">
                    <h1>Login / Sign In Formulario</h1>
                </div>-->
        <br/>
        <div class="rerun"><a href="phpControl.php">Acceso con Google+</a></div>
        <?php
        if (!$sesion->isLogged()) {
            ?>
            <div class="container">
                <div class="card"></div>
                <div class="card">
                    <h1 class="title">Login</h1>
                    <form id="formulario_login" action="pages/phplogin.php" method="post" autocomplete="off">
                        <div class="input-container">
                            <input type="text" id="user" name="user" required="required" autocomplete=""/>
                            <label for="user">Usuario</label>
                            <div class="bar"></div>
                        </div>
                        <div class="input-container">
                            <input type="password" id="password" name="password" required="required" autocomplete=""/>
                            <label for="password">Contraseña</label>
                            <div class="bar"></div>
                        </div>
                        <div class="button-container">
                            <button action="submit"><span>Iniciar Sesión</span></button>
                        </div>
                        <div class="footer"><a href="#">¿Has olvidado tu contraseña?</a></div>
                        <input type="hidden" name="procedencia" id="procedencia" value="login" />
                            <input type="hidden" name="destino" id="destino" value="login" />
                    </form>
                </div>
                <div class="card alt">
                    <div class="toggle"></div>
                    <h1 class="title">Registro
                        <div class="close"></div>
                    </h1>
                    <form id="formulario_register" action="pages/phpRegister.php" method="post" autocomplete="off">
                        <div class="input-container">
                            <input type="text" id="email" name="email" required="required"/>
                            <label for="email">Email</label>
                            <div class="bar"></div>
                        </div>
                        <div class="input-container">
                            <input type="password" id="password" name="password" required="required"/>
                            <label for="Password">Contraseña</label>
                            <div class="bar"></div>
                        </div>
                        <div class="input-container">
                            <input type="password" id="confirm_password" required="required"/>
                            <label for="confirm_password">Repetir contraseña</label>
                            <div class="bar"></div>
                        </div>
                        <div class="button-container">
                            <button type="submit" id="boton_registrar"><span>Siguiente</span></button>
                        </div>
                        <input type="hidden" name="procedencia" id="procedencia" value="registro" />
                        <input type="hidden" name="destino" id="destino" value="registro" />
                    </form>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="rerun"><a href="pages/phplogout.php">Log Out</a></div>
            <?php
        }
        ?>
        <!-- Portfolio--><a id="portfolio" href="" title="View my portfolio!"><i class="fa fa-link"></i></a>
        <!-- CodePen--><a id="codepen" href="" title="Follow me!"><i class="fa fa-codepen"></i></a>
        <!-- <script src='js/jquery.min.js'></script> -->
        <script src='js/jquery-1.12.0.js'></script>
        <script src="js/index.js"></script>

    </body>

</html>