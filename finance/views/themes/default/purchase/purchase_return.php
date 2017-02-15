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
    <form class="form-horizontal" action="<?php echo $form_action ?>" enctype="multipart/form-data" method="post" name="purchase_return_form" id="purchase-form">
   	<input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
    <input type="hidden" name="purchase_return_id" id="purchase_return_id" value="<?php echo $purchase_return_id; ?>" />
    <input type="hidden" name="purchase_id" id="purchase_id" value="<?php echo $purchase_id; ?>" />
    <input type="hidden" name="purchase_order_id" id="purchase_order_id" value="<?php echo $purchase_order_id; ?>" />
    <input type="hidden" name="currency_symbol" id="currency_symbol" value="<?php echo $currency_symbol; ?>" />
    <input type="hidden" name="currency_code" id="currency_code" value="<?php echo $currency_code; ?>" />
    <input type="hidden" name="currency_value" id="currency_value" value="<?php echo $currency_value; ?>" />
    <input type="hidden" name="currency_id" id="currency_id" value="<?php echo $currency_id; ?>" />
    <input type="hidden" name="edit_keyword" id="edit_keyword" value="<?php echo $edit_keyword; ?>" />
    
    <section class="content-header">
      <h1> Purchase Return</h1>
        <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      	</ul>
      	<div class="pull-right">
         	<button class="btn btn-primary" type="submit" value="save" name="purchase_return_form" id="purchase_return-form"><i class="fa fa-save"></i></button>
            
         	<a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
            	<div class="row">
                 	<div class="col-md-6">
                    	<!-- Start: select -->
                        <div class="form-group required <?php if(form_error('select_purchase_id') !== "") { echo "has-error"; } ?>"> 
                          <label for="select_order" class="col-sm-3 control-label">Purchase id</label>
                          <div class="col-md-9">
                            <select name="select_purchase_id" id="select_purchase_id" class="form-control" <?php if($edit_keyword == 1){ ?> disabled="disabled" <?php } ?>>                  
                            <option value="">Select Purchase id</option>         
                            <?php
							if(isset($list_purchase_id))
							{
                            	foreach($list_purchase_id as $record_purchase_id)  
								{
									if($record_purchase_id['purchase_id'] == $purchase_id)
									{
										?>
										 <option value="<?php echo $record_purchase_id['purchase_id']; ?>" data-purchase_order_id="<?php echo $record_purchase_id['order_id']; ?>" selected="selected"><?php echo $record_purchase_id['purchase_id']; ?></option>
                                         <?php 
									}
									else
									{
									?>
                                    <option value="<?php echo $record_purchase_id['purchase_id']; ?>" data-purchase_order_id="<?php echo $record_purchase_id['order_id']; ?>" ><?php echo $record_purchase_id['purchase_id']; ?></option>
                                    <?php 
									}
								}
							}
							?>
                            </select>                           
                            <?php echo form_error('select_purchase_id', '<div class="text-danger">', '</div>'); ?>        
                            <script>
										 $('#select_purchase_id').val(<?=isset($select_purchase_id)?$select_purchase_id:'';?>);
									  </script>
                            <div class="text-danger" id="err_purchase_id" style="display:none;"></div>
                            <input type="hidden" name="order_id" id="order_id" />
                            <input type="hidden" name="product_name" id="product_name" />
                          </div>
                          <!-- End: select --> 
                     </div>
                 </div>
                 
				
				 <div class="col-sm-6">
					  <!-- Start: input -->
					  <div class="form-group">                             
						  <label for="purchase_date" class="col-sm-3 control-label">Purchase Date</label>
						  <div class="col-sm-9">
							 <input type="text" name="purchase_date" value="<?php echo $purchase_date; ?>" class="form-control" id="purchase_date" disabled="disabled">
						  </div>
						</div>
					  </div>    
					  <!-- End: input -->			
                </div><!-- end of row -->
				
				<div class="row">				
					<div class="col-sm-6"> 
					<!-- Start: input -->
						<div class="form-group required <?php if(form_error('manufacturer') !== "") { echo "has-error"; } ?>">   
						  <label for="manufacturer" class="col-sm-3 control-label" >Manufacturer</label>
						  <div class="col-md-9">
							<input type="text" name="manufacturer" id="manufacturer" class="form-control" value="<?php echo $manufacturer; ?>" disabled="disabled">      
							<input type="hidden" name="manufacturer_id" id="manufacturer_id" class="form-control" value="<?php echo $manufacturer_id; ?>">                         
							<?php echo form_error('manufacturer', '<div class="text-danger">', '</div>'); ?>
							<div class="text-danger" id="err_manufacturer" style="display:none;"></div>
						  </div>
						</div>
					<!-- End: input -->
					</div> 					
					
					<div class="col-sm-6"> 
					<!-- Start: input -->
						<div class="form-group"> 
						  <label for="manufacturer_email" class="col-sm-3 control-label" >Manufacturer Email</label>
						  <div class="col-sm-9">
						   <input type="text" name="manufacturer_email" id="manufacturer_email" class="form-control" value="<?php echo $manufacturer_email; ?>" disabled="disabled">
						  </div>
						</div>
					<!-- End: input -->
					</div>             
              	 
                </div><!-- end of row --> 
				
                <div class="row"> 
                    <div class="col-sm-6"> 
					<!-- Start: input -->
                        <div class="form-group">
						  <label for="manufacturer_telephone" class="col-sm-3 control-label">Manufacturer Telephone</label>
						  <div class="col-md-9">                               
							<input type="text" name="manufacturer_telephone" id="manufacturer_telephone" class="form-control" value="<?php echo $manufacturer_telephone; ?>" disabled="disabled">
						  </div>
                        </div>
					<!-- End: input -->
                    </div> 
					
                    <div class="col-sm-6"> 
					<!-- Start: input -->     
						<div class="form-group"> 
                          <label for="manufacturer_mobile" class="col-sm-3 control-label">Manufacturer Mobile</label>
                          <div class="col-md-9">                               
							<input type="text" name="manufacturer_mobile" id="manufacturer_mobile" class="form-control" value="<?php echo $manufacturer_mobile; ?>" disabled="disabled">
                          </div>
                        </div>
                     <!-- End: input -->
                    </div> 
                </div><!-- end of row -->                   
                <br> 
                 <div>
                 	<label for="product"><h5>Product Information & Reason for Return</h5></label>
						<div class="row">
							<div class="col-sm-6">
							<!-- Start: input -->  
								<div class="form-group required <?php if(form_error('product_name') !== "") { echo "has-error"; } ?>">  
								  <label for="product_name" class="col-md-3 control-label">Product Name</label>
								  <div class="col-md-9">									
									<select name="select_product_name" id="select_product_name" class="form-control">                  
										<option value="">Select Product Name</option>      
										
									</select>
									
									<input type="hidden" name="product_id" class="form-control" id="product_id" value="<?php echo $product_id; ?>"> 
									<input type="hidden" name="purchase_product_id" class="form-control" id="purchase_product_id" > 
									<?php echo form_error('select_product_name', '<div class="text-danger">', '</div>'); ?>    
								  </div>
								</div>
							<!-- End: input -->
							</div>
							
							<div class="col-sm-6"> 
							<!-- Start: input -->
								<div class="form-group "> 
								  <label for="product_model_name" class="col-sm-3 control-label">Product Model Name</label>
								  <div class="col-sm-9">
									<input type="text" name="product_model_name" class="form-control" id="product_model_name" disabled="disabled">  
									<input type="hidden" name="model_name" class="form-control" id="model_name">      
								  </div>
								</div>
								<!-- End: input -->
							</div>
							
						</div><!-- end of row -->
						<div class="row"> 
							<div class="col-sm-6"> 
							<!-- Start: input -->
								<div class="form-group required <?php if(form_error('product_quantity') !== "") { echo "has-error"; } ?>">  
								  <label for="product_quantity" class="col-sm-3 control-label">Product Quantity</label>
								  <div class="col-sm-9">
									<input type="text" name="product_quantity" class="form-control" id="product_quantity" disabled="disabled">  
									<input type="hidden" name="quantity" class="form-control" id="quantity">       
								  </div>
								</div>
							<!-- End: input -->	
							</div>
							
							<div class="col-sm-6"> 
							<!-- Start: input -->
								<div class="form-group required <?php if(form_error('product_options') !== "") { echo "has-error"; } ?>">                                  
								  
								  <label for="product_options" class="col-sm-3 control-label">Product Options</label>
								  <div class="col-sm-9">
									<input type="text" name="product_options" class="form-control" id="product_options" disabled="disabled">        
								  </div>
								</div>
							<!-- End: input -->	
							</div>							
                        </div><!-- end of row -->
						
						<div class="row"> 
							<div class="col-sm-6"> 
							<!-- Start: input -->
								<div class="form-group required <?php if(form_error('product_total') !== "") { echo "has-error"; } ?>"> 
								  <label for="product_total" class="col-md-3 control-label">Product Total</label>
								  <div class="col-md-9">
									<input type="text" name="product_price_total" class="form-control" id="product_price_total" disabled="disabled">  
									<input type="hidden" name="price_total" class="form-control" id="price_total">      
									<input type="hidden" name="currency_id" class="form-control" id="currency_id" value="<?php echo $currency_id; ?>">
									<input type="hidden" name="currency_value" class="form-control" id="currency_value" value="<?php echo $currency_value; ?>">
								   <input type="hidden" name="currency_code" class="form-control" id="currency_code" value="<?php echo $currency_code; ?>">
								  </div>
								</div>
								<!-- End: input -->	
							</div>
							
							<div class="col-sm-6">    
								<!-- Start: input -->
								<div class="form-group required <?php if(form_error('reason_for_return') !== "") { echo "has-error"; } ?>">  
									<label for="reason_for_return" class="col-sm-3 control-label">Reason for return</label>
									<div class="col-sm-9">
									<select name="reason_for_return" id="reason_for_return" class="form-control">
									<option value="">Select Reason for return</option>                            <?php 
									if(isset($list_reason))
									{
										foreach($list_reason as $reason)
										{
											if($reason['return_reason_id'] == $reason_for_return)
											{
												?>
												<option value="<?php echo $reason['return_reason_id']; ?>" selected="selected"><?php echo $reason['return_reason_name']; ?></option>
												<?php
											}
											else
											{
											?>
											<option value="<?php echo $reason['return_reason_id']; ?>"><?php echo $reason['return_reason_name']; ?></option>
											<?php
											}
										}
									}
									?>  
									</select>
									<?php echo form_error('reason_for_return', '<div class="text-danger">', '</div>'); ?>        
								</div>
								</div>
								<!-- End: input -->	
							</div>
                        </div><!-- end of row -->
						
						<div class="row"> 
							<div class="col-sm-6">   
								<!-- Start: input -->						  
								<div class="form-group required <?php if(form_error('return_status') !== "") { echo "has-error"; } ?>">    <label for="reason_for_return" class="col-sm-3 control-label">Return Status</label>
								  <div class="col-sm-9">
									<select name="return_status" id="return_status" class="form-control">
									<option value="">Select Return Status</option>                            <?php 
									if(isset($list_return_status))
									{
										foreach($list_return_status as $return_status_data)
										{
											if($return_status_data['return_status_id'] == $return_status)
											{
												?>
												<option value="<?php echo $return_status_data['return_status_id']; ?>" selected="selected"><?php echo $return_status_data['return_status_name']; ?></option>
												<?php
											}
											else
											{
											?>
											<option value="<?php echo $return_status_data['return_status_id']; ?>"><?php echo $return_status_data['return_status_name']; ?></option>
											<?php
											}
										}
									}
									?>  
									</select>
									<?php echo form_error('return_status', '<div class="text-danger">', '</div>'); ?>        
								  </div>
								</div>
								<!-- End: input -->	
							</div>
							
							<div class="col-sm-6">  
								<!-- Start: input -->
								<div class="form-group required <?php if(form_error('return_action') !== "") { echo "has-error"; } ?>">
								  <label for="reason_for_return" class="col-sm-3 control-label">Return Action</label>
								  <div class="col-sm-9">
									<select name="return_action" id="return_action" class="form-control">
									<option value="">Select Return Action</option>                            <?php 
									if(isset($list_return_action))
									{
										foreach($list_return_action as $return_action_data)
										{
											if($return_action_data['return_action_id'] == $return_action)
											{
												?>
												<option value="<?php echo $return_action_data['return_action_id']; ?>" selected="selected"><?php echo $return_action_data['return_action_name']; ?></option>
												<?php
											}
											else
											{
											?>
											<option value="<?php echo $return_action_data['return_action_id']; ?>"><?php echo $return_action_data['return_action_name']; ?></option>
											<?php
											}
										}
									}
									?>  
									</select>
									<?php echo form_error('return_action', '<div class="text-danger">', '</div>'); ?>        
								  </div>
								</div>
								<!-- End: input -->	
							</div>							
                        </div><!-- end of row -->
                          
                        <div class="row"> 
							<div class="col-sm-6">   
								<!-- Start: input -->
								<div class="form-group required <?php if(form_error('product_is_opened') !== "") { echo "has-error"; } ?>">  
									  <label for="product_is_opened" class="col-sm-3 control-label">Product is opened</label>
									  <div class="col-sm-9">
										<select name="product_is_opened" id="product_is_opened" class="form-control">
										<option value="">Select Product is opened</option>                            <option value="1">Yes</option>
										<option value="0">No</option>
										</select>
										<?php echo form_error('product_is_opened', '<div class="text-danger">', '</div>'); ?>        
									  </div>
									  <script>
									  $('#product_is_opened').val(<?=isset($product_is_opened)?$product_is_opened:'';?>);
									  </script>
								</div>
								<!-- End: input -->	
                            </div>
                         
							<div class="col-sm-6"> 	
								<!-- Start: input -->
								<div class="form-group">
								  <label for="faulty_or_other_details" class="col-sm-3 control-label">Faulty or other details</label>
									<div class="col-sm-9">
									<textarea name="faulty_or_other_details" id="faulty_or_other_details" class="form-control"><?php echo $faulty_or_other_details; ?></textarea>
								  </div>
								</div>
								<!-- End: input -->	
							</div>
                        </div><!-- end of row -->
						
						<div class="row">
							<div class="col-sm-6"> 
								<!-- Start: input -->
								<div class="form-group"> 
								  <label for="status" class="col-sm-3 control-label">Status</label>
								  <div class="col-sm-9">
									<select name="status" id="status" class="form-control">
										<option value="">Select Status</option>
										<option value="1">Enabled</option>
										<option value="0">Disabled</option>
									</select>
									
									  <script>
										 $('#status').val(<?=isset($status)?$status:'';?>);
									  </script>
								  </div>
								</div>
								<!-- End: input -->	
							</div>
                         
							<div class="col-sm-6"> 
							<?php if ($this->session->userdata('role_id') == 1) { ?>
									<!------- start : Select group ------>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="user_status">Soft Deleted</label>                             
										<div class="col-sm-9">      
											<input type="checkbox" name="is_deleted" id="is_deleted" value="1" <?php if ($is_deleted == 1) echo 'checked'; ?> />  
										 </div>               
									</div>
									<!------- End : Select group ------>
							<?php } ?>
							</div>   
                     </div><!-- end of row -->
      
                 </div>
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


$(document).ready(function() {
	
	$('#order_id').val("<?php echo $purchase_order_id; ?>");
	//get currency symbol
	var currency_symbol=$('#currency_symbol').val();
	var currency_code=$('#currency_code').val();
	var currency_value=$('#currency_value').val();

	if($('#edit_keyword').val() == 1)
	{	
		console.log('edit');
		$('#product_id').val("<?php echo $product_id; ?>");
		$('#purchase_id').val("<?php echo $purchase_id; ?>");
		$('#select_purchase_id').val("<?php echo $purchase_id; ?>");
					
		var purchase_product_id="<?php echo $purchase_product_id; ?>";
		var product_id = "<?php echo $product_id; ?>";
		$.ajax({
			type:'POST',
			url:"<?php echo base_url('purchase/purchase_return/getProductList'); ?>",
			data:{
				'purchase_id':$('#select_purchase_id').val(),
				'manufacturer_id':$('#manufacturer_id').val()
			},
			dataType:"json",
			success: function(json){
				console.log('pn: '+json);
				
				var html="";
				product_id=$('#product_id').val();
				
				var json_data=JSON.stringify(json);
				
				html+="<option value=''>Select Product Name</option>";
				$.each(json,function(index,value){
					
					if(product_id > 0)
					{
						if(value.product_id == product_id)
						{
							html+="<option value='"+value.product_id+"' data-id='"+value.purchase_product_id+"' data-model='"+value.model+"' data-quantity='"+value.quantity+"' data-price='"+value.price+"' selected='selected'>"+value.name+"</option>";							
							
							product_id=value.product_id;
							$('#purchase_product_id').val(value.purchase_product_id);
							$('#product_model_name').val(value.model);
							$('#model_name').val(value.model);
							$('#product_quantity').val(value.quantity);
							$('#quantity').val(value.quantity);	
							$('#product_price_total').val(currency_symbol+value.quantity*value.price);
							$('#price_total').val(value.quantity*value.price);						
						}
						else
						{
							html+="<option value='"+value.product_id+"' data-id='"+value.purchase_product_id+"' data-model='"+value.model+"' data-quantity='"+value.quantity+"' data-price='"+value.price+"'>"+value.name+"</option>";
						}
					}
					else
					{
						
						html+="<option value='"+value.product_id+"' data-id='"+value.purchase_product_id+"' data-model='"+value.model+"' data-quantity='"+value.quantity+"' data-price='"+value.price+"'>"+value.name+"</option>";
					}
					
				});
				
				$("#select_product_name").html(html);
				console.log(purchase_product_id);
				productOptions(purchase_product_id,product_id);
				//$("#select_product_name").select2();
					
			}
		});
		
		
		function productOptions(purchase_product_id,product_id)
		{		
			$.ajax({
				type:'POST',			
				url:"<?php echo base_url('purchase/purchase_return/productOptions'); ?>",
				data:{							
					'manufacturer_id':$('#manufacturer_id').val(),
					'purchase_id':$('#select_purchase_id').val(),
					'purchase_product_id':purchase_product_id,
					'product_id': product_id
				},
				dataType:"json",
				success: function(json){
					
					var str='';
					
					if(json.length > 1)
					{					
						$.each(json,function(index,value){
							str+=value.name+':'+value.value+', ';						
						});
					}
					else
					{					
						$.each(json,function(index,value){
							if(value.name == null || value.value == null)
							{								
								str+='';
							}
							else
							{								
								str+=value.name+':'+value.value;
							}
						});					
					}				
					$('#product_options').val(str);
				}
			});
		}								
	}
	else
	{
		console.log('add');
		$('#purchase_date').val("<?php echo $purchase_date; ?>");
		// get manufacutrer list
		$('#select_purchase_id').change(function(){
			
			if($('#select_purchase_id').val() == "")
			{
				$('#err_purchase_id').show();
				$('#err_purchase_id').html('Please select purchase id');
			}
			else
			{
				var purchase_product_id = $('option:selected', this).attr('data-purchase_order_id');
				var purchase_id=$('#select_purchase_id').val();
			
				$('#order_id').val(purchase_product_id);				
				$('#err_purchase_id').hide();
			
				$.ajax({
					type:'POST',
					url:"<?php echo base_url('purchase/purchase/getPurchaseDataById'); ?>",
					data:{
						'purchase_id':$('#select_purchase_id').val()
					},
					dataType:"json",
					success: function(data){
						var manufacturer_id=data.manufacturer_id;
						
						//get manufacturer_name from purchase table						
						$('#purchase_date').val(data.date_added);
						
						//get manfacturer name from manufacturer table
						$.ajax({
							type:'POST',							
							url:"<?php echo base_url('purchase/purchase_return/getManufactuereInfo'); ?>",
							data:{							
								'manufacturer_id':manufacturer_id
							},
							dataType:"json",
							success: function(json){
								console.log(json);
								$('#manufacturer').val(json.firstname+' '+json.lastname);
								$('#manufacturer_id').val(json.manufacturer_id);
								$('#manufacturer_email').val(json.email);							
								$('#manufacturer_telephone').val(json.telephone);		
								$('#manufacturer_mobile').val(json.mobile);
								////////////////							
								$.ajax({
									type:'POST',
									url:"<?php echo base_url('purchase/purchase_return/getProductList'); ?>",
									data:{
										'purchase_id':$('#select_purchase_id').val(),
										'manufacturer_id':manufacturer_id
									},
									dataType:"json",
									success: function(json){
										console.log(json);
										var html="";
										var product_id=$('#product_id').val();										
										var json_data=JSON.stringify(json);
										
										html+="<option value=''>Select Product Name</option>";
										$.each(json,function(index,value){
											console.log(value);
											
											if(product_id > 0)
											{
												if(value.product_id == product_id)
												{
													html+="<option value='"+value.product_id+"' data-id='"+value.purchase_product_id+"' data-model='"+value.model+"' data-quantity='"+value.quantity+"' data-price='"+value.price+"' selected='selected' >"+value.name+"</option>";
												}
												else
												{
													html+="<option value='"+value.product_id+"' data-id='"+value.purchase_product_id+"' data-model='"+value.model+"' data-quantity='"+value.quantity+"' data-price='"+value.price+"'>"+value.name+"</option>";
												}
											}
											else
											{
												
												html+="<option value='"+value.product_id+"' data-id='"+value.purchase_product_id+"' data-model='"+value.model+"' data-quantity='"+value.quantity+"' data-price='"+value.price+"'>"+value.name+"</option>";
											}
											
										});
										
										$("#select_product_name").html(html);
										//$("#select_product_name").select2();																					
									}
								});
								//////////////////	
										
							}
						});
					}
				});
			}
		});	
	}
	
	$('#select_product_name').change(function(){	
			
			if($('#select_purchase_id').val() == "")
			{
				$('#err_purchase_id').show();
				$('#err_purchase_id').html('Please select purchase id');
			}
			
			else
			{
				$('#err_purchase_id').hide();
				$('#err_manufacturer').hide();
			}
			
			var purchase_product_id = $('option:selected', this).attr('data-id');
			var product_model_name = $('option:selected', this).attr('data-model');
			var product_quantity = $('option:selected', this).attr('data-quantity');
			var product_price_total = $('option:selected', this).attr('data-price');
			var price_total = $('option:selected', this).attr('data-price');
			var product_id=this.value;
			
			$('#product_id').val(product_id);
			$('#purchase_product_id').val(purchase_product_id);
			$('#product_model_name').val(product_model_name);
			$('#model_name').val($('option:selected', this).attr('data-model'));
			$('#product_quantity').val(product_quantity);
			$('#quantity').val(product_quantity);
			$('#product_price_total').val(currency_symbol+product_quantity*product_price_total);
			$('#price_total').val(product_quantity*price_total);
			
			$.ajax({
				type:'POST',			
				url:"<?php echo base_url('purchase/purchase_return/productOptions'); ?>",
				data:{							
					'manufacturer_id':$('#manufacturer_id').val(),
					'purchase_id':$('#select_purchase_id').val(),
					'purchase_product_id':purchase_product_id,
					'product_id': product_id
				},
				dataType:"json",
				success: function(json){
					
					var str='';
					
					if(json.length > 1)
					{					
						$.each(json,function(index,value){
							str+=value.name+':'+value.value+', ';							
						});
					}
					else
					{					
						$.each(json,function(index,value){
							if(value.name == null || value.value == null)
							{								
								str+='';
							}
							else
							{								
								str+=value.name+':'+value.value;
							}
						});					
					}					
					$('#product_options').val(str);
				}
			});
			
		});
});	//end of document
</script>