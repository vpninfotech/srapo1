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
    <form name="addressForm" id="addressForm" method="post" action="<?php echo $form_action; ?>">
        <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $this->session->userdata('customer_id'); ?>" />
        <input type="hidden" name="address_id" id="address_id" value="<?php echo $address_id; ?>" />
    <h4 class="account-title"><?php echo $text_form; ?></h4>
    <br>
    <div class="form-group required <?php if (form_error('firstname') !== "") {
    echo "has-error";
} ?>">
        <label class="col-sm-2 control-label" for="first_name">First Name </label>
        <div class="col-sm-10 form-group">
            <input id="first_name" class="form-control" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>" type="text">
<?php echo form_error('firstname', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>

    <div class="form-group required <?php if (form_error('lastname') !== "") {
    echo "has-error";
} ?>">
        <label class="col-sm-2 control-label" for="last_name">Last Name </label>
        <div class="col-sm-10 form-group">
            <input id="last_name" class="form-control" name="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>" type="text">
<?php echo form_error('lastname', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="company">Company </label>
        <div class="col-sm-10 form-group">
            <input id="company" class="form-control" name="company" placeholder="Company" value="<?php echo $company; ?>" type="text">             
        </div>
    </div>

    <div class="form-group required <?php if (form_error('address_1') !== "") {
    echo "has-error";
} ?>">
        <label class="col-sm-2 control-label" for="add1">Address 1 </label>
        <div class="col-sm-10 form-group">
            <input id="add1" class="form-control" name="address_1" placeholder="Address 1" value="<?php echo $address_1; ?>" type="text">
<?php echo form_error('add1', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="add2">Address 2 </label>
        <div class="col-sm-10 form-group">
            <input id="add2" class="form-control" name="address_2" placeholder="Address 2" value="<?php echo $address_2; ?>" type="text">
        </div>
    </div>

    <div class="form-group required <?php if (form_error('city') !== "") {
    echo "has-error";
} ?>">
        <label class="col-sm-2 control-label" for="city">City</label>
        <div class="col-sm-10 form-group">
            <input id="city" class="form-control" name="city" placeholder="City" value="<?php echo $city; ?>" type="text">
            <?php echo form_error('city', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>

    <div class="form-group required <?php if (form_error('postcode') !== "") {
                echo "has-error";
            } ?>">
        <label class="col-sm-2 control-label" for="postcode">Post Code</label>
        <div class="col-sm-10 form-group">
            <input id="postcode" class="form-control" name="postcode" placeholder="postcode" value="<?php echo $postcode; ?>" type="text">
                <?php echo form_error('postcode', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>

    <div class="form-group required <?php if (form_error('country_id') !== "") {
                    echo "has-error";
                } ?>">
        <label class="col-sm-2 control-label" for="country">Country</label>
        <div class="col-sm-10 form-group">
            <select id="input-country" class="form-control custom-select" name="country_id">
                <option value=""> Please Select </option>
<?php foreach ($countries as $country) { ?>
    <?php if ($country['country_id'] == $country_id) { ?>
                        <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['country_name']; ?></option>
    <?php } else { ?>
                        <option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
                <?php } ?>
            <?php } ?>
            </select>
<?php echo form_error('country_id', '<div class="text-danger">', '</div>'); ?>
        </div>
        <div class="clear-fix"></div>
    </div>

    <div class="form-group required <?php if (form_error('state_id') !== "") {
    echo "has-error";
} ?>">
        <label class="col-sm-2 control-label" for="state">Region / State</label>
        <div class="col-sm-10 form-group">
            <select id="input-state" class="form-control custom-select" name="state_id">
            </select>
            <?php echo form_error('state_id', '<div class="text-danger">', '</div>'); ?>
        </div>
        <div class="clear-fix"></div>
    </div> 

    <div class="form-group">
        <label class="col-sm-2 control-label label-block radio-custom" for="default_address">Default Address</label>
        <div class="col-sm-10  label-block">
            <?php if ($default) { ?>
                <label class="radio-inline label-block">
                    <input name="default_address" value="1" class="form-group" checked="checked" type="radio">Yes
                </label>
                <label class="radio-inline label-block">
                    <input name="default_address" value="0" class="form-group" type="radio">No
                </label>
<?php } else { ?>
                <label class="radio-inline label-block">
                    <input name="default_address" value="1" class="form-group" type="radio">Yes
                </label>
                <label class="radio-inline label-block">
                    <input name="default_address" value="0" class="form-group" checked="checked"  type="radio">No
                </label>
<?php } ?>
            </label>
        </div>
    </div>
    <div class="clear-fix"></div>
    <div class="buttons">
        <div class="pull-left">
            <a class="btn btn-primary button btn-continue" href="<?php echo $cancel ?>">Back</a>
        </div>
        <div class="pull-right">
            <input type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-primary button btn-continue" value="Save" />                            	
        </div>
    </div>
</form>
</div>

<script type="text/javascript">
    $('select[name=\'country_id\']').on('change', function () {
//alert(element.value);
//alert(index);


        $.ajax({
            url: "<?php echo base_url('account/address_book/get_zone_by_country_id') ?>",
            dataType: 'json',
            type: 'post',
            data: {'country_id': this.value},
            beforeSend: function () {
                $('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
            },
            complete: function () {
                $('.fa-spin').remove();
            },
            success: function (json) {
                html = '<option value=""> ---Please Select--- </option>';

                if (json['zone'] && json['zone'] != '') {
                    for (i = 0; i < json['zone'].length; i++) {
                        html += '<option value="' + json['zone'][i]['state_id'] + '"';

                        if (json['zone'][i]['state_id'] == '<?php echo $state_id; ?>') {
                            html += ' selected="selected"';
                        }

                        html += '>' + json['zone'][i]['state_name'] + '</option>';
                    }
                } else {
                    html += '<option value="0" selected="selected"> ---None--- </option>';

                }

                $('select[name=\'state_id\']').html(html);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }

        });
    });
    $('select[name=\'country_id\']').trigger('change');
</script>