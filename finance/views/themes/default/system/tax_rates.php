<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>
  <link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/form-editable/css/bootstrap-editable.css" rel="stylesheet" />
  <script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/form-editable/js/bootstrap-editable.min.js"></script>
  
  <!--tags input css and js and intialize in footer-->
  <!--<link href="plugins/tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
  <script type="text/javascript" src="plugins/tagsinput/bootstrap-tagsinput.min.js"></script>-->
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
    <section class="content-header">
      <h1> Tax Rates </h1>
       <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
      	<button class="btn btn-primary" type="submit" value="save" name="form-tax_rate" form="form-tax_rate"><i class="fa fa-save"></i></button>
         <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
    </section>
    <!------------------ End Content Header (Page header) ---------------------> 
    <!-------------------------- Main content ------------------------------- -->
    <section class="content">
    <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="form-tax_rate" id="form-tax_rate">
 
  <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
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
          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h2>
            </div>
            <div class="box-body">                            
              <input type="hidden" name="tax_rate_id" value="<?php echo $tax_rate_id; ?>" />
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('tax_name')!==""){echo "has-error";} ?>">
                <label for="country_name" class="col-sm-3 col-md-2 control-label">Tax Name</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="tax_name" id="tax_name" class="form-control" placeholder="Tax Name" value="<?php echo $tax_name; ?>">
                   <?php echo form_error('tax_name','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('tax_rate')!==""){echo "has-error";} ?>">
                <label for="iso_code" class="col-sm-3 col-md-2 control-label">Tax Rate</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="tax_rate" id="tax_rate" class="form-control" placeholder="Tax Rate" value="<?php echo $tax_rate; ?>">
                    <?php echo form_error('tax_rate','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
               
              <!------- start : Select group ------>
              <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label" for="type">Type</label>
                  <div class="col-sm-9 col-md-10">
                    <select name="type" id="type" class="form-control">
                        <?php if ($type == 'P') { ?>
                        <option value="P" selected="selected">Percentage</option>
                        <?php } else { ?>
                        <option value="P">Percentage</option>
                        <?php } ?>
                        <?php if ($type == 'F') { ?>
                        <option value="F" selected="selected">Fixed Amount</option>
                        <?php } else { ?>
                        <option value="F">Fixed Amount</option>
                        <?php } ?>
                    </select>
                    
                  </div>                  
              </div>
              <!------- End : Select group ------> 
                            
               <!------- start : Select group ------>
               <!--<div class="form-group">
                <label class="col-sm-3 col-md-2 control-label" for="customer_group">Customer Group
</label>
                  <div class="col-sm-9 col-md-10">
                      <input type="checkbox" name="customer_group" onclick="checkAddress(this)" id="customer_group" value="<?php echo $customer_group; ?>" <?php if($customer_group==1) echo 'checked'; ?> /> Default                 
                      <script type="text/javascript">
                            function checkAddress(checkbox)
                            {
                                if (checkbox.checked)
                                {
                                    $("#customer_group").val("1");
                                }
                                else
                                {
                                    $("#customer_group").val("0");
                                }
                            }
                      </script>
                  </div>
              </div>-->
              <!------- End : Select group ------>
              
              
              <!------- start : Select group ------>
              <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label" for="country">Country</label>
                  <div class="col-sm-9 col-md-10">
                    <select name="country" id="country" class="form-control">
                        <?php 
						if (isset($country_list)) { 
							foreach($country_list as $country)
							{
							?>
							<option value="<?php echo $country['country_id']; ?>" if()><?php echo $country['country_name']; ?></option>
							<?php
							}
						} 
						?>
                    </select>
                   <script>
                       $("#country").val(<?=isset($country_id)?$country_id:''?>);
                    </script> 
                  </div>                  
              </div>
              <!------- End : Select group ------>
              
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
              
            
            </div>
            <!-- End : box-body -->
          </div>
        </div>
     </div>
     </form>
    </section>
    <!----------------------- Main content -------------------------------> 
  </div>
  <!------------------- End content-wrapper ---------------------------->
 
<script type="text/javascript">
	//Initialize Select2 Elements
    $(".select2").select2();
	
	//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
</script>


