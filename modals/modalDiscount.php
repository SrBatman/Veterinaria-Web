<div class="modal fade bd-example-modal-lg custom-modal-ignore" id="modalAddDiscount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg " >
        <div class="modal-content" id="modal-servicio">
          <div class="modal-header">
         
            <h5 class="modal-title" id="exampleModalLongTitle">Nuevo descuento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <img src="../img/icons/addPerson.png" alt="check" height="50px"/>
          <div class="modal-body" id="modal-body">
          <div style="width: 500px; height: 500px; margin: auto;">
        <form method="post" action="../controllers/adddiscount.php" onsubmit="return validarDescuento();">
        <div class="form-group">
            <label for="porcentaje" class="form-label">Porcentaje (%):</label>
            <input type="number" class="form-control" id="porcentaje" name="porcentaje" aria-describedby="porcentajeHelp"/> 
            <div id="porcentajeHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="cantidad" class="form-label">Cantidad:</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" aria-describedby="cantidadHelp">
            <div id="cantidadHelp" class="form-text">&nbsp;&nbsp;</div>
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
