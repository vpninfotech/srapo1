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
        	<!-- Center colunm-->
        	<div class="center_column col-xs-12 col-sm-12" id="center_column">
            	<!-- subcategories -->
                <div class="subcategories">
                    <ul>
                        <li class="current-categorie">
                            <a href=""><?php echo $heading_title; ?></a>
                        </li>
                        
                    </ul>
                    
                </div>
                <!-- ./subcategories -->
                
                <!-- view-product-list-->
                <!--<div id="view-product-list" class="view-product-list row">
                    
                	  <div class="sortPagiBar sort-top col-xs-12">
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
                   
                </div>-->
                <!-- view-product-list-->
             <input type="hidden" name="catalog_no" id="catalog_no" value="<?php echo $catalogs['catalog_no']; ?>" />
             <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id; ?>" />
<input type="hidden" name="category_id" id="category_id" value="<?php echo $category_id; ?>" />
<input type="hidden" name="path" id="path" value="<?php echo $path; ?>" />
                <!-- PRODUCT LIST -->
                <ul class="row product-list grid">
                	 <?php foreach ($products as $product) {           ?>
                            <li class="col-sx-12 col-sm-3">
                            <div class="product-container owl-item">
                                <div class="left-block">
                                    <a>
                                        <img class="img-responsive" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" src="<?php echo $product['thumb']; ?>" />
                                    </a>
                                    
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a><?php echo $product['name']; ?></a></h5>
                                    <h5><?php echo 'Design No:'.$product['model']; ?></h5>
                                    
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
          <span class="price product-price"><?php echo 'Price : '.$product['price']; ?></span>
          <?php } else { ?>
          <span class="price product-price"><?php echo 'Price : '.$product['special']; ?></span> <span class="old-price"><?php echo $product['price']; ?></span>
          <?php } ?>
          <?php if ($product['tax']) { ?>
          <p class="price-tax"><?php echo $text_tax; ?> <?php echo 'Price : '.$product['tax']; ?></p>
          <?php } ?>
        </p>
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
                    <?php }  ?>
                </ul>
                <!-- PRODUCT LIST -->
                
                <?php if (!$products) { ?>
      <p><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>

      <?php if($products) {  //echo "<pre>";print_r($products);die;?>

      <div class="row catadesc" id="catadesc">

    <div class="col-sm-9 product-layout product-grid">

          <div class="product-thumb">

                <h2> Price & Description </h2>

                <?php  

                    foreach ($products as $key => $row) {

                        $mid[$key]  = $row['model'];

                    }



          array_multisort($mid, SORT_ASC, $products); ?>

                  <table class="table-responsive">

                      <tr>

                          <th>Model</th>

                            <th>Price</th>

                          <?php //echo "<pre>";print_r($attributes);     

                              foreach ($attributes as $attribute) 

                                { ?>

                          <th><?php echo $attribute['name'];?> </th>

                          <?php } ?>  

                        </tr>

               <?php     foreach ($products as $product) { ?>

               

                      <tr>

                          <td><?php echo $product['model'];?></td>

                            <td><?php if($product['special'])
                                  {
                                        echo $product['special'];
                                      } 
                                      else 
                                      {echo $product['price'];}?></td>

                <?php 

                

                  if(!empty($product['attribute_groups']))

                    {

                        foreach ($product['attribute_groups'] as $attribute_group) 

                        { 

                     
                            foreach ($attribute_group['attribute'] as $attribute) 

                            { 

                                foreach ($attributes as $attr) 

                                { 

                                    if($attr['name'] == $attribute['name'])

                                    {?>

                                        <td><?php echo $attribute['text']; ?></td>

                              <?php } 

                                } 

                           } 

                       }

                   }

                   else

                   {

                        foreach ($attributes as $attribute) { ?>

                          <td> - </td>

                        <?php } 

                   }

               } ?> 

               </tr>

               </table>

          </div>

        </div>

      <div class="col-sm-3 product-layout product-grid">

          <div class="product-thumb">
        
                <h2> Cart </h2>
      <p class="price cprice" style="font-size:13px;font-weight:bold;">

          Catalog : <?php echo $catalogs['catalog_no']; ?> &nbsp;&nbsp;
            <span class="price-new"><?php echo $catalogs['special']; ?></span> 

            <?php if(!empty($catalogs['special'])){ ?>

              <span class="price-old" style="height:20px;">

            <?php } ?>

              <?php echo $catalogs['price']; ?>

            </span>

          </p>
                <div class="custom-btn addcartbtn" style="text-align:center">

                  <a class="btn btn-block btn-success custom button-cart1" id="addcartbtn" style="margin-top:10px;border-radius:30px"> Add To Cart </a>

                 <a href="<?php echo $download; ?>"  id="download_button" class="btn btn-block btn-success custom" style="margin-top:10px;border-radius:30px">Download</a>

                </div>
            </div>
    </div>

    </div>

    <?php } ?>
            </div>
            <!-- Center colunm -->
        </div>
        <!-- ./row -->
	</div>
</div>









      



      



      


      


<style>

.catadesc{

  /*border: 1px solid #000;

    padding: 0 10px 10px 10px;*/

    margin-top: 15px;

}

.catadesc h2{

  background-color:#DE0E5C;

  color:#fff;

  padding:5px;

  margin:0px 0px 5px 0px;

}

.catadesc table

{

  width:100%;

}

.catadesc table tr td,.catadesc table tr th {

  border:1px dashed #999;

  padding:5px 10px;

}

.catadesc .product-thumb .catprice{

  padding:10px;

}

.catadesc .input-group

{    

 margin-bottom: 10px;

    margin-top: 20px;

}

.catadesc .custom

{    

 margin-bottom: 10px;

}

.quscatalog{

  padding:0px !important;

}

.cprice{

      font-size: 14px;

    position: relative;

    top: 5px;



}

.crtprice{
  width:30%;
}
.crt1{
width:20%;
}


</style>

<script type="text/javascript"><!--

$('.button-cart1').on('click', function() {

  var catalog_no = $('#catalog_no').val();
  var product_id = $('#product_id').val();
  var quantity = 1;
  var category_id = $('#category_id').val();
  var path = $('#path').val();
 
  $.ajax({

    url: '<?php echo base_url('checkout/cart/addcatalog'); ?>',

    type: 'post',

    data: {catalog_no:catalog_no,product_id:product_id,quantity:quantity,category_id:category_id,path:path},

    dataType: 'json',

    beforeSend: function() {

      $('.button-cart1').button('loading');

    },

    complete: function() {

      $('.button-cart1').button('reset');

    },

    success: function(json) {

      $('.alert, .text-danger').remove();

      $('.form-group').removeClass('has-error');



      if (json['error']) {
          alert('Error');
        }

      if (json['success']) {

        /*$('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');*/

		new PNotify({
                                            title: json['product_title'],
                                            text: json['product_image'] + json['success'],                                           
                                        });

				$('.cart-link').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');

				$('html, body').animate({ scrollTop: 0 }, 'slow');
				


        $('#cart > ul').load('index.php?route=common/cart/info ul li');

      }

    },

        error: function(xhr, ajaxOptions, thrownError) {

            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

        }

  });

});

//--></script>




