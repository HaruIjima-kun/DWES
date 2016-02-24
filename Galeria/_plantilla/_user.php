<?php 
    $sesion = new Session();

    $usuario = $sesion->getUser();

    $alias = $usuario->getAlias();
    $avatar = $usuario->getAvatar();
    $email = $usuario->getEmail();
?>

<div class="logohead">
    <img src="<?php echo $avatar?>" alt="" width="150">
    <br>
    <h2 class="text-center"><?php echo $alias; ?></h2>
    <h3 class="text-center"><?php echo $email ?></h3>
    <br>
    <form method="post" action="pages/phpControl.php">
        <input id="btn_perfil" type="submit" value="Perfil">
    </form>
    <form method="post" action="pages/phplogout.php">
        <input id="btn_perfil" type="submit" value="Cerrar sesión">
    </form>
</div>	
