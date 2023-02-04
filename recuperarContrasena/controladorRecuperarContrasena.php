<?php   

$loginPass = 10;
$contrasena = substr(md5(microtime()), 1, $loginPass);

$hash=password_hash($contrasena, PASSWORD_DEFAULT,  ['cost'=>10]);


if (!empty($_POST["recuperar"])) {
    
    if (!empty($_POST["correo"])) {

        $correo=$_POST["correo"];

        $sql=$conexion->query(" SELECT * FROM usuarios WHERE Correo = '$correo'");

        if (mysqli_num_rows($sql) > 0) {
            
            $conexion->query(" UPDATE usuarios SET Contrasena = '$contrasena', Hash512='$hash' WHERE Correo = '$correo' ");

            include "correo.php";

            echo '<div class="verificado">
            <script language="javascript">
            
            alert("¡Todo salio bien! \nRevise su correo");
            history.pushState(null, null, window.location.href);
            window.location.href="../login/login.php";

            </script>
            </div>';
            
        }else{

            echo "<div style='color: white;
            padding: 0 0 30px 0;
            text-align: center;
            font-size: 25px;'>Alguno de los datos es invalido</div>";

        }

    } else {

        echo "<div style='color: white;
            padding: 0 0 30px 0;
            text-align: center;
            font-size: 25px;'>Campos vacios</div>";

    }
    

}


?>
