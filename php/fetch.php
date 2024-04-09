<?php

require '../php/database.php';
if(isset($_POST['search'])){

    $search = $_POST['search'];
    if($search != ''){
        $stmt = $conn->prepare("SELECT * FROM clinic_management.empleado WHERE nombre LIKE :search");
        $stmt->execute(['search' => $search . '%']);
            // $stmt->execute(['search' => '%' . $search . '%']);\
    } else {
        $stmt = $conn->prepare("SELECT * FROM clinic_management.empleado");
        $stmt->execute();
    }



    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Aquí puedes generar el HTML de la tabla con los resultados y devolverlo
    if(count($results) > 0) {
   
  
        foreach ($results as $row) {
            echo "<tr>";
            echo "<td>".$row['empleadoId']."</td>";
            echo "<td>".$row['nombre']."</td>";
            echo "<td>".$row['apellidoP']." ".$row['apellidoM']."</td>";
            echo "<td>".$row['puesto']."</td>";
            echo "<td>  <a href=\"./empleados.php?view&empleadoId=".$row['empleadoId']."&nombre=".$row['nombre']."&apellidoP=".$row['apellidoP']."&apellidoM=".$row['apellidoM']."&direccion=".$row['direccion']."&colonia=".$row['colonia']."&zp=".$row['zp']."&correo=".$row['email']."&telefono=".$row['telefono']."&puesto=".$row['puesto']."\"> Ver </a></td>";
            echo "<td>  <a href=\"./empleados.php?edit=".$row['empleadoId']."\"> Modificar </a></td>";
            echo "<td>  <a href=\"./empleados.php?delete&empleadoId=".$row['empleadoId']."&nombre=".$row['nombre']."&apellidoP=".$row['apellidoP']."&apellidoM=".$row['apellidoM']."&puesto=".$row['puesto']."\"> Eliminar </a></td>";
            echo "</tr>";
        }
      
    } 
}
