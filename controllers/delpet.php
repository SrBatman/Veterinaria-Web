<?php
require '../php/database.php';

class DelPetController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

   public function removePet(){
        $mascotaId = $_GET['res'];
        if(isset($mascotaId)) {

            try {
                // Preparar la sentencia SQL
                $stmt = $this->conn->prepare("DELETE FROM pet_care.mascota WHERE mascotaId = ?");

                // Vincular los parámetros
                $stmt->bindParam(1, $mascotaId);

                // Ejecutar la sentencia
                $stmt->execute();

                // Redirigir a la página de mascota
                header('Location: ../vistas/mascotas.php?eliminado=ok');
                exit;
            } catch(PDOException $e) {
                // Manejar el error
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Redirect to an error page or display an error message
            // header('Location: ../vistas/error.php');
            echo "$mascotaId";
            exit;
        }
    }


}

$delPetController = new DelPetController($conn);
$delPetController->removePet();