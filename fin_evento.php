<?php


include "config/conexion.php";

$sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
$dat=$sql->fetch_object();

// que haya al menos un evento
if ($dat!=null) {
	
	//que tome la fecha de hoy
	$hoy = date('Y-m-d');
	//que compare si ya es la fecha final para la inscripción
	if (($dat->Fecha_fin)<=$hoy) {
		//que actualice el evento y lo deshabilite para la inscripción
		$sql=$conexion->query(" UPDATE evento SET = Activo=1 WHERE Id_evento=($dat->Id_evento)");

		if ($sql == 1) {
			
			/* echo "<div style='color: white;
			padding: 0 0 20px 0;
			text-align: center;
			color: #fff;
			font-size: 20px;'>Sistema actualizado</div>"; */
			echo "<script> location.reload(true);
			
			</script>";

		} else {
			
			echo "<div style='color: white;
			padding: 0 0 20px 0;
			text-align: center;
			color: #fff;
			font-size: 20px;'>Ocurrio un error</div>";

		}
		
	}
    
}

?>