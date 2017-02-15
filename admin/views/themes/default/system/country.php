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
      <h1> Countries </h1>
       <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
      	<button class="btn btn-primary" type="submit" value="save" name="country_save" form="form-country"><i class="fa fa-save"></i></button>
         <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
              </div>
    </section>
    <!------------------ End Content Header (Page header) ---------------------> 
    <!-------------------------- Main content ------------------------------- -->
    <section class="content">
    <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="return_status_form" id="form-country">
 
  <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
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
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h2>
            </div>
            <div class="box-body"> 
          
                           
              <input type="hidden" name="country_id" value="<?php echo $country_id; ?>" />
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('country_name')!==""){echo "has-error";} ?>">
                <label for="country_name" class="col-sm-3 col-md-2 control-label">Country Name</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="country_name" id="country_name" class="form-control" placeholder="Country Name" value="<?php echo $country_name;//echo set_value('country_name'); ?>">
                    <?php echo form_error('country_name','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('iso_code_2')!==""){echo "has-error";} ?>">
                <label for="iso_code" class="col-sm-3 col-md-2 control-label">ISO Code(2)</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="iso_code_2" id="iso_code" class="form-control" placeholder="ISO Code(2)" value="<?php echo $iso_code_2; ?>">
                    <?php echo form_error('iso_code_2','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->

              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('iso_code')!==""){echo "has-error";} ?>">
                <label for="iso_code" class="col-sm-3 col-md-2 control-label">ISO Code(3)</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="iso_code" id="iso_code" class="form-control" placeholder="ISO Code" value="<?php echo $iso_code; ?>">
                    <?php echo form_error('iso_code','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
                        
              
              <!------- start : Select group ------>
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


