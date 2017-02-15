<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>
<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/form-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/form-editable/js/bootstrap-editable.min.js">
</script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/all.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
<!-- Select2 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/icheck.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <form class="form-horizontal" action="<?php echo $form_action ?>" enctype="multipart/form-data" method="post" name="orders_form" id="purchase-form">
   	<input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
    <input type="hidden" name="purchase_id" id="purchase_id" value="<?php echo $purchase_id; ?>" />
   	<input type="hidden" name="edit_keyword" id="edit_keyword" value="<?php echo $edit_keyword; ?>" />
   
    <section class="content-header">
      <h1> Purchase</h1>
        <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      	</ul>
      	<div class="pull-right">
         	<button class="btn btn-primary" type="submit" value="save" name="orders_form" id="purchase-form"><i class="fa fa-save"></i></button>
         	<a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i> Cancel </a>
      	</div>
    </section>
    <!------------------ End Content Header (Page header) ---------------------> 
    <!-------------------------- Main content ------------------------------- -->
    <section class="content">    
    
      <div class="row">
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
        
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h2>              
            </div>
            <div class="box-body"> 
         
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
               
                  <ul class="nav nav-tabs" id="order">
                    <li class="active"><a href="#tab-product" data-toggle="tab">Products</a></li>
                    <!--<li><a href="#tab-total" data-toggle="tab">Total</a></li>-->
                  </ul>
                  
                    <div class="tab-content">                   
                      <!-- Start : tab-pane products-->
                      <div class="tab-pane active" id="tab-product">
                      
                      	<!-- start : order and manufacturer -->  
                        <div class="row">                       
                            <div class="col-sm-6"> 
                                <div class="form-group required <?php if(form_error('select_order') !== "") { echo "has-error"; } ?>">                                  
                                  
                                  <label for="select_order" class="col-sm-2 control-label">Order id</label>
                                  <div class="col-sm-10">
                                    <select name="select_order" id="select_order" class="form-control" <?php if($this->uri->segment(3) == 'edit'){?> disabled="disabled" <?php }?>>
                                    
                                    </select>                                   
                                    <?php echo form_error('select_order', '<div class="text-danger">', '</div>'); ?>
                                    <input type="hidden" name="order_id" id="order_id" value="<?php if(isset($order_id)){ echo $order_id; } ?>" />
                                  </div>
                                </div>
                               
         
                             </div>
                             
                             <div class="col-sm-6"> 
                                <div class="form-group required <?php if(form_error('select_manufacturers') !== "") { echo "has-error"; } ?>">                             
                                  
                                  <label for="select_manufacturers" class="col-sm-3 control-label">Manufacturer</label>
                                  <div class="col-sm-9">
                                    <select name="select_manufacturers" id="select_manufacturers" class="form-control" <?php if($this->uri->segment(3) == 'edit'){?> disabled="disabled" <?php }?>>
                                      
                                      
                                    </select>
                                    <?php echo form_error('select_manufacturers', '<div class="text-danger">', '</div>'); ?>
                                    
                                    <input type="hidden" name="manufacturer_id" id="manufacturer_id" value="<?php if(isset($manufacturer_id)){ echo $manufacturer_id; } ?>"/>
                                  </div>
                                </div>
                             </div>                             
                        </div>
                      <!-- end : order and manufacturer -->
                      
                       
                       <!-- Start : product add to cart table --> 
                        <div class="table-responsive table-padding">
                          <table class="table table-striped table-bordered table-hover table-padding" id="attribute">
                          <thead>
                              <tr>
                                <td class="text-left">Product</td>
                                <td class="text-left">Model</td>
                                <td class="text-left">Quantity</td>
                                <td class="text-left">Unit Price</td>
                                <td class="text-left">Total</td>
                                <td>Action</td>
                              </tr>
                          </thead>                          
                          <tbody id="cart">  
                          		<?php //print_r($purchase_products); ?>		 
								<?php if ($purchase_products) { ?>
                                <?php $product_row = 0; ?>
                                <?php foreach ($purchase_products as $purchase_product) { ?>
                                <tr>
                                  <td class="text-left"><?php echo $purchase_product['name']; ?><br />
                                  <input type="hidden" name="product[<?php echo $product_row; ?>][product_id]" value="<?php echo $purchase_product['product_id']; ?>" />
                                   
                                   <input type="hidden" name="product[<?php echo $product_row; ?>][manufacturer_id]" value="<?php echo $purchase_product['manufacturer_id']; ?>" />
                                    <?php foreach ($purchase_product['option'] as $option) { ?>
                                    - <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br />
                                    <?php if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'image') { ?>
                                    <input type="hidden" name="product[<?php echo $product_row; ?>][option][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['product_option_value_id']; ?>" />
                                    <?php } ?>
                                    <?php if ($option['type'] == 'checkbox') { ?>
                                    <input type="hidden" name="product[<?php echo $product_row; ?>][option][<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option['product_option_value_id']; ?>" />
                                    <?php } ?>
                                    <?php if ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') { ?>
                                    <input type="hidden" name="product[<?php echo $product_row; ?>][option][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" />
                                    <?php } ?>
                                    <?php } ?></td>
                                  <td class="text-left"><?php echo $purchase_product['model']; ?></td>
                                  <td class="text-right"><?php echo $purchase_product['quantity']; ?>
                                    <input type="hidden" name="product[<?php echo $product_row; ?>][quantity]" value="<?php echo $purchase_product['quantity']; ?>" />
                                  </td>
                                  <td class="text-right"></td>
                      			  <td class="text-right"></td>
                      			  <td class="text-center"></td>
                                
                                </tr>
                                <?php $product_row++; ?>
                                <?php } ?>                               
                                <?php } else { ?>
                                <tr>
                                  <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
                                </tr>
                              </tbody>
                              <?php } ?>
                          </table>
                          
                          <!-- Total -->
                          <table class="table table-striped table-bordered table-hover table-padding" id="attribute-total">
                          	<tbody id="total">
                            	
                            </tbody>
                          </table>
                        </div>
                       <!-- End : product add to cart table -->
                        
                        <!--Start : Inside Nav tab   -->
                        <ul class="nav nav-tabs nav-justified">
                          <li class="active"><a data-toggle="tab" href="#tab-product-add" aria-expanded="false">Products</a></li>
                        </ul>
                        
                        <div class="tab-content">
                          <!-- Start : tab-pane Product-->
                          <div class="tab-pane active" id="tab-product-add">
                              <legend>Add Product(s)</legend>
                               <!------- Start : input group ------>
                              <div class="form-group">
                                <label for="select_product" class="col-sm-3 col-md-2 control-label">Select Product</label>
                                <div class="col-sm-9 col-md-10">
                                  <input type="text" id="input-product" name="product" class="form-control" placeholder="Select Product">
                                  <input type="hidden" name="product_id" value="" id="product_id"/>
                                </div>
                              </div>
                              <!------- End : input group ------>
                              
                              <!------- Start : input group ------>
                              <div class="form-group">
                                <label for="quantity" class="col-sm-3 col-md-2 control-label">Quantity</label>
                                <div class="col-sm-9 col-md-10">
                                  <input type="text" id="quantity" name="quantity" class="form-control" value="1">
                                </div>
                              </div>
                              <!------- End : input group ------>
                              
                              <!-- Start : option -->
                              <div id="option"></div>
                              <!-- End : option -->
                              <br>
                              <div class="text-right">
                                  <button id="product-add" name="product-add" class="btn btn-primary" type="button">
                                  <i class="fa fa-plus-circle"></i>
                                  Add Product
                                  </button>
                              </div>
                          </div>
                          <!-- End : tab-pane Product-->
                          <br>
                          
                          
                           
                            <div class="row">                               
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="payment_status" class="col-sm-3 control-label">Payment Status</label>
                                    <div class="col-md-9">
                                        <select name="payment_status" class="form-control" id="payment_status">
                                          <option value="0">Pending</option>
                                          <option value="1">Done</option>
                                          
                                        </select>
                                        <script>
										  $("#payment_status").val(<?=isset($payment_status)?$payment_status:''?>);
										</script>
                                    </div>
                                  </div>
                              </div>
                             
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="payment_method" class="col-sm-3 control-label">Payment Method</label>
                                    <div class="col-md-9">
                                        <select name="payment_method" class="form-control" id="payment_method" >
                                        <?php
                                        if(isset($payment_methods))
                                        {
                                            foreach($payment_methods as $payment_method)
                                            {
												if($payment_method['payment_code'] == $payment_code)												{
                                            ?>                                  
                                            <option value="<?php echo $payment_method['payment_code']; ?>" selected="selected"><?php echo $payment_method['payment_method_name']; ?></option>
                                            <?php
												}
												else
												{
											?>                                  
                                            <option value="<?php echo $payment_method['payment_code']; ?>"><?php echo $payment_method['payment_method_name']; ?></option>
                                            <?php
                                            	}
											}
                                        }
                                        else
                                        {
                                            ?>
                                            <option value="">None</option>
                                           <?php
                                        }
                                        ?>                                      
                                        </select>
                                  
                                    </div>
                                  </div>
                              </div>                              
                            </div>                            
                  			
                            <br />
                              <div class="row">                               
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="received" class="col-sm-3 control-label">Received Status</label>
                                    <div class="col-md-9">
                                        <select name="received" class="form-control" id="received" required="required">
                                          <option value="1">Received</option>
                                          <option value="0">Not received yet</option>
                                        </select>
                                         <script>
									  		$("#received").val(<?=isset($received)?$received:''?>);
										</script>
                                    </div>
                                  </div>
                              </div> 
                              
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="Attachments" class="col-sm-3 control-label"=>Attachment</label>
                                    <div class="col-md-9">
                                        <input type="file" id="fileInput" name="Attachments" class="filestyle img-select-data">
                                     <input id="HAttachments" name="HAttachments" type="hidden" value="<?php if(isset($attachment)){ echo $attachment; } ?>">                                   
                                     
                                    <br/>
                                    <label class="text-muted">Only 5 MB File Size are Allowed </label>
                                    </div>
                                  </div>
                              </div>    
                                                        
                           </div>
                         
                           
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="description" class="col-sm-3 control-label">Note</label>
                                  <div class="col-md-9">
                                  	<textarea name="description" class="form-control" id="description"><?php if(isset($note)){ echo $note; }?></textarea>
                                   </div>
                                  
                                </div>
                              </div>
                              
                                 <?php if ($this->session->userdata('role_id') == 1) { ?>
                                <!------- start : Select group ------>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="user_status">Soft Deleted</label>
                                        <div class="col-md-9">
                                            <input type="checkbox" name="is_deleted" onclick="checkAddress(this)" id="is_deleted" value="<?php echo $is_deleted; ?>" <?php if ($is_deleted == 1) echo 'checked'; ?> />                 
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
                                </div>
                                <!------- End : Select group ------>
						  <?php } ?>
                              
                              
                            </div>
                         
                        </div>
                      </div>
                      <!-- End : tab-pane products -->
                                       
                    <!-- Start : tab-pane Total-->
                    <div class="tab-pane" id="tab-total">                     
                        <!--Start : Button-->
              			<div class="form-group">
                          <div class="col-sm-6 col-xs-6 text-left">
                              <button class="btn btn-default btnPrevious" type="button">
                              <i class="fa fa-arrow-left"></i>
                              Back
                              </button>
                            </div>
                            <div class="col-sm-6 col-xs-6 text-right">
                              <button id="button-refresh" class="btn btn-warning" type="button">
                  <i class="fa fa-refresh"></i>
                </button>
                              <button id="save" class="btn btn-primary" type="submit" value="save" name="orders_save">
                                <i class="fa fa-check-circle"></i>
                                Save
                              </button>
                            </div>
                         </div>
                         <!-- End : Button-->
                    </div>
                    <!-- End : tab-pane- Total -->
                  </div>                	
                  <!-- /.tab-content -->
                
                
              </div>              
              <!-- nav-tabs-custom --> 
            </div>
          </div>
        </div>
      </div>
    </section>
    </form>
    <!----------------------- Main content -------------------------------> 
  </div>
  <!------------------- End content-wrapper ---------------------------->

