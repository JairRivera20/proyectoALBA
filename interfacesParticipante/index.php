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
        if ($ok==1) {?>
                <br>
                <div class="padre">
                    <div class="container">
                        <button><a href="ultimoevento.php">Ver ultimo evento disponible</a></button>
						
						<form method="POST">
							<button type="submit" name="btnPodio" value="ok" style="color:white;">Ver podio <?=$datos->Nombre?></button>
						</form>
						<?php include "../podio/podio.php";?>
                    </div>
                </div>
			
    <?php
    
        }else {
            echo "<div class='container' style='color: white;
            margin-top: 20%;
            padding: 0 0 20px 0;
            text-align: center;
            color: #fff;
            font-size: 50px;'>No hay evento registrado</div>";
        } 
    ?>   
</body>
</html>