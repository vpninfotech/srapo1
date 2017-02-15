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
</style><!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap timepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/timepicker/bootstrap-timepicker.min.css">
<!-- bootstrap timepicker -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<div class="col-sm-12">
    <!-- page heading-->
        <h2 class="page-heading">
            <span class="page-heading-title2"><?php echo $heading_title; ?></span>
        </h2>
        
        
    <!-- ../page heading-->
    <form name="addressForm" id="addressForm" method="post" action="<?php echo $form_action; ?>">
        <input type="hidden" name="product_id" id="product_id" value="<?php $product_id ?>" />  
    <h4 class="account-title"><?php echo $text_order; ?></h4>
    <br>
    <div class="form-group required <?php if (form_error('firstname') !== "") {
    echo "has-error";
} ?>">
        <label class="col-sm-2 control-label text-right" for="firstname">First Name </label>
        <div class="col-sm-10 form-group">
            <input id="firstname" class="form-control" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>" type="text">
<?php echo form_error('firstname', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>

    <div class="form-group required <?php if (form_error('lastname') !== "") {
    echo "has-error";
} ?>">
        <label class="col-sm-2 control-label text-right" for="lastname">Last Name </label>
        <div class="col-sm-10 form-group">
            <input id="lastname" class="form-control" name="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>" type="text">
<?php echo form_error('lastname', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>
    
    <div class="form-group required <?php if (form_error('email') !== "") {
    echo "has-error";
} ?>">
        <label class="col-sm-2 control-label text-right" for="email">Email </label>
        <div class="col-sm-10 form-group">
            <input id="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>" type="text">
<?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>
    
    <div class="form-group required <?php if (form_error('telephone') !== "") {
    echo "has-error";
} ?>">
        <label class="col-sm-2 control-label text-right" for="telephone">Telephone </label>
        <div class="col-sm-10 form-group">
            <input id="telephone" class="form-control" name="telephone" placeholder="Telephone" value="<?php echo $telephone; ?>" type="text">
<?php echo form_error('telephone', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>
    
    <div class="form-group required <?php if (form_error('order_id') !== "") {
    echo "has-error";
} ?>">
        <label class="col-sm-2 control-label text-right" for="order_id">Order ID </label>
        <div class="col-sm-10 form-group">
            <input id="order_id" class="form-control" name="order_id" placeholder="Order ID" value="<?php echo $order_id; ?>" type="text">
<?php echo form_error('order_id', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label text-right" for="input-date-ordered">Order Date </label>
        <div class="col-sm-10 form-group">
            <div class="input-group date"><input type="text" name="date_ordered" value="<?php echo $date_ordered; ?>" placeholder="Order Date" data-date-format="YYYY-MM-DD" id="input-date-ordered" class="form-control" /><span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>           
        </div>
    </div>
    
    <h4 class="account-title"><?php echo $text_product; ?></h4>
    <br>
    <div class="form-group required <?php if (form_error('product') !== "") {
    echo "has-error";
} ?>">
        <label class="col-sm-2 control-label text-right" for="product">Product Name </label>
        <div class="col-sm-10 form-group">
            <input id="product" class="form-control" name="product" placeholder="Product Name" value="<?php echo $product; ?>" type="text">
<?php echo form_error('product', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>

    <div class="form-group required <?php if (form_error('model') !== "") {
    echo "has-error";
} ?>">
        <label class="col-sm-2 control-label text-right" for="model">Product Code </label>
        <div class="col-sm-10 form-group">
            <input id="model" class="form-control" name="model" placeholder="Product Code" value="<?php echo $model; ?>" type="text">
            <?php echo form_error('model', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label text-right" for="quantity">Quantity</label>
        <div class="col-sm-10 form-group">
            <input id="quantity" class="form-control" name="quantity" placeholder="Quantity" value="<?php echo $quantity; ?>" type="text">            
        </div>
    </div>

    <div class="form-group required <?php if (form_error('return_reason_id') !== "") {
                echo "has-error";
            } ?>">
        <label class="col-sm-2 control-label text-right" for="return_reason_id">Reason for Return</label>
        <div class="col-sm-10 form-group">
        <?php foreach ($return_reasons as $return_reason) { ?>
        <?php if ($return_reason['return_reason_id'] == $return_reason_id) { ?> 
            <div class="radio">
            <label>
                <input type="radio" name="return_reason_id" value="<?php echo $return_reason['return_reason_id']; ?>" checked="checked" /><?php echo $return_reason['return_reason_name']; ?>
            </label>
            </div>
        <?php } else { ?>
            <div class="radio">
            <label>
                <input type="radio" name="return_reason_id" value="<?php echo $return_reason['return_reason_id']; ?>" /><?php echo $return_reason['return_reason_name']; ?>
            </label>
            </div>
        <?php } ?>
        <?php } ?>
        <?php echo form_error('return_reason_id', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>
    
    <div class="form-group required <?php if (form_error('opened') !== "") {
                echo "has-error";
            } ?>">
        <label class="col-sm-2 control-label text-right" for="opened">Product is opened</label>
        <div class="col-sm-10 form-group">
            <label class="radio-inline">
            <?php if ($opened) { ?>
                <input type="radio" name="opened" value="1" checked="checked" />
            <?php } else { ?>
                <input type="radio" name="opened" value="1" />
            <?php } ?>
                Yes
            </label>
            <label class="radio-inline">
            <?php if (!$opened) { ?>
               <input type="radio" name="opened" value="0" checked="checked" />
            <?php } else { ?>
               <input type="radio" name="opened" value="0" />
            <?php } ?>
               No
            </label>
        
        <?php echo form_error('opened', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label text-right" for="comment">Faulty or other details</label>
        <div class="col-sm-10 form-group">
            <textarea name="comment" rows="10" placeholder="Faulty or other details" id="input-comment" class="form-control"><?php echo $comment; ?></textarea>
        </div>
        <div class="clear-fix"></div>
    </div>
    <div class="buttons">
        <div class="pull-left">
            <a class="btn btn-primary button btn-continue" href="<?php echo $back ?>">Back</a>
        </div>
        <div class="pull-right">
            <input type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-primary button btn-continue" value="Submit" />                            	
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
<script type="text/javascript">
$('.date').datepicker({
    todayHighlight:true,
    format:"yyyy-mm-dd",
    autoclose: true,
});
</script>