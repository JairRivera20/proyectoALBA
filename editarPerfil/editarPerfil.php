<!-- seleccion del id de cada usuario y saber los datos de cada uno de ellos -->
<?php 

/* ID del perfil para identificar el perfil el cual se va editar */
$id=$_SESSION["Id_usuario"];

$sql=$conexion->query(" SELECT * FROM usuarios WHERE Id_usuario=$id ");
$resultados=$sql->fetch_assoc()

?>

<!-- llamado de css de editar perfil -->
<link rel="stylesheet" href="../css/editarPerfil2.css">

 <!-- BOTON del modal -->
 <div class="boton-modal">
        <!-- <label for="btn-modal">Abrir modal</label> -->
    </div>
    <!-- fin del boton -->
    <!-- ventana modal -->
    <input type="checkbox" name="btn-modal" id="btn-modal">
    <div class="container-modal">
        <div class="content-modal">

            <script>
                function eliminar(){
                    var respuesta=confirm("Estas seguro que deseas eliminar");
                        return respuesta;
                }

                function salir(){
                    var respuesta=confirm("¿Realmente deseas salir?");
                    return respuesta;
                }

            </script>

<div class="espacio">

    <div class="formularioP">

    <h4>Editar perfil</h4>

    <?php 
    include "controladorEditarPerfil.php";
    ?>

    <form method="post" enctype="multipart/form-data">

        <input type="hidden" name="Id_usuario" value="<?= $_SESSION["Id_usuario"]?>">

        <div class="foto">
                <label>Foto de perfil</label>
                <?php 

                if ($resultados["Foto"] != "") {
					include "eliminar.php"; 
                    echo '<div class="fotoPe"><img src="data:image/jpg;base64,'. base64_encode($resultados["Foto"]).'" alt="Foto"></div>'.'
					<div>
						<form method="POST">
							
							<input type="hidden" value="<?=$id?>" name="usuario">
							<input type="hidden" value="ok" name="token">
							
							<button class="botonEliminar" type="submit" value="ok" name="btn" onclick="return eliminar()">
								<i class="bi bi-x"></i>
							</button>
						</form>
					</div>';
                    
                } else {

                    echo '<div class="iconoPre"><i class="bi bi-person-circle"></i></div>';
                    
                }
                
                ?>

                <input type="file" accept="image/png, image/gif, image/jpeg" name="foto" value="">
        </div>

        <div class="nombre">
            <label>Nombre</label>
            <input class="mayuscula limite" type="text" name="nombre" value="<?php echo $resultados['Nombre'] ?>">
        </div>
		
		
		
        <div class="apellido">
            <label>Apellido</label>
            <input class="mayuscula limite" type="text" name="apellido" value="<?php echo $resultados['Apellido'] ?>">
        </div>

        <div class="telefono">
            <label>Teléfono</label>
            <input type="tel" name="telefono" value="<?php echo $resultados['Telefono'] ?>">
        </div>

        <div class="contraseña">
            <label>Contraseña</label>
            <input type="password" name="contraseña" id="contraseña" value="<?php echo $resultados['Contrasena'] ?>">
			<!-- icono del ojo password -->
            <span><i class="bi bi-eye" id="ojo"></i></span>
        </div>

        <input type="submit" name="editarPerfil" value="Guardar">

    </div>

    </form>

    </div>

	
	<!-- javascript para que al ingresar los datos estos comiecen con letra mayuscula -->
    <script src="../js/mayuscula2.js"></script>

	
	<!-- javascript para poner lmite de caracteres en algunos datos -->
    <script src="../js/limite.js"></script>
	
	<!-- javascript para la funcionaliodad del ojo de password -->
    <script src="../js/mostrarOcultarContrasena.js"></script>


    <!-- para que se pueda dar el estilo al boton de regresar -->
    <script src="../js/botonRegresar.js"></script>

    <script src="../js/mensajePestana.js"></script>

            <hr>

            <div class="btn-cerrar">
                <label for="btn-modal">Cerrar</label>
                <a class="salir" href="../login/controladorSalir.php"><button>Cerrar Sesión</button></a>
            </div>

            <div>
                
            </div>

        </div>
        <!-- para disminuir al dar click fuera del contenido -->
        <label for="btn-modal" class="cerrar-modal"></label>
    </div>
    <!-- fin de ventana -->