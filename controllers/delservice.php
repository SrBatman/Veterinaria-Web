<?php
require '../php/database.php';

class DelServiceController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

   public function removeService(){
        $servicioId = $_GET['res'];
        if(isset($servicioId)) {

            try {
                // Preparar la sentencia SQL
                $stmt = $this->conn->prepare("DELETE FROM clinic_management.servicio WHERE servicioId = ?");

                // Vincular los parámetros
                $stmt->bindParam(1, $servicioId);

                // Ejecutar la sentencia
                $stmt->execute();

                // Redirigir a la página de servicio
                header('Location: ../vistas/servicios.php?eliminado=ok');
                exit;
            } catch(PDOException $e) {
                // Manejar el error
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Redirect to an error page or display an error message
            // header('Location: ../vistas/error.php');
            echo "$servicioId";
            exit;
        }
    }


}

$delServiceController = new DelServiceController($conn);
$delServiceController->removeService();