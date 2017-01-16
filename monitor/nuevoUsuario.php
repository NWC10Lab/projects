<?php
include_once("inc/funciones2.php");
$zonas= array(array('id'=>'1','zona'=>'Barrio Salamanca'),array('id'=>'2','zona'=>'Barrio Chamberí'));//getZonas();
$result= array(true,"");
if(isset($_POST['formlog'])){
    echo "<pre>".var_dump($_POST)."</pre>";
}
if(
   isset($_POST["formlog"])&&!empty($_POST["formlog"])&&
   isset($_POST["username"])&&!empty($_POST["username"])&&
   isset($_POST["password"])&&!empty($_POST["password"])&&
   isset($_POST["password2"])&&!empty($_POST["password2"])&&
   $_POST["password"]==$_POST["password2"]&&
   isset($_POST["zonas"])&& count($_POST["zonas"]>0)
   ){
       extract($_POST);
       $result=crearCliente($username,$password,$zonas);
       $result[1] = "Usuario creado con éxito";
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
            <h2><strong>Dolphinder</strong></h2>
            
            <p><strong>Alta Nuevo Usuario</strong></p> 
            
            <form class="m-t" role="" action="<?=$_SERVER['PHP_SELF']?>" method="post"> 
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="a@b.com" required="">
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Contraseña" required="">
                </div>
                <div class="form-group">
                    <input name="password2" type="password" class="form-control" placeholder="Repetir Contraseña" required="">
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group col-xs-12">
                            <select name="zonas[]" multiple id="zonas" required>
        <!--                        <option value="0">Zonas</option>-->
                                <?php for($i=30;$i<count($suscripciones);$i++){ ?>
                                <option name="tipo_suscripcion" value="<?= $suscripciones[$i]["id"]?>">Tipo suscripcion: <?= $suscripciones[$i]["nombre"]." (Eventos: ".$suscripciones[$i]["max_eventos"]?>)</option>
                                <?php } ?>
                                <?php foreach($zonas as $zona){ ?>
                                    <option name="zona" value="<?= $zona["id"]?>"><?= $zona["zona"]?></option>
                                <?php } ?>
                            </select>
                        </div>        
                    </div>
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
