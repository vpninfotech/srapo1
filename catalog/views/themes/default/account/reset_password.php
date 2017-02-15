<div class="col-sm-12">

    <h4 class="account-title">Reset Your Password</h4>
    <br>
    <form name="resetForm" id="resetForm" action="<?php echo $form_action; ?>" method="post">
        <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_id; ?>" />
        <input type="hidden" id="code" name="code" value="<?php echo $code; ?>" />
        <div id="forgot_status">
            <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php } ?>
                
            <?php if($this->session->flashdata('warning')) { ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('warning'); ?></div>
            <?php } ?>
            
        </div>
    <div class="form-group required">
        <label class="col-sm-4 control-label" for="password">Enter New Password </label>
        <div class="col-sm-8">
            <input type="password" id="password" class="form-control form-group" name="password" placeholder="Password" >
        </div>
    </div>

    <!--<div class="form-group required">
        <label class="col-sm-4 control-label" for="confirm_password">Confirm Password </label>
        <div class="col-sm-8">
            <input type="password" id="confirm_password" class="form-control form-group" name="confirm_password" placeholder="Confirm Password" >
        </div>
    </div>-->

    <div class="buttons">
        <div class="pull-right">
            <input type="submit" name="resetSubmit" id="resetSubmit" class="btn btn-primary button btn-continue" value="Reset Password" />
        </div>
    </div>
    </form>
</div>

<!-- JAVA SCRIPT -->
<script src="<?php echo CATALOG_PATH; ?>/lib/jquery-validation/jquery.validate.js"></script> <!-- Form Validation --> 
<script src="<?php echo CATALOG_PATH;?>js/jquery-validate.bootstrap-tooltip.js"></script>
<script type="text/javascript">
$(document).ready(function () {
   
$('#resetForm').validate({
     highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        // $(".input-group").after();
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        $(element).closest('.error').remove();
    },
    //ignore:[],
    rules: {
            password: {
                required: true,
            }
            
    },
    messages: {
           password: {
                required: "Please Provide Password."
            }
            
    },
    /*submitHandler: function(form){ 
        $('#resetSubmit').val('Processing...');
         $.post($(form).attr('action'),$(form).serialize(),function(data){
                if(data==1)
                {
                        $('#reset_status').html('<div class="alert alert-success">We have sent you a account activation link on your email. please check it and active your account.</div>');
                        $("#resetForm")[0].reset();
                        $('#resetSubmit').val('Reset Password');
                }
                else if(data==0)
                {
                        $('#reset_status').html('<div class="alert alert-success">We have sent you a account activation link on your email. please check it and active your account.</div>');
                        $("#resetForm")[0].reset();
                        $('#resetSubmit').val('Reset Password');
                }
         });
          return false;
   }*/
}); 
});

</script>