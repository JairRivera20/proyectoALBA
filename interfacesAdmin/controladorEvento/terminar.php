<!-- controlador para agregar un nuevo evento desde la pagina y se guarde en la base de datos -->
<?php 

if (!empty($_POST["btnTerminar"])) {

    if (!empty($_POST["terminar"])) {
        

        $sql=$conexion->query(" INSERT INTO evento (Nombre, Fecha, Lugar) VALUES ('', '', '') ");

        if ($sql == 1) {
            
            /* echo "<div style='color: white;
            padding: 0 0 20px 0;
            text-align: center;
            color: #fff;
            font-size: 20px;'>Evento registrado</div>"; */
            echo "<script> location.reload(true);
            
            </script>";

        } else {
            
            echo "<div style='color: white;
            padding: 0 0 20px 0;
            text-align: center;
            color: #fff;
            font-size: 20px;'>Ocurrio un error</div>";

        }
        
        
    }else {
        
        echo "<div 
        style='color: white;
        padding: 0 0 20px 0;
        text-align: center;
        color: #fff;
        font-size: 20px;'>Campos vacios</div>";

    }
}

?>