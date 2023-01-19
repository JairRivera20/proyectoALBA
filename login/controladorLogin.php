<?php
session_start();
/* despues de llenar el formulario y darle click al boton iniciar sesion */
if (!empty($_POST["ingresar"])) {
    if (!empty($_POST["correo"]) and !empty($_POST["contrasena"])) {
        
        /* las variables toman el valor de los campos del formulario a traves de los valores "name"*/
        $correo=$_POST["correo"];
        $contrasena=$_POST["contrasena"];
        

        /* hacemos la consulta para insertar en la tabla de la base de datos */
        $sql=$conexion->query(" SELECT * FROM usuarios WHERE Correo='$correo' AND Contrasena='$contrasena' AND Activado = 1 ");
        $datos=$sql->fetch_object();
        if ($datos != null) {

            $hash=$datos->Hash512;      
            $res= $datos->Contrasena;

            if (password_verify($res,$hash)) {

                /* guardamos ciertos datos en unas variables para un uso de mas adelante */
                $_SESSION["Id_usuario"]=$datos->Id_usuario;
                $_SESSION["Nombre"]=$datos->Nombre;
                $_SESSION["Apellido"]=$datos->Apellido; 
                $_SESSION["Rol"]=$datos->Rol;
                        
                    if (isset($_SESSION['Rol'])) {
                        
                        switch($_SESSION['Rol']){
                            case 1:
                                header("location: ../interfacesAdmin/inicioAdmin.php");
                            break;
    
                            case 2:
                                header("location: ../interfacesJuez/inicioJuez.php");
                            break;
    
                            case 3:
                                header("location: ../interfacesParticipante/inicioParticipante.php");
                            break;
                            
                        }
                        
                    }
                
            }
        }else {
            echo "<div 
            style='color: white;
            padding: 0 0 10px 0;
            text-align: center'>Acceso denegado</div>";
            
        };
        

    } else {

        echo "<div 
        style='color: white;
        padding: 0 0 30px 0;
        text-align: center'>Campos vacios</div>";

    }
    
}


?>