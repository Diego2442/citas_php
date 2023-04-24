<?php 
    $url='http://localhost/prueba_usco/';

    session_start();
    
    if(!isset($_SESSION['user_medico'])){
      header('Location:'.$url);
    }
?>
<?php 

include_once('../Template/head.php'); 
include_once('../conexion.php');

//medicamentos
$sql=$conexion->prepare('SELECT * FROM medicamentos');
$sql->execute();
$lista_medicamentos=$sql->fetchAll(PDO::FETCH_ASSOC);

//Datos de la cita
$sentencia =$conexion->prepare(
    'SELECT citas.idcita, citas.id_estado, citas.diagnostico, citas.anotacion, citas.fecha_hora, consultorios.direccion, municipios.nombre_mun, p.documento, estados.nombre_estado, p.nombre_usuario, p.correo  
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
    ON m.id = citas.id_medico where idcita=:idcita
   ');
  
  $cita_id=$_GET['id'];

  $sentencia->bindParam(':idcita',$cita_id);
  $sentencia->execute();
  $cita = $sentencia->fetch(PDO::FETCH_LAZY);


?>
<?php include_once('./navbar.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="">
<div class="container mt-5 justify-content-center" >
<div class="card border-dark mb-3" style="max-width: 90%;">
  <div class="card-header">Cita </div>
  <div class="card-body text-dark">
    
    <form action="diagnostico.php" method="post">
    <input type="hidden" class="" name="id" readonly value="<?php echo $_GET['id'] ?>">
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                <label for="" class="form-label">Nombre</label>
                <input type="text"
                    class="form-control" name="" id="" aria-describedby="helpId" value="<?php echo $cita['nombre_usuario'] ?>" readonly>
                </div>
                <div class="mb-3">
                <label for="" class="form-label">Documento</label>
                <input type="text"
                    class="form-control" name="" id="" aria-describedby="helpId" value="<?php echo $cita['documento'] ?>">
                </div>
                <div class="mb-3">
                </div>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Correo Electronico</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" value="<?php echo $cita['correo'] ?>">
                </div>

                <label for="exampleFormControlInput1">Medicamentos a recetar</label><br>
                <?php foreach($lista_medicamentos as $medicamentos){ ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input js-switch" type="checkbox" id="" data-id="<?php echo $medicamentos['idmed'] ?>">
                    <label class="form-check-label" for=""><?php echo $medicamentos['nombre_medicamento'] ?></label>
                  </div>
                 <?php } ?> 
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Diagnostico</label>
                    <textarea class="form-control" name="diagnostico" id="exampleFormControlTextarea1" rows="5"></textarea>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-10">
            
            </div>
            <div class="col-2">
            <button type="submit" class="btn btn-primary">Guardar Diagnostico</button>
            </div>
        </div>
    </form>
  </div>
</div>
</div>
</div>

<?php  ?>

<script>

    $(document).ready(function() {
    $('.js-switch').change(function() {
        let cita = $(this).prop('checked') === true ? '<?php echo $_GET['id'] ?>' : '';
        let cita_id = '<?php echo $_GET['id'] ?>';
        let med_id = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'agregar_medicamento.php',
            data: {
                'cita': cita,
                'med_id': med_id,
                'cita_id': cita_id
            },
            success: function(data) {
                console.log(data.message);

                /* Swal.fire({
                position: 'top-end',
                icon: data.icon,
                title: '',
                showConfirmButton: false,
                timer: 800
                }) */

                if (data.icon == 'success'){
                toastr.success(data.message);
                }else if(data.icon =='error'){
                    toastr.error(data.message);
                }
          
            }
        });
    });
});
</script>

</body>
</html>


