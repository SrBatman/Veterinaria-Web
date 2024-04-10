<?php
require '../php/database.php';

class AddDiscountController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addDiscount() {
        // Check if all required inputs are provided
        if(isset($_POST['porcentaje'], $_POST['cantidad'])) {

            try {
                // Preparar la sentencia SQL
                $stmt = $this->conn->prepare("EXEC clinic_management.InsertarDescuento :porcentaje, :cantidad");

                // Vincular los parámetros
                $stmt->bindParam(':porcentaje', $_POST['porcentaje']);
                $stmt->bindParam(':cantidad', $_POST['cantidad']);

                // Ejecutar la sentencia
                $stmt->execute();

                // Redirigir a la página de descuentos
                header('Location: ../vistas/descuentos.php?res=ok&porcentaje=' . $_POST['porcentaje'] . '&cantidad=' . $_POST['cantidad']."");
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

$addDiscountController = new AddDiscountController($conn);
$addDiscountController->addDiscount();
