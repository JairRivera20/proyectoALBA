<!-- controlador para eliminar usuarios y con respectivo id de cada evento -->
<?php 

if (!empty($_GET["Id_usuario"])) {
    
    $id=$_GET["Id_usuario"];
    $sql=$conexion->query(" DELETE FROM usuarios WHERE Id_usuario=$id ");

    if ($sql == 1) { 
            
        echo "<div style='color: white;
        padding: 0 0 20px 0;
        text-align: center;
        color: #fff;
        font-size: 20px;'>Usuario eliminado correctamente</div>";

    } else {
        
        echo "<div style='color: white;
        padding: 0 0 20px 0;
        text-align: center;
        color: #fff;
        font-size: 20px;'>Ocurrio un error</div>";

    }
        
}

?>