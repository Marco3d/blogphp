<?php
    
    require_once 'class/comentarios.php';
    require_once 'class/categorias.php';
    $obj = new Categorias();
    $obj1 = new Comentarios();

    $cantNot = "5"; //Noticias por página
    
    if (isset($_GET["pos"]))
        $inicio = $_GET["pos"];
    else
        $inicio = 0;
    
    $proxima = $inicio+$cantNot;

    $datos = $obj->getCategoriaId($_GET["id"],$inicio,$cantNot);
    
    $total = $obj->TotalCategorias($_GET["id"]);
    
    $cantPag = $total/$cantNot;
    
    if (isset($_GET["pos"]) and $_GET["pos"]>0)
        $actual = $_GET["pos"]/$cantNot+1;
    else
        $actual = 1;
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Iedit Rodrigo De Triana</title>
<meta name="description" content="Blog sobre diseño web,educación,Herramientas TIC" />
<meta name="keywords" content="Html5, Diseño web, Educación, TIC " />
<meta name="apple-mobile-web-app-capable" content="yes" /> 
<meta name="apple-mobile-web-app-status-bar-style" content="grey" /> 
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" /> 
<link rel="shortcut icon" href="images/favicon.png" /> 
<link rel="bookmark icon" href="images/favicon.png" /> 
<link href="css/main.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
<script src="js/twitter.js"></script>    
<script src="js/custom.js"></script>
       <!-- Rel next y prev -->
      <?php
            if ($inicio>0) {
        ?>
            <link rel="prev" href="<?php echo Principal::ruta(); ?><?php echo $datos[0]["categoria"]; ?>-c<?php echo $datos[0]["idcategoria"]; ?>-h<?php echo $inicio-$cantNot;?>.html" />
        <?php
            }
            
            if ($proxima<$total) {
        ?>
            <link rel="next" href="<?php echo Principal::ruta(); ?><?php echo $datos[0]["categoria"]; ?>-c<?php echo $datos[0]["idcategoria"]; ?>-h<?php echo $inicio+$cantNot;?>.html" />
        <?php
            }
        ?>
          
        
        <!-- Rel next y prev -->


</head>
<body>

<div id="header"> <!-- Comienzo Header -->
		    <?php include 'includes/header.php' ?>

</div><!-- Fin header -->

<div id="main">
    <!-- Start H1 Title -->
    <div class="titlesnormal">
    
        <h1>IEDIT RODRIGO DE TRIANA</h1>
        
        
    
    </div>
    <!-- End H1 Title -->
    <!-- Start Main Body Wrap -->
    <div id="main-wrap">
        
        <!-- Start Left Section -->
        <div class="leftsection leftsectionalt">
            <div id="actual">
               <!--  si hay noticias en esta categoria -->
                        <?php
                            if(sizeof($datos) > 0){
                          ?>
                        Categoría actual: <h3><?php echo $datos[0]["categoria"]; ?></h3>

                    </div>
          <!-- star blog post -->
           <?php foreach($datos as $d){  ?>
            <div class="blogwrap">
            
                <div class="blogtitle"><h3><a href="<?php echo Principal::ruta().Principal::limpiaUrl($d['titulo'])."-n".$d["idnoticia"].".html"; ?>"><?php echo $d["titulo"]; ?></a></h3></div>
                <div class="blogbody">       
                               
                    <div class="blogimage">
                    <?php echo Principal::myTruncate($d["detalle"], "500"); ?>                               
                               
                    </div>
                    
                    <div class="bloginfo1">
                        <p class="usericon">Publicado por: <span><?php echo $d["nombre"]; ?></span></p>
                      <p class="calendericon">Fecha: <span><?php echo Principal::invierteFecha($d["fecha"]); ?></span></p> 

                        <p class="blogbutton"><a href="<?php echo Principal::ruta().Principal::limpiaUrl($d['titulo'])."-n".$d["idnoticia"].".html"; ?>" title="Leer más" class="smallsmoothrectange orangebutton">Leer más</a></p>
                   
                    </div>
                    
                </div>
                
               
            
            </div>
            <!-- End Blog Post -->
                <?php } ?>
                                 
                
                        
                                 
            <!-- Start Pagination -->
            <div class="blogwrap">
            
                <div class="blogpagination">
                
                   <?php include 'includes/paginar3.php';?>
                
                </div>  
                
                
            </div> 
            <!-- End Pagination -->
            
     
                    <div class="blogwrap">
                        <?php
                            }else{
                                ?><h3><?php
                                            echo "No hay noticias asociadas a esta categoría"; ?></h3><?php
                            }
                        ?>
                    </div>    
        </div><!-- fin left seccion --> 

               


        <!-- Start Right Section -->
        <div class="rightsection rightsectionalt">
            <?php include 'includes/lateral.php'; ?>
        </div>
        <!-- End Right Section -->
        
    </div><!-- Fin main wrap -->

                        

</div> <!-- Fin main -->
<div id="footer">
   
    
            




     <!-- End Footer Top -->
    <div class="clear"></div>
    <!-- Start Footer Bottom -->
    <div id="footerbottom">
    
        <div class="footerwrap">
        
            <!-- Start Copyright Div -->
            <div id="copyright">&copy;<?php echo date("Y");?>.Iedit Rodrigo De Triana - Desarrollado por 
            
            
            <a href="http://www.aulared.net" title="Desarrollado por">@ulaRED</a></div>
     
            
            <!-- End Copyright Div -->

            <!-- Start Social area -->
            <div class="socialfooter">
                
                <ul>
                <li><a href="#" class="social-google"></a></li>
                <li><a href="#" class="social-facebook"></a></li>
                <li><a href="#" class="social-twitter"></a></li>
                <li><a href="#" class="social-linkedin"></a></li>
                <li><a href="#" class="social-forrst"></a></li>
                <li><a href="#" class="social-dribbble"></a></li>
                </ul>
                
            </div>
            <!-- End Socialarea -->
        
        </div>
    
    </div>
    <!-- End Footer Bottom -->
</div>
<!-- End Footer -->
<!-- Start Scroll To Top Div -->
<div id="scrolltab"></div>
<!-- End Scroll To Top Div -->



</body>
</html>