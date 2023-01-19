<?php
include '../config/conexion.php';

if (!empty($_POST['btnparticipar'])) {
    
    if (!empty($_POST['Id'])) {
        
        $id=$_POST['Id'];

        $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
        $dato=$sql->fetch_object();
        $evento=$dato->Id_evento;

        $sql=$conexion->query("UPDATE evento_usuarios SET fk_evento=$evento WHERE fk_usuarios=$id");

        if ($sql==1){
            echo '<div>
            <script language="javascript">
            
            alert("¡Registro exitoso!");
            history.pushState(null, null, window.location.href);

            </script>
            </div>';
        }else{
            echo "Error al registrar";
        }

    }else{
        echo "Error 404";
        
    }


    
}



?>