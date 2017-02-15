 <link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- Select2 -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
<!-- Select2 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/all.css">
<!-- iCheck 1.0.1 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/icheck.min.js"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
  
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Voucher Themes </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
                <button class="btn btn-primary" type="submit" value="save" name="voucher_themes_save" form="form_voucher_themes"><i class="fa fa-save"></i></button>
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
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i><?php echo $text_form ?></h2>
              
            </div>
            <div class="box-body"> 
                   <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="voucher_themes_form" id="form_voucher_themes">
                <input type="hidden" name="voucher_theme_id" value="<?php echo $voucher_theme_id; ?>" /> 
               
                
                <!-- Start : input Group -->
                <div class="form-group required <?php if(form_error('name')!==""){echo "has-error";} ?>">
                  <label for="name" class="col-sm-3 col-md-2 control-label">Voucher Theme Name</label>
                  <div class="col-sm-9 col-md-10">
                      <input type="text" name="name" id="name" class="form-control" placeholder="Voucher Theme Name" value="<?php echo $name; ?>">
                    <?php echo form_error('name','<div class="text-danger">', '</div>'); ?>
                  </div>
                </div>
                <!-- End : input Group -->
                
                
                <!------- start : image group ------>
              <div class="form-group required <?php if(form_error('image')!==""){echo "has-error";} ?>">
                <label class="col-sm-3 col-md-2 control-label" for="image">Image</label>
                <div class="col-sm-4 col-md-4"> <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $config_image; ?>" id="input-image" />
                  <?php echo form_error('image','<div class="text-danger">', '</div>'); ?>
                </div>
                <div class="clearfix"></div>
              </div>
              <!------- End : image group ------> 
              
                
                
                <!------- End : Select group ------>
                 <?php if($this->session->userdata('role_id')== 1) { ?>
              <!------- start : Select group ------>
              <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label" for="is_deleted">Soft Deleted</label>
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
	//Initializa Summernote
	$('#input-description').summernote({height: 300});
	
	//Initialize Select2 Elements
    $(".select2").select2();
	
	//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
	$('#date_added').datepicker({  
      autoclose: true,
	  format: "yyyy-mm-dd",
	 
    });
</script>
<script type="text/javascript">
		
/* End : image preview script For Image-1 tab*/
var baseurl = "<?php print base_url(); ?>"; 	


</script> 

 

