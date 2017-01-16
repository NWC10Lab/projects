<?php
include './inc/funciones.php';


if(
   isset($_POST['anuncio'])&&!empty($_POST['anuncio'])&&
   isset($_POST['anuncio'])&&!empty($_POST['anuncio'])&&
   isset($_POST['anuncio'])&&!empty($_POST['anuncio'])&&
   isset($_POST['anuncio'])&&!empty($_POST['anuncio'])&&
   isset($_POST['anuncio'])&&!empty($_POST['anuncio'])&&
   isset($_POST['anuncio'])&&!empty($_POST['anuncio'])&&
   isset($_POST['anuncio'])&&!empty($_POST['anuncio'])&&
   isset($_POST['anuncio'])&&!empty($_POST['anuncio'])&&
   isset($_POST['anuncio'])&&
   isset($_POST['metros'])&&
   isset($_POST['anuncio'])&&!empty($_POST['anuncio'])
   ){
  extract($_POST);
  if(newAnuncio($anuncio,$prop,$tel,$empresa,$dni,$idioma)){//poner todos los campos
      //enviar mail
      
      
      
  }
}





?>