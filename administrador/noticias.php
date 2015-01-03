<?php
	require_once 'class/noticias.php';
	if (isset($_SESSION["id"]) and isset($_SESSION["nombre"])) {
		$noticias = new Noticias();
		$datos = $noticias->getNoticias();
		//echo "<pre>";print_r($datos);exit;
		
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
												
							<?php
							
								if (isset($_GET["m"]) and is_numeric($_GET["m"])) {
									switch ($_GET["m"]) {
										case 1:
										?><div class="alert alert-info"><?php
											echo "La noticia se eliminó correctamente.";?></div><?php
											break;
										case 2:
										?><div class="alert alert-error"><?php
											echo "La noticia no se puede eliminar porque tiene registros asociados. Elimine primero los comentarios";?></div><?php
											break;
											case 3:
										?><div class="alert alert-info"><?php
											echo "La noticia fue agregada correctamente.";?></div><?php
											break;
										case 4:
										?><div class="alert alert-error"><?php
											echo "No existe ninguna categoría asociada a la noticia";?></div><?php
											break;
											case 5:
										?><div class="alert alert-info"><?php
											echo "La noticia ha sido modificada correctamente.";?></div><?php
											break;
										case 6:
										?><div class="alert alert-info"><?php
											echo "La noticia ha sido modificada correctamente.";?></div><?php
											break;	
										


									}
								}
							?>
						
		   <div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h3><i class=" icon-folder-open"></i> Gestor de Noticias</h3>
						<div class="box-icon">
							
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							
						</div>
					</div>

					<div class="box-content">
						<?php
							if(sizeof($datos) > 0){
							?>

							 <table class="table table-striped table-bordered bootstrap-datatable datatable ">
							<thead>
							<tr>
								<th>Título</th>
								<th>Categoría</th>
								<th>Fecha</th>
								<th>Hora</th>
								
								<th>Acciones</th>
								
							</tr>
							</thead> 
							<tbody>



								<?php
									foreach ($datos as $key) {
								?>
								<tr>
								
									<td class="center"><?php echo $key["titulo"]; ?></td>
									<td class="center"><?php echo $key["categoria"]; ?></td>
									<td class="center"><?php echo $key["fecha"]; ?></td>
									<td class="center"><?php echo $key["hora"]; ?></td>
									
									<td class="center">
									<a class="btn btn-info" href="modificarNoticias.php?id=<?php echo $key['idnoticia']; ?>"
										<i class="icon-edit icon-white"></i>  
										Editar</a> 	
									<a class="btn btn-danger" href="javascript:void(0);" onclick="eliminiar('delNoticia.php','<?php echo $key["idnoticia"]; ?>')">
										<i class="icon-trash icon-white"></i> 
										Eliminar
									</a>

									
									
									
								</tr>
							<?php
								}
							?>

							</tbody>
						 </table>

						<?php
							}else{
								?><div class="alert alert-info"><?php
											echo "No hay noticias"; ?></div><?php
							}
						?>
						<a href="insertarNoticia.php">Agregar Noticia</a>


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
