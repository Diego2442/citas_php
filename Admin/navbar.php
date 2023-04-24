<?php $url_base="http://localhost/prueba_usco/Admin/"; ?>
<body>
  <header>


  <nav class="navbar navbar-expand navbar-light bg-light">
      <ul class="nav navbar-nav">
          <li class="nav-item">
              <a class="nav-link active" href="<?php echo $url_base; ?>" aria-current="page">Sistema Citas<span class="visually-hidden">(current)</span></a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base; ?>usuarios/">Usuarios</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base; ?>citas/">Citas</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base; ?>consultorios/">Consultorios</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="http://localhost/prueba_usco/logout.php">Cerrar sesión</a>
          </li>
      </ul>
  </nav>

  </header>