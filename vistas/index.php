<?php
  session_start();
  require 'database.php';

  class User {
    private $conn;
    public $user;
  
    public function __construct($conn) {
      $this->conn = $conn;
      if (isset($_SESSION['user_id'])) {
        $stmt = $this->conn->prepare('SELECT id, email, passU, username FROM users WHERE id = ?');
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if ($user) {
          $this->user = $user;
        }
      }
    }
  }
  
  $user = new User($conn);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Zoologico de colombia</title>
    <link rel="shortcut icon" href="../../assets/icons/zoo_icon.png" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user->user)): ?>
      
      <br> ¡Bienvenid@ de vuelta <?= $user->user['username']; ?>!
      <br>Haz iniciado sesion de manera satisfactoria.
      <a href="logout.php">
        Cerrar Sesion
      </a> 
    <?php else: ?>
      <h1>Iniciar sesion o registrarse</h1>

      <a href="login.php">Iniciar sesion</a> or
      <a href="signup.php">Registrarse</a>
    <?php endif; ?>
  </body>
</html>