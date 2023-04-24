
<?php 
    $url='http://localhost/prueba_usco/logout.php';

    session_start();
    
    if(!isset($_SESSION['user_paciente'])){
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
    $lista_citas = $sentencia->fetchAll(PDO::FETCH_ASSOC);


?>


<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>
<div class="container">
  <nav class="nav justify-content-left  ">
    <a class="nav-link " href="http://localhost/prueba_usco/logout.php" aria-current="page">Cerrar Sección</a>
    
  </nav>

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
                  <th scope="col">Reporte</th>
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
                  <td>
                  <?php if($cita['id_estado']==3){ ?>
                      <a href="pdf.php?id=<?php echo $id_cita ?>">PDF</a>
                  <?php } ?>
                  </td>
                  </td>
                  
                  <td><?php echo $cita['nombre_estado'] ?></td>
                  
                </tr>
                <?php } ?>
                
              </tbody>
            </table>
          </div>
          </div> 


  </main>