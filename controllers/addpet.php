<?php
require '../php/database.php';

class AddPetController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addPet() {
        // Check if all required inputs are provided
        if(isset($_POST['nombre'], $_POST['especie'], $_POST['raza'], $_POST['edad'], $_POST['peso'], $_POST['sexo'], $_POST['owner'])) {

            try {
                // Preparar la sentencia SQL
                $stmt = $this->conn->prepare("INSERT INTO pet_care.mascota(nombre, especie, raza, edad, peso, sexo, estatus) VALUES (:nombre, :especie, :raza, :edad, :peso, :sexo, :estatus); SELECT SCOPE_IDENTITY() AS mascotaId;");

                // Vincular los parámetros
                $stmt->bindParam(':nombre', $_POST['nombre']);
                $stmt->bindParam(':especie', $_POST['especie']);
                $stmt->bindParam(':raza', $_POST['raza']);
                $stmt->bindParam(':edad', $_POST['edad']);
                $stmt->bindParam(':peso', $_POST['peso']);
                $stmt->bindParam(':sexo', $_POST['sexo']);
                $stmt->bindValue(':estatus', 'Activo');  // Aquí se cambió bindParam por bindValue

                // Ejecutar la sentencia
                $stmt->execute();

                // Preparar la consulta SQL para obtener el ID de la mascota recién insertada
                $stmt = $this->conn->prepare("SELECT @@IDENTITY AS mascotaId");
                // Ejecutar la sentencia
                $stmt->execute();
                // Obtener el ID de la mascota recién insertada
                $mascotaId = $stmt->fetchColumn();


                $stmt = $this->conn->prepare("INSERT INTO pet_care.pet_and_owner (pet, owner) VALUES (:mascotaId, :clienteId)");

                // Vincular los parámetros
                $stmt->bindParam(':mascotaId', $mascotaId);
                $stmt->bindParam(':clienteId', $_POST['owner']);
       

                // Ejecutar la sentencia
                $stmt->execute();

                // Redirigir a la página de mascotas
                header('Location: ../vistas/mascotas.php?res=ok&nombre=' . $_POST['nombre'] . '&especie=' . $_POST['especie'] . '&raza=' . $_POST['raza'] );
                //mascotaId=".$row['mascotaId']."&nombre=".$row['PetName']."&especie=".$row['especie']."&raza=".$row['raza']."&owner=".$row['OwnerName']." ".$row['apellidoP']."
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

$addPetController = new AddPetController($conn);
$addPetController->addPet();
