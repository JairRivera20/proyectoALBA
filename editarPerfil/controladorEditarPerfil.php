<!-- controlador para poder modificar los datos desde la pagina y se guarden en la base de datos -->
<?php 

if (!empty($_POST["editarPerfil"])) {
    
    if (!empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["telefono"]) and !empty($_POST["contraseña"]) ) {
        
        $id=$_POST["Id_usuario"];
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"];
        $telefono=$_POST["telefono"];
        $contraseña=$_POST["contraseña"];
        $hash = password_hash($contraseña,PASSWORD_DEFAULT, ['cost'=>10]);

        

        if (!empty($_FILES["foto"]["tmp_name"])) {

            $foto = addslashes(file_get_contents($_FILES["foto"]["tmp_name"]));
            $imagen = getimagesize($_FILES['foto']['tmp_name']);
            $ancho = $imagen[0];
            $alto = $imagen[1];

            if ($ancho <= 720 && $alto <= 720) {

                $sql=$conexion->query(" UPDATE usuarios SET Nombre='$nombre', Apellido='$apellido', Telefono='$telefono', Contrasena='$contraseña', Foto='$foto', Hash512='$hash' WHERE Id_usuario=$id ");

                if ($sql == 1) {
                
                    include "sql.php";
                    
        
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
                font-size: 15px;'>La imagen supera las dimesiones de 720 X 720</div>";
            }
        }else {
            $sql=$conexion->query(" UPDATE usuarios SET Nombre='$nombre', Apellido='$apellido', Telefono='$telefono', Contrasena='$contraseña', Hash512='$hash' WHERE Id_usuario=$id ");

            if ($sql == 1) {
			   
				include "sql.php";
				
    
            } else {
                
                echo "<div style='color: white;
                padding: 0 0 20px 0;
                text-align: center;
                color: #fff;
                font-size: 20px;'>Ocurrio un error</div>";
    
            }
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