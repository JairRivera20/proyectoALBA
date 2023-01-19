<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="http://localhost/proyectoalba/css/registro2.css">
    <link rel="stylesheet" href="../css/registro2.css">
    <link rel="icon" href="../img/Logo.png">
    <!-- llamado de los iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- llamado de jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
	<!-- tab en el enter -->
		<script src="../js/enter.js"></script>
    
    <!-- script para el select padre -->
    <script type="text/javascript">

        $(document).ready(function(){
            recargarLista();

            $('#rol').change(function(){
                recargarLista();
            });
        });

        /* llamado del ajax */
        function recargarLista(){
            $.ajax({
                type:"POST",
                url:"controladorRegistro/datos.php",
                data:"rol=" + $('#rol').val(),
                success:function(r){
                    $('#rango').html(r);
                }
            })
        }

    </script>


</head>
<body>

    <!-- Formulario del registro de los usarios -->
    <div class="formulario">

        <h1>Registro</h1>

        <?php 
        include "../config/conexion.php";
        include "controladorRegistro/controladorRegistro.php";
        ?>
        
        <form method="post">

            <div class="DNI">
                <label>DNI</label>
                <input type="number" name="DNI">
            </div>

            <div class="nombre">
                <label>Nombre</label>
                <input class="mayuscula" type="text" name="nombre">
            </div>

            <div class="apellido">
                <label>Apellido</label>
                <input class="mayuscula" type="text" name="apellido">
            </div>

            <div class="telefono">
                <label>Teléfono</label>
                <input type="tel" name="telefono">
            </div>

            <div class="correo">
                <label>Correo electronico</label>
                <input type="email" name="correo">
            </div>

            <div class="contraseña">
                <label>Contraseña</label>
                <input type="password" name="contraseña" id="contraseña">
                <!-- icono del ojo password -->
                <i class="bi bi-eye" id="ojo"></i>
            </div>

            <!-- select padre -->
            <div class="rol">
  
                    <label class="titulorol">Rol:</label>

                    <select name="rol" id="rol">
                        <option value="0" selected disabled>Seleccione su rol</option>
                        <option value="2">Juez</option>
                        <option value="3">Participante</option>
                    </select>

            </div>

            <!-- aqui es donde va el select hijo Rango -->
            <div id="rango"></div>

            <!-- aqui es donde va el select hijo de region a la hora de ser el rol de participante -->
            <div id="region"></div>

            
            <div class="cuenta">
                <a href="../login/login.php">¿Ya tienes cuenta?</a>
            </div>
            <br>

                <input type="submit" name="registrarse" value="Registrarse">


        </form>
    
    </div>    

        <!-- javascript para la funcionaliodad del ojo de password -->
        <script src="../js/mostrarOcultarContrasena.js"></script>
		
		
		<!-- javascript para que al ingresar los datos estos comiecen con letra mayuscula -->
        <script src="../js/mayuscula2.js"></script>
		
    
</body>
</html>