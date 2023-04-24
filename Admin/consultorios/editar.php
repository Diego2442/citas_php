<?php 
    $url='http://localhost/prueba_usco/';

    session_start();
    
    if(!isset($_SESSION['admin_login'])){
      header('Location:'.$url);
    }
    
    ?>

<?php 

if($_GET['txtID']){

    include_once('../../conexion.php');
    $id=$_GET['txtID'];
    //sentencia listar municipios
    $sentencia =$conexion->prepare('SELECT * FROM municipios');
    $sentencia->execute();
    $lista_municipios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    
    //sentencia para buscar el consultorio
    $sql=$conexion->prepare("SELECT * FROM consultorios WHERE idcon=:idcon");
        $sql->bindParam(":idcon",$id);
        $sql->execute();
        $consultorio=$sql->fetch(PDO::FETCH_LAZY);

}

if($_POST){

    //Post para actualizar los datos
    
    $id=(isset($_POST['id'])?$_POST['id']:'');
    $direccion=(isset($_POST['direccion'])?$_POST['direccion']:'');
    $municipio=(isset($_POST['municipio'])?$_POST['municipio']:'');
    

    $sentencia = $conexion->prepare('UPDATE consultorios SET direccion=:direccion,id_mun=:id_mun where idcon=:id');

    $sentencia->bindParam(':id',$id);
    
    $sentencia->bindParam(':direccion',$direccion);
    $sentencia->bindParam(':id_mun',$municipio); 
    

    
    if($sentencia->execute()){
        header('Location:index.php?mensaje=Se guardó con éxito');
    }
    else{
        header('Location:index.php?error=Ocurrió un error al guardar');
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

    <div class="container">
        <div class="card mt-3">
            <div class="card-header">
                Editar Consultorios
            </div>
            <div class="card-body ">
            <form action="" method="post">
                              
                            <label for="" class="form-label">Id</label>
                              <input type="text"
                                class="form-control" name="id" id="" aria-describedby="helpId" placeholder="" value="<?php echo $consultorio['idcon']?>" readonly >

                              <label for="" class="form-label">Municipios</label>
                                <select name="municipio" id="" class="form-control" >
                                  <?php foreach($lista_municipios as $municipio){ ?>

                                    <?php if($consultorio['id_mun'] == $municipio['idmun']){ ?>
                                    <option value="<?php echo $municipio['idmun'];?>" selected>
                                      <?php echo $municipio['nombre_mun'];?>
                                    </option>
                                    <?php }else{ ?>
                                    <option value="<?php echo $municipio['idmun'];?>" >
                                      <?php echo $municipio['nombre_mun'];?>
                                    </option>

                                  <?php } } ?>
                                </select>

                              <label for="" class="form-label">Dirección</label>
                              <input type="text"
                                class="form-control" name="direccion" id="" aria-describedby="helpId" placeholder="" value="<?php echo $consultorio['direccion']?>" >
                              
                              <button type="submit" class="btn mt-3 btn-warning">Editar</button>
                            
                          </form>
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