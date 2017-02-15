<div class="login-box-main">

  <div class="login-logo">
   <b>Admin</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box">

  <div class="login-box-body">
    <p class="login-box-msg">Please Login Your Account</p>
    <div>
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
    <form name="loginform" action="<?php echo $form_action;?>" method="post">
    <input name="redirect" type="hidden" value="<?= $this->uri->uri_string() ?>" />
      <div class="form-group has-feedback <?php if(form_error('email')!==""){echo "has-error";} ?>">
        <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('Email'); ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php echo form_error('email','<div class="text-danger">', '</div>'); ?>
      </div>
      <div class="form-group has-feedback <?php if(form_error('password')!==""){echo "has-error";} ?>">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php echo form_error('password','<div class="text-danger">', '</div>'); ?>
      </div>
      
      <div class="row">
        <div class="col-xs-8">
           
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="Sign In">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
      
    </form>
    <a href="<?php echo $forgot_password;?>">I forgot my password</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</div>