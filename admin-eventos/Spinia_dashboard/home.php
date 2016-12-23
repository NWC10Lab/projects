<?php
//comprueba sesion y saca el id usuario
include './inc/seguridad.php';
if(!comprobarSession()){
    //header("location:index.php");
    $datosUsuario=datosSession();
    echo $datosUsuario[0];
    echo $datosUsuario[1];
}
$datosUsuario=datosSession();
$id_usuario=$datosUsuario[0];
$NombreUsuario=$datosUsuario[1];
include './inc/eventos.php';



$eventosInactivos=selectEventosInactivos($id_usuario);
$eventosActivos=selectEventosActivos($id_usuario);
$leads = array();
$tituloEvento = "Eventos";
$tablaLeads="";
?>

<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6.2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Dec 2016 13:57:45 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NWC10 | Home</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    
</head>

<body class="">

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> 
            
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?=$NombreUsuario?></strong></span></span></a>
<!--                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>-->
                    </div>
                    <div class="logo-element">
                        NWC10
                    </div>
                </li>

                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Eventos Inactivos</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if(count($eventosInactivos)>0){ ?>
                        <?php foreach($eventosInactivos as $evento){ ?>
                        <li><a href="evento.php?id_evento=<?= $evento["id"] ?>" id="evento_<?=$evento["id"]?>" class="evento"><?=$evento["nombre"]?></a></li>
                        <?php }}else{ ?>
                        <li><a href="#">Ninguno</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Eventos Activos</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if(count($eventosActivos)>0){ ?>
                        <?php foreach($eventosActivos as $evento){ ?>
                        <li><a href="evento.php?id_evento=<?= $evento["id"] ?>" id="evento_<?=$evento["id"]?>" class="evento"><?=$evento["nombre"]?></a></li>
                        <?php }}else{ ?>
                        <li><a href="#">Ninguno</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li>
                    <a href="nuevoevento.php"><i class="fa fa-pie-chart"></i> <span class="nav-label">Nuevo evento</span>  </a>
                </li>
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Bienvenido <?= $NombreUsuario ?></span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">18</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> 18 
                                    <span class="pull-right text-muted small">personas se han suscrito a eventos</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="salir.php">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2><?= $tituloEvento ?></h2>
                </div>
            </div>
            <!--main-->
<!--            <div class="wrapper wrapper-content">
                <div class="middle-box text-center animated fadeInRightBig">
                    <h3 class="font-bold">Bienvenido a NWC10 EVENTS</h3>
                    <div class="error-desc">
                        Empieza creando un <strong>EVENTO</strong> o entra en uno existente.
                    </div>
                </div>
            </div>-->
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Acciones</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-12"><h2 class="text-center">¡Bienvenido <?= $NombreUsuario ?>!</h2></div>
                                        <div class="col-xs-12"><p class="text-center">Entre en un proyecto o empiece uno nuevo para comenzar.</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                
            </div>
            <!--Footer-->
            <div class="footer">
                <div class="pull-right">
                     <strong>Transformación</strong> Digital
                </div>
                <div>
                    <strong>Copyright</strong> NWC10 &copy; 1997-2017
                </div>
            </div>

        </div>
        </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
    
    
    
    <script src="js/mainEvents.js"></script>
    <script src="js/plugins/dataTables/datatables.min.js"></script>


</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6.2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Dec 2016 13:57:45 GMT -->
</html>
