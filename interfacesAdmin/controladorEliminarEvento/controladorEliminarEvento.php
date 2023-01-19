<!-- controlador para eliminar eventos y con respectivo id de cada evento -->
<?php 

if (!empty($_GET["Id"])) {
    
    $id=$_GET["Id"];
    $sql=$conexion->query(" DELETE FROM evento_usuarios WHERE fk_evento=$id ");
    $sql=$conexion->query(" DELETE FROM evento WHERE Id_evento=$id ");

    if ($sql == 1) { 
            
        echo "<div style='color: white;
        padding: 0 0 20px 0;
        text-align: center;
        color: #fff;
        font-size: 20px;''>Evento eliminado correctamente</div>";

    } else {
        
        echo "<div style='color: white;
        padding: 0 0 20px 0;
        text-align: center;
        color: #fff;
        font-size: 20px;'>Ocurrio un error</div>";

    }
        
}

?>