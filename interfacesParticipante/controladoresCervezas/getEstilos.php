<?php
require_once '../../config/conexion.php'; //libreria de conexion a la base

$id_categoria = filter_input(INPUT_POST, 'Id_categoria'); //obtenemos el parametro que viene de ajax

if($id_categoria != ''){ //verificamos nuevamente que sea una opcion valida
  if(!$conexion){
    die("<br/>Sin conexi&oacute;n.");
  }

  /*Obtenemos los discos de la banda seleccionada*/
  $sql = "SELECT Id_estilo, Nombre FROM estilos WHERE fk_categoria = ".$id_categoria;  
  $query = mysqli_query($conexion, $sql);
  $filas = mysqli_fetch_all($query, MYSQLI_ASSOC); 
  mysqli_close($conexion);
}

/**
 * Como notaras vamos a generar código `html`, esto es lo que sera retornado a `ajax` para llenar 
 * el combo dependiente
 */
?>


<option value="" name="estilos" id="estilos" selected disabled> Seleccione estilo </option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $op['Id_estilo']?>"><?= $op['Nombre'] ?></option>
<?php endforeach; ?>