<?php

include_once('../conexion.php');

    session_start();

    //sentencia trae los datos del medico
    $sentencia = $conexion->prepare('SELECT * FROM usuarios where correo=:correo');
    $correo=$_SESSION['user_paciente'];

    $sentencia->bindParam(':correo',$correo);
    $sentencia->execute();
    $paciente= $sentencia->fetch(PDO::FETCH_LAZY);
    $paciente_id=$paciente['id'];

    //sentencia citas relacionadas con el medico
    $sql= $conexion->prepare('SELECT * FROM citas where id_paciente=:id_paciente');

    $sql->bindParam(':id_paciente',$paciente_id);
    $sql->execute();
    $lista_citas=$sql->fetchAll(PDO::FETCH_ASSOC);


    //sentencia listar departamentos
    $sentencia =$conexion->prepare(
      'SELECT citas.idcita, citas.id_estado, citas.diagnostico, citas.anotacion, citas.fecha_hora, consultorios.direccion, municipios.nombre_mun, p.documento, estados.nombre_estado, m.nombre_usuario  
      FROM citas
      INNER JOIN consultorios 
      ON citas.id_consultorio = consultorios.idcon
      INNER JOIN municipios 
      ON consultorios.id_mun = municipios.idmun
      INNER JOIN usuarios as p
      ON p.id = citas.id_paciente
      INNER JOIN estados
      ON estados.idestado = citas.id_estado
      INNER JOIN usuarios as m
      ON m.id = citas.id_medico
      where id_paciente = :id_paciente
     ');
     
    $sentencia->bindParam(':id_paciente',$paciente_id); 
    $sentencia->execute();
    $cita = $sentencia->fetch(PDO::FETCH_LAZY);

?>

<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

    <h2>Diagnotico Clinico</h2>

    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
         
          <p class="col-md-8 fs-4">El usuarios <?php echo $cita['nombre_usuario'] ?> identificado con documento de identidad N. <?php echo $cita['documento'] ?> asistió con cita prevista el dia y hora <?php echo $cita['fecha_hora'] ?> en el cuál obtiene el siguiente diagnostico .</p>
          <br>
          <h3>Diagnostico:</h3>
          <?php 
          
          echo "<label>".$cita['diagnostico']."</label><br>";

          ?>
          <div class="container">
          <h3>Medicamentos Recetados:</h3>

          <?php
                      $id_cita=$cita['idcita'];
                      //sentencia listar departamentos
                      $sentencia =$conexion->prepare('SELECT medicamentos.nombre_medicamento 
                                                      FROM cita_medicamento
                                                      INNER JOIN medicamentos
                                                      ON medicamentos.idmed=cita_medicamento.id_medicamento
                                                      WHERE id_cita=:id_cita');
                      
                      $sentencia->bindParam(':id_cita',$id_cita);
                      $sentencia->execute();
                      $lista_medicamentos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

                      foreach($lista_medicamentos as $medicamento){
                        echo $medicamento['nombre_medicamento']."<br>";
                      }
                    ?>
            </div>
         <br><br>
          <label for="" class="">Medico a cargo de la consulta:</label><br>
          <strong><?php echo $cita['nombre_usuario'] ?></strong>
        </div>
      </div>

      <br><br><br><br><br><br><br><br>
      <img src="https://upload.wikimedia.org/wikipedia/commons/f/f8/Firma_Len%C3%ADn_Moreno_Garc%C3%A9s.png" alt="" style="height:20%; width:25%"><br>
      _______________________________ <br>
      Firma Gerente

      <footer>
        <br><br><br><br><br><br><br>
      <small>Certificado expedido con fecha: <?php echo date('Y-m-d H:m:i') ?></small>
        <?php echo $cita['idcita'] ?>
        <?php echo $cita['fecha_hora'] ?>
        <?php echo $cita['nombre_mun'] ?>
        <?php echo $cita['direccion'] ?>
      </footer>
                  

                   

</body>
</html>

<?php

$HTML = ob_get_clean();

require_once("../public/dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf= new Dompdf();

$opciones=$dompdf->getOptions();
$opciones->set(array("isRemoteEnabled"=>true));

$dompdf->setOptions($opciones);

$dompdf->loadHTML($HTML);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf",array("Attachment"=>false));
?>

<style>
html {
  min-height: 100%;
  position: relative;
}
body {
  margin: 0;
  margin-bottom: 40px;
}
footer {
  background-color: black;
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 40px;
  color: white;
}
</style>