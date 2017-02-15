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
</style>
<div class="col-sm-12">
     <form name="profileForm" id="profileForm" method="post" action="<?php echo $form_action; ?>">
     <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" />            
    <h4 class="account-title">Your Personal Details</h4>
    <br>
    <div class="form-group required <?php if (form_error('firstname') !== "") { echo "has-error";  } ?>">
        <label class="col-sm-2 control-label" for="firstname">First Name</label>
        <div class="col-sm-10 form-group">
            <input id="firstname" class="form-control" name="firstname" placeholder="First Name" type="text" value="<?php echo $firstname; ?>">
            <?php echo form_error('firstname', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>
    
    <div class="form-group required <?php if (form_error('lastname') !== "") { echo "has-error";  } ?>">
        <label class="col-sm-2 control-label" for="last_name">Last Name </label>
        <div class="col-sm-10 form-group">
            <input id="last_name" class="form-control" name="lastname" placeholder="Last Name" type="text" value="<?php echo $lastname; ?>">
            <?php echo form_error('lastname', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>
    
    <div class="form-group required <?php if (form_error('email') !== "") { echo "has-error";  } ?>">
        <label class="col-sm-2 control-label" for="email">Email </label>
        <div class="col-sm-10 form-group">
            <input id="email" class="form-control" name="email" placeholder="Email" type="text" value="<?php echo $email; ?>">
            <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>
    
    <div class="form-group required <?php if (form_error('telephone') !== "") { echo "has-error";  } ?>">
        <label class="col-sm-2 control-label" for="telephone">Telephone</label>
        <div class="col-sm-10 form-group">
            <input id="telephone" class="form-control" name="telephone" placeholder="Telephone" type="text" value="<?php echo $telephone; ?>">
            <?php echo form_error('telephone', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>
    
    <!--<div class="form-group">
        <label class="col-sm-2 control-label" for="fax">Fax</label>
        <div class="col-sm-10">
            <input id="fax" class="form-control form-group" name="fax" placeholder="Fax" type="text">
        </div>
    </div>--> 

    
    <div class="buttons">
        <div class="pull-left">
            <a class="btn btn-primary button btn-continue" href="<?php echo site_url('account/account'); ?>">Back</a>
        </div>
        <div class="pull-right">
            <input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary button btn-continue" value="Save" />
            <!--<a class="btn btn-primary button btn-continue" href="#">Continue</a>-->
        </div>
    </div>
     </form>
</div>