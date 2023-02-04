
<?php
include('modelo/conexion.php');
$id = $_REQUEST['id'];

$update = ("UPDATE cerveza SET Pendiente=1 WHERE Id_cerveza=$id");
$result_update = mysqli_query($conexion, $update);

echo "<script type='text/javascript'>
        window.location='index.php';
    </script>";

?>
