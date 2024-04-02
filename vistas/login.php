<?php
  ini_set('error_log', '../logs/error.log');
  class User {
    private $conn;
    private $user_id;
    
    public function __construct($conn) {
      $this->conn = $conn;
      session_start();
      if (isset($_SESSION['user_id'])) {
        $this->user_id = $_SESSION['user_id'];
        header('Location: http://localhost/Zoo/pages/login/index.php');
        exit;
      }
    }
    
    public function login($email, $password) {
      $stmt = $this->conn->prepare('SELECT id, email, passU FROM users WHERE email = ?');
      $stmt->bind_param('s', $email);
      $stmt->execute();
      $result = $stmt->get_result();
      $user = $result->fetch_assoc();
  
      if ($user !== null && password_verify($password, $user['passU'])) {
          $_SESSION['user_id'] = $user['id'];
          header("Location: http://localhost/Zoo/pages/login/index.php");
          exit;
      } else {
          return 'Las credenciales son incorrectas';
      }
  }

  }

  // include_once("../php/database.php");
  
  require '../php/database.php';
  $user = new User($conn);
  
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $message = $user->login($_POST['email'], $_POST['password']);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Veterinaria</title>
    <link rel="shortcut icon" href="../img/pies.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilos.css">
    
  </head>
  <body>
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
                <li class="nav-item active">
                                  <a class="nav-link" href="../index.html#cuarta">Veterinaria</a>
                </li>
                <li class="nav-item active">
                      <a class="nav-link" href="../index.html#septima">Alimentos y accesorios</a>
                </li>
              <li class="nav-item active">
                               <a class="nav-link" href="../index.html#contact">Contacto</a>
                         </li>
              </ul>
<ul class="navbar-nav">
    <li class="nav-item">
        <span class="navbar-text">
            <i class="bi bi-telephone"></i> 33-1023-2346
        </span>
    </li>
</ul>

            </div>
            <form class="form-inline">
                <button type="button" class="btn btn-secondary btn-lg" style="margin-right: 20px;" onclick="location.href='./login.php'">Iniciar sesion</button>
            </form>
          </nav>
        </div>
    </header>

    <section id="content" class="content">
     <video autoplay loop muted plays-inline class="back-video">
      <source src="../img/test.mp4" type="video/mp4">
     </video>

    <div class="login-box" id="login-box">
      <br>
      <br>
      <br>
      <br>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
    
    <h1>Iniciar sesion</h1>
    <!-- <span>ó <a href="signup.php">Registarse</a></span> -->

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="Introduce tu email">
      <input name="password" type="password" placeholder="Introduce tu contraseña">
      <input type="submit" value="Iniciar sesion">
    </form>
    </div>
    
    </section>

      <!-- Footer -->
  <section id="footer">
    <div class="footer container">
      <div class="brand">
      </div>
      <h2>¡Siguenos en nuestras redes sociales!</h2>
      <div class="social-icon">
        <div class="social-item">
          <a href="https://www.facebook.com"><img src="../img/icons/facebook.png"  height="50px" width="50px"/></a>
        </div>
        <div class="social-item">
          <a href="https://web.whatsapp.com"><img src="../img/icons/twitter.png" height="50px" width="50px" /></a>
        </div>

      </div>
      <p>Copyright © 2024 Patitas. Todos los derechos reservados</p>
    </div>
  </section>
  </body>
</html>