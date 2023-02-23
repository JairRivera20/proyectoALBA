<?php
/* comprobacion despues de rellenar el formulario */

if(isset($_POST['btnasignar'])) {

    if(isset($_POST['mesa']) and isset($_POST['beer']) and isset($_POST['user'])){

        $mesa=$_POST["mesa"];
        $beer=$_POST["beer"];
        $user=$_POST["user"];

        /* hacemos la consulta para insertar en la tabla de la base de datos */
		
		$sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
		$alt=$sql->fetch_object();

		$a=0;
		
		while($a<$user){
			$cata=$_POST['cata'.$a];
			$b=0;
			while($b<$beer){
					
				$cer=$_POST['cerveza'.$b];
			
				/* insertar datos */
				$sql=$conexion->query(
				"INSERT INTO general (Id,fk_cerveza,fk_usuario,Ejemplo,Sin_fallas,Maravilloso,Comentario,Nota,Fallas,Aroma,Apariencia,Sabor,Sensacion,Juzgado,Mesa,fk_evento)
				VALUES ('','$cer','$cata','','','','','','','','','','',0,$mesa,($alt->Id_evento))");
				$sql=$conexion->query("UPDATE cerveza SET Seleccionada=1 WHERE Id_cerveza=$cer");
				$b++;	
			}
			$sql=$conexion->query("UPDATE usuarios SET Seleccionado=1 WHERE Id_usuario=$cata");
			$a++;
		}
		
            
        /* validamos si se registro correctamente */

        if ($sql==1) {
            echo "<div style='color: white;
			padding: 0 0 30px 0;
			text-align: center;
			color: #fff;
			font-size: 20px;'> Asignación satisfactoria </div>";
            
            
            
        } else {
            echo "<div style='color: white;
			padding: 0 0 30px 0;
			text-align: center;
			color: #fff;
			font-size: 20px;''>Error 404 </div>";
            
        };

    }
    
};

?>