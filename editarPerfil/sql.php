<?php
include "../config/conexion.php";

if (isset($resultados['Rol'])) {
                        
    switch($resultados['Rol']){
        case 1:
            echo '<script language="javascript">

            alert("Los cambios se veran reflejados la proxima vez que inicies sesión");
            
            window.location.href="../interfacesAdmin/inicioAdmin.php";

            </script>';
        break;

        case 2:
            echo '<script language="javascript">

            alert("Los cambios se veran reflejados la proxima vez que inicies sesión");
            
            window.location.href="../interfacesJuez/inicioJuez.php";

            </script>';
        break;

        case 3:
            echo '<script language="javascript">

            alert("Los cambios se veran reflejados la proxima vez que inicies sesión");
            
            window.location.href="../interfacesParticipante/inicioParticipante.php";

            </script>';
        break;
        
    }
    
};

?>