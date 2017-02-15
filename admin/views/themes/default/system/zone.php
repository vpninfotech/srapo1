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
      <h1> Zones </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
         <button class="btn btn-primary" type="submit" value="save" name="zone_save" form="form-zone"><i class="fa fa-save"></i></button>
         <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
    </section>
    <!------------------ End Content Header (Page header) ---------------------> 
    <!-------------------------- Main content ------------------------------- -->
    <section class="content">
     <?php if(isset($error) && $error!==""): ?>
        
        <div class="alert alert-danger alert-bold-border">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
          
            <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error;?>
          
        </div>
        
        <?php endif; ?>
        <?php if(isset($success) && $success!==""): ?>
          
        <div class="alert alert-success alert-bold-border">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
          
           <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success;?>
          
        </div>
        
        <?php endif; ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i><?php echo $text_form; ?></h2>
            </div>
            <div class="box-body"> 
           
              <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="return_status_form" id="form-zone">
 
  <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
  
  <input type="hidden" name="state_id" id="state_id" value="<?php echo $state_id;?>" />
  
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('zone_name')!==""){echo "has-error";} ?>">
                <label for="zone_name" class="col-sm-3 col-md-2 control-label">Zone Name</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="zone_name" id="zone_name" class="form-control" placeholder="Zone Name" value="<?php echo $zone_name; ?>">
                    <?php echo form_error('zone_name','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group">
                <label for="zone_code" class="col-sm-3 col-md-2 control-label">Zone Code</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="zone_code" id="zone_code" class="form-control" placeholder="Zone Code" value="<?php echo $zone_code; ?>">
                </div>
              </div>
              <!-- End : input Group -->
              <!------- start : input group ------>
              <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label" for="country">Country</label>
                  <div class="col-sm-9 col-md-10">
                    <select name="country_id" id="country_id" class="form-control">
                    <?php 
					foreach($country_name as $countries)
					{ 
					?>
                     
                   <option value="<?php echo $countries['country_id']; ?>"> <?php echo $countries['country_name']; ?> </option>
                    <?php
					}
					?>                     
                    </select>
                     <script>
					  $("#country_id").val(<?php echo $country_id; ?>);
					</script> 
                  </div>
              </div>
              <!------- End : input group ------>
             
              <!------- start : input group ------>
              <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label" for="status">Status</label>
                  <div class="col-sm-9 col-md-10">
                    <select name="status" id="status" class="form-control">
                      <option value="1"> Enabled </option>
                      <option value="0"> Disabled </option>
                    </select>
                    <script>
					  $("#status").val(<?php echo $status; ?>);
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
  
<script type="text/javascript">
	//Initialize Select2 Elements
    $(".select2").select2();
</script>


