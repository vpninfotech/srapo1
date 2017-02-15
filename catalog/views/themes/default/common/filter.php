<style>
input[type="checkbox"], input[type="radio"] {
    margin: 0px 0px 0px 0px !important;
}
input.color[type="checkbox"], input.color[type="radio"] {
    margin: 4px 0px 0px 0px !important;
}
</style>
<!-- block filter -->
<div class="block left-module">
    <p class="title_block title_filter" data-toggle="collapse" data-target="#demo">Filter selection</p>
    <div class="block_content block_filter">
        <!-- layered -->
        <div class="layered layered-filter-price">
        <?php if(isset($filter['data']['categorie']) && count($filter['data']['categorie'])>0 ){?>
        <!-- filter categgory -->
            <div class="layered_subtitle" id="filter-group">Categories</div>
            <div class="layered-content">
                <ul class="check-box-list">
                	 <?php foreach ($filter['data']['categorie'] as $category) { ?>
                    <li>
                   <label>
<span class="Style" style="background-color:; display:inline-block; margin: 0 5px 0 0;">
<input type="checkbox" id="<?php echo 'c_'.$category['category_id']; ?>" name="filter[]" value="<?php echo 'c'.$category['category_id']; ?>"><em> <?php echo $category['category_name']; ?></em>
</span>
</label>
                    </li>
                 <?php } ?>
                </ul>
            </div> 
            <!-- ./filter categgory -->
        <?php } ?>

        
        
        
        
        
        	<?php if(isset($filter['data'])) { ?>
                	<?php foreach($filter['data']['filter_groups'] as $filter_group) { ?>
        <?php $data = array(); ?>
       		<?php if($filter_group['name'] == 'price' || $filter_group['name'] == 'PRICE' || $filter_group['name'] == 'prices' || $filter_group['name'] == 'PRICES' || $filter_group['name'] == 'Prices' || $filter_group['name'] == 'Price') { ?>
       		<!-- filter price -->
            <div class="layered_subtitle" id="filter-group<?php echo $filter_group['filter_group_id']; ?>"><?php echo $filter_group['name']; ?></div>
            <div class="layered-content slider-range">
                 <?php foreach ($filter_group['filter'] as $filter) { ?>
                  <?php //$data[] = $filter['name'];
                  $data[] = $this->currency->format($filter['name'],$this->session->userdata('currency'),'',false); ?>
                 <?php } ?>
                   
                <div data-label-reasult="Range:" data-min="<?php echo min($data); ?>" data-max="<?php echo max($data); ?>" data-unit="<?php echo $this->currency->getCurrencySymbol($this->session->userdata('currency'));?>" class="slider-range-price" data-value-min="<?php echo min($data); ?>" data-value-max="<?php echo max($data); ?>"></div>
                <div class="amount-range-price">Range: <?php echo $this->currency->getCurrencySymbol($this->session->userdata('currency'));?><?php echo min($data); ?> - <?php echo $this->currency->getCurrencySymbol($this->session->userdata('currency'));?><?php echo max($data); ?></div>
                <script type="text/javascript">
                  var slider_range=['<?php echo min($data);?>','<?php echo max($data);?>'];
                  
                </script>
            </div>
            <!-- ./filter price -->
           
            <?php } elseif($filter_group['name'] == 'color' || $filter_group['name'] == 'COLOR' || $filter_group['name'] == 'colors' || $filter_group['name'] == 'COLORS' || $filter_group['name'] == 'Colors' || $filter_group['name'] == 'Color') { ?>
            <!-- filter color -->
            <div class="layered_subtitle" id="filter-group<?php echo $filter_group['filter_group_id']; ?>"><?php echo $filter_group['name']; ?></div>
            <div class="layered-content filter-color">
                <ul class="check-box-list">
                 <?php foreach ($filter_group['filter'] as $filter) { ?>
                    <li>
                       <label style="background-color:<?php echo $filter['name']; ?>">
<span class="Style" style="display:inline-block; margin: 0 5px 0 0;">
<input type="checkbox" id="<?php echo $filter['filter_id']; ?>" name="filter[]" value="<?php echo $filter['filter_id']; ?>" class="color">
</span>
</label> 
                    </li>
                  <?php } ?>
                </ul>
            </div>
            <!-- ./filter color -->
       		<?php } else {?>
            <!-- filter categgory -->
            <div class="layered_subtitle" id="filter-group<?php echo $filter_group['filter_group_id']; ?>"><?php echo $filter_group['name']; ?></div>
            <div class="layered-content">
                <ul class="check-box-list">
                	 <?php foreach ($filter_group['filter'] as $filter) { ?>
                    <li>
                   <label>
<span class="Style" style="background-color:; display:inline-block; margin: 0 5px 0 0;">
<input type="checkbox" id="<?php echo $filter['filter_id']; ?>" name="filter[]" value="<?php echo $filter['filter_id']; ?>"><em> <?php echo $filter['name']; ?></em>
</span>
</label>
                    </li>
                 <?php } ?>
                </ul>
            </div> 
            <!-- ./filter categgory -->
        
       
           <?php } } ?>
           <?php } ?>
        </div>
        <!-- ./layered -->

    </div>
