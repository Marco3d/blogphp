<?php
	session_start();
	if (isset($_SESSION["id"]) and isset($_SESSION["nombre"])) {
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
				<div class="breadcrumb">
					<H3>Bienvenid@ <i><?php echo $_SESSION["nombre"]; ?></i> a la zona de administración</H3>

				</div>
			</div>
		   </div><!-- fin row -->
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
