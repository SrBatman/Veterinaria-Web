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
<h2 class="epictitle">Administracion de mascotas</h2>
</div>
<div class="tabla-contenedor">
<!-- <input type="text" id="search" placeholder="Buscar por nombre"/> -->
<table class="tablita">
<tr>
    <th>ID</th> 
    <th>Nombre</th> 
    <th>Especie</th> 
    <th>Raza</th> 
    <th>Estatus</th> 
    <th>Dueño</th> 
    <th>&nbsp;&nbsp;</th>
    <th>&nbsp;&nbsp;</th>
    <th>&nbsp;&nbsp;</th>
</tr>


<?php 


$stmt = $conn->prepare("SELECT * FROM pet_care.Clientes_y_Mascotas ORDER BY estatus;");
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
        echo "<td>".$row['mascotaId']."</td>";
        echo "<td>".$row['PetName']."</td>";
        echo "<td>".$row['especie']."</td>";
        echo "<td>".$row['raza']."</td>";
        echo "<td>".$row['estatus']."</td>";
        echo "<td>".$row['OwnerName']." ".$row['apellidoP']."</td>";
        echo "<td>  <a href=\"./mascotas.php?view&mascotaId=".$row['mascotaId']."&nombre=".$row['PetName']."&especie=".$row['especie']."&raza=".$row['raza']."&edad=".$row['edad']."&peso=".$row['peso']."&sexo=".$row['sexo']."&estatus=".$row['estatus']."&owner=".$row['OwnerName']." ".$row['apellidoP']."\"> Ver </a></td>";
        echo "<td>  <a href=\"./mascotas.php?edit=".$row['mascotaId']."\"> Modificar </a></td>";
        echo "<td>  <a href=\"./mascotas.php?delete&mascotaId=".$row['mascotaId']."&nombre=".$row['PetName']."&especie=".$row['especie']."&raza=".$row['raza']."&owner=".$row['OwnerName']." ".$row['apellidoP']."\"> Baja </a></td>";
        echo "</tr>";
    }
  
} 
?>
</table>


</div>

<button type="button" class="btn btn-primary" style="position:relative; left:380px; top: 50px;" onclick="mostrarModalPet();">Nueva mascota</button>
</section>


<?php require '../modals/modalPet.php' ?>
<?php require '../modals/modalAddedM.php' ?>
<?php require '../modals/modalDelM.php' ?>
<?php require '../modals/modalShowM.php' ?>
<?php require '../modals/modalDeleted.php' ?>

<script src="../js/scripts.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<script>
      function redirigir(){
        window.location.href = "./empleados.php";
      }
</script>

<script src="../js/test.js"></script>

<script>
      function redirigir(){
        window.location.href = "./mascotas.php";
      }
</script>



<script>
    
    const x = new URLSearchParams(window.location.search);
    if (x.has('delete')){
    let id = x.get('mascotaId');
    let name = x.get('nombre');
    let especie = x.get('especie');
    let raza = x.get('raza');
    let owner = x.get('owner');



    // Modificar el contenido del cuerpo del modal
    if (id && name && especie && raza && owner) {
        document.getElementById('del-mascota-uno').textContent = `MascotaId: ${id}`;
        document.getElementById('del-mascota-dos').textContent = `Nombre: ${name}`;
        document.getElementById('del-mascota-tres').textContent = `Especie: ${especie}`;
        document.getElementById('del-mascota-cuatro').textContent = `Raza: ${raza}`;
        document.getElementById('del-mascota-cinco').textContent = `Dueño: ${owner}`;
        let componente = jQuery('#modalDeleteConfirm')
        componente.modal('show')
    }
    }
   
</script>

<script>
    
    if (x.has('view')){
    let id = x.get('mascotaId');
    let name = x.get('nombre');
    let especie = x.get('especie');
    let raza = x.get('raza');
    let edad = x.get('edad');
    let peso = x.get('peso');
    let sexo = x.get('sexo');
    let estatus = x.get('estatus');
    let owner = x.get('owner');


    // Modificar el contenido del cuerpo del modal
    if (id && name && especie && raza && edad && peso && sexo && estatus && owner) {
        document.getElementById('mascota-uno').textContent = `MascotaId: ${id}`;
        document.getElementById('mascota-dos').textContent = `Nombre: ${name}`;
        document.getElementById('mascota-tres').textContent = `Especie: ${especie}`;
        document.getElementById('mascota-cuatro').textContent = `Raza: ${raza}`;
        document.getElementById('mascota-cinco').textContent = `Edad: ${edad}`;
        document.getElementById('mascota-seis').textContent = `Peso: ${peso}`;
        document.getElementById('mascota-siete').textContent = `Sexo: ${sexo}`;
        document.getElementById('mascota-ocho').textContent = `Activo: ${estatus}`;
        document.getElementById('mascota-nueve').textContent = `Dueño: ${owner}`;
        let componente = jQuery('#showInfo')
        componente.modal('show')
    }
    }
   
</script>
<script>

  if (x.has('eliminado')){

    document.getElementById('modal-title').textContent = `¡Mascota eliminada!`;
    document.getElementById('modal-owo').textContent = 'Se ha eliminado la mascota con éxito.';
   
    let componente = jQuery('#showEliminated')
        componente.modal('show')
  }
</script>


<script>
      function eliminarMascota(){
        let id = x.get('mascotaId');
        window.location.href = `../controllers/delpet.php?res=${id}`;
      }
</script>

<script>
    // Obtener los parámetros de la URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('res')){
      let name  = urlParams.get('nombre');
      let especie = urlParams.get('especie');
      let raza = urlParams.get('raza');

    // Modificar el contenido del cuerpo del modal
    if (name && especie && raza) {
        document.getElementById('mascota-name').textContent = `Nombre: ${name}`;
        document.getElementById('mascota-especie').textContent = `Especie: ${especie}`;
        document.getElementById('mascota-raza').textContent = `Raza: ${raza}`;
        let componente = jQuery('#modalExito')
        componente.modal('show')
    }
    }
   
</script>
</body>
</html>