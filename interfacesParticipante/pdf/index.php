<?php
session_start();

if (empty($_SESSION["Id_usuario"])) {
    header("location: ../login/login.php");
} else if (!empty($_SESSION["Rol"] != 3)) {
    session_start();
    session_destroy();
    header("location: ../login/login.php");
}

include '../../config/conexion.php';

$id = $_SESSION['Id_usuario'];

require "vendor/autoload.php";

$sql = $conexion->query("SELECT * FROM usuarios WHERE Id_usuario = $id");
$alt = $sql->fetch_object();


$html = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Códigos de cerveza ".$alt->Nombre." ".$alt->Apellido."</title>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap' rel='stylesheet'>
    <link rel='icon' href='../../img/Logo.png'>
    
    <style>
        *{
            font-family: 'Open Sans', 'sans-serif';
        }
        
        .container{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        
        .principal{
            border-collapse: collapse;
            border: 1px solid black;
            margin-bottom: 1rem;
            width: 30%;
        }
        
        .column {
            width: 32%;
            display: inline-block;
            vertical-align: top;
        }
          
    </style>
    
</head>
<body>
<div class='container'>
    <div class='column'>
";

$sql = $conexion->query("SELECT cerveza.Codigo, cerveza.Muestras, estilos.Nombre AS Estilo, categorias.Nombre AS Categoria, cerveza.Pendiente
FROM cerveza
INNER JOIN estilos ON estilos.Id_estilo=cerveza.Id_cerveza
INNER JOIN categorias ON categorias.Id_categoria=estilos.fk_categoria
WHERE fk_usuario=$id");

$count = 0;
while ($datos = $sql->fetch_object()) {
    $a = 0;
    while ($a < ($datos->Muestras)) {
        if ($count % 3 == 0 && $count != 0) {
            $html .= "
    </div>
    <div class='column'>
            ";
        }

        $html .= "
            <table class='principal'>
                
                <tr>
                    <table>
                        <th>Código: </th>
                        <td>".$datos->Codigo."</td>
                    </table>
                    
                    <table>
                        <th>Categoría: </th>
                        <td>".$datos->Categoria."</td>
                    </table>
                    
                    <table>
                        <th>Estilo: </th>
                        <td>".$datos->Estilo."</td>
                    </table>
                </tr>
                
            </table>
        ";

        $a++;
        $count++;
    }
}

$html .= "
    </div>
</div>
</body>
</html>
";

use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("documento.pdf",array('Attachment'=>'0'))
?>