<!--ventana para Update--->
<div class="modal fade" id="deleteChildresn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="background: rgba(65, 64, 59, 0.445);" class="modal-header">
            <h4 class="modal-title" style="text-align: center; color:white;">
              <?=$data->Nombre?> || Ver juzgamientos de la Cerveza
            </h4>
      </div>
      <div style="background: rgba(65, 64, 59, 0.445);" class="modal-body">
      
        <?php
       /*  cerveza.Nombre AS Cerveza,cerveza.Codigo, usuarios.Nombre AS Usuario, rango_competidor.Nombre AS Rango  */

            while ($altdataCliente = mysqli_fetch_array($altqueryCliente)) { ?>
            <form method="POST" action="controlador/rechazar.php">
              <div>
                <input type="hidden" name="Id_cerveza" value="<?php echo $altdataCliente['Id_cerveza']; ?>">
              </div>
              <div>
                <input type="hidden" name="eventos" value="<?=$data->Id_evento?>">
              </div>
              <div class="modal-body">
                <button type="submit" style="background: #39A900; border:yellow" class="btn btn-primary"><?php echo $altdataCliente['Categoria']," - ",$altdataCliente['Estilo']," - ",$altdataCliente['Cerveza']; ?></button>
              </div>
              </form>
          <?php } ?>
        
        <div class="modal-footer">
            <button type="button" style="background: red; border:red" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!---fin ventana Update --->