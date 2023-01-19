<?php
include('../modelo/conexion.php');
$id = $_REQUEST['id'];

$DeleteRegistro = ("DELETE FROM cerveza WHERE Id_cerveza=$id");
mysqli_query($conexion, $DeleteRegistro);
?>