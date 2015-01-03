<?php
	require_once 'class/comentarios.php';
	if (isset($_SESSION["id"]) and isset($_SESSION["nombre"])) {
		$comentarios = new Comentarios();
		$datos = $comentarios->getComentarios();
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

			
					
							<?php
								if (isset($_GET["m"]) and is_numeric($_GET["m"])) {




									switch ($_GET["m"]) {
										case 1:
										?><div class="alert alert-info"><?php
											echo "El comentario fue aprobado. "; ?></div><?php
											break;
										case 2:
										?><div class="alert alert-info"><?php
											echo "El comentario se eliminó correctamente";?></div><?php
											break;

										case 3:
										?><div class="alert alert-error"><?php
											echo "Datos incorrectos";?></div><?php
											break;	

										case 4:
										?><div class="alert alert-info"><?php
											echo "El comentario ha sido modificado correctamente";?></div><?php
											break;	
									}
								}
							?>
					
			
			<!-- comienzo contenido dinamico -->
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h3><i class="icon-user"></i> Gestor de Comentarios</h3>
						<div class="box-icon">
							
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							
						</div>
					</div>
			
						<div class="box-content">
						
						  
						  
			
						

							<?php
							if(sizeof($datos) > 0){
							?>	
						 <table class="table table-striped table-bordered bootstrap-datatable datatable">
							<thead>
							<tr>
								<th>Nombre</th>
								<th>Email</th>
								<th>Comentario</th>
								<th>Noticia</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
							</thead> 
							<tbody>

							<?php
								//print_r($datos);
								foreach ($datos as $key) {
							?>
							<tr>
								<td class="center"><?php echo $key["nombre"]; ?></td>
								
								<td class="center">
								<?php
									$email1 = base64_decode($key["email"]);
									
									$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
									$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
									$secreto = "My+Clave@";
																
									$email = MCRYPT_DECRYPT(MCRYPT_RIJNDAEL_256,$secreto,$email1,MCRYPT_MODE_ECB,$iv);
									echo $email;
								?>
								</td>

								<td class="center">
									<?php echo $key["comentario"]; ?>
								</td>
								<td class="center">
									<?php echo $key["titulo"]; ?>
								</td>
								<td class="center">
									<span class="label label-success">Pendiente</span>
								</td>
								<td class="center">
														
								<a class="btn btn-info" href="modificarComentario.php?id=<?php echo $key['idcomentario']; ?>">
										<i class="icon-edit icon-white"></i>  
										Editar</a> 							

								<a class="btn btn-danger" href="javascript:void(0);" onclick="eliminiar('delComentario.php','<?php echo $key["idcomentario"]; ?>')">
										<i class="icon-trash icon-white"></i> 
										Eliminar
									</a>							

								<a class="btn btn-success" href="javascript:void(0);" onclick="aprobar('aprobar.php',<?php echo $key['idcomentario']; ?>)">
										<i class="icon-thumbs-up"></i>  
										Aprobar                                           
									</a>


							    </td>
							</tr>
							<?php
								}
							?>

							</tbody>
						 </table>

						<?php
							}else{
								?><div class="alert alert-info"><?php
											echo "No hay comentarios pendientes para aprobación"; ?></div><?php
							}
						?>
						<a href="insertarCategoria.php">Editar comentario</a>


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

