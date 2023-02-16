<?php

/* comprobacion despues de rellenar el formulario */

if(!empty($_POST["btnregistrar"])){
    if (!empty($_POST["codigo"]) and !empty($_POST["usuario"]) and !empty($_POST["estilos"]) and !empty($_POST['muestras'])) {
    
    /* las variables toman el valor de los campos del formulario a traves de los valores "name" */
    $muestras=$_POST["muestras"];
    $codigo=$_POST["codigo"];
    $usuario=$_POST["usuario"];
    $estilo=$_POST["estilos"];

    /* hacemos la consulta para insertar en la tabla de la base de datos */

    $sql=$conexion->query(
        "INSERT INTO cerveza (Id_cerveza,Codigo,fk_usuario,fk_estilo,Muetsras,Pendiente) 
        VALUES ('','$codigo',$usuario,$estilo,$muestras,1) ");
    /* validamos si se registro correctamente */
    if ($sql==1) {
        echo "<div style='color: white;
        padding: 0 0 20px 0;
        text-align: center;
        color: #fff;
        font-size: 20px;'> Cerveza registrada exitosamente </div>";
    } else {
        echo "<div style='color: white;
        padding: 0 0 20px 0;
        text-align: center;
        color: #fff;
        font-size: 20px;'> Cerveza registrada sin éxito </div>";
    }
} else {

    echo "<div style='color: white;
    padding: 0 0 20px 0;
    text-align: center;
    color: #fff;
    font-size: 20px;'> Algún campo está vacío </div>";

}
    
}


?>