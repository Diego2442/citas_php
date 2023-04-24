<?php 
    $url='http://localhost/prueba_usco/';

    session_start();
    
    if(!isset($_SESSION['admin_login'])){
      header('Location:'.$url);
    }
    
    ?>

<?php

include_once('../../conexion.php');

//sentencia medicos
$sentencia =$conexion->prepare('SELECT * 
                                FROM usuarios
                                WHERE rol_id=2');  
$sentencia->execute();
$lista_medicos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

//sentencia usuarios 
$sentencia =$conexion->prepare('SELECT * 
                                FROM usuarios
                                ');  
$sentencia->execute();
$lista_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

//sentencia Consultorios
$sentencia =$conexion->prepare('SELECT * 
                                FROM consultorios
                                INNER JOIN municipios
                                ON municipios.idmun = consultorios.id_mun 
                                INNER JOIN departamentos
                                ON municipios.id_dept = departamentos.iddept 
                                ');  
$sentencia->execute();
$lista_consultorios = $sentencia->fetchAll(PDO::FETCH_ASSOC);


?>


<?php 

    ///Guardar los datos del formulario

    if($_POST){

        

        $fecha=(isset($_POST['fecha'])?$_POST['fecha']:'');
        $consultorio=(isset($_POST['consultorio'])?$_POST['consultorio']:'');
        $paciente=(isset($_POST['paciente'])?$_POST['paciente']:'');
        $medico=(isset($_POST['medico'])?$_POST['medico']:'');

        $fecha_hora=date('Y-m-d H:i:s',strtotime($fecha));//convierte el datetime a formato legible en la bd

        //sentencia verificar que el medico ne se haya asignado al mismo horario
        $sentencia=$conexion->prepare('SELECT * FROM citas WHERE id_medico=:medico and fecha_hora=:fecha_hora AND id_estado=1');

        $sentencia->bindParam(':medico',$medico);
        $sentencia->bindParam(':fecha_hora',$fecha_hora);

        $sentencia->execute();

        //sentencia verificar que el usuario no se haya asignado al mismo horario
        $sentencia2=$conexion->prepare('SELECT * FROM citas WHERE id_paciente=:paciente and fecha_hora=:fecha_hora AND id_estado=1');

        $sentencia2->bindParam(':paciente',$paciente);
        $sentencia2->bindParam(':fecha_hora',$fecha_hora);

        $sentencia2->execute();


        if($sentencia->rowCount() == 0 && $sentencia2->rowCount() == 0){

            //sentencia insertar datos en la base de datos
            
            $sql=$conexion->prepare('INSERT INTO citas(idcita,fecha_hora,id_consultorio,id_paciente,id_medico,id_estado)
                                            VALUES (null,:fecha,:consultorio,:paciente,:medico,1)');
            
            $sql->bindParam(':fecha',$fecha_hora);
            $sql->bindParam(':consultorio',$consultorio);
            $sql->bindParam(':paciente',$paciente);
            $sql->bindParam(':medico',$medico);


            if($sql->execute()){
                $mensaje = "Asignado con éxito";
                header('Location:index.php?mensaje='.$mensaje);
            }else{
                $mensaje = "Error al asignar";
                header('Location:index.php?mensaje='.$mensaje);
            }

        }elseif($sentencia2->rowCount() > 0){
            $mensaje = "El paciente  ya esta asignado en este horario";
            header('Location:crear.php?mensaje='.$mensaje);
        }elseif($sentencia->rowCount() > 0){
            $mensaje = "El medico  ya esta asignado en este horario";
            header('Location:crear.php?mensaje='.$mensaje);
        }
    }

?>

<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  
  <main>

        <div class="container mb-4">
            <div class="row">
                <div class="col-sm-10 p-5 ">
                    <div class="card border-primary">
                    
                    <div class="card-body">
                        <h4 class="card-title">Asignar Cita</h4>
                        <form action="" method="post">
                            <div class="mb-3">
                              <label for="" class="form-label">Fecha y Hora</label>
                              <input type="datetime-local" step="1800"
                                class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="">
                            </div>
                            <div class="mb-3">
                              <label for="" class="form-label">Consultorio</label>
                              <select name="consultorio" id="" class="form-control">
                                <?php foreach($lista_consultorios as $consultorio){ ?>
                                    <option value="<?php echo $consultorio['idcon'] ?>"><?php echo $consultorio['direccion']." - ".$consultorio['nombre_dept']."/".$consultorio['nombre_mun'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label for="" class="form-label">Pacientes</label>
                              <select name="paciente" id="" class="form-control">
                                <?php foreach($lista_usuarios as $usuario){ ?>
                                    <option value="<?php echo $usuario['id'] ?>"><?php echo $usuario['nombre_usuario']." doc.".$usuario['documento'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label for="" class="form-label">Medicos</label>
                              <select name="medico" id="" class="form-control">
                                <?php foreach($lista_medicos as $medico){ ?>
                                    <option value="<?php echo $medico['id'] ?>"><?php echo $medico['nombre_usuario'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="mb-3">
                              
                              <input type="submit"
                                class=" btn btn-outline-primary" name="" id="" value="Asignar" aria-describedby="helpId" placeholder="">
                              
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>

  </main>
  
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>




