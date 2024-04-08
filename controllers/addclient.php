<?php
require '../php/database.php';

class AddClientController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addClient() {
        // Check if all required inputs are provided
        if(isset($_POST['nombre'], $_POST['apellidoP'], $_POST['apellidoM'], $_POST['direccion'], $_POST['colonia'], $_POST['zp'], $_POST['correo'], $_POST['tel_cel'], $_POST['tel_casa'])) {

            try {
                // Preparar la sentencia SQL
                $stmt = $this->conn->prepare("EXEC pet_care.InsertarCliente :nombre, :apellidoP, :apellidoM, :direccion, :colonia, :zp, :email, :tel_cel, :tel_casa");

                // Vincular los parámetros
                $stmt->bindParam(':nombre', $_POST['nombre']);
                $stmt->bindParam(':apellidoP', $_POST['apellidoP']);
                $stmt->bindParam(':apellidoM', $_POST['apellidoM']);
                $stmt->bindParam(':direccion', $_POST['direccion']);
                $stmt->bindParam(':colonia', $_POST['colonia']);
                $stmt->bindParam(':zp', $_POST['zp']);
                $stmt->bindParam(':email', $_POST['correo']);
                $stmt->bindParam(':tel_cel', $_POST['tel_cel']);
                $stmt->bindParam(':tel_casa', $_POST['tel_casa']);

                // Ejecutar la sentencia
                $stmt->execute();

                // Redirigir a la página de clientes
                header('Location: ../vistas/clientes.php?res=ok&nombre=' . $_POST['nombre'] . '&apellidoP=' . $_POST['apellidoP'] . '&apellidoM=' . $_POST['apellidoM']);
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

$addClientController = new AddClientController($conn);
$addClientController->addClient();
