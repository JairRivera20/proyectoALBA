<?php
include "../config/conexion.php";

function generarCodigo($longitud) {
    $key = '';
    $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $max = strlen($pattern)-1;
    for($i=0;$i < $longitud;$i++) $key .= $pattern[mt_rand(0,$max)];
    return $key;
};

/* comprobacion para no repetir el codigo */
while(true){
    $cod=generarCodigo(6);
    $q= "SELECT COUNT(*) AS codigos FROM cerveza WHERE cerveza.Codigo='$cod'";
    $consulta = mysqli_query($conexion, $q);
    $resul = mysqli_fetch_array($consulta);    
    if ($resul['codigos']==0) {
        mysqli_close($conexion);
        break;
    }
};

?>