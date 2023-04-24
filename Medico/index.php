<?php 
    $url='http://localhost/prueba_usco/';

    session_start();
    
    if(!isset($_SESSION['user_medico'])){
      header('Location:'.$url);
    }
    
    ?>
 <?php /*  sort($arreglo, SORT_STRING);  */ 
 
 $dia=date('N');
 $hoy=date('Y-m-d');
 $dias=['','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'];
 
 ?> 

<?php 

include_once('../Template/head.php'); 
include_once('../conexion.php');

    //sentencia trae los datos del medico
    $sentencia = $conexion->prepare('SELECT * FROM usuarios where correo=:correo');
    $correo=$_SESSION['user_medico'];

    $sentencia->bindParam(':correo',$correo);
    $sentencia->execute();
    $medico= $sentencia->fetch(PDO::FETCH_LAZY);
    $medico_id=$medico['id'];

    //sentencia citas relacionadas con el medico
    $sql= $conexion->prepare('SELECT * FROM citas where id_medico=:id_medico');

    $sql->bindParam(':id_medico',$medico_id);
    $sql->execute();
    $lista_citas=$sql->fetchAll(PDO::FETCH_ASSOC);


?>

    <?php include_once('./navbar.php') ?>

  <main>

    <div class="jumbotron jumbotron-fluid">
      <div class="container div-imagen-fondo">
        <h1 class="display-3">Medico <?php echo $medico['nombre_usuario'] ?></h1>
        <p class="lead">Aqui encontrarás la agenda del día de hoy</p>
        <hr class="my-2">
        <div class="row">
          <div class="col-2">
          
          <div class="card border-light" style="width: 10rem;">
            <div class="card-header">
              Citas<br> <?php $hora = date('d-m-Y'); echo $dias[$dia].' '.$hora; ?>
            </div>
            <ul class="list-group list-group-flush">
              <?php foreach($lista_citas as $citas){  $fecha_cita=date('Y-m-d',strtotime($citas['fecha_hora']));?>
                <?php if($hoy == $fecha_cita){ ?>
                  <?php if($citas['id_estado']==3){ ?>
                    <li class="list-group-item">
                      <input type="hidden" name="id" id="id" value="<?php echo $citas['idcita'] ?>">
                      <?php echo $citas['fecha_hora'] ?>
                      <a class="btn btn-outline-success " id="btn_enviar"  type="button" >Efectuada</a>
                    </li>
                  <?php }else{ ?>
                    <li class="list-group-item">
                      <input type="hidden" name="id" id="id" value="<?php echo $citas['idcita'] ?>">
                      <?php echo $citas['fecha_hora'] ?>
                      <a class="btn btn-outline-info " id="btn_enviar" href="cita.php?id=<?php echo $citas['idcita'] ?>" type="button">Tomar</a>
                    </li>

                  <?php } ?>
              <?php } ?>
              <?php } ?>
              
            </ul>
          </div>

          </div>
          <di class="col-10">
              <div class="m5" id="cita">
                <div class="card border-dark mb-3" style="max-width: 100%;">
                <div class="card-header">Historial de Citas</div>
                <div class="card-body text-dark">

           

                      <?php   
                          
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
      WHERE id_medico=:id_medico
     ');
     
    $sentencia->bindParam(':id_medico',$medico_id);
    $sentencia->execute();
    $lista_citas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    /* print_r($lista_citas); */

    ?>
  
  <main>

  
  
    

          <div class="table-responsive">
            <table class="table table-primary" id="myTable">
              <thead>
                <tr>
                  <th scope="col"># Cita</th>
                  <th scope="col">Fecha y Hora</th>
                  <th scope="col">Municipio</th>
                  <th scope="col">Dirección Consultorio</th>
                  <th scope="col">Medico</th>
                  <th scope="col">Nombre Paciente</th>
                  <th scope="col">Documento Paciente</th>
                  <th scope="col">diagnostico</th>
                  <th scope="col">Medicamento</th>
                  <th scope="col">Estado</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php foreach($lista_citas as $cita){ ?>
                <tr class="">
                  <td scope="row"><?php echo $cita['idcita'] ?></td>
                  <td><?php echo $cita['fecha_hora'] ?></td>
                  <td><?php echo $cita['nombre_mun'] ?></td>
                  <td><?php echo $cita['direccion'] ?></td>
                  <td><?php echo $cita['nombre_usuario'] ?></td>
                  <td>
                      <?php

                        $documento=$cita['documento'];
                        //sentencia listar departamentos
                        $sentencia =$conexion->prepare('SELECT nombre_usuario 
                                                        FROM usuarios
                                                        WHERE documento=:documento');

                        $sentencia->bindParam(':documento',$documento);
                        $sentencia->execute();
                        $paciente = $sentencia->fetch(PDO::FETCH_LAZY);

                        echo $paciente['nombre_usuario'];
                      ?>

                  </td>
                  <td><?php echo $cita['documento'] ?></td>
                  <td><?php echo $cita['diagnostico'] ?></td>
                  <td>
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
                  </td>
                  <td><?php echo $cita['nombre_estado'] ?></td>
                  
                </tr>
                <?php } ?>
                
              </tbody>
            </table>
          </div>
          
          


        


                  
                </div>
              </div>
              </div>
          </di>
        </div>
      </div>
    </div>

  </main>

  <?php 
    if($_GET['mensaje']){
      ?>
      <script>
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: '<?php echo $_GET['mensaje'] ?>',
        showConfirmButton: false,
        timer: 1500
      })
      </script>
      <?php
    }
  ?>
  
  <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
  </script>


<!-- <style>
    .div-imagen-fondo {
        background-image: url('https://static.vecteezy.com/system/resources/previews/007/286/985/original/seamless-pattern-with-icons-on-the-theme-of-medicine-doodle-with-medicine-icons-on-black-background-vintage-medicine-icons-vector.jpg');
            }
</style> -->


  <?php include_once('../Template/foot.php'); ?>