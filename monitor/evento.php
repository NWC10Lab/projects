<?php
//comprueba sesion y saca el id usuario
include './inc/seguridad.php';
if(!comprobarSession()){
    header("location:index.php");
    $datosUsuario=datosSession();
    echo $datosUsuario[0];
    echo $datosUsuario[1];
}
$datosUsuario=datosSession();
$id_usuario=$datosUsuario[0];
$NombreUsuario=$datosUsuario[1];
include './inc/eventos.php';

//Pone el evento en Inactivo
if(isset($_GET['a'])&&$_GET['a']=="e"&&isset($_GET['id_evento'])&&$_GET['id_evento']!=""&&$_GET['id_evento']!=NULL){
    if(comprobarEventoUsuario($id_usuario, $_GET['id_evento'])){
        if(inactivarEvento($_GET['id_evento'])){
            header('location:home.php');
        }
    }
}
$id_evento="";
$eventosInactivos=selectEventosInactivos($id_usuario);
$eventosActivos=selectEventosActivos($id_usuario);
$leads = array();
$tituloEvento = "Eventos";
$tablaLeads="";
$cabeceraTabla="";
$activo=false;
$eventoAct=array("nombre"=>"","fecha"=>"","hora"=>"","lugar"=>"","hora"=>"","aforo"=>"","id"=>"");
if(isset($_GET['id_evento'])&&!empty($_GET['id_evento'])){
    if(comprobarEventoUsuario($id_usuario, $_GET['id_evento'])){
            $eventoAct=selectEvento($_GET['id_evento']);
        $tituloEvento=$eventoAct['nombre'];
        if($eventoAct['fecha_baja']==NULL){
            $activo=true;
        }
        include './inc/leads.php';
        $id_evento=$_GET['id_evento'];
        if(isset($_GET['asistentes'])){
            $leads = selectLeadsAsistentes($_GET['id_evento'],$id_usuario);   
        }else{
            $leads = selectLeads($_GET['id_evento'],$id_usuario);    
        }
        $campos=$eventoAct["campos_suscriptores"];
        //echo "<pre>".$campos;
        $campos=explode("-", $campos);
        //var_dump($campos);
        //echo "</pre>";
        for($i=0;$i<count($campos);$i++){
           $cabeceraTabla.="<th>$campos[$i]</th>";
        }
        $cabeceraTabla.='<th>Fecha inscripción</th>';
        $cabeceraTabla.='<th><input type="checkbox" name="all" class="checkAll"> All</th>';
        //cuerpo de la tabla
        
        foreach($leads as $lead){
            $tablaLeads.= '<tr class="gradeX" >';
            for($i=0;$i<count($campos);$i++){
                $campo=$campos[$i];

                $tablaLeads.="<td>$lead[$campo]</td>"; 
            }    
            $tablaLeads.="<td>".$lead['fecha_alta']."</td>";
            $tablaLeads.='<td class="right">
                                        <!--<a href="" class="btn btn-success btn-xs"><i class="fa fa-envelope"></i></a> 
                                        <a class="btn btn-danger btn-xs" href=""> <i class="fa fa-trash"></i></a>-->
                                        <input type="checkbox" name="check-'.$lead['id'].'" value="'.$lead['id'].'" class="checks">
                                        
                                    </td>
                                </tr>';                     
                                    
        }
    }
}

//datos gráfica leads-dias
$datosArray = datosGraficaLeads($id_evento);
$datosString="";
foreach($datosArray as $dato){
    $datosString.= "[".strtotime($dato['fecha'])."000,".$dato['cantidad']."],";
}
    $datosString= trim($datosString,",");
    
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
    <!--Sweet alert-->
    <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
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
                    <h2 id="titulo-<?=$id_evento?>" class="tituloEvento"><?= $tituloEvento ?></h2>
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
                            <div class="col-lg-3 col-xs-6">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Datos Evento</h5>
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
                                        <ul class="todo-list m-t small-list">
                                            <li><strong>Evento: </strong> <?= $eventoAct['nombre'] ?></li>
                                            <li><strong>Fecha: </strong><?= $eventoAct['fecha'] ?></li>
                                            <li><strong>Hora: </strong><?= $eventoAct['hora'] ?></li>
                                            <li><strong>Lugar: </strong><?= $eventoAct['lugar'] ?></li>
                                            <li><strong>Aforo: </strong><?= $eventoAct['aforo'] ?></li>
                                            <li><strong>Registrados: </strong><?= count($leads) ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Aforo / registrados </h5>
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
                                        <div>
                                            <canvas id="doughnutChart" height="270"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
