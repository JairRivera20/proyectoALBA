<?php 
session_start();
if (empty($_SESSION["Id_usuario"])) {
    header("location: ../../login/login.php");
}else if (!empty($_SESSION["Rol"] != 3)) {

    session_start();
    session_destroy();
    header("location: ../../login/login.php");
}

include "../../config/conexion.php";
$sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
$alt=$sql->fetch_object();
if ($alt!=null) {

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resultados</title>
    <link rel="stylesheet" href="http://localhost/proyectoalba/css/resultados3.css">
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

$sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
$data=$sql->fetch_object();
$evento=$data->Id_evento;

$sqlCliente   = ("SELECT * FROM evento");
$queryCliente = mysqli_query($conexion, $sqlCliente);
$cantidad     = mysqli_num_rows($queryCliente);

$altsqlCliente   = ("SELECT cerveza.Id_cerveza, categorias.Nombre AS Categoria, estilos.Nombre AS Estilo, cerveza.Nombre AS Cerveza,cerveza.Codigo, usuarios.Nombre AS Usuario, rango_competidor.Nombre AS Rango 
FROM cerveza 
INNER JOIN usuarios ON cerveza.fk_usuario=usuarios.Id_usuario
INNER JOIN estilos ON cerveza.fk_estilo=estilos.Id_estilo
INNER JOIN categorias ON estilos.fk_categoria=categorias.Id_categoria
INNER JOIN rango_competidor ON usuarios.fk_rango_competidor=rango_competidor.Id_rango_competidor
INNER JOIN evento_usuarios ON usuarios.Id_usuario=evento_usuarios.fk_usuarios
INNER JOIN evento ON evento_usuarios.fk_evento=evento.Id_evento
WHERE evento.Id_evento=$evento AND cerveza.Pendiente=1
ORDER BY Usuario ASC");
$altqueryCliente = mysqli_query($conexion, $altsqlCliente);
$altcantidad     = mysqli_num_rows($altqueryCliente);

include('ModalAceptar.php'); 
include('ModalRechazar.php'); 

?>
<div class="res">
    <br><br><br>
    <div class="tabla">        
        <h4 class="">Resultados || <?=$data->Nombre?></h4>
        
        <table class="">
            
            <thead>
                <tr>
                    <!-- <th scope="col">Id juzgamiento</th> -->
                    <th scope="col">Nombre de la cerveza</th>
                    <!-- <th scope="col">Cóodigo de la cerveza</th> -->
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
                
                $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
                $alt=$sql->fetch_object();
                $evento=$alt->Id_evento;

                $sql=$conexion->query("SELECT general.Id, cerveza.Nombre, categorias.Nombre AS Categoria, estilos.Nombre AS Estilo, general.Ejemplo, general.Sin_fallas, general.Maravilloso, general.Comentario, general.Fallas, general.Nota, general.Aroma, general.Apariencia, general.Sabor, general.Sensacion 
                FROM evento_usuarios
                INNER JOIN evento ON evento_usuarios.fk_evento=evento.Id_evento
                INNER JOIN usuarios ON evento_usuarios.fk_usuarios=usuarios.Id_usuario
                INNER JOIN cerveza ON usuarios.Id_usuario=cerveza.fk_usuario
                INNER JOIN general ON general.fk_cerveza=cerveza.Id_cerveza
                INNER JOIN estilos ON cerveza.fk_usuario=estilos.Id_estilo
                INNER JOIN categorias ON estilos.fk_categoria=categorias.Id_categoria
                WHERE evento.Id_evento=$evento AND general.Juzgado=1");
                /* se crea un while para listar los datos y se repite la la cantidad de filas de la tabla*/
                while($datos=$sql->fetch_object()){ 
                ?>
                    <tr>
                        <!-- se debe colocar el nombre de los atributos de la tabla que se mostrarán en la tabla -->
                        <!-- <td><?=$datos->Id?></td> -->
                        <td><?=$datos->Nombre?></td>
                        <td><?=$datos->Categoria?></td>
                        <td><?=$datos->Estilo?></td>
                        <!-- <td><?=$datos->Codigo?></td> -->
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
                            
                        <!-- <td>
                            <a href="modificar_juzgamiento.php?Id=<?=$datos->Id?>" ><i class="bi bi-pencil"></i></a>
                        </td> -->
                            
                        <!-- <td>
                            <a onclick="return eliminar()" href="index.php?Id=<?=$datos->Id?>"><i class="bi bi-trash"></i></a>
                        </td> -->


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
                    
                    
                    <td>
                        Filtro:
                    </td>
                    
                    <td>
                        <button type="button" style="background: #39A900; font-size: 15px;  border:yellow" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#editChildresn">
                        <!-- <i class="bi bi-clipboard-data" style="padding-right: 10px;"></i> -->
                            Evento
                        </button>
                    </td>   

                    <td>
                        <button type="button" style="background: #39A900; font-size: 15px;  border:yellow" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#deleteChildresn">
                            Cerveza
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
            <a href="../inicioParticipante.php"><button type="button" >Regresar</button></a>
        </div>
    </div>
</div>

<?php
}else{
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="stylesheet" href="http://localhost/proyectoalba/css/resultados3.css">
    <link rel="stylesheet" href="../../css/resultados3.css">
    <link rel="icon" href="../../img/Logo.png">
    <!-- llamada de iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </head>
    <body>
    
        <div class="formulario" style="text-align:center;color:white;margin-top:10%;">
            <h2 >
                
                No hay registros disponibles
            </h2>
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
            <a href="../inicioParticipante.php"><button type="button" >Regresar</button></a>
        </div>
        </div>
        
    </body>
    </html>
<?php
}
?>




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
$('.btnBorrar').click(function(e){
        e.preventDefault();
        var id = $(this).attr("id");

        var dataString = 'id='+ id;
        url = "controlador/rechazar.php";
            $.ajax({
                type: "POST",
                url: url,
                data: dataString,
                success: function(data)
                {
                  window.location.href="index.php";
                  $('#respuesta').html(data);
                }
            });
    return false;

    });

</script>



</body>
</html>