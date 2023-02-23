<?php
if (!empty($_POST['btn'])){
	if($_POST['token']==="ok"){
		$_POST["Id_usuario"];
		
		$id=$_SESSION["Id_usuario"];
        $sql = $conexion -> query("UPDATE usuarios SET Foto=NULL WHERE Id_usuario=$id");

        if ($sql == 1) { 
                
            echo 
			"<script>
			setTimeout(function() {
			  location.reload();
			}, 100);
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