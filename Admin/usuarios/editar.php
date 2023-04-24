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
    //sentencia listar roles
    $sentencia =$conexion->prepare('SELECT * FROM roles');
    $sentencia->execute();
    $lista_roles = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    
    //sentencia para buscar el usuario
    $sql=$conexion->prepare("SELECT * FROM usuarios WHERE id=:id");
        $sql->bindParam(":id",$id);
        $sql->execute();
        $usuario=$sql->fetch(PDO::FETCH_LAZY);

}

if($_POST){

    //Post para actualizar los datos
    
    /* $nombre=(isset($_POST['nombre'])?$_POST['nombre']:'');
    $correo=(isset($_POST['correo'])?$_POST['correo']:'');
    $documento=(isset($_POST['documento'])?$_POST['documento']:''); */
    $direccion=(isset($_POST['direccion'])?$_POST['direccion']:'');
    $telefono=(isset($_POST['telefono'])?$_POST['telefono']:'');
    /* $fecha_nacimiento=(isset($_POST['fecha_nacimiento'])?$_POST['fecha_nacimiento']:'');
    $rol=(isset($_POST['rol'])?$_POST['rol']:'');
    $password=(isset($_POST['password'])?$_POST['password']:''); */

    $sentencia = $conexion->prepare('UPDATE usuarios SET /* nombre_usuario=:nombre_usuario,correo=:correo,password=:password,documento=:documento,fecha_nacimiento=:fecha_nacimiento,rol_id=:rol_id, */direccion=:direccion,telefono=:telefono where id=:id');

    $sentencia->bindParam(':id',$id);
    /* $sentencia->bindParam(':nombre_usuario',$nombre);
    $sentencia->bindParam(':correo',$correo);
    $sentencia->bindParam(':documento',$documento);*/
    $sentencia->bindParam(':direccion',$direccion);
    $sentencia->bindParam(':telefono',$telefono); 
    /* $sentencia->bindParam(':fecha_nacimiento',$fecha_nacimiento);
    $sentencia->bindParam(':rol_id',$rol);
    /* $sentencia->bindParam(':password',$password); */

    
    if($sentencia->execute()){
        header('Location:index.php?mensaje=Se Actualizó con éxito&icon=success');
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
                Editar Usuarios
            </div>
            <div class="card-body ">
            <form action="" method="post">
                              
                              <label for="" class="form-label">Name</label>
                              <input type="text"
                                class="form-control" name="nombre" id="" aria-describedby="helpId" placeholder="" value="<?php echo $usuario['nombre_usuario']?>" readonly>

                                <label for="" class="form-label">Correo</label>
                              <input type="email"
                                class="form-control" name="correo" id="" aria-describedby="helpId" placeholder=""value="<?php echo $usuario['correo']?>" readonly>

                                <label for="" class="form-label">N. Documento</label>
                              <input type="number"
                                class="form-control" name="documento" id="" aria-describedby="helpId" placeholder="" value="<?php echo $usuario['documento']?>" readonly>

                                <label for="" class="form-label">Dirección</label>
                              <input type="text"
                                class="form-control" name="direccion" id="" aria-describedby="helpId" placeholder="" value="<?php echo $usuario['direccion']?>" required>

                                <label for="" class="form-label">Telefono</label>
                              <input type="number"
                                class="form-control" name="telefono" id="" aria-describedby="helpId" placeholder="" value="<?php echo $usuario['telefono']?>" required>

                                <label for="" class="form-label">Fecha Nacimiento</label>
                              <input type="Date"
                                class="form-control" name="fecha_nacimiento" id="" aria-describedby="helpId" placeholder="" value="<?php echo $usuario['fecha_nacimiento']?>" readonly>

                              <label for="" class="form-label">Rol</label>
                                <select name="rol" id="" class="form-control" Disabled>
                                  <?php foreach($lista_roles as $rol){ ?>

                                    <?php if($rol['idrol'] == $usuario['rol_id']){ ?>
                                    <option value="<?php echo $rol['idrol'];?>" selected>
                                      <?php echo $rol['name'];?>
                                    </option>
                                    <?php }else{ ?>
                                    <option value="<?php echo $rol['idrol'];?>" >
                                      <?php echo $rol['name'];?>
                                    </option>

                                  <?php } } ?>
                                </select>

                              <label for="" class="form-label">Contraseña</label>
                              <input type="password"
                                class="form-control" name="password" id="" aria-describedby="helpId" placeholder="" value="<?php echo $usuario['password']?>" readonly>
                              
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