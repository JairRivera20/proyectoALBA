<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>

    <link rel="stylesheet" href="../css/recuperarContrasena3.css">
    <link rel="icon" href="../img/Logo.png">
</head>
<body>

    <div class="container">
        <h2>Recuperar contraseña</h2>
        <br>

        <?php 
        include "../config/conexion.php";
        include "controladorRecuperarContrasena.php";
        ?>

        <div>

        <form action="" method="POST">
            
            <label for="">Correo</label>
            <input type="email" id="correo" name="correo" required>

            <input type="submit" name="recuperar" value="Enviar">
            <input type="button" onclick="history.back()" value="Regresar">

        </form>

        </div>

    </div>

    
</body>
</html>