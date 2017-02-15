 <div class="login-box-main">
  <div class="login-logo">
   <b>Operator</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box">
  <div class="login-box-body">
    <p class="login-box-msg">Reset Your Password</p>
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
    <form name="reset_pwdform" action="<?php echo $form_action;?>" method="post">
    <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
      <div class="form-group has-feedback <?php if(form_error('pwd')!==""){echo "has-error";} ?>">
        <input type="password" name="pwd" class="form-control" placeholder="Password" value="<?php echo set_value('pwd');?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php echo form_error('pwd','<div class="text-danger">', '</div>'); ?>
      </div>
      <div class="form-group has-feedback <?php if(form_error('cnfpwd')!==""){echo "has-error";} ?>">
        <input type="password" name="cnfpwd" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('cnfpwd');?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php echo form_error('cnfpwd','<div class="text-danger">', '</div>'); ?>
      </div>
      
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="reset" value="reset" >Reset</button>
        </div>
        <!-- /.col -->
      </div>
      
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</div>