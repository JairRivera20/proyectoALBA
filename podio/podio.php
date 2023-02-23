<!-- este es el que está conectado a inicio -->
<?php
include "config/conexion.php";

if (!empty($_POST['btnPodio'])) {
    $sql=$conexion->query("SELECT Id_evento FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
        $data=$sql->fetch_object();
        $evento=$data->Id_evento;
        

        $sql=mysqli_query($conexion,"SELECT Id, fk_cerveza FROM general 
        WHERE fk_evento=$evento and Juzgado=1
        GROUP BY fk_cerveza");

        $cuantas = mysqli_num_rows($sql);

        if ($cuantas>=3) {

            $A=0;
            $B=0;
            $C=0;

            $puesto_1=0;
            $puesto_2=0;
            $puesto_3=0;
            
            while ($alt=$sql->fetch_object()) {

                $i=0;
                $resultado=0;
                
                $cerv=$alt->fk_cerveza;

                $query=$conexion->query("SELECT Id, Aroma, Apariencia, Sabor, Sensacion, Nota, fk_cerveza, Ejemplo, Sin_fallas, Maravilloso 
                FROM general 
                WHERE fk_cerveza=$cerv AND fk_evento=$evento AND Juzgado=1");
                

                

                    while($datos=$query->fetch_object()){

                        $i++;
                        $total=0;

                        $ejemplo=$datos->Ejemplo;

                        $sin_fallas=$datos->Sin_fallas;

                        $maravilloso=$datos->Maravilloso;
        
                        $aroma=$datos->Aroma;
        
                        $apariencia=$datos->Apariencia;
        
                        $sabor=$datos->Sabor;
                        
                        $sensacion=$datos->Sensacion;
                        
                        $nota=$datos->Nota;
        
                        $suma=$aroma+$apariencia+$sabor+$sensacion+$nota+$ejemplo+$sin_fallas+$maravilloso;
        
                        $suma=$suma/8;
                        $total=$total+$suma;
                        $resultado=$resultado+$total;
                        
                    }
        
                    $promedio=$resultado/$i;
                    
                    /* primera vez que se hace la comparación */
                    if($puesto_1==0){
                        
                        $puesto_1=$promedio;
                        $A=$cerv;
                        $next=true;
                       

                    }else {

                        if ($puesto_1!=0 && $puesto_2!=0) {

                            if ($promedio>=$puesto_1) {
                                $phantom=$puesto_1;//variable temporal para tomar el mayor valor
                                $Z=$A; /* z es una variable temporal */
                                $A=$cerv;
                                $puesto_1=$promedio;
                                $phantom2=$puesto_2;//variable que toma el valor del segundo para darselo al tercero
                                $puesto_2=$phantom;//la variable toma el menor valor
                                $Y=$B;
                                $B=$Z;
                                $puesto_3=$phantom2;
                                $C=$Y;                                
                                
                            }elseif ($promedio<$puesto_1 && $promedio>$puesto_3) {
                                $phantom=$puesto_2;
                                $Z=$B;
                                $B=$cerv;
                                $puesto_2=$promedio;
                                $puesto_3=$phantom;
                                $C=$Z;
                                
                            }else {
                                $puesto_3=$promedio;
                                $C=$cerv;
                                
                            }
                            
                        }else {
                            /* el nuevo promedio es mayor al anterior? entonces mover los valores hacia abajo */
                            if($promedio>=$puesto_1) {
        
                                $phantom=$puesto_1;//variable temporal para tomar el mayor valor
                                $Z=$A; /* z es una variable temporal */
                                $A=$cerv;
                                $puesto_1=$promedio;
                                $puesto_2=$phantom;//la variable toma el menor valor
                                $B=$Z;                                
                            
                            }elseif ($promedio<$puesto_1 && $promedio>$puesto_3) {
                                $phantom=$puesto_2;
                                $Z=$B;
                                $B=$cerv;
                                $puesto_2=$promedio;
                                $puesto_3=$phantom;
                                $C=$Z;    
                                                       
                            }else{
                                $puesto_3=$promedio;
                                $C=$cerv;
                               
                            }
                        }
                        
                        if ($next!=true) {
                            echo "Error en el posicionamiento de los ganadores";
                        }
                    }
                    
                
                
            }

            $sql=$conexion->query("UPDATE evento SET Primer_puesto=$A, Segundo_puesto=$B, Tercer_puesto=$C WHERE Id_evento='$evento'");
            
            $sql=$conexion->query("SELECT categorias.Nombre AS Categoria, estilos.Nombre AS Estilo
            FROM cerveza 
            INNER JOIN estilos ON estilos.Id_estilo = cerveza.fk_estilo
            INNER JOIN categorias ON estilos.fk_categoria=categorias.Id_categoria
            WHERE Id_cerveza=$A");
            $alfa=$sql->fetch_object();

            $sql=$conexion->query("SELECT categorias.Nombre AS Categoria, estilos.Nombre AS Estilo
            FROM cerveza 
            INNER JOIN estilos ON estilos.Id_estilo = cerveza.fk_estilo
            INNER JOIN categorias ON estilos.fk_categoria=categorias.Id_categoria
            WHERE Id_cerveza=$B");
            $bravo=$sql->fetch_object();

            $sql=$conexion->query("SELECT categorias.Nombre AS Categoria, estilos.Nombre AS Estilo
            FROM cerveza 
            INNER JOIN estilos ON estilos.Id_estilo = cerveza.fk_estilo
            INNER JOIN categorias ON estilos.fk_categoria=categorias.Id_categoria
            WHERE Id_cerveza=$C");
            $charlie=$sql->fetch_object();
            ?>

            <div class="puestos">

            <br> <h1>Puestos: </h1>
            <br> <h3>Primer puesto:</h3> <?=$alfa->Categoria." - ".$alfa->Estilo?>.
            <br> <h3>Segundo Puesto:</h3> <?=$bravo->Categoria." - ".$alfa->Estilo?>.
            <br> <h3>Tercer Puesto:</h3> <?=$charlie->Categoria." - ".$alfa->Estilo?>.
            <br>

            </div>
            
                <a href="index.php"><button>Cerrar</button></a>

            <?php
        }else {
            echo "<br>
            <h2 style='color:white ;text-align:center;'>No hay registros suficientes</h2>
            <br>
            <a href='index.php'><button style='color:white;''>Cerrar</button></a>
            ";
        }
}
    

?>
