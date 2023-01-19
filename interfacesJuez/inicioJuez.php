<?php
session_start();
if (empty($_SESSION["Id_usuario"])) {
    header("location: ../login/login.php");
}else if (!empty($_SESSION["Rol"] != 2)) {

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
    <title>Inicio</title>
    <link rel="stylesheet" href="https://pruebas.migtutor.com/css/inicioJuez3.css">
    <link rel="stylesheet" href="../css/inicioJuez3.css">
    <link rel="icon" href="../img/Logo.png">
</head>

<?php 
        include ("menuJuez.php");
        include "../config/conexion.php";

        /* SI HAY 2 o más */
        $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 1,1");
        $alt=$sql->fetch_object();

        if ($alt!=null) {

            $anterior=$alt->Id_evento;

            $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
            $alt=$sql->fetch_object();
            $actual=$alt->Id_evento;

            if ($anterior<$actual) {
                
                $evento=$anterior;
                $sql=$conexion->query("SELECT * FROM evento WHERE Id_evento=$evento");
                $datos=$sql->fetch_object();

                if($datos!=null){
                    ?>
                    <br><br><br>
                    <div class="container">
                        <?php
                        
                            $sql = $conexion->query("SELECT cerveza.Id_cerveza AS id, cerveza.Nombre,cerveza.Codigo, usuarios.Nombre AS usuario, rango_competidor.Nombre AS rango 
                            FROM cerveza 
                            INNER JOIN usuarios ON cerveza.fk_usuario = usuarios.Id_usuario
                            INNER JOIN rango_competidor ON usuarios.fk_rango_competidor = rango_competidor.Id_rango_competidor
                            WHERE cerveza.Pendiente=0 AND usuarios.Rol = 3");
                            $cuantas = mysqli_num_rows($sql);
                            ?>

                        <!-- Para ver los 3 primeros puestos que gnaron en el anterior evento -->
                       
                           
                            <div>
                                <form method="POST">
                                    <input type="hidden" value="ok" name="update">
                                    <button type="submit" name="btnUpdate" value="ok">Ver podio <?=$datos->Nombre?></button>
                                <?php include "./podio/fork.php";?>
								
								</form>
								
                            </div>
                        
                        
                    </div>
                    
                    <?php
                }
            
            }
        }else {

            $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
            $alt=$sql->fetch_object();

            if ($alt!=null) {
                $actual=$alt->Id_evento;
                ?>
                <div class="container">
                        <?php
                            
                        
                            $sql = $conexion->query("SELECT cerveza.Id_cerveza AS id, cerveza.Nombre,cerveza.Codigo, usuarios.Nombre AS usuario, rango_competidor.Nombre AS rango 
                            FROM cerveza 
                            INNER JOIN usuarios ON cerveza.fk_usuario = usuarios.Id_usuario
                            INNER JOIN rango_competidor ON usuarios.fk_rango_competidor = rango_competidor.Id_rango_competidor
                            WHERE cerveza.Pendiente=0 AND usuarios.Rol = 3");
                            $cuantas = mysqli_num_rows($sql);
                            ?>

                        <!-- Para ver los 3 primeros puestos que gnaron en el anterior evento -->
                       
                           
                            <div>
                                <form method="POST">
                                    <input type="hidden" value="ok" name="update">
                                    <button type="submit" name="btnUpdate" value="ok">Ver podio <?=$alt->Nombre?></button>
                                </form>
                            </div>
                        
                        <?php include "./podio/fork.php";?>
                    
                    
                    <?php
                
            }else {
                echo "<div style='color: white;
                margin-top: 20%;
                padding: 0 0 20px 0;
                text-align: center;
                color: #fff;
                font-size: 50px;'>No hay registros suficientes</div>";
            }
        }
    ?>
    </div>


</body>
</html>