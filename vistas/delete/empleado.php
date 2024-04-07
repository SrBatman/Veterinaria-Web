<?php
session_start();
require '../../php/database.php';

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
<html lang="en">
<head>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../../css/vistas.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>Veterinaria</title>
    <link rel="shortcut icon" href="../../img/pies.png" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"> </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

   
</head>
<body>


<?php require '../../php/headerhelper.php' ?>
<section class="tabla">

<div class="titlecontent">
<h2 class="epictitle">Eliminacion de empleado</h2>
</div>
<div class="tabla-contenedor">

<table class="tablita">
<tr>
    <th>ID</th> 
    <th>Nombre</th> 
    <th>Apellido</th> 
    <th>Puesto/Cargo</th>
  
</tr>



<?php 
$empleadoId = $_GET['res'];

$stmt = $conn->prepare("SELECT empleadoId, nombre, apellidoP, puesto FROM clinic_management.empleado WHERE empleadoId = ?");
$stmt->bindParam(1, $empleadoId);
if (!$stmt) {
    echo "\nPDO::errorInfo():\n";
    error_log("Error en la consulta");
}
$stmt->execute();

$total = $stmt->rowCount();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(count($results) > 0) {
   
  
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>".$row['empleadoId']."</td>";
        echo "<td>".$row['nombre']."</td>";
        echo "<td>".$row['apellidoP']."</td>";
        echo "<td>".$row['puesto']."</td>";
        echo "</tr>";
    }
  
} 
?>
</table>
<h4 class="texto-eliminado">
    ¿Estás seguro de que deseas eliminar este empleado?
  </h4>
 <div class="botones">
  <button type="button" class="btn btn-danger">Confirmar</button>
  <button type="button" class="btn btn-warning">Cancelar</button>
 </div>
</div>
</section>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
         
            <h5 class="modal-title" id="exampleModalLongTitle">¡Registro exitoso!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <img src="../img/icons/check-two.gif" alt="check" height="50px"/>
          <div class="modal-body" id="modal-body">
            Se ha registrado con exito el empleado:
            <br>
            <div id="employee-name" style="text-align: center;"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="redirigir()">Aceptar</button>
          </div>
        </div>
      </div>
    </div>

<script src="../js/scripts.js"></script>
<script>
    // Obtener los parámetros de la URL
    const urlParams = new URLSearchParams(window.location.search);

    // Obtener los valores de los parámetros
    const nombre = urlParams.get('nombre');
    const apellidoP = urlParams.get('apellidoP');
    const apellidoM = urlParams.get('apellidoM');

    // Modificar el contenido del cuerpo del modal
    if (nombre && apellidoP && apellidoM) {
        document.getElementById('employee-name').textContent = `${nombre} ${apellidoP} ${apellidoM}`;
        let componente = jQuery('#exampleModalCenter')
        componente.modal('show')
    }
</script>
</body>
</html>