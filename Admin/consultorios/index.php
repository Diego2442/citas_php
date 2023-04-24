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

    


    //sentencia listar departamentos
    $sentencia =$conexion->prepare('SELECT * FROM departamentos');
    $sentencia->execute();
    $lista_departamentos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    //sentencia listar departamentos
    $sentencia =$conexion->prepare('SELECT * FROM municipios');
    $sentencia->execute();
    $lista_municipios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    
    ?>

  <main>

  
  
    <div class="container">
      <div class="row">
          <div class="col-6 mt-3">
          <div class="card card-outline card-primary">
          <div class="card-header">
          <h3 class="card-title">Consultorios</h3>
          <h5>Listar Consultorio</h5>
          </div>
          <div class="card-body">

            <div class="mb-3">
            
              <label for="" class="form-label">Departamentos</label>
              <select class="form-select form-select-lg select" name="departamento" id="departamento">
                <option value="">Seleciona...</option>
              <?php foreach($lista_departamentos as $departamento){ ?>
                <option value="<?php echo $departamento['iddept']?>"><?php echo $departamento['nombre_dept']?>-<?php echo $departamento['iddept']?></option>
              <?php } ?>
              </select>
            </div>

            <div id="municipios">

            </div>
            
          </div>
          </div>
          </div>

          <div class="col-6 mt-3">
          <div class="card card-outline card-primary">
          <div class="card-header">
          <h3 class="card-title">Consultorios</h3>
            <h5>Agregar Consultorio</h5>

          </div>
          <div class="card-body">

          <div class="mb-3">
                    <label for="" class="form-label">Departamentos</label>
                    <select class="form-select form-select-lg " name="departamento" id="departamento_crear">
                    <option value="">Seleciona...</option>
                    <?php foreach($lista_departamentos as $departamento){ ?>
                    <option value="<?php echo $departamento['iddept']?>"><?php echo $departamento['nombre_dept']?>-<?php echo $departamento['iddept']?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <div>
                    <div id="municipios_crear">

                    </div>
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
    window.location="./index.php?txtID="+id;
  }
})
  }
  </script>
  
<!-- Crear el script principal  -->
  <script type="text/javascript">
    $(document).ready(function(){
      recargarMun();

      $('#departamento').change(function(){
        recargarMun();
      });
    })
  </script>

<script type="text/javascript">
    function recargarMun(){
      $.ajax({
        type:"POST",
        url:"municipios.php",
        data:"departamento="+$('#departamento').val(),
        success:function(r){
          $('#municipios').html(r);
        }
      });
    }
  </script>
  <!-- fin del script  -->


  <!-- Crear el script del para agregar  -->

  <script type="text/javascript">
    $(document).ready(function(){
      recargarMun_Modal();

      $('#departamento_crear').change(function(){
        recargarMun_Modal();
      });
    })
  </script>

<script type="text/javascript">
    function recargarMun_Modal(){
      $.ajax({
        type:"POST",
        url:"crear.php",
        data:"departamento="+$('#departamento_crear').val(),
        success:function(r){
          $('#municipios_crear').html(r);
        }
      });
    }
  </script>

  <!-- fin del script  -->


  <script>
    
$(document).ready(function() {
    $('.select2').select2();
});
  </script>
  

  <?php include_once('../../Template/foot.php'); ?>