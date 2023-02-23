<?php
session_start();
if (empty($_SESSION["Id_usuario"])) {
    header("location: ../login/login.php");

} else if (!empty($_SESSION["Rol"] != 1)) {

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
    <link rel="stylesheet" href="../css/inicioAdmin3.css">
    <link rel="icon" href="../img/Logo.png">
</head>

<?php 
        include("menuAdmin.php");
        include "../config/conexion.php";
        ?>
        
            <div class="container">
                <?php
                
                    $sql = $conexion->query("SELECT cerveza.Id_cerveza AS id, cerveza.Codigo, usuarios.Nombre AS usuario, rango_competidor.Nombre AS rango 
                    FROM cerveza 
                    INNER JOIN usuarios ON cerveza.fk_usuario = usuarios.Id_usuario
                    INNER JOIN rango_competidor ON usuarios.fk_rango_competidor = rango_competidor.Id_rango_competidor
                    WHERE cerveza.Pendiente=0 AND usuarios.Rol = 3");
                    $cuantas = mysqli_num_rows($sql);

                    ?>
                    <a href="notificaciones/index.php" ><button>Notificaciones pendientes: <?php echo $cuantas; ?></button> </a>
                    <?php

                    $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
                    $alt=$sql->fetch_object();
                    
                    if ($alt!=null) {
                        
                        ?>
                        <div>
                            <div>
                                <form method="POST">
                                    <button type="submit" name="btnPodio" value="ok">Ver podio <?=$alt->Nombre?></button>
                                </form>
                            </div>
                            <div>
                                <?php include "../podio/podio.php"; ?>
                            </div>
                        </div>
                            
                        <?php
                        
                    }else {
                        echo "<h2 style='color:white;text-align:center;'>No hay registros suficientes</h2>";
                    }

                    ?>
            </div>

</body>
</html>