<?php
/* comprobacion despues de rellenar el formulario */

if(!empty($_POST["btnasignar"])) {
    if (!empty($_POST["cerveza"]) and !empty($_POST["usuario"]) and !empty($_POST['mesa'])) {

        $Id=$_POST["Id_juz"];
        $cerveza=$_POST["cerveza"];
        $usuario=$_POST["usuario"];
        $mesa=$_POST['mesa'];
        

        /* hacemos la consulta para insertar en la tabla de la base de datos */
        $sql=$conexion->query(
            "INSERT INTO general (Id,fk_cerveza,fk_usuario,Ejemplo,Sin_fallas,Maravilloso,Comentario,Nota,Fallas,Aroma,Apariencia,Sabor,Sensacion,Juzgado,Mesa)
            VALUES ('$Id',$cerveza,$usuario,'','','','','','','','','','',0,$mesa)");
            
        /* validamos si se registro correctamente */

        if ($sql==1) {
            echo "<div style='color: white;
            padding: 0 0 20px 0;
            text-align: center;
            color: #fff;
            font-size: 20px;'> Asignación exitosa </div>";
            /* header ("location: mesas.php"); */
            
        } else {
            echo "<div class='alert alert-danger'>Error 404 </div>";
        };
    }else{
        echo "<div style='color: white;
            padding: 0 0 20px 0;
            text-align: center;
            color: #fff;
            font-size: 20px;'> Campos vacíos</div>";
    };

    

};

?>