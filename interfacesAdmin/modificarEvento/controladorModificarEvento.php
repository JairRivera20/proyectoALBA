<!-- controlador para poder modificar los datos desde la pagina y se guarden en la base de datos -->
<?php 

if (!empty($_POST["modificarEvento"])) {
    
    if (!empty($_POST["nombreEvento"]) and !empty($_POST["fecha"]) and !empty($_POST["lugar"])) {
        
        $id=$_POST["Id"];
        $nombreEvento=$_POST["nombreEvento"];
        $fecha=$_POST["fecha"];
        $lugar=$_POST["lugar"];
        $sql=$conexion->query(" UPDATE evento SET Nombre='$nombreEvento', Fecha='$fecha', Lugar='$lugar' WHERE Id_evento=$id ");

        if ($sql == 1) {
            
            header("location: ../evento.php");

        } else {
            
            echo "<div style='color: white;
            padding: 0 0 20px 0;
            text-align: center;
            color: #fff;
            font-size: 20px;'>Ocurrio un error</div>";

        }

    } else {
        
        echo "<div style='color: white;
        padding: 0 0 20px 0;
        text-align: center;
        color: #fff;
        font-size: 20px;'>Campos vacios</div>";

    }
    
}

?>