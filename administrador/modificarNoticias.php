<?php
	require_once 'class/noticias.php';
	require_once 'class/categorias.php';
	if (isset($_SESSION["id"]) and isset($_SESSION["nombre"])) {
	
			$obj_categoria = new Categorias();
			$data_categoria = $obj_categoria->get();
			//echo "<pre>";print_r($data_categoria);
			$noticias = new Noticias();
			$datos=$noticias->getNoticiasId($_GET["id"]);
			//echo "<pre>";print_r($datos);exit;
		
	if(isset($_POST['enviar']) and $_POST['enviar'] == 'true'){
			$noticias->updateNoticias($_GET["id"]);
			
			
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
												 
								<form action="" method="post" >
									<h3>Agregar Noticia</h3>
								<div>
									<label>
									<span>Nombre: </span>								
									<input type="text" name="titulo" title="ingrese un título para la noticia"  required autofocus value="<?php echo $datos[0]['titulo']; ?>" />
									</label>
								</div>
							
								<div>
									<label>
									<span>Detalle: </span>		
									<textarea name="detalle"  title="Ingrese la descripción de la noticia" id="elm1"><?php echo $datos[0]['detalle']; ?></textarea>
									
									</label>

									

								
								<div>
									<label>
									<span>Categoría: </span>								
									<select name="categoria">
										<option value="0">Seleccione...</option>
										<?php
										foreach ($data_categoria as $key) {
											if($key['idcategoria'] == $datos[0]['idcategoria']){
										?>
											<option value="<?php echo $key['idcategoria']; ?>" selected='selected'><?php echo $key['categoria']; ?></option>
										<?php
											}else{
										?>
											<option value="<?php echo $key['idcategoria']; ?>"><?php echo $key['categoria']; ?></option>
										<?php		
											}
										?>
										
										<?php
										}
										?>
									</select>
									</label>
								</div>
									


								<div>
									<label>
									<span>Descarga: </span>								
									<input type="text" name="descarga" value="<?php echo $datos[0]['descarga']; ?>" />
									</label>
								</div>

								</div>
								<div>
								<input type="hidden" name="enviar" value="true">
								<input type="submit" <button class="btn btn-success" type="button" name="grabar" value="Grabar" title="Grabar">
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
