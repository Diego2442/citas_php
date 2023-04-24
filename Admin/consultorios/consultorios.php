<?php 
    $url='http://localhost/prueba_usco/';

    session_start();
    
    if(!isset($_SESSION['admin_login'])){
      header('Location:'.$url);
    }
    
    ?>

<?php   
    include_once('../../Template/head.php');
    include_once('../../conexion.php');


    $municipio = $_POST['municipio'];

    $sql=$conexion->prepare(
        'SELECT consultorios.idcon, consultorios.direccion, municipios.nombre_mun, departamentos.nombre_dept 
        FROM consultorios 
        INNER JOIN municipios 
        ON consultorios.id_mun = municipios.idmun 
        INNER JOIN departamentos 
        ON municipios.id_dept = departamentos.iddept 
        WHERE id_mun=:id_mun');

    $sql->bindParam(':id_mun',$municipio);

    $sql->execute();

    $lista_consultorios=$sql->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="mb-3">
    
    <div class="table-responsive">
        <table class="table table-primary" id="myTable">
            <thead>
                <tr>
                    <th>Consultorio</th>
                    <th scope="col">Dirrección</th>
                    <th scope="col">Municipio</th>
                    <th scope="col">Departamento</th>
                    <th scope="col" colspan="">Acciones</th>

                </tr>
            </thead>
            <tbody>
            <?php foreach($lista_consultorios as $consultorio){ ?>
                <tr class="">
                        
                    <td><?php echo $consultorio['idcon'] ?></td>
                    <td scope="row"><?php echo $consultorio['direccion'] ?></td>
                    <td><?php echo $consultorio['nombre_mun'] ?></td>
                    <td><?php echo $consultorio['nombre_dept'] ?></td>
                    <td>
                        <a name="" id="" class="btn btn-warning" href="./editar.php?txtID=<?php echo $consultorio['idcon'] ?>" role="button">Editar</a>
                     
                        <a name="" id="" class="btn btn-danger" href="javascript:borrar(<?php echo $consultorio['idcon'] ?>)" role="button">Eliminar</a>
                    </td>

               
                    
                </tr>
                <?php } ?>
                
            </tbody>
        </table>
    </div>
    

</div>

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