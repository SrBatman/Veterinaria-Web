<?php
session_start();
require '../php/database.php';

class User {
  private $conn;
  public $user;

  public function __construct($conn) {
    $this->conn = $conn;
    if (isset($_SESSION['user_id'])) {
        if ($_SESSION['user_id'] == 'admin') {
            // Define el array para el usuario admin
            $this->user = array(
                'userId' => 'admin',
                'email' => 'admin@example.com',
                'passU' => 'admin_password',
                'usuario' => 'Neopales'
            );
            $_SESSION['username'] =  $this->user['usuario'];
            $_SESSION['user_data'] = $this->user;
        } else {
            $stmt = $this->conn->prepare('SELECT id, email, passU, usuario FROM users WHERE id = ?');
            $stmt->bindParam(1, $_SESSION['user_id']);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                $this->user = $user;
                $_SESSION['username'] =  $this->user['usuario'];
                $_SESSION['user_data'] = $this->user;
            }
        }
    } else {
        // Redirige a otra página si $_SESSION['user_id'] no está establecido
        header("Location: login.php");
        exit();
    }
  }
}

$user = new User($conn);

?>

<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilos.css">
    <meta charset="utf-8">
    <title>Veterinaria</title>
    <link rel="shortcut icon" href="../img/pies.png" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  </head>
  <body>
    <?php require '../php/header.php' ?>

    <div class="factura-contenedor">
      <div class="select-client container">
        <div class="client-text">
          <h4>Cliente</h4>
        </div>
      <?php 
        $stmt = $conn->prepare("SELECT clienteId, nombre, apellidoP FROM pet_care.cliente");

        // Ejecutar la consulta
        $stmt->execute();
    
        // Iniciar el menú desplegable
        echo '<select  id="owner" name="owner">';
        echo '<option value="">Seleccione</option>';
    
        // Iterar sobre los resultados
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row['clienteId'] . '">' . $row['nombre'] . ' ' . $row['apellidoP'] . '</option>';
        }
    
        // Cerrar el menú desplegable
        echo '</select>';
        
        ?>

        <div class="more-text" >
          <h5>¿No encuentras al cliente? <a href="./clientes.php">Agregalo aquí</a></h5> 
        </div>

      </div>
      <div class="boxbox container">
        <h6>Acerca de la consulta</h6>
         <div class="table container">
         <table class="table">
          <thead>
    <tr>
      <th scope="col">MascotaId</th>
      <th scope="col">Nombre de la mascota</th>
      <th scope="col">Servicio(s)</th>
      <th scope="col">Total por servicios</th>
    </tr>
        </thead>
  <tbody>

  </tbody>
</table>

         </div>
         <button type="button" class="btn btn-primary" style="position:relative; left:10px;" onclick="mostrarModal();">Agregar paciente</button>
      </div>

      <div class="detalles container">
        <div class="cajaowo">

        </div>

      </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"> </script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>