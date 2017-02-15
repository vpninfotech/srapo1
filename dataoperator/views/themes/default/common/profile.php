<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Profile </h1>
    <ul class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul>
    <div class="pull-right">
      <button class="btn btn-primary" type="submit" value="save" name="users_save" form="form-users"><i class="fa fa-save"></i></button>
   </section>
  <!------------------ End Content Header (Page header) ---------------------> 
  <!-------------------------- Main content ------------------------------- -->
  <section class="content">
    <?php if(isset($error) && $error!==""): ?>
    <div class="col-xs-12">
      <div class="alert alert-danger alert-bold-border">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
        <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error;?> </div>
    </div>
    <?php endif; ?>
    <?php if(isset($success) && $success!==""): ?>
    <div class="col-xs-12">
      <div class="alert alert-success alert-bold-border">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
        <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success;?> </div>
    </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-default">
          <div class="box-header">
            <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h2>
          </div>
          <div class="box-body">
            <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="form-users" id="form-users">
              <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>" />
              <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
               
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('firstname')!==""){echo "has-error";} ?>">
                <label for="firstname" class="col-sm-3 col-md-2 control-label">First Name</label>
                <div class="col-sm-9 col-md-10">
                  <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" value="<?php echo $firstname; ?>">
                  <?php echo form_error('firstname','<div class="text-danger">', '</div>'); ?> </div>
              </div>
              <!-- End : input Group --> 
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('middlename')!==""){echo "has-error";} ?>">
                <label for="middlename" class="col-sm-3 col-md-2 control-label">Middle Name</label>
                <div class="col-sm-9 col-md-10">
                  <input type="text" name="middlename" id="firstname" class="form-control" placeholder="Middle Name" value="<?php echo $middlename; ?>">
                  <?php echo form_error('middlename','<div class="text-danger">', '</div>'); ?> </div>
              </div>
              <!-- End : input Group --> 
              
              <!------- start : input group ------>
              <div class="form-group required <?php if(form_error('lastname')!==""){echo "has-error";} ?>">
                <label for="lastname" class="col-sm-3 col-md-2 control-label">Last Name</label>
                <div class="col-sm-9 col-md-10">
                  <input type="text" name="lastname" id="last_name" class="form-control" placeholder="Last Name" value="<?php echo $lastname; ?>">
                  <?php echo form_error('lastname','<div class="text-danger">', '</div>'); ?> </div>
              </div>
              <!------- End : input group ------> 
              
              <!------- start : input group ------>
              <div class="form-group required <?php if(form_error('email')!==""){echo "has-error";} ?>">
                <label for="email" class="col-sm-3 col-md-2 control-label">Email</label>
                <div class="col-sm-9 col-md-10">
                  <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" readonly="readonly">
                  <?php echo form_error('email','<div class="text-danger">', '</div>'); ?> </div>
              </div>
              <!------- end : input group ------> 
              
              <!------- start : input group ------>
              <div class="form-group required <?php if(form_error('telephone')!==""){echo "has-error";} ?>">
                <label for="telephone" class="col-sm-3 col-md-2 control-label">Telephone</label>
                <div class="col-sm-9 col-md-10">
                  <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Telephone" value="<?php echo $telephone; ?>" autocomplete="off">
                  <?php echo form_error('telephone','<div class="text-danger">', '</div>'); ?> </div>
              </div>
              <!------- end : input group ------> 
              
              <!------- start : image group ------>
              <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label" for="image">Image</label>
                <div class="col-sm-4 col-md-4"> <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $config_image; ?>" id="input-image" />
                </div>
                <div class="clearfix"></div>
              </div>
              <!------- End : image group ------> 
              
              <!------- start : input group ------>
              <div class="form-group required <?php if(form_error('password')!=="" ){echo "has-error";} ?>">
                <label for="password" class="col-sm-3 col-md-2 control-label">Password</label>
                <div class="col-sm-9 col-md-10">
                  <input type="password" class="form-control" name="password" id="pwd" placeholder="Password" value="<?php echo $password; ?>">
                  <?php echo form_error('password','<div class="text-danger">', '</div>'); ?> </div>
              </div>
              <!------- end : input group ------> 
              
              <!------- start : input group ------>
              <div class="form-group required <?php if(form_error('confirm_pwd')!=="" ){echo "has-error";} ?>">
                <label for="confirm_pwd" class="col-sm-3 col-md-2 control-label">Confirm Password</label>
                <div class="col-sm-9 col-md-10 store-checkbox">
                  <input type="password" name="confirm_pwd" id="c_password" class="form-control" placeholder="Confirm Password" value="<?php echo $confirm_pwd ?>">
                  <?php echo form_error('confirm_pwd','<div class="text-danger">', '</div>'); ?> </div>
              </div>
              <!------- End : input group ------> 
              
              
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

<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js"> 		</script> 
<script>/*$("textarea").tagsinput('items')*/</script> 
<script type="text/javascript">
	
	
	
/* End : image preview script For Image-1 tab*/
var baseurl = "<?php print base_url(); ?>"; 	


</script> 
