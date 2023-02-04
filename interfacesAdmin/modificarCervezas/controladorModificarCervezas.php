<?php

/* aqui se hace la comprobacion: si el boton no está vacio, hacer X cosa */

if (!empty($_POST["btnmodificarcerveza"])) {

    if (!empty($_POST["nombre"]) and !empty($_POST["codigo"]) and !empty($_POST["usuario"]) and !empty($_POST["estilos"])) {
       
       $Id_cerveza=$_POST["Id_cerveza"];
       $nombre=$_POST["nombre"];
       $codigo=$_POST["codigo"];
       $usuario=$_POST["usuario"];
       $estilo=$_POST["estilos"];

       /* los atributos de la base de datos toman el valor de las variables antes definidas */

        $sql_3=$conexion->query(
        "UPDATE cerveza 
        SET Nombre='$nombre', Codigo='$codigo', fk_usuario=$usuario, fk_estilo=$estilo
        WHERE Id_cerveza=$Id_cerveza");
        
        if ($sql_3==1) {
            header("location: ../editarCervezas.php");
        } else {
            echo "<div style='color: white;
            padding: 0 0 20px 0;
            text-align: center;
            color: #fff;
            font-size: 20px;'>Error en la modificación</div>";
        }
    }else {
        if (empty($_POST["nombre"])) {
            echo "<div style='color: white;
            padding: 0 0 20px 0;
            text-align: center;
            color: #fff;
            font-size: 20px;'>Nombre está vacío</div>";
        }
        if (empty($_POST["codigo"])) {
            echo "<div style='color: white;
            padding: 0 0 20px 0;
            text-align: center;
            color: #fff;
            font-size: 20px;'>Codigo está vacío</div>";
        }
        if (empty($_POST["usuario"])) {
            echo "<div style='color: white;
            padding: 0 0 20px 0;
            text-align: center;
            color: #fff;
            font-size: 20px;'>Usuario está vacío</div>";
        }
        if (empty($_POST["estilos"])) {
            echo "<div style='color: white;
            padding: 0 0 20px 0;
            text-align: center;
            color: #fff;
            font-size: 20px;'>Estilos está vacío</div>";
        }
        /* echo "<div style='color: white;
        padding: 0 0 20px 0;
        text-align: center;
        color: #fff;
        font-size: 20px;'>Algún campo está vacío</div>"; */
    }
}

?>  