<?php
/* comprobacion despues de rellenar el formulario */

if(isset($_POST['btnasignar'])) {

    if(isset($_POST['mesa']) and isset($_POST['beer']) and isset($_POST['user'])){

        $mesa=$_POST["mesa"];
        $beer=$_POST["beer"];
        $user=$_POST["user"];

        /* hacemos la consulta para insertar en la tabla de la base de datos */
		
		$a=0;
		
		while($a<$user){
			$cata=$_POST['cata'.$a];
			$b=0;
			while($b<$beer){
					
				$cer=$_POST['cerveza'.$b];
			
				/* insertar datos */
				$sql=$conexion->query(
				"INSERT INTO general (Id,fk_cerveza,fk_usuario,Ejemplo,Sin_fallas,Maravilloso,Comentario,Nota,Fallas,Aroma,Apariencia,Sabor,Sensacion,Juzgado,Mesa)
				VALUES ('','$cer','$cata','','','','','','','','','','',0,$mesa)");
				
				$b++;	
			}
			$a++;
		}
		
            
        /* validamos si se registro correctamente */

        if ($sql==1) {
            echo "<div class='alert alert-success'> Asignación satisfactoria </div>";
            
            
            
        } else {
            echo "<div class='alert alert-danger'>Error 404 </div>";
            
        };

    }
    
};

?>