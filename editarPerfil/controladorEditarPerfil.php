<!-- controlador para poder modificar los datos desde la pagina y se guarden en la base de datos -->
<?php 

if (!empty($_POST["editarPerfil"])) {
    
    if (!empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["telefono"]) and !empty($_POST["contraseña"])) {
        
        $id=$_POST["Id_usuario"];
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"];
        $telefono=$_POST["telefono"];
        $contraseña=$_POST["contraseña"];

        $hash = password_hash($contraseña,PASSWORD_DEFAULT, ['cost'=>10]);

        $sql=$conexion->query(" UPDATE usuarios SET Nombre='$nombre', Apellido='$apellido', Telefono='$telefono', Contrasena='$contraseña', Hash512='$hash' WHERE Id_usuario=$id ");

        if ($sql == 1) {
            
            session_start();
            session_destroy();
            header("location: ../login/login.php");

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