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
            <button class="btn btn-primary" type="submit" value="save" name="payment_settings_save" form="form-payment-settings"><i class="fa fa-save"></i></button>
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

                        <form class="form-horizontal" action="<?php echo $action ?>" method="post" name="payment_settings_form" id="form-payment-settings">
                        
         <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-status" data-toggle="tab"><?php echo $tab_order_status; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="entry-email"><?php echo $entry_email; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="pp_standard_email" value="<?php echo $pp_standard_email; ?>" placeholder="<?php echo $entry_email; ?>" id="entry-email" class="form-control"/>
                  <?php if ($error_email) { ?>
                  <div class="text-danger"><?php echo $error_email; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-live-demo"><span data-toggle="tooltip" title="<?php echo $help_test; ?>"><?php echo $entry_test; ?></span></label>
                <div class="col-sm-10">
                  <select name="pp_standard_test" id="input-live-demo" class="form-control">
                    <?php if ($pp_standard_test) { ?>
                    <option value="1" selected="selected">Yes</option>
                    <option value="0">No</option>
                    <?php } else { ?>
                    <option value="1">Yes</option>
                    <option value="0" selected="selected">No</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-debug"><span data-toggle="tooltip" title="<?php echo $help_debug; ?>"><?php echo $entry_debug; ?></span></label>
                <div class="col-sm-10">
                  <select name="pp_standard_debug" id="input-debug" class="form-control">
                    <?php if ($pp_standard_debug) { ?>
                    <option value="1" selected="selected">Yes</option>
                    <option value="0">No</option>
                    <?php } else { ?>
                    <option value="1">Yes</option>
                    <option value="0" selected="selected">No</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-transaction"><?php echo $entry_transaction; ?></label>
                <div class="col-sm-10">
                  <select name="pp_standard_transaction" id="input-transaction" class="form-control">
                    <?php if (!$pp_standard_transaction) { ?>
                    <option value="0" selected="selected"><?php echo $text_authorization; ?></option>
                    <?php } else { ?>
                    <option value="0"><?php echo $text_authorization; ?></option>
                    <?php } ?>
                    <?php if ($pp_standard_transaction) { ?>
                    <option value="1" selected="selected"><?php echo $text_sale; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_sale; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="<?php echo $help_total; ?>"><?php echo $entry_total; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="pp_standard_total" value="<?php echo $pp_standard_total; ?>" placeholder="<?php echo $entry_total; ?>" id="input-total" class="form-control"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="pp_standard_sort_order" value="<?php echo $pp_standard_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control"/>
                </div>
              </div>
              <!------- Start : input group ------>
                            <div class="form-group">
                                <label for="country" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="(Auto Complete)">Country</span></label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" id="filter_name" name="pp_standard_payment_country_id" class="form-control hidden-print" placeholder="Countries">
                                    <div id="payment-country" class="well well-sm" style="height: 150px; overflow: auto; margin-bottom: 0px;">
<?php foreach ($pp_standard_payment_country_id as $payment_country) { ?>
                                            <div id="payment-country<?php echo $payment_country['country_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $payment_country['country_name']; ?>
                                                <input type="hidden" name="pp_standard_payment_country_id[]" value="<?php echo $payment_country['country_id']; ?>" />
                                            </div>
<?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!------- End : input group ------> 
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="pp_standard_status" id="input-status" class="form-control">
                    <?php if ($pp_standard_status) { ?>
                    <option value="1" selected="selected">Enabled</option>
                    <option value="0">Disabled</option>
                    <?php } else { ?>
                    <option value="1">Enabled</option>
                    <option value="0" selected="selected">Disabled</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-status">
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_canceled_reversal_status; ?></label>
                <div class="col-sm-10">
                  <select name="pp_standard_canceled_reversal_status_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $pp_standard_canceled_reversal_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_completed_status; ?></label>
                <div class="col-sm-10">
                  <select name="pp_standard_completed_status_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $pp_standard_completed_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_denied_status; ?></label>
                <div class="col-sm-10">
                  <select name="pp_standard_denied_status_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $pp_standard_denied_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_expired_status; ?></label>
                <div class="col-sm-10">
                  <select name="pp_standard_expired_status_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $pp_standard_expired_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_failed_status; ?></label>
                <div class="col-sm-10">
                  <select name="pp_standard_failed_status_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $pp_standard_failed_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_pending_status; ?></label>
                <div class="col-sm-10">
                  <select name="pp_standard_pending_status_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $pp_standard_pending_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_processed_status; ?></label>
                <div class="col-sm-10">
                  <select name="pp_standard_processed_status_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $pp_standard_processed_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_refunded_status; ?></label>
                <div class="col-sm-10">
                  <select name="pp_standard_refunded_status_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $pp_standard_refunded_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_reversed_status; ?></label>
                <div class="col-sm-10">
                  <select name="pp_standard_reversed_status_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $pp_standard_reversed_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_voided_status; ?></label>
                <div class="col-sm-10">
                  <select name="pp_standard_voided_status_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $pp_standard_voided_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['order_status_name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
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
 $('input[name=\'pp_standard_payment_country_id\']').autocomplete({
    'source': function (request, response) {
        $.ajax({
            url: "<?php echo base_url('payment/pp_standard/autocomplete/') ?>",
            dataType: 'json',
            type: 'POST',
            data: {'pp_standard_country': request},
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
        $('input[name=\'pp_standard_payment_country_id\']').val('');
        $('#payment_country' + item['value']).remove();

        $('#payment-country').append('<div id="payment_country' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="pp_standard_payment_country_id[]" value="' + item['value'] + '" /></div>');
    }
});

$('#payment-country').delegate('.fa-minus-circle', 'click', function () {
    $(this).parent().remove();
});

</script>
