<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper"> 
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Payment Methods </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
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
                  <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i><?php echo $text_edit; ?></h2>
               </div>
               <div class="box-body">
                  <form class="form-horizontal" action="<?php echo $action ?>" method="post" name="payment_settings_form" id="form-payment-settings">
                     <div class="row">
                        <div class="col-sm-3">
                           <ul class="nav nav-pills nav-stacked" id="country">
                            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                           	 
                                                  <?php foreach ($countries as $country) { ?>
                                                        <li><a href="#tab-country<?php echo $country['country_id']; ?>" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$('a[href=\'#tab-country<?php echo $country['country_id']; ?>\']').parent().remove(); $('#tab-country<?php echo $country['country_id']; ?>').remove(); $('#country a:first').tab('show');"></i> <?php echo $country['country_name']; ?></a></li>
                                                 
                                                  <?php } ?>
                              <li>
                                 <input type="text" name="country" value="" placeholder="country" id="input-country" class="form-control" />
                              </li>
                           </ul>
                        </div>
                        <div class="col-sm-9">
                        <div class="tab-content">
                <div class="tab-pane active" id="tab-general">
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-tax-class"><?php echo $entry_tax_class; ?></label>
                    <div class="col-sm-10">
                      <select name="weight_tax_class_id" id="input-tax-class" class="form-control">
                        <option value="0"><?php echo $text_none; ?></option>
                        <?php foreach ($tax_classes as $tax_class) { ?>
                        <?php if ($tax_class['tax_class_id'] == $weight_tax_class_id) { ?>
                        <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                    <div class="col-sm-10">
                      <select name="weight_status" id="input-status" class="form-control">
                        <?php if ($weight_status) { ?>
                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                        <option value="0"><?php echo $text_disabled; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_enabled; ?></option>
                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="weight_sort_order" value="<?php echo $weight_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
                    </div>
                  </div>
                </div>
               <?php $option_row = 0; ?>
                <?php foreach ($countries as $country) { ?>
                <div class="tab-pane" id="tab-country<?php echo $country['country_id']; ?>">
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-rate<?php echo $country['country_id']; ?>"><span data-toggle="tooltip" title="<?php echo $help_rate; ?>"><?php echo $entry_rate; ?></span></label>
                    <div class="col-sm-10">
                      <textarea name="weight_<?php echo $country['country_id']; ?>_rate" rows="5" placeholder="<?php echo $entry_rate; ?>" id="input-rate<?php echo $country['country_id']; ?>" class="form-control"><?php echo ${'weight_' . $country['country_id'] . '_rate'}; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-status<?php echo $country['country_id']; ?>"><?php echo $entry_status; ?></label>
                    <div class="col-sm-10">
                      <select name="weight_<?php echo $country['country_id']; ?>_status" id="input-status<?php echo $country['country_id']; ?>" class="form-control">
                        <?php if (${'weight_' . $country['country_id'] . '_status'}) { ?>
                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                        <option value="0"><?php echo $text_disabled; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_enabled; ?></option>
                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                  <?php $option_row ++; ?>
                <?php } ?>
              <div id="custom"></div>
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
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/js/common.js"></script>
<script type="text/javascript">
//Option



$('input[name=\'country\']').autocomplete({
    'source': function(request, response) {
        $.ajax({
            url: "<?php echo base_url('shipping/weight/autocomplete/') ?>",
            dataType: 'json',
            type: 'POST',
            data: {'country': request},
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
    
    'select': function(item) {
		if($("div#tab-country" + item.value).length != 0)
		{
			alert(item.label + " Already Added");
		}
		else
		{
			
		
		 $('input[name=\'country\']').val('');
		html = '';
		html += '  <div class="tab-pane" id="tab-country' + item.value + '">';
        html += '   <div class="form-group">';
		html += '  <label class="col-sm-2 control-label" for="input-rate' + item.value + '"><span data-toggle="tooltip" title="Example: 5:10.00,7:12.00 Weight:Cost,Weight:Cost, etc..">Rates</span></label>';
		html += '<div class="col-sm-10">';
		html +='<textarea name="weight_' + item.value + '_rate" rows="5" placeholder="Rates" id="input-rate' + item.value + '" class="form-control"></textarea>';
        html += '   </div>';
        html += '   </div>';
		
		
		html += '   <div class="form-group">';
		html += '   <label class="col-sm-2 control-label" for="input-status' + item.value + '">Status</label>';
		html += '    <div class="col-sm-10">';
		html += '    <select name="weight_' + item.value + '_status" id="input-status' + item.value + '" class="form-control">';
		html += '    <option value="1" selected="selected">Enabled</option>';
		html += '    <option value="0">Disabled</option>';
		html += '   </select>';
		html += '   </div>';
		
		
		
		
		
        html += '   </div>';
		html += '  </div>';
		$('#custom').before(html);
		
		$('#country > li:last-child').before('<li><a href="#tab-country' + item.value + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'a[href=\\\'#tab-country' + item.value + '\\\']\').parent().remove(); $(\'#tab-country' + item.value + '\').remove(); $(\'#country a:first\').tab(\'show\')"></i> ' + item['label'] + '</li>');
      
}
	}
});   
</script> 
