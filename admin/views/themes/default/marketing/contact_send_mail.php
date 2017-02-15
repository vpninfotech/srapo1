<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>
<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/form-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/form-editable/js/bootstrap-editable.min.js"></script>


<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper" id="content"> 
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Mail </h1>
    <ul class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul>
    <div class="pull-right">
      <button class="btn btn-primary" type="button" value="save" onclick="send('<?php echo base_url('marketing/contact_send_mail/send');?>')" name="button-send" id="button-send"><i class="fa fa-envelope"></i></button>
      <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
  </section>
  <!-- ---------------- End Content Header (Page header) ------------------- --> 
  <!-------------------------- Main content ------------------------------- -->
  <section class="content">
    <div class="row ">
      <div class="col-xs-12 msg"></div>
      <div class="col-xs-12">
        <div class="box box-default">
          <div class="box-header">
            <h2 class="box-title col-sm-6"><i class="fa fa-envelope"></i> Mail</h2>
          </div>
          <div class="box-body">
            <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="form-send-mail" id="form-send-mail">
              <!-- Start : input Group -->
              <div class="form-group <?php if(form_error('old_password')!==""){echo "has-error";} ?>">
                <label for="old_password" class="col-sm-3 col-md-2 control-label">From</label>
                <div class="col-sm-9 col-md-10">
                <label><?php echo $this->common->config('config_email');?></label>
                 </div>
              </div>
              <!-- End : input Group --> 
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-to">To</label>
                <div class="col-sm-10">
                  <select name="to" id="input-to" class="form-control">
                    <option value="newsletter">All Newsletter Subscribers</option>
                    <option value="customer_all">All Customers</option>
                    <option value="manufacturer_all">All Manufacturer</option>
                    <option value="customer_group">Customer Group</option>
                    <option value="customer">Customers</option>
                    <option value="manufacturer">Manufacturer</option>
                    <option value="product">Products</option>
                  </select>
                </div>
              </div>
               <div class="form-group to" id="to-customer-group">
            <label class="col-sm-2 control-label" for="input-customer-group">Customer Group</label>
            <div class="col-sm-10">
              <select name="customer_group_id" id="input-customer-group" class="form-control">
                <?php foreach ($customer_groups as $customer_group) { ?>
                <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['group_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group to" id="to-customer">
            <label class="col-sm-2 control-label" for="input-customer"><span data-toggle="tooltip" title="Customer">Customer</span></label>
            <div class="col-sm-10">
              <input type="text" name="customers" value="" placeholder="Customer" id="input-customer" class="form-control" />
              <div class="well well-sm" style="height: 150px; overflow: auto;"></div>
            </div>
          </div>
          <div class="form-group to" id="to-manufacturer">
            <label class="col-sm-2 control-label" for="input-manufacturer"><span data-toggle="tooltip" title="Manufacturer">Manufacturer</span></label>
            <div class="col-sm-10">
              <input type="text" name="manufacturer" value="" placeholder="Manufacturer" id="input-manufacturer" class="form-control" />
              <div class="well well-sm" style="height: 150px; overflow: auto;"></div>
            </div>
          </div>
           <div class="form-group to" id="to-product">
            <label class="col-sm-2 control-label" for="input-product"><span data-toggle="tooltip" title="Send only to customers who have ordered products in the list. (Autocomplete)">Product</span></label>
            <div class="col-sm-10">
              <input type="text" name="products" value="" placeholder="Products" id="input-product" class="form-control" />
              <div class="well well-sm" style="height: 150px; overflow: auto;"></div>
            </div>
          </div>
           <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-subject">Subject</label>
            <div class="col-sm-10">
              <input type="text" name="subject" value="" placeholder="Subject" id="input-subject" class="form-control" />
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-message">Message</label>
            <div class="col-sm-10">
              <textarea name="message" placeholder="Message" id="input-message" class="form-control"></textarea>
            </div>
          </div>
             </form>
          </div>
          <!-- End : box-body --> 
        </div>
      </div>
    </div>
  </section>
  <!----------------------- Main content -------------------------------> 
</div>
<!------------------- End content-wrapper ----------------------------> 
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js">     </script>
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/js/common.js"></script> 
<script type="text/javascript">
var baseurl = "<?php print base_url(); ?>"; 
  //Initializa Summernote
  $('#input-message').summernote({height: 300});


    $('select[name=\'to\']').on('change', function() {
  $('.to').hide();

  $('#to-' + this.value.replace('_', '-')).show();
});

$('select[name=\'to\']').trigger('change');
</script> 
<script type="text/javascript">
// Customers
$('input[name=\'customers\']').autocomplete({
  'source': function(request, response) {
      $.ajax({
            url: "<?php echo base_url('customers/customer/autocomplete/') ?>",
            dataType: 'json',
                        type:'POST',
                        data : {'filter_name':request},
            success: function(json) {
                response($.map(json, function(item) {
                    return {
                        label: item['firstname']+' '+item['lastname'],
                        value: item['customer_id']
                    }
                }));
            }
        });
  },
  'select': function(item) {
    $('input[name=\'customers\']').val('');

    $('#input-customer' + item['value']).remove();

    $('#input-customer').parent().find('.well').append('<div id="input-customer' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="customer[]" value="' + item['value'] + '" /></div>');
  }
});

$('#input-customer').parent().find('.well').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

// Manufacturer
$('input[name=\'manufacturer\']').autocomplete({
  'source': function(request, response) {
       $.ajax({
                        url: "<?php echo base_url('catalog/manufacturers/autocomplete/') ?>",
                        dataType: 'json',
                        type: 'POST',
                        data: {'manufacturer': request},
                        success: function (json) {
                            response($.map(json, function (item) {
                                return {
                                    label: item['name'],
                                    value: item['manufacturer_id']
                                }
                            }));
                        }
                    });
  },
  'select': function(item) {
    $('input[name=\'manufacturer\']').val('');

    $('#input-manufacturer' + item['value']).remove();

    $('#input-manufacturer').parent().find('.well').append('<div id="input-manufacturer' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="manufacturer[]" value="' + item['value'] + '" /></div>');
  }
});

$('#input-manufacturer').parent().find('.well').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});
// Products
$('input[name=\'products\']').autocomplete({
  'source': function(request, response) {
     $.ajax({
            url: "<?php echo base_url('catalog/product/autocomplete/') ?>",
            dataType: 'json',
            type: 'POST',
            data: {'product_name': request},
            success: function (json) {
                response($.map(json, function (item) {
                    return {
                        label: item['product_name'],
                        value: item['product_id']
                    }
                }));
            }
        });
  },
  'select': function(item) {
    $('input[name=\'products\']').val('');

    $('#input-product' + item['value']).remove();

    $('#input-product').parent().find('.well').append('<div id="input-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product[]" value="' + item['value'] + '" /></div>');
  }
});

$('#input-product').parent().find('.well').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});


function send(url) {
  $('textarea[name=\'message\']').val($('#input-message').code());
  $.ajax({
    url: url,
    type: 'post',
    data: $('#form-send-mail').serialize(),
    dataType: 'json',
    beforeSend: function() {
      
      $('#button-send').button('loading');
    },
    complete: function() {
      $('#button-send').button('reset');
    },
    success: function(json) {
      $('.alert, .text-danger').remove();
      if (json['error']) {
        if (json['error']['warning']) {
          $('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '</div>');
        }

        if (json['error']['subject']) {
          $('input[name=\'subject\']').after('<div class="text-danger">' + json['error']['subject'] + '</div>');
        }

        if (json['error']['message']) {
          $('textarea[name=\'message\']').parent().append('<div class="text-danger">' + json['error']['message'] + '</div>');
        }
      }

      if (json['next']) {
        if (json['success']) {
          $('.msg').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i>  ' + json['success'] + '</div>');

          send(json['next']);
        }
      } else {
        if (json['success']) {
          $('.msg').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
        }
      }
    }
  });
}
</script>