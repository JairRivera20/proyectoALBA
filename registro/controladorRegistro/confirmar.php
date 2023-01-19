<?php 

if (isset($_GET['correo'])) {
    
    $correo = $_GET['correo'];
    
} else {
    
    header("location: ../../login/login.php");

}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar</title>
    <link rel="stylesheet" href="http://localhost/proyectoalba/css/confirmar2.css">
    <link rel="stylesheet" href="../../css/confirmar2.css">
    <link rel="icon" href="../../img/LOGO ALBA V.png">
</head>
<body>

    <div class="container">
        <h2>Verificar Cuenta</h2>

        <?php 
        include "../../config/conexion.php";
        include "verificar.php";
        ?>

        <div>
        
            <form action="" method="POST">

                <label for="">Código de verificación</label>
                <input type="hidden" id="correo" name="correo" value="<?php echo $correo; ?>">
                <input type="number" id="codigo" name="codigo">

                <input type="submit" name="verificar" value="Verificar">

            </form>

        </div>

    </div>

    
</body>
</html>