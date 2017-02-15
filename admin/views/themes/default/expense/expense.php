<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
  <!-- Select2 -->
  <script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>
  <!-- bootstrap datepicker -->
  <script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">    
  	 <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="expense_form" id="form-expense" enctype="multipart/form-data">            
        <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
       	<input type="hidden" name="expense_id" value="<?php echo $expense_id; ?>" /> 
              
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Expense </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
         <button class="btn btn-primary" type="submit" value="save" name="expense_save" form="form-expense"><i class="fa fa-save"></i></button>
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
              <!-- <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="expense_form" id="form-expense" enctype="multipart/form-data">            
             	<input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
               <input type="hidden" name="expense_id" value="<?php echo $expense_id; ?>" /> 
                    -->
               <div class="row">
                <div class="col-md-6">
               	  <div class="form-group col-md-12 required <?php if(form_error('user_type')!==""){echo "has-error";} ?>">
                 	<label for="user_type" class="control-label">Select User Type</label>
                    <select class="form-control" name="user_type" id="user_type" data-live-search="true">
                        <option value="">Select User Type</option>
                        <?php
                            foreach ($user_groups as $key => $value) {
								
								echo '<option value="'.$value['role_id'].'">'.$value['role_name'].'</option>';								
                            }
                        ?>                        
                    </select>
                    <?php echo form_error('user_type','<div class="text-danger">', '</div>'); ?>
                   <script type="text/javascript">				
                       $('#user_type').val('<?php if(isset($user_type_id)){ echo $user_type_id;}?>');
                                
                   </script>
                  </div>
                 </div>
                 <div class="col-md-6">
                  <div class="form-group col-md-12 required <?php if(form_error('user_list')!==""){echo "has-error";} ?>">
                    <label for="user_list" class="control-label">User List</label>
                    <select name="user_list" id="edit_user_list" class="form-control" data-live-search="true">
                        <option value="">Select User</option>                        
                    </select>
                    
                    <?php echo form_error('user_list','<div class="text-danger">', '</div>'); ?>
                     
               	  </div> 
                  </div>  
                  </div>
                            
                  
               	 <div class="row">
                <div class="col-md-6">
                  <div class="form-group col-md-12 required <?php if(form_error('expense_date')!==""){echo "has-error";} ?>">
                      <label for="date" class="control-label">Expense Date</label>
                      <input type="text" name="expense_date" class="form-control" id="expense_date" value="<?php echo $expense_date; ?>">
                      <?php echo form_error('expense_date','<div class="text-danger">', '</div>'); ?>
                   </div>
                   </div>
                    <div class="col-md-6">        
                   <div class="form-group col-md-12">
                      <label for="reference" class="control-label">Reference</label>
                      <input type="text" name="reference" value="<?php echo $reference; ?>" class="form-control" id="reference">
                   </div>
                   </div>
                   </div>
                   <div class="row">
                <div class="col-md-6">
                   <div class="form-group col-md-12 required <?php if(form_error('expense_name')!==""){echo "has-error";} ?>">
                      <label for="expense_name" class="control-label">Expence Name</label>
                      <input type="text" name="expense_name" value="<?php echo $expense_name; ?>" class="form-control" id="expense_name">
                      <?php echo form_error('expense_name','<div class="text-danger">', '</div>'); ?>
                   </div>
                   </div>
              
                  <!------- start : Select group ------>  
                 <div class="col-md-6">
                  <div class="form-group col-md-12 required <?php if(form_error('expense_category')!==""){echo "has-error";} ?>">
                    <label for="expense_category" class="control-label">Expence Category</label>
                      
                        <select name="expense_category" id="expense_category" class="form-control">
                    		<option value="">Select Expense Category</option>
							<?php 
							if(isset($expense_categories) || count($expense_categories) > 0)
							{
								foreach($expense_categories as $expense_category)
								{
							?>
                            	<option value="<?php echo $expense_category['expense_category_id']; ?>"><?php echo $expense_category['expense_category_name']; ?></option>
                            <?php
								}
							}
							?>                            
                        </select>
                        <?php echo form_error('expense_category','<div class="text-danger">', '</div>'); ?>
                        <script type="text/javascript">				
                      	 	$('#expense_category').val('<?php if(isset($expense_category_id)){ echo $expense_category_id; }?>');                               
                  		</script>
                                     
                  </div>
                  </div>
                  <!------- End : Select group ------>                 
                   </div>
                   <div class="row">
                <div class="col-md-6"> 
                  <div class="form-group col-md-12 required <?php if(form_error('amount')!==""){echo "has-error";} ?>">
                      <label for="amount" class="control-label">Amount</label>
                      <input name="amount" type="text" id="amount" value="<?php echo $expense_amount; ?>" class="form-control">
                      <?php echo form_error('amount','<div class="text-danger">', '</div>'); ?>
                  </div>
                  </div>
                   <div class="col-md-6"> 
                  <div class="form-group col-md-12">
                   <label for="fileInput" class="control-label">Attachment</label>
                    <input type="file" id="fileInput" name="Attachments" class="filestyle img-select-data">
                     <input id="HAttachments" name="HAttachments" type="hidden" value="<?php if(isset($attachment)){ echo $attachment; } ?>">
                    <br/>
                    <label class="text-muted">Only 5 MB File Size are Allowed </label>
                  </div>
                  </div>
                  </div>
                   <div class="row">
                <div class="col-md-6">
                  <div class="form-group col-md-12">
                    <label for="description" class="control-label">Note</label>
                    <!--<textarea name="description" class="form-control" id="input-description"></textarea>-->
                    <textarea name="description" class="form-control"><?php echo $note;?></textarea>
                  </div>
                  </div>
                  
                  
                
                  <div class="col-md-6">
                 <!-- Note : display disable currency according to "setting" table config --> 
                 <div class="form-group col-md-12">
                      <label for="currency" class="control-label">Currency</label>
                      <input name="currency" type="text" id="currency" value="<?php echo $currency_data['code']; ?>(<?php echo $currency_data['symbol_left']; ?>)" class="form-control" disabled="disabled">   
                      <input type="hidden" name="currency_id"  id="currency_id" value="<?php echo $currency_data['currency_id']; ?>" />  
                      <input type="hidden" name="symbol_left"  id="symbol_left" value="<?php echo $currency_data['symbol_left']; ?>" /> 
                      <input type="hidden" name="decimal_place"  id="decimal_place" value="<?php echo $currency_data['decimal_place']; ?>" />
                      <input type="hidden" name="currency_value"  id="currency_value" value="<?php echo $currency_data['value']; ?>" />
                      <input type="hidden" name="currency_code"  id="currency_code" value="<?php echo $currency_data['code']; ?>" />                                       
                  </div>
                  </div>
                  </div>
                  
                  
                  
                 <div class="row">
                <div class="col-md-6">
                  <!------- start : Select group ------>
                  <div class="form-group col-md-12">
                    <label for="status" class="control-label">Status</label>                      
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
                  </div>
                  <!------- End : Select group ------>
                  
                  
              <?php if($this->session->userdata('finance_role_id')== 3) { ?>
              <!------- start : Select group ------>
               <div class="row">
                <div class="col-md-6">
              <div class="col-md-12 form-group">
                <label for="status" class="control-label">Soft Deleted</label>&nbsp;
                  
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
              </div>
              <!------- End : Select group ------>
              <?php } ?>
              
                      
                  <!--<div class="clearfix"></div>-->
                
              	</div>
              <!--</form>-->
            </div>
            <!-- End : box-body -->
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
	$('#input-description').summernote({height: 150});
	
	//Date picker
   /* $('#expense_date').datepicker({
      autoclose: true
    });*/
	
	//Date picker
	$('#expense_date').datepicker({
	   autoclose: true,
	   format : 'dd-mm-yyyy',
	   todayHighlight:true,
	   pickTime: false
	});

	/////////////////
	$(document).ready(function(){

    	$('#user_type').trigger('change');
		$('#edit_user_list').val('<?php if(isset($user_id)){ echo $user_id;}?>');
	});
	
	jQuery.validator.addMethod('filesize123', function(value, element, param) {
    // param = size (en bytes) 
    // element = element to validate (<input>)
    // value = value of the element (file name)
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
	
	/* Role wise User List fill*/
    $('select[name=\'user_type\']').on('change', function() {
        var role_id = $(this).val();		
         $.ajax({
            url: "<?php echo base_url('support/tickets/getUserListByRoleId');?>",
            type: "post",
            data: {role_id:role_id},
             async : false,
            dataType: 'json',
            success: function (response) {
                var html = '<option value="">Select User</option>';
                if(response)
                {
                    $.each(response, function(key,val) {
                        html += '<option value="'+val.user_id+'">'+val.user_name+'</option>';
                    });     
                }
           $('select[name=\'user_list\']').html(html);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }

    });
  });
  

	 
	//////////////////
	// Name AutoComplate          
	/*$('input[name=\'filter_name\']').autocomplete({
		'source': function(request,response) {
			$.ajax({
				url: "<?php echo base_url('customers/customer/autocomplete/') ?>",
				dataType: 'json',
							type:'POST',
							data : {'filter_name':request},
				success: function(json) {
					response($.map(json, function(item) {
						return {
							label: item['firstname'],
							value: item['customer_id']
						}
					}));
				}
			});
		},
		'select': function(item) {
				$('input[name=\'filter_name\']').val(item['label']);
		}	
	});*/
	
	
</script>