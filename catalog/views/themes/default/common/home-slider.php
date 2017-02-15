
<!-- Start : Home slideder-->
<div id="home-slider">
        <div class="homeslider">
            <div class="container-fluid">
				<div class="row">
                    <div class="content-slide">
                        <ul id="contenhomeslider">
                        <?php if(isset($slider_list) && count($slider_list) >0)
                        {
                          foreach ($slider_list as $slider) {
                          ?>
                          <li><img class="img-responsive" alt="<?php echo $slider['title'];?>" src="<?php echo $slider['image'];?>" title="<?php echo $slider['title'];?>" /></li>
                          <?php
                          }
                        }
                        else
                         {
                          ?>
                          <li><img class="img-responsive" alt="slider-1" src="<?php echo CATALOG_PATH;?>images/main-slider/slide-1.jpg" title="slide-1" /></li>
                         <li><img class="img-responsive" alt="slider-1" src="<?php echo CATALOG_PATH;?>images/main-slider/slide-2.jpg" title="slide-1" /></li>
                         <li><img class="img-responsive" alt="slider-1" src="<?php echo CATALOG_PATH;?>images/main-slider/slide-3.jpg" title="slide-1" /></li>
                      <?php 
                        }
                      ?>
                          
                        </ul>
                    </div>
                </div>
           </div>
      </div>             
</div>
<!-- END : Home slideder-->
