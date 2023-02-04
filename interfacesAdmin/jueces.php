<?php

session_start();
if (empty($_SESSION["Id_usuario"])) {
    header("location: ../../login/login.php");
}else if (!empty($_SESSION["Rol"] != 1)) {

    session_start();
    session_destroy();
    header("location: ../login/login.php");
};

include "../config/conexion.php";
if(!$conexion){
  die("<br/>Sin conexi&oacute;n.");
};
$sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
$alt=$sql->fetch_object();

if ($alt!=null) {
    $evento=$alt->Id_evento;

/*obtenemos los datos del primer select para categorias*/
$sql = "SELECT cerveza.Id_cerveza, cerveza.Nombre, cerveza.Codigo, categorias.Nombre AS categoria, estilos.Nombre AS estilo
FROM evento_usuarios
INNER JOIN evento ON evento_usuarios.fk_evento=evento.Id_evento
INNER JOIN usuarios ON evento_usuarios.fk_usuarios = usuarios.Id_usuario
INNER JOIN cerveza ON usuarios.Id_usuario=cerveza.fk_usuario
INNER JOIN estilos ON cerveza.fk_estilo = estilos.Id_estilo 
INNER JOIN categorias ON estilos.fk_categoria=categorias.Id_categoria
WHERE evento.Id_evento=$evento && cerveza.Pendiente=1";
$query = mysqli_query($conexion, $sql);
$filas = mysqli_fetch_all($query, MYSQLI_ASSOC); 



include "../config/conexion.php";

/* obtenemos los datos de usuario */
$sql_2 = "SELECT usuarios.Id_usuario, usuarios.Nombre, rango_juez.Nombre AS Rango
FROM evento_usuarios 
INNER JOIN evento ON evento_usuarios.fk_evento = evento.Id_evento
INNER JOIN usuarios ON evento_usuarios.fk_usuarios=usuarios.Id_usuario
INNER JOIN rango_juez ON usuarios.fk_rango_juez=rango_juez.Id_rango_juez
WHERE usuarios.Rol=2 AND evento.Id_evento=$evento";
$query_2 = mysqli_query($conexion, $sql_2);
$filas_2 = mysqli_fetch_all($query_2, MYSQLI_ASSOC); 
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar mesas/jueces</title>

    <link rel="stylesheet" href="../css/jueces2.css">
    <link rel="icon" href="../img/Logo.png">

    <!-- llamada de iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<script>
    function reestablecer() {
		setTimeout(() => {
			document.getElementById('form').reset();
		}, 100);

        
    };
    function eliminar(){
        var respuesta=confirm("Estás a punto de eliminar un JUZGAMIENTO. ¿Deseas eliminar?");
        return respuesta
    };
    
</script>
</head>

    <?php 
        include "menuAdmin.php";
    ?>
    

    <!-- division de la pantalla hacia la izquierda -->

    <div class="formulario">
            <?php
                include "../config/conexion.php";
                include "controladorJueces/eliminarJuez.php";
            ?>

        <!-- formulario para rellenar la tabla de la basae de datos -->

        <form class="form-horizontal p-5" id="formul" method="POST">

            <h3 class="text-center text-secondary">Asignar jueces y cervezas</h3>
            
                <!-- <h4 class="text-left text-secondary">Juez</h4> -->

                <!-- mostramos el resultado de la comprobacion -->

                <?php            
                include "./controladorJueces/asignarJuez.php";
                ?>

                <!-- formulario para el ingreso de datos a la base de datos -->
                <div class="form-group row">
                    <?php
                    include "../config/conexion.php";
                    $sql=$conexion->query("SELECT Id FROM general ORDER BY Id DESC LIMIT 0,1");
                    $next=$sql->fetch_object();
                    ?>
                    <!--  -->
                    <div>
                        <?php
                        if ($next!=null) {
                            ?>
                            
                            <?php
                        }else {
                            ?>
                            <input type="hidden" name="Id_juz"  value="1" readonly>
                            <?php
                        }
                        ?>
                        
                    </div>
                    <!--  -->

                    <div>
                        <!-- <label>Digite mesa...</label> -->
                        <input type="number" class="form-control" name="mesa" placeholder="Digite mesa...">
                    </div>
                    
                </div>
                
                <div class="mb-2 col-sm-14">

                    <select id="cerveza" class="form-control" name="cerveza" type="number">
                        <option value="" selected disabled>- Seleccione cerveza -</option>
                        <?php foreach ($filas as $op): //llenar las opciones del select padre ?>
                        <option value="<?= $op['Id_cerveza']?>"><?=$op['categoria']," - ",$op['estilo']," - ",$op['Nombre']?></option>  
                        <?php endforeach; ?>
                    </select>

                    <select id="usuario" name="usuario" type="number" class="form-control">
                        <option value="" selected disabled>- Seleccione usuario -</option>
                        <?php foreach ($filas_2 as $op_2): //llenar las opciones del select usuario ?>
                            <option value="<?= $op_2['Id_usuario'] ?>"><?= $op_2['Nombre']," - ",$op_2['Rango']?></option>   
                        <?php endforeach; ?>
                    </select>

                </div>
            
            <button type="submit" class="btn btn-primary" name="btnasignar" value="ok" onclick="reestablecer()">Registrar</button>
            
        </form>
    
    </div>
    <div  class="table-responsive">
        <div class="tabla">        
            <h3 class="text-center text-secondary">Jueces y cervezas asignadas || <?=$alt->Nombre?></h3>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                    <!-- <th scope="col">Id juzgamiento</th> -->
                    <!-- <th scope="col">Id usuario</th> -->
                    <th scope="col">Nombre de la cerveza</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Estilo</th>
                    <th scope="col">Código de la cerveza</th>
                    <th scope="col">Juez</th>
                    <th scope="col">Mesa</th>
                    <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- se muestran datos de la tabla y se hace la consulta -->
                    <?php
                    include "../config/conexion.php";
                    

                    $sql=$conexion->query("SELECT evento_usuarios.fk_evento,evento_usuarios.fk_usuarios,general.Id,general.fk_usuario, (SELECT Nombre FROM usuarios WHERE Id_usuario=general.fk_usuario) AS Usuario, 
                    cerveza.Nombre AS Cerveza, categorias.Nombre AS Categoria, estilos.Nombre AS Estilo, cerveza.Codigo, general.Mesa
                    FROM evento_usuarios
                    INNER JOIN evento ON evento_usuarios.fk_evento=evento.Id_evento
                    INNER JOIN usuarios ON evento_usuarios.fk_usuarios=usuarios.Id_usuario
                    INNER JOIN cerveza ON usuarios.Id_usuario=cerveza.fk_usuario
                    INNER JOIN general ON general.fk_cerveza=cerveza.Id_cerveza
                    INNER JOIN estilos ON cerveza.fk_usuario=estilos.Id_estilo
                    INNER JOIN categorias ON estilos.fk_categoria=categorias.Id_categoria
                    WHERE evento.Id_evento=$evento AND general.Juzgado=0");
                    /* se crea un while para listar los datos y se repite la la cantidad de filas de la tabla*/
                    while($datos=$sql->fetch_object()){ 
                    ?>
                        <tr>
                            <!-- se debe colocar el nombre de los atributos de la tabla que se mostrarán en la tabla -->
                            <!-- <td><?=$datos->Id?></td>
                            <td><?=$datos->fk_usuario?></td>
                            <td><?=$datos->Nombre?></td> -->

                            <td><?=$datos->Cerveza?></td>
                            <td><?=$datos->Categoria?></td>
                            <td><?=$datos->Estilo?></td>
                            <td><?=$datos->Codigo?></td>                        
                            <td><?=$datos->Usuario?></td>
                            <td><?=$datos->Mesa?></td>
                            
                            <!-- iconos llamados mediante scrpit de font-awesome -->
                            <td>
                                <!-- redireccionamos a la pagina de modificacion y mandamos consigo el valor que hay en la variable -->
                                <a onclick="return eliminar()" href="jueces.php?Id=<?=$datos->Id?>"class="btn btn-small btn-danger"><i class="bi bi-trash"></i></a>
                                
                            </td>
                        </tr>
                        <!-- abrimos php para cerrar el html y php -->
                    <?php }
                    ?>
                </tbody>
            </table>

        </div>
    </div>

    
</body>
</html>

<?php
}else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar mesas/jueces</title>
    <link rel="stylesheet" href="http://localhost/proyectoalba/css/jueces4.css">
    <link rel="stylesheet" href="../css/jueces4.css">
    <link rel="icon" href="../img/LOGO ALBA V.png">
    <!-- llamada de iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </head>
    
        <?php include "menuAdmin.php";?>
        <h2 class="container" style="color:white; text-align:center; margin-top:10%">
            No hay registros disponibles
        </h2>
    </body>
    </html>
    <?php
}
?>
