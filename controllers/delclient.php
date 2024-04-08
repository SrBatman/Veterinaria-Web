<?php
require '../php/database.php';

class DelClientController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

   public function removeClient(){
        $clienteId = $_GET['res'];
        if(isset($clienteId)) {

            try {
                // Preparar la sentencia SQL
                $stmt = $this->conn->prepare("DELETE FROM pet_care.cliente WHERE clienteId = ?");

                // Vincular los parámetros
                $stmt->bindParam(1, $clienteId);

                // Ejecutar la sentencia
                $stmt->execute();

                // Redirigir a la página de clientes
                header('Location: ../vistas/clientes.php?eliminado=ok');
                exit;
            } catch(PDOException $e) {
                // Manejar el error
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Redirect to an error page or display an error message
            // header('Location: ../vistas/error.php');
            echo "$clienteId";
            exit;
        }
    }


}

$delClientController = new DelClientController($conn);
$delClientController->removeClient();