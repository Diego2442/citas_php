<?php 
    $url='http://localhost/prueba_usco/';

    session_start();
    
    if(!isset($_SESSION['admin_login'])){
      header('Location:'.$url);
    }
    include_once('../../conexion.php');
    include_once('../../Template/head.php');
    ?>

<!-- Sección para recibir los datos del form y crear consultorio -->
<?php 
if(isset($_POST['direccion'])){


    $municipio=$_POST['municipio'];
    $direccion=$_POST['direccion'];
    
    $sentencia=$conexion->prepare('INSERT INTO consultorios(idcon,direccion,id_mun) VALUES (null,:direccion,:id_mun)');

    $sentencia->bindParam(':direccion',$direccion);
    $sentencia->bindParam(':id_mun',$municipio);

    

    if($sentencia->execute()){
      $mensaje="Guradado con éxito";
      /* print_r($mensaje); */
      header('Location:./index.php?mensaje='.$mensaje.'&icon=success');
    }else{
      $mensaje="Error al guardar";
      /* print_r($mensaje); */
      header('Location:./index.php?mensaje='.$mensaje);
    }
  }

?>
<!-- fin del post del formulario -->

<?php if($_POST['departamento']){  
  

  $departamento = (isset($_POST['departamento'])?$_POST['departamento']:'');

    $sql=$conexion->prepare('SELECT idmun, nombre_mun, estado, id_dept FROM municipios WHERE id_dept=:id_dept');

    $sql->bindParam(':id_dept',$departamento);

    $sql->execute();

    $lista_municipios=$sql->fetchAll(PDO::FETCH_ASSOC);
  
?>

  <form action="crear.php" method="post">

    <label for="" class="form-label">Municipios</label>
    <select class="form-select form-select-lg select2" name="municipio" id="municipio">
        <?php foreach($lista_municipios as $municipio){ ?>        
          <option selected value="<?php echo $municipio['idmun'] ?>"><?php echo $municipio['nombre_mun'] ?></option>
        <?php } ?>
        
    </select>
    </div>

    <div class="mb-3">
    <label for="" class="form-label">Dirección</label>
    <input type="text"
      class="form-control" name="direccion" id="" aria-describedby="helpId" placeholder="" required>
    </div>
    <div class="mb-3">

    <div class="mb-3">
      
      <input type="submit"
        class=" btn btn-success" name="" id="" aria-describedby="helpId" placeholder="" value="Crear">
    </div>


  </form>


<?php }?>

<script>
  
$(document).ready(function() {
    $('.select2').select2();
});
</script>