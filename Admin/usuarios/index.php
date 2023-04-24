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

    //sentencia de los usuarios
    $sentencia =$conexion->prepare('SELECT * FROM usuarios INNER JOIN roles ON usuarios.rol_id = roles.idrol');
    $sentencia->execute();
    $lista_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $hoy=new DateTime(date('Y-m-d'));


    //sentencia listar roles
    $sentencia =$conexion->prepare('SELECT * FROM roles');
    $sentencia->execute();
    $lista_roles = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    
    ?>

  <main>

  
  
    <div class="container">
      <div class="row">
        <div class="col-12">
        <div class="card card-outline card-primary">
        <div class="card-header">
        <h3 class="card-title">Usuarios</h3>


        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Agregar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <form action="crear.php" method="post">
                  
                    <label for="" class="form-label">Name</label>
                    <input type="text"
                      class="form-control" name="nombre" id="" aria-describedby="helpId" placeholder="" required>

                      <label for="" class="form-label">Correo</label>
                    <input type="email"
                      class="form-control" name="correo" id="" aria-describedby="helpId" placeholder="" required>

                      <label for="" class="form-label">N. Documento</label>
                    <input type="number"
                      class="form-control" name="documento" id="" aria-describedby="helpId" placeholder="" required>

                      <label for="" class="form-label">Dirección</label>
                    <input type="text"
                      class="form-control" name="direccion" id="" aria-describedby="helpId" placeholder="" required>

                      <label for="" class="form-label">Telefono</label>
                    <input type="number"
                      class="form-control" name="telefono" id="" aria-describedby="helpId" placeholder="" max="9999999999" required>

                      <label for="" class="form-label">Fecha Nacimiento</label>
                    <input type="Date"
                      class="form-control" name="fecha_nacimiento" id="" aria-describedby="helpId" placeholder="" required>

                      <label for="" class="form-label">Rol</label>
                    <select name="rol" id="" class="form-control" required>
                    <?php foreach($lista_roles as $rol){ ?>
                      <option value="<?php echo $rol['idrol'];?>">
                        <?php echo $rol['name'];?>
                      </option>
                    <?php } ?>
                    </select>

                    <label for="" class="form-label">Contraseña</label>
                    <input type="password"
                      class="form-control" name="password" id="" aria-describedby="helpId" placeholder="" required>
                    
                    <button type="submit" class="btn mt-3 btn-primary">Agregar</button>
                  
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                
              </div>
            </div>
          </div>
        </div>
          
        
        </div>
        <div class="card-body">

          <div class="table-responsive">
            <table class="table" id="myTable">
              <thead class="bg-primary text-light">
                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Correo</th>
                  <th scope="col">N. Documento</th>
                  <th scope="col">Dirección</th>
                  <th scope="col">Telefono</th>
                  <th scope="col">Edad</th>
                  <th scope="col">Rol</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($lista_usuarios as $usuario){ ?>

                <tr class="">
                  <td scope="row"><?php echo $usuario['nombre_usuario']?></td>
                  <td><?php echo $usuario['correo']?></td>
                  <td><?php echo $usuario['documento']?></td>
                  <td><?php echo $usuario['direccion']?></td>
                  <td><?php echo $usuario['telefono']?></td>
                  <td><?php 
                      $nacimiento=new DateTime($usuario['fecha_nacimiento']);
                      $anios=date_diff($nacimiento,$hoy);

                      echo $anios->y;
                  ?>
                  </td>
                  <td><?php echo $usuario['name']?></td>
                  <td>

                    <a name="" id="" class="btn btn-warning" href="./editar.php?txtID=<?php echo $usuario['id'] ?>" role="button">Editar</a>
                    <a name="" id="" class="btn btn-danger" href="javascript:borrar(<?php echo $usuario['id'] ?>)" role="button">Eliminar</a>


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
        icon: '<?php echo $_GET['icon'] ?>',
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

<script>
  function borrar(id){
    Swal.fire({
  title: 'Esta seguro de eliminar?',
  text: "No puede volver a atras!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si!'
  }).then((result) => {
  if (result.isConfirmed) {
    window.location="./eliminar.php?txtID="+id;
  }
})
  }
  </script>

  


  <?php include_once('../../Template/foot.php'); ?>