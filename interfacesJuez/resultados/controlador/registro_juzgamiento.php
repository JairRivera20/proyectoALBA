<?php
/* comprobacion despues de rellenar el formulario */

if(!empty($_POST["btnjuzgar"])) {
    /* formulario segmentado */
    /* aroma */
    if (!empty($_POST["aroma"]) and !empty($_POST["apariencia"]) and !empty($_POST["sabor"]) and !empty($_POST["sensacion"]) and !empty($_POST["general-estilo"]) and !empty($_POST["general-fallas"]) and !empty($_POST["general-vida"]) and !empty($_POST["fallas"]) and !empty($_POST["descripcion"]) and !empty($_POST["nota"])) {
        
        $Id=$_POST["Id"];
        $aroma=$_POST["aroma"];
        $apariencia=$_POST["apariencia"];
        $sabor=$_POST["sabor"];
        $sensacion=$_POST["sensacion"];
        $generalestilo=$_POST["general-estilo"];
        $generalfallas=$_POST["general-fallas"];
        $generalvida=$_POST["general-vida"];
        $fallas=$_POST["fallas"];
        $descripcion=$_POST["descripcion"];
        $nota=$_POST["nota"];

        /* hacemos la consulta para insertar en la tabla de la base de datos */
        $sql=$conexion->query(
            "UPDATE general 
            SET Ejemplo=$generalestilo,Sin_fallas=$generalfallas,Maravilloso=$generalvida,Comentario='$descripcion',Nota=$nota,Fallas='$fallas',Aroma=$aroma,Apariencia=$apariencia,Sabor=$sabor,Sensacion=$sensacion, Juzgado=1
            WHERE Id=$Id AND Juzgado=0");
            
        /* validamos si se registro correctamente */
    
        if ($sql==1) {
            echo "<div class='alert alert-success'> Juzgamiento registrado exitosamente </div>";
            header ("location:estadisticas/stats.php?Id=$Id");
            
            
        } else {
            echo "<div class='alert alert-danger'>Error 404 </div>";
        };

    }else {
        header ("location:index_juzgamiento.php");

    };
}
?>