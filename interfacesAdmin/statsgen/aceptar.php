<?php 
session_start();
if (empty($_SESSION["Id_usuario"])) {
    header("location: ../../login/login.php");
}else if (!empty($_SESSION["Rol"] != 1)) {

    session_start();
    session_destroy();
    header("location: ../../login/login.php");
}
?>


<?php
include('modelo/conexion.php');

$id = $_POST['id'];

    $sql_4 = ("SELECT Aroma,Apariencia,Sabor,Sensacion, Nota
    FROM general 
    INNER JOIN cerveza ON general.fk_cerveza=cerveza.Id_cerveza
    INNER JOIN estilos ON cerveza.fk_estilo = estilos.Id_estilo
    INNER JOIN categorias ON estilos.fk_categoria=categorias.Id_categoria
    WHERE general.Juzgado=1 AND categorias.Id_categoria=$id");
    $query_4 = mysqli_query($conexion, $sql_4);
    $cantidad     = mysqli_num_rows($query_4);

    $aromatot=0;
    $aparienciatot=0;
    $sabortot=0;
    $sensaciontot=0;
    $notatot=0;

    while ($data = mysqli_fetch_array($query_4)) { 
    
    $aroma=$data['Aroma'];
    $apariencia=$data['Apariencia'];
    $sabor=$data['Sabor'];
    $sensacion=$data['Sensacion'];
    $nota=$data['Nota'];

    $aromatot=$aromatot+$aroma;
    $aparienciatot=$aparienciatot+$apariencia;
    $sabortot=$sabortot+$sabor;
    $sensaciontot=$sensaciontot+$sensacion;
    $notatot=$notatot+$nota;      
    
}

$aromatot=$aromatot/$cantidad; 
$aparienciatot=$aparienciatot/$cantidad;
$sabortot=$sabortot/$cantidad;
$sensaciontot=$sensaciontot/$cantidad; 
$notatot=$notatot/$cantidad;

$total=$aromatot+$aparienciatot+$sabortot+$sensaciontot+$notatot;
?>
<html>
  <head>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <!-- Include boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <link rel="stylesheet" href="../../css/estadisticas2.css">
    <link rel="icon" href="../../img/Logo.png">

</head>
<body>
  <div class="container">
      <!-- Create a canvas element where the radar chart will be rendered -->   

      <canvas id="radarChart"  style="width: 550px; height: 150px;"></canvas>

      <?php
      // Use PHP to collect and process the data needed for the radar chart
      $data = ([
      [$aromatot * 4.166666667],
      [$aparienciatot * 16.666666667],
      [$sabortot * 2.5],
      [$sensaciontot * 10],
      [$notatot * 5]

      ]);
      ?>
  <!--  4.166666667   el de 12-->
  <!-- 16.666666667   el de 3 -->
  <!-- 2.5            el de 20 -->
  <!-- 10             el de 5 -->
  <!-- 5              el de 10 -->
      <script>
        var options = {
          scale:{
            gridLines: {
              color: "black",
              lineWidth: 0.5
            },
            ticks: {
              beginAtZero: true,
              min: 0,
              max: 50,
              stepSize: 10
            },
            pointLabels: {
              fontSize: 13.5,
              fontColor: "white",
            }
          },
          legend: {
            display:false         
          },
            
            
        }
        
      // Use JavaScript and Chart.js to generate the radar chart
      var ctx = document.getElementById('radarChart').getContext('2d');
      var chart = new Chart(ctx, {
          type: 'radar',
          data: {
              labels: ['Aroma', 'Apariencia', 'Sabor', 'Sensación', 'General'],
              datasets: [{
                backgroundColor: "rgba(238, 130, 238, 0.411)",
                borderColor: "gold",
                pointRadius: 0,
                data: <?php echo json_encode($data); ?>
              }]
          },
          options:  options
          
        });
      </script>

    <hr>

    <div class="comentarios">
      <?php
        if ($total>=0 and $total<=13) {

          /* echo "<div class='total'>$total</div>"; */
          echo "<p>Problemático (0-13)</p>";
          echo "<p>Sabores y aromas indeseados dominan.</p>";
          
        }
        if ($total>=14 and $total<=20) {
          
          /* echo "<div class='total'>$total</div>"; */
          echo "<p>Razonable (14-20)</p>";
          echo "<p>Off flavors/aromas o deficiencias grandes de estilo.</p>";
          
        }
        if ($total>=21 and $total<=29) {
          
          /* echo "<div class='total'>$total</div>"; */
          echo "<p>Bueno (21-29)<p>";
          echo "<p>Pierde puntos en precisión de estilo y / o defectos de menor importancia.<p>";
          
        }
        if ($total>=30 and $total<=37) {
          
          /* echo "<div class='total'>$total</div>"; */
          echo "<p>Muy Bueno (30-37)</p>";
          echo "<p>En general dentro de los parámetros del estilo, con pequeños defectos.</p>";
          
        }
        if ($total>=38 and $total<=44) {
          
          /* echo "<div class='total'>$total</div>"; */
          echo "<p>Excelente (38-44)</p>";
          echo "<p>Ejemplifica bien el estilo, requiere pequeños ajustes.</p>";
          
        }
        if ($total>=45 and $total<=50) {
          
          /* echo "<div class='total'>$total</div>"; */
          echo "<p>Sobresaliente (45-50)</p>";
          echo "<p>Ejemplo de clase mundial del estilo.</p>";
          
        }

      ?>
    </div>
  
  </div>


  <div class="container2">
      <?php
        echo "<div class='total'>Tu nota es:</div>";
        echo "<div class='total'>$total</div>";
      ?>
    </div>

    <div class="boton">
        <input type="button" onclick="history.back()" value="Atrás">
    </div>


</body>
</html>
