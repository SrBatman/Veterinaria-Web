<?php 
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
        <div class="header container-fluid"> 
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark justify-content-between" style="background-color: #4482af;">
            <a class="navbar-brand" href="#">
                <img src="../img/pies.png" width="50" height="50" class="d-inline-block align-top" alt="">
                Veterinaria Patitas
              </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="../index.html">Inicio</a>
                </li>
                <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Empleados
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Agregar</a>
          <a class="dropdown-item" href="#">Modificar</a>
          <a class="dropdown-item" href="#">Eliminar</a>
          <!-- <div class="dropdown-divider"></div> -->
          <a class="dropdown-item" href="#">Ver lista</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Clientes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Agregar</a>
          <a class="dropdown-item" href="#">Modificar</a>
          <a class="dropdown-item" href="#">Eliminar</a>
          <!-- <div class="dropdown-divider"></div> -->
          <a class="dropdown-item" href="#">Ver lista</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mascotas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Agregar</a>
          <a class="dropdown-item" href="#">Modificar</a>
          <a class="dropdown-item" href="#">Eliminar</a>
          <!-- <div class="dropdown-divider"></div> -->
          <a class="dropdown-item" href="#">Ver lista</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Descuentos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Agregar</a>
          <a class="dropdown-item" href="#">Modificar</a>
          <a class="dropdown-item" href="#">Eliminar</a>
          <!-- <div class="dropdown-divider"></div> -->
          <a class="dropdown-item" href="#">Ver lista</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Servicios
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Agregar</a>
          <a class="dropdown-item" href="#">Modificar</a>
          <a class="dropdown-item" href="#">Eliminar</a>
          <!-- <div class="dropdown-divider"></div> -->
          <a class="dropdown-item" href="#">Ver lista</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Facturas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Generar</a>
          <a class="dropdown-item" href="#">Modificar</a>
          <a class="dropdown-item" href="#">Eliminar</a>
          <!-- <div class="dropdown-divider"></div> -->
          <a class="dropdown-item" href="#">Ver lista</a>
        </div>
      </li>
              </ul>
<ul class="navbar-nav">
    <li class="nav-item">
        <span class="navbar-text fs-3" style="color:black;">
        <i class="bi bi-person fs-3"></i> <?php 
        echo isset($_SESSION['user_data']) ? $_SESSION['user_data']['usuario'] : $_SESSION['username']; ?>
        </span>
    </li>
</ul>

            </div>
            <form class="form-inline">
                <button type="button" class="btn btn-secondary btn-lg" style="margin-right: 20px;" onclick="location.href='../vistas/logout.php'">Cerrar Sesion</button>
            </form>
          </nav>
        </div>
    </header>