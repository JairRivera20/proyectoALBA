<!-- controlador para agregar un nuevo evento desde la pagina y se guarde en la base de datos -->
<?php 
$sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
$alt=$sql->fetch_object();

if ($alt!=null) {
    $check=$alt->Nombre;
}else {
    $check='ok';
}


if (!empty($_POST["agregarEvento"])) {

    if (!empty($_POST["nombreEvento"]) and !empty($_POST["fecha"]) and !empty($_POST["lugar"])) {

        $nombreEvento=$_POST["nombreEvento"];
        $fecha=$_POST["fecha"];
        $lugar=$_POST["lugar"];

        if ($check!='') {

            $sql=$conexion->query(" INSERT INTO evento (Nombre, Fecha, Lugar) VALUES ('$nombreEvento', '$fecha', '$lugar') ");

            if ($sql == 1) {
                
                echo "<div style='color: white;
                padding: 0 0 20px 0;
                text-align: center;
                color: #fff;
                font-size: 20px;'>Evento registrado</div>";

            } else {
                
                echo "<div style='color: white;
                padding: 0 0 20px 0;
                text-align: center;
                color: #fff;
                font-size: 20px;'>Ocurrio un error</div>";

            }

        } else {

            $sql=$conexion->query("SELECT * FROM evento WHERE Nombre='' ORDER BY Id_evento ASC");

            $desk=$sql->fetch_object();

            $evento=$desk->Id_evento;

            $sql=$conexion->query("UPDATE evento SET Nombre='$nombreEvento',Fecha='$fecha',Lugar='$lugar' WHERE Id_evento=$evento");

            if ($sql == 1) {
                
                echo "<div style='color: white;
                padding: 0 0 20px 0;
                text-align: center;
                color: #fff;
                font-size: 20px;'>Evento registrado</div>";

            } else {
                
                echo "<div style='color: white;
                padding: 0 0 20px 0;
                text-align: center;
                color: #fff;
                font-size: 20px;'>Ocurrio un error</div>";

            }
        
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
