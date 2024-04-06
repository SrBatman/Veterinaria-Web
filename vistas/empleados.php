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
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../css/vistas.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>Veterinaria</title>
    <link rel="shortcut icon" href="../img/pies.png" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
</head>
<body>


<?php require '../php/header.php' ?>
<section class="tabla">

<div class="titlecontent">
<h2 class="epictitle">Administracion de empleados</h2>
</div>
<div class="tabla-contenedor">

<table class="tablita">
<tr>
    <th>ID</th> 
    <th>Nombre</th> 
    <th>Apellido</th> 
    <th>Puesto/Cargo</th>
    <th>&nbsp;&nbsp;</th>
    <th>&nbsp;&nbsp;</th>
</tr>



<?php 


$stmt = $conn->prepare("SELECT empleadoId, nombre, apellidoP, puesto FROM clinic_management.empleado");
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
        echo "<td>  <a href=\"./edits/empleado.php\"> Modificar </a></td>";
        echo "<td>  <a href=\"./delete/empleado.php\"> Eliminar </a></td>";
        echo "</tr>";
    }
  
} 
?>
</table>
</div>
</section>
<section class="agregar-datos">

<h3 class="information">Nuevo empleado</h3>
<div style="width: 500px; height: 500px; margin: auto;">
        <form>
          <div class="form-group">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" aria-describedby="nombreHelp">
            <div id="nombreHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="apellidoP" class="form-label">Apellido Paterno:</label>
            <input type="text" class="form-control" id="apellidoP" aria-describedby="apellidoPHelp">
            <div id="apellidoPHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="apellidoM" class="form-label">Apellido Materno:</label>
            <input type="text" class="form-control" id="apellidoM" aria-describedby="apellidoMHelp">
            <div id="apellidoMHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="direccion" class="form-label">Direccion:</label>
            <input type="text" class="form-control" id="direccion" aria-describedby="direccionHelp">
            <div id="direccionHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="colonia" class="form-label">Colonia:</label>
            <input type="text" class="form-control" id="colonia" aria-describedby="coloniaHelp">
            <div id="direccionHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="zp" class="form-label">Codigo postal:</label>
            <input type="text" class="form-control" id="zp" aria-describedby="zpHelp">
            <div id="zpHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="correo" class="form-label">Email:</label>
            <input type="email" class="form-control" id="correo" aria-describedby="correoHelp">
            <div id="correoHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>

          <div class="form-group">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" placeholder="## #### ####" class="form-control" id="telefono">
            <div id="telefonoHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="puesto" class="form-label">Puesto:</label>
            <input type="text" class="form-control" id="puesto" aria-describedby="puestoHelp">
            <div id="puestoHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <button type="button" class="btn btn-primary" onclick="validarFormulario(event)">Agregar</button>
        </form>
 
      </div>

</section>

</body>
</html>