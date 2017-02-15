<!-- Start : MAIN HEADER -->
<div class="container main-header">
  <div class="row">
      <div class="col-xs-12 col-sm-3 logo">
          <a href="<?php echo BASE_URL;?>"><img alt="Srapo" src="<?php echo CATALOG_PATH;?>images/srapos.png" /></a>
      </div>
      <div class="col-xs-7 col-sm-7 header-search-box">
         <form class="form-inline" name="search-form" id="search" method="post" action="<?php echo site_url('product/search');?>" >
                
                <div class="form-group input-serach">
                  <input type="text" id="search_product" name="search" placeholder="Search Products" value="<?php if(isset($search)){echo $search;}?>" autocomplete="off">
                </div>
                <button type="submit" class="pull-right btn-search"></button>
          </form>
      </div>
      <div id="cart-block" class="col-xs-5 col-sm-2 shopping-cart-box">
          <a class="cart-link" href="<?php echo site_url('checkout/cart'); ?>" style="width:210px">
          <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 20px;margin-right: 8px;"></i><span id="cart-total" class="cart-number"><?php echo $header['text_items']; ?></span>
          </a>
          
      </div>
  </div>
  
</div>
<!-- END : MANIN HEADER -->