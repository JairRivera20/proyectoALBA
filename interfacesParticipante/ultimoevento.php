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
include '../config/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>

    <link rel="stylesheet" href="../css/ultimoEvento3.css">
    <link rel="icon" href="../img/Logo.png">
</head>
<body>
    <!-- <div>
        <button><a href="inicioParticipante.php">Volver</a></button>
    </div>
    <hr> -->

    <?php 
        include "menuParticipante.php";
        include "controladoresCervezas/ctrlparticipar.php";
            $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
            $datos=$sql->fetch_object();
            if ($datos!=null) {
                $check=$datos->Nombre;
                if ($check!='') {
                    ?>
                    <div class="container">
                        <h4>Evento: <?=$datos->Nombre?></h4>
                        <h4>Lugar de realización: <?=$datos->Lugar?></h4>
                        <h4>Fecha de inicio: <?=$datos->Fecha?></h4>
                        <form method="POST">
                            <div>
                                <input type="hidden" value="<?=$id?>" name="Id">
                            </div>
                            <div>
                                <input type="submit" value="Participar" name="btnparticipar">
                            </div>
                            
                        </form>
                    </div>
                    <?php
                }else {
                    $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 1,1");
                    $data=$sql->fetch_object();
                    ?>
                    <div class="container">
                        <h4>Evento: <?=$data->Nombre?></h4>
                        <h4>Lugar de realización: <?=$data->Lugar?></h4>
                        <h4>Fecha de inicio: <?=$data->Fecha?></h4>
                        
                    </div>
                    <?php
                }
    
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