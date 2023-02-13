<!-- Modal -->
<div class="modal fade" id="aceptarS" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="aceptarS" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header" style="background: rgba(65, 64, 59, 0.445);">
        <h1 class="modal-title fs-5" id="aceptarS" style="text-align: center; color:white;">Mesas</h1>
      </div>
      <div class="modal-body" style="background: rgba(65, 64, 59, 0.445); overflow: hidden;">
        <div>
            <h3 style="color:white">Asignanación</h3>
            <form id="give">
                
                <div class="selecModal">
                    <label>Mesa</label>
                    <select id="mesa" class="form-control" name="mesa" type="number">
                        <option value="">- Seleccione mesa -</option>
                        <?php
                            $a=0;
                            while ($a<($count->Mesas)) {
                                ?>

                                <option value="<?=$a+1?>"><?=$a+1?></option>
                                
                                <?php
                                $a++;
                            } //llenar las opciones del select padre 
                        ?>
                    </select>
                </div>
                <br>
                <div class="form">
                  <div>
                      <label>N° Cervezas</label>
                      <input type="number" class="form-control" name="beer" id="beer">
                  </div>
                  <br>
                  <div>
                      <label>N° Catadores</label>
                      <input type="number" class="form-control" name="user" id="user">
                  </div>
                </div>

                <button type="submit" style="display:none;" id="oculto">enviar</button>
            </form>
        </div>
      </div>
      <div class="botones" style="background: rgba(65, 64, 59, 0.445);">
      <div>
        <button type="button" data-bs-dismiss="modal">Cerrar</button>
      </div>
        <div>
            <!-- Button trigger modal -->
            
                <button type="submit" data-bs-toggle="modal" id="accionador">
                    Siguiente
                </button>
            

        </div>
        
      </div>
      
      
    </div>
  </div>
 
</div>
<script>
    $( document ).ready(function() {
        $("#accionador").click(function(){
            $("#oculto").click();
        });
    $("#give").submit(function(event){
        event.preventDefault(); //previene el comportamiento por defecto del formulario
        var mesa = $("#mesa").val(); //obtiene el valor del select mesa
        var beer = $("#beer").val(); //obtiene el valor del input de cervezas
        var user = $("#user").val(); //obtiene el valor del input de catadores
        var res = $('#resultado');

        $.ajax({
              data: {mesa:mesa, beer:beer, user:user}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
              dataType: 'html', //tipo de datos que esperamos de regreso
              type: 'POST', //mandar variables como post o get
              url: './controladoreJuzgamiento/beer.php' //url que recibe las variables
            }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion             

              res.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
              
            });
    });
    });
</script>

