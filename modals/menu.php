
<div class="modal fade bd-example-modal-lg custom-modal" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" >
          <div class="modal-header">
         
            <h5 class="modal-title" id="exampleModalLongTitle">Datos para la consulta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <img src="../img/icons/notes.png" alt="check" height="50px"/>
          <div class="modal-body" id="modal-body">
          <div style="width: 500px; height: 500px; margin: auto;">

        <form method="post" action="../controllers/tablecontrol.php" onsubmit="return validarPacientes();">
          <div class="form-group">
            <label for="nombre" class="form-label">Mascota:</label>
            <?php 
           
            $dueno = $_GET['owner'];
         
            $stmt = $conn->prepare("SELECT * FROM pet_care.Clientes_y_Mascotas where clienteId = :clienteId;");

            $stmt->bindParam(':clienteId', $dueno);

                // Ejecutar la consulta
                $stmt->execute();
            
                // Iniciar el menú desplegable
                echo '<select class="form-control" id="mascotas" name="mascotas">';
                echo '<option value="">Seleccione</option>';
            
                // Iterar sobre los resultados
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['mascotaId'] . '">' . $row['PetName'] . '</option>';
                }
            
                // Cerrar el menú desplegable
                echo '</select>';
                
                ?>
                <div id="mascotasHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="servicios" class="form-label">Lista de servicios:</label>
                    <?php 
                $stmt = $conn->prepare("SELECT * FROM clinic_management.servicio");

                // Ejecutar la consulta
                $stmt->execute();
            
                // Iniciar el menú desplegable
                echo '<select class="form-control" id="serviciosSelect" name="serviciosSelect" multiple>';
                echo '<option value="">Seleccione</option>';
            
                // Iterar sobre los resultados
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['servicioId'] . "_" . $row['tipo'] .'">' . $row['tipo'] . '</option>';
                }
            
                // Cerrar el menú desplegable
                echo '</select>';
                
                ?>
            <div id="serviciosHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          
            <label for="raza" class="form-label">Servicios seleccionados</label>
            
            <div id="caja-de-servicios" class="caja-de-servicios">&nbsp;&nbsp;</div>
    
            <div id="espacio" class="form-text">&nbsp;&nbsp;</div>
          <button type="submit" class="btn btn-danger" style="width: 150px; position: relative; left: 150px;">Confirmar</button>
          <button type="button" class="btn btn-warning" style="width: 150px; position: relative; left: 150px;" onclick="redirigir()">Cancelar</button>
        
        </form>
 
      </div>
         
          </div>
          <div class="modal-footer">
            <!-- <button type="submit" class="btn btn-secondary" data-dismiss="modal">Agregar</button> -->
          </div>
        </div>
      </div>
    </div>
   