<?php 
    $url='http://localhost/prueba_usco/';

    session_start();
    
    if(!isset($_SESSION['admin_login'])){
      header('Location:'.$url);
    }
    
    ?>
<?php
    
    include_once('../../conexion.php');


    $departamento = $_POST['departamento'];

    $sql=$conexion->prepare('SELECT idmun, nombre_mun, estado, id_dept FROM municipios WHERE id_dept=:id_dept');

    $sql->bindParam(':id_dept',$departamento);

    $sql->execute();

    $lista_municipios=$sql->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="mb-3">
    <label for="" class="form-label">Municipios</label>
    <select class="form-select form-select-lg " name="municipio" id="municipio">
        <?php foreach($lista_municipios as $municipio){ ?>        
            <option selected value="<?php echo $municipio['idmun'] ?>"><?php echo $municipio['nombre_mun'] ?></option>
        <?php } ?>
        
    </select>
</div>

<div id="consultorios">

</div>

<script type="text/javascript">
    $(document).ready(function(){
      recargarCon();

      $('#municipio').change(function(){
        recargarCon();
      });
    })
  </script>

<script type="text/javascript">
    function recargarCon(){
      $.ajax({
        type:"POST",
        url:"consultorios.php",
        data:"municipio="+$('#municipio').val(),
        success:function(r){
          $('#consultorios').html(r);
        }
      });
    }
  </script>

  <script>
    
$(document).ready(function() {
    $('.select2').select2();
});
  </script>