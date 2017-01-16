<?php
include_once("inc/newLead.php");
$result= array(true,"");

if(isset($_POST["formRegistro"])&&!empty($_POST["formRegistro"])){
    
    
    $id_evento=7;//evento con todos los campos menos 1
    $id_evento=6;//evento con 2 campos
    $lead= new NewLead($id_evento);
    $result=$lead->guardarDatos($_POST);
}

?>

<!DOCTYPE html>
<html>
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
    <!-- Data picker -->
    <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
</head>

<body class="gray-bg">  
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name "><img src="img/logo_cnw.png" style="max-width: 300px;"></h1>
            </div>
            <h2><strong>SUSCRIBETE AL EVENTO BLABLA</strong></h2>
            
            <p>Rellene todos los campos</p> 
            
            <form class="m-t" role="" action="<?=$_SERVER['PHP_SELF']?>" method="post"> 
                <div class="form-group">
                    <input name="nombre" type="text" class="form-control" placeholder="Nombre" required="">
                </div>
                <div class="form-group">
                    <input name="apellidos" type="text" class="form-control" placeholder="Apellidos" required="">
                </div>
<!--                <div class="form-group">
                    <input name="email" type="email" class="form-control" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <input name="dni" type="text" class="form-control" placeholder="Dni" required="">
                </div>
                <div class="form-group">
                    <input name="telefono" type="tel" class="form-control" placeholder="Teléfono" required="">
                </div>
                <div class="form-group">
                    <input name="empresa" type="text" class="form-control" placeholder="Empresa" required="">
                </div>-->
                <input type="submit" class="btn btn-primary block full-width m-b" value="Guardar" name="formRegistro">
                
                <?php if($result[0]){ ?>
                <p class="text-center text-success"><?= $result[1] ?></p>
                <?php }else{ ?>
                <p class="text-center text-danger"><?= $result[1] ?></p>
                <?php } ?>
                
            </form>
            <p class="m-t"> <small>NWC10 Transformación Digital &copy; 2016</small> </p>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6.2.1/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Dec 2016 13:55:43 GMT -->
</html>
