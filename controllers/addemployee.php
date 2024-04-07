<?php
require '../php/database.php';

class AddEmployeeController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addEmployee() {
        // Check if all required inputs are provided
        if(isset($_POST['nombre'], $_POST['apellidoP'], $_POST['apellidoM'], $_POST['direccion'], $_POST['colonia'], $_POST['zp'], $_POST['correo'], $_POST['telefono'], $_POST['puesto'])) {

            try {
                // Preparar la sentencia SQL
                $stmt = $this->conn->prepare("EXEC clinic_management.InsertarEmpleado :nombre, :apellidoP, :apellidoM, :direccion, :colonia, :zp, :email, :puesto, :telefono");

                // Vincular los parámetros
                $stmt->bindParam(':nombre', $_POST['nombre']);
                $stmt->bindParam(':apellidoP', $_POST['apellidoP']);
                $stmt->bindParam(':apellidoM', $_POST['apellidoM']);
                $stmt->bindParam(':direccion', $_POST['direccion']);
                $stmt->bindParam(':colonia', $_POST['colonia']);
                $stmt->bindParam(':zp', $_POST['zp']);
                $stmt->bindParam(':email', $_POST['correo']);
                $stmt->bindParam(':puesto', $_POST['puesto']);
                $stmt->bindParam(':telefono', $_POST['telefono']);

                // Ejecutar la sentencia
                $stmt->execute();

                // Redirigir a la página de empleados
                header('Location: ../vistas/empleados.php?res=ok&nombre=' . $_POST['nombre'] . '&apellidoP=' . $_POST['apellidoP'] . '&apellidoM=' . $_POST['apellidoM']);
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

$addEmployeeController = new AddEmployeeController($conn);
$addEmployeeController->addEmployee();

