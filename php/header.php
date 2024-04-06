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
                  <a class="nav-link" href="../vistas/index.php">Inicio</a>
                </li>
                <li class="nav-item active">
        <a class="nav-link" href="./empleados.php">Empleados</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./clientes.php">Clientes</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./mascotas.php">Mascotas</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./descuentos.php">Descuentos</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./servicios.php">Servicios</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./facturas.php">Facturas</a>
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