<!-- controlador para poder modificar los datos desde la pagina y se guarden en la base de datos -->
<?php 

if (!empty($_POST["modificarPerfil"])) {
    
    if (!empty($_POST["DNI"]) and !empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["telefono"]) and !empty($_POST["correo"]) and !empty($_POST["contraseña"]) and !empty($_POST["rol"])) {
        
        $id=$_POST["Id_usuario"];
        $DNI=$_POST["DNI"];
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"];
        $telefono=$_POST["telefono"];
        $correo=$_POST["correo"];
        $contraseña=$_POST["contraseña"];
        
        $hash=password_hash($contraseña,PASSWORD_DEFAULT,['cost'=>10]);
        
        $rol=$_POST["rol"];
        
        $sql=$conexion->query(" UPDATE usuarios SET DNI='$DNI', Nombre='$nombre', Apellido='$apellido', Telefono='$telefono', Correo='$correo', Contrasena='$contraseña', Hash512='$hash', Rol='$rol' WHERE Id_usuario=$id ");

        if ($sql == 1) {
            
            header("location: ../editarPerfiles.php");

        } else {
            
            echo "<div style='color: white;
            padding: 0 0 20px 0;
            text-align: center;
            color: #fff;
            font-size: 20px;'>Ocurrio un error</div>";

        }

    } else {
        
        echo "<div style='color: white;
        padding: 0 0 20px 0;
        text-align: center;
        color: #fff;
        font-size: 20px;'>Campos vacios</div>";

    }
    
}

?>