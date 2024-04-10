<?php
require '../php/database.php';

class DelDiscountController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

   public function removeDiscount(){
        $descuentoId = $_GET['res'];
        if(isset($descuentoId)) {

            try {
                // Preparar la sentencia SQL
                $stmt = $this->conn->prepare("DELETE FROM clinic_management.descuento WHERE descuentoId = ?");

                // Vincular los parámetros
                $stmt->bindParam(1, $descuentoId);

                // Ejecutar la sentencia
                $stmt->execute();

                // Redirigir a la página de descuentos
                header('Location: ../vistas/descuentos.php?eliminado=ok');
                exit;
            } catch(PDOException $e) {
                // Manejar el error
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Redirect to an error page or display an error message
            // header('Location: ../vistas/error.php');
            echo "$descuentoId";
            exit;
        }
    }


}

$delDiscountController = new DelDiscountController($conn);
$delDiscountController->removeDiscount();