<?php

/* aqui se hace la comprobacion: si el boton no está vacio, hacer X cosa */

if (!empty($_POST["btnmodificar"])) {

    if (!empty($_POST["aroma"]) and !empty($_POST["apariencia"]) and !empty($_POST["sabor"]) and !empty($_POST["sensacion"]) and !empty($_POST["general-estilo"]) and !empty($_POST["general-fallas"]) and !empty($_POST["general-vida"]) and !empty($_POST["fallas"]) and !empty($_POST["descripcion"]) and !empty($_POST["nota"])) {
        
        $id=$_POST["Id"];
        $aroma=$_POST["aroma"];
        $apariencia=$_POST["apariencia"];
        $sabor=$_POST["sabor"];
        $sensacion=$_POST["sensacion"];
        $generalestilo=$_POST["general-estilo"];
        $generalfallas=$_POST["general-fallas"];
        $generalvida=$_POST["general-vida"];
        $fallas=$_POST["fallas"];
        $descripcion=$_POST["descripcion"];
        $nota=$_POST["nota"];

        $total=$aroma+$apariencia+$sabor+$sensacion+$nota;

    }else {
        if(empty($_POST("aroma"))){
            echo "<div class='alert alert-warning'> aroma campo está vacío </div>";
        };
        if (empty($_POST("apariencia"))) {
            echo "<div class='alert alert-warning' >apariencia campo está vacío </div>";
        };
        if (empty($_POST("sabor"))) {
            echo "<div class='alert alert-warning'> sabor vida campo está vacío </div>";
        };
        if (empty($_POST("sensacion"))) {
            echo "<div class='alert alert-warning'> sensacion campo está vacío </div>";
        };
        if (empty($_POST("general-estilo"))) {
            echo "<div class='alert alert-warning'> general estilo campo está vacío </div>";
        };
        if (empty($_POST("general-fallas"))) {
            echo "<div class='alert alert-warning' >gevariableneral fallas campo está vacío </div>";
        };
        if (empty($_POST("general-vida"))) {
            echo "<div class='alert alert-warning'> general vida campo está vacío </div>";
        };
        if (empty($_POST("fallas"))) {
            echo "<div class='alert alert-warning'> fallas campo está vacío </div>";
        };
        if (empty($_POST("descripcion"))) {
            echo "<div class='alert alert-warning'> descripcion  campo está vacío </div>";
        };
        if (empty($_POST("general-nota"))) {
            echo "<div class='alert alert-warning'>  nota campo está vacío </div>";
        };
    }
    /* las variables toman el valor de los campos del formulario a traves de los valores "name" */
       
    /* hacemos la consulta para insertar en la tabla de la base de datos */
    

    $sql=$conexion->query(
        "UPDATE general SET Ejemplo=$generalestilo,Sin_fallas=$generalfallas,Maravilloso=$generalvida,Comentario='$descripcion',Nota=$nota,Fallas='$fallas',Aroma=$aroma,Apariencia=$apariencia,Sabor=$sabor,Sensacion=$sensacion
        WHERE Id=$id");
        
        if ($sql==1) {
            header("location:index_juzgamiento.php");
        } else {
            echo "<div class='alert alert-danger'>Error en la modificación</div>";
        }
    }

?>  