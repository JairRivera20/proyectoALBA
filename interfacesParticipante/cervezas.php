<?php
session_start();
if (empty($_SESSION["Id_usuario"])) {
    header("location: ../login/login.php");
}else if (!empty($_SESSION["Rol"] != 3)) {

    session_start();
    session_destroy();
    header("location: ../login/login.php");
}
include '../config/conexion.php';
$id=$_SESSION['Id_usuario'];

$sql=$conexion->query("SELECT*FROM cerveza WHERE fk_usuario=$id");

$datos=$sql->fetch_object();

if ($datos!=null) {

    $ok=1;

}else {
    $ok=0;
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cervezas</title>
    <link rel="stylesheet" href="../css/cervezas1.css">
    <link rel="icon" href="../img/Logo.png">
</head>
    <?php include("menuParticipante.php"); ?>
    <div>
	<div class="table-responsive">
		<div class="container">
		<table>
			<thead>
				<tr>
					<th>Categoria</th>
					<th>Estilo</th>
					<th>Código</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>
        <?php
        if ($ok==1) {
            $sql=$conexion->query("SELECT estilos.Nombre AS Estilo,categorias.Nombre AS Categoria,cerveza.Pendiente, cerveza.Codigo
            FROM cerveza
            INNER JOIN estilos ON estilos.Id_estilo=cerveza.Id_cerveza
            INNER JOIN categorias ON categorias.Id_categoria=estilos.fk_categoria
            WHERE fk_usuario=$id");
            
            while ($alt=$sql->fetch_object()) {
                ?>
                            <tr>
                                
                                <td><?=$alt->Categoria?></td>
                                <td><?=$alt->Estilo?></td>
								<td><?=$alt->Codigo?></td>
								<td><?php 
                                    $p=$alt->Pendiente;
                                    if ($p==1) {
                                        echo "Aceptada";
                                    }else {
                                        echo "En espera";
                                    }?>
                                </td>
                            </tr>
                <?php
            }
        }else {
            echo "<div class='noCervezas';>No tienes cervezas registradas</div>";
        }
        ?>
				</tbody>
			</table>
		</div>
	</div>
    </div>
    
    
</body>
</html>