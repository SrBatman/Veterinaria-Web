<?php
require '../php/database.php';

class AddServiceController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addService() {
        // Check if all required inputs are provided
        if(isset($_POST['servicio'], $_POST['precio'])) {

            try {
                // Preparar la sentencia SQL
                $stmt = $this->conn->prepare("EXEC clinic_management.InsertarServicio :tipo, :precio");

                // Vincular los parámetros
                $stmt->bindParam(':tipo', $_POST['servicio']);
                $stmt->bindParam(':precio', $_POST['precio']);

                // Ejecutar la sentencia
                $stmt->execute();

                // Redirigir a la página de servicios
                header('Location: ../vistas/servicios.php?res=ok&tipo=' . $_POST['servicio'] . '&precio=' . $_POST['precio']."");
                exit;
            } catch(PDOException $e) {
                // Manejar el error
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Redirect to an error page or display an error message
            header('Location: ../vistas/error.php');
            exit;
        }
    }
}

$addServiceController = new AddServiceController($conn);
$addServiceController->addService();
