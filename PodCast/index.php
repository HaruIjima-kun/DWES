<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PodCast</title>
        <link rel="stylesheet" type="text/css" href="css/estilos1.css"/>
    </head>
    <body id="index">

        <div id="capaCentrada">
            <form action="pages/phplogin.php" method="post"
                  enctype="multipart/form-data" class="posicion_formulario">
                <label id="lblUsuario">Usuario: </label>
                <input type="text" name="usuario" placeholder="Escriba su usuario" required autofocus=""/>
                <br/>
                <label id="lblCategoria">Contraseña: </label>
                <input type="password" name="pass" placeholder="Escriba una categoría" required/>
                <br/>
                <input type="submit" value="Iniciar Sesión" name="login" />
            </form>
        </div>
    </body>
</html>
