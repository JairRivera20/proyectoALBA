<?php
session_start();
if (empty($_SESSION["Id_usuario"])) {
    header("location: ../login/login.php");
    
}else if (!empty($_SESSION["Rol"] != 1)) {

    session_start();
    session_destroy();
    header("location: ../login/login.php");
}
include "../config/conexion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podio</title>

    <link rel="stylesheet" href="../css/inicioAdmin2.css">
    <link rel="icon" href="../img/Logo.png">
    <!-- llamado de los iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!--  -->
    <script src="https://kit.fontawesome.com/123c640fb2.js" crossorigin="anonymous"></script>
</head>

<!-- funcion de js para pregunta si desea eliminar evento -->
<script>

    function eliminar(){
        var respuesta=confirm("Estas seguro que deseas eliminar");
            return respuesta;
    }
    
</script>

<body>

    <!-- Contenido del formulario para realizar un evento -->
    <div style="margin-top:26%;">
        <div class="container" style="color:white; text-align:center;">


        <h1>Podio</h1>

        <?php 

        include "controladorEvento/fork.php";?>

        </div>
    </div>
    

</body>
</html>