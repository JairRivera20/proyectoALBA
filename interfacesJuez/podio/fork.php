
<?php
include "../config/conexion.php";

if (!empty($_POST["btnUpdate"])) {
   if (!empty($_POST["update"])) {

    
            $sql=$conexion->query("SELECT Id_evento FROM evento ORDER BY Id_evento DESC LIMIT 1,1");
            $data=$sql->fetch_object();
    
            if ($data!=null) {
                $evento=$data->Id_evento;
            }else{
                $sql=$conexion->query("SELECT Id_evento FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
                $f=$sql->fetch_object();
                $evento=$f->Id_evento;
            }
            
    
            $sql=mysqli_query($conexion,"SELECT general.Id, general.fk_cerveza FROM general 
            INNER JOIN cerveza ON cerveza.Id_cerveza=general.fk_cerveza
            INNER JOIN usuarios ON usuarios.Id_usuario=cerveza.fk_usuario
            INNER JOIN evento_usuarios ON usuarios.Id_usuario=evento_usuarios.fk_usuarios
            INNER JOIN evento ON evento_usuarios.fk_evento=evento.Id_evento
            WHERE evento.Id_evento=$evento
            GROUP BY general.fk_cerveza
            ORDER BY general.fk_cerveza ASC
            LIMIT 0,3");
    
            $cuantas = mysqli_num_rows($sql);
    
            if ($cuantas==3) {
    
                $puesto_1=0;
                $puesto_2=0;
                $puesto_3=0;
    
                
                while ($alt=$sql->fetch_object()) {
    
                    $i=0;
                    $resultado=0;
                    
                    $alt->fk_cerveza;
    
                    $query=$conexion->query("SELECT general.Id,general.Aroma,general.Apariencia,general.Sabor,general.Sensacion,general.Nota,general.fk_cerveza 
                    FROM general 
                    INNER JOIN cerveza ON cerveza.Id_cerveza=general.fk_cerveza
                    INNER JOIN usuarios ON usuarios.Id_usuario=cerveza.fk_usuario
                    INNER JOIN evento_usuarios ON usuarios.Id_usuario=evento_usuarios.fk_usuarios
                    INNER JOIN evento ON evento_usuarios.fk_evento=evento.Id_evento
                    WHERE general.fk_cerveza=$cerv AND evento.Id_evento=$evento");
                    
    
                    
    
                        while($datos=$query->fetch_object()){
    
                            $i=$i+1;
                            $total=0;
            
                            $aroma=$datos->Aroma;
            
                            $apariencia=$datos->Apariencia;
            
                            $sabor=$datos->Sabor;
                            
                            $sensacion=$datos->Sensacion;
                            
                            $nota=$datos->Nota;
            
                            $suma=$aroma+$apariencia+$sabor+$sensacion+$nota;
            
            
                            $suma=$suma/5;
                            $total=$total+$suma;
                            $resultado=$resultado+$total;
                            
                            
                        }
            
                        $promedio=$resultado/$i;
                        
            
                        if($puesto_1==0 && $puesto_2==0 && $puesto_3==0){
                            if ($promedio>$puesto_1 && $promedio>$puesto_2 && $promedio>$puesto_3 ) {
                                $puesto_1=$promedio;
                                $A=$cerv;
                                $next=true;
                            }
                        }elseif ($promedio==$puesto_1) {
                            $puesto_1=$promedio;
                            $A=$cerv;
                            
                        }
                        elseif($promedio>$puesto_1) {
                            $phantom=$puesto_1;//variable temporal para tomar el mayor valor
                            $Z=$A;
                            $A=$cerv;
                            $puesto_1=$promedio;
                            $puesto_2=$phantom;//la variable toma el menor valor
                            $B=$Z;
                            
                            
                        }elseif ($promedio==$puesto_2) {
                            $puesto_2=$promedio;
                            $B=$cerv;
            
                        }elseif ($promedio<$puesto_2) {
                            $puesto_3=$promedio;
                            $C=$cerv;
                        }    
                        if ($next!=true) {
                            echo "Error en el posicionamiento de los ganadores";
                        }
                    
                    
                }
    
                $sql=$conexion->query("UPDATE evento SET Primer_puesto=$A, Segundo_puesto=$B, Tercer_puesto=$C WHERE Id_evento=$evento");
                
                $sql=$conexion->query("SELECT cerveza.Nombre, categorias.Nombre AS Categoria
                FROM cerveza 
                INNER JOIN estilos ON estilos.Id_estilo = cerveza.fk_estilo
                INNER JOIN categorias ON estilos.fk_categoria=categorias.Id_categoria
                WHERE Id_cerveza=$A");
                $alfa=$sql->fetch_object();
    
                $sql=$conexion->query("SELECT cerveza.Nombre, categorias.Nombre AS Categoria
                FROM cerveza 
                INNER JOIN estilos ON estilos.Id_estilo = cerveza.fk_estilo
                INNER JOIN categorias ON estilos.fk_categoria=categorias.Id_categoria
                WHERE Id_cerveza=$B");
                $bravo=$sql->fetch_object();
    
                $sql=$conexion->query("SELECT cerveza.Nombre, categorias.Nombre AS Categoria
                FROM cerveza 
                INNER JOIN estilos ON estilos.Id_estilo = cerveza.fk_estilo
                INNER JOIN categorias ON estilos.fk_categoria=categorias.Id_categoria
                WHERE Id_cerveza=$C");
                $charlie=$sql->fetch_object();
                ?>
    
                <div class="puestos">
    
                <br> Puestos: 
                <br> Primer puesto: <?=$alfa->Nombre?>, <?=$alfa->Categoria?>.
                <br> Segundo Puesto: <?=$bravo->Nombre?>, <?=$bravo->Categoria?>.
                <br> Tercer puesto: <?=$charlie->Nombre?>, <?=$charlie->Categoria?>.
                <br>
    
                </div>
                
                    <a href="inicioAdmin.php"><button>Regresar</button></a>
                
    
                <?php
            }else {
                echo "<br>
                <h2 style='color:white ;text-align:center;'>No hay registros suficientes</h2>
                <br>
                ";
            }
        }
    }
    
            
       
    
        
    
    ?>
    