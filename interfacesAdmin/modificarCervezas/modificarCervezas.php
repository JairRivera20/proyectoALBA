<?php
include "../../config/conexion.php";
if(!$conexion){
  die("<br/>Sin conexi&oacute;n.");
};

/*obtenemos los datos del primer select para categorias*/
$sql = "SELECT * FROM categorias";
$query = mysqli_query($conexion, $sql);
$filas = mysqli_fetch_all($query, MYSQLI_ASSOC); 

?>
<?php

include "../../config/conexion.php";

/* obtenemos los datos de usuario */
$sql_2 = "SELECT * FROM usuarios";
$query_2 = mysqli_query($conexion, $sql_2);
$filas_2 = mysqli_fetch_all($query_2, MYSQLI_ASSOC); 


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modificar cervezas</title>

    <link rel="stylesheet" href="../../css/modificarCervezas3.css">
    <link rel="icon" href="../../img/Logo.png">
</head>

<script type="text/javascript">
    $(document).ready(function(){
        var estilos = $('#estilos');
        var estilos_sel = $('#estilos_sel');

        //Ejecutar accion al cambiar de opcion en el select de las bandas
        $('#categorias').change(function(){
          var Id_categoria = $(this).val(); //obtener el id seleccionado

          if(Id_categoria !== ''){ //verificar haber seleccionado una opcion valida

            /*Inicio de llamada ajax*/
            $.ajax({
              data: {Id_categoria:Id_categoria}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
              dataType: 'html', //tipo de datos que esperamos de regreso
              type: 'POST', //mandar variables como post o get
              url: './controlador/get_estilos.php' //url que recibe las variables
            }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion             

              estilos.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
              estilos.prop('disabled', false); //habilitar el select
            });
            /*fin de llamada ajax*/

          }else{ //en caso de seleccionar una opcion no valida
            estilos.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
            estilos.prop('disabled', true); //deshabilitar el select
          }    
        });

    });
</script>
<body>
    <div class="espacio">
        <div class="container">
            <form class="form-horizontal p-5 m-auto" method="POST">
                <h4 class="text-center text-secondary">Modificar cervezas</h4>
                <input type="hidden" name="Id_cerveza" value="<?= $_GET["Id_cerveza"] ?>">
                <!-- aqui se toma el id mediante el name que mandamos desde el index para la modificacion -->
                <?php
                    include "controladorModificarCervezas.php";
                    include "../../config/conexion.php";
                    $Id_cerveza=$_GET["Id_cerveza"];

                    $sql=$conexion->query(
                    "SELECT cerveza.Id_cerveza, cerveza.Nombre, cerveza.Codigo, usuarios.Nombre AS Usuario,  usuarios.Id_usuario, estilos.Nombre AS Estilo, estilos.Id_estilo, categorias.Nombre AS Categoria
                    FROM cerveza 
                    INNER JOIN usuarios ON cerveza.fk_usuario=usuarios.Id_usuario
                    INNER JOIN estilos ON estilos.Id_estilo=cerveza.fk_estilo
                    INNER JOIN categorias ON categorias.Id_categoria=estilos.fk_categoria AND estilos.Id_estilo = cerveza.fk_estilo
                    WHERE Id_cerveza=$Id_cerveza");
                
                    /* recorre los datos y los va mostrando */
                    while ($datos=$sql->fetch_object()) {?>

                    <div class="form-group row">
                        <!-- en cada input se debe agregar el "value" que tienen las variables para mostrar -->
                        <div class="mb-2 col-sm-10">
                            <!-- solo el administrador podrá ver esta interfaz que permite visualizar el id, en las demás debe ser oculto/hidden -->
                            <label for="Id_cerveza">Id Cerveza</label>
                            <input type="number" class="form-control" name="Id_cerveza" value="<?= $datos->Id_cerveza?>" readonly>
                            <!-- ------------------------------------------------------------------------------------------------------- -->
                        </div>
                        <div class="mb-2 col-sm-10">
                            <label for="nombre">Nombre de la cerveza</label>
                            <input type="text" class="form-control" name="nombre" value="<?= $datos->Nombre?>">
                        </div>
                        <div class="mb-2 col-sm-10">      
                            <label for="codigo">Código de la cerveza</label>                  
                            <input type="text" class="form-control" name="codigo" value="<?= $datos->Codigo?>" readonly>                
                        </div>
                        <div class="mb-2 col-sm-10">
                            <label for="usuario">Nombre del usuario</label>
                            <select id="usuario" name="usuario" type="number" class="form-control">
                                <option value="<?= $datos->Id_usuario?>"><?= $datos->Usuario?></option>
                                <?php foreach ($filas_2 as $op_2): //llenar las opciones del select usuario ?>
                                <option value="<?= $op_2['Id_usuario'] ?>"><?= $op_2['Nombre'] ?></option>  
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-2 col-sm-10">
                            <label for="categorias">Categoría</label>
                            <select id="categorias" class="form-control" name="categorias" type="number">
                                <option value=""><?= $datos->Categoria?></option>
                                <?php foreach ($filas as $op): //llenar las opciones del select padre ?>
                                <option value="<?= $op['Id_categoria']?>"><?= $op['Nombre'] ?></option>  
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-2 col-sm-10">
                            <label for="estilos">Estilo</label>
                            <select id="estilos" type="number" class="form-control" name="estilos">
                                <option value="<?=$datos->Id_estilo?>"><?=$datos->Estilo?></option>
                            </select>
                        </div>                  
                    </div>  
                <?php 
                    }
                ?>
                <br>
                <!-- -------------------------------------------------------------------------- -->
                <button type="submit" name="btnmodificarcerveza" value="ok">Guardar cambios</button>
                <input type="button" onclick="history.back()" name="volver atrás" value="Regresar"></input> 
            </form>
        </div>
    </div>
</body>
</html>