<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <ul class="breadcrumb">
        	<?php foreach ($breadcrumbs as $breadcrumb) { ?>
        		<li>
                	<a href="<?php echo $breadcrumb['href']; ?>">
						<?php echo $breadcrumb['text']; ?>
                    </a>
                </li>
        	<?php } ?>
        </ul>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <!-- Product -->
                    <div id="product">
                        <div class="primary-box row">
                            <div class="pb-left-column col-xs-12 col-sm-6">
                                <!-- product-imge-->
                                <div class="product-image">
                                    <div class="product-full">
                                    <?php if ($thumb) { ?>
                                        <img id="product-zoom" src='<?php echo $thumb; ?>' data-zoom-image="<?php echo $thumb; ?>"/> 	
									<?php } ?>
                                    </div>
                                    <div class="product-img-thumb" id="gallery_01">
                                        <ul class="owl-carousel" data-items="3" data-nav="true" data-dots="false" data-margin="20" data-loop="false">
                                        <?php if ($images) { ?>
            								<?php foreach ($images as $image) { ?>
                                            <li>
                                                <a href="#" data-image="<?php echo $image['popup']; ?>" data-zoom-image="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>">
                                                    <img id="product-zoom"  src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /> 
                                                </a>
                                            </li>
                                            <?php } ?>
            							<?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <!-- product-imge-->
                            </div>
                            <div class="pb-right-column col-xs-12 col-sm-6">
                                <h1 class="product-name"><?php echo $heading_title; ?></h1>
                                <div class="product-comments">
                                    <div class="product-star">
                                        <?php if ($rating) { ?>
                                         <div class="product-star">
                                          <?php for ($i = 1; $i <= 5; $i++) { ?>
                                          <?php if ($rating < $i) { ?>
                                          <i class="fa fa-star-o"></i>
                                          <?php } else { ?>
                                          <i class="fa fa-star"></i>
                                          <?php } ?>
                                          <?php } ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="comments-advices">
                                        <a href="#">Based  on <?php echo $reviews; ?></a>
                                       
                                    </div>
                                </div>
            <div class="product-price-group">
                <?php if ($price) { ?>
                    <?php if (!$special) { ?>
                    	<span class="price"><?php echo $price; ?></span>
                    <?php } else { ?>
                		<span class="old-price"><?php echo $price; ?></span>
                 		<span class="price"><?php echo $special; ?></span>
                	<?php } ?>
                	<?php if ($tax) { ?>
                		<span><?php echo $text_tax; ?> <?php echo $tax; ?></span>
                	<?php } ?>
                	<?php if ($discounts) { ?>
						<?php foreach ($discounts as $discount) { ?>
							<?php echo $discount['quantity']; ?>
								<span class="price"><?php echo $text_discount; ?>
								<?php echo $discount['price']; ?></span>
						<?php } ?> 
					<?php } ?>
                <?php } ?>
            </div>
                                <div class="info-orther">
                                    <p><?php echo $text_model; ?> <?php echo $model; ?></p>
                                    <p><?php echo $text_stock; ?> <span class="in-stock"><?php echo $stock; ?></span></p>
                                   
                                </div>
                                <!--<div class="product-desc">
                                    <?php echo $description; ?> 
                                </div>-->
                                <div class="form-option">
                                    <p class="form-option-title">Available Options:</p>
                                    <?php if ($options) { ?>
            						<hr>
                                     <h3><?php echo $text_option; ?></h3>
                                     <?php foreach ($options as $option) { ?>
            <?php if ($option['type'] == 'select') { ?>
            
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <select name="option[<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                <?php if ($option_value['price']) { ?>
                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                <?php } ?>
                </option>
                <?php } ?>
              </select>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'radio') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="radio">
                  <label>
                    <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php if ($option_value['image']) { ?>
                    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> 
                    <?php } ?>                    
                    <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'checkbox') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php if ($option_value['image']) { ?>
                    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> 
                    <?php } ?>
                    <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'text') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'textarea') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <textarea name="option[<?php echo $option['product_option_id']; ?>]" rows="5" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control"><?php echo $option['value']; ?></textarea>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'file') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <button type="button" id="button-upload<?php echo $option['product_option_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
              <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" id="input-option<?php echo $option['product_option_id']; ?>" />
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'date') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group date">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'datetime') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group datetime">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'time') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group time">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php } ?>
            <?php } ?>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                        <div class="attributes">
                                            <div class="attribute-label">Qty:</div>
                                            <div class="attribute-list product-qty-width">
                                                <div class="qty qty-width">
                                                    <button class="btn btn-quantity btn-plus-up"><i class="fa fa-caret-up"></i></button>
                                     <input id="option-product-qty" class="text-center" type="text" value="1" name="quantity">
                                    <button class="btn btn-quantity btn-plus-down"><i class="fa fa-caret-down"></i></button>
                                                   
                                                </div>
                                               
                                            </div>
                                        </div>
                                    
                                </div>
                                <div class="form-action">
                                    <div class="button-group">
                                        
                                        <button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn-add-cart"><?php echo $button_cart; ?></button>
                                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                                    </div>
                                    <div class="button-group">
                                        <a class="wishlist" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product_id; ?>');"><i class="fa fa-heart-o"></i>
                                        <br>Wishlist</a>
                                        <a class="compare" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product_id; ?>');"><i class="fa fa-signal"></i>
                                        <br>        
                                        Compare</a>

                                    </div>
                                </div>
                                <div class="form-share">
                                  
                                    <div class="network-share">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- tab product -->
                        <div class="product-tab">
                            <ul class="nav-tab">
                                <li class="active">
                                    <a aria-expanded="false" data-toggle="tab" href="#product-detail">Product Details</a>
                                </li>
                                <li>
                                    <a aria-expanded="true" data-toggle="tab" href="#information">information</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#reviews">reviews</a>
                                </li>
                            </ul>
                            <div class="tab-container">
                                <div id="product-detail" class="tab-panel active">
                                   <?php echo $description; ?>
                                </div>
                                <div id="information" class="tab-panel">
                                    <table class="table table-bordered">
                <?php foreach ($attribute_groups as $attribute_group) { ?>
                <thead>
                  <tr>
                    <td colspan="2"><strong><?php echo $attribute_group['name']; ?></strong></td>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                  <tr>
                    <td><?php echo $attribute['name']; ?></td>
                    <td><?php echo $attribute['text']; ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
                <?php } ?>
              </table>
                                </div>
                                <?php if ($review_status) { ?>
                                <div id="reviews" class="tab-panel">

                                    <div class="product-comments-block-tab">
  										<form class="form-horizontal" id="form-review">
                						<div id="review"></div>
                                        <div class="row error-msg">
                                            <div class="col-md-12">
                                                <div class="sortPagiBar">
                                                    <div class="bottom-pagination">
                                                    <nav>
                                                        
                                                    </nav>
                                                    </div>
                                                </div>   
                                              </div>  
                                        </div>
                                          
                						<h4><?php echo $text_write; ?></h4>
                                        <?php if ($review_guest) { ?>
                                        	<div class="form-group required">
                                            <div class="col-sm-12">
                                            <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                                            <input id="input-name" class="form-control" name="name" value="<?php echo $customer_name; ?>" type="text">
                                            </div>
                                            
                                        </div>
                                        	<div class="form-group required">
                                            <div class="col-sm-12">
                                            <label class="control-label" for="input-review">Your Review</label>
                                            <textarea id="input-review" class="form-control" name="text" rows="5"></textarea>    
                                            </div>
                                        </div>
                                       	 	<div class="form-group required">
                                        	
                                            <div class="col-sm-12">
                                            <label class="control-label rating-label" for="input-review"><?php echo $entry_rating; ?></label>
                                                <div class="stars">
                                                        <input class="star star-5" id="star-5" type="radio" name="rating" value="1"/>
                                                        <label class="star star-5" for="star-5"></label>
                                                        <input class="star star-4" id="star-4" type="radio" name="rating" value="2"/>
                                                        <label class="star star-4" for="star-4"></label>
                                                        <input class="star star-3" id="star-3" type="radio" name="rating" value="3"/>
                                                        <label class="star star-3" for="star-3"></label>
                                                        <input class="star star-2" id="star-2" type="radio" name="rating" value="4"/>
                                                        <label class="star star-2" for="star-2"></label>
                                                        <input class="star star-1" id="star-1" type="radio" name="rating" value="5"/>
                                                        <label class="star star-1" for="star-1"></label>
                                                </div>
                                            </div>
                                           
                                            <div class="col-sm-12">
                                            	<button class="btn btn-quantity" type="button" id="button-review" data-loading-text="<?php echo $text_loading; ?>" >Continue</button>
                                            </div>
                                            
                                        </div>
                						<?php } else { ?>
                						<?php echo $text_login; ?>
                						<?php } ?>
              							</form>
                                     </div>
                                    
                                </div>
                                <?php } ?>
                               
                            </div>
                        </div>
                        <!-- ./tab product -->
                        
                    </div>
                <!-- Product -->
            </div>
            <!-- ./ Center colunm -->
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3 left-on-detail" id="left_column">
         	 <?php echo $this->load->get_section('colom_right');?>
            </div>

            <!-- ./left colunm -->
            <?php if(isset($products) && $products) { ?>
            <div class="column col-xs-12 col-sm-12">
            	<!-- box product -->
                <div class="page-product-box">
                    <h3 class="heading">Related Products</h3>
                    <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":4},"1000":{"items":4}}'>
                    	
                        <?php foreach($products as $product) { ?>
                        <li>
                            <div class="product-container">
                                <div class="left-block">
                                    <a href="#">
                                        <img class="img-responsive" src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" />
                                    </a>
                                    <div class="quick-view quick-position">
                                           <a title="Add to my wishlist" class="heart" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"></a> <a title="Add to compare" class="compare" onclick="compare.add('<?php echo $product['product_id']; ?>');"></a>
                                    </div>
                                   
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h5>
                                    <!--<div class="product-star">
                                       <?php if ($product['rating']) { ?>
                                         <div class="product-star">
                                          <?php for ($i = 1; $i <= 5; $i++) { ?>
                                          <?php if ($product['rating'] < $i) { ?>
                                          <i class="fa fa-star-o"></i>
                                          <?php } else { ?>
                                          <i class="fa fa-star"></i>
                                          <?php } ?>
                                          <?php } ?>
                                        </div>
                                        <?php } ?>
                                    </div>-->
                                    <div class="content_price">
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
                                    </div>
                                    <div class="cart ">
                            <a onclick="cart.add('<?php echo $product['product_id']; ?>');" class="button hint--top" data-hint="Add to Cart">
                            <i class="button-left-icon"></i>
                            <span class="button-cart-text">Add to Cart</span>
                            <i class="button-right-icon"></i></a>
                        					</div>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                       
                    </ul>
                </div>
                <!-- ./box product -->
            </div>
             <?php } ?>
        </div>
        <!-- ./row-->
    </div>
</div>
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>lib/datetimepicker/moment.js"></script> 
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>lib/datetimepicker/bootstrap-datetimepicker.min.js"></script> 
<link rel="stylesheet" type="text/css" href="<?php echo CATALOG_PATH;?>lib/datetimepicker/bootstrap-datetimepicker.min.css" />
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	pickDate: false
});

//--></script>

<script type="text/javascript"><!--
$(document).ready(function() {
	getReview(1);
});
$('#review').delegate('.pagination a', 'click', function(e) {
    e.preventDefault();

    $('#review').fadeOut('slow');

    $('#review').load(this.href);

    $('#review').fadeIn('slow');
});



$('#button-review').on('click', function() {
	$.ajax({
		url: '<?php echo base_url('product/product/write/'.$product_id); ?>',
		type: 'post',
		dataType: 'json',
		data: $("#form-review").serialize(),
		beforeSend: function() {
			$('#button-review').button('loading');
		},
		complete: function() {
			$('#button-review').button('reset');
		},
		success: function(json) {
			$('.alert-success, .alert-danger').remove();

			if (json['error']) {
				$('.error-msg').after('<br/><div class="alert alert-danger" style="padding:3px 15px;"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				$('.error-msg').after('<br/><div class="alert alert-success" style="padding:3px 15px;"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').prop('checked', false);
			}
		}
	});
});
function getReview(pageno=1)
{
     $.ajax({
        url: '<?php echo site_url('product/product/review/'.$product_id); ?>',
        type: 'post',
        dataType: 'json',
        data: {'page':pageno},
        beforeSend: function() {
            $('#button-review').button('loading');
        },
        complete: function() {
            $('#button-review').button('reset');
        },
        success: function(json) {
            $('.alert-success, .alert-danger').remove();

            if (json['error']) {
                $('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
            }
            var html = "";
            if(json['reviews'].length >0 )
            {

         
          $.each(json['reviews'], function (index,value) {
            html+='<div class="comment row">';
            html+='<div class="col-sm-3 author">';
                   html+='<div class="grade">';
                     html+='<span class="reviewRating">';
                                if (value['rating']) 
                                { 
                             html+='<div class="product-star">';
                                   for (var i = 1; i <= 5; i++) 
                                   { 
                                     if (value['rating'] < i) 
                                    { 
                                        html+='<i class="fa fa-star-o"></i>';
                                    } 
                                    else 
                                    {
                                        html+='<i class="fa fa-star"></i>';
                                    } 
                                   }
                              html+='</div>';
                                 }
                            html+='</span>';
                        html+='</div>';
                        html+='<div class="info-author">';
                            html+='<span><strong>'+value['author']+'</strong></span>';
                            html+='<em>'+value['date_added']+'</em>';
                         html+='</div>';
                     html+='</div>';
                    html+=' <div class="col-sm-9 commnet-dettail">';
                     html+=value['text'];
                     html+='</div>';
                 html+='</div>';
                
         });
        }
        
        if(json['pagination'])
        {
          $('.bottom-pagination > nav').html(json['pagination']);
        }
        $('#review').html(html);
    }
    });

}


//--></script>

<script type="text/javascript"><!--
$('#button-cart').on('click', function() {
	$.ajax({
		url: '<?php echo site_url('checkout/cart/add'); ?>',
		type: 'post',
		data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-cart').button('loading');
		},
		complete: function() {
			$('#button-cart').button('reset');
		},
		success: function(json) {
			
			$('.alert, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));

						if (element.parent().hasClass('input-group')) {
							element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						} else {
							element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						}
					}
				}

				

				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			}

			if (json['success']) {
				/*$('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');*/
                               new PNotify({
                                            title: json['product_title'],
                                            text: json['product_image'] + json['success'],                                           
                                        });

				$('.cart-link').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');

				$('html, body').animate({ scrollTop: 0 }, 'slow');

				//$('#cart > ul').load('index.php?route=common/cart/info ul li');
			}
		},
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
	});
});
//--></script>