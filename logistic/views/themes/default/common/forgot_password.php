 <div class="login-box-main">
  <div class="login-logo">
   <b>Logistic</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box">
  <div class="login-box-body">
    <p class="login-box-msg">Enter Email To Get Reset Password Link</p>
	<div>
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
</div>
    

    <form name="forgot_pwdform" action="<?php echo $form_action;?>" method="post">
      <div class="form-group has-feedback <?php if(form_error('email')!==""){echo "has-error";} ?>">
        <input type="text" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php echo form_error('email','<div class="text-danger">', '</div>'); ?>
      </div>
      
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="forgot_password" value="Send me Password Link" >Send me Password Link</button>
        </div>
        <!-- /.col -->
      </div>
      
    </form>
    <a href="<?php echo $login_link;?>">Have an account? Sign in</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</div>