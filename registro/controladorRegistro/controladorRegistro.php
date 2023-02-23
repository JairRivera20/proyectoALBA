<!-- controlador para agregar un nuevo registro desde la pagina y se guarde en la base de datos -->
<?php

if (!empty($_POST["registrarse"])) {

    if (!empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["telefono"]) and !empty($_POST["correo"]) and !empty($_POST["contraseña"]) and !empty($_POST["rol"])) {
        
        $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
        $check=$sql->fetch_object();
        if ($check!=null) {
            if (($check->Activo)!=1) {
                $telefono=$_POST["telefono"];
                $correo=$_POST["correo"];

                $sql=$conexion->query("SELECT * FROM usuarios WHERE Telefono=$telefono OR Correo='$correo'");
                $check=$sql->fetch_object();

                if ($check!=null) {
                    echo "<div 
                    style='color: white;
                    padding: 0 0 30px 0;
                    text-align: center;'>El correo o el telefono ya se encuentra registrado</div>";
                }else{

                    $nombre=$_POST["nombre"];
                    $apellido=$_POST["apellido"];
                    
                    $contraseña=$_POST["contraseña"];

                    $hash= password_hash($contraseña,PASSWORD_DEFAULT, ['cost'=>10]);

                    $rol=$_POST["rol"];
                    

                    /* aqui se hace la condicion segun el rol del usuario para la hora de guardar sus datos */
                    if ($rol == 2) {

                        include "correo.php";
                        $rango=$_POST["rango"];

                        $sql=$conexion->query(" INSERT INTO usuarios ( Nombre, Apellido, Telefono, Correo, Contrasena, Hash512, Rol, fk_rango_competidor, fk_rango_juez, fk_region, Activado, Codigo) VALUES ( '$nombre', '$apellido', '$telefono', '$correo', '$contraseña', '$hash', '$rol', NULL, '$rango', NULL, 0, '$codigo') ");
                        
                        $sql=$conexion->query("SELECT * FROM usuarios WHERE Correo='$correo' AND Hash512='$hash'");
                            $alt=$sql->fetch_object();
                                $id=$alt->Id_usuario;

                        $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
                            $alt=$sql->fetch_object();
                                $evento=$alt->Id_evento;

                        $sql=$conexion->query("INSERT INTO evento_usuarios (fk_evento,fk_usuarios) VALUES ($evento,$id)");
                        
                    } elseif ($rol == 3) {
                        
                        include "correo.php";
                        $rango=$_POST["rango"];
                        $region=$_POST["region"];
                        $sql=$conexion->query(" INSERT INTO usuarios (Nombre, Apellido, Telefono, Correo, Contrasena, Hash512, Rol, fk_rango_competidor, fk_rango_juez, fk_region, Activado, Codigo) VALUES ('$nombre', '$apellido', '$telefono', '$correo', '$contraseña', '$hash', '$rol', '$rango', NULL, '$region', 0, '$codigo') ");

                        $sql=$conexion->query("SELECT * FROM usuarios WHERE Correo='$correo' ");
                            $alt=$sql->fetch_object();
                                $id=$alt->Id_usuario;

                        $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
                            $alt=$sql->fetch_object();
                                $evento=$alt->Id_evento;

                        $sql=$conexion->query("INSERT INTO evento_usuarios (fk_evento,fk_usuarios) VALUES ($evento,$id)");
                    }
                    

                    if ($sql == 1) {
                        
                        
                        /* header("location: controladorRegistro/confirmar.php"); */
                        
                        echo '<div class="verificado">
                        <script language="javascript">
                        
                        alert("Revise su correo");
                        history.pushState(null, null, window.location.href);
                        window.location.href="../../index.php";
                        </script>
                        </div>';

                    } else {
                        
                        echo "<div style='color: white;
                        padding: 0 0 30px 0;
                        text-align: center;'>Ocurrio un error</div>";

                    }
                }
            }else {
                echo "<div 
                style='color: white;
                padding: 0 0 30px 0;
                text-align: center;'>El evento ($check->Nombre) ha cerrado sus inscripciones</div>";
            }
        }else {
            echo "<div 
            style='color: white;
            padding: 0 0 30px 0;
            text-align: center;'>No hay evento disponible para el registro</div>";
        }        
    } else {
        
        echo "<div 
        style='color: white;
        padding: 0 0 30px 0;
        text-align: center;'>Campos vacios</div>";

    }
}

?>