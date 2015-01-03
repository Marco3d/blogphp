                                    <ul>
                                    <?php
                                          if($inicio==0){
                                    ?>
                                         
                                          <li><a href="#" title="Inicio" class="normal">Inicio</a></li>
                                    <?php
                                          }else{
                                    ?>
                                          
                                          <li><a href="<?php echo Principal::ruta(); ?>Home-a<?php echo $inicio-$cantNot; ?>.html" title="Previous" class="normal">&lt;Anterior</a></li>
                                    <?php
                                          }
                                    ?>
                                    
                                    <?php
                                          $a=0;
                                          $ultimaPag = 0;
                                          
                                          if ($actual>6) {
                                                echo "...";
                                          }
                                          
                                          for ($i=1; $i <=$cantPag ; $i++) {
                                                if($i>=$actual-5 && $i<=$actual+5){
                                                      if ($i == $actual) {
                                          ?>    
                                                            
                                                            <li><a href="<?php echo $i; ?>" title="<?php echo $i; ?>" class="normalactive"><?php echo $i; ?></a></li>
                                          <?php       
                                                      } else {
                                          ?>
                                                     
                                          <li><a href="<?php echo Principal::ruta(); ?>Home-a<?php echo $a;?>.html" title="<?php echo $i." ";?>" class="normal"><?php echo $i." ";?></a></li>

                                          <?php
                                                      }
                                                }
                                                $a+=$cantNot;
                                                $ultimaPag++;
                                          }
                                          
                                          $final = $ultimaPag*$cantNot;
                                          $resto = $total-$final;
                                          
                                          if ($final<$total) {
                                                $ultimaPag++;
                                                
                                                if ($actual==$ultimaPag) {
                                    ?>
                                          <span class="negrita"><?php echo $ultimaPag; ?></span>

                                    <?php
                                                }else{
                                    ?>
                                                <a href="<?php echo Principal::ruta(); ?>Home-a<?php echo $final; ?>.html"><?php echo $ultimaPag; ?></a>


                                    <?php
                                                }
                                                
                                          }
                                          
                                          if ($ultimaPag-$actual>5) {
                                                echo "...";
                                          }
                                    ?>
                                    
                                    <?php
                                          if ($ultimaPag==$actual) {
                                    ?>
                                                <li><a href="#" title="Last" class="normal">Final</a></li>
                                    <?php
                                          } else {
                                    ?>
                                                
                                                <li><a href="<?php echo Principal::ruta();?>Home-a<?php echo $inicio+$cantNot; ?>.html" title="Next" class="normal">Siguiente&gt;</a></li>
                                    <?php
                                          }
                                          
                                    ?>
                              </ul>