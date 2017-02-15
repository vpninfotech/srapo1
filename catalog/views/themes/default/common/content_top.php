<!-- Start : servives -->

<div class="container">
   <div class="service ">
      <div class="col-xs-6 col-sm-3 service-item">
         <div class="icon"> <img alt="services" src="<?php echo CATALOG_PATH;?>images/icon/s1.png" /> </div>
         <div class="info"> <a href="#">
            <h3>Free Shipping</h3>
            </a> <span>On order over $200</span> </div>
      </div>
      <div class="col-xs-6 col-sm-3 service-item">
         <div class="icon"> <img alt="services" src="<?php echo CATALOG_PATH;?>images/icon/s2.png" /> </div>
         <div class="info"> <a href="#">
            <h3>30-day return</h3>
            </a> <span>Moneyback guarantee</span> </div>
      </div>
      <div class="col-xs-6 col-sm-3 service-item">
         <div class="icon"> <img alt="services" src="<?php echo CATALOG_PATH;?>images/icon/s3.png" /> </div>
         <div class="info" > <a href="#">
            <h3>24/7 support</h3>
            </a> <span>Online consultations</span> </div>
      </div>
      <div class="col-xs-6 col-sm-3 service-item">
         <div class="icon"> <img alt="services" src="<?php echo CATALOG_PATH;?>images/icon/s4.png" /> </div>
         <div class="info"> <a href="#">
            <h3>SAFE SHOPPING</h3>
            </a> <span>Safe Shopping Guarantee</span> </div>
      </div>
   </div>
</div>
<!-- End : services --> 

