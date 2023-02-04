<div class="modal fade" id="estiloN" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title" style="color:black; text-align:center;">
                    BJCP Brewers Style Guide
                </h4>
        </div>
        <div class="modal-body" >
        
            <?php
                $num=$next->Id_estilo;
                /* abre el txt */
                $file = fopen("./estilos/en/styles.txt", "r");
                /* lo que queremos filtrar */
                $hashtag = 'hashtag';
                $texto = '<div id="'.$hashtag.$num.'">';
                
                $salida = "";
                $sale = 0;
                
                /* mientras no haya fin de archivo, ni se acabe la imprenta de lineas que se ejecute  */
                while(!feof($file) && $sale==0) {
                     /* toma las lineas */
                    $line = fgets($file);
                    /* comprobante de  */
                    if(strpos($line,$texto) === 0){
                       $salida .= $line;
                          while(!feof($file)) {
                               /* toma la linea */
                               $line = fgets($file);
                               /* comprueba si esa linea que tomó inicia con div id */
                               if(strpos($line,"<div id=") === 0){
                                    /* envia 1 para detener el while primario */
                                    $sale = 1;
                                    /* el break rompe el while interno */
                                    break;
                               } else {
                                    /* si en la linea tomada no se encuentra div id entonces muestra esa linea */
                                    $salida .= $line."<br>";
                               }
                          }
                    }
                }
                /* cierra el txt */
                fclose($file);
                echo $salida;
                ?>
                    
                
            
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" style="width: 100px;">Cerrar</button>
        </div>

        </div>
    </div>
</div>