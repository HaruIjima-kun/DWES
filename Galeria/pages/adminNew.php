<?php
require '../clases/AutoCarga.php';

$sesion = new Session();

if (!$sesion->isLogged()) {
    header( "Location:../index.php");
}

$usuario = $sesion->getUser();

$alias = $usuario->getAlias();
$avatar = $usuario->getAvatar();
$email = $usuario->getEmail();
$admin = $usuario->getAdministrador();
$personal = $usuario->getPersonal();
$activo = $usuario->getActivo();

function seleccionar($parametro) {
    if ($parametro == 1) {
        echo 'checked="checked"';
    }
}
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminUSERS - Nuevo Usuario</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="../css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="../css/estilosPersonalizados.css">

    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">

                <!-- Logo -->
                <a href="adminProfile.php" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>LT</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b>USERS</span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="<?php echo $avatar ?>" class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs"><?php echo $alias ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="<?php echo $avatar ?>" class="img-circle" alt="User Image">
                                        <p>
                                            <?php echo $alias ?>
                                            <small>
                                                <?php echo $email ?>
                                            </small>
                                        </p>

                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <form action="adminProfile.php">
                                                <input type="submit" class="btn btn-default btn-flat" value="Perfil">
                                            </form>
                                            <!--<a href="pages/examples/profile.html" class="btn btn-default btn-flat">Perfil</a>-->
                                        </div>
                                        <div class="pull-left">
                                            <form action="../index.php">
                                                <input type="submit" class="btn btn-default btn-flat" value="Galería">
                                            </form>
                                            <!--<a href="pages/examples/profile.html" class="btn btn-default btn-flat">Perfil</a>-->
                                        </div>
                                        <div class="pull-right">
                                            <form method="post" action="phplogout.php"  enctype="multipart/form-data">
                                                <input type="submit" class="btn btn-default btn-flat" value="Cerrar sesión">
                                            </form>
                                            <!--<a href="#" class="btn btn-default btn-flat">Cerrar Sesión</a>-->
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo $avatar ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $alias ?></p>
                            <!-- Status -->
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu">
                        <li class="header">Menú de navegación</li>
                        <!-- Optionally, you can add icons to the links -->
                        <!--<li class="active"><a href="#"><i class="fa fa-user"></i> <span>Perfil</span></a></li>-->
                        <li class="treeview">
                            <a href="#"><i class="fa fa-user"></i> <span>Perfil</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="adminProfile.php">Mi perfil</a></li>
                                <li><a href="adminEdit.php">Editar</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-users"></i> <span>Usuarios</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="adminNew.php">Nuevo Usuario</a></li>
                                <li><a href="adminView.php">Visualizar</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-photo"></i> <span>Galería</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="adminGallery.php">Nueva entrada</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $alias ?>
                        <small>Nuevo usuario</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Usuarios</a></li>
                        <li class="active">Nuevo usuario</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Datos de cuenta</h3>
                                </div>
                                <!-- /.box-header -->
<!--                                <div class="alert alert-success alert-dismissable col-md-12" >
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4>	<i class="icon fa fa-check"></i> ¡Enorabuena!</h4>
                                    Sus datos han sido modificados satisfactoriamente.
                                </div>-->
                                <!-- form start -->
                                <form role="form" action="phpNewUser.php" method="post" enctype="multipart/form-data">
                                    <div class="box-body form_nuevo">
                                        <div class="form-group col-md-4">
                                            <label for="alias">Alias</label>
                                            <input type="text" class="form-control" id="alias" name="alias" placeholder="Enter alias">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputPassword1">Contraseña</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputPassword1">Confirmar contraseña</label>
                                            <input type="password" id="password2" class="form-control" id="password2" placeholder="Password">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="avatarNuevo">Avatar</label>
                                            <input type="file" id="avatar" name="avatar" accept="image/*">
                                        </div>
                                        <div class="checkbox checkbox_nuevo col-md-8">
                                            <label>
                                                <input id="check_admin" name="check_admin" type="checkbox" class="minimal"> Administrador
                                            </label>
                                            <br/>
                                            <label>
                                                <input id="check_personal" name="check_personal" type="checkbox" class="minimal"> Personal
                                            </label>
                                            <br/>
                                            <label>
                                                <input id="check_activo" name="check_activo" type="checkbox" class="minimal"> Activo
                                            </label>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-default boton_cancelar_form_nuevo">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.box -->
                        </div>

                        <!--/.col (left) -->
                        <!-- right column -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.3.0
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2016 by <a href="#">Jose A. Martín</a>.</strong> Todos los derechos reservados.
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                        <p>Will be 23 on April 24th</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-user bg-yellow"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                                        <p>New phone +1(800)555-1234</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                                        <p>nora@example.com</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-file-code-o bg-green"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                                        <p>Execution time 5 seconds</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Custom Template Design
                                        <span class="label label-danger pull-right">70%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Update Resume
                                        <span class="label label-success pull-right">95%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Laravel Integration
                                        <span class="label label-warning pull-right">50%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Back End Framework
                                        <span class="label label-primary pull-right">68%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                    </div>
                    <!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                    <!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">General Settings</h3>
                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                                <p>
                                    Some information about this general settings option
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Allow mail redirect
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                                <p>
                                    Other sets of options are available
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Expose author name in posts
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                                <p>
                                    Allow the user to show his name in blog posts
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <h3 class="control-sidebar-heading">Chat Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Show me as online
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Turn off notifications
                                    <input type="checkbox" class="pull-right">
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Delete chat history
                                    <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                </label>
                            </div>
                            <!-- /.form-group -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
               immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="../js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../plugins/fastclick/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../js/demo.js"></script>
    </body>

</html>
