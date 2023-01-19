<?php
session_start();
if (empty($_SESSION["Id_usuario"])) {
    header("location: ../login/login.php");
}else if (!empty($_SESSION["Rol"] != 3)) {

    session_start();
    session_destroy();
    header("location: ../login/login.php");
}
$id = $_SESSION["Id_usuario"];
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
    <title>Cervezas</title>
    <link rel="stylesheet" href="http://localhost/proyectoalba/css/inscripcionCerveza.css">
    <link rel="stylesheet" href="../css/inscripcionCerveza.css">
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
        include("menuParticipante.php");
        $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
            $alt=$sql->fetch_object();
                if ($alt!=null) {
    ?>

    <div class="form">

        <!-- formulario para rellenar la tabla de la basae de datos -->
        <form method="POST">
            <h4>Registro cerveza</h4>
            <!-- mostramos el resultado de la comprobacion -->
            <?php            
            include "controladoresCervezas/controladorCervezas.php";
            include "controladoresCervezas/codigoRamdon.php";
            
            ?>
            <!-- formulario para el ingreso de datos a la base de datos -->
            <div class="form-group row">                
                <div class="mb-2 col-sm-14">
                    <label>Nombre de la cerveza</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="mb-2 col-sm-14">
                    <label>Código</label>
                    <input type="text" class="form-control" name="codigo" id="codigo" value="<?=$cod?>" readonly>                
                    
                </div>
                <!-- toma el ID del participante para saber quien inscribio la cerveza -->
                <div class="mb-2 col-sm-14">
                    <input type="hidden" id="usuario" name="usuario" value="<?=$id?>">
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
            </div>
            <!-- -------------------------------------------------------------------------- -->
            <input type="submit" value="Registrar" name="btnregistrar" class="btn btn-primary">
        </form>

        <!-- formulario para rellenar la tabla de la basae de datos -->

    </div>

    <?php
                }else {
                    echo "<div class='form' style='color: white;
                    margin-top: 20%;
                    padding: 0 0 20px 0;
                    text-align: center;
                    color: #fff;
                    font-size: 50px;'>No hay registros suficientes</div>";
                }
            ?>
        
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>