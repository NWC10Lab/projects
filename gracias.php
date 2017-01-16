<?php  
//validaciones formulario
$valido=true;
if( isset($_POST['nombre'])&&!empty($_POST['nombre'])&&
    isset($_POST['apellidos'])&&!empty($_POST['apellidos'])&&
    isset($_POST['DNI'])&&!empty($_POST['DNI'])&&
    isset($_POST['telefono'])&&!empty($_POST['telefono'])&&
    isset($_POST['email'])&&!empty($_POST['email'])&&
    isset($_POST['importe'])&&!empty($_POST['importe'])&&
    isset($_POST['cliente'])&&($_POST['cliente']=="1"||$_POST['cliente']=="0")&&
    isset($_POST['acepto'])&&!empty($_POST['acepto'])

    ){
        //extract($_POST);
    //pruebas    
        //$email=" a@b.com ";
        //$telefono="679680205 ";
        //$DNI="02717117n ";
                
        $email=trim($email);
        $telefono=trim($telefono);
        $DNI=trim($DNI);
        echo "-$email-$telefono-$DNI-<br>";
        //validar email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)||strrpos($email,"yopmail")) {
            echo "email mal";
            $valido=false;
        }else{echo "email bien";}
        //validar teléfono
        if(!filter_var($telefono, FILTER_VALIDATE_INT)||strlen($telefono)!=9){
            echo "numero mal";
            $valido=false;
        }else{echo "numero bien";}
        //validar DNI
        $patron="/([0-9]{1,8})([T,R,W,A,G,M,Y,F,P,D,X,B,N,J,Z,S,Q,V,H,L,C,K,E]{1})/i";
        $val=preg_match($patron,$DNI);
        if($val==0||$val==NULL){
            echo "dni mal";
            $valido=false;
        }else{echo "dni bien";}
}else{
    $valido=false;
    echo "Formulario incorrecto!!!";
}

if(!$valido){
    //header('location:index.html');
}
     
    



?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!---eliminar esto-->
<?php if(false){ ?>   
<?php if($cliente=="1"){ echo "soy cliente";?>
        <!-- Google Code for TAG LEAD HIPOTECA CLIENTE Conversion Page -->
        <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 970006428;
        var google_conversion_language = "en";
        var google_conversion_format = "3";
        var google_conversion_color = "ffffff";
        var google_conversion_label = "DP80CNKx3mwQnL_EzgM";
        var google_remarketing_only = false;
        /* ]]> */
        </script>
        <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
        <noscript>
            <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/970006428/?label=DP80CNKx3mwQnL_EzgM&amp;guid=ON&amp;script=0"/>
            </div>
        </noscript>
        
<?php }else{ echo "NO soy cliente";?>
        <!-- Google Code for TAG LEAD HIPOTECA NO CLIENTE Conversion Page -->
        <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 970006428;
        var google_conversion_language = "en";
        var google_conversion_format = "3";
        var google_conversion_color = "ffffff";
        var google_conversion_label = "i2egCJ-x3mwQnL_EzgM";
        var google_remarketing_only = false;
        /* ]]> */
        </script>
        <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
        <noscript>
            <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/970006428/?label=i2egCJ-x3mwQnL_EzgM&amp;guid=ON&amp;script=0"/>
            </div>
        </noscript>
<?php }} ?>
        
    </head>
    <!--
    Variaciones:
    CLIENTE->
    -->
    <body>
        
    </body>
</html>
