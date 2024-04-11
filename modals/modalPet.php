
<div class="modal fade bd-example-modal-lg custom-modal" id="modalAddPet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" >
          <div class="modal-header">
         
            <h5 class="modal-title" id="exampleModalLongTitle">Nueva mascota</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <img src="../img/icons/addPerson.png" alt="check" height="50px"/>
          <div class="modal-body" id="modal-body">
          <div style="width: 500px; height: 500px; margin: auto;">

        <form method="post" action="../controllers/addpet.php" onsubmit="return validarMascotas();">
          <div class="form-group">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp">
            <div id="nombreHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="especie" class="form-label">Especie:</label>
            <input type="text" class="form-control" id="especie" name="especie" aria-describedby="especieHelp">
            <div id="especieHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="raza" class="form-label">Raza:</label>
            <input type="text" class="form-control" id="raza" name="raza" aria-describedby="razaHelp">
            <div id="razaHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="edad" class="form-label">Edad:</label>
            <input type="number" class="form-control" id="edad" name="edad" aria-describedby="edadHelp">
            <div id="edadHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="peso" class="form-label">Peso:</label>
            <input type="text" class="form-control" id="peso" name="peso" aria-describedby="pesoHelp">
            <div id="pesoHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="sexo" class="form-label">Sexo:</label>
            <select class="form-control" id="sexo" name="sexo">
              <option value="">Seleccione</option>
              <option>Hembra</option>
              <option>Macho</option>
            </select>
            <div id="zpHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="owner" class="form-label">Dueño:</label>
            <?php 
        $stmt = $conn->prepare("SELECT clienteId, nombre, apellidoP FROM pet_care.cliente");

        // Ejecutar la consulta
        $stmt->execute();
    
        // Iniciar el menú desplegable
        echo '<select class="form-control" id="owner" name="owner">';
        echo '<option value="">Seleccione</option>';
    
        // Iterar sobre los resultados
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row['clienteId'] . '">' . $row['nombre'] . ' ' . $row['apellidoP'] . '</option>';
        }
    
        // Cerrar el menú desplegable
        echo '</select>';
        
        ?>

            <div id="correoHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
       
        
          <button type="submit" class="btn btn-primary" style="width: 150px; position: relative; left: 150px;">Agregar</button>
        </form>
 
      </div>
         
          </div>
          <div class="modal-footer">
            <!-- <button type="submit" class="btn btn-secondary" data-dismiss="modal">Agregar</button> -->
          </div>
        </div>
      </div>
    </div>
   