<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Coupons </h1>
     <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
          
         
        <button class="btn btn-primary" type="submit" value="save" name="coupon_save" form="form-copuon" title="Save"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" class="btn btn-default" title="Back"><i class="fa fa-reply"></i></a>
      </div>
    </section>
    <!------------------ End Content Header (Page header) ---------------------> 
    <!-------------------------- Main content ------------------------------- -->
    <section class="content">
        <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="form-copuon" id="form-copuon"> 
            <?php if(isset($error) && $error!==""): ?>
            <div class="col-xs-12">
            <div class="alert alert-danger alert-bold-border">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
          
                <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error;?>
          
            </div>
            </div>
            <?php endif; ?>
            <?php if(isset($success) && $success!==""): ?>
            <div class="col-xs-12">
            <div class="alert alert-success alert-bold-border">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
          
                <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success;?>
          
            </div>
            </div>
            <?php endif; ?>
      <div class="row">
        <div class="col-xs-12">
            <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
            <input type="hidden" name="coupon_id" value="<?php echo $coupon_id; ?>" />
          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h2>
              
            </div>
            <div class="box-body"> 
           
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('coupon_name')!==""){echo "has-error";} ?>">
                <label for="coupon_name" class="col-sm-3 col-md-2 control-label">
                Coupon Name
                </label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="coupon_name" id="coupon_name" class="form-control" placeholder="Coupon Name" value="<?php echo $coupon_name; ?>">
                    <?php echo form_error('coupon_name','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('code')!==""){echo "has-error";} ?>">
                <label for="code" class="col-sm-3 col-md-2 control-label">
                <span data-original-title="The code the customer enters to get the discount." data-toggle="tooltip">Code</span>
                </label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="code" id="code" class="form-control" placeholder="Code" value="<?php echo $code; ?>">
                    <?php echo form_error('code','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group">
                <label for="type" class="col-sm-3 col-md-2 control-label">
                <span data-original-title="Percentage Of Fixed Amount" data-toggle="tooltip">Type</span>
                </label>
                <div class="col-sm-9 col-md-10">
                    <select name="coupon_type" id="coupon_type" class="form-control">
                        <?php if($coupon_type) { ?>
                            <option value="percentage" <?php if($coupon_type == 'percentage'){echo "selected"; } ?>>Percentage</option>
                            <option value="fixed_amount" <?php if($coupon_type == 'fixed_amount'){echo "selected"; } ?>>Fixed Amount</option>
                        <?php } else { ?>
                            <option value="percentage" <?php if($coupon_type == 'percentage'){echo "selected"; } ?>>Percentage</option>
                            <option value="fixed_amount" <?php if($coupon_type == 'fixed_amount'){echo "selected"; } ?>>Fixed Amount</option>
                        <?php } ?>
                    </select>
                    <script>
                        $("#coupon_type").val(<?=isset($coupon_type)?"'".$coupon_type."'":''?>);
                    </script> 
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group <?php if(form_error('discount')!==""){echo "has-error";} ?>">
                <label for="discount" class="col-sm-3 col-md-2 control-label">Discount</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="discount" id="discount" class="form-control" placeholder="Discount" value="<?php echo $discount;  ?>">
                    <?php echo form_error('discount','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group <?php if(form_error('total_amt')!==""){echo "has-error";} ?>">
                <label for="total_amt" class="col-sm-3 col-md-2 control-label">
                <span data-original-title="The Total Amount That Must be Reached Before The Coupon is valid." data-toggle="tooltip">Total Amount</span>
                </label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="total_amt" id="total_amt" class="form-control" placeholder="Total Amount" value="<?php echo $total_amt ?>">
                    <?php echo form_error('total_amt','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!------- start : input group ------>
                <div class="form-group <?php if(form_error('customer_login')!==""){echo "has-error";} ?>">
                  <label for="customer_login" class="col-sm-3 col-md-2 control-label">
                   <span data-original-title="Customer Must be Logged in to Use The Coupon" data-toggle="tooltip">Customer Login</span>
                   </label>
                  <div class="col-sm-9 col-md-10">
                  <label>
                      <?php if ($customer_login) { ?>
                      <input type="radio" id="customer_login_yes" name="customer_login" value="1" class="minimal" checked="checked">&nbsp;&nbsp;Yes&nbsp;&nbsp;
                      <?php } else { ?>
                      <input type="radio" id="customer_login_yes" name="customer_login" value="1" class="minimal">&nbsp;&nbsp;Yes&nbsp;&nbsp;
                      <?php } ?>
                  </label>
                  <label>
                    <?php if (!$customer_login) { ?> 
                    <input type="radio" id="customer_login_no" name="customer_login" value="0" class="minimal" checked="checked">&nbsp;&nbsp;No 
                    <?php } else { ?>
                    <input type="radio" id="customer_login_no" name="customer_login" value="0" class="minimal">&nbsp;&nbsp;No
                    <?php } ?>
                  </label>
                  <?php echo form_error('customer_login','<div class="text-danger">', '</div>'); ?>
                  </div>
                </div>
              <!------- End : input group ------>
              
              <!------- start : input group ------>
                <div class="form-group <?php if(form_error('shipping')!==""){echo "has-error";} ?>">
                  <label for="free_shipping" class="col-sm-3 col-md-2 control-label">Free Shipping</label>
                  <div class="col-sm-9 col-md-10">
                  <label>
                      <?php if ($shipping) { ?>
                      <input type="radio" id="shipping_yes" name="shipping" value="1" class="minimal" checked="checked">&nbsp;&nbsp;Yes&nbsp;&nbsp;
                      <?php } else { ?>
                      <input type="radio" id="shipping_yes" name="shipping" value="1" class="minimal">&nbsp;&nbsp;Yes&nbsp;&nbsp;
                      <?php } ?>
                  </label>
                  <label>
                    <?php if (!$shipping) { ?> 
                    <input type="radio" id="shipping_no" name="shipping" value="0" class="minimal" checked="checked">&nbsp;&nbsp;No 
                    <?php } else { ?>
                    <input type="radio" id="shipping_no" name="shipping" value="0" class="minimal">&nbsp;&nbsp;No
                    <?php } ?>
                  </label>
                    <?php echo form_error('shipping','<div class="text-danger">', '</div>'); ?>
                  </div>
                </div>
              <!------- End : input group ------>
              
              <!------- Start : input group ------>
              <div class="form-group">
                <label for="products" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="(Auto Complete)">Products</span></label>
                <div class="col-sm-9 col-md-10">
                  <input type="text" id="product" name="product" class="form-control" placeholder="Product">
                  <div id="coupon-product" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($coupon_product as $coupon_product) { ?>
                    <div id="coupon-product<?php echo $coupon_product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $coupon_product['product_name']; ?>
                      <input type="hidden" name="coupon_product[]" value="<?php echo $coupon_product['product_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div> 
                
              </div>
              <!------- End : input group ------>
              
              <!------- Start : input group ------>
              <div class="form-group">
                <label for="categories" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="(Auto Complete)">Category</span></label>
                <div class="col-sm-9 col-md-10">
                  <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Categories">
                  <div id="coupon-category" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($coupon_category as $coupon_category) { ?>
                    <div id="coupon-category<?php echo $coupon_category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $coupon_category['category_name']; ?>
                      <input type="hidden" name="coupon_category[]" value="<?php echo $coupon_category['category_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div> 
                
              </div>
              <!------- End : input group ------>
              
             
              
              <!-- Start : Date Picker Group -->
              <div class="form-group">
                <label for="start_date" class="col-sm-3 col-md-2 control-label">Date Start</label>
                <div class="col-sm-9 col-md-10">
                    <div class="input-group date">
                        <input id="start_date" name="start_date" placeholder="Start Date" class="form-control pull-right" value="<?php echo $start_date ?>" type="text">
                    	<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                	</div>
                </div>
              </div>
              <!-- End : Date Picker Group -->
              
              <!-- Start : Date Picker Group -->
              <div class="form-group">
                <label for="end_date" class="col-sm-3 col-md-2 control-label">Date End</label>
                <div class="col-sm-9 col-md-10">
                    <div class="input-group date">
                      <input id="end_date" name="end_date" placeholder="End Date" class="form-control pull-right" value="<?php echo $end_date ?>" type="text">
                    	<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                	</div>
                </div>
              </div>
              <!------ End : Date Picker Group ------>
              
              <!-- Start : input Group -->
              <div class="form-group">
                <label for="uses_per_coupon" class="col-sm-3 col-md-2 control-label">
                <span data-toggle="tooltip" title="" data-original-title="The Maximum no. of times the coupon can be used By Any Customer. Leave Blank For Unlimited.">Uses Per Coupon</span>
                </label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="uses_per_coupon" id="uses_per_coupon" class="form-control" value="<?php echo $uses_per_coupan ?>">
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group">
                <label for="uses_per_customer" class="col-sm-3 col-md-2 control-label">
                <span data-toggle="tooltip" title="" data-original-title="The Maximum no. of times the coupon can be used By Single Customer. Leave Blank For Unlimited.">Uses Per Customer</span>
                </label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="uses_per_customer" id="uses_per_customer" class="form-control" value="<?php echo $uses_per_customer; ?>">
                </div>
              </div>
              <!-- End : input Group -->
              
              <!------- start : input group ------>
              <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label" for="status">Status</label>
                  <div class="col-sm-9 col-md-10">
                    <select name="status" id="status" class="form-control">
                        <?php if ($status) { ?>
                        <option value="0">Disabled</option>
                        <option value="1" selected="selected">Enabled</option>
                        <?php } else { ?>
                        <option value="0" selected="selected">Disabled</option>
                        <option value="1">Enabled</option>
                        <?php } ?>
                    </select>
                    <script>
                        $("#status").val(<?=isset($status)?$status:''?>);
                    </script> 
                  </div>
              </div>
              <!------- End : input group ------>
              
              <?php if($this->session->userdata('role_id')== 1) { ?>
              <!------- start : Select group ------>
              <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label" for="status">Soft Deleted</label>
                  <div class="col-sm-9 col-md-10">
                    <input type="checkbox" name="is_deleted" onclick="checkAddress(this)" id="is_deleted" value="<?php echo $is_deleted; ?>" <?php if($is_deleted==1) echo 'checked'; ?> />                 
                      <script type="text/javascript">
                            function checkAddress(checkbox)
                            {
                                if (checkbox.checked)
                                {
                                    $("#is_deleted").val("1");
                                }
                                else
                                {
                                    $("#is_deleted").val("0");
                                }
                            }
                      </script>
                  </div>
              </div>
              <!------- End : Select group ------>
              <?php } ?>
              
            </form>
            </div>
            <!-- End : box-body -->
          </div>
        </div>
      </div>
    </section>
    <!----------------------- Main content -------------------------------> 
  </div>
  <!------------------- End content-wrapper ---------------------------->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/js/common.js"></script> 
<script type="text/javascript">
//Product         
$('input[name=\'product\']').autocomplete({
    'source': function(request,response) {
        $.ajax({
            url: "<?php echo base_url('catalog/product/autocomplete/') ?>",
            dataType: 'json',
                        type:'POST',
                        data : {'product_name':request},
            success: function(json) {
                response($.map(json, function(item) {
                    return {
                        label: item['product_name'],
                        value: item['product_id']
                    }
                }));
            }
        });
    },
    'select': function(item) {
        $('input[name=\'product\']').val('');
		
        $('#coupon-product' + item['value']).remove();

        $('#coupon-product').append('<div id="coupon-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="coupon_product[]" value="' + item['value'] + '" /></div>');
    }	
});

$('#coupon-product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});


// Category
$('input[name=\'category_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: "<?php echo base_url('catalog/category/autocomplete/') ?>",
			dataType: 'json',
                                type:'POST',
                                data : {'category_name':request},
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['category_name'],
						value: item['category_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'category_name\']').val('');
		
		$('#coupon-category' + item['value']).remove();
		
		$('#coupon-category').append('<div id="coupon-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="coupon_category[]" value="' + item['value'] + '" /></div>');
	}	
});

$('#coupon-category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
</script>
<script type="text/javascript">
	//Initialize Select2 Elements
    //$(".select2").select2();
	
	//Date picker
    $('#start_date').datepicker({
       todayHighlight:true,
      format : 'yyyy-mm-dd',
      autoclose: true
    });
	
	//Date picker
    $('#end_date').datepicker({
      todayHighlight:true,
      format : 'yyyy-mm-dd',  
      autoclose: true
    });
	

</script>