<!--                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Line Chart Example
                                            <small>With custom colors.</small>
                                        </h5>
                                    </div>
                                    <div class="ibox-content">
                                        <div>
                                            <canvas id="lineChart" height="110"></canvas>
                                        </div>
                                    </div>
                                </div>-->
                                
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Evolución registros de usuarios </h5>
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
                                        <div class="flot-chart">
                                            <div class="flot-chart-content" id="flot-line-chart-multi"></div>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                            
                        </div>
                
                        
                <div class="row">
                    <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Usuarios inscritos</h5>
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
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <?=$cabeceraTabla?>
                                        </tr>
                                    </thead>
            <!--                        <tr class="gradeX hidden" id="fila-leads">    
                                        <td class="nombre">nombre</td>
                                        <td class="apellidos">apellidos</td>
                                        <td class="email">email</td>
                                        <td class="dni">dni</td>
                                        <td class="empresa">empresa</td>
                                        <td class="telefono">telefono</td>
                                        <td class="right">
                                            <a href="" class="btn btn-success btn-xs"><i class="fa fa-envelope"></i></a> 
                                            <a class="btn btn-danger btn-xs" href=""> <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>-->
                                    <tbody id="tabla-leads">


                                        <?= $tablaLeads ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <?=$cabeceraTabla?>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <?php if($activo){ ?>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12"><a href="<?=$_SERVER['PHP_SELF']?>?id_evento=<?=$id_evento?>" class="btn btn-primary btn-block">Inscritos</a></div>
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12"><a href="<?=$_SERVER['PHP_SELF']?>?id_evento=<?=$id_evento?>&asistentes=1" class="btn btn-primary btn-block">Han asistido</a></div>
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12"><div class="btn btn-primary btn-block" id="mandarMail">Email</div></div>
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12"><div class="btn btn-primary btn-block" id="borrarLeads">Borrar Leads</div></div>
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12"><div class=""></div></div>
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12"><div id="eliminarEvento" class="btn btn-danger btn-block" data="<?=$eventoAct['id']?>">Finalizar Evento</div></div>
                                </div>
                                <?php } ?>
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
    
    
    
    
    <script src="js/plugins/dataTables/datatables.min.js"></script>
    
    <!-- Gráficos -->
    <script src="js/plugins/chartJs/Chart.min.js"></script>
<!--    <script src="js/demo/chartjs-demo.js"></script>-->
    
    <!-- Sweet alert -->
    <script src="js/plugins/sweetalert/sweetalert.min.js"></script>
    
    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/jquery.flot.time.js"></script>

    
    
    <!--Mi js-->
    <script src="js/mainEvents.js"></script>
    
    
    <script>
    //graficos
    //donut
    var aforo=<?=$eventoAct['aforo']?>;
    var leads=<?= count($leads) ?>;
    aforo=aforo-leads;
    var doughnutData = {
        labels: ["Aforo Libre","Usuarios Registrados" ],
        datasets: [{
        data: [aforo,leads],
        backgroundColor: ["#dedede","#1ab394"]
        }]
    } ;
    var doughnutOptions = {
        responsive: true
    };
    var ctx4 = document.getElementById("doughnutChart").getContext("2d");
    new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});
    
    
    //linea del tiempo mejorada
    
    //Flot Multiple Axes Line Chart
