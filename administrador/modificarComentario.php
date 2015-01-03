<?php
	require_once 'class/comentarios.php';
	if (isset($_SESSION["id"]) and isset($_SESSION["nombre"])) {
		$comentarios = new Comentarios();
		$datos = $comentarios->getPorId($_GET["id"]);
		//echo "<pre>";print_r($datos);exit;
		
		if (isset($_POST["validar"]) and $_POST["validar"] == "true") {
			$comentarios->update();
		}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	
	<?php include 'includes/head.php' ?>

<body>
		<!-- topbar starts -->
		 <?php include 'includes/topbar.php' ?>
		<!-- topbar ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
			<?php include 'includes/sidebar.php' ?>
			</div><!--/span-->
			<!-- left menu ends -->
			
			
			
			<div id="content" class="span10">
			<!-- content starts -->
			<?php include 'includes/menubar.php' ?>

			
					
							
					
			
			<!-- comienzo contenido dinamico -->
			<div class="row-fluid">		
				<div class="box span12">
				
					<div class="insertarform">
												 
								<form name="form" method="post" action="" id="contact-form">
									<h3>Editar Comentario</h3>
								<div>
									<label>
									<span>Nombre: </span>								
									<input type="text" name="nombre" value="<?php echo $datos[0]['nombre']; ?>">
									</label>
								</div>
							
								

								<div>
									<label>
									<span>Comentario: </span>								
									<textarea name="comentario" cols="40" rows="10"><?php echo $datos[0]['comentario']; ?></textarea>
									</label>
								</div>

								<div>
									<label>
									<span>Comentario: </span>								
									<select name="estado">
										<option value="aprobado">aprobado</option>
										<option value="pendiente">pendiente</option>
									</select>
									</label>
								</div>



								<div>
									<input type="hidden" name="validar" value="true">
									<input type="hidden" name="id" value="<?php echo $datos[0]['idcomentario']; ?>" />
									<input type="submit" name="grabar" value="grabar" title="grabar" />
								</div>
								</form>
						


					</div>
				


					
				</div><!--/span-->
			
			</div><!--/row-->


		<?php include 'includes/footer.php' ?>		

		  <!-- end footer -->
	
		
</body>
</html>
<?php
	} else {
		header("Location: index.php");
	}
?>

