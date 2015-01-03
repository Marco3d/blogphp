<?php
require_once 'class/noticias.php';
require_once 'class/comentarios.php';


    $obj = new Principal();
    $obj->removeIndexUrl();
    
    $objN = new Noticias();
    
    $cantNot = "3"; //Noticias por página
    
    if (isset($_GET["pos"]))
        $inicio = $_GET["pos"];
    else
        $inicio = 0;
    
    $proxima = $inicio+$cantNot;

    $datos = $objN->getNoticias($inicio,$cantNot);
    
    $total = $objN->TotalNoticias();
    
    $cantPag = $total/$cantNot;
    
    if (isset($_GET["pos"]) and $_GET["pos"]>0)
        $actual = $_GET["pos"]/$cantNot+1;
    else
        $actual = 1;
    
    $obj1 = new Comentarios();
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
<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="../css/bootstrap-responsive.css" rel="stylesheet">
<link href="bootstrap/js/bootstrap.min.js" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
<script src="js/twitter.js"></script>    
<script src="js/custom.js"></script>
<script>
    //// Start Simple Sliders ////
    $(function() {
        setInterval("rotateDiv()", 10000);
    });
        
        function rotateDiv() {
        var currentDiv=$("#simpleslider div.current");
        var nextDiv= currentDiv.next ();
        if (nextDiv.length ==0)
            nextDiv=$("#simpleslider div:first");
        
        currentDiv.removeClass('current').addClass('previous').fadeOut('2000');
        nextDiv.fadeIn('3000').addClass('current',function() {
            currentDiv.fadeOut('2000', function () {currentDiv.removeClass('previous');});
        });
    
    }
    //// End Simple Sliders //// 
</script> 
<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto();
  });
</script>

<!-- Rel next y prev -->
        
        <?php
            if ($inicio>0) {
        ?>
            <link rel="prev" href="?pos<?php echo $inicio-$cantNot;?>" />
        <?php
            }
            
            if ($proxima<$total) {
        ?>
            <link rel="next" href="?pos<?php echo $inicio+$cantNot;?>" />
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
    
        <h1>IEDIT RODRIGO DE TRIANA<p> PÁGINA WEB INSTITUCIONAL</p></h1>
        
        
    
    </div>
    <!-- End H1 Title -->
    <!-- Start Main Body Wrap -->
    <div id="main-wrap">

        <!-- Start Featured Boxes -->
        <?php include 'includes/boxtop.php' ?>
        <!-- End Featured Boxes -->
        
        
        <!-- Start Left Section -->
        <div class="leftsection leftsectionalt">
        
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
                
                   <?php include 'includes/paginar2.php';?>
                
                </div>  
                
                
            </div> 
            <!-- End Pagination -->
            
     
        </div><!-- fin left seccion --> 

               


        <!-- Start Right Section -->
        <div class="rightsection rightsectionalt">
            <?php include 'includes/lateral.php'; ?>
        </div>
        <!-- End Right Section -->
        
        

    </div><!-- Fin main wrap -->


 
</div> <!-- Fin main -->
<div id="footer">
   
    
            <?php include 'includes/footer.php'; ?>




     <!-- End Footer Top -->
   
    <!-- Start Footer Bottom -->
    
    
        
            
            <!-- Start Copyright Div -->
          <div><center>  &copy;<?php echo date("Y");?>.Iedit Rodrigo De Triana - Desarrollado por 
            
            
            <a href="http://www.aulared.net" title="Desarrollado por">@ulaRED</a></center></div>
     
            
            <!-- End Copyright Div -->

      
    
    
    <!-- End Footer Bottom -->
</div>
<!-- End Footer -->
<!-- Start Scroll To Top Div -->
<div id="scrolltab"></div>
<!-- End Scroll To Top Div -->


</body>
</html>