<?php require '../clases/AutoCarga.php'; $bd=new DataBase(); $gestorCountry=new ManageCountry($bd); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{titulo}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../estilo/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="../estilo/vendor/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../estilo/estilo.css">
    <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>

<body>
    <!-- Aquí van los diálogos -->
    <!-- Modal -->
    <div class="modal fade" id="formularioInsertar" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <form id="formInsertar">
                        Nombre
                        <input type="text" id="Name" value="" />
                        <br/> Pais
                        <?php echo Util::getSelect( "CountryCode", $gestorCountry->getValuesSelect()); ?>
                        <br/> Distrito
                        <input type="text" id="District" value="" />
                        <br/> Poblacion
                        <input type="number" id="Population" value="" />
                        <input type="text" id="ID" value="" hidden/>
                        <br/>
                    </form>
                    <div class="modal-footer">
                        <button type="button" id="btInsertar" class="btn btn-default">Insert</button>
                        <button type="button" id="btEditar" class="btn btn-default">Edit</button>
                        <button type="button" id="" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <div><span id="mensajeInsertar"></span></div>
                </div>
            </div>

        </div>
    </div>

    <!-- Fin de los dialogos -->

    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <!--/.navbar-collapse -->
        </div>
    </div>
    <div class="jumbotron">
        <div id="divLogin" class="navbar-form navbar-right form-group mostrar">
            <div class="form-group">
                <input type="text" name="user" id="login" value="" placeholder="Username" class="form-control" />
                <input type="password" name="password" id="clave" value="" placeholder="Password" class="form-control" />
                <input type="button" id="btlogin2" value="Login" class="btn btn-success" />
            </div>
            <br/>
            <span class="ocultar" id="mensajeError">Fallo al iniciar sesión.</span>
            
        </div>
        <div class="row ocultar" id="divRespuesta">
            <h1>Estás logueado.</h1>
            <h2><a href="#" id="btlogout">Cerrar sesión</a></h2>
        </div>



        <!--<div id="divLogin" class="row mostrar" >
                <h1>Login</h1>
                <br>
                <input type="text" name="user" id="login" value="" placeholder="Username" class="form-control"/>
                <input type="password" name="password" id="clave" value="" placeholder="Password" />
                <input type="button" id="btlogin2" value="Login" /><br/>
                <span  class="ocultar" id="mensajeError">Fallo al iniciar sesión.</span>
            </div>
            
            <div class="row ocultar" id="divRespuesta" >
                <h1>Estás logueado.</h1>
                <h2><a href="#" id="btlogout">Cerrar sesión</a></h2>
            </div>-->


        <div class="row" id="divCiudades">
            <button type="button" id="botonInsertarDialog" class="btn btn-info btn-lg" data-toggle="modal" data-target="#formularioInsertar">Insertar</button>
        </div>
    </div>
    <div class="container">
        <hr>
        <footer>
            <p>&copy; {pie}</p>
        </footer>
    </div>
    <script src="../js/vendor/jquery-1.11.1.js"></script>
    <script src="../js/vendor/bootstrap.min.js"></script>
    <script src="../js/ajax.js"></script>
    <script src="../js/codigoLogin.js"></script>
</body>

</html>
<?php $bd->close(); ?>