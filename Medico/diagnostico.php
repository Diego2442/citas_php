<?php  

include_once('../conexion.php');

if($_POST){
    $id=$_POST['id'];
    $diagnostico=(isset($_POST['diagnostico'])?$_POST['diagnostico']:'');

    /* print_r($diagnostico); */
    $sentencia=$conexion->prepare('UPDATE citas SET diagnostico=:diagnostico,id_estado=3 where idcita=:idcita');

    $sentencia->bindParam(':diagnostico',$diagnostico);
    $sentencia->bindParam(':idcita',$id);

    if($sentencia->execute()){
        $mensaje="Guardado con exito";
        header('Location:index.php?mensaje='.$mensaje);
    }else{
        $mensaje="Error al guardar";
        header('Location:index.php?mensaje='.$mensaje);
    }

}

?>