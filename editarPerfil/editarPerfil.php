<!-- seleccion del id de cada usuario y saber los datos de cada uno de ellos -->
<?php 

include "../config/conexion.php";
$id=$_GET["Id_usuario"];

$sql=$conexion->query(" SELECT * FROM usuarios WHERE Id_usuario=$id ");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil</title>
    <link rel="stylesheet" href="http://localhost/proyectoalba/css/editarPerfil2.css">
    <link rel="stylesheet" href="../css/editarPerfil2.css">
</head>
<body>

<div class="container">
    
    <div class="form">

    <h4>Editar perfil</h4>

    <?php 
    include "controladorEditarPerfil.php";
    while($datos=$sql->fetch_object()){?>

    <form method="post">

        <input type="hidden" name="Id_usuario" value="<?= $_GET["Id_usuario"]?>">

        <div class="nombre">
            <label>Nombre</label>
            <input class="mayuscula" type="text" name="nombre" value="<?= $datos->Nombre ?>">
        </div>

        <div class="apellido">
            <label>Apellido</label>
            <input class="mayuscula" type="text" name="apellido" value="<?= $datos->Apellido ?>">
        </div>

        <div class="telefono">
            <label>Teléfono</label>
            <input type="tel" name="telefono" value="<?= $datos->Telefono ?>">
        </div>

        <div class="contraseña">
            <label>Contraseña</label>
            <input type="text" name="contraseña" value="<?= $datos->Contrasena ?>">
        </div>

        <input type="submit" name="editarPerfil" value="Guardar">
        <input type="button" onclick="history.back()" name="regresar" value="Regresar">

    </div>

    </form>

    <?php }
    ?>

    </div>
	
	<!-- javascript para que al ingresar los datos estos comiecen con letra mayuscula -->
    <script src="../js/mayuscula2.js"></script>

</body>
</html>

