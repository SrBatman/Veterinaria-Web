
<div class="modal fade bd-example-modal-lg custom-modal" id="modalAddClient" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" >
          <div class="modal-header">
         
            <h5 class="modal-title" id="exampleModalLongTitle">Nuevo cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <img src="../img/icons/addPerson.png" alt="check" height="50px"/>
          <div class="modal-body" id="modal-body">
          <div style="width: 500px; height: 500px; margin: auto;">
        <form method="post" action="../controllers/addclient.php" onsubmit="return validarClientes();">
          <div class="form-group">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp">
            <div id="nombreHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="apellidoP" class="form-label">Apellido Paterno:</label>
            <input type="text" class="form-control" id="apellidoP" name="apellidoP" aria-describedby="apellidoPHelp">
            <div id="apellidoPHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="apellidoM" class="form-label">Apellido Materno:</label>
            <input type="text" class="form-control" id="apellidoM" name="apellidoM" aria-describedby="apellidoMHelp">
            <div id="apellidoMHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="direccion" class="form-label">Direccion:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" aria-describedby="direccionHelp">
            <div id="direccionHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="colonia" class="form-label">Colonia:</label>
            <input type="text" class="form-control" id="colonia" name="colonia" aria-describedby="coloniaHelp">
            <div id="direccionHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="zp" class="form-label">Codigo postal:</label>
            <input type="text" class="form-control" id="zp" name="zp" aria-describedby="zpHelp">
            <div id="zpHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="correo" class="form-label">Email:</label>
            <input type="email" class="form-control" id="correo" name="correo" aria-describedby="correoHelp">
            <div id="correoHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>

          <div class="form-group">
            <label for="tel_cel" class="form-label">Teléfono Cel:</label>
            <input type="text" placeholder="## #### ####" class="form-control" id="tel_cel" name="tel_cel">
            <div id="tel_celHelp" class="form-text">&nbsp;&nbsp;</div>
          </div>
          <div class="form-group">
            <label for="tel_casa" class="form-label">Telefono Casa:</label>
            <input type="text" placeholder="## #### ####" class="form-control" id="tel_casa" name="tel_casa" aria-describedby="tel_casaHelp">
            <div id="tel_casaHelp" class="form-text">&nbsp;&nbsp;</div>
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
