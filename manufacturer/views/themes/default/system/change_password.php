<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper"> 
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Change Password </h1>
    <ul class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul>
    <div class="pull-right">
      <button class="btn btn-primary" type="submit" value="save" name="change_password_save" form="change_password_form"><i class="fa fa-save"></i></button>
       
  </section>
  <!-- ---------------- End Content Header (Page header) ------------------- --> 
  <!-------------------------- Main content ------------------------------- -->
  <section class="content">
      <?php if(isset($error) && $error!==""): ?>
     
        <div class="alert alert-danger alert-bold-border">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
          <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error;?> </div>
      
      <?php endif; ?>
      <?php if(isset($success) && $success!==""): ?>
      
        <div class="alert alert-success alert-bold-border">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
          <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success;?> </div>
      
      <?php endif; ?>
    <div class="row">
      
      <div class="col-xs-12">
        <div class="box box-default">
          <div class="box-header">
            <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> Change Password</h2>
          </div>
          <div class="box-body">
            <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="change_password_form" id="change_password_form">
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('old_password')!==""){echo "has-error";} ?>">
                <label for="old_password" class="col-sm-3 col-md-2 control-label">Old Password</label>
                <div class="col-sm-9 col-md-10">
                  <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Old Password" value="<?php echo set_value('old_password'); ?>">
                  <?php echo form_error('old_password','<div class="text-danger">', '</div>'); ?> </div>
              </div>
              <!-- End : input Group --> 
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('new_password')!==""){echo "has-error";} ?>">
                <label for="new_password" class="col-sm-3 col-md-2 control-label">New Password</label>
                <div class="col-sm-9 col-md-10">
                  <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" value="<?php echo set_value('new_password'); ?>">
                  <?php echo form_error('new_password','<div class="text-danger">', '</div>'); ?> </div>
              </div>
              <!-- End : input Group --> 
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('confirm_password')!==""){echo "has-error";} ?>">
                <label for="confirm_password" class="col-sm-3 col-md-2 control-label">Confirm Password</label>
                <div class="col-sm-9 col-md-10">
                  <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('confirm_password'); ?>">
                  <?php echo form_error('confirm_password','<div class="text-danger">', '</div>'); ?> </div>
              </div>
              <!-- End : input Group -->
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
