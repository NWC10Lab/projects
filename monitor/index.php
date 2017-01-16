<?php
$mng="";
if(isset($_POST['email'])&&$_POST['password']&&!empty($_POST['email'])&&!empty($_POST['password'])){
    include 'inc/seguridad.php';
    extract($_POST); 
    $login = comprobarUser($email,$password);
    if($login[0]){
        crearSession($login[1]['nombre'],$login[1]['id'],$login[1]['max_eventos']);
        header("location:home.php");
        //iniciar sesion
        //redirigir
        $mng= "BIEN!!";
        header("Location:home.php");
    }else{
        $mng= "Datos incorrectos";
    }
}
?>
<!DOCTYPE html>
<html>
<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6.2.1/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Dec 2016 13:55:43 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>EVENTS | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">  
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name "><img src="img/logo_cnw.png" style="max-width: 300px;"></h1>
            </div>
            <h3>Bienvenido a NWC10 EVENTS</h3>
            <p>Logueate para iniciar nuestro servicio de eventos    
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>          
            <form class="m-t" role="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <div class="form-group">
                    <input name="email" type="email" class="form-control" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Contraseña" required="">
                </div>
                <input type="submit" class="btn btn-primary block full-width m-b" value="Login" name="formlog">
                
                <p class="text-center text-danger"><?= $mng ?></p>
                <a href="#"><small>¿Olvidaste tu contraseña?</small></a>
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
