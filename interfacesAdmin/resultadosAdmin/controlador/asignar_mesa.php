<?php
/* comprobacion despues de rellenar el formulario */

if(!empty($_POST["btnasignar"])) {

    $Id=$_POST["Id_juz"];
    $cerveza=$_POST["cerveza"];
    $usuario=$_POST["usuario"];
    $mesa=$_POST["mesa"];
    

    /* hacemos la consulta para insertar en la tabla de la base de datos */
    $sql=$conexion->query(
        "INSERT INTO general (Id,fk_cerveza,fk_usuario,Ejemplo,Sin_fallas,Maravilloso,Comentario,Nota,Fallas,Aroma,Apariencia,Sabor,Sensacion,Juzgado)
        VALUES ('$Id',$cerveza,$usuario,'','','','','','','','','','',0)");
        
    /* validamos si se registro correctamente */

    if ($sql==1) {
        echo "<div class='alert alert-success'> Juzgamiento registrado exitosamente </div>";
        header ("location:mesas.php");
        
    } else {
        echo "<div class='alert alert-danger'>Error 404 </div>";
    };

};

?>