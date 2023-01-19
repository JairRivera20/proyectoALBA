<?php

include "../config/conexion.php";
$sql = $conexion->query("SELECT cerveza.Id_cerveza AS id, cerveza.Nombre,cerveza.Codigo, usuarios.Nombre AS usuario, rango_competidor.Nombre AS rango 
FROM cerveza 
INNER JOIN usuarios ON cerveza.fk_usuario = usuarios.Id_usuario
INNER JOIN rango_competidor ON usuarios.fk_rango_competidor = rango_competidor.Id_rango_competidor
WHERE cerveza.Pendiente=0 AND usuarios.Rol = 3");
$cuantas = mysqli_num_rows($sql);

?>


<link rel="stylesheet" href="http://localhost/proyectoalba/css/menuDesplegable3.css">
<link rel="stylesheet" href="../css/menuDesplegable3.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

<body id="body">

    <!-- icono del menu desplegable -->
    <header>

        <div class="icono_menu">
            <i class="bi bi-list" id="btn_open"></i>
        </div>
		<script>

			function salir(){
				var respuesta=confirm("¿Realmente deseas salir?");
					return respuesta;
			}

		</script>

    </header>

    <!-- opciones del menu al desplegar -->
    <div class="menu" id="menu">

            <!-- icono y perfil -->
            <div class="icono_nombre_perfil">
                
                <i class="bi bi-person-circle"></i>
                <h4><?php echo$_SESSION["Nombre"]." ".$_SESSION["Apellido"]; ?></h4>

                <!-- icono del lapiz editar -->
                <a href="../editarPerfil/editarPerfil.php?Id_usuario=<?= $_SESSION["Id_usuario"] ?>">
                    <div class="lapiz">
                        <i class="bi bi-pencil-fill"></i>
                    </div>
                </a>
                
            </div>


        <!-- opciones del menu -->
        <div class="options_menu">

            <a href="inicioAdmin.php">
                <div class="option">
                <i class="bi bi-house" title="Inicio"></i> 
                <h4>Inicio</h4>
                </div>
            </a>

            <?php
            if ($cuantas==0) {?>
            
                <a href="notificaciones/index.php">
                    <div class="option">
                    <i class="bi bi-bell" title="Notificaciones"></i>
                    <h4>Notificaciones</h4>
                    </div>
                </a>
            
            <?php
            }if ($cuantas>0) {?>

                <a href="notificaciones/index.php">
                    <div class="option">
                    <span class="bi bi-bell" title="Notificaciones"></span>
                    <span class="bi bi-exclamation" style="color:gold;"></span>
                    <h4>Notificaciones</h4>
                    </div>
                </a>

            <?php
            }
            ?>

            <a href="evento.php">
                <div class="option">
                <i class="bi bi-calendar-event" title="Eventos"></i>
                <h4>Eventos</h4>
                </div>
            </a>

            <a href="jueces.php">
                <div class="option">
                <i class="bi bi-clipboard2-plus" title="Asignar jueces/mesas"></i>
                <h4>Asignar jueces/mesas</h4>
                </div>
            </a>

            <a href="editarPerfiles.php">
                <div class="option">
                <i class="bi bi-people" title="Editar perfiles"></i>
                <h4>Perfiles</h4>
                </div>
            </a>

            <a href="editarCervezas.php">
                <div class="option">
                <i class="bi bi-trash2" title="Editar cervezas"></i>
                <h4>Cervezas</h4>
                </div>
            </a>

            <a href="statsgen/index.php">
                <div class="option">
                <i class="bi bi-clipboard2-check" title="Resultados del evento"></i> 
                <h4>Resultados del evento</h4>
                </div>
            </a>

            <a href="resultadosAdmin/">
                <div class="option">
                <i class="bi bi-search" title="Resultados anteriores"></i>
                <h4>Resultados anteriores</h4>
                </div>
            </a>

            <a href="../login/controladorSalir.php" onclick="return salir()">
                <div class="option">
                <i class="bi bi-box-arrow-left" title="Salir"></i>
                <h4>Salir</h4>
                </div>
            </a>
			<img class="logoSenaBlanco" src="../img/Logo-sena-blanco-sin-fondo.png" alt="logo sena blanco">
        </div>

    </div>

    <!-- llamado del archivo js para la animacion del boton del menu -->
    <script src="../js/menuDespegable2.js"></script>

