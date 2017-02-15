<!-- Start : featured category sports -->
 <?php if ($header['categories']) { ?>

<?php //echo "<pre>";print_r($header['categories']);exit;
    $config_display_categories =json_decode($this->common->config('config_display_categories'),true);
    foreach ($header['categories'] as $key => $category) 
    { 
        if (in_array($category['category_id'], $config_display_categories)) 
        {
            //-Statr:category
        
    ?>
       
       <div class="category-featured">
    <nav class="navbar nav-menu nav-menu-green show-brand">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-brand"><a href="<?php echo $category['href'];?>"><?php echo $category['name'];?></a></div>
          <span class="toggle-menu"></span>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">           
          <ul class="nav navbar-nav">
           
            <li class="active"><a data-toggle="tab" href="#tab-most-viewed-<?php echo $key;?>">Most Viewed</a></li>
             <li><a data-toggle="tab" href="#tab-best-seller-<?php echo $key;?>">Best Seller</a></li>
           <?php if ($category['children']) { 
            $count = 0;
            foreach ($category['children'] as $child) {
               if($count ==3) break;
            ?>
           <li><a href="<?php echo $child['href']?>"><?php echo $child['name']?></a></li>
           <?php 
           $count++;
            }
           }?>
           
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
      <!-- <div id="elevator-2" class="floor-elevator">
            <a href="#elevator-1" class="btn-elevator up fa fa-angle-up"></a>
            <a href="#elevator-3" class="btn-elevator down fa fa-angle-down"></a>
      </div> -->
    </nav>
    <div class="category-banner">

    <?php
            // Start: set-category top left Images
           $category_top_left_banner =array();
           $category_top_left_banner_list = $this->banner->getBanner('home','category',$category['category_id'],'top left');

           foreach ($category_top_left_banner_list as $top_left_banner) 
            {
                   if (is_file(DIR_IMAGE . $top_left_banner['image'])) 
                   {                
                        $image = $this->image->resize($top_left_banner['image'], 585, 65);
                    } 
                    else 
                    {
                        $image = $this->image->resize('no_image.png', 585, 65);
                    }
                  $category_top_left_banner['image'] = $image ;
                  if($top_left_banner['link'])
                  {
                     $category_top_left_banner['link'] = $top_left_banner['link']; 
                  }
                  else
                  {
                     $category_top_left_banner['link'] = '#';
                  }
                 
                  break;
            }

            if(!isset($category_top_left_banner['image']))
            {
                $category_top_left_banner['image'] = $image = $this->image->resize('no_image.png', 585, 65);
            }

            if( !isset($category_top_left_banner['link']))
            {
                $category_top_left_banner['link'] = '#';
            }
        // End: set-categort top left Images

        // Start: set-categort top  right Images
           $category_top_right_banner =array();
           $category_top_right_banner_list = $this->banner->getBanner('home','category',$category['category_id'],'top right');

           foreach ($category_top_right_banner_list as  $top_right_banner) 
            {
                   if (is_file(DIR_IMAGE . $top_right_banner['image'])) 
                   {                
                        $image = $this->image->resize($top_right_banner['image'], 585, 65);
                    } 
                    else 
                    {
                        $image = $this->image->resize('no_image.png', 585, 65);
                    }
                  $category_top_right_banner['image'] = $image ;
                  if($top_right_banner['link'])
                  {
                     $category_top_right_banner['link'] = $top_right_banner['link']; 
                  }
                  else
                  {
                     $category_top_right_banner['link'] = '#';
                  }
                 
                  break;
            }

            if(!isset($category_top_right_banner['image']))
            {
                $category_top_right_banner['image'] = $image = $this->image->resize('no_image.png', 585, 65);
            }

            if( !isset($category_top_right_banner['link']))
            {
                $category_top_right_banner['link'] = '#';
            }
        // End: set-categort right Images

        // Start: set-categort left Images
           $category_left_banner =array();
           $category_left_banner_list = $this->banner->getBanner('home','category',$category['category_id'],'left');

           foreach ($category_left_banner_list as $left_banner) 
            {
                   if (is_file(DIR_IMAGE . $left_banner['image'])) 
                   {                
                        $image = $this->image->resize($left_banner['image'], 234, 350);
                    } 
                    else 
                    {
                        $image = $this->image->resize('no_image.png', 234, 350);
                    }
                  $category_left_banner['image'] = $image ;
                  if($left_banner['link'])
                  {
                     $category_left_banner['link'] = $left_banner['link']; 
                  }
                  else
                  {
                     $category_left_banner['link'] = '#';
                  }
                 
                  break;
            }

            if(!isset($category_left_banner['image']))
            {
                $category_left_banner['image'] = $image = $this->image->resize('no_image.png', 234, 350);
            }

            if( !isset($category_left_banner['link']))
            {
                $category_left_banner['link'] = '#';
            }
        // End: set-categort left Images
            
    ?>
        <div class="col-sm-6 banner">
            <a href="<?php echo $category_top_left_banner['link'];?>"><img alt="ads2" class="img-responsive" src="<?php echo $category_top_left_banner['image'];?>" /></a>
        </div>
        <div class="col-sm-6 banner">
            <a href="<?php echo $category_top_right_banner['link'];?>"><img alt="ads2" class="img-responsive" src="<?php echo $category_top_right_banner['image'];?>" /></a>
        </div>
   </div>
   <div class="product-featured clearfix">
        <div class="banner-featured">
            <div class="featured-text"><span></span></div>
            <div class="banner-img">
                <a href="<?php echo $category_left_banner['link'];?>"><img alt="Featurered 1" src="<?php echo $category_left_banner['image'];?>" /></a>
            </div>
        </div>
        <div class="product-featured-content">
            <div class="product-featured-list">
                <div class="tab-container autoheight">
                    <?php
                    //Start-Best seller
                     $bestseller_list = $this->BestSeller->getBestSeller($category['category_id']);

                     // echo "<pre>";
                     // print_r($bestseller_list);
                    if(isset($bestseller_list['products']) && $bestseller_list['products'])
                    {
                        ?>
                        <!-- tab product -->
                    <div class="tab-panel" id="tab-best-seller-<?php echo $key;?>">
                        <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                        <?php
                        foreach ($bestseller_list['products'] as $bestseller) {
                           ?> <li>
                                <div class="left-block">
                                    <a href="<?php echo $bestseller['href']; ?>">
                                    <img class="img-responsive" alt="<?php echo $bestseller['name']; ?>" src="<?php echo $bestseller['thumb']; ?>" /></a>
                                    <div class="quick-view">
                                            <a title="Add to my wishlist" class="heart" onclick="wishlist.add('<?php echo $bestseller['product_id']; ?>');"></a> <a title="Add to compare" class="compare" onclick="compare.add('<?php echo $bestseller['product_id']; ?>');"></a>
                                    </div>
                                   
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="<?php echo $bestseller['href']; ?>"><?php echo $bestseller['name']; ?></a></h5>
                                    <div class="content_price">
                                        <?php if ($bestseller['price']) { ?>
        <p class="price">
          <?php if (!$bestseller['special']) { ?>
          <span class="price product-price"><?php echo $bestseller['price']; ?></span>
          <?php } else { ?>
          <span class="price product-price"><?php echo $bestseller['special']; ?></span> <span class="old-price"><?php echo $bestseller['price']; ?></span>
          <?php } ?>
          <?php if ($bestseller['tax']) { ?>
          <p class="price-tax">Ex.Tax <?php echo $bestseller['tax']; ?></p>
          <?php } ?>
        </p>
        <?php } ?>
                                    </div>

                                     <?php if ($bestseller['rating']) { ?>
                                         <div class="product-star">
                                          <?php for ($i = 1; $i <= 5; $i++) { ?>
                                          <?php if ($bestseller['rating'] < $i) { ?>
                                          <i class="fa fa-star-o"></i>
                                          <?php } else { ?>
                                          <i class="fa fa-star"></i>
                                          <?php } ?>
                                          <?php } ?>
                                        </div>
                                        <?php } ?>


                                    <!-- <div class="product-star">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div> -->
                                     <div class="cart ">
                            <a onclick="cart.add('<?php echo $bestseller['product_id']; ?>');" class="button hint--top" data-hint="Add to Cart">
                            <i class="button-left-icon"></i>
                            <span class="button-cart-text">Add to Cart</span>
                            <i class="button-right-icon"></i></a>
                        					</div>
                                </div>
                            </li>
                        <?php
                            }
                        ?>
                          
                        </ul>
                    </div>
                <?php

                    }
                     //End-Best seller
                    ?>
                     <?php
                    //Start-most view
                     $mostview_list = $this->PopularProducts->PopularProducts($category['category_id']);
					

                    // echo "<pre>";
                     //print_r($mostview_list['products']);
                    if(isset($mostview_list['products']) && $mostview_list['products'])
                    {
                        ?>
                          <!-- tab product -->
                    <div class="tab-panel active" id="tab-most-viewed-<?php echo $key;?>">
                        <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                            <?php
                        foreach ($mostview_list['products'] as $mostview) {
                           ?>
                            <li>
                                <div class="left-block">
                                    <a href="<?php echo $mostview['href']; ?>"><img class="img-responsive" alt="<?php echo $mostview['name']; ?>" src="<?php echo $mostview['thumb']; ?>" /></a>
                                    <div class="quick-view">
                                            <a title="Add to my wishlist" class="heart" onclick="wishlist.add('<?php echo $mostview['product_id']; ?>');"></a> <a title="Add to compare" class="compare" onclick="compare.add('<?php echo $mostview['product_id']; ?>');"></a> 
                                    </div>
                                   
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="<?php echo $mostview['href']; ?>"><?php echo $mostview['name']; ?></a></h5>
                                    <div class="content_price">
                                        <?php if ($mostview['price']) { ?>
        <p class="price">
          <?php if (!$mostview['special']) { ?>
          <span class="price product-price"><?php echo $mostview['price']; ?></span>
          <?php } else { ?>
          <span class="price product-price"><?php echo $mostview['special']; ?></span> <span class="old-price"><?php echo $mostview['price']; ?></span>
          <?php } ?>
          <?php if ($mostview['tax']) { ?>
          <p class="price-tax">Ex.Tax <?php echo $mostview['tax']; ?></p>
          <?php } ?>
        </p>
        <?php } ?>
                                    </div>
                                     <?php /*if ($mostview['rating']) { ?>
                                         <div class="product-star">
                                          <?php for ($i = 1; $i <= 5; $i++) { ?>
                                          <?php if ($mostview['rating'] < $i) { ?>
                                          <i class="fa fa-star-o"></i>
                                          <?php } else { ?>
                                          <i class="fa fa-star"></i>
                                          <?php } ?>
                                          <?php } ?>
                                        </div>
                                        <?php }*/ ?>
                                        <div class="cart ">
                            <a onclick="cart.add('<?php echo $mostview['product_id']; ?>');" class="button hint--top" data-hint="Add to Cart">
                            <i class="button-left-icon"></i>
                            <span class="button-cart-text">Add to Cart</span>
                            <i class="button-right-icon"></i></a>
                        					</div>
                                </div>
                            </li>
                            <?php
                            }
                        ?>
                        </ul>
                    </div>
                        <?php
                    }
                    ?>
                  
                </div>
            </div>
        </div>
   </div>
</div>
<!-- End : featured category sports-->

       

    <?php
     //-End:Category
    }
  }
} ?>
