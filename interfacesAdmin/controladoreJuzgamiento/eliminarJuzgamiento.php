<?php
if (!empty($_GET["Id"])) {
    $id=$_GET["Id"];
    $sql=$conexion->query("DELETE FROM general WHERE Id=$id");
    if ($sql==1) {
        echo "<div class='alert alert-success'>Juzgamiento eliminado exitosamente</div>";
        
    } else {
        echo "<div class='alert alert-danger'>Error en la eliminación</div>";
    }
    
}
?>