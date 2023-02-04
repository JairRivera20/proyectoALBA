<?php 
session_start();
if (empty($_SESSION["Id_usuario"])) {
    header("location: ../../login/login.php");
}else if (!empty($_SESSION["Rol"] != 2)) {

    session_start();
    session_destroy();
    header("location: ../../login/login.php");
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resultados</title>


    <link rel="stylesheet" href="../../css/resultados3.css">
    <link rel="icon" href="../../img/Logo.png">
    <!-- llamada de iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

  <!-- jquery  -->
  <script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4=" crossorigin="anonymous"></script>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
</head>
<body>
<script>
    function eliminar(){
        var respuesta=confirm("Estás a punto de eliminar un JUZGAMIENTO. ¿Deseas eliminar?");
        return respuesta
    };
</script>




<?php

include('modelo/conexion.php');
$sqlCliente   = ("SELECT categorias.Id_categoria,categorias.Nombre 
FROM categorias
INNER JOIN estilos ON categorias.Id_categoria=estilos.fk_categoria
INNER JOIN cerveza ON estilos.Id_estilo = cerveza.fk_estilo
INNER JOIN general on cerveza.Id_cerveza=general.fk_cerveza
WHERE cerveza.fk_estilo = estilos.Id_estilo AND general.Juzgado=1
GROUP BY categorias.Nombre
ORDER BY categorias.Id_categoria ASC");
$queryCliente = mysqli_query($conexion, $sqlCliente);
$cantidad     = mysqli_num_rows($queryCliente);

?>
<?php  include('ModalAceptar.php'); ?>
<div class="res">
    <br><br><br>
    <div class="tabla">        
        <h3 class="">Resultados</h3>
        
        <table class="">
            
            <thead>
                <tr>
                <!-- <th scope="col">Id juzgamiento</th> -->
                <th scope="col">Nombre de la cerveza</th>
                <th scope="col">Categoría</th>
                <th scope="col">Estilo</th>
                <th scope="col">Aroma /12</th>
                <th scope="col">Apariencia /3</th>
                <th scope="col">Sabor /20</th>
                <th scope="col">Sensacion /5</th>
                <!-- <th scope="col">Fallas</th> -->
                <th scope="col">Estilo /13</th>
                <th scope="col">Virtud /13</th>
                <th scope="col">Aspecto /13</th>
                <!-- <th scope="col">Comentario</th> -->
                <th scope="col">Nota /10</th>
                <th scope="col">Estadisticas</th>
                </tr>
            </thead>
            <tbody>
                <!-- se muestran datos de la tabla y se hace la consulta -->
                <?php
                include "modelo/conexion.php";
                $sql=$conexion->query("SELECT Id,cerveza.Nombre, categorias.Nombre AS Categoria, estilos.Nombre AS Estilo, Ejemplo, Sin_fallas, Maravilloso, Comentario, Fallas, Nota, Aroma, Apariencia, Sabor, Sensacion 
                FROM general 
                INNER JOIN cerveza ON general.fk_cerveza=cerveza.Id_cerveza
                INNER JOIN estilos ON cerveza.fk_estilo=estilos.Id_estilo
                INNER JOIN categorias ON estilos.fk_categoria=categorias.Id_categoria
                WHERE general.Juzgado=1");
                /* se crea un while para listar los datos y se repite la la cantidad de filas de la tabla*/
                while($datos=$sql->fetch_object()){ 
                ?>
                    <tr>
                        <!-- se debe colocar el nombre de los atributos de la tabla que se mostrarán en la tabla -->
                        <!-- <td><?=$datos->Id?></td> -->
                        <td><?=$datos->Nombre?></td>
                        <td><?=$datos->Categoria?></td>
                        <td><?=$datos->Estilo?></td>
                        <td><?=$datos->Aroma?></td>
                        <td><?=$datos->Apariencia?></td>
                        <td><?=$datos->Sabor?></td>
                        <td><?=$datos->Sensacion?></td>
                        <!-- <td><?=$datos->Fallas?></td> -->
                        <td><?=$datos->Ejemplo?></td>
                        <td><?=$datos->Sin_fallas?></td>
                        <td><?=$datos->Maravilloso?></td>
                        <!-- <td><?=$datos->Comentario?></td> -->
                        <td><?=$datos->Nota?></td>
                        
                         <!-- iconos llamados mediante scrpit de font-awesome -->
                         <td>
                            <!-- redireccionamos a la pagina de modificacion y mandamos consigo el valor que hay en la variable -->
                            <a href="stats.php?Id=<?=$datos->Id?>" ><i class="bi bi-graph-up-arrow"></i></a>
                        </td>
                    </tr>
                    <!-- abrimos php para cerrar el html y php -->
                <?php }
                ?>
            </tbody>
            <tfooter>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                    
                    <td>
                        <button type="button" style="background: #39A900; border:yellow" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#editChildresn">
                        <i class="bi bi-clipboard-data"></i>
                            General
                        </button>
                    </td>
                </tr>
                
            </tfooter>
            
        </table>

        <div class="boton">
            <style>
            .boton button{
                width: 100px;
                border: none;
                outline: none;
                height: 40px;
                background: #39A900;
                color: #fff;
                font-size: 18px;
                border-radius: 20px;
                transition: all 300ms;
                cursor: pointer;
            }

            .boton button:hover{
                transform: scale(1.10);
            }
            </style>
            <button type="button" onclick="history.back()" >Regresar</button>
        </div>

    </div>
</div>
<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4=" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $(window).on('load',function() {
            $(".cargando").fadeOut(1000);
        });

//Ocultar mensaje
    setTimeout(function () {
        $("#contenMsjs").fadeOut(1000);
    }, 3000);
});
</script>



</body>
</html>