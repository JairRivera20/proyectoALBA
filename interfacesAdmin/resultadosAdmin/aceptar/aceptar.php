<?php 
session_start();
if (empty($_SESSION["Id_usuario"])) {
    header("location: ../../../login/login.php");
}else if (!empty($_SESSION["Rol"] != 1)) {

    session_start();
    session_destroy();
    header("location: ../../../login/login.php");
}
?>

<?php
include('modelo/conexion.php');

$id = $_POST['Id_cerveza'];
$evento=$_POST['eventos'];

$sql=$conexion->query("SELECT * FROM evento WHERE Id_evento=$evento");
$dat=$sql->fetch_object();


$sql=$conexion->query("SELECT general.Id, cerveza.Nombre, categorias.Nombre AS Categoria, estilos.Nombre AS Estilo, general.Ejemplo, general.Sin_fallas, general.Maravilloso, general.Comentario, general.Fallas, general.Nota, general.Aroma, general.Apariencia, general.Sabor, general.Sensacion 
FROM evento_usuarios
INNER JOIN evento ON evento_usuarios.fk_evento=evento.Id_evento
INNER JOIN usuarios ON evento_usuarios.fk_usuarios=usuarios.Id_usuario
INNER JOIN cerveza ON usuarios.Id_usuario=cerveza.fk_usuario
INNER JOIN general ON general.fk_cerveza=cerveza.Id_cerveza
INNER JOIN estilos ON cerveza.fk_usuario=estilos.Id_estilo
INNER JOIN categorias ON estilos.fk_categoria=categorias.Id_categoria
WHERE evento.Id_evento=$evento AND general.fk_cerveza=$id");
$datos=$sql->fetch_object()


?>
<html>
  <head>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    
     <!-- Include boostrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- llamada de iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

  <link rel="stylesheet" href="http://localhost/proyectoalba/css/resultados3.css">
  <link rel="stylesheet" href="../../../css/resultados3.css">
  <link rel="icon" href="../../../img/Logo.png">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


</head>
<body>
<br><br><br>
<div class="res">
  <div class="tabla">        
        <h4 class="">Evento <?=$dat->Nombre?>
        <br>
        <?php
        if ($datos!=null) {
          ?>
          Juzgamientos de la cerveza <?=$datos->Nombre?>.
        <br>
          <?= $datos->Categoria, " - ", $datos->Estilo?>. </h4>
          
          <table class="">
              
              <thead>
                <tr>
                      <!-- <th scope="col">Cóodigo de la cerveza</th> -->
                      
                      <th scope="col">Aroma /12 &nbsp&nbsp</th> 
                      <th scope="col">Apariencia /3 &nbsp&nbsp</th>
                      <th scope="col">Sabor /20 &nbsp&nbsp</th>
                      <th scope="col">Sensacion /5 &nbsp&nbsp</th>
                      <!-- <th scope="col">Fallas</th> -->
                      <th scope="col">Estilo /13 &nbsp&nbsp</th>
                      <th scope="col">Virtud /13 &nbsp&nbsp</th>
                      <th scope="col">Aspecto /13 &nbsp&nbsp</th>
                      <!-- <th scope="col">Comentario</th> -->
                      <th scope="col">Nota /10 &nbsp&nbsp</th>
                      <!-- <th scope="col">Estadística</th> -->
                </tr>
              </thead>
              <tbody>
                  <!-- se muestran datos de la tabla y se hace la consulta -->
                  <?php
                  $sql=$conexion->query("SELECT general.Id, cerveza.Nombre, categorias.Nombre AS Categoria, estilos.Nombre AS Estilo, general.Ejemplo, general.Sin_fallas, general.Maravilloso, general.Comentario, general.Fallas, general.Nota, general.Aroma, general.Apariencia, general.Sabor, general.Sensacion 
                  FROM evento_usuarios
                  INNER JOIN evento ON evento_usuarios.fk_evento=evento.Id_evento
                  INNER JOIN usuarios ON evento_usuarios.fk_usuarios=usuarios.Id_usuario
                  INNER JOIN cerveza ON usuarios.Id_usuario=cerveza.fk_usuario
                  INNER JOIN general ON general.fk_cerveza=cerveza.Id_cerveza
                  INNER JOIN estilos ON cerveza.fk_usuario=estilos.Id_estilo
                  INNER JOIN categorias ON estilos.fk_categoria=categorias.Id_categoria
                  WHERE evento.Id_evento=$evento AND general.fk_cerveza=$id");
                  /* se crea un while para listar los datos y se repite la la cantidad de filas de la tabla*/
                  while($alt=$sql->fetch_object()){ 
                  ?>
                      <tr>
                          <!-- se debe colocar el nombre de los atributos de la tabla que se mostrarán en la tabla -->
                          
                          <td><?=$alt->Aroma?></td>
                          <td><?=$alt->Apariencia?></td>
                          <td><?=$alt->Sabor?></td>
                          <td><?=$alt->Sensacion?></td>
                          <!-- <td><?=$alt->Fallas?></td> -->
                          <td><?=$alt->Ejemplo?></td>
                          <td><?=$alt->Sin_fallas?></td>
                          <td><?=$alt->Maravilloso?></td>
                          <!-- <td><?=$alt->Comentario?></td> -->
                          <td><?=$alt->Nota?></td>

                          
                          
                      </tr>
                      <!-- abrimos php para cerrar el html y php -->
                  <?php }
                  ?>
              </tbody>
              <!-- <tfoot>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  
                  <td>

                   
    
                  </td>
                  
                  
                </tr>
              </tfoot> -->
              
              
          </table>


        <div class="botones">

          <div class="boton">
          <style>
            .boton button{
                width: 100px;
                border: none;
                outline: none;
                height: 40px;
                background: #39A900;
                color: #fff;
                font-size: 18px;
                border-radius: 20px;
                transition: all 300ms;
                cursor: pointer;
            }

            .boton button:hover{
                transform: scale(1.10);
            }
            </style>
            <a href="../index.php"><button type="button" >Regresar</button></a>
          </div>

          <div class="boton2">

            <form action="statsgen.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $id?>">
              <button type="submit" style="background: #39A900; border:yellow" class="btn btn-lg btn-primary" >
                <i class="bi bi-clipboard-data"></i>
                  Estadística
              </button>
            </form>

          </div>

        </div>
          
          <?php
        }else {
          ?>
          <br>
          <div>
            <h4>
              No hay juzgamientos hechos para esta cerveza.
            </h4>
          </div>
        <?php
          
        }
        ?>
        

  </div>
</div>
</body>
</html>
