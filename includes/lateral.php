<?php
    require_once 'class/categorias.php';
    $obj = new Categorias();
    $datos = $obj->getCategorias();
?>

<!-- Start Blog Widget -->
            <div class="blogwidgetstart">
                <!-- Start Advertising Widget -->
                <div class="widgettitle"><h4>El Colegio</h4></div>
                
                <div class="widgetbody">
                
                    <div class="blogcategories">
                    
                       <ul>
            <?php
                foreach($datos as $d){
            ?>
            <li><a href="<?php echo $d["categoria"]; ?>-c<?php echo $d['idcategoria']; ?>-h0.html"><?php echo $d["categoria"]; ?></a></li>
            <?php
                }
            ?>

                
        </ul>
                                                
                    </div>
                
              </div>
              <!-- End categorias Widget -->
              
            
            </div>
            <!-- End Blog Widget -->


            
            <!-- Start Blog Widget -->
           <!--  <div class="blogwidget">
               Start Categories Widget
               <div class="widgettitle"><h4>Campus Virtual</h4></div>
               
               <div class="widgetbody">
               
                   <div class="blogcategories">
                   
                   <a href="#"><img src="images/campus1.jpg"  alt="Campus Virtual"></a>
                   
                   
                   </div>
               
             </div>
             End blanco Widget
             
           
           </div> -->
            <!-- End Blog Widget -->

            <!-- Start Blog Widget -->
            <div class="blogwidget">
                <!-- Start Categories Widget -->
                <div class="widgettitle"><h4>Correo</h4></div>
                
                <div class="widgetbody">
                
                    <div class="blogcategories">
                    
                    <a href="https://www.google.com/a/rodrigodetriana.edu.co/ServiceLogin?service=mail&passive=true&rm=false&continue=http://mail.google.com/a/rodrigodetriana.edu.co/&ltmpl=default&ltmplcache=2&emr=1" target="new"><img src="images/correo.png"  alt="Correo"></a>
                    
                    
                    </div>
                
              </div>
              <!-- End blanco Widget -->
              
            
            </div>
            <!-- End Blog Widget -->


            <div class="blogwidget">
                <!-- Start Categories Widget -->
                <div class="widgettitle"><h4>Twitter Rodriguista</h4></div>
                
                <div class="widgetbody">
                
                    <div class="blogcategories">
                    
                    <a class="twitter-timeline"  href="https://twitter.com/colrodtriana"  data-widget-id="410099276568477696">Tweets por @colrodtriana</a>
                      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

                    
                    
                    </div>
                
              </div>
              <!-- End blanco Widget -->
              
            
            </div>
            <!-- End Blog Widget -->
            
            
            