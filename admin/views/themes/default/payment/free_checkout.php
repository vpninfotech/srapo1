<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Payment Methods </h1>
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
        </ul>
        <div class="pull-right">
            <button class="btn btn-primary" type="submit" value="save" name="form-free-checkout" form="form-free-checkout"><i class="fa fa-save"></i></button>
            <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
        </div>
    </section>
    <!------------------ End Content Header (Page header) ---------------------> 
    <!-------------------------- Main content ------------------------------- -->
    <section class="content">
        <?php if (isset($error) && $error !== ""): ?>

            <div class="alert alert-danger alert-bold-border">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>

                <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error; ?>

            </div>

        <?php endif; ?>
        <?php if (isset($success) && $success !== ""): ?>

            <div class="alert alert-success alert-bold-border">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>

                <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success; ?>

            </div>

        <?php endif; ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header">
                        <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h2>
                    </div>
                    <div class="box-body"> 

                        <form class="form-horizontal" action="<?php echo $action ?>" method="post" name="form-free-checkout" id="form-free-checkout">
                    
		  
		   <div class="form-group">
            <label class="col-sm-2 control-label" for="input-completed_status">Order Status</label>
            <div class="col-sm-10">
              <select name="free_checkout_order_status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $free_checkout_order_status) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['order_status_name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['order_status_name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
		  
		    <!------- Start : input group ------>
                            <div class="form-group">
                                <label for="country" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="(Auto Complete)">Country</span></label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" id="filter_name" name="free_checkout_payment_country_id" class="form-control hidden-print" placeholder="Countries">
                                    <div id="payment-country" class="well well-sm" style="height: 150px; overflow: auto; margin-bottom: 0px;">
<?php foreach ($free_checkout_payment_country_id as $payment_country) { ?>
                                            <div id="payment-country<?php echo $payment_country['country_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $payment_country['country_name']; ?>
                                                <input type="hidden" name="free_checkout_payment_country_id[]" value="<?php echo $payment_country['country_id']; ?>" />
                                            </div>
<?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!------- End : input group ------>
		  
		   <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
			<select name="free_checkout_status" class="form-control">
                <?php if ($free_checkout_status) { ?>
                <option value="1" selected="selected">Enabled</option>
                <option value="0">Disabled</option>
                <?php } else { ?>
                <option value="1">Enabled</option>
                <option value="0" selected="selected">Disabled</option>
                <?php } ?>
            </select>
            </div>
          </div>
		  
		   <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort_order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">
              <input type="text" name="free_checkout_sort_order" value="<?php echo $free_checkout_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort_order" class="form-control" />
            </div>
          </div>
      </form>
                    </div>
                </div>
            </div>
         </div>
    </section>
  </div>
<!------------------- End content-wrapper ---------------------------->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/js/common.js"></script>
<script>
 $('input[name=\'free_checkout_payment_country_id\']').autocomplete({
    'source': function (request, response) {
        $.ajax({
            url: "<?php echo base_url('payment/Free_checkout/autocomplete/') ?>",
            dataType: 'json',
            type: 'POST',
            data: {'payment_country': request},
            success: function (json) {
                response($.map(json, function (item) {
                    return {
                        label: item['country_name'],
                        value: item['country_id']
                    }
                }));
            }
        });
    },
    'select': function (item) {
        $('input[name=\'free_checkout_payment_country_id\']').val('');
        $('#payment_country' + item['value']).remove();

        $('#payment-country').append('<div id="payment_country' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="free_checkout_payment_country_id[]" value="' + item['value'] + '" /></div>');
    }
});

$('#payment-country').delegate('.fa-minus-circle', 'click', function () {
    $(this).parent().remove();
});

</script>
