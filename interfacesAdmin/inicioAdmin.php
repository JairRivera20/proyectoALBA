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
                
                    $sql = $conexion->query("SELECT cerveza.Id_cerveza AS id, cerveza.Nombre,cerveza.Codigo, usuarios.Nombre AS usuario, rango_competidor.Nombre AS rango 
                    FROM cerveza 
                    INNER JOIN usuarios ON cerveza.fk_usuario = usuarios.Id_usuario
                    INNER JOIN rango_competidor ON usuarios.fk_rango_competidor = rango_competidor.Id_rango_competidor
                    WHERE cerveza.Pendiente=0 AND usuarios.Rol = 3");
                    $cuantas = mysqli_num_rows($sql);

                    ?>
                    <a href="notificaciones/index.php" ><button>Tu tienes <?php echo $cuantas; ?> notifiaciones </button> </a>
                    <?php

                    $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
                    $alt=$sql->fetch_object();
                    
                    if ($alt!=null) {
                        $check=$alt->Nombre;
                    }else {
                        $check='';
                    }
                    

                    if ($check!='') {
                        
                        /* para saber si hay 2 */
                        $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 1,1");
                        $g=$sql->fetch_object();

                        if ($g!=null) {
                            
                            $check=$g->Primer_puesto;
                            $chec=$g->Segundo_puesto;
                            $che=$g->Tercer_puesto;

                            if ($check!=0 && $chec!=0 && $che!=0) {
                                
                                

                            }else {

                                $evento=$alt->Id_evento;
                                $sql=$conexion->query("SELECT * FROM evento WHERE Id_evento=$evento");
                                $datos=$sql->fetch_object();
                                ?>
                                <form method="POST">
                                    <button type="submit" name="btnPodio" value="ok">Ver podio <?=$g->Nombre?></button>
                                </form>
                                <form method="POST">
                                    
                                    <input type="hidden" value="ok" name="terminar">
                                    <button type="submit" name="btnTerminar" value="ok">Terminar <?=$datos->Nombre?></button>
                                    
                                    <?php include "controladorEvento/terminar.php"; ?>
                                </form>
                                <?php
                            }
                            

                        }else {
                            /* solo hay 1 */
                            $evento=$alt->Id_evento;
                            $sql=$conexion->query("SELECT * FROM evento WHERE Id_evento=$evento");
                            $datos=$sql->fetch_object();
                            include "controladorEvento/terminar.php";
                            ?>

                            <br>
                            <form method="POST">
                                <input type="hidden" value="ok" name="terminar">
                                <button type="submit" name="btnTerminar" value="ok">Terminar <?=$datos->Nombre?></button>
                            </form>

                            <?php
                        }
                            
                    }else {

                        $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 1,1");
                        $alt=$sql->fetch_object();

                        if ($alt!=null) {

                            $evento=$alt->Id_evento;

                            $sql=$conexion->query("SELECT * FROM evento WHERE Id_evento=$evento");
                            ?>
                            <div >
                                <a href='podio.php'><button>Ver podio <?=$alt->Nombre?></button></a>
                            </div>
                            <?php

                        }else {
                            echo "<h2 style='color:white;text-align:center;'>No hay registros suficientes</h2>";
                        }

                        
                    }

                    ?>

                <!-- Notifications: style can be found in dropdown.less -->
                
                
                    
                
            </div>

</body>
</html>