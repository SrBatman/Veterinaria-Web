<div class="modal fade bd-example-modal-lg custom-modal-ignore" id="modalAddService" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg " >
        <div class="modal-content" id="modal-servicio">
          <div class="modal-header">
         
            <h5 class="modal-title" id="exampleModalLongTitle">Nuevo servicio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <img src="../img/icons/addPerson.png" alt="check" height="50px"/>
          <div class="modal-body" id="modal-body">
          <div style="width: 500px; height: 500px; margin: auto;">
        <form method="post" action="../controllers/addservice.php" onsubmit="return validarServicios();">
        <div class="form-group">
            <label for="servicio" class="form-label">Servicio:</label>
            <input type="text" class="form-control" id="servicio" name="servicio" aria-describedby="servicioHelp">
            <div id="servicioHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="precio" class="form-label">Precio:</label>
            <input type="text" class="form-control" id="precio" name="precio" aria-describedby="precioHelp">
            <div id="precioHelp" class="form-text">&nbsp;&nbsp;</div>
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
