<!-- seleccion del id de cada evento y saber los datos de cada uno de ellos -->
<?php 

include "../../config/conexion.php";
$id=$_GET["Id_usuario"];

$sql=$conexion->query(" SELECT * FROM usuarios WHERE Id_usuario=$id ");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Perfil</title>

    <link rel="stylesheet" href="../../css/modificarPerfiles3.css">
    <link rel="icon" href="../../img/Logo.png">
</head>
<body>

<!-- fomulario en el cual se hacen las modificaciones del perfil -->

<div class="container">

    <div class="form">

        <h4>Editar registro</h4>

        <?php 
        include "controladorPerfiles.php";
        while($datos=$sql->fetch_object()){?>

        <form method="post">

            <input type="hidden" name="Id_usuario" value="<?= $_GET["Id_usuario"]?>">

            <div class="nombre">
                <label>Nombre</label>
                <input type="text" name="nombre" value="<?= $datos->Nombre ?>">
            </div>

            <div class="apellido">
                <label>Apellido</label>
                <input type="text" name="apellido" value="<?= $datos->Apellido ?>">
            </div>

            <div class="telefono">
                <label>Teléfono</label>
                <input type="tel" name="telefono" value="<?= $datos->Telefono ?>">
            </div>

            <div class="correo">
                <label>Correo</label>
                <input type="email" name="correo" value="<?= $datos->Correo ?>">
            </div>

            <div class="contraseña">
                <label>Contraseña</label>
                <input type="text" name="contraseña" value="<?= $datos->Contrasena ?>">
            </div>

            <div class="rol">
    
                        <label class="titulorol">Rol:</label>
                        
                        <input type="radio" name="rol" value='1' id="rol1">
                        <label for="rol1">Steward</label>

                        <input type="radio" name="rol" value='2' id="rol2">
                        <label for="rol2">Juez</label>

                        <input type="radio" name="rol" value='3' id="rol3">
                        <label for="rol3">Participante</label>
        
            </div>
            <br>
            <input type="submit" name="modificarPerfil" value="Guardar cambios">
            <a href="../editarPerfiles.php"><input type="button" name="regresar" value="Regresar"></a>

        </form>

        <?php }
        ?>

    </div>
    
</div>
    
</body>
</html>