<?php 

if (!empty($_POST["verificar"])) {
    
    if (!empty($_POST["correo"]) and !empty($_POST["codigo"])) {

        $correo=$_POST["correo"];
        $codigo=$_POST["codigo"];
        
        $sql=$conexion->query(" SELECT * FROM usuarios WHERE Correo = '$correo' AND Codigo = '$codigo' ");

        if (mysqli_num_rows($sql) > 0) {
            
            $conexion->query(" UPDATE usuarios SET Activado = 1 WHERE Correo = '$correo' ");

            echo '<div class="verificado">
            <script language="javascript">
            
            alert("Todo correcto");
            history.pushState(null, null, window.location.href);
            window.location.href="../../login/login.php";

            </script>
            </div>';
            
        }else{

            echo "<div style='color: white;
            padding: 0 0 30px 0;
            text-align: center;
            font-size: 25px;'>Este Código es invalido</div>";

        }

    } else {

        echo "<div style='color: white;
            padding: 0 0 30px 0;
            text-align: center;
            font-size: 25px;'>Campos vacios</div>";

    }
    

}


?>