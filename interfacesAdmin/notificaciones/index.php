<?php
session_start();
if (empty($_SESSION["Id_usuario"])) {
    header("location: ../../login/login.php");

} else if (!empty($_SESSION["Rol"] != 1)) {

    session_start();
    session_destroy();
    header("location: ../../login/login.php");
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Notificaciones</title>
  <!-- jquery  -->
  <script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4=" crossorigin="anonymous"></script>
  <!-- CSS only -->

  <link rel="stylesheet" href="../../css/notificaciones4.css">
  <link rel="icon" href="../../img/Logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!--   <style> 
        table tr th{
            background:rgba(0, 0, 0, .6);
            color: black;
        }
        tbody tr{
          font-size: 12px !important;

        }
        h3{
            color:crimson; 
            margin-top: 100px;
        }
        a:hover{
            cursor: pointer;
            color: #333 !important;
        }
      </style> -->
</head>

<div class="container">

      <?php
      include('modelo/conexion.php');

      $sqlCliente   = ("SELECT cerveza.Id_cerveza AS id, cerveza.Nombre,cerveza.Codigo, usuarios.Nombre AS usuario, rango_competidor.Nombre AS rango 
      FROM cerveza 
      INNER JOIN usuarios ON cerveza.fk_usuario = usuarios.Id_usuario
      INNER JOIN rango_competidor ON usuarios.fk_rango_competidor = rango_competidor.Id_rango_competidor
      WHERE cerveza.Pendiente=0 AND usuarios.Rol = 3");
      $queryCliente = mysqli_query($conexion, $sqlCliente);
      $cantidad     = mysqli_num_rows($queryCliente);
      ?>


        <h4 class="text-center">
          <strong>Solicitudes de cerveza <span>  ( <?php echo $cantidad; ?> )</span> </strong>
        </h4>
       


      <!-- <div class="row text-center" style="background-color: #cecece">  
        <div class="col-md-6"> 
          
        </div>
      </div> -->

      <div class="table-responsive">
        <div class="table-responsive">
          <table class="table">
              <thead>
                <tr>
                <th scope="col">Nombre </th>
                <th scope="col">Código </th>
                <th scope="col">Participante </th>
                <th scope="col">Rango</th>
				<th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    while ($dataCliente = mysqli_fetch_array($queryCliente)) { ?>
                <tr>
                  <td><?php echo $dataCliente['Nombre']; ?></td>
                  <td><?php echo $dataCliente['Codigo']; ?></td>
                  <td><?php echo $dataCliente['usuario']; ?></td>
                  <td><?php echo $dataCliente['rango']; ?></td>
                  
                <td> 
                    <button type="button" style="background: red; border:red" class="btn btn-primary" data-toggle="modal" data-target="#deleteChildresn<?php echo $dataCliente['id']; ?>">
                        Rechazar
                    </button>
                  
                    <button type="button" style="background: #39A900; border:yellow" class="btn btn-primary" data-toggle="modal" data-target="#editChildresn<?php echo $dataCliente['id']; ?>">
                        Aceptar
                    </button>
                </td>
                </tr>
          

                  <!--Ventana Modal para Actualizar--->
                  <?php  include('ModalAceptar.php'); ?>

                  <!--Ventana Modal para la Alerta de Eliminar--->
                  <?php include('ModalRechazar.php'); ?>


              <?php } ?>
      
          </table>
      </div>
  </div>

    <div class="boton">
      <button type="button" onclick="history.back()" style="background: #39A900; border:yellow" class="btn btn-primary">Regresar</button>
    </div>

                

</div>

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

//Ocultar mensaje
    setTimeout(function () {
        $("#contenMsjs").fadeOut(1000);
    }, 3000);



    $('.btnBorrar').click(function(e){
        e.preventDefault();
        var id = $(this).attr("id");

        var dataString = 'id='+ id;
        url = "controlador/rechazar.php";
            $.ajax({
                type: "POST",
                url: url,
                data: dataString,
                success: function(data)
                {
                  window.location.href="index.php";
                  $('#respuesta').html(data);
                }
            });
    return false;

    });


});
</script>

</body>
</html>