<!-- Start : Page-top -->
<div class="page-top">
   <div class="container">
      <div class="row">
      <?php    $specialproduct_list = $this->specialproduct->getSpecialProduct();
	  if(isset($specialproduct_list['products']) && $specialproduct_list['products']) { $class = 'col-sm-9'; $no_of = '{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}';} else { $class = 'col-sm-12'; $no_of = '{"0":{"items":1},"600":{"items":3},"1000":{"items":3},"1200":{"items":4}}';} ?>
         <div class="col-xs-12 <?php echo $class; ?> page-top-left">
            <div class="popular-tabs">
               <ul class="nav-tab">
                <li class="active"><a data-toggle="tab" href="#tab-3">New products</a></li>
                  <li><a data-toggle="tab" href="#tab-1">BEST SELLERS</a></li>
                  <li><a data-toggle="tab" href="#tab-2">ON SALE</a></li>
                 
               </ul>
               <div class="tab-container">
                  <?php

                        //Start-Best seller
                        $bestseller_list = $this->BestSeller->getBestSeller();

                        if(isset($bestseller_list['products']) && $bestseller_list['products'])
                        {
                            ?>
                  <div id="tab-1" class="tab-panel">
                     <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='<?php echo $no_of; ?>'>
                        <?php
                        foreach ($bestseller_list['products'] as $bestseller) {
                           ?>
                        <li>
                           <div class="left-block"> <a href="<?php echo $bestseller['href']; ?>"> <img class="img-responsive" alt="<?php echo $bestseller['name']; ?>" src="<?php echo $bestseller['thumb']; ?>" /> </a>
                              <div class="quick-view"> <a title="Add to my wishlist" class="heart" onclick="wishlist.add('<?php echo $bestseller['product_id']; ?>');"></a> <a title="Add to compare" class="compare" onclick="compare.add('<?php echo $bestseller['product_id']; ?>');"></a> </div>
                             
                              <div class="group-price">
                                 <?php if($bestseller['quantity'] <= 0)
                                                {
                                                    ?>
                                 <span class="product-sale">Sale</span>
                                 <?php
                                                }
                                                ?>
                              </div>
                           </div>
                           <div class="right-block">
                              <h5 class="product-name"><a href="<?php echo $bestseller['href']; ?>"><?php echo $bestseller['name']; ?></a></h5>
                              <div class="content_price">
                                 <?php if ($bestseller['price']) { ?>
                                
                                    <?php if (!$bestseller['special']) { ?>
                                    <span class="price product-price"><?php echo $bestseller['price']; ?></span>
                                    <?php } else { ?>
                                  <span class="old-price"><?php echo $bestseller['price']; ?></span>  <span class="price product-price"><?php echo $bestseller['special']; ?></span> 
                                    <?php } ?>
                                    <?php if ($bestseller['tax']) { ?>
                                 <p class="price-tax">Ex.Tax <?php echo $bestseller['tax']; ?></p>
                                 <?php } ?>
                                 
                                 <?php } ?>
                              </div>
                              <?php /*if ($bestseller['rating']) { ?>
                              <div class="product-star">
                                 <?php for ($i = 1; $i <= 5; $i++) { ?>
                                 <?php if ($bestseller['rating'] < $i) { ?>
                                 <i class="fa fa-star-o"></i>
                                 <?php } else { ?>
                                 <i class="fa fa-star"></i>
                                 <?php } ?>
                                 <?php } ?>
                              </div>
                              <?php } */?>
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
                    //Start-on sale tab

 

                    $mostview_list = $this->PopularProducts->PopularProducts();
                    if(isset($mostview_list['products']) && $mostview_list['products'])
                    { ?>
                  <div id="tab-2" class="tab-panel">
                     <ul class="product-list owl-carousel"  data-dots="false" data-loop="true" data-nav = "true" data-margin = "30"  data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='<?php echo $no_of; ?>'>
                        <?php
                                foreach ($mostview_list['products'] as $mostview) {
                                   ?>
                        <li>
                           <div class="left-block"> <a href="<?php echo $mostview['href']; ?>"><img class="img-responsive" alt="<?php echo $mostview['name']; ?>" src="<?php echo $mostview['thumb']; ?>" /></a>
                              <div class="quick-view">  <a title="Add to my wishlist" class="heart" onclick="wishlist.add('<?php echo $mostview['product_id']; ?>');"></a> <a title="Add to compare" class="compare" onclick="compare.add('<?php echo $mostview['product_id']; ?>');"></a>  </div>
                              
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
                              <?php } */?>
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
                     //End-on Sale tab
                    ?>
                  <?php
                     //Start-latest product tab
                        $latestproduct_list = $this->latestproduct->getLatestProduct();
                        if(isset($latestproduct_list['products']) && $latestproduct_list['products'])
                        {
                            ?>
                  <div id="tab-3" class="tab-panel active">
                     <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='<?php echo $no_of; ?>'>
                        <?php
                                foreach ($latestproduct_list['products'] as $latestproduct) {
                                   ?>
                        <li>
                           <div class="left-block"> <a href="<?php echo $latestproduct['href']; ?>"><img class="img-responsive" alt="<?php echo $latestproduct['name']; ?>" src="<?php echo $latestproduct['thumb']; ?>" /></a>
                              <div class="quick-view"> <a title="Add to my wishlist" class="heart" onclick="wishlist.add('<?php echo $latestproduct['product_id']; ?>');"></a> <a title="Add to compare" class="compare" onclick="compare.add('<?php echo $latestproduct['product_id']; ?>');"></a> </div>
                             
                           </div>
                           <div class="right-block">
                              <h5 class="product-name"><a href="<?php echo $latestproduct['href']; ?>"><?php echo $latestproduct['name']; ?></a></h5>
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
                              <?php /*if ($latestproduct['rating']) { ?>
                              <div class="product-star">
                                 <?php for ($i = 1; $i <= 5; $i++) { ?>
                                 <?php if ($latestproduct['rating'] < $i) { ?>
                                 <i class="fa fa-star-o"></i>
                                 <?php } else { ?>
                                 <i class="fa fa-star"></i>
                                 <?php } ?>
                                 <?php } ?>
                              </div>
                              <?php }*/ ?>
                               <div class="cart ">
                            <a onclick="cart.add('<?php echo $latestproduct['product_id']; ?>');" class="button hint--top" data-hint="Add to Cart">
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
                     //End-latest Product tab
                    ?>
               </div>
            </div>
         </div>
         <?php  //Start-special product tab
                      
                        // echo "<pre>";
                        // print_r($specialproduct_list);
                        if(isset($specialproduct_list['products']) && $specialproduct_list['products'])
                        {
                            ?>
         <div class="col-xs-12 col-sm-3 page-top-right">
            <div class="latest-deals">
               <h2 class="latest-deal-title">latest deals</h2>
               <div class="latest-deal-content">
                  <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":1}}'>
                     <?php
                         $count=0;
                        foreach ($specialproduct_list['products'] as $specialproduct) {
                           ?>
                     <li>
                        <div class="count-down-time" data-countdown="<?php echo $specialproduct['special_date_end']; ?>"></div>
                        <div class="left-block"> <a href="<?php echo $specialproduct['href']; ?>"><img class="img-responsive" alt="<?php echo $specialproduct['name']; ?>" src="<?php echo $specialproduct['thumb']; ?>" /></a>
                           <div class="quick-view"> <a title="Add to my wishlist" class="heart" onclick="wishlist.add('<?php echo $specialproduct['product_id']; ?>');"></a> <a title="Add to compare" class="compare" onclick="compare.add('<?php echo $specialproduct['product_id']; ?>');"></a> </div>
                          
                        </div>
                        <div class="right-block">
                           <h5 class="product-name"><a href="<?php echo $specialproduct['href']; ?>"><?php echo $specialproduct['name']; ?></a></h5>
                           <div class="content_price"> <span class="price product-price"><?php echo $specialproduct['special']; ?></span> <span class="price old-price"><?php echo $specialproduct['price']; ?></span> </div>
                           <div class="cart ">
                            <a onclick="cart.add('<?php echo $specialproduct['product_id']; ?>');" class="button hint--top" data-hint="Add to Cart">
                            <i class="button-left-icon"></i>
                            <span class="button-cart-text">Add to Cart</span>
                            <i class="button-right-icon"></i></a>
                        					</div>
                        </div>
                     </li>
                     <?php
                             $count++;
                            }
                            //If product count is 1 then put extra <li> tag
                            if($count==1)
                            {
                              ?>
                     <li></li>
                     <?php   }
                        ?>
                  </ul>
               </div>
            </div>
         </div>
         <?php } else { }
                    //End- Special Product
                    ?>
      </div>
   </div>
</div>
<!--End : Page-top -->