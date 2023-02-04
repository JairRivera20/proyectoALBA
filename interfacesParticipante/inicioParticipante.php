<?php
session_start();
if (empty($_SESSION["Id_usuario"])) {
    header("location: ../login/login.php");
}else if (!empty($_SESSION["Rol"] != 3)) {

    session_start();
    session_destroy();
    header("location: ../login/login.php");
}

include '../config/conexion.php';

$sql=$conexion->query("SELECT*FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
$datos=$sql->fetch_object();
if ($datos!=null) {
    $evento=$datos->Id_evento;
    $ok=1;

}else {
    $ok=0;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>

    <link rel="stylesheet" href="../css/inicioParticipante4.css">
    <link rel="icon" href="../img/Logo.png">
</head>

<?php include("menuParticipante.php"); ?>

    <?php
        if ($ok==1) {

            $check=$datos->Nombre;

            if ($check!='') {
                ?>
                <br>
                <div class="padre">
                    <div class="container">
                        <button><a href="ultimoevento.php">Ver ultimo evento disponible</a></button>
                    </div>
                </div>
                <?php
            }else {
                $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 1,1");
                $data=$sql->fetch_object();
                ?>
                <br>
                <div class="padre">
                    <div class="container">

                        <h4>El evento <?=$data->Nombre?> ha terminado</h4>
                        <button><a href="ultimoevento.php">Ver ultimo evento disponible</a></button>
						
						<div>
                                <form method="POST">
                                    <input type="hidden" value="ok" name="update">
                                    <button type="submit" name="btnUpdate" value="ok" style="color:white;">Ver podio <?=$data->Nombre?></button>
                                </form>
                        </div>
                        
                        <?php include "podio/fork.php";?>
                        
                    </div>
					
                </div>
            
            
                <?php
            }
        


       
        
        include "../config/conexion.php";

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
                    <div class="container2">
                        <?php
                        
                            $sql = $conexion->query("SELECT cerveza.Id_cerveza AS id, cerveza.Nombre,cerveza.Codigo, usuarios.Nombre AS usuario, rango_competidor.Nombre AS rango 
                            FROM cerveza 
                            INNER JOIN usuarios ON cerveza.fk_usuario = usuarios.Id_usuario
                            INNER JOIN rango_competidor ON usuarios.fk_rango_competidor = rango_competidor.Id_rango_competidor
                            WHERE cerveza.Pendiente=0 AND usuarios.Rol = 3");
                            $cuantas = mysqli_num_rows($sql);
                            ?>

                        <!-- Para ver los 3 primeros puestos que gnaron en el anterior evento -->
                       
                           
                            
                    
                    
                    <?php
                }
            
            }
        }
        ?>

    
        </div>
    </div>
    
    <?php
    
        }else {
            echo "<div class='container' style='color: white;
            margin-top: 20%;
            padding: 0 0 20px 0;
            text-align: center;
            color: #fff;
            font-size: 50px;'>No hay registros suficientes</div>";
        } 
        
    ?>

        
   
</body>
</html>