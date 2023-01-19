<!-- aqui se toma el id mediante el name que mandamos desde el index para la modificacion -->
<?php
include "modelo/conexion.php";
$id=$_GET["Id"];

$sql=$conexion->query("SELECT * FROM general WHERE Id=$id");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar juzgamiento</title>
    <link rel="stylesheet" href="http://localhost/proyectoalba/css/modificarJuzgamiento.css">
    <link rel="stylesheet" href="../../css/modificarJuzgamiento.css">
    <link rel="icon" href="../../img/LOGO ALBA V.png">
</head>
<body>

<h3 class="titulo">Modificar Juzgamiento</h3>
    <div class="container">
        <div class="grande">
            <form class="form-horizontal p-5 m-auto" method="POST">
                <div class="form">
                <input type="hidden" name="Id" value="<?= $_GET["Id"] ?>">
                <?php

                    include "../controladoresJuzgamiento/modificarJuzgamiento.php";

                    /* recorre los datos y los va mostrando */
                    while ($datos=$sql->fetch_object()) {?>

                    <div class="aroma">
                    <h4 class="text-left text-secondary">Aroma</h4>
                    <div class="form-group row">

                        <!--  -->
                        <input type="hidden" name="Id" value="<?=$datos->Id?>">
                        <!--  -->

                    </div>
                        <div class="mb-2 col-sm-14">
                        <h5 class="text-left text-secondary">Malta</h5>
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
                        <h5 class="text-left text-secondary">Lúpulos</h5>
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
                        <h5 class="text-left text-secondary">Fermentación</h5>
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
                        <input type="text" class="form-control" name="aroma-descripcion" placeholder="Descripción" require >
                        </div>
                        <div class="mb-2 col-sm-14">
                        <input type="Number" min="0" max="12"  class="form-control" name="aroma" placeholder="Nota" require value="<?=$datos->Aroma?>">
                        </div>               
                        </div>
                        <!-- --------------------------------------------------------------------- -->

                        <div class="apariencia">
                        <h4 class="text-left text-secondary">Apariencia</h4>
                        <div class="mb-2 col-sm-14">
                        <div class="mb-2 col-sm-14">
                            <input type="text" class="form-control" name="apariencia-inspeccion" placeholder="Inspección de botella" require>
                        </div>
                        <h5 class="text-left text-secondary">Color</h5>
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
                        <h5 class="text-left text-secondary">Claridad</h5>
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
                        <h5 class="text-left text-secondary">Espuma</h5>
                        <div class="mb-2 col-sm-14">
                            <h6 class="text-left text-secondary">Color</h6>
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

                        <div class="mb-2 col-sm-14">
                            <h6 class="text-left text-secondary">Formación de espuma</h6>
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
                            <h6 class="text-left text-secondary">Retención</h6>
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
                        </div>

                        <div class="mb-2 col-sm-14">
                        <input type="text" class="form-control" name="apariencia-descripcion" placeholder="Descripción" require>
                        </div>
                        <div class="mb-2 col-sm-14">
                        <input type="Number" min="0" max="3"  class="form-control" name="apariencia" placeholder="Nota" require value="<?=$datos->Apariencia?>">
                        </div> 
                        </div>

                        <!-- </div> -->
                        <!-- -------------------------------------------------------------------------------------------- -->
                        
                        <div class="sabor">
                        <h4 class="text-left text-secondary">Sabor</h4>
                        <div class="mb-2 col-sm-14">
                        <h5 class="text-left text-secondary">Malta</h5>
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
                        <h5 class="text-left text-secondary">Lúpulos</h5>
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
                        <h5 class="text-left text-secondary">Amargor</h5>
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
                        <h5 class="text-left text-secondary">Fermentación</h5>
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
                        <h5 class="text-left text-secondary">Equilibrio</h5>
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
                        <h5 class="text-left text-secondary">Final/Retrogusto</h5>
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
                        <input type="text" class="form-control" name="sabor-descripcion" placeholder="Descripción" require>
                        </div>
                        <div class="mb-2 col-sm-14">
                        <input type="Number" min="0" max="20"  class="form-control" name="sabor" placeholder="Nota" require value="<?=$datos->Sabor?>">
                        </div>
                        </div>
                        <!-- ---------------------------------------------------------- -->
                        <div class="sensacion">

                        <h4 class="text-left text-secondary">Sensación en boca</h4>
                        <div class="mb-2 col-sm-14">
                        <h5 class="text-left text-secondary">Cuerpo</h5>
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
                        <h5 class="text-left text-secondary">Carbonatación</h5>
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
                        <h5 class="text-left text-secondary">Calentamiento</h5>
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
                        <h5 class="text-left text-secondary">Cremosidad</h5>
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
                        <h5 class="text-left text-secondary">Astringencia</h5>
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
                        <input type="text" class="form-control" name="sensacionboca-descripcion" placeholder="Descripción" require>
                        </div>
                        <div class="mb-2 col-sm-14">
                        <input type="Number" min="0" max="5"  class="form-control" name="sensacion" placeholder="Nota" require value="<?=$datos->Sensacion?>">
                        </div>

                        </div>
                        <!-- ---------------------------------------------------------------------- -->

                        <!-- -------------------------------------------------------------------------- -->
                        <div class="general">
                        <h4 class="text-left text-secondary">General</h4>
                        <div class="mb-2 col-sm-14">
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
                        </div>
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
                            <datalist id="general-vida">
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
                        <input type="text" name="fallas" placeholder="Fallas" require value="<?=$datos->Fallas?>">
                        </div>
                        <div class="mb-2 col-sm-14">
                        <input type="text" name="descripcion" placeholder="Descripción" require value="<?=$datos->Comentario?>">
                        </div>
                        <div class="mb-2 col-sm-14">
                        <input type="number" min="0" max="10" name="nota" placeholder="Nota" require value="<?=$datos->Nota?>">
                        </div>
                        </div>
                    
                <?php 
                    }
                ?>
                <input type="button" class="btn btn-secondary" onclick="history.back()" name="volver atrás" value="Volver atrás"></input>
                <!-- -------------------------------------------------------------------------- --> 
                <button type="submit" class="btn btn-primary" name="btnmodificar" value="ok">Agregar cambios</button>
            </div>
            </form>
        </div>
    </div>
</body>
</html>