$(function() {
    var oilprices = [ [1167692400000, 61.05], [1167778800000, 58.32], [1167865200000, 57.35], [1167951600000, 56.31], [1168210800000, 55.55], [1168297200000, 55.64], [1168383600000, 54.02], [1168470000000, 51.88], [1168556400000, 52.99], [1168815600000, 52.99], [1168902000000, 51.21], [1168988400000, 52.24], [1169074800000, 50.48], [1169161200000, 51.99], [1169420400000, 51.13], [1169506800000, 55.04], [1169593200000, 55.37], [1169679600000, 54.23], [1169766000000, 55.42], [1170025200000, 54.01], [1170111600000, 56.97], [1170198000000, 58.14], [1170284400000, 58.14], [1170370800000, 59.02], [1170630000000, 58.74], [1170716400000, 58.88], [1170802800000, 57.71], [1170889200000, 59.71], [1170975600000, 59.89], [1171234800000, 57.81], [1171321200000, 59.06], [1171407600000, 58.00], [1171494000000, 57.99], [1171580400000, 59.39], [1171839600000, 59.39], [1171926000000, 58.07], [1172012400000, 60.07], [1172098800000, 61.14], [1172444400000, 61.39], [1172530800000, 61.46], [1172617200000, 61.79], [1172703600000, 62.00], [1172790000000, 60.07], [1173135600000, 60.69], [1173222000000, 61.82], [1173308400000, 60.05], [1173654000000, 58.91], [1173740400000, 57.93], [1173826800000, 58.16], [1173913200000, 57.55], [1173999600000, 57.11], [1174258800000, 56.59], [1174345200000, 59.61], [1174518000000, 61.69], [1174604400000, 62.28], [1174860000000, 62.91], [1174946400000, 62.93], [1175032800000, 64.03], [1175119200000, 66.03], [1175205600000, 65.87], [1175464800000, 64.64], [1175637600000, 64.38], [1175724000000, 64.28], [1175810400000, 64.28], [1176069600000, 61.51], [1176156000000, 61.89], [1176242400000, 62.01], [1176328800000, 63.85], [1176415200000, 63.63], [1176674400000, 63.61], [1176760800000, 63.10], [1176847200000, 63.13], [1176933600000, 61.83], [1177020000000, 63.38], [1177279200000, 64.58], [1177452000000, 65.84], [1177538400000, 65.06], [1177624800000, 66.46], [1177884000000, 64.40], [1178056800000, 63.68], [1178143200000, 63.19], [1178229600000, 61.93], [1178488800000, 61.47], [1178575200000, 61.55], [1178748000000, 61.81], [1178834400000, 62.37], [1179093600000, 62.46], [1179180000000, 63.17], [1179266400000, 62.55], [1179352800000, 64.94], [1179698400000, 66.27], [1179784800000, 65.50], [1179871200000, 65.77], [1179957600000, 64.18], [1180044000000, 65.20], [1180389600000, 63.15], [1180476000000, 63.49], [1180562400000, 65.08], [1180908000000, 66.30], [1180994400000, 65.96], [1181167200000, 66.93], [1181253600000, 65.98], [1181599200000, 65.35], [1181685600000, 66.26], [1181858400000, 68.00], [1182117600000, 69.09], [1182204000000, 69.10], [1182290400000, 68.19], [1182376800000, 68.19], [1182463200000, 69.14], [1182722400000, 68.19], [1182808800000, 67.77], [1182895200000, 68.97], [1182981600000, 69.57], [1183068000000, 70.68], [1183327200000, 71.09], [1183413600000, 70.92], [1183586400000, 71.81], [1183672800000, 72.81], [1183932000000, 72.19], [1184018400000, 72.56], [1184191200000, 72.50], [1184277600000, 74.15], [1184623200000, 75.05], [1184796000000, 75.92], [1184882400000, 75.57], [1185141600000, 74.89], [1185228000000, 73.56], [1185314400000, 75.57], [1185400800000, 74.95], [1185487200000, 76.83], [1185832800000, 78.21], [1185919200000, 76.53], [1186005600000, 76.86], [1186092000000, 76.00], [1186437600000, 71.59], [1186696800000, 71.47], [1186956000000, 71.62], [1187042400000, 71.00], [1187301600000, 71.98], [1187560800000, 71.12], [1187647200000, 69.47], [1187733600000, 69.26], [1187820000000, 69.83], [1187906400000, 71.09], [1188165600000, 71.73], [1188338400000, 73.36], [1188511200000, 74.04], [1188856800000, 76.30], [1189116000000, 77.49], [1189461600000, 78.23], [1189548000000, 79.91], [1189634400000, 80.09], [1189720800000, 79.10], [1189980000000, 80.57], [1190066400000, 81.93], [1190239200000, 83.32], [1190325600000, 81.62], [1190584800000, 80.95], [1190671200000, 79.53], [1190757600000, 80.30], [1190844000000, 82.88], [1190930400000, 81.66], [1191189600000, 80.24], [1191276000000, 80.05], [1191362400000, 79.94], [1191448800000, 81.44], [1191535200000, 81.22], [1191794400000, 79.02], [1191880800000, 80.26], [1191967200000, 80.30], [1192053600000, 83.08], [1192140000000, 83.69], [1192399200000, 86.13], [1192485600000, 87.61], [1192572000000, 87.40], [1192658400000, 89.47], [1192744800000, 88.60], [1193004000000, 87.56], [1193090400000, 87.56], [1193176800000, 87.10], [1193263200000, 91.86], [1193612400000, 93.53], [1193698800000, 94.53], [1193871600000, 95.93], [1194217200000, 93.98], [1194303600000, 96.37], [1194476400000, 95.46], [1194562800000, 96.32], [1195081200000, 93.43], [1195167600000, 95.10], [1195426800000, 94.64], [1195513200000, 95.10], [1196031600000, 97.70], [1196118000000, 94.42], [1196204400000, 90.62], [1196290800000, 91.01], [1196377200000, 88.71], [1196636400000, 88.32] ];
    var oilprices = [<?=$datosString?>];
    var exchangerates = [ ];

    function euroFormatter(v, axis) {
        return v.toFixed(axis.tickDecimals) + "€";
    }

    function doPlot(position) {
        $.plot($("#flot-line-chart-multi"), [{
            data: oilprices,
            label: "Inscritos "
        }], {
            xaxes: [{
                mode: 'time'
            }],
            
            legend: {
                position: 'sw'
            },
            colors: ["#1ab394"],
            grid: {
                color: "#999999",
                hoverable: true,
                clickable: true,
                tickColor: "#D4D4D4",
                borderWidth:0,
                hoverable: true //IMPORTANT! this is needed for tooltip to work,
                
            },
            series: {
                lines: {
                    fill:true,
                    fillColor: "rgba(26,179,148,.4)"
                }
            },
            tooltip: true,
            tooltipOpts: {
                content: "%s el %x : <strong>%y</strong>",
                //xDateFormat: "%y-%m-%d",
                xDateFormat: "%d-%b-%Y",
                monthNames: ["en", "feb", "mar", "abr", "may", "jun", "jul", "ago", "sep", "oct", "nov", "dic"],
                onHover: function(flotItem, $tooltipEl) {
                    // console.log(flotItem, $tooltipEl);
                }
            }
            
        });
    }

    doPlot("right");

    $("button").click(function() {
        doPlot($(this).text());
    });
});
    
    //line del tiempo
    /*var lineData = {
        labels: ["January", "February", "March", "April", "May", "June", "Julio"],
        datasets: [
            {
                label: "Suscripciones",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [28, 48, 40, 19, 86, 27, 90]
            },{
                label: "Data 2",
                backgroundColor: 'rgba(220, 220, 220, 0.5)',
                pointBorderColor: "#fff",
                data: [65, 59, 80, 81, 56, 55, 40]
            }
        ]
    };
    var lineOptions = {responsive: true};
    var ctx = document.getElementById("lineChart").getContext("2d");
    new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});*/
    
    //eliminar evento
    $("#eliminarEvento").click( function(){
        swal({
                title: "Estas seguro?",
                text: "Vas a finalizar el evento.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, finalízalo",
                cancelButtonText: "No, cancela porfavor",
                closeOnConfirm: false,
                closeOnCancel: false },
            function (isConfirm) {
                if (isConfirm) {
                    var id_evento=$("#eliminarEvento").attr("data");
                    window.location.href = "evento.php?a=e&id_evento="+id_evento;
                    swal("Deleted!", "Your imaginary file"+id_evento+" has been deleted.", "success");
                } else {
                    swal("Cancelado", "El evento sigue activo :)", "error");
                }
            });
    });
    
    //check all
    $('.checkAll').click(function() {
        if ($(this).is(':checked')) {
          $(".checks").prop('checked', true);
          $(".checkAll").prop('checked', true);
        }else{
            $(".checks").prop('checked', false);
            $(".checkAll").prop('checked', false);
        }
    });
    
    //eliminarLead
    $("#borrarLeads").click(function(){
        swal({
                title: "Estas seguro?",
                text: "Vas a eliminar todos los usuarios marcados.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, elimínalos",
                cancelButtonText: "No, cancela porfavor",
                closeOnConfirm: false,
                closeOnCancel: false },
            function (isConfirm) {
                if (isConfirm) {
                    var ids = "evento="+$(".tituloEvento").attr("id").split("-")[1]+"&check=";  
                    $(".checks").each(function(){
                        if($(this).is(':checked')){
                            ids+=$(this).val()+",";
                        }
                    });
                    ids = ids.substring(0,ids.length-1);
                    console.log(ids);
                    //eliminar los leads x ajax
                    $.ajax({
                            data:  ids,
                            url:   'eliminarLeads.php',
                            type:  'post',
                            beforeSend: function () {
                                    
                            },
                            success:  function (response) {
                                    if(response=="1"){
                                        swal("Eliminados", "Los usuarios seleccionados han sido eliminados.", "success");
                                        location.reload();
                                    }else{
                                        swal("Ha habido un problema!", response , "error");                           
                                    }
                            },
                            error: function (){
                                swal("Ha habido un problema!", "Error 404. Contacte con el administrador.", "error");
                            }
                    });             
                } else {
                    swal("Cancelado", "Los usuarios siguen activos :)", "error");
                }
            });
    });
    </script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6.2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Dec 2016 13:57:45 GMT -->
</html>
