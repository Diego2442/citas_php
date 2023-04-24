<?php 
    $url='http://localhost/prueba_usco/';

    session_start();
    
    if(!isset($_SESSION['admin_login'])){
      header('Location:'.$url);
    }
    
    ?>

<?php
    
    include_once('../../conexion.php');

    if($_POST['anotacion']){

        $id=(isset($_POST['id'])?$_POST['id']:'');
        $anotacion=(isset($_POST['anotacion'])?$_POST['anotacion']:'');

        $sentencia=$conexion->prepare('UPDATE citas SET anotacion=:anotacion,id_estado=2 where idcita=:id');

        $sentencia->bindParam(':id',$id);   
        $sentencia->bindParam(':anotacion',$anotacion);

        if($sentencia->execute()){

            $mensaje = "Cancelación Exitosa";
            header('Location:index.php?mensaje='.$mensaje);
        }else{
            $mensaje = "No se pudo cancelar";
            header('Location:index.php?mensaje='.$mensaje);
        }


    }else{
        $mensaje = "Ingrese la anotación";
            header('Location:index.php?mensaje='.$mensaje);
    }


?>

