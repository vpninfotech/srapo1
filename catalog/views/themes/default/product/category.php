<style>
.sortPagiBar .sort-product {
    width: 183px;
}
.loader {
   position: absolute;
  left: 50%;
  top: 50%;
  z-index: 10000;
  width: 70px;
  height: 70px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
  display: none;

}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
 
<div class="columns-container">

    <div class="container" id="columns">
    <div class="loader"></div>
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
           	<?php foreach ($breadcrumbs as $breadcrumb) { ?>
    			<li>
                	<a href="<?php echo $breadcrumb['href']; ?>">
						<?php echo $breadcrumb['text']; ?>
                    </a>
                </li>
    		<?php } ?>
        </div>

        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <input type="hidden" name="category_id" id="category_id" value="<?=$category_id;?>">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">
                <?php echo $this->load->get_section('filter');?>
            </div>
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
            <!-- subcategories -->
                <div class="subcategories">
                    <ul>
                        <li class="current-categorie">
                            <a href=""><?php echo $heading_title; ?></a>
                        </li>
                    </ul>
                    
                </div>
                <!-- ./subcategories -->
                  <?php //echo '<pre>';print_r($products); ?>
                
                <!-- view-product-list-->
                <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading">
                        <span class="page-heading-title"><?php echo $heading_title; ?></span>
                    </h2>
                	  <div class="sortPagiBar sort-top">
                    <div class="show-product-item">
                        <select onchange="setPaginationPage(1)" name="filter_limit" id="filter_limit">
                             <?php foreach ($limits as $limits) { ?>
            <?php if ($limits['value'] == $limit) { ?>
            <option value="<?php echo $limits['value']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $limits['value']; ?>"><?php echo $limits['text']; ?></option>
            <?php } ?>
            <?php } ?>
                        </select>
                    </div>
                    <div class="sort-product">
                        <select onchange="setPaginationPage(1)" id="filter_ordering" name="filter_ordering">
                        <?php foreach ($sorts as $sorts) { ?>
                                 <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
            <option value="<?php echo $sorts['value']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $sorts['value']; ?>"><?php echo $sorts['text']; ?></option>
            <?php } ?>
                        <?php } ?>
                        </select>
                        <div class="sort-product-icon">
                            <i class="fa fa-sort-alpha-asc"></i>
                        </div>
                    </div>
                </div>
                    <ul class="display-product-option">
                        <li class="view-as-grid selected">
                            <span>grid</span>
                        </li>
                        <li class="view-as-list">
                            <span>list</span>
                        </li>
                    </ul>
                   
                </div>
                
                    <!-- PRODUCT LIST -->
                    <ul class="row product-list grid">
                        
                         <?php foreach ($products as $product) { ?>

                        <li class="col-sx-12 col-sm-4">
                            <div class="product-container owl-item">
                                <div class="left-block">
                                    <a href="<?php echo $product['href']; ?>">
                                        <img class="img-responsive" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" src="<?php echo $product['thumb']; ?>" />
                                    </a>
                                    <div class="quick-view">
                                    
                                           <a title="Add to my wishlist" class="heart" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"></a> <a title="Add to compare" class="compare" onclick="compare.add('<?php echo $product['product_id']; ?>');"></a>
                                    </div>
                                    
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="<?php echo $product['href']; ?>"><?php if($product['catalog_product']==0){echo $product['name'];}else{ echo 'CATALOG NO : '.$product['name'];} ?></a><?php if ($product['catalog_product']==1) { ?><span style="float:right;padding-right:10px">Items(<?php echo $product['total_item'];?>)</span><?php } ?></h5>
                                    <?php /*if ($product['rating']) { ?>
                                    <div class="product-star">
                                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    	<?php if ($product['rating'] < $i) { ?>
                                        	<i class="fa fa-star-o"></i>
                                         <?php } else { ?>
                                        	<i class="fa fa-star"></i>
                                         <?php } ?>
                                    <?php } ?>
                                    </div>
                                    <?php }*/ ?>
                                     <?php if ($product['price']) { ?>
        <p class="price">
          <?php if (!$product['special']) { ?>
          <span class="price product-price"><?php echo $product['price']; ?></span>
          <?php } else { ?>
          <span class="price product-price"><?php echo $product['special']; ?></span> <span class="old-price"><?php echo $product['price']; ?></span>
          <?php } ?>
          <?php if ($product['tax']) { ?>
          <p class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></p>
          <?php } ?>
        </p>
        <?php } ?>
          <?php if($button=='Add to Cart'){ ?>
         <div class="cart ">
                            <a onclick="cart.add('<?php echo $product['product_id']; ?>');" class="button hint--top" data-hint="Add to Cart">
                            <i class="button-left-icon"></i>
                            <span class="button-cart-text"><?php echo $button; ?></span>
                            <i class="button-right-icon"></i></a>
        </div>
        <?php } else { ?>
        <div class="cart ">
                            <a href ='<?php echo $product['href']; ?>'" class="button hint--top" data-hint="Add to Cart">
                            <i class="button-left-icon"></i>
                            <span class="button-cart-text"><?php echo $button; ?></span>
                            <i class="button-right-icon"></i></a>
        </div>
        <?php } ?>
                                    <div class="info-orther">
                                        <p>Item Code: #<?php echo $product['model']; ?></p>
                                        <p class="availability">Availability: <span><?php if($product['quantity']>1){ echo 'In stock';}else { echo 'Out stock';} ?></span></p>
                                        <div class="product-desc">
                                           <?php echo $product['description']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                    <!-- ./PRODUCT LIST -->
                </div>
                <!-- ./view-product-list-->
                <div class="sortPagiBar">
                    <div class="bottom-pagination">
                        <nav>
                          <ul class="pagination">
                            <?php echo $pagination; ?>
                          </ul>
                        </nav>
                    </div>
                    
               
                </div>
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>
