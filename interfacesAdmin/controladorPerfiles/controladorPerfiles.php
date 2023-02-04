<!-- controlador para agregar un nuevo registro desde la pagina y se guarde en la base de datos -->
<?php 

if (!empty($_POST["registrar"])) {

    if (!empty($_POST["DNI"]) and !empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["telefono"]) and !empty($_POST["correo"]) and !empty($_POST["contraseña"]) and !empty($_POST["rol"])) {
        
        $DNI=$_POST["DNI"];
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"];
        $telefono=$_POST["telefono"];
        $correo=$_POST["correo"];
        $contraseña=$_POST["contraseña"];

        $hash=password_hash($contraseña,PASSWORD_DEFAULT,['cost'=>10]);

        $rol=$_POST["rol"];
        
        

        /* aqui se hace la condicion segun el rol del usuario para la hora de guardar sus datos */
        if ($rol == 1) {
            
            $sql=$conexion->query(" INSERT INTO usuarios (DNI, Nombre, Apellido, Telefono, Correo, Contrasena, Hash512, Rol, fk_rango_competidor, fk_rango_juez, fk_region, Activado) VALUES ('$DNI', '$nombre', '$apellido', '$telefono', '$correo', '$contraseña', '$hash', '$rol', NULL, NULL, NULL, 1) ");
        
        } elseif ($rol == 2) {

            $rango=$_POST["rango"];

            $sql=$conexion->query(" INSERT INTO usuarios (DNI, Nombre, Apellido, Telefono, Correo, Contrasena, Hash512, Rol, fk_rango_competidor, fk_rango_juez, fk_region, Activado) VALUES ('$DNI', '$nombre', '$apellido', '$telefono', '$correo', '$contraseña', '$hash', '$rol', NULL, '$rango', NULL, 1) ");
            
            $sql=$conexion->query("SELECT * FROM usuarios WHERE Correo='$correo' AND DNI=$DNI");
                $alt=$sql->fetch_object();
                    $id=$alt->Id_usuario;

            $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
                $alt=$sql->fetch_object();
                    $evento=$alt->Id_evento;

            $sql=$conexion->query("INSERT INTO evento_usuarios (fk_evento,fk_usuarios) VALUES ($evento,$id)");
        
        } elseif ($rol == 3) {
            
            $rango=$_POST["rango"];
            $region=$_POST["region"];
            $sql=$conexion->query(" INSERT INTO usuarios (DNI, Nombre, Apellido, Telefono, Correo, Contrasena, Hash512, Rol, fk_rango_competidor, fk_rango_juez, fk_region, Activado) VALUES ('$DNI', '$nombre', '$apellido', '$telefono', '$correo', '$contraseña', '$hash', '$rol', '$rango', NULL, '$region', 1) ");

            $sql=$conexion->query("SELECT * FROM usuarios WHERE Correo='$correo' AND DNI=$DNI");
                $alt=$sql->fetch_object();
                    $id=$alt->Id_usuario;

            $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
                $alt=$sql->fetch_object();
                    $evento=$alt->Id_evento;

            $sql=$conexion->query("INSERT INTO evento_usuarios (fk_evento,fk_usuarios) VALUES ($evento,$id)");

        }
        

        if ($sql == 1) {
            
            echo "<div style='color: white; margin: 0 0 20px 0;
            padding: 0 0 30px 0;
            text-align: center;
            color: #fff;
            font-size: 20px;'>Registro Exitoso</div>";
            /* header("location: ../../login/login.php"); */

        } else {
            
            echo "<div style='color: white;
            padding: 0 0 30px 0;
            text-align: center;'>Ocurrio un error</div>";

        }
        
        
    } else {
        
        echo "<div 
        style='color: white;
        padding: 0 0 30px 0;
        text-align: center;'>Campos vacios</div>";

    }
}

?>