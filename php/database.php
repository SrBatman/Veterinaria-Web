<?php 
class DataBase {
    public $conn;
    
    public function __construct(){
        $host = "localhost";
        $database = "Veterinaria";
        $username = "SuperAdmin";
        $password = "patitas24!$";
        $puerto = 1433;
        
        try {
            $this->conn = new PDO("sqlsrv:Server=$host;Database=$database", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
            error_log("Connected to SQL Server");
        } catch (PDOException $e) {
            error_log("Connection failed: " . $e->getMessage());
            echo "Connection failed: " . $e->getMessage();
        }
    }



}

$db = new Database();
$conn = $db->conn ;
?>