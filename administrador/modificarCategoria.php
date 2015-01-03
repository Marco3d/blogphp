<?php
	require_once 'class/categorias.php';
	if (isset($_SESSION["id"]) and isset($_SESSION["nombre"])) {
		$categorias = new Categorias();
		$datos=$categorias->getId($_GET["id"]);
		// echo "<pre>";print_r($datos);exit;
		if (isset($_POST["enviado"]) and $_POST["enviado"]=="true") {
			$categorias->update($_POST["id"]);
		}
		
?>
<!DOCTYPE html>
<html lang="es">
<head>
	
	<?php include 'includes/head.php' ?>

</head>

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

			<div id="content" class="span12">
			
			
				
			<div>
				
						
							<?php
								if (isset($_GET["mensaje"]) and is_numeric($_GET["mensaje"])) {
									switch ($_GET["mensaje"]) {
										case 1:
										?><div class="alert alert-info"><?php
											echo "La categoría ya existe";
											break;
										case 2:
										?><div class="alert alert-info"><?php
											echo "La categoría ha sido creada.";
											break;
									}
								}
							?>
						
			</div>
		   </div><!-- fin row -->
		   <div class="row-fluid">

			<div id="content" class="span12">
							
				<div>
					<div class="insertarform">
												 
								<form action="" name="" method="post" id="contact-form">
									<h3>Agregar Categoría</h3>
								<div>
									<label>
									<span>Nombre: </span>								
									<input type="text" name="categoria" title="Ingrese el nombre de la categoría"  required autofocus value="<?php echo $datos[0]['categoria']; ?>" />
									</label>
								</div>
							
								<div>
									<label>
									<span>Descripción: </span>		
									<textarea name="descripcion"  title="Ingrese la descripción de la categoría" required="required"  ><?php echo $datos[0]['descripcion']; ?></textarea>
									
									</label>
								</div>
								<div>
								<input type="hidden" name="id" value="<?php echo $datos[0]['idcategoria']; ?>">	
								<input type="hidden" name="enviado" value="true">
								<input type="submit" <button class="btn btn-success" type="button" name="actualizar" value="Actualizar" title="Actualizar">
								</div>
								</form>
						


					</div>
				</div>
			</div> <!-- fin row -->
				
		   <!-- fin contenido dinamico -->

		  <!--  star footer -->

		<?php include 'includes/footer.php' ?>		

		  <!-- end footer -->
	
		
</body>
</html>
<?php
	} else {
		header("Location: index.php");
	}
?>
