<?php 
    $url='http://localhost/prueba_usco/';

    session_start();
    
    if(!isset($_SESSION['admin_login'])){
      header('Location:'.$url);
    }
    
    ?>

<?php include_once('../Template/head.php'); ?>

    <?php include_once('./navbar.php') ?>

  <main>

    Home

  </main>


  <?php include_once('../Template/foot.php'); ?>