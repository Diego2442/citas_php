<?php 
    $url='http://localhost/prueba_usco/';

    session_start();
    
    if(!isset($_SESSION['admin_login'])){
      header('Location:'.$url);
    }
    
    ?>

    <?php include_once('../../Template/head.php'); ?>

    <?php include_once('../navbar.php') ?>

    <?php
    
    include_once('../../conexion.php');

    /* 
    SELECT  a.id AS nombre,
    b.jefefamilia AS jefefamilia 
    FROM    cliente AS a 
    INNER JOIN cliente AS b 
    ON a.id = b.id
    WHERE b.jefefamilia = 'algo'; */


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
     ');
     
    $sentencia->execute();
    $lista_citas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    /* print_r($lista_citas); */

    ?>
  
  <main>

  
  
    <div class="container">
      <div class="row">
        <div class="col-12 mt-4">
        <div class="card card-outline card-primary">
        <div class="card-header">
        <h3 class="card-title">Citas</h3>

        <a name="" id="" class="btn btn-success" href="crear.php" role="button">Agregar</a>          
        
        </div>
        <div class="card-body">

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
                  <th scope="col">Anotación de la Cancelación de Cita</th>
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
                  
                  <td>
                  <?php if($cita['id_estado'] == '1'){ ?>
                    <form action="cancelar.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $cita['idcita']; ?>">
                        <div class="row">
                          <div class="col-8">
                            
                              <input type="text"
                              class="form-control me-5 " name="anotacion" id="" aria-describedby="helpId" placeholder="" value="<?php echo $cita['anotacion'] ?>" >
                    
                          </div>
                          <div class="col-4">
                              <button type="submit" class="btn btn-outline-danger" name="btn_cancelar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-x" viewBox="0 0 16 16">
                              <path d="M6.146 7.146a.5.5 0 0 1 .708 0L8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 0 1 0-.708z"></path>
                              <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path>
                            </svg>
                              </button>
                          </div>
                        </div>
                    </form>
                    <?php }else{ ?>
                      <p><?php echo $cita['anotacion']; ?></p>
                    <?php } ?>
                  </td>
                  
                </tr>
                <?php } ?>
                
              </tbody>
            </table>
          </div>
          
          


        </div>
        </div>
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

  <?php include_once('../../Template/foot.php'); ?>
