<style>
@media (max-width: 320px) {
    .menu-hidden4 {
        display: none !important;
    } 
}
@media (min-width: 321px) and (max-width: 360px) {
    .menu-hidden4 {
        display: none !important;
    }  
}
@media (min-width: 361px) and (max-width: 480px) {
    .menu-hidden4{
        display: none !important;
    }   
}
@media (min-width: 481px) and (max-width: 600px) {
    .menu-hidden4 {
        display: none !important;
    } 
}
@media (min-width: 601px) and (max-width: 640px) {
    .menu-hidden4 {
        display: none !important;
    } 
}
</style><div class="col-sm-12">
    <form name="changePassword" id="changePassword" method="post" action="<?php echo $form_action; ?>">
    <h4 class="account-title">Your Password</h4>
    <br>
    <div class="form-group required <?php if(form_error('password')!==""){echo "has-error";} ?>">
        <label class="col-sm-3 control-label" for="password">Password </label>
        <div class="col-sm-9 form-group">
            <input id="password" class="form-control" name="password" placeholder="Password" type="password" value="<?php echo $password; ?>">
            <?php echo form_error('password','<div class="text-danger">', '</div>'); ?> 
        </div>
    </div>

    <div class="form-group required <?php if(form_error('confirm_password')!==""){echo "has-error";} ?>">
        <label class="col-sm-3 control-label" for="confirm_password">Confirm Password </label>
        <div class="col-sm-9 form-group">
            <input id="confirm_password" class="form-control" name="confirm_password" placeholder="Confirm Password" type="password" value="<?php echo $confirm_password; ?>">
            <?php echo form_error('confirm_password','<div class="text-danger">', '</div>'); ?>            
        </div>
    </div>

    <div class="buttons">
        <div class="pull-left">
            <a class="btn btn-primary button btn-continue" href="<?php echo site_url('account/account'); ?>">Back</a>
        </div>
        <div class="pull-right">
            <input type="submit" name="btnSubmit" id="btnSubmit" value="Save" class="btn btn-primary button btn-continue" />
            <!--<a class="btn btn-primary button btn-continue" href="#">Save</a>-->
        </div>
    </div>
    </form>
</div>