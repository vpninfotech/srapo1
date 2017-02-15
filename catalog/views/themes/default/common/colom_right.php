<?php
 
                        if(isset($latestproduct_list['products']) && $latestproduct_list['products'])
                        {
                            ?>  
                             <!-- block best sellers -->
                <div class="block left-module">
                    <p class="title_block">NEW PRODUCTS</p>
                    <div class="block_content">
                        <ul class="products-block best-sell">
                        	 <?php
							 $count = 1;
                                foreach ($latestproduct_list['products'] as $latestproduct) {  if($count == 5){ break; } $count++;
                                   ?>   
                            <li>
                                <div class="products-block-left">
                                    <a href="<?php echo $latestproduct['href']; ?>"><img class="img-responsive" alt="<?php echo $latestproduct['name']; ?>" src="<?php echo $latestproduct['thumb']; ?>" /></a>
                                </div>
                                <div class="products-block-right">
                                    <p class="product-name">
                                        <a href="<?php echo $latestproduct['href']; ?>"><?php echo $latestproduct['name']; ?></a>
                                    </p>
                                    <div class="content_price">
                                               <?php if ($latestproduct['price']) { ?>
                                                  <p class="price">
                                                    <?php if (!$latestproduct['special']) { ?>
                                                    <span class="price product-price"><?php echo $latestproduct['price']; ?></span>
                                                    <?php } else { ?>
                                                    <span class="price product-price"><?php echo $latestproduct['special']; ?></span> <span class="old-price"><?php echo $latestproduct['price']; ?></span>
                                                    <?php } ?>
                                                    <?php if ($latestproduct['tax']) { ?>
                                                    <p class="price-tax">Ex.Tax <?php echo $latestproduct['tax']; ?></p>
                                                    <?php } ?>
                                                  </p>
                                                  <?php } ?>
                                            </div>
                                    <?php if ($latestproduct['rating']) { ?>
                                         <div class="product-star">
                                          <?php for ($i = 1; $i <= 5; $i++) { ?>
                                          <?php if ($latestproduct['rating'] < $i) { ?>
                                          <i class="fa fa-star-o"></i>
                                          <?php } else { ?>
                                          <i class="fa fa-star"></i>
                                          <?php } ?>
                                          <?php } ?>
                                        </div>
                                        <?php } ?>
                                </div>
                            </li>
                            <?php } ?>
                       </ul>
                    </div>
                </div>
                <!-- ./block best sellers  -->
               
                <?php
                           
                        }
                       
                         // Start: set-Home bottom left Images

           $product_left_banner =array();
           $product_left_banner_list = $this->banner->getBanner('product','right column');

           foreach ($product_left_banner_list as $bottom_left_banner) 
            {
                   if (is_file(DIR_IMAGE . $bottom_left_banner['image'])) 
                   {                
                        $image = $this->image->resize($bottom_left_banner['image'], 270, 281);
                    } 
                    else 
                    {
                        $image = $this->image->resize('no_image.png', 270, 281);
                    }
                  $product_left_banner['image'] = $image ;
                  if($bottom_left_banner['link'])
                  {
                     $product_left_banner['link'] = $bottom_left_banner['link']; 
                  }
                  else
                  {
                     $product_left_banner['link'] = '#';
                  }
                 
                  break;
            }

            if(!isset($product_left_banner['image']))
            {
                $product_left_banner['image'] = $image = $this->image->resize('no_image.png', 270, 281);
            }

            if( !isset($product_left_banner['link']))
            {
                $product_left_banner['link'] = '#';
            }
        // End: set-Home bottom left Images
?>
             <!-- left silide -->
                <div class="col-left-slide left-module text-center">
                    <div class="banner-opacity">
                        <a href="<?php echo $product_left_banner['link'];?>"><img src="<?php echo $product_left_banner['image'];?>" alt="ads-banner"></a>
                    </div>
                </div>
                <!--./left silde-->