<div class="modal fade" id="modalDeleteConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
         
            <h5 class="modal-title" id="exampleModalLongTitle">Eliminar descuento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <img src="../img/icons/delperson.png" alt="check" height="50px"/>
          <div class="modal-body" id="modal-body">
          <div id="del-descuento-uno" style="text-align: center;"></div>
          <div id="del-descuento-dos" style="text-align: center;"></div>
          <div id="del-descuento-tres" style="text-align: center;"></div>
          <br>
          ¿Estás seguro de que deseas eliminar el descuento?
         
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="eliminarDescuento()">Confirmar</button>
          <button type="button" class="btn btn-warning" onclick="redirigir()">Cancelar</button>
          </div>
        </div>
      </div>
    </div>