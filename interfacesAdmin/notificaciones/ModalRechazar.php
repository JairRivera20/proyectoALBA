<!-- Ventana modal para eliminar -->
<div class="modal fade" id="deleteChildresn<?php echo $dataCliente['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div style="background: rgb(177, 175, 149)" class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                Rechazar la cerveza:
            </h4>
        </div>

        <div class="modal-body">
          <strong style="text-align: center !important; color:white;"> 
            <?php echo $dataCliente['Nombre']," - ",$dataCliente['usuario'],", ",$dataCliente['rango']; ?>        
          </strong>
        </div>
        
        <div class="modal-footer">
          <button type="button" style="background: #39A900; border:yellow; color:white;" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" style="background: red; border:red" class="btn btn-danger btnBorrar" data-dismiss="modal" id="<?php echo $dataCliente['id']; ?>">Rechazar</button>
        </div>
        
        </div>
      </div>
</div>
<!---fin ventana eliminar--->