<?php
    require_once 'class/noticias.php';
    require_once 'class/comentarios.php';
    $obj = new Principal();

    $objN = new Noticias();
    
    $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    
    $cantNot = "5"; //Noticias por página

    $datos = $objN->noticiaPorId($_GET["id"]);
    
    $obj1 = new Comentarios();
    $comentAct = $obj1->comentarioId($_GET["id"]);
    
    if (isset($_POST["enviar"]) and $_POST["enviar"]=="si") {
        //verifico el captcha
        include_once 'securimage/securimage.php';
        $securimage = new Securimage();
        
        if ($securimage->check($_POST['captcha_code']) == false) {
             // the code was incorrect
             // you should handle the error so that the form processor doesn't continue
            echo "El c&oacute;digo ingresado es incorrecto. Por favor intente de nuevo.<br /><br />";
            echo "<a href='javascript:history.go(-1)'>Click aqu&iacute; para regresar</a>";
            exit;
        }else{
            $obj1->insertarComentario();
        }
    }
    
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Iedit Rodrigo De Triana- <?php echo $datos[0]["titulo"]; ?>-</title>
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
<script type="text/javascript" src="js/funciones.js" language="JavaScript"></script>



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
        	<!-- Start Blog Post -->
        	<div class="blogwrapstart">
                    <div class="blogtitle"><h3><a href="#"><?php echo $datos[0]["titulo"]; ?></a></h3></div>
                

                    <div class="blogbody">                             

                        <div class="blogimage"><?php echo $datos[0]["detalle"]; ?> </div>   
                                       
                    
                        <div class="bloginfo1">
                            <p class="usericon">Publicado por: <span><?php echo $datos[0]["nombre"]; ?></span></p>
                            <p class="calendericon">Fecha: <span><?php echo Principal::invierteFecha($datos[0]["fecha"]); ?></span></p>
                                     
                        </div>
                    
                    </div>               
              
            
            </div>
            <!-- End Blog Post -->
            
        	<!-- Start Blog Post -->
        	<div class="blogwrap">
            
            	<div class="blogcommenttitle"><h3><?php
                                $comentarios = $obj1->totalComentarios($_GET["id"]);
                            ?>
                            <?php
                            
                            if($comentarios==1){
                                echo " 1 Comentario";
                            }elseif($comentarios==0){
                                echo  "No hay Comentarios";
                                                            
                            }else{
                             echo $comentarios."  Comentarios"; 
                            }
                            
                            ?>  </h3>
                </div>
              
            
            </div>
            <!-- End Blog Post -->

            <!-- Start Blog Comments -->

            <?php foreach ($comentAct as $key) { ?>

            <div class="blogcomment">
            
           	  
                
                	<div class="commenttitle">
                    
                    	<p><span class="avatarname"><?php echo $key["nombre"]; ?></span> <span class="avatardate">Enviado : <span class="avatardateorange"><?php echo Principal::invierteFecha($key["fecha"]); echo " (".$key["hora"].")"; ?></span></span></p>
                    
                  </div>
                    
                    
                    
                    <div class="blogtext">
                    
                   <?php echo $key["comentario"]; ?>
                    
                   
                    
                   
                
                </div>
            
            </div>
            <!-- End Blog Comments -->

            
             <?php } ?>
            
                <div class="blogcommenttitle"></div>
               <div class="blogcommenttitle"><h3>Escribe tu comentario </h3>
                <div id="error"></div>
               </div> 

            <!-- Start Comment Form -->
            <div class="blogcomment">
            
                            
                <div class="blogcommentform">
                
                    <form name="Fcomentarios" action="" method="post">

                    <fieldset>
                    
                        Nombre:
                            <input type="text" name="nombre" id="nombre" />
                    
                    </fieldset>  

                    <fieldset>
                    
                        Correo:
                            <input type="text" name="correo" id="correo" />
                    
                    </fieldset>   
                    
                    <fieldset>
                    
                       Comentario: <textarea name="comentario"  cols="5" rows="5"></textarea>
                    
                    </fieldset>
                    
                 
                    
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                            <input type="hidden" name="url" value="<?php echo $url; ?>">
                            <input type="hidden" name="enviar" value="si" />
                            
                            <fieldset>
                            <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
                            <br />
                            <a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[ Cambiar Imagen ]</a>
                            <br /><br />
                            <label for="captcha_code">Digite el texto de la imagen anterior <span class="obligatorio">*</span></label>
                            <br />
                            <input type="text" name="captcha_code" size="10" maxlength="6" required="required" />
                            </fieldset> 
                            
                            <input type="button" name="comentar" value="comentar" class="contactformbutton"  onclick="validaComentario();" />
                    
                    </form>
                
               
              
                
              
              </div>
            
            </div>
            <!-- End Comment Form -->
        
        </div>
        <!-- End Left Section -->
        
           
        

               

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