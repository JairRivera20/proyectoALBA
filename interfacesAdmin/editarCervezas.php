<?php
session_start();
if (empty($_SESSION["Id_usuario"])) {
    header("location: ../login/login.php");
}else if (!empty($_SESSION["Rol"] != 1)) {

    session_start();
    session_destroy();
    header("location: ../login/login.php");
}
?>

<?php
include "../config/conexion.php";
if(!$conexion){
  die("<br/>Sin conexi&oacute;n.");
};

/*obtenemos los datos del primer select para categorias*/
$sql = "SELECT * FROM categorias";
$query = mysqli_query($conexion, $sql);
$filas = mysqli_fetch_all($query, MYSQLI_ASSOC); 
mysqli_close($conexion);
?>
<?php

include "../config/conexion.php";

/* obtenemos los datos de usuario */
$sql_2 = "SELECT usuarios.Id_usuario, usuarios.Nombre, rango_competidor.Nombre AS Rango 
FROM usuarios 
INNER JOIN rango_competidor ON rango_competidor.Id_rango_competidor=usuarios.fk_rango_competidor
WHERE Rol != 1 AND Rol !=2";
$query_2 = mysqli_query($conexion, $sql_2);
$filas_2 = mysqli_fetch_all($query_2, MYSQLI_ASSOC); 
mysqli_close($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cervezas</title>

    <link rel="stylesheet" href="../css/editarCervezas3.css">
    <link rel="icon" href="../img/Logo.png">
    <!-- llamada de iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- llamada de jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <!-- alerta para confirmar eliminacion de usuario -->
    <script>
        function eliminar(){
            var respuesta=confirm("Estás a punto de ELIMINAR una cerveza. ¿Deseas ELIMINAR?");
            return respuesta
        }
    </script>


<!-- script para el select hijo -->
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
              url: './controladoresCervezas/getEstilos.php' //url que recibe las variables
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
<!-- obtiene el value de un option -->
<script>
    function fillBook(){    
        var select_nombre = document.getElementById('nombre').value;
        var select_codigo = document.getElementById('codigo').value;
        var select_usuario = document.getElementById('usuario').value;
        var select_hijo = document.getElementById('estilos').value;
        console.log('nombre -> '+select_nombre);
        console.log('codigo -> '+select_codigo);
        console.log('usuario -> '+select_usuario);
        console.log('estilos -> '+select_hijo);
    }
</script>

</head>

    <?php 
        include("menuAdmin.php");
        
        $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
        $alt=$sql->fetch_object();
        if ($alt!=null) {
        include "../config/conexion.php";
    ?>

    <div class="form">
            <?php
                include "controladorEliminarCervezas/controladorEliminarCervezas.php";
            ?>
        <!-- formulario para rellenar la tabla de la basae de datos -->
        <form method="POST">
            <h4>Registrar nueva cerveza</h4>
            <!-- mostramos el resultado de la comprobacion -->
            <?php            
            include "controladoresCervezas/controladorCervezas.php";
            include "controladoresCervezas/codigoRamdon.php";
            
            ?>
            <!-- formulario para el ingreso de datos a la base de datos -->
            <div class="form-group row">                
                <div class="mb-2 col-sm-14">
                    <label>Código</label>
                    <input type="text" class="form-control" name="codigo" id="codigo" value="<?=$cod?>" readonly>                
                    
                </div>
                <div class="mb-2 col-sm-14">
                    <select id="usuario" name="usuario" type="number" class="form-control">
                        <option value="" selected disabled> Seleccione usuario </option>
                        <?php foreach ($filas_2 as $op_2): //llenar las opciones del select usuario ?>
                        <option value="<?= $op_2['Id_usuario'] ?>"><?= $op_2['Nombre']." - ".$op_2['Rango']?></option>  
                        <?php endforeach; ?>
                    </select>                
                </div>
                <div class="mb-2 col-sm-14" >
                    <!-- select padre -->
                    <select id="categorias" class="form-control" name="categorias" type="number">
                        <option value="" selected disabled> Seleccione categoría </option>
                        <?php foreach ($filas as $op): //llenar las opciones del select padre ?>
                        <option value="<?= $op['Id_categoria']?>"><?= $op['Nombre'] ?></option>  
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- select hijo -->
                <div class="mb-2 col-sm-14" >
                    <select id="estilos" type="number" disabled="" class="form-control" name="estilos" onchange="fillBook();">
                        <option value="" selected disabled> Seleccione estilo </option>
                    </select>
                </div>                              
                <div class="mb-2 col-sm-14">
                    <label>N° muestras</label>
                    <input type="number" class="form-control" id="muestras" name="muestras">
                </div>
            </div>
            <!-- -------------------------------------------------------------------------- -->
            <input type="submit" value="Registrar" name="btnregistrar" class="btn btn-primary">
        </form>
    </div>
    <div>

            <?php
                /* que ese ultimo evento no sea vacío */
                $check=$alt->Nombre;
                if ($check!='') {
                include "../config/conexion.php";
               

            ?>
        <!-- division inferior para la ver el listado -->
        <div class="table-responsive">
            <div class="tabla">
                
                <h4 class="text-center text-secondary">Cervezas participes || <?=$alt->Nombre?></h4>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                        
                        <th scope="col">Código</th>
                        <th scope="col">Participante</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Estilo</th>
						<th scope="col">N° muestras</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- se muestran datos de la tabla y se hace la consulta -->
                        <?php
                        include "../config/conexion.php";
                        $sql=$conexion->query("SELECT cerveza.Id_cerveza, cerveza.Muestras, cerveza.Codigo, usuarios.Nombre AS Usuario, estilos.Nombre AS Estilo, categorias.Nombre AS Categoria
                        FROM cerveza 
                        INNER JOIN usuarios ON cerveza.fk_usuario=usuarios.Id_usuario
                        INNER JOIN estilos ON estilos.Id_estilo=cerveza.fk_estilo
                        INNER JOIN categorias ON categorias.Id_categoria=estilos.fk_categoria AND estilos.Id_estilo = cerveza.fk_estilo
                        INNER JOIN evento_usuarios ON usuarios.Id_usuario=evento_usuarios.fk_usuarios
                        INNER JOIN evento ON evento_usuarios.fk_evento=evento.Id_evento
                        WHERE evento_usuarios.fk_evento=($alt->Id_evento) AND usuarios.Rol!=1");
                        /* se crea un while para listar los datos y se repite la la cantidad de filas de la tabla*/
                        while($datos=$sql->fetch_object()){ 
                        ?>
                            <tr>
                                <!-- se debe colocar el nombre de los atributos de la tabla que se mostrarán en la tabla -->
                                <!-- <td><?=$datos->Id_cerveza?></td> -->
                                
                                <td><?=$datos->Codigo?></td>
                                <td><?=$datos->Usuario?></td>
                                <td><?=$datos->Categoria?></td>
                                <td><?=$datos->Estilo?></td>
								<td><?=$datos->Muestras?></td>
                                <!-- iconos llamados mediante scrpit de font-awesome -->
                                <td>
                                    <!-- redireccionamos a la pagina de modificacion y mandamos consigo el valor que hay en la variable -->
                                    <a href="modificarCervezas/modificarCervezas.php?Id_cerveza=<?=$datos->Id_cerveza?>"class="btn btn-small btn-warning"><i class="bi bi-pencil"></i></a>
                                </td>

                                <td>    
                                    <a onclick="return eliminar()" href="editarCervezas.php?Id_cerveza=<?=$datos->Id_cerveza?>"class="btn btn-small btn-danger"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            <!-- abrimos php para cerrar el html y php -->
                        <?php }
                        ?>
                    </tbody>
                </table>
                
            </div>
        </div>
        <?php
            /* cervezas del evento anterior */
            }else {
                $sql = $conexion->query("SELECT * FROM evento ORDER BY Id_vento DESC LIMIT 1,1 ");
                $alt=$sql->Nombre
                ?>
                <div class="table-responsive">
                    <div class="tabla">
                
                    <h4 class="text-center text-secondary">Cervezas participes || <?=$alt->Nombre?></h4>
                    <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                        <!-- <th scope="col">Id cerveza</th> -->
                        <th scope="col">Nombre</th>
                        <th scope="col">Código</th>
                        <th scope="col">Participante</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Estilo</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- se muestran datos de la tabla y se hace la consulta -->
                        <?php
                        include "../config/conexion.php";
                        $sql=$conexion->query("SELECT cerveza.Id_cerveza, cerveza.Nombre, cerveza.Codigo, usuarios.Nombre AS Usuario, estilos.Nombre AS Estilo, categorias.Nombre AS Categoria
                        FROM cerveza 
                        INNER JOIN usuarios ON cerveza.fk_usuario=usuarios.Id_usuario
                        INNER JOIN estilos ON estilos.Id_estilo=cerveza.fk_estilo
                        INNER JOIN categorias ON categorias.Id_categoria=estilos.fk_categoria AND estilos.Id_estilo = cerveza.fk_estilo
                        INNER JOIN evento_usuarios ON usuarios.Id_usuario=evento_usuarios.fk_usuarios
                        INNER JOIN evento ON evento_usuarios.fk_evento=evento.Id_evento
                        WHERE evento_usuarios.fk_evento=($alt->Id_evento) AND usuarios.Rol!=1");
                        /* se crea un while para listar los datos y se repite la la cantidad de filas de la tabla*/
                        while($datos=$sql->fetch_object()){ 
                        ?>
                            <tr>
                                <!-- se debe colocar el nombre de los atributos de la tabla que se mostrarán en la tabla -->
                                <!-- <td><?=$datos->Id_cerveza?></td> -->
                                <td><?=$datos->Nombre?></td>
                                <td><?=$datos->Codigo?></td>
                                <td><?=$datos->Usuario?></td>
                                <td><?=$datos->Categoria?></td>
                                <td><?=$datos->Estilo?></td>
                                <!-- iconos llamados mediante scrpit de font-awesome -->
                                <td>
                                    <!-- redireccionamos a la pagina de modificacion y mandamos consigo el valor que hay en la variable -->
                                    <a href="modificarCervezas/modificarCervezas.php?Id_cerveza=<?=$datos->Id_cerveza?>"class="btn btn-small btn-warning"><i class="bi bi-pencil"></i></a>
                                </td>

                                <td>    
                                    <a onclick="return eliminar()" href="editarCervezas.php?Id_cerveza=<?=$datos->Id_cerveza?>"class="btn btn-small btn-danger"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            <!-- abrimos php para cerrar el html y php -->
                        <?php }
                        ?>
                    </tbody>
                </table>
                
                </div>
            </div>
                <?php
            }
            ?>

            <?php
                    }else {
                        echo "<div style='color: white;
                        margin-top: 20%;
                        padding: 0 0 20px 0;
                        text-align: center;
                        color: #fff;
                        font-size: 50px;'>Debes registrar al menos un evento</div>";
                    }
                ?>

    </div>
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>