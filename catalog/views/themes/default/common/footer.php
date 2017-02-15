<!-- Start : Footer -->
<footer id="footer">
     <div class="container">
            <!-- introduce-box -->
            <div id="introduce-box" class="row">
                <div class="col-md-4">
                    <div id="address-box">
                        
                        <a href="<?php echo site_url('common/home'); ?>"><img src="<?php echo BASE_URL."image/".$header['logo'];?>" alt="" /></a>
                        <div id="address-list">
                            <div class="tit-name">Address:</div>
                            <div class="tit-contain"><?php echo nl2br($header['address']); ?></div>
                            <div class="tit-name">Phone:</div>
                            <div class="tit-contain"><?php echo $header['phone']; ?></div>
                            <div class="tit-name">Email:</div>
                            <div class="tit-contain"><?php echo $header['email']; ?></div>
                        </div>
                    </div> 
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="introduce-title">Company</div>
                            <ul id="introduce-company"  class="introduce-list">
                                <?php foreach ($header['informations'] as $information) { ?>
                                <?php if ($information['column'] == 1 || $information['column'] > 2) { ?>
                                <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                                <?php } ?>
                                <?php } ?>
                                <li><a href="<?php echo $header['sitemap']; ?>">Site Map</a></li>
                            </ul>
                        </div>
                        <!--<div class="col-xs-6 col-sm-4 col-md-4">
                            <div class="introduce-title">My Account</div>
                            <ul id = "introduce-Account" class="introduce-list">
                                <li><a href="order_history.php">My Order</a></li>
                                <li><a href="wishlist.php">My Wishlist</a></li>
                                <li><a href="#">My Credit Slip</a></li>
                                <li><a href="#">My Addresses</a></li>
                                <li><a href="#">My Personal In</a></li>
                            </ul>
                        </div>-->
                        <div class="clearfix footer-adjust"></div>
                        <div class="col-xs-4 col-sm-6 col-md-6">
                            <div class="introduce-title">Support</div>
                            <ul id = "introduce-support"  class="introduce-list">
                                <?php foreach ($header['informations'] as $information) { ?>
                                <?php if ($information['column'] == 2) { ?>
                                <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                                <?php } ?>
                                <?php } ?>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div id="contact-box">
                        <div class="introduce-title">Newsletter</div>
                        <form name="newsletter" id="newsletter" method="post" onsubmit="return false;">
                        <div class="input-group" id="mail-box">
                            <input type="text" name="newsletter_email" id="newsletter_email" placeholder="Your Email Address"/>
                            <span class="input-group-btn">
                                <input type="submit" name="submit" class="btn btn-default" onclick="newsletter_subscribe()" value="OK" style="padding: 6px 30px 6px 12px;"/>
                                <!--<button class="btn btn-default" type="submit" name="submit" onclick="newsletter_subscribe()">OK</button>-->
                            </span>
                        </div><!-- /input-group -->
                        </form>
                        <div class="news_message" style="margin-bottom: 15px; margin-top: -15px;"></div>
                        <div class="introduce-title">Let's Socialize</div>
                        <div class="social-link">
                            <?php if ($header['facebook']) { ?>
                                <a href="<?php echo $header['facebook']; ?>"><i class="fa fa-facebook"></i></a>
                            <?php } ?>
                                
                            <?php if ($header['twitter']) { ?>
                                <a href="<?php echo $header['twitter']; ?>"><i class="fa fa-twitter"></i></a>
                            <?php } ?>
                                
                            <?php if ($header['googleplus']) { ?>
                                <a href="<?php echo $header['googleplus']; ?>"><i class="fa fa-google-plus"></i></a>
                            <?php } ?>
                                
                            <?php if ($header['pinterest']) { ?>
                                <a href="<?php echo $header['pinterest']; ?>"><i class="fa fa-pinterest-p"></i></a>
                            <?php } ?>
                                
                            <?php if ($header['instagram']) { ?>
                                <a href="<?php echo $header['facebook']; ?>"><i class="fa fa-instagram"></i></a>
                            <?php } ?>
                            <!--<a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            <a href="#"><i class="fa fa-vk"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>-->
                        </div>
                    </div>
                    
                </div>
            </div><!-- /#introduce-box -->
        
            <!-- #trademark-box -->
            <div id="trademark-box" class="row">
                <div class="col-sm-12">
                    <ul id="trademark-list">
                        <li id="payment-methods">Accepted Payment Methods</li>
                        <li>
                            <a href="#"><img src="<?php echo CATALOG_PATH;?>images/payment/trademark-ups.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo CATALOG_PATH;?>images/payment/trademark-qiwi.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo CATALOG_PATH;?>images/payment/trademark-wu.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo CATALOG_PATH;?>images/payment/trademark-cn.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo CATALOG_PATH;?>images/payment/trademark-visa.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo CATALOG_PATH;?>images/payment/trademark-mc.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo CATALOG_PATH;?>images/payment/trademark-ems.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo CATALOG_PATH;?>images/payment/trademark-dhl.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo CATALOG_PATH;?>images/payment/trademark-fe.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo CATALOG_PATH;?>images/payment/trademark-wm.jpg"  alt="ups"/></a>
                        </li>
                    </ul> 
                </div>
            </div> <!-- /#trademark-box -->
            
            <!-- #trademark-text-box -->
            <!--<div id="trademark-text-box" class="row">
                <div class="col-sm-12">
                    <ul id="trademark-search-list" class="trademark-list">
                        <li class="trademark-text-tit">HOT SEARCHED KEYWORDS:</li>
                        <li><a href="#" >Xiaomi Mi3</a></li>
                        <li><a href="#" >Digiflipo Pro XT 712 Tablet</a></li>
                        <li><a href="#" >Mi 3 Phones</a></li>
                        <li><a href="#" >Iphoneo 6 Plus</a></li>
                        <li><a href="#" >Women's Messenger Bags</a></li>
                        <li><a href="#" >Wallets</a></li>
                        <li><a href="#" >Women's Clutches</a></li>
                        <li><a href="#" >Backpacks Totes</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul id="trademark-tv-list" class="trademark-list">
                        <li class="trademark-text-tit">TVS:</li>
                        <li><a href="#" >Sonyo TV</a></li>
                        <li><a href="#" >Samsing TV</a></li>
                        <li><a href="#" >LGG TV</a></li>
                        <li><a href="#" >Onidai TV</a></li>
                        <li><a href="#" >Toshibao TV</a></li>
                        <li><a href="#" >Philipsi TV</a></li>
                        <li><a href="#" >Micromaxo TV</a></li>
                        <li><a href="#" >LED TV</a></li>
                        <li><a href="#" >LCD TV</a></li>
                        <li><a href="#" >Plasma TV</a></li>
                        <li><a href="#" >3D TV</a></li>
                        <li><a href="#" >Smart TV</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul id="trademark-mobile-list" class="trademark-list">
                        <li class="trademark-text-tit">MOBILES:</li>  
                        <li><a href="#" >Moto E</a></li>
                        <li><a href="#" >Samsing Mobile</a></li>
                        <li><a href="#" >Micromaxi Mobile</a></li>
                        <li><a href="#" >Nokian Mobile</a></li>
                        <li><a href="#" >HTCi Mobile</a></li>
                        <li><a href="#" >Sonyo Mobile</a></li>
                        <li><a href="#" >Appleo Mobile</a></li>
                        <li><a href="#" >LGG Mobile</a></li>
                        <li><a href="#" >Karbonni Mobile</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul id="trademark-laptop-list" class="trademark-list">
                        <li class="trademark-text-tit">LAPTOPS::</li> 
                        <li><a href="#" >Appleo Laptop</a></li>
                        <li><a href="#" >Acer Laptop</a></li>
                        <li><a href="#" >Samsing Laptop</a></li>
                        <li><a href="#" >Lenov Laptop</a></li>
                        <li><a href="#" >Sonyo Laptop</a></li>
                        <li><a href="#" >Delli Laptop</a></li>
                        <li><a href="#" >Asuso Laptop</a></li>
                        <li><a href="#" >Toshibao Laptop</a></li>
                        <li><a href="#" >LGG Laptop</a></li>
                        <li><a href="#" >HPo Laptop</a></li>
                        <li><a href="#" >Notebook</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul id="trademark-watches-list" class="trademark-list">
                        <li class="trademark-text-tit">WATCHES:</li>  
                        <li><a href="#" >FCUKo Watches</a></li>
                        <li><a href="#" >Titan Watches</a></li>
                        <li><a href="#" >Casioo Watches</a></li>
                        <li><a href="#" >Fastrack Watches</a></li>
                        <li><a href="#" >Timexi Watches</a></li>
                        <li><a href="#" >Fossili Watches</a></li>
                        <li><a href="#" >Dieselo Watches</a></li>
                        <li><a href="#" >Toshibao Laptop</a></li>
                        <li><a href="#" >Luxury Watches</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul id="trademark-shoes-list" class="trademark-list">
                        <li class="trademark-text-tit">FOOTWEAR:</li>  
                        <li><a href="#" >Shoes</a></li>
                        <li><a href="#" >Casual Shoes</a></li>
                        <li><a href="#" >Sports Shoes</a></li>
                        <li><a href="#" >Adidasi Shoes</a></li>
                        <li><a href="#" >Gas Shoes</a></li>
                        <li><a href="#" >Pumai Shoes</a></li>
                        <li><a href="#" >Reeboki Shoes</a></li>
                        <li><a href="#" >Woodlandi Shoes</a></li>
                        <li><a href="#" >Red tape Shoes</a></li>
                        <li><a href="#" >Nikeo Shoes</a></li>
                    </ul>
                </div>
            </div><!-- /#trademark-text-box -->
            <div id="footer-menu-box" style="border-top: 0px;">
                <div class="col-sm-12">
                    <ul class="footer-menu-list">
                        <?php foreach ($header['informations'] as $information) { ?>
                            <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <!--<div class="col-sm-12">
                    <ul class="footer-menu-list">
                        <li><a href="#" >Company Info - Partnerships</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul class="footer-menu-list">
                        <li><a href="#" >Online Shopping</a></li>
                        <li><a href="#" >Promotions</a></li>
                        <li><a href="#" >My Orders</a></li>
                        <li><a href="#" >Help</a></li>
                        <li><a href="sitemap.php" >Site Map</a></li>
                        <li><a href="#" >Customer Service</a></li>
                        <li><a href="#" >Support</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul class="footer-menu-list">
                        <li><a href="#" >Most Populars</a></li>
                        <li><a href="#" >Best Sellers</a></li>
                        <li><a href="#" >New Arrivals</a></li>
                        <li><a href="#" >Special Products</a></li>
                        <li><a href="#" >Manufacturers</a></li>
                        <li><a href="#" >Our Stores</a></li>
                        <li><a href="#" >Shipping</a></li>
                        <li><a href="#" >Payments</a></li>
                        <li><a href="#" >Warantee</a></li>
                        <li><a href="#" >Refunds</a></li>
                        <li><a href="#" >Checkout</a></li>
                        <li><a href="#" >Discount</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul class="footer-menu-list">
                        <li><a href="condition.php" >Terms & Conditions</a></li>
                        <li><a href="privacy.php" >Policy</a></li>
                        <li><a href="shipping.php" >Shipping</a></li>
                        <li><a href="payment.php" >Payments</a></li>
                        <li><a href="return.php" >Returns</a></li>
                        <li><a href="#" >Refunds</a></li>
                        <li><a href="#" >Warrantee</a></li>
                        <li><a href="faq.php" >FAQ</a></li>
                        <li><a href="contact.php" >Contact</a></li>
                    </ul>
                </div>-->
                <p class="text-center">Copyrights &#169; <?php echo date('Y'); ?> Srapo. All Rights Reserved.</p>
            </div><!-- /#footer-menu-box -->
        </div> 
</footer>
</body>
</html>
<!--    NEWSLETTER -->
<script>
function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};
function newsletter_subscribe()
{
    var email=$("#newsletter_email").val();
    
    if(isValidEmailAddress(email))
    {       
        $.post('<?=site_url('account/login/subscribe')?>',{EmailAddress:email},function(data){
        if(data == 1)
        {	
            $(".news_message").css('color','green');
            $(".news_message").html('Thank you for subscribing on our newsletter.');
            $("#newsletter_email").val('');	
        }
        else
        {	
            $(".news_message").css('color','red');
            $(".news_message").html('Already subscribed.');    
        }

        });	
    }
    else
    {
        $(".news_message").css('color','red');
        $(".news_message").html('Please Enter Valid Email Id.'); 
    }
}
</script>

<!-- ./ NEWSLETTER -->