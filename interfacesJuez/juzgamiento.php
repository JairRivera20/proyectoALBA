<?php
session_start();
if (empty($_SESSION["Id_usuario"])) {
    header("location: ../login/login.php");
    
}else if (!empty($_SESSION["Rol"] != 2)) {

    session_start();
    session_destroy();
    header("location: ../login/login.php");
}

$Id_usuario=$_SESSION['Id_usuario'];

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juzgamientos</title>

    <link rel="stylesheet" href="../css/juzgamiento3.css">
    <link rel="icon" href="../img/Logo.png">
    <!-- llamada de iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- jquery  -->
    <script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4=" crossorigin="anonymous"></script>
    <!-- boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<script>
    function reestablecer() {
        document.getElementById('formul').reset
    };
    function eliminar(){
        var respuesta=confirm("Estás a punto de eliminar un JUZGAMIENTO. ¿Deseas eliminar?");
        return respuesta
    };
    
</script>
</head>
<body>


<?php
        include "../config/conexion.php";
        $sql="SELECT COUNT(Id) AS n FROM general WHERE fk_usuario=$Id_usuario AND Juzgado=0";
        $query = mysqli_query($conexion, $sql);
        if ($query!=null) {
            $filas = mysqli_fetch_all($query, MYSQLI_ASSOC);  
            $res= $filas[0]['n'];
        }else{
            echo "<div class='noCervezas'; >NO TIENES CERVEZAS POR JUZGAR</div>";
            /* header("location:resultados.php"); */
        }
        
    ?>
   