</div>
<!-- ./block filter  -->
<script type="text/javascript"><!--
var filter = [];
var page_number =1;
$('label').click(function() {

	filter = []
 	$('input[name^=\'filter\']:checked').each(function(element) {
    
		filter.push(this.value);
	});
page_number =1;
	 getFilterData();
});
//-->

$( ".slider-range-price" ).on( "slidechange", function( event, ui ) {
page_number =1;	
slider_range = ui.values;
getFilterData();
	
	} );

function getFilterData()
{

    var filter_limit = $('#filter_limit').val();
    var filter_ordering = $('#filter_ordering').val();
     if (typeof(slider_range) == "undefined")
    {
      slider_range = [];
    }
   $.ajax({
    url: '<?php echo base_url('product/category/search');?>',
    type: 'post',
     dataType: 'json',
    data: {'limit':filter_limit,'sort':filter_ordering,'range':slider_range,'page':page_number,'filter':filter,'order':filter_ordering,'category_id':$('#category_id').val()},
    async: false,
    crossDomain: true,
    beforeSend: function() {
      //$('#button-shipping-method').button('loading');
      $('.loader').css("display", "block");

    },
    complete: function() {
      //$('#button-shipping-method').button('reset');
      $('.loader').css("display", "none");
    },
    success: function(json) {
        if(json['error'])
        {
          alert(json['error']);
        }
         var html = "";
        if(json['products'].length >0 )
        {

         
          $.each(json['products'], function (index,value) {

            html+='<li class="col-sx-12 col-sm-4">';
            html+='      <div class="product-container owl-item">';
            html+='                    <div class="left-block">';
            html+='                        <a href="'+value['href']+'">';
            html+='                <img class="img-responsive" alt="'+value['name']+'" title="'+value['name']+'" src="'+value['thumb']+'" />';
            html+='                        </a>';
            html+='                        <div class="quick-view">';
            html+='                          <a title="Add to my wishlist" class="heart" onclick="wishlist.add('+value['product_id']+');"></a>';
            html+='                          <a title="Add to compare" class="compare" onclick="compare.add('+value['product_id']+');"></a>';
           
            html+='                        </div>';
            html+='                    </div>';
            html+='                    <div class="right-block">';
            html+='                       <h5 class="product-name"><a href="'+value['href']+'">'+value['name']+'</a></h5>';
                                     /*if (value['rating']) 
                                     { 
                                    html+='<div class="product-star">';
                                     for (var i = 1; i <= 5; i++) 
                                      { 
                                        if (value['rating'] < i) 
                                        { 
                                         html+=' <i class="fa fa-star"></i>';
                                         } 
                                         else 
                                         { 
                                          html+='<i class="fa fa-star-o"></i>';
                                          } 
                                     } 
                                    html+='</div>';
                                     }*/
                                      if (value['price']) 
                                      {
                                    html+='<div class="content_price">';
                                     if (!value['special']) 
                                     { 
                                       html+=' <span class="price product-price">'+value['price']+'</span>';
                                      } 
                                      else {
                               
                                       html+=' <span class="price product-price">'+value['special']+'</span> <span class=" price price-old">'+value['price']+'</span>';
                                        } 
                                   if (value['tax']) 
                                   {
                                  html+='<span class="price-tax">Ex Tax: '+value['tax']+'</span>';
                                   } 
                                    html+='</div>';
                                     } 
									
							html+='<div class="cart">';
                            html+='<a onclick="cart.add('+value['product_id']+');" class="button hint--top" data-hint="Add to Cart">';
                            html+='<i class="button-left-icon"></i>';
                            html+='<span class="button-cart-text">Add to Cart</span>';
                            html+='<i class="button-right-icon"></i></a>';
                        	html+='</div>';	
									
									
									
									
									
									
                                    html+='<div class="info-orther">';
                                        html+='<p>Item Code: #'+value['model']+'</p>';
                                        html+='<p class="availability">Availability: <span>';
                                        if(value['quantity']>1){ 
                                          html+='In stock';
                                        }
                                        else 
                                        { 
                                          html+='Out stock';
                                        }
                                        html+='</span></p>';
                                        html+='<div class="product-desc">'+value['description']+'</div>';
                                           
                                        
                                   html+=' </div>';
                               html+=' </div>';
                           html+=' </div>';
                       html+=' </li>';
            
        });
        }
        else
        {
          html='<li class="">There is no product that matches the search criteria.</li>';
        }
        $('.product-list').html(html);

        if(json['pagination'])
        {
          $('.bottom-pagination > nav').html(json['pagination']);
        }
		/* scroll top */ 
        $('body,html').animate({scrollTop:0},400);
            return false;
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}
function setPaginationPage(page)
{
  page_number = page;
  getFilterData();
}



</script>