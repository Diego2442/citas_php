<?php 
    $url='http://localhost/prueba_usco/';

    session_start();
    
    if(!isset($_SESSION['admin_login'])){
      header('Location:'.$url);
    }
    
    ?>

<?php

include_once('../../conexion.php');

/* Sentencia de borrado */
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID'])?$_GET['txtID']:'');

    //borrar datos en la base de datos
    $sentencia=$conexion->prepare("DELETE FROM consultorios WHERE idcon=:idcon");
    $sentencia->bindParam(":idcon",$txtID);
    $sentencia->execute();

    $mensaje="Eliminación Exitosa";

    header('Location:index.php?mensaje='.$mensaje);
}
    /* fin de sentencia */



?>