<?php

    if ($res!=0) {
        ?>

        <?php
            include "../config/conexion.php";
            $sql=$conexion->query("SELECT Id, Juzgado,
            (SELECT Nombre FROM usuarios WHERE Id_usuario=general.fk_usuario AND Id_usuario=$Id_usuario) AS Usuario, 
            categorias.Nombre AS Categoria,estilos.Id_estilo, estilos.Nombre AS Estilo, cerveza.Codigo, general.Mesa
            FROM general 
            INNER JOIN cerveza ON general.fk_cerveza=cerveza.Id_cerveza
            INNER JOIN estilos ON cerveza.fk_estilo=estilos.Id_estilo
            INNER JOIN categorias ON estilos.fk_categoria=categorias.Id_categoria
            INNER JOIN usuarios ON cerveza.fk_usuario=usuarios.Id_usuario
            WHERE general.Juzgado=0
            LIMIT 0,1");
            $next=$sql->fetch_object();                              
        ?>

        <div class="container">
            
            <div class="titulo" style="color:white;">
                <h4>Calificación</h4>
                <h4 >Registro juzgamiento</h4>
                <h4>Mesa <?=$next->Mesa?></h4>  
            </div>


        <div class="grande" id="principio">
            <!-- formulario para rellenar la tabla de la basae de datos -->
            <form id="formul" method="POST">


                <div class="form movPag">
                
                    <div class="aroma">

                        <div class="textos">

                            
                            <h2>Codigo:</h2>
                            <input type="text" value="<?=$next->Codigo?>" readonly onmousedown="return false;">


                            <h2>Categoría:</h2>
                            <input type="text" value="<?=$next->Categoria?>" readonly onmousedown="return false;">
                            <br>


                            <div class="txtEstilos">
							<?php  include('./espanol.php'); ?>	
                                <button class="botonEstilos" type="button"  data-toggle="modal" data-target="#estiloS">
                                    <?=$next->Estilo?> - ES
                                </button>
                                

                                <button class="botonEstilos" type="button"  data-toggle="modal" data-target="#estiloN">
                                    <?=$next->Estilo?> - EN
                                </button>
								<?php  include('./ingles.php'); ?>
                                
                            </div>
                            <br>

                         
                        </div>

                        <h4 style="text-align: center;">Aroma</h4>
                        <!-- mostramos el resultado de la comprobacion -->
                        <?php            
                        include "controladoresJuzgamiento/registroJuzgamiento.php";
                        ?>
                        <!-- formulario para el ingreso de datos a la base de datos -->
                        <div class="form-group row">

                       <!--  <?php
                            /* include "../config/conexion.php";
                            $sql=$conexion->query("SELECT Id, Juzgado FROM general WHERE fk_usuario=$Id_usuario AND juzgado=0 LIMIT 0,1");
                            $next=$sql->fetch_object();  */                               
                        ?> -->

                            <!--  -->
                            <input type="hidden" name="Id" readonly value="<?=$next->Id?>">
                            <!--  -->
                            
                        </div>
                        <div class="mb-2 col-sm-14">
                            <h5>Malta</h5>
                            <span>
                                Bajo
                                <input type="range" name="aroma-malta" min="0" max="13" list="lista-aroma-malta">
                                    <datalist id="lista-aroma-malta">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10">
                                        <option value="11">
                                        <option value="12">
                                        <option value="13">
                                    </datalist>
                                Alto
                            </span>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <h5>Lúpulos</h5>
                            <span>
                                Bajo
                                <input type="range" name="aroma-lupulos" min="0" max="13" list="lista-aroma-lupulos">
                                    <datalist id="lista-aroma-lupulos">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10">
                                        <option value="11">
                                        <option value="12">
                                        <option value="13">
                                    </datalist>
                                Alto
                            </span>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <h5>Fermentación</h5>
                            <span>
                                Bajo
                                <input type="range" name="aroma-fermentacion" min="0" max="13" list="lista-aroma-fermentacion">
                                    <datalist id="lista-aroma-fermentacion">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10">
                                        <option value="11">
                                        <option value="12">
                                        <option value="13">
                                    </datalist>
                                Alto
                            </span>               
                        </div>
                        <div class="mb-2 col-sm-14">
                            <input type="text" name="aroma-descripcion" placeholder="Descripción" require>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <input type="Number" onkeyup="this.value = MinMaxNumber(this, this.value)" min="0" max="12" name="aroma" placeholder="Nota" require>
                        </div>   

                        <div class="botones">
                            <button type="button" onclick="history.back()" name="regresar" value="Regresar">Regresar</button>
                            <button type="button" onclick="miFuncion(); return false;" id="b1" class="bs siguiente">Siguiente</button>
                        </div>
                        
                        
                    </div>
                    <!-- --------------------------------------------------------------------- -->
                    
                    <div class="apariencia">
                        <h4 style="text-align: center;">Apariencia</h4>
                        <div class="mb-2 col-sm-14">
                                <div class="mb-2 col-sm-14">
                                    <input type="text" name="apariencia-inspeccion" placeholder="Inspección de botella" require>
                                </div>
                                <h5>Color</h5>
                                <span>
                                    Amarillo
                                    <input type="range" name="apariencia-color" min="0" max="13" list="lista-apariencia-color">
                                        <datalist id="lista-apariencia-color">
                                            <option value="1">
                                            <option value="2">
                                            <option value="3">
                                            <option value="4">
                                            <option value="5">
                                            <option value="6">
                                            <option value="7">
                                            <option value="8">
                                            <option value="9">
                                            <option value="10">
                                            <option value="11">
                                            <option value="12">
                                            <option value="13">
                                        </datalist>
                                    Negro
                                </span>
                        </div>
                            <div class="mb-2 col-sm-14">
                            <h5 >Claridad</h5>
                                <span>
                                    Brillante
                                    <input type="range" name="apariencia-claridad" min="0" max="13" list="lista-apariencia-claridad">
                                        <datalist id="lista-apariencia-claridad">
                                            <option value="1">
                                            <option value="2">
                                            <option value="3">
                                            <option value="4">
                                            <option value="5">
                                            <option value="6">
                                            <option value="7">
                                            <option value="8">
                                            <option value="9">
                                            <option value="10">
                                            <option value="11">
                                            <option value="12">
                                            <option value="13">
                                        </datalist>
                                    Opaco
                                </span>
                            </div>
                            <div class="mb-2 col-sm-14">
                                <h5 >Espuma</h5>
                                <div class="mb-2 col-sm-14">
                                    <h6>Color</h6>
                                    <span>
                                        Blanco
                                        <input type="range" name="espuma-color" min="0" max="13" list="lista-espuma-color">
                                            <datalist id="lista-espuma-color">
                                                <option value="1">
                                                <option value="2">
                                                <option value="3">
                                                <option value="4">
                                                <option value="5">
                                                <option value="6">
                                                <option value="7">
                                                <option value="8">
                                                <option value="9">
                                                <option value="10">
                                                <option value="11">
                                                <option value="12">
                                                <option value="13">
                                            </datalist>
                                        Marron
                                    </span>
                                </div>
                            </div>
                            
                                <div class="mb-2 col-sm-14">
                                    <h6 >Formación de espuma</h6>
                                    <span>
                                        Bajo
                                        <input type="range" name="espuma-formacion" min="0" max="13" list="lista-espuma-formacion">
                                            <datalist id="lista-espuma-formacion">
                                                <option value="1">
                                                <option value="2">
                                                <option value="3">
                                                <option value="4">
                                                <option value="5">
                                                <option value="6">
                                                <option value="7">
                                                <option value="8">
                                                <option value="9">
                                                <option value="10">
                                                <option value="11">
                                                <option value="12">
                                                <option value="13">
                                            </datalist>
                                        Alto
                                    </span>
                                </div>
                                <div class="mb-2 col-sm-14">
                                    <h6 >Retención</h6>
                                    <span>
                                        Rápido
                                        <input type="range" name="espuma-retencion" min="0" max="13" list="lista-espuma-retencion">
                                            <datalist id="lista-espuma-retencion">
                                                <option value="1">
                                                <option value="2">
                                                <option value="3">
                                                <option value="4">
                                                <option value="5">
                                                <option value="6">
                                                <option value="7">
                                                <option value="8">
                                                <option value="9">
                                                <option value="10">
                                                <option value="11">
                                                <option value="12">
                                                <option value="13">
                                            </datalist>
                                        Persistente
                                    </span>
                                
                            </div>
                            
                            <div class="mb-2 col-sm-14">
                                <input type="text" name="apariencia-descripcion" placeholder="Descripción" require>
                            </div>
                            <div class="mb-2 col-sm-14">
                                <input type="Number" onkeyup="this.value = MinMaxNumber(this, this.value)" min="0" max="3"  name="apariencia" placeholder="Nota" require>
                            </div>

                            <div class="botones">
                                <button class="ba atras1">Anterior</button>
                                <button class="bs siguiente2">Siguiente</button>
                            </div>
                    </div>
                    <!-- -------------------------------------------------------------------------------------------- -->
                    <div class="sabor">
                    
                        <h4 style="text-align: center;">Sabor</h4>
                        <div class="mb-2 col-sm-14">
                            <h5>Malta</h5>
                            <span>
                                Bajo
                                <input type="range" name="sabor-malta" min="0" max="13" list="lista-sabor-malta">
                                    <datalist id="lista-sabor-malta">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10">
                                        <option value="11">
                                        <option value="12">
                                        <option value="13">
                                    </datalist>
                                Alto
                            </span>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <h5 >Lúpulos</h5>
                            <span>
                                Bajo
                                <input type="range" name="sabor-lupulos" min="0" max="13" list="lista-sabor-lupulos">
                                    <datalist id="lista-sabor-lupulos">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10">
                                        <option value="11">
                                        <option value="12">
                                        <option value="13">
                                    </datalist>
                                Alto
                            </span>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <h5 >Amargor</h5>
                            <span>
                                Bajo
                                <input type="range" name="sabor-amargor" min="0" max="13" list="lista-sabor-amargor">
                                    <datalist id="lista-sabor-amargor">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10">
                                        <option value="11">
                                        <option value="12">
                                        <option value="13">
                                    </datalist>
                                Alto
                            </span>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <h5 >Fermentación</h5>
                            <span>
                                Bajo
                                <input type="range" name="sabor-fermentacion" min="0" max="13" list="lista-sabor-fermentacion">
                                    <datalist id="lista-sabor-fermentacion">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10">
                                        <option value="11">
                                        <option value="12">
                                        <option value="13">
                                    </datalist>
                                Alto
                            </span>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <h5 >Equilibrio</h5>
                            <span>
                                Bajo
                                <input type="range" name="sabor-equilibrio" min="0" max="13" list="lista-sabor-equilibrio">
                                    <datalist id="lista-sabor-equilibrio">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10">
                                        <option value="11">
                                        <option value="12">
                                        <option value="13">
                                    </datalist>
                                Alto
                            </span>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <h5>Final/Retrogusto</h5>
                            <span>
                                Bajo
                                <input type="range" name="sabor-retrogusto" min="0" max="13" list="lista-sabor-retrogusto">
                                    <datalist id="lista-sabor-retrogusto">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10">
                                        <option value="11">
                                        <option value="12">
                                        <option value="13">
                                    </datalist>
                                Alto
                            </span>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <input type="text"  name="sabor-descripcion" placeholder="Descripción" require>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <input type="Number" onkeyup="this.value = MinMaxNumber(this, this.value)" min="0" max="20"   name="sabor" placeholder="Nota" require>
                        </div>

                        <div class="botones">
                            <button class="ba atras2">Anterior</button>
                            <button class="bs siguiente3">Siguiente</button>
                        </div>
                    
                    </div>
                    <!-- ---------------------------------------------------------- -->
                    <div class="sensacion">
                    
                        <h4 style="text-align: center;">Sensación en boca</h4>
                        <div class="mb-2 col-sm-14">
                            <h5 >Cuerpo</h5>
                            <span>
                                Delgado
                                <input type="range" name="sensacionboca-cuerpo" min="0" max="13" list="lista-sensacionboca-cuerpo">
                                    <datalist id="lista-sensacionboca-cuerpo">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10">
                                        <option value="11">
                                        <option value="12">
                                        <option value="13">
                                    </datalist>
                                Lleno
                            </span>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <h5 >Carbonatación</h5>
                            <span>
                                Bajo
                                <input type="range" name="sensacionboca-carbonatacion" min="0" max="13" list="lista-sensacionboca-carbonatacion">
                                    <datalist id="lista-sensacionboca-carbonatacion">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10">
                                        <option value="11">
                                        <option value="12">
                                        <option value="13">
                                    </datalist>
                                Alto
                            </span>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <h5 >Calentamiento</h5>
                            <span>
                                Bajo
                                <input type="range" name="sensacionboca-calentamiento" min="0" max="13" list="lista-sensacionboca-calentamiento">
                                    <datalist id="lista-sensacionboca-calentamiento">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10">
                                        <option value="11">
                                        <option value="12">
                                        <option value="13">
                                    </datalist>
                                Alto
                            </span>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <h5 >Cremosidad</h5>
                            <span>
                                Bajo
                                <input type="range" name="sensacionboca-cremosidad" min="0" max="13" list="lista-sensacionboca-cremosidad">
                                    <datalist id="lista-sensacionboca-cremosidad">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10">
                                        <option value="11">
                                        <option value="12">
                                        <option value="13">
                                    </datalist>
                                Alto
                            </span>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <h5 >Astringencia</h5>
                            <span>
                                Bajo
                                <input type="range" name="sensacionboca-astringencia" min="0" max="13" list="lista-sensacionboca-astringencia">
                                    <datalist id="lista-sensacionboca-astringencia">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10">
                                        <option value="11">
                                        <option value="12">
                                        <option value="13">
                                    </datalist>
                                Alto
                            </span>
                        </div>
                        
                        <div class="mb-2 col-sm-14">
                            <input type="text" name="sensacionboca-descripcion" placeholder="Descripción" require>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <input type="Number" onkeyup="this.value = MinMaxNumber(this, this.value)" min="0" max="5"   name="sensacion" placeholder="Nota" require>
                        </div>

                        <div class="botones">
                            <button class="ba atras3">Anterior</button>
                            <button class="bs siguiente4">Siguiente</button>
                        </div>
                                
                    </div>
                    <!-- ---------------------------------------------------------------------- -->
                    
                    <!-- -------------------------------------------------------------------------- -->
                    <div class="general">
                        <h4 style="text-align: center;">General</h4>
                        <span>
                            No adecuado al estilo
                            <input type="range" name="general-estilo" min="0" max="13" list="lista-general-estilo">
                                <datalist id="lista-general-estilo">
                                    <option value="1">
                                    <option value="2">
                                    <option value="3">
                                    <option value="4">
                                    <option value="5">
                                    <option value="6">
                                    <option value="7">
                                    <option value="8">
                                    <option value="9">
                                    <option value="10">
                                    <option value="11">
                                    <option value="12">
                                    <option value="13">
                                </datalist>
                            Ejemplo clásico
                        </span>
                    
                        <div class="mb-2 col-sm-14">
                        
                            <span>
                                Defectos significativos
                                <input type="range" name="general-fallas" min="0" max="13" list="lista-general-fallas">
                                    <datalist id="lista-general-fallas">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10">
                                        <option value="11">
                                        <option value="12">
                                        <option value="13">
                                    </datalist>
                                Sin fallas
                            </span>
                        </div>
                        <div class="mb-2 col-sm-14">
                            
                            <span>
                                Sin vida
                                <input type="range" name="general-vida" min="0" max="13" list="lista-general-vida">
                                    <datalist id="lista-general-vida">
                                        <option value="1">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10">
                                        <option value="11">
                                        <option value="12">
                                        <option value="13">
                                    </datalist>
                                Maravilloso
                            </span>
                        </div>

                    
                    
                        <div class="mb-2 col-sm-14">
                            <input type="text" name="fallas" placeholder="Fallas" require>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <input type="text" name="descripcion" placeholder="Descripción" require>
                        </div>
                        <div class="mb-2 col-sm-14">
                            <input type="number" onkeyup="this.value = MinMaxNumber(this, this.value)" min="0" max="10" name="nota" placeholder="Nota" require>
                        </div>

                        <div id="b2" class="botones">
                            <button class="ba atras4">Anterior</button>
                            <button type="submit" name="btnjuzgar" value="ok" onclick=reestablecer()>Registrar</button>
                        </div>

                       <!--  <div class="boton">
                            
                        </div> -->

                    </div>

                </div>

            </form>

        </div>

        
    </div>

        <?php
        }else{
            echo "<div class='noCervezas';>NO TIENES MÁS CERVEZAS POR JUZGAR</div>";
            /* header("location:resultados.php"); */
        }
    ?>
    


    <!-- division de la pantalla hacia la izquierda -->

    <!-- ------------------------------------------------------------------------ -->
    
    <!-- llamado de archivo js para que se pueda ver la aminacion de siguiente y anterior en el formulario -->
    <script src="../js/moverFormulario.js"></script>

    <!-- llamado del archivo js para que se pueda lar la condicion del max y el min en la Nota -->
    <script src="../js/MinMaxNumber.js"></script>
    


    <!-- modal info -->
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4=" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $(window).on('load',function() {
                $(".cargando").fadeOut(1000);
            });

    });
    </script>

</body>
</html>