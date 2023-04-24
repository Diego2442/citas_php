
<?php 

include_once('../conexion.php');

    $cita=($_GET['cita']!='')?$_GET['cita']:'';
    $med_id=($_GET['med_id']!='')?$_GET['med_id']:'';
    $cita_id=($_GET['cita_id']!='')?$_GET['cita_id']:'';

    if($cita!='' && $med_id!=''){
        $sentencia=$conexion->prepare('INSERT INTO cita_medicamento(idcitamed,id_cita,id_medicamento) VALUES (null,:id_cita,:id_medicamento) ');

        $sentencia->bindParam(':id_cita',$cita);
        $sentencia->bindParam(':id_medicamento',$med_id);

        $sentencia->execute();
    }else{
        $sentencia =$conexion->prepare('DELETE FROM cita_medicamento where id_cita=:id_cita and id_medicamento=:id_medicamento ');

        $sentencia->bindParam(':id_cita',$cita_id);
        $sentencia->bindParam(':id_medicamento',$med_id);

        $sentencia->execute();
    }

?>