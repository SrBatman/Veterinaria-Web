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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"> </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

   
</head>
<body>


<?php require '../php/header.php' ?>
<section class="tabla">

<div class="titlecontent">
<h2 class="epictitle">Administracion de clientes</h2>
</div>
<div class="tabla-contenedor">

<table class="tablita">
<tr>
    <th>ID</th> 
    <th>Nombre</th> 
    <th>Apellidos</th> 
    <th>Telefono </th>
    <th>&nbsp;</th>
    <th>&nbsp;&nbsp;</th>
    <th>&nbsp;&nbsp;</th>
</tr>



<?php 


$stmt = $conn->prepare("SELECT * FROM pet_care.cliente");
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
        echo "<td>".$row['clienteId']."</td>";
        echo "<td>".$row['nombre']."</td>";
        echo "<td>".$row['apellidoP']." ".$row['apellidoM']."</td>";
        echo "<td>".$row['tel_cel']."</td>";
        echo "<td>  <a href=\"./clientes.php?view&clienteId=".$row['clienteId']."&nombre=".$row['nombre']."&apellidoP=".$row['apellidoP']."&apellidoM=".$row['apellidoM']."&direccion=".$row['direccion']."&colonia=".$row['colonia']."&zp=".$row['zp']."&correo=".$row['email']."&tel_casa=".$row['tel_casa']."&tel_cel=".$row['tel_cel']."\"> Ver </a></td>";
        echo "<td>  <a href=\"./clientes.php?edit=".$row['clienteId']."\"> Modificar </a></td>";
        echo "<td>  <a href=\"./clientes.php?delete&clienteId=".$row['clienteId']."&nombre=".$row['nombre']."&apellidoP=".$row['apellidoP']."&apellidoM=".$row['apellidoM']."&tel_cel=".$row['tel_cel']."\"> Eliminar </a></td>";
        echo "</tr>";
    } 
  
} else {
  echo "<tr><td>No hay datos aun.</td></tr>";
}
?>
</table>

</div>
<button type="button" class="btn btn-primary" style="position:relative; left:380px; top: 50px;" onclick="mostrarModalCliente();">Nuevo cliente</button>
</section>
<!-- <section class="agregar-datos">

<h3 class="information">Nuevo empleado</h3>
<div style="width: 500px; height: 500px; margin: auto;">
        <form method="post" action="../controllers/addemployee.php" onsubmit="return validarEmpleados();">
          <div class="form-group">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp">
            <div id="nombreHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="apellidoP" class="form-label">Apellido Paterno:</label>
            <input type="text" class="form-control" id="apellidoP" name="apellidoP" aria-describedby="apellidoPHelp">
            <div id="apellidoPHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="apellidoM" class="form-label">Apellido Materno:</label>
            <input type="text" class="form-control" id="apellidoM" name="apellidoM" aria-describedby="apellidoMHelp">
            <div id="apellidoMHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="direccion" class="form-label">Direccion:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" aria-describedby="direccionHelp">
            <div id="direccionHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="colonia" class="form-label">Colonia:</label>
            <input type="text" class="form-control" id="colonia" name="colonia" aria-describedby="coloniaHelp">
            <div id="direccionHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="zp" class="form-label">Codigo postal:</label>
            <input type="text" class="form-control" id="zp" name="zp" aria-describedby="zpHelp">
            <div id="zpHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="correo" class="form-label">Email:</label>
            <input type="email" class="form-control" id="correo" name="correo" aria-describedby="correoHelp">
            <div id="correoHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>

          <div class="form-group">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" placeholder="## #### ####" class="form-control" id="telefono" name="telefono">
            <div id="telefonoHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="puesto" class="form-label">Puesto:</label>
            <input type="text" class="form-control" id="puesto" name="puesto" aria-describedby="puestoHelp">
            <div id="puestoHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
 
      </div>

</section> -->

<?php require '../modals/modalAddedC.php' ?>
<?php require '../modals/modalClient.php' ?>
<?php require '../modals/modalDelC.php' ?>
<?php require '../modals/modalShowC.php' ?>
<?php require '../modals/modalDeleted.php' ?>

<script src="../js/scripts.js"></script>

<script>
      function redirigir(){
        window.location.href = "./clientes.php";
      }
</script>



<script>
    
    const x = new URLSearchParams(window.location.search);
    if (x.has('delete')){
    let id = x.get('clienteId');
    let nombre = x.get('nombre');
    let apellidoP = x.get('apellidoP');
    let apellidoM = x.get('apellidoM');
    let tel = x.get('tel_cel');


    // Modificar el contenido del cuerpo del modal
    if (nombre && apellidoP && apellidoM) {
        document.getElementById('del-cliente-uno').textContent = `ClienteId: ${id}`;
        document.getElementById('del-cliente-dos').textContent = `Nombre: ${nombre} ${apellidoP} ${apellidoM}`;
        document.getElementById('del-cliente-tres').textContent = `Telefono: ${tel}`;
        let componente = jQuery('#modalDeleteConfirm')
        componente.modal('show')
    }
    }
   
</script>
<script>

  if (x.has('eliminado')){
        
    document.getElementById('modal-title').textContent = `¡Cliente eliminado!`;
    document.getElementById('modal-owo').textContent = 'Se ha eliminado al cliente con éxito.';
    let componente = jQuery('#showEliminated')
        componente.modal('show')
  }
</script>
<script>
    
    if (x.has('view')){
    let nombre = x.get('nombre');
    let apellidoP = x.get('apellidoP');
    let apellidoM = x.get('apellidoM');
    let direccion = x.get('direccion');
    let colonia = x.get('colonia');
    let zp = x.get('zp');
    let correo = x.get('correo');
    let telefono = x.get('tel_cel');
    let telcasa = x.get('tel_casa');


    // Modificar el contenido del cuerpo del modal
    if (nombre && apellidoP && apellidoM) {
        document.getElementById('cliente-nombre').textContent = `Nombre: ${nombre}`;
        document.getElementById('cliente-apellidos').textContent = `Apellidos: ${apellidoP} ${apellidoM}`;
        document.getElementById('cliente-direccion').textContent = `Dirección: ${direccion}, ${colonia}, ${zp}`;
        document.getElementById('cliente-correo').textContent = `Correo: ${correo}`;
        document.getElementById('cliente-telefono').textContent = `Teléfono: ${telefono}`;
        document.getElementById('cliente-telcasa').textContent = `Tel Casa: ${telcasa}`;
        let componente = jQuery('#showInfo')
        componente.modal('show')
    }
    }
   
</script>

<script>
      function eliminarCliente(){
        let id = x.get('clienteId');
        window.location.href = `../controllers/delclient.php?res=${id}`;
      }
</script>

<script>
    // Obtener los parámetros de la URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('res')){
      const nombre = urlParams.get('nombre');
    const apellidoP = urlParams.get('apellidoP');
    const apellidoM = urlParams.get('apellidoM');

    // Modificar el contenido del cuerpo del modal
    if (nombre && apellidoP && apellidoM) {
        document.getElementById('cliente-name').textContent = `${nombre} ${apellidoP} ${apellidoM}`;
        let componente = jQuery('#modalExito')
        componente.modal('show')
    }
    }
   
</script>
</body>
</html>