<div class="modal fade" id="modalDeleteConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
         
            <h5 class="modal-title" id="exampleModalLongTitle">Eliminar mascota</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <img src="../img/icons/removedb.png" alt="check" height="50px"/>
          <div class="modal-body" id="modal-body">
          <div id="del-mascota-uno" style="text-align: center;"></div>
          <div id="del-mascota-dos" style="text-align: center;"></div>
          <div id="del-mascota-tres" style="text-align: center;"></div>
          <div id="del-mascota-cuatro" style="text-align: center;"></div>
          <div id="del-mascota-cinco" style="text-align: center;"></div>
          <br>
          ¿Estás seguro de que deseas eliminar a la mascota?
            <br>
          Esto solo cambiara el estado de la mascota a inactiva, <br> no se eliminara del todo.
         
           
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="eliminarMascota()">Confirmar</button>
          <button type="button" class="btn btn-warning" onclick="redirigir()">Cancelar</button>
          </div>
        </div>
      </div>
    </div>