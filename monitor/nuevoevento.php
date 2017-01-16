<?php
//comprueba sesion y saca el id usuario
include './inc/seguridad.php';
if(!comprobarSession()){
    //header("location:index.php");
    $datosUsuario=datosSession();
    //echo $datosUsuario[0];
    //echo $datosUsuario[1];
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
$camposEventos=camposEvento();
$numCampos=count($camposEventos);

//Controlar maximo eventos segun plan contratado
if(count($eventosActivos)>=$datosUsuario[2]){
    header('location:eventosMax.php');
}

//nuevo evento
$mng="";
if(isset($_POST["formEvento"])){
    //echo "<pre>hola";
    //var_dump($_POST);
    //echo"</pre>";
    //verificacion que existe almenos un campo activo
    $camposVerificacion=false;
    foreach($camposEventos as $campos){
        //echo "<br>".$_POST["campo_$campos[1]"];
        if(isset($_POST["campo_$campos[1]"])){
            $camposVerificacion=true;
        }
    }
    //echo $camposVerificacion;
    if(
       isset($_POST["nombre"])&&!empty($_POST["nombre"])&&
       isset($_POST["lugar"])&&!empty($_POST["lugar"])&&
       isset($_POST["aforo"])&&!empty($_POST["aforo"])&&
       isset($_POST["fecha"])&&!empty($_POST["fecha"])&&
       isset($_POST["hora"])&&!empty($_POST["hora"])&&
       $camposVerificacion
    ){
        //comprueblo los campos xa los suscriptores y creo un array;
        extract($_POST);
        //añado segundos a la hora
        $hora.=":00";
        //creo array con los campos
        $stringCampos="";
        foreach($camposEventos as $campos){
            if(isset($_POST["campo_$campos[1]"])&&!empty($_POST["campo_$campos[1]"])){
                $stringCampos.=$_POST["campo_$campos[1]"]."-";
            }
        }   
        $stringCampos = trim($stringCampos, '-');
        //echo $id_usuario.$nombre.$lugar.$aforo.$fecha.$hora.$stringCampos;
        //echo "<h1>".$fecha."</h1>";
        $result=nuevoEvento($id_usuario,$nombre,$lugar,$aforo,$fecha,$hora,$stringCampos);
        if($result[0]){
            $id_evento=$result[1];
        }else{
            $mng=$result[1];
        }
    }else{
        $mng= "Datos Incorrectos";
    }
}
?>

<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6.2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Dec 2016 13:57:45 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NWC10 | Nuevo Evento</title>
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    
    <!--para la hora-->
    <link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <!--para la fecha-->
    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    
</head>

<body class="">

    <div id="wrapper">

    <?php include("includes/header.php"); ?>

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
                    <!--formulario jm-->
                    <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Nuevo evento <small>Rellene los campos.</small> <?=$mng?></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            <!--FORMULARIO REAL-->
                            <form method="post" class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group"><label class="col-sm-2 control-label">Evento</label>
                                            <div class="col-sm-10"><input name="nombre" type="text" class="form-control" placeholder="Nombre Evento"></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group"><label class="col-sm-2 control-label">Lugar</label>
                                            <div class="col-sm-10"><input name="lugar" type="text" class="form-control"></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group"><label class="col-sm-2 control-label">Aforo</label>
                                            <div class="col-sm-10"><input name="aforo" type="number" class="form-control"></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group" id="data_1"><label class="col-sm-2 control-label">Fecha <span class="small">(evento)</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input type="text" class="form-control" name="fecha" value="2017/01/01">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Hora <span class="small"> (evento)</span></label>
                                            <div class="col-sm-10"><div class="input-group clockpicker" data-autoclose="true">
                                            <input name="hora" type="text" class="form-control" value="09:30">
                                            <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                        </div></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Campos <span class="small"> (suscriptores)</span></label>
                                            <div class="col-sm-10">
                                                <!--Bucle para los checks segun los campos que haya en eventos-->
                                                <?php foreach ($camposEventos as $campo) { ?>
                                                    
                                                <div class="i-checks"> 
                                                    <label class="">
                                                        <div class="icheckbox_square-green" style="position: relative;">
                                                            <input type="checkbox" value="<?=$campo[0]?>" checked="" style="position: absolute; opacity: 0;" name="campo_<?= $campo[1]?>">
                                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                        </div> 
                                                        <i></i> <?= $campo[0]?>
                                                    </label>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="col-lg-4">
                                        <!---->
                                        <div class="widget navy-bg p-xl row form-group">

                                            <h3 class="col-xs-12">Comentarios</h3>
                                            <textarea class="col-xs-12 form-control">
                                                
                                            </textarea>
                                            
                                            
                                        </div>
                                            
                                        <!---->
                                    </div>
                                </div> 
                                <div class="hr-line-dashed"></div>
                                
                                
                                <div class="form-group">
                                    <div class="col-sm-12 float-right">
                                        <button class="btn btn-white" type="submit">Cancel</button>
                                        
                                        <input type="submit" name="formEvento" class="btn btn-primary" value="Crear evento">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                    <!--formulario jm end-->
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
    <!-- Data picker -->
    <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <!-- Clock picker -->
    <script src="js/plugins/clockpicker/clockpicker.js"></script>
    <!-- Data picker -->
    <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
    
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
        $('.clockpicker').clockpicker();
        /*$('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                //format:"yyyy/mm/dd"
            });   */
            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format:"yyyy/mm/dd"
            });
    </script>
   
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6.2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Dec 2016 13:57:45 GMT -->
</html>
