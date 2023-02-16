<!-- seleccion del id de cada evento y saber los datos de cada uno de ellos -->
<?php 

include "../../config/conexion.php";
$id=$_GET["Id"];

$sql=$conexion->query(" SELECT * FROM evento WHERE Id_evento=$id ");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Evento</title>

    <link rel="stylesheet" href="../../css/modificarEvento2.css">
    <link rel="icon" href="../../img/Logo.png">
</head>
<body>

<!-- fomulario en el cual se hacen las modificaciones del evento -->

<div class="container">
    <div class="form">

    <h4>Modificar evento</h4>

    <?php 
    include "controladorModificarEvento.php";
    while($datos=$sql->fetch_object()){?>

    <form method="post">

        <input type="hidden" name="Id" value="<?= $_GET["Id"]?>">

        <div class="nombre_evento">
            <label>Nombre del evento</label>
            <input type="text" name="nombreEvento" value="<?= $datos->Nombre ?>">
        </div>

        <div class="fecha">
            <label>Fecha inicio</label>
            <input type="date" name="fecha" value="<?= $datos->Fecha ?>">
        </div>
		
		<div class="fecha">
            <label>Fecha fin</label>
            <input type="date" name="fecha_f" value="<?= $datos->Fecha_fin?>">
        </div>

        <div class="lugar">
            <label>Lugar</label>
            <input type="text" name="lugar" value="<?= $datos->Lugar?>">
        </div>
		<div>
			<label>Mesas</label>
			<input type="number" name="mesas" value="<?=$datos->Mesas?>">
		</div>

        <input type="submit" name="modificarEvento" value="Guardar cambios">
        <a href="../evento.php"><input type="button" name="regresar" value="Regresar"></a>

    </form>

    <?php }
    ?>

    </div>
</div>
    
</body>
</html>