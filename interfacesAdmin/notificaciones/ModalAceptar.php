
<!--ventana para Update--->
<div class="modal fade" id="editChildresn<?php echo $dataCliente['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div style="background: rgb(202, 200, 168);" class="modal-content">
      <div class="modal-header">
            <h4 class="modal-title" style="text-align: center; color:white;">
                Aceptar la cerveza:
            </h4>
      </div>
      <div class="modal-body">
          <strong style="text-align: center !important; color:white;"> 
            <?php echo $dataCliente['Nombre']," - ",$dataCliente['usuario'],", ",$dataCliente['rango']; ?>        
          </strong>
        </div>


      <form method="POST" action="aceptar.php">
        <input type="hidden" name="id" value="<?php echo $dataCliente['id']; ?>">
            <div class="modal-footer">
              <button type="button"  style="background: red; border:red" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" style="background: #39A900; border:yellow" class="btn btn-primary">Aceptar</button>
            </div>
       </form>

    </div>
  </div>
</div>
<!---fin ventana Update --->
