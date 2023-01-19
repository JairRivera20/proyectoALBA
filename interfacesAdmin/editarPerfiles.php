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
    <title>Perfiles</title>
    <link rel="stylesheet" href="http://localhost/proyectoalba/css/editarPerfilesAdmin2.css">
    <link rel="stylesheet" href="../css/editarPerfilesAdmin2.css">
    <link rel="icon" href="../img/Logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- llamado de jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    
    <!-- script para el select padre -->
    <script type="text/javascript">

            $(document).ready(function(){
                recargarLista();

                $('#rol').change(function(){
                    recargarLista();
                });
            });

            /* llamado del ajax */
            function recargarLista(){
                $.ajax({
                    type:"POST",
                    url:"controladorPerfiles/datos.php",
                    data:"rol=" + $('#rol').val(),
                    success:function(r){
                        $('#rango').html(r);
                    }
                })
            }

    </script>

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

        $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
        $datos=$sql->fetch_object();
        if ($datos!=null) {

    ?>

    <!-- Contenido del formulario para realizar un evento -->
    <div class="container">

        <div class="form">

            <h4>Registrar nuevo usuario</h4>

            <?php 
            include "../config/conexion.php";
            include "controladorPerfiles/controladorPerfiles.php";
            ?>

            <form method="post">

                <div class="DNI">
                    <label>DNI</label>
                    <input type="number" name="DNI">
                </div>

                <div class="nombre">
                    <label>Nombre</label>
                    <input class="mayuscula" type="text" name="nombre">
                </div>

                <div class="apellido">
                    <label>Apellido</label>
                    <input class="mayuscula" type="text" name="apellido">
                </div>

                <div class="telefono">
                    <label>Telefono</label>
                    <input type="tel" name="telefono">
                </div>

                <div class="correo">
                    <label>Correo</label>
                    <input type="email" name="correo">
                </div>

                <div class="contraseña">
                    <label>Contraseña</label>
                    <input type="text" name="contraseña">
                </div>


                <!-- select padre -->
                <div class="rol">
  
                    <label class="titulorol">Rol:</label>

                    <select name="rol" id="rol">
                        <option value="0" selected disabled>Seleccione su rol</option>
                        <option value="1">Steward</option>
                        <option value="2">Juez</option>
                        <option value="3">Participante</option>
                    </select>

                </div>

                <!-- aqui es donde va el select hijo Rango -->
                <div id="rango"></div>

                <!-- aqui es donde va el select hijo de region a la hora de ser el rol de participante -->
                <div id="region"></div>


                <input type="submit" name="registrar" value="Registrar">

            </form>

        </div>

        <!-- Apartado de la tabla con la informcion de los eventos -->

        <div class="table-responsive">
            <div class="tabla_container">
                
                    
                    <div class="tabla">
                    

                    <h4>Listado de usuarios registros</h4>

                    <?php 

                        include "../config/conexion.php";
                        include "controladorEliminarPerfiles/controladorEliminarPerfiles.php"
                    ?>

                    <table>

                        <thead>
                            <tr>

                                <!-- <th class="col">Id</th> -->
                                <th class="col">DNI</th>
                                <th class="col">Nombre</th>
                                <th class="col">Apellido</th>
                                <th class="col">Teléfono</th>
                                <th class="col">Correo</th>
                                <th class="col">Contraseña</th>
                                <th class="col">Rol</th>
                                <th class="col">Editar</th>
                                <th class="col">Eliminar</th>

                            </tr>
                        </thead>

                        <!-- informacion traida de la base de datos para mostrar los usuarios registrados -->
                        <tbody>

                            <?php 
                            include "../config/conexion.php";

                            $sql=$conexion->query("SELECT evento_usuarios.Id,evento.Nombre AS Evento, usuarios.Id_usuario, usuarios.DNI, usuarios.Nombre, usuarios.Apellido, usuarios.Telefono, usuarios.Correo, usuarios.Contrasena, usuarios.Rol
                            FROM evento_usuarios
                            INNER JOIN evento on evento_usuarios.fk_evento=evento.Id_evento
                            INNER JOIN usuarios ON evento_usuarios.fk_usuarios= usuarios.Id_usuario
                            WHERE usuarios.Activado=1 AND usuarios.Rol !=1");
                            $alt=$sql->fetch_object();

                            if ($alt!=null) {
                            while($datos=$sql->fetch_object()){ ?>

                            <tr>
                                <!-- <td><?= $datos->Id_usuario?></td> -->
                                <td><?= $datos->DNI?></td>
                                <td><?= $datos->Nombre ?></td>
                                <td><?= $datos->Apellido ?></td>
                                <td><?= $datos->Telefono ?></td>
                                <td><?= $datos->Correo ?></td>
                                <td><?= $datos->Contrasena ?></td>
                                <td><?php 
                                $Rol=$datos->Rol;
                                if ($Rol==1) {
                                    echo "Administrador";
                                }elseif ($Rol==2) {
                                    echo "Juez";
                                }elseif ($Rol==3) {
                                    echo "Participante";
                                }
                                ?></td>

                                <!-- boton de modificar usuario con respectivo id para cada usuario -->
                                <td><a href="modificarPerfiles/modificarPerfiles.php?Id_usuario=<?= $datos->Id_usuario ?>"><i class="bi bi-pencil"></i></a></td>
                                
                                <!-- boton de eliminar usuario con respectivo id para cada usuario -->
                                <td><a onclick="return eliminar()" href="editarPerfiles.php?Id_usuario=<?= $datos->Id_usuario ?>"><i class="bi bi-trash"></i></a></td>
                            </tr>

                            <?php
                            }
                    }else{
                        $sql=$conexion->query("SELECT usuarios.Id_usuario, usuarios.DNI, usuarios.Nombre, usuarios.Apellido, usuarios.Telefono, usuarios.Correo, usuarios.Contrasena, usuarios.Rol
                        FROM usuarios
                        WHERE usuarios.Activado=1 AND usuarios.Rol !=1");

                        while ($datos=$sql->fetch_object()){
                            ?>

<tr>
                                        <!-- <td><?= $datos->Id_usuario?></td> -->
                                        <td><?= $datos->DNI?></td>
                                        <td><?= $datos->Nombre ?></td>
                                        <td><?= $datos->Apellido ?></td>
                                        <td><?= $datos->Telefono ?></td>
                                        <td><?= $datos->Correo ?></td>
                                        <td><?= $datos->Contrasena ?></td>
                                        <td><?php 
                                        $Rol=$datos->Rol;
                                        if ($Rol==1) {
                                            echo "Administrador";
                                        }elseif ($Rol==2) {
                                            echo "Juez";
                                        }elseif ($Rol==3) {
                                            echo "Participante";
                                        }
                                        ?></td>

                                        <!-- boton de modificar usuario con respectivo id para cada usuario -->
                                        <td><a href="modificarPerfiles/modificarPerfiles.php?Id_usuario=<?= $datos->Id_usuario ?>"><i class="bi bi-pencil"></i></a></td>
                                        
                                        <!-- boton de eliminar usuario con respectivo id para cada usuario -->
                                        <td><a onclick="return eliminar()" href="editarPerfiles.php?Id_usuario=<?= $datos->Id_usuario ?>"><i class="bi bi-trash"></i></a></td>
                                    </tr>

                                    <?php
                                }
                            }?>
                            
                        </tbody>
                    </table>

                </div>
                <br>
            </div>
        </div>

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

    <!-- Contenido del formulario para realizar un evento -->

    </div>
	
	
	<!-- javascript para que al ingresar los datos estos comiecen con letra mayuscula -->
    <script src="../js/mayuscula2.js"></script>

</body>
</html>