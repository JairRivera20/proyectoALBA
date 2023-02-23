<?php
if (!empty($_GET["Mesa"])) {
    $mesa=$_GET["Mesa"];

    $sql=("SELECT * FROM general WHERE Mesa=$mesa");

    $query=mysqli_query($conexion,$sql);
    $filas=mysqli_fetch_all($query, MYSQLI_ASSOC);

    foreach ($filas as $fila) {
        $cerveza = $fila['fk_cerveza'];
        $usuario = $fila['fk_usuario'];
        
        $sql_cerveza = "UPDATE cerveza SET Seleccionada=0 WHERE Id_cerveza='$cerveza'";
        $sql_usuario = "UPDATE usuarios SET Seleccionado=0 WHERE Id_usuario='$usuario'";
        
        $conexion->query($sql_cerveza);
        $conexion->query($sql_usuario);
    }
    
    $sql=$conexion->query("DELETE FROM general WHERE Mesa=$mesa");
    
    
}
?>