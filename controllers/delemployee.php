<?php
require '../php/database.php';

class DelEmployeeController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

   public function removeEmployee(){
        $empleadoId = $_GET['res'];
        if(isset($empleadoId)) {

            try {
                // Preparar la sentencia SQL
                $stmt = $this->conn->prepare("DELETE FROM clinic_management.empleado WHERE empleadoId = ?");

                // Vincular los parámetros
                $stmt->bindParam(1, $empleadoId);

                // Ejecutar la sentencia
                $stmt->execute();

                // Redirigir a la página de empleados
                header('Location: ../vistas/empleados.php?eliminado=ok');
                exit;
            } catch(PDOException $e) {
                // Manejar el error
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Redirect to an error page or display an error message
            // header('Location: ../vistas/error.php');
            echo "$empleadoId";
            exit;
        }
    }


}

$delEmployeeController = new DelEmployeeController($conn);
$delEmployeeController->removeEmployee();