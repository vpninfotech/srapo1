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
<div id="columns" class="container">
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
  <div class="row">

    <div id="content">
      <h1><?php echo $heading_title; ?></h1>
      <label class="control-label" for="input-search"></label>
      <div class="row">
      <div class="col-sm-12">
      
      
      <div class="box-border">
                <ul>
                                    
                    <li class="row">
                        
                        <div class="col-sm-4">
                            
                            <label for="Search" class="required">Search</label>
                             <input type="text" name="search" value="<?php echo $search; ?>" placeholder="<?php echo $text_keyword; ?>" id="input-search" class="form-control" />
<label class="checkbox-inline">
          <?php if ($description) { ?>
          <input type="checkbox" name="description" value="1" id="description" checked="checked" />
          <?php } else { ?>
          <input type="checkbox" name="description" value="1" id="description" />
          <?php } ?>
          <?php echo $entry_description; ?>
          </label>
                        </div><!--/ [col] -->

                        <div class="col-sm-4">
                            
                            <label class="required">All Categories</label>

                            <div class="custom_select">

                                <select name="category_id" id="category_id" class="input form-control">
            <option value="0"><?php echo $text_category; ?></option>
            <?php foreach ($categories as $category_1) { ?>
            <?php if ($category_1['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_1['category_id']; ?>" selected="selected"><?php echo $category_1['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_1['category_id']; ?>"><?php echo $category_1['name']; ?></option>
            <?php } ?>
            <?php foreach ($category_1['children'] as $category_2) { ?>
            <?php if ($category_2['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_2['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_2['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
            <?php } ?>
            <?php foreach ($category_2['children'] as $category_3) { ?>
            <?php if ($category_3['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_3['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_3['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
            <?php } ?>
            <?php } ?>
            <?php } ?>
            <?php } ?>
          </select>

                            </div>


                        </div><!--/ [col] -->
                        
                        <div class="col-sm-4">
                              <label class="required"></label>
                            <label class="checkbox-inline" style="margin-top: 20px;">
            <?php if ($sub_category) { ?>
            <input type="checkbox" name="sub_category" id="sub_category" value="1" checked="checked" />
            <?php } else { ?>
            <input type="checkbox" name="sub_category" id="sub_category" value="1" />
            <?php } ?>
            <?php echo $text_sub_category; ?></label>

                        </div><!--/ [col] -->

                    </li><!--/ .row -->

                </ul>
               <input type="button" value="<?php echo $button_search; ?>" id="button-search" class="btn btn-quantity" style="margin:10px 0px 10px 0px;"/>
            </div>
      
      
      </div>
       
      </div>
      
      
     
      
      
      <div id="search-ajax">
                  <!-- view-product-list-->
                <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading">
                        <span class="page-heading-title"><?php echo $text_search; ?></span>
                    </h2>
                	  <div class="sortPagiBar sort-top">
                    <div class="show-product-item">
                        <select id="input-limit" onchange="getSearchProduct()">
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
                        <select id="input-sort" onchange="getSearchProduct()">
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

      <?php if ($products) { ?>
      <div class="row">
      	<div class="col-sm-12">
         <!-- PRODUCT LIST -->
         <ul class="row product-list grid">
                        
                         <?php foreach ($products as $product) { ?>
                        <li class="col-sx-12 col-sm-3">
                            <div class="product-container">
                                <div class="left-block">
                                    <a href="<?php echo $product['href']; ?>">
                                        <img class="img-responsive" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" src="<?php echo $product['thumb']; ?>" />
                                    </a>
                                    <div class="quick-view">
                                    
                                            <a title="Add to my wishlist" class="heart" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"></a> <a title="Add to compare" class="compare" onclick="compare.add('<?php echo $product['product_id']; ?>');"></a>
                                    </div>
                                    
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h5>
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
                                    <?php } */?>
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
        <div class="cart ">
                            <a onclick="cart.add('<?php echo $product['product_id']; ?>');" class="button hint--top" data-hint="Add to Cart">
                            <i class="button-left-icon"></i>
                            <span class="button-cart-text">Add to Cart</span>
                            <i class="button-right-icon"></i></a>
                        					</div>
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
      </div>
      <div class="sortPagiBar">
                    <div class="bottom-pagination">
                        <nav>
                         <p style="float:left;position:relative;top:25px;right:10px"><?php echo $results; ?></p>
                          <ul class="pagination" style="margin: 10px 0px 0px 0px !important;">
                            <?php echo $pagination; ?>
                          </ul>
                         
                        </nav>
                         
                    </div>
                   
               
                </div>
     
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      </div>
      </div>
</div>
</div>
<script type="text/javascript"><!--
$('#button-search').bind('click', function() {
	getSearchProduct();
       
});

$('#content input[name=\'search\']').bind('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

$('select[name=\'category_id\']').on('change', function() {
	if (this.value == '0') {
		$('input[name=\'sub_category\']').prop('disabled', true);
	} else {
		$('input[name=\'sub_category\']').prop('disabled', false);
	}
  
});

$('select[name=\'category_id\']').trigger('change');

function getSearchProduct(pageno=1)
{
     $.ajax({
        url: '<?php echo site_url('product/search/ajaxSearch'); ?>',
        type: 'post',
        dataType: 'json',
        data: {'page':pageno,'search':$('#input-search').val(),'description':$('#description').val(),'category_id':$('#category_id').val(),'sub_category':$('#sub_category').val(),'sort':$('#input-sort').val(),'limit':$('#input-limit').val(),'order':$('#input-sort').val()},
        beforeSend: function() {
           $('.loader').css("display", "block");
        },
        complete: function() {
            $('.loader').css("display", "none");
        },
        success: function(json) {
          
            $('.alert-success, .alert-danger').remove();

            if (json['error']) {
                $('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
            }
            if(json['search'])
            {
              $("#content > h1").html(json['heading_title']);
            }
            var html = "";
            if (json['products'].length > 0 ) 
            {
                                html+='<p><a href="'+json['compare']+'" id="compare-total">'+json['text_compare']+'</a></p>';
                html+='<div id="view-product-list" class="view-product-list">';
				html+='<h2 class="page-heading">';
				html+='<span class="page-heading-title">'+json['heading_title']+'</span>';
				html+='</h2>';
				html+='<div class="sortPagiBar sort-top">';
				html+='<div class="show-product-item">';
				html+='<select id="input-limit" onchange="getSearchProduct()">';
				$.each(json['limits'], function (limit_index,limit_value) {
                if (limit_value['value'] == json['limit']) 
                {
                  html+='<option value="'+limit_value['value']+'" selected="selected">'+limit_value['text']+'</option>';
                } 
                else 
                {
                  html+='<option value="'+limit_value['value']+'">'+limit_value['text']+'</option>';
                }
                });
                html+='</select>';
				html+='</div>';
                html+='<div class="sort-product">';
                html+='<select id="input-sort" onchange="getSearchProduct()">';
				$.each(json['sorts'], function (sort_index,sort_value) {

                if (sort_value['value'] == json['sort']+'-'+json['order']) 
                {
                  html+='<option value="'+sort_value['value']+'" selected="selected">'+sort_value['text']+'</option>';
                } 
                else 
                {
                  html+='<option value="'+sort_value['value']+'">'+sort_value['text']+'</option>';
                }
                });
				html+='</select>';
				html+='<div class="sort-product-icon">';
				html+='<i class="fa fa-sort-alpha-asc"></i>';
				html+='</div>';
				html+='</div>';
				html+='</div>';
				html+='<ul class="display-product-option">';
				html+='<li class="view-as-grid selected">';
				html+='<span>grid</span>';
				html+='</li>';
				html+='<li class="view-as-list">';
				html+='<span>list</span>';
				html+='</li>';
				html+='</ul>';
				html+='</div>';
				html+='<br />';





            html+='<div class="row">';
             
        
                     html+='<ul class="row product-list grid">';
                         if(json['products'].length >0 )
                          {

                      
                        $.each(json['products'], function (index,value) {
                          html+='<li class="col-sx-12 col-sm-3">';
                          html+='<div class="product-container">';
                              html+='<div class="left-block">';
                                  html+='<a href="'+value['href']+'">';
                                      html+='<img class="img-responsive" alt="'+value['name']+'" title="'+value['name']+'" src="'+value['thumb']+'" />';
                                  html+='</a>';
                                  html+='<div class="quick-view">';
                                    
          html+='<a title="Add to my wishlist" class="heart" onclick="wishlist.add('+value['product_id']+');"></a>';
          html+='<a title="Add to compare" class="compare" onclick="compare.add('+value['product_id']+');"></a>';
                                  html+='</div>';
                                  
                              html+='</div>';
                              html+='<div class="right-block">';
                                  html+='<h5 class="product-name"><a href="'+value['href']+'">'+value['name']+'</a></h5>';
                                     /*if (value['rating']) 
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
                                      } */
                                   if (value['price']) 
                                   { 
                                        html+='<p class="price">';
                                        if (!value['special']) 
                                        { 
                                          html+='<span class="price product-price">'+value['price']+'</span>';
                                        } 
                                        else 
                                        { 
                                          html+='<span class="price product-price">'+value['special']+'</span> <span class="old-price">'+value['price']+'</span>';
                                        }
                                         if (value['tax']) 
                                         { 
                                           html+='<p class="price-tax">Ex.Tax'+value['tax']+'</p>';
                                         }
                                      html+='</p>';
                                  }

                            html+='<div class="cart ">';
                            html+='<a onclick="cart.add('+value['product_id']+');" class="button hint--top" data-hint="Add to Cart">';
                            html+='<i class="button-left-icon"></i>';
                            html+='<span class="button-cart-text">Add to Cart</span>';
                            html+='<i class="button-right-icon"></i></a>';
                            html+='</div>';


                                  html+='<div class="info-orther">';
                                      html+='<p>Item Code: #'+value['model']+'</p>';
                                      html+='<p class="availability">Availability: <span>';
                                      
                                      if(value['quantity']>1)
                                      { 
                                       html+='In stock';
                                      }
                                      else 
                                      { 
                                        html+='Out stock';
                                      } 
                                      html+='</span></p>';
                                      html+='<div class="product-desc">';
                                         html+=value['description'];
                                      html+='</div>';
                                  html+='</div>';
                              html+='</div>';
                          html+='</div>';
                      html+='</li>';
                          
                   });
                  }
                  html+='</ul>';
       html+='</div>';
     
      html+='<div class="sortPagiBar">';
html+='<div class="bottom-pagination">';
html+='<nav>';
html+='<p style="float:left;position:relative;top:25px;right:10px">'+json["results"]+'</p>';
html+='<ul class="pagination" style="margin: 10px 0px 0px 0px !important">'+json["pagination"];
html+='</ul>';
html+='</nav>';
html+='</div>';
html+='</div>';
/* scroll top */ 
        $('body,html').animate({scrollTop:0},400);
           
      }
      else 
      {
       html+='<p>'+json['text_empty']+'</p>';
/* scroll top */ 
        $('body,html').animate({scrollTop:0},400);
          
      }
      $('#search-ajax').html(html);
    }
    });

}

--></script>
