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


    <!-- Opciones del menu al desplegar -->
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

            <a href="inicioJuez.php">
                <div class="option">
                <i class="bi bi-house" title="Inicio"></i> 
                <h4>Inicio</h4>
                </div>
            </a>

            <a href="juzgamiento.php">
                <div class="option">
                <i class="bi bi-ui-checks" title="Formulario"></i> 
                <h4>Formulario</h4>
                </div>
            </a>

            <a href="resultados/index.php">
                <div class="option">
                <i class="bi bi-search" title="Resultados anteriores"></i> 
                <h4>Resultados anteriores</h4>
                </div>
            </a>

            <a href="statsgen/index.php">
                <div class="option">
                <i class="bi bi-clipboard2-check" title="Resultados"></i> 
                <h4>Resultados</h4>
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