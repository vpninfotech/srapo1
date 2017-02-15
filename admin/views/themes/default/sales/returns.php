<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>

<div class="content-wrapper">  
  <form class="form-horizontal" name="returnsform" action="<?php echo $form_action;?>" method="post" id="form-returns">
		<input type="hidden" name="return_id" value="<?php echo $return_id; ?>" />
		<input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Product Returns </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
        <button class="btn btn-primary" type="submit" value="save" name="returns_save"><i class="fa fa-save"></i></button>
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
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> <?php echo $text_form; ?> </h2>
            </div>
            <div class="box-body"> 
                  
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('order_id')!==""){echo "has-error";} ?>">
                <label for="order_id" class="col-sm-2 control-label">Order ID</label>
                <div class="col-sm-10">
                    <input type="text" name="order_id" id="order_id" class="form-control" placeholder="Order ID" value="<?php echo $order_id; ?>">
                    <?php echo form_error('order_id','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              
              <div class="form-group">
                <label for="order_date" class="col-sm-2 control-label">Order Date</label>
                <div class="col-sm-3">
                    <div class="input-group date">
                      <input id="date_ordered" class="form-control" type="text" placeholder="Order Date" value="<?php echo $date_ordered; ?>" name="date_ordered">
                      <span class="input-group-btn">
                      <button class="btn btn-default" type="button">
                      <i class="fa fa-calendar"></i>
                      </button>
                      </span>
                    </div>
                </div>
                
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group">
                <label for="customer" class="col-sm-2 control-label">Customer</label>
                <div class="col-sm-10">
                    <input type="text" name="customer" id="customer" class="form-control" placeholder="Customer" value="<?php echo $customer; ?>">
                    <input type="hidden" name="customer_id" id="customer_id" class="form-control" placeholder="Customer ID" value="<?php echo $customer_id; ?>">
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('firstname')!==""){echo "has-error";} ?>">
                <label for="firstname" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" value="<?php echo $firstname; ?>">
                     <?php echo form_error('firstname','<div class="text-danger">', '</div>'); ?>
                </div>

              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('lastname')!==""){echo "has-error";} ?>">
                <label for="lastname" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" value="<?php echo $lastname; ?>">
                     <?php echo form_error('lastname','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('email')!==""){echo "has-error";} ?>">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
                     <?php echo form_error('email','<div class="text-danger">', '</div>'); ?>

                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('telephone')!==""){echo "has-error";} ?>">
                <label for="telephone" class="col-sm-2 control-label">Telephone</label>
                <div class="col-sm-10">
                    <input type="text" name="telephone" id="telephone" class="form-control" placeholder="Telephone" value="<?php echo $telephone; ?>">
                     <?php echo form_error('telephone','<div class="text-danger">', '</div>'); ?>
              	</div>
              </div>
              <!-- End : input Group -->
              
              <legend>Product Information & Reason for Return</legend>
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('product')!==""){echo "has-error";} ?>">
                <label for="product" class="col-sm-2 control-label">Product</label>
                <div class="col-sm-10">
                     <input type="text" name="product" id="product" class="form-control" placeholder="Product" value="<?php echo $product; ?>">
                     
                     <input type="hidden" name="product_id" id="product_id" class="form-control" placeholder="Product id" value="<?php echo $product_id; ?>">
                     <?php echo form_error('product','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group">
                <label for="model" class="col-sm-2 control-label">Model</label>
                <div class="col-sm-10">
                  <input type="text" name="model" id="model" class="form-control" placeholder="Model" value="<?php echo $model; ?>">
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group">
                <label for="quantity" class="col-sm-2 control-label">Quantity</label>
                <div class="col-sm-10">
                  <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity" value="<?php echo $quantity; ?>">
                </div>
              </div>
              <!-- End : input Group -->
              
              <!------- start : input group ------>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="return_reason_id">Return Reason</label>
                  <div class="col-sm-10">
                    <select name="return_reason_id" id="return_reason_id" class="form-control">
                      <?php
					  foreach($reasons as $return_reasons)
					  {
						  ?>
						  <option value="<?php echo $return_reasons['return_reason_id']; ?>"><?php echo $return_reasons['return_reason_name']; ?></option>
                          <?php
					  }
					  ?>
                    </select>
                    <script>
					  $("#return_reason_id").val(<?=isset($return_reason_id)?$return_reason_id:''?>);
					</script>
                  </div>
              </div>
              <!------- End : input group ------>
              
              <!------- start : input group ------>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="opened">Opened</label>
                  <div class="col-sm-10">
                    <select name="opened" id="opened" class="form-control">
                      <option value="0"> UnOpened </option>
                      <option value="1"> Opened </option>
                    </select>
                    <script>
					  $("#opened").val(<?=isset($opened)?$opened:''?>);
					</script>
                  </div>
              </div>
              <!------- End : input group ------>
              
              <!------- start : input group ------>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="comment">Comment</label>
                  <div class="col-sm-10">
                    <textarea name="comment" id="comment" class="form-control" rows="4"><?php echo $comment; ?></textarea>
                  </div>
              </div>
              <!------- End : input group ------>
              
              <!------- start : input group ------>              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="return_action">Return Action</label>
                  <div class="col-sm-10">
                    <select name="return_action_id" id="return_action_id" class="form-control">
                    <?php
						foreach($actions as $return_action)
						{
						?>
                        <option value="<?php echo $return_action['return_action_id']; ?>"><?php echo $return_action['return_action_name']; ?></option>
                        <?php
						}
					?>                     
                    </select>
                     <script>
					  $("#return_action_id").val(<?=isset($return_action_id)?$return_action_id:''?>);
					</script>
                  </div>
              </div>
              <!------- End : input group ------>
              
              <!------- start : input group ------>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="return_status_id">Return Status</label>
                  <div class="col-sm-10">
                    <select name="return_status_id" id="return_status_id" class="form-control">
                      <?php
					  	foreach($status as $return_status)
						{
							?>
                            <option value="<?php echo $return_status['return_status_id']; ?>"> <?php echo $return_status['return_status_name']; ?></option>
                            <?php
						}
					  ?>                     
                    </select>
                    <script>
					  $("#return_status_id").val(<?=isset($return_status_id)?$return_status_id:''?>);
					</script>
                  </div>
              </div>
              <!------- End : input group ------>
              
            
            </div>
            <!-- End : box-body -->
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
<script type="text/javascript">
	
	
	//Date picker
    $('#date_ordered').datepicker({
      todayHighlight:true,
      autoclose: true
    });
	
		
	// Product Name AutoComplate	
	$('input[name=\'product\']').autocomplete({		
		'source': function(request, response) {			
			console.log(request);
			$.ajax({
				type:'POST',
				url: "<?php echo base_url('catalog/product/autocomplete/'); ?>",				
				data : {'product':request},
				dataType: 'json',			
				success: function(json) {
					response($.map(json, function(item) {
						return {
							label: item['product_name'],
							value: item['product_id'],
							model: item['product_model']						
						}						
					}));
				}				
			});
		},
		'select': function(item) {
			$('input[name=\'product\']').val(item['label']);
			$('input[name=\'product_id\']').val(item['value']);
			$('input[name=\'model\']').val(item['model']);					
		}
	});	
	
	// Customer Name AutoComplate	
	$('input[name=\'customer\']').autocomplete({		
		'source': function(request, response) {			
			console.log(request);
			$.ajax({
				type:'POST',
				url: "<?php echo base_url('customers/customer/autocomplete/'); ?>",				
				data : {'filter_name':request},
				dataType: 'json',			
				success: function(json) {
					response($.map(json, function(item) {
						return {
							label: item['firstname']+' '+item['lastname'],
							value: item['customer_id'],
							firstname: item['firstname'],
							lastname: item['lastname'],
							email: item['email'],	
							telephone: item['telephone'],				
						}						
					}));
				}				
			});
		},
		'select': function(item) {
			$('input[name=\'customer\']').val(item['label']);
			$('input[name=\'customer_id\']').val(item['value']);
			$('input[name=\'firstname\']').val(item['firstname']);
			$('input[name=\'lastname\']').val(item['lastname']);
			$('input[name=\'email\']').val(item['email']);
			$('input[name=\'telephone\']').val(item['telephone']);					
		}
	});	
	
</script>