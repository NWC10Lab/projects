<?php
include_once("inc/altaUsuario.php");
$suscripciones=selectSuscriopciones();
$result= array(true,"");

if(
   isset($_POST["formlog"])&&!empty($_POST["formlog"])&&
   isset($_POST["nombre"])&&!empty($_POST["nombre"])&&
   isset($_POST["email"])&&!empty($_POST["email"])&&
   isset($_POST["password"])&&!empty($_POST["password"])&&
   isset($_POST["password2"])&&!empty($_POST["password2"])&&
   $_POST["password"]==$_POST["password2"]&&
   isset($_POST["tipo_suscripcion"])&&$_POST["tipo_suscripcion"]!=0
   ){
       extract($_POST);
       $result=newUsuario($nombre,$email,$password,$tipo_suscripcion);
}else if(isset($_POST["formlog"])){
    $result= array(false,"Rellene todos los campos");
    /*comprobar datos
    if($_POST["password"]==$_POST["password2"]){
      echo "contraseñas true";
    }
    echo "<pre>";
    echo var_dump($_POST);
    echo "</pre>";*/
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
            <h2><strong>Alta Nuevo Usuario</strong></h2>
            
            <p>Rellene todos los campos</p> 
            
            <form class="m-t" role="" action="<?=$_SERVER['PHP_SELF']?>" method="post"> 
                <div class="form-group">
                    <input name="nombre" type="text" class="form-control" placeholder="Nombre" required="">
                </div>
                <div class="form-group">
                    <input name="email" type="email" class="form-control" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Contraseña" required="">
                </div>
                <div class="form-group">
                    <input name="password2" type="password" class="form-control" placeholder="Repetir Contraseña" required="">
                </div>
                <div class="form-group">
                    <select name="tipo_suscripcion">
                        <option value="0">Eligue una suscripción</option>
                        <?php for($i=0;$i<count($suscripciones);$i++){ ?>
                        <option name="tipo_suscripcion" value="<?= $suscripciones[$i]["id"]?>">Tipo suscripcion: <?= $suscripciones[$i]["nombre"]." (Eventos: ".$suscripciones[$i]["max_eventos"]?>)</option>
                        <?php } ?>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary block full-width m-b" value="Guardar" name="formlog">
                
                <?php if($result[0]){ ?>
                <p class="text-center text-success"><?= $result[1] ?></p>
                <?php }else{ ?>
                <p class="text-center text-danger"><?= $result[1] ?></p>
                <?php } ?>
                
                <p class="text-muted text-center"><small>¿No tienes una cuenta aún?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="http://nwc10.com/#sectioncontac" target="_blank">Contacta con NWC10</a>
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
