<?php 
if (isset($_POST['mascotas']) && !empty($_POST['serviciosSelect'])){
    $uwu = new stdClass();
    $uwu->servicios = $_POST['serviciosSelect']; 
    $uwu->mascota = $_POST['mascotas']; 
    $_SESSION['lista'][] = $uwu;

    
    header('Location: ../vistas/index.php?editar=ok&mascota=' . $uwu->mascota . '&servicios=' . $_POST['serviciosSelect']);
    exit;
      
 } else {
    header('Location: ../vistas/index.php?error=errorentabla');
     echo"No hay datos";
     // header('Location: ../vistas/index.php?error=emptyowner');
 }
 

?>