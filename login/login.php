
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="../css/login1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="icon" href="../img/Logo.png">
    
</head>
<body>

    <!-- formulario del login -->
    <div class="formulario">
        <img class="logo2" src="../img/logo-sena-verde-png-sin-fondo.png" alt="logo sena">
        <br>
        <br>
        <br>
        <br>
		<?php 
            include "../config/conexion.php";
            include "controladorLogin.php";
        ?>
        
        <h1>Iniciar Sesión</h1>
		 


        <form method="POST">

            <div class="correo">
                <label>Correo electrónico</label>
                <input type="email" name="correo">
            </div>

            <div class="contraseña">
                <label>Contraseña</label>
                <input type="password" name="contrasena" id="contraseña">
                <!-- icono del ojo password -->
                <span><i class="bi bi-eye" id="ojo"></i></span>
            </div>

            <div class="recordar">
                <a href="../recuperarContrasena/recuperarContrasena.php">¿Olvidaste tu contraseña?</a>
            </div>
            <br>

            <div class="recordar">
                <a href="../registro/registro.php">Registrarse</a>
            </div>
            <br>

            <input name="ingresar" type="submit" value="Iniciar Sesión">
            
        </form>
    
    </div>
	
	<img class="logo" src="../img/Logo.png" alt="logo alba">

    <!-- javascript para la funcionaliodad del ojo de password -->
    <script src="../js/mostrarOcultarContrasena.js"></script>
	
	<script src="../js/mensajePestana.js"></script>

</body>
</html>
