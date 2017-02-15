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
<!--<div class="page-content">-->
<div class="col-sm-12">
    <form name="newsletterForm" id="newsletterForm" method="post" action="<?php $form_action; ?>">
        <h4 class="account-title">Newsletter Subscription</h4>
        <!---<div class="row">
            <div class="col-sm-12">-->
        <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label label-block radio-custom" for="default_address">Subscribe</label>
                    <div class="col-sm-10  label-block">
                        <?php if ($newsletter) { ?>
                            <label class="radio-inline label-block">
                                <input name="newsletter" value="1" class="form-group" checked="checked" type="radio">Yes
                            </label>
                            <label class="radio-inline label-block">
                                <input name="newsletter" value="0" class="form-group" type="radio">No
                            </label>
                        <?php } else { ?>
                            <label class="radio-inline label-block">
                                <input name="newsletter" value="1" class="form-group" type="radio">Yes
                            </label>
                            <label class="radio-inline label-block">
                                <input name="newsletter" value="0" class="form-group" checked="checked"  type="radio">No
                            </label>
                        <?php } ?>
                        </label>
                    </div>
                </div>
                <div class="clear-fix"></div>

                <div class="buttons">
                    <div class="pull-left">
                        <a class="btn btn-primary button btn-continue" href="<?php echo site_url('account/account'); ?>">Back</a>
                    </div>
                    <div class="pull-right">
                        <input type="submit" name="btnSubmit" id="btnSubmit" value="Save" class="btn btn-primary button btn-continue"/>
                        <!--<a class="btn btn-primary button btn-continue" href="#">Continue</a>-->
                    </div>
                </div>

            <!--</div>
        </div>-->
    </form>
</div>
<!--</div>-->
