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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evento</title>
    <link rel="stylesheet" href="http://localhost/proyectoalba/css/eventoAdmin2.css">
    <link rel="stylesheet" href="../css/eventoAdmin2.css">
    <link rel="icon" href="../img/Logo.png">
    <!-- llamado de los iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

</head>

<!-- funcion de js para pregunta si desea eliminar evento -->
<script>

    function eliminar(){
        var respuesta=confirm("Estas seguro que deseas eliminar");
            return respuesta;
    }
    
</script>

    <?php 
        include("menuAdmin.php");
    ?>

    <!-- Contenido del formulario para realizar un evento -->
    <div class="container">

        <div class="form">

            <h4>Formulario</h4>

            <?php 
            include "../config/conexion.php";
            include "controladorEvento/controladorEvento.php";
            ?>

            <form method="post">

                <div class="nombre_evento">
                    <label>Nombre del evento</label>
                    <input type="text" name="nombreEvento">
                </div>

                <div class="fecha">
                    <label>Fecha</label>
                    <input type="date" name="fecha">
                </div>

                <div class="lugar">
                    <label>Lugar</label>
                    <input type="text" name="lugar">
                </div>

                <input type="submit" name="agregarEvento" value="Agregar">

            </form>

        </div>

        <!-- Apartado de la tabla con la informcion de los eventos -->
        <div class="">
            <div class="table-responsive">

                <div class="tabla">

                    <h4>Listado de eventos</h4>

                    <?php 

                        include "../config/conexion.php";
                        include "controladorEliminarEvento/controladorEliminarEvento.php"
                    ?>

                    <table>

                        <thead>
                            <tr>

                                <th class="col">Id</th>
                                <th class="col">Nombre</th>
                                <th class="col">Fecha</th>
                                <th class="col">Lugar</th>
                                <th class="col">Editar</th>
                                <th class="col">Eliminar</th>

                            </tr>
                        </thead>

                        <!-- informacion traida de la base de datos para mostrar los eventos realizados -->
                        <tbody>

                            <?php 
                            include "../config/conexion.php";
                            $sql=$conexion->query(" SELECT * FROM evento ");
                            while($datos=$sql->fetch_object()){ ?>

                            <tr>
                                <td><?= $datos->Id_evento?></td>
                                <td><?= $datos->Nombre ?></td>
                                <td><?= $datos->Fecha ?></td>
                                <td><?= $datos->Lugar ?></td>

                                <!-- boton de modificar evento con respectivo id para cada evento -->
                                <td><a href="modificarEvento/modificarEvento.php?Id=<?= $datos->Id_evento ?>"><i class="bi bi-pencil"></i></a></td>
                                
                                <!-- boton de eliminar evento con respectivo id para cada evento -->
                                <td><a onclick="return eliminar()" href="evento.php?Id=<?= $datos->Id_evento ?>"><i class="bi bi-trash"></i></a></td>
                            </tr>

                            <?php
                            }
                            ?>
                            
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </div>

</body>
</html>