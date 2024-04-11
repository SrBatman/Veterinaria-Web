<?php 
session_start();

if (isset($_POST['owner']) && !empty($_POST['owner'])){
    $ownerPet = $_POST['owner'];
    header('Location: ../vistas/index.php?modalPatient=ok&owner=' . $ownerPet);
} else {
    header('Location: ../vistas/index.php?error=emptyowner');
}

?>