<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js"> 		</script>
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/js/common.js"></script>
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/jquery-validation/jquery.validate.js"></script> <!-- Form Validation --> 

<script type="text/javascript">
//Initializa Summernote
$('#input-description').summernote({height: 300});

//Initialize Select2 Elements
$(".select2").select2();

//Date picker
$('#date_available').datepicker({
  autoclose: true
});

//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass: 'iradio_minimal-blue'
});

	

//order id dropdown menu with search text box
$(document).ready(function() {
	
	
	//get list of order id on document load
	var order_list=new Array();
	var keyword=$('#select_order').val();
	var get_order_id=$('#order_id').val();
	$.ajax({
		url: "<?php echo base_url()."purchase/purchase/getOrderIdList"; ?>",
		type: 'POST',
		async:false,
		data: {
			'keyword':keyword		
		},
		dataType: "json",
		success: function(json) {
			//console.log('order_id: '+JSON.stringify(json));
			
			var json_data=JSON.stringify(json);
			//console.log(json_data['order_id']);
			order_list="";
			order_list+="<option value=''>Select Order id</option>";
			$.each(json,function(index,value){
				
				if(get_order_id > 0)
				{
					if(value.order_id == get_order_id)
					{		
						order_list+="<option value='"+value.order_id+"' selected='selected'>"+value.order_id+"</option>";
					}
					else
					{
						order_list+="<option value='"+value.order_id+"'>"+value.order_id+"</option>";
					}
				}
				else
				{
					order_list+="<option value='"+value.order_id+"'>"+value.order_id+"</option>";					
				}
				
			});
			
			$("#select_order").html(order_list);
			//$("#select_order").select2();
			
		}
	});	
	
	//get manufacturer id
	var manufacturer_id=$('#select_manufacturers').val();
	var manufacturer=$('#manufacturer_id').val();
	//console.log('manufacturer:'+manufacturer);
	if(manufacturer_id == "" || manufacturer_id == null)
	{
		manufacturer_id=manufacturer;
	}
	console.log('manufacturer_id:'+manufacturer_id);
	//display manufacturer list on page load event
	var order_id=$('#select_order').val();
	
	//select order change(when select order id)
	$('#select_order').change(function(){
		var order_id=$('#select_order').val();
		
		$.ajax({
			url: "<?php echo base_url()."purchase/purchase/getManufacturerList"; ?>",
			type: 'POST',
			async:false,
			data: {
				'order_id':order_id		
			},
			dataType: "json",
			success: function(json) {
				
				var data=JSON.stringify(json);
				var html="";
				
				html+="<option value=''>Select Manufacturer</option>";
				$.each(json,function(index,value){
					
					if(manufacturer_id > 0)
					{
						//console.log('in manufacturer_id:'+manufacturer_id);
						if(manufacturer_id == value.manufacturer_id)
						{
							html+="<option value='"+value.manufacturer_id+"' selected='selected'>"+value.manufacturer_name+"</option>";			
						}
						else
						{
							html+="<option value='"+value.manufacturer_id+"'>"+value.manufacturer_name+"</option>";			
						}
					}
					else
					{
						html+="<option value='"+value.manufacturer_id+"'>"+value.manufacturer_name+"</option>";			
					}
					
				});	
				$("#select_manufacturers").html(html);
				//$("#select_manufacturers").select2();
				
				// Refresh products and totals
				$('#button-refresh').trigger('click');
			}
		});
	});
	
	
	
	//on change manufacturer
	$("#select_manufacturers").change(function(){
				
		var manufacturer_id=$('#select_manufacturers').val();		
		var manufacturer=$('#manufacturer_id').val();
		
		if(manufacturer_id == "" || manufacturer_id == null)
		{
			manufacturer_id=manufacturer;
		}
		
		$.ajax({
			type:"POST",
			url: "<?php echo base_url()."api/api_manufacturer"; ?>",	
			async:false,		
			data:{
				'manufacturer_id':manufacturer_id,
			},
			dataType: 'json',
			async:false,			
			success: function(json) {
				//add data in cart
				$.ajax({
					type:"POST",
					url: "<?php echo base_url()."api/api_purchasecart/add"; ?>",
					data: $('#cart input[name^=\'product\'][type=\'text\'], #cart input[name^=\'product\'][type=\'hidden\'], #cart input[name^=\'product\'][type=\'radio\']:checked, #cart input[name^=\'product\'][type=\'checkbox\']:checked, #cart select[name^=\'product\'], #cart textarea[name^=\'product\'],#tab-product select[name=\'select_manufacturers\']'),
					dataType: 'json',			
					success: function(json) {						
						// Refresh products and totals
						$('#button-refresh').trigger('click');						
					}
				});
			}
		});
		
		// Refresh products and totals
		$('#button-refresh').trigger('click');
	});
	
	// Product Name AutoComplate
	$('input[name=\'product\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url('purchase/purchase/getProductListAutocomplete/'); ?>",
			data: {
					'product': request,
					'manufacturer_id':$('#select_manufacturers').val(),
					'order_id': $('#select_order').val()
			},
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						//label: item['product_name'],
						label: item['name'],
						value: item['product_id'],
						model: item['product_model'],
						manufacturer_price: item['product_manufacturer_price'],
						option: item['option'],
						price: item['price']
					}
				}));
			}
		});
	},
	'select': function(item) {
			$('input[name=\'product\']').val(item['label']);
			$('input[name=\'product_id\']').val(item['value']);
			$('input[name=\'model\']').val(item['model']);
			$('input[name=\'manufacturer_price\']').val(item['manufacturer_price']);
			//console.log('option:' + item['option']);
			if (item['option'] != '') {
				html  = '<fieldset>';
				html += '  <legend><?php echo $entry_option; ?></legend>';
	
				for (i = 0; i < item['option'].length; i++) {
					option = item['option'][i];
	
					if (option['type'] == 'select') {
						html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
						html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
						html += '  <div class="col-sm-10">';
						html += '    <select name="option[' + option['product_option_id'] + ']" id="input-option' + option['product_option_id'] + '" class="form-control">';
						html += '      <option value=""><?php echo $text_select; ?></option>';
	
						for (j = 0; j < option['product_option_value'].length; j++) {
							option_value = option['product_option_value'][j];
	
							html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];
	
							/*if (option_value['price']) {
								html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
							}*/
	
							html += '</option>';
						}
	
						html += '    </select>';
						html += '  </div>';
						html += '</div>';
					}
	
					if (option['type'] == 'radio') {
						html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
						html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
						html += '  <div class="col-sm-10">';
						html += '    <select name="option[' + option['product_option_id'] + ']" id="input-option' + option['product_option_id'] + '" class="form-control">';
						html += '      <option value=""><?php echo $text_select; ?></option>';
	
						for (j = 0; j < option['product_option_value'].length; j++) {
							option_value = option['product_option_value'][j];
	
							html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];
	
							if (option_value['price']) {
								html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
							}
	
							html += '</option>';
						}
	
						html += '    </select>';
						html += '  </div>';
						html += '</div>';
					}
	
					if (option['type'] == 'checkbox') {
						html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
						html += '  <label class="col-sm-2 control-label">' + option['name'] + '</label>';
						html += '  <div class="col-sm-10">';
						html += '    <div id="input-option' + option['product_option_id'] + '">';
	
						for (j = 0; j < option['product_option_value'].length; j++) {
							option_value = option['product_option_value'][j];
	
							html += '<div class="checkbox">';
	
							html += '  <label><input type="checkbox" name="option[' + option['product_option_id'] + '][]" value="' + option_value['product_option_value_id'] + '" /> ' + option_value['name'];
	
							if (option_value['price']) {
								html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
							}
	
							html += '  </label>';
							html += '</div>';
						}
	
						html += '    </div>';
						html += '  </div>';
						html += '</div>';
					}
	
					if (option['type'] == 'image') {
						html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
						html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
						html += '  <div class="col-sm-10">';
						html += '    <select name="option[' + option['product_option_id'] + ']" id="input-option' + option['product_option_id'] + '" class="form-control">';
						html += '      <option value=""><?php echo $text_select; ?></option>';
	
						for (j = 0; j < option['product_option_value'].length; j++) {
							option_value = option['product_option_value'][j];
	
							html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];
	
							if (option_value['price']) {
								html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
							}
	
							html += '</option>';
						}
	
						html += '    </select>';
						html += '  </div>';
						html += '</div>';
					}
	
					if (option['type'] == 'text') {
						html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
						html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
						html += '  <div class="col-sm-10"><input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" id="input-option' + option['product_option_id'] + '" class="form-control" /></div>';
						html += '</div>';
					}
	
					if (option['type'] == 'textarea') {
						html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
						html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
						html += '  <div class="col-sm-10"><textarea name="option[' + option['product_option_id'] + ']" rows="5" id="input-option' + option['product_option_id'] + '" class="form-control">' + option['value'] + '</textarea></div>';
						html += '</div>';
					}
	
					if (option['type'] == 'file') {
						html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
						html += '  <label class="col-sm-2 control-label">' + option['name'] + '</label>';
						html += '  <div class="col-sm-10">';
						html += '    <button type="button" id="button-upload' + option['product_option_id'] + '" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>';
						html += '    <input type="hidden" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" id="input-option' + option['product_option_id'] + '" />';
						html += '  </div>';
						html += '</div>';
					}
	
					if (option['type'] == 'date') {
						html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
						html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
						html += '  <div class="col-sm-3"><div class="input-group date"><input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" placeholder="' + option['name'] + '" data-date-format="YYYY-MM-DD" id="input-option' + option['product_option_id'] + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
						html += '</div>';
					}
	
					if (option['type'] == 'datetime') {
						html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
						html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
						html += '  <div class="col-sm-3"><div class="input-group datetime"><input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" placeholder="' + option['name'] + '" data-date-format="YYYY-MM-DD HH:mm" id="input-option' + option['product_option_id'] + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
						html += '</div>';
					}
	
					if (option['type'] == 'time') {
						html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
						html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
						html += '  <div class="col-sm-3"><div class="input-group time"><input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" placeholder="' + option['name'] + '" data-date-format="HH:mm" id="input-option' + option['product_option_id'] + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
						html += '</div>';
					}
				}
	
				html += '</fieldset>';
	
				$('#option').html(html);
	
				/*$('.date').datetimepicker({
					pickTime: false
				});
				
	
				$('.datetime').datetimepicker({
					pickDate: true,
					pickTime: true
				});
	
				$('.time').datetimepicker({
					pickDate: false
				});*/
			} else {
				$('#option').html('');
			}
		}
	});
	
	//Add Product button
	$('#product-add').on('click', function() {		
		$.ajax({
			url: "<?php echo base_url()."api/api_purchasecart/add"; ?>",
			type: 'POST',
			async: false,
			data: $('#tab-product select[name=\'select_manufacturers\'], #tab-product input[name=\'product_id\'], #tab-product input[name=\'quantity\'], #tab-product input[name^=\'option\'][type=\'text\'], #tab-product input[name^=\'option\'][type=\'hidden\'], #tab-product input[name^=\'option\'][type=\'radio\']:checked, #tab-product input[name^=\'option\'][type=\'checkbox\']:checked, #tab-product select[name^=\'option\'], #tab-product textarea[name^=\'option\']'),
			dataType: "json",
			success: function(json) {
				console.log('data: '+JSON.stringify(json));
					$('.alert, .text-danger').remove();
					$('.form-group').removeClass('has-error');
		
					if (json['error']) {
						if (json['error']['warning']) {
							$('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
						}
		
						if (json['error']['option']) {
							for (i in json['error']['option']) {
								var element = $('#input-option' + i.replace('_', '-'));
		
								if (element.parent().hasClass('input-group')) {
									$(element).parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
								} else {
									$(element).after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
								}
							}
						}
		
						
						// Highlight any found errors
						$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
					} else {
						// Refresh products and totals
						$('#button-refresh').trigger('click');
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			//}
		});
	});
		
	
	// Add all products to the purchase product cart using the api
	$('#button-refresh').on('click', function() {
		
		var manufacturer_id=$('#select_manufacturers').val();
		
		
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url()."api/api_purchasecart/products"; ?>",			
			dataType: 'json',
			async:false,			
			data:{
				'manufacturer_id':manufacturer_id,
			},
			success: function(json) {
				console.log(json);
				html = '';			
				
				$('.alert-danger, .text-danger').remove();
	
				// Check for errors
				if (json['error']) {
					if (json['error']['warning']) {
						$('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					}
	
					if (json['error']['stock']) {
						$('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['stock'] + '</div>');
					}
	
					if (json['error']['minimum']) {
						for (i in json['error']['minimum']) {
							$('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['minimum'][i] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
						}
					}
				}
	
			
			if (json['products'].length) {
					for (i = 0; i < json['products'].length; i++) {
						product = json['products'][i];
	
						html += '<tr>';						
						html += '  <td class="text-left">' + product['name'] + '<br />';
						html += '  <input type="hidden" name="product[' + i + '][product_id]" value="' + product['product_id'] + '" />';
						
						html += '  <input type="hidden" name="product_id" value="' + product['product_id'] + '" />';
	
						if (product['option']) {
							for (j = 0; j < product['option'].length; j++) {
								option = product['option'][j];
	
								html += '  - <small>' + option['name'] + ': ' + option['value'] + '</small><br />';
	
								if (option['type'] == 'select' || option['type'] == 'radio' || option['type'] == 'image') {
									html += '<input type="hidden" name="product[' + i + '][option][' + option['product_option_id'] + ']" value="' + option['product_option_value_id'] + '" />';
								}
	
								if (option['type'] == 'checkbox') {
									html += '<input type="hidden" name="product[' + i + '][option][' + option['product_option_id'] + '][]" value="' + option['product_option_value_id'] + '" />';
								}
	
								if (option['type'] == 'text' || option['type'] == 'textarea' || option['type'] == 'file' || option['type'] == 'date' || option['type'] == 'datetime' || option['type'] == 'time') {
									html += '<input type="hidden" name="product[' + i + '][option][' + option['product_option_id'] + ']" value="' + option['value'] + '" />';
								}
							}
						}
	
						html += '</td>';
						html += '  <td class="text-left">' + product['model'] + '</td>';
						html += '  <td class="text-right"><div class="input-group btn-block" style="max-width: 200px;"><input type="text" name="product[' + i + '][quantity]" value="' + product['quantity'] + '" class="form-control" /><span class="input-group-btn"><button type="button" data-toggle="tooltip" title="<?php echo $button_refresh; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary refresh-qty" id="qty-refresh"><i class="fa fa-refresh"></i></button></span></div></td>';
						html += '  <td class="text-right">' + product['price'] + '</td>';
						html += '  <td class="text-right">' + product['total'] + '</td>';
						html += '  <td class="text-center" style="width: 3px;"><button type="button" value="' + product['purchase_cart_id'] + '" data-toggle="tooltip" title="<?php echo $button_remove; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
						html += '</tr>';							
					}
				}
	
				
	
				$('#cart').html(html);
	
				// Totals
				html = '';	
				
					
				//console.log(json['totals']);
				if (json['totals'].length) {
					for (i in json['totals']) {
						total = json['totals'][i];
	
						html += '<tr>';
						html += '  <td class="text-left" colspan="4"><b>' + total['title'] + ':</b></td>';
						html += '  <td class="text-right"><b>' + total['text'] + '</b>';
						//html += '  <input type="hidden" name="getTotal" id="getTotal" value="'+ total['value'] +'">';
						html += '  </td>';
						html += '</tr>';
					}
				}
	
				if (!json['totals'].length && !json['products'].length) {
					html += '<tr>';
					html += '  <td colspan="5" class="text-center"><?php echo $text_no_results; ?></td>';
					html += '</tr>';
				}

				$('#total').html(html);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});
	
	//on load
	jQuery(window).load(function () { 			
		if($('#edit_keyword').val() == 1)
		{
			//change trigger
			$("#select_manufacturers").trigger('change');			  	
			$("#select_order").trigger('change');
		}
	});	
	
	//cart Quantity Referesh button
	$('#cart').delegate('.btn-primary', 'click', function() {		
		var node = this;
		
		// Refresh products, vouchers and totals
		$.ajax({
			url: "<?php echo base_url()."api/api_purchasecart/addQuantity"; ?>",
			type: 'post',
			async:false,
			data: $('#cart input[name^=\'product_id\'][type=\'hidden\'],#cart input[name^=\'product\'][type=\'text\'], #cart input[name^=\'product\'][type=\'hidden\'], #cart input[name^=\'product\'][type=\'radio\']:checked, #cart input[name^=\'product\'][type=\'checkbox\']:checked, #cart select[name^=\'product\'], #cart textarea[name^=\'product\']'),
			dataType: 'json',
			crossDomain: true,
			beforeSend: function() {
				$(node).button('loading');
			},
			complete: function() {
				$(node).button('reset');
			},
			success: function(json) {
				$('.alert, .text-danger').remove();
				$('.form-group').removeClass('has-error');
	
				if (json['error'] && json['error']['warning']) {
					$('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
	
				if (json['success']) {
					$('#content > .container-fluid').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		}).done(function() {
			$('#button-refresh').trigger('click');
		});
	});


	//delete record from cart
	$('#cart').delegate('.btn-danger', 'click', function() {
		var node = this;		
		$.ajax({
			url:"<?php echo base_url()."api/api_purchasecart/remove"; ?>",
			type: 'post',
			data: 'key=' + encodeURIComponent(this.value),
			dataType: 'json',
			async:false,
			crossDomain: true,
			beforeSend: function() {
				$(node).button('loading');
			},
			complete: function() {
				$(node).button('reset');
			},
			success: function(json) {
				$('.alert, .text-danger').remove();
	
				// Check for errors
				if (json['error']) {
					$('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				} else {
					// Refresh products, vouchers and totals
					$('#button-refresh').trigger('click');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});
	
	//Purchase order Product
	/*$('#button-purchase').click(function(){
		var order_id=$('#select_order').val();
		var manufacturer_id=$('#select_manufacturers').val();
		var payment_method=$('#payment_method').val();
		var fileInput=$('#fileInput').val();
		var description=$('#description').val();
		var received=$('#received').val();
			
		
		$.ajax({
			type:"POST",
			url:"<?php echo base_url()."purchase/purchase/test"; ?>",
			async:
			data: {
				'order_id':order_id,
				'manufacturer_id':manufacturer_id,
				'payment_method':payment_method,
				'fileInput':fileInput,
				'description':description,
				'received':received
			},
			dataType: 'json',
			success: function(json) {
				
			}
		});
	});*/
	
	//file attachment
	jQuery.validator.addMethod('filesize123', function(value, element, param) {
		
		return false; 
	});
	jQuery.validator.addMethod(
		"MaxSize",
		function(value, element) {
	
			console.log("file="+value);
			if(value)
			{
				var size = element.files[0].size;
			   if (size > 5242880)// checks the file more than 1 MB
			   {
					return false;
			   } else {
				   return true;
			   }   
			}
			else
			{
				return true;
			}
			
		},
		"Please upload less than 5 MB file."
	);
	
});	//end of document
</script>