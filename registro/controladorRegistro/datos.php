<?php 
/* conexion que se hace con la base de datos */
require_once '../../config/conexion.php';

/* obtenemos el parametro que viene de ajax */
$rol = $_POST['rol'];


/* verificamos que el campo no este vacio */
if (!empty($_POST['rol'])) {
    
    /* si el usuario escoge el rol de juez se despliega los rangos de juez */
    if ($rol == 2) {

        $sql = "SELECT * FROM rango_juez";

        $result = mysqli_query($conexion,$sql);

        /* mostramos los datos seleccionados en el select */
        $cadena = "<label>Rango</label>
                    <select id ='rango' name = 'rango'>";

        /* obtenemos los datos de la tabla de la base de datos segun el rol */
        while ($ver = mysqli_fetch_row($result)){
                $cadena = $cadena. '<option value ='.$ver[0]. '>'.$ver[1]. '</option>';
        }

        /* cerramos el select */
        echo $cadena."</select>";


    /* si el usuario escoge el rol de competidor/participante se despliega los rangos de competidor/participante */
    }else if ($rol == 3) {
        
        $sql = "SELECT * FROM rango_competidor";
        
        $result = mysqli_query($conexion,$sql);
        
        /* mostramos los datos seleccionados en el select */
        $cadena = "<label>Rango</label>
                    <select id ='rango' name = 'rango'>";

        /* obtenemos los datos de la tabla de la base de datos segun el rol */
        while ($ver = mysqli_fetch_row($result)){
                $cadena = $cadena. '<option value ='.$ver[0]. '>'.utf8_encode($ver[1]). '</option>';
        }

        /* cerramos el select */
        echo $cadena."</select>";


        /* ------------------------ el select de region ------------------------- */

        $sql = "SELECT * FROM region";

        $result = mysqli_query($conexion,$sql);


        /* mostramos los datos seleccionados en el select */
        $cadena = "<label>Región</label>
        <select id = 'region' name = 'region'>";


        /* obtenemos los datos de la tabla region de la base de datos */
        while ($ver = mysqli_fetch_array($result)){
            $cadena = $cadena. '<option value ='.$ver[0].'>'. $ver[1]. '</option>';
        }
        
        /* cerramos el select */
        echo $cadena."</select>";


    }
}


?>