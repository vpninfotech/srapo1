<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>
<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/form-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/form-editable/js/bootstrap-editable.min.js">
</script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap timepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/timepicker/bootstrap-timepicker.min.css">
<!-- bootstrap timepicker -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/timepicker/bootstrap-timepicker.min.js"></script>


<!-- DATE TIME PICKER -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/datetimepicker/bootstrap-datetimepicker.min.css">
<!-- bootstrap timepicker -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/all.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
<!-- Select2 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/icheck.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="content"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Orders</h1>
        <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
        <div class="pull-right">
                 <a href="<?php echo base_url('sales/orders');?>" class="btn btn-default"><i class="fa fa-reply"></i> Cancel </a>
              </div>
    </section>
    <!------------------ End Content Header (Page header) ------------------- --> 
    <!-------------------------- Main content ------------------------------- -->
    <section class="content">
      <div class="row" >
       <div class="col-xs-12 myerror">
       </div>
       <?php if(isset($error) && $error!==""): ?>
        <div class="col-xs-12">
        <div class="alert alert-danger alert-bold-border">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
           <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error;?>
        </div>
        </div>
        <?php endif; ?>
        <?php if(isset($success) && $success!==""): ?>
          <div class="col-xs-12">
        <div class="alert alert-success alert-bold-border">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
           <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success;?>
        </div>
        </div>
        <?php endif; ?>

        <div class="col-xs-12">
        <form class="form-horizontal" action="#" method="post" name="orders_form">
          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> Add Order</h2>
             
            </div>
            <div class="box-body"> 
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
               
                  <ul class="nav nav-tabs" id="order">
                    <li class="disable active"><a href="#tab-customer" data-toggle="tab">Customer Details</a></li>
                    <li class="disable"><a href="#tab-cart" data-toggle="tab">Products</a></li>
                    <li class="disable"><a href="#tab-payments" data-toggle="tab">Payment Details</a></li>
                    <li class="disable"><a href="#tab-shipping" data-toggle="tab">Shipping Details</a></li>
                    <li class="disable"><a href="#tab-total" data-toggle="tab">Total</a></li>
                  </ul>
                    <div class="tab-content">
                      <!-- Start : tab-pane cust-details-->
                      <div class="tab-pane active" id="tab-customer">
                        <!------- Start : input group ------> 
                        <div class="form-group">
                          <label class="col-sm-3 col-md-2 control-label" for="currency">Currency</label>
                          <div class="col-sm-9 col-md-10">
                            <select name="currency" id="currency" class="form-control">
                               <?php foreach ($currency_list as $currency) { ?>
                                  <?php if ($currency['code'] == $currency_code) { ?>
                                  <option value="<?php echo $currency['code']; ?>" selected="selected"><?php echo $currency['code']; ?></option>
                                  <?php } else { ?>
                                  <option value="<?php echo $currency['code']; ?>"><?php echo $currency['title']; ?></option>
                                  <?php } ?>
                                  <?php } ?>
                            </select>
                          </div>
                        </div>
                        <!------- End : input group ------>
                        
                        <!-- Start : input Group -->
                        <div class="form-group">
                          <label for="customer" class="col-sm-3 col-md-2 control-label">Customer</label>
                          <div class="col-sm-9 col-md-10">
                              <input type="text" name="customer" id="customer" class="form-control" value="<?php echo $customer;?>" placeholder="Customer">
                              <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer_id;?>">
                          </div>
                        </div>
                        <!-- End : input Group -->
                        
                        <!------- Start : input group ------> 
                        <div class="form-group">
                          <label class="col-sm-3 col-md-2 control-label" for="customer_group">Customer Group</label>
                          <div class="col-sm-9 col-md-10">
                            <select name="customer_group_id" id="customer_group_id" class="form-control">
                              
                            <?php

                            foreach ($customer_group as $key => $value) {
                              echo '<option value="'.$value['customer_group_id'].'">'.$value['group_name'].'</option>';
                            }
                            ?>
                              
                            </select>
                          </div>
                        </div>
                        <!------- End : input group ------>
                        
                        <!-- Start : input Group -->
                        <div class="form-group required">
                          <label for="first_name" class="col-sm-3 col-md-2 control-label">First Name</label>
                          <div class="col-sm-9 col-md-10">
                              <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" value="<?php echo $firstname; ?>">
                          </div>
                        </div>
                        <!-- End : input Group -->
                        
                        <!------- start : input group ------>
                        <div class="form-group required">
                          <label for="last_name" class="col-sm-3 col-md-2 control-label">Last Name</label>
                          <div class="col-sm-9 col-md-10">
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" value="<?php echo $lastname; ?>">
                           
                          </div>
                        </div>
                        <!------- End : input group ------>
                        
                        <!------- start : input group ------>
                        <div class="form-group required ">
                          <label for="email" class="col-sm-3 col-md-2 control-label">Email</label>
                          <div class="col-sm-9 col-md-10">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>">
                            
                          </div>
                        </div>
                        <!------- end : input group ------>
                        
                        <!------- start : input group ------>
                        <div class="form-group required">
                          <label for="telephone" class="col-sm-3 col-md-2 control-label">Telephone</label>
                          <div class="col-sm-9 col-md-10">
                            <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Telephone" value="<?php echo $telephone; ?>">
                            
                          </div>
                        </div>
                        <!------- end : input group ------>
                        
                        <!--Start : Button-->
                      <div class="form-group">
                          <div class="col-sm-12 text-right">
                              <button id="button-customer" class="btn btn-primary btnNext" type="button">
                              <i class="fa fa-arrow-right"></i>
                              Continue
                              </button>
                            </div>
                          </div>
                        <!-- End : Button-->    
                      </div>
                      <!-- End : tab-pane cust-details -->
                    
              <!-- Start : tab-pane tab-cart -->       
            <div class="tab-pane" id="tab-cart">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                       <td class="text-left">Product</td>
                        <td class="text-left">Model</td>
                        <td class="text-right">Quantity</td>
                        <td class="text-right">Unit Price</td>
                        <td class="text-right">Total</td>
                        <td>Action</td>
                    </tr>
                  </thead>
                  <tbody id="cart">
                    <?php if ($order_products || $order_vouchers) { ?>
                    <?php $product_row = 0; ?>
                    <?php foreach ($order_products as $order_product) { ?>
                    <tr>
                      <td class="text-left"><?php echo $order_product['name']; ?><br />
                        <input type="hidden" name="product[<?php echo $product_row; ?>][product_id]" value="<?php echo $order_product['product_id']; ?>" />
                        <?php foreach ($order_product['option'] as $option) { ?>
                        - <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br />
                        <?php if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'image') { ?>
                        <input type="hidden" name="product[<?php echo $product_row; ?>][option][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['product_option_value_id']; ?>" />
                        <?php } ?>
                        <?php if ($option['type'] == 'checkbox') { ?>
                        <input type="hidden" name="product[<?php echo $product_row; ?>][option][<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option['product_option_value_id']; ?>" />
                        <?php } ?>
                        <?php if ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') { ?>
                        <input type="hidden" name="product[<?php echo $product_row; ?>][option][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" />
                        <?php } ?>
                        <?php } ?></td>
                      <td class="text-left"><?php echo $order_product['model']; ?></td>
                      <td class="text-right"><?php echo $order_product['quantity']; ?>
                        <input type="hidden" name="product[<?php echo $product_row; ?>][quantity]" value="<?php echo $order_product['quantity']; ?>" /></td>
                      <td class="text-right"></td>
                      <td class="text-right"></td>
                      <td class="text-center"></td>
                    </tr>
                    <?php $product_row++; ?>
                    <?php } ?>
                    <?php $voucher_row = 0; ?>
                    <?php foreach ($order_vouchers as $order_voucher) { ?>
                    <tr>
                      <td class="text-left"><?php echo $order_voucher['description']; ?>
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][voucher_id]" value="<?php echo $order_voucher['voucher_id']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][description]" value="<?php echo $order_voucher['description']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][code]" value="<?php echo $order_voucher['code']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][from_name]" value="<?php echo $order_voucher['from_name']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][from_email]" value="<?php echo $order_voucher['from_email']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][to_name]" value="<?php echo $order_voucher['to_name']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][to_email]" value="<?php echo $order_voucher['to_email']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][voucher_theme_id]" value="<?php echo $order_voucher['voucher_theme_id']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][message]" value="<?php echo $order_voucher['message']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][amount]" value="<?php echo $order_voucher['amount']; ?>" /></td>
                      <td class="text-left"></td>
                      <td class="text-right">1</td>
                      <td class="text-right"></td>
                      <td class="text-right"></td>
                      <td class="text-center"></td>
                    </tr>
                    <?php $voucher_row++; ?>
                    <?php } ?>
                    <?php } else { ?>
                    <tr>
                      <td class="text-center" colspan="6">No result Found</td>
                    </tr>
                  </tbody>
                  <?php } ?>
                </table>
              </div>
              <ul class="nav nav-tabs nav-justified">
                <li class="active"><a href="#tab-product" data-toggle="tab">Products</a></li>
                <li><a href="#tab-voucher" data-toggle="tab">Vouchers</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab-product">
                  <fieldset>
                    <legend>Add Product(s)</legend>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-product">Choose Product</label>
                      <div class="col-sm-10">
                        <input type="text" name="product" value="" id="input-product" class="form-control" />
                        <input type="hidden" name="product_id" value="" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-quantity">Quantity</label>
                      <div class="col-sm-10">
                        <input type="text" name="quantity" value="1" id="input-quantity" class="form-control" />
                      </div>
                    </div>
                    <div id="option"></div>
                  </fieldset>
                  <div class="text-right">
                    <button type="button" id="button-product-add" data-loading-text="Loading..." class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Product</button>
                  </div>
                </div>
                <div class="tab-pane" id="tab-voucher">
                  <fieldset>
                    <legend>Add Voucher(s)</legend>
                    <div class="form-group required">
                      <label class="col-sm-2 control-label" for="input-to-name">Recipient's Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="to_name" value="" id="input-to-name" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group required">
                      <label class="col-sm-2 control-label" for="input-to-email">Recipient's Email</label>
                      <div class="col-sm-10">
                        <input type="text" name="to_email" value="" id="input-to-email" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group required">
                      <label class="col-sm-2 control-label" for="input-from-name">Senders Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="from_name" value="" id="input-from-name" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group required">
                      <label class="col-sm-2 control-label" for="input-from-email">Senders Email</label>
                      <div class="col-sm-10">
                        <input type="text" name="from_email" value="" id="input-from-email" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group required">
                      <label class="col-sm-2 control-label" for="input-theme">Gift Certificate Theme</label>
                      <div class="col-sm-10">
                        <select name="voucher_theme_id" id="input-theme" class="form-control">
                          <?php foreach ($voucher_themes as $voucher_theme) { ?>
                          <option value="<?php echo $voucher_theme['voucher_theme_id']; ?>"><?php echo $voucher_theme['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-message">Message</label>
                      <div class="col-sm-10">
                        <textarea name="message" rows="5" id="input-message" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="form-group required">
                      <label class="col-sm-2 control-label" for="input-amount">Amount</label>
                      <div class="col-sm-10">
                        <input type="text" name="amount" value="<?php echo $voucher_min; ?>" id="input-amount" class="form-control" />
                      </div>
                    </div>
                  </fieldset>
                  <div class="text-right">
                    <button type="button" id="button-voucher-add" data-loading-text="Loading..." class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Voucher</button>
                  </div>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-sm-6 text-left">
                  <button type="button" onclick="$('a[href=\'#tab-customer\']').tab('show');" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button>
                </div>
                <div class="col-sm-6 text-right">
                  <button type="button" id="button-cart" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Continue</button>
                </div>
              </div>
            </div>
          <!-- End : tab-panel Cart -->
                    
                    
                    <!-- Start : tab-pane payments-->
                    <div class="tab-pane" id="tab-payments">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-payment-address">Choose Address</label>
                <div class="col-sm-10">
                  <select name="payment_address" id="input-payment-address" class="form-control">
                    <option value="0" selected="selected">--- None ---</option>
                    <?php foreach ($addresses as $address) { ?>
                    <option value="<?php echo $address['address_id']; ?>"><?php echo $address['firstname'] . ' ' . $address['lastname'] . ', ' . $address['address_1'] . ', ' . $address['city'] . ', ' . $address['country']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-payment-firstname">First Name</label>
                <div class="col-sm-10">
                  <input type="text" name="firstname" value="<?php echo $payment_firstname; ?>" id="input-payment-firstname" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-payment-lastname">Last Name</label>
                <div class="col-sm-10">
                  <input type="text" name="lastname" value="<?php echo $payment_lastname; ?>" id="input-payment-lastname" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-payment-company">Company</label>
                <div class="col-sm-10">
                  <input type="text" name="company" value="<?php echo $payment_company; ?>" id="input-payment-company" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-payment-address-1">Address 1</label>
                <div class="col-sm-10">
                  <input type="text" name="address_1" value="<?php echo $payment_address_1; ?>" id="input-payment-address-1" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-payment-address-2">Address 2</label>
                <div class="col-sm-10">
                  <input type="text" name="address_2" value="<?php echo $payment_address_2; ?>" id="input-payment-address-2" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-payment-city">City</label>
                <div class="col-sm-10">
                  <input type="text" name="city" value="<?php echo $payment_city; ?>" id="input-payment-city" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-payment-postcode">Postcode</label>
                <div class="col-sm-10">
                  <input type="text" name="postcode" value="<?php echo $payment_postcode; ?>" id="input-payment-postcode" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-payment-country">Country</label>
                <div class="col-sm-10">
                  <select name="country_id" id="input-payment-country" class="form-control">
                    <option value="">--- Please Select ---</option>
                    <?php foreach ($countries as $country) { ?>
                    <?php if ($country['country_id'] == $payment_country_id) { ?>
                    <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['country_name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-payment-zone">Region / State</label>
                <div class="col-sm-10">
                  <select name="zone_id" id="input-payment-zone" class="form-control">
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 text-left">
                  <button type="button" onclick="$('a[href=\'#tab-cart\']').tab('show');" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button>
                </div>
                <div class="col-sm-6 text-right">
                  <button type="button" id="button-payment-address" data-loading-text="Loading..." class="btn btn-primary"><i class="fa fa-arrow-right"></i>Continue</button>
                </div>
              </div>
            </div>
                    <!-- End : tab-pane payments -->
                    
                    
            <!-- Start : tab-pane shipping-->
            <div class="tab-pane" id="tab-shipping">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-shipping-address">Choose Address</label>
                <div class="col-sm-10">
                  <select name="shipping_address" id="input-shipping-address" class="form-control">
                    <option value="0" selected="selected">--- None ---</option>
                    <?php foreach ($addresses as $address) { ?>
                    <option value="<?php echo $address['address_id']; ?>"><?php echo $address['firstname'] . ' ' . $address['lastname'] . ', ' . $address['address_1'] . ', ' . $address['city'] . ', ' . $address['country']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-shipping-firstname">First Name</label>
                <div class="col-sm-10">
                  <input type="text" name="firstname" value="<?php echo $shipping_firstname; ?>" id="input-shipping-firstname" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-shipping-lastname">Last Name</label>
                <div class="col-sm-10">
                  <input type="text" name="lastname" value="<?php echo $shipping_lastname; ?>" id="input-shipping-lastname" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-shipping-company">Company</label>
                <div class="col-sm-10">
                  <input type="text" name="company" value="<?php echo $shipping_company; ?>" id="input-shipping-company" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-shipping-address-1">Address 1</label>
                <div class="col-sm-10">
                  <input type="text" name="address_1" value="<?php echo $shipping_address_1; ?>" id="input-shipping-address-1" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-shipping-address-2">Address 2</label>
                <div class="col-sm-10">
                  <input type="text" name="address_2" value="<?php echo $shipping_address_2; ?>" id="input-shipping-address-2" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-shipping-city">City</label>
                <div class="col-sm-10">
                  <input type="text" name="city" value="<?php echo $shipping_city; ?>" id="input-shipping-city" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-shipping-postcode">Postcode</label>
                <div class="col-sm-10">
                  <input type="text" name="postcode" value="<?php echo $shipping_postcode; ?>" id="input-shipping-postcode" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-shipping-country">Country</label>
                <div class="col-sm-10">
                  <select name="country_id" id="input-shipping-country" class="form-control">
                    <option value="">--- Please Select ---</option>
                    <?php foreach ($countries as $country) { ?>
                    <?php if ($country['country_id'] == $shipping_country_id) { ?>
                    <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['country_name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-shipping-zone">Region / State</label>
                <div class="col-sm-10">
                  <select name="zone_id" id="input-shipping-zone" class="form-control">
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 text-left">
                  <button type="button" onclick="$('a[href=\'#tab-payments\']').tab('show');" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button>
                </div>
                <div class="col-sm-6 text-right">
                  <button type="button" id="button-shipping-address" data-loading-text="Loading..." class="btn btn-primary"><i class="fa fa-arrow-right"></i>Continue</button>
                </div>
              </div>
            </div>
                    <!-- End : tab-pane shipping -->
                    
                    <!-- Start : tab-pane Total-->
                    <div class="tab-pane" id="tab-total">
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <td class="text-left">Product</td>
                                <td class="text-left">Model</td>
                                <td class="text-right">Quantity</td>
                                <td class="text-right">Unit Price</td>
                                <td class="text-right">Total</td>
                              </tr>
                            </thead>
                            <tbody id="total">
                              <tr>
                                <td class="text-center" colspan="5">No results!</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <fieldset>
                          <legend>Order Details</legend>
                          <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-shipping-method">Shipping Method</label>
                            <div class="col-sm-10">
                              <div class="input-group">
                                <select name="shipping_method" id="input-shipping-method" class="form-control">
                                  <option value="">--- Please Select ---</option>
                                  <?php if ($shipping_code) { ?>
                                  <option value="<?php echo $shipping_code; ?>" selected="selected"><?php echo $shipping_method; ?></option>
                                  <?php } ?>
                                </select>
                                <span class="input-group-btn">
                                <button type="button" id="button-shipping-method" data-loading-text="Loading..." class="btn btn-primary">Apply</button>
                                </span></div>
                            </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-payment-method">Payment Method</label>
                            <div class="col-sm-10">
                              <div class="input-group">
                                <select name="payment_method" id="input-payment-method" class="form-control">
                                  <option value="">--- Please Select ---</option>
                                  <?php if ($payment_code) { ?>
                                  <option value="<?php echo $payment_code; ?>" selected="selected"><?php echo $payment_method; ?></option>
                                  <?php } ?>
                                </select>
                                <span class="input-group-btn">
                                <button type="button" id="button-payment-method" data-loading-text="Loading..." class="btn btn-primary">Apply</button>
                                </span></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-coupon">Coupon</label>
                            <div class="col-sm-10">
                              <div class="input-group">
                                <input type="text" name="coupon" value="<?php echo $coupon; ?>" id="input-coupon" class="form-control" />
                                <span class="input-group-btn">
                                <button type="button" id="button-coupon" data-loading-text="Loading..." class="btn btn-primary">Apply</button>
                                </span></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-voucher">Voucher</label>
                            <div class="col-sm-10">
                              <div class="input-group">
                                <input type="text" name="voucher" value="<?php echo $voucher; ?>" id="input-voucher" data-loading-text="Loading..." class="form-control" />
                                <span class="input-group-btn">
                                <button type="button" id="button-voucher" data-loading-text="Loading..." class="btn btn-primary">Apply</button>
                                </span></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-order-status">Order Status</label>
                            <div class="col-sm-10">
                              <select name="order_status_id" id="input-order-status" class="form-control">
                                <?php foreach ($order_statuses as $order_status) { ?>
                                <?php if ($order_status['order_status_id'] == $order_status_id) { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['order_status_name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['order_status_name']; ?></option>
                                <?php } ?>
                                <?php } ?>
                              </select>
                              <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-comment">Comment</label>
                            <div class="col-sm-10">
                              <textarea name="comment" rows="5" id="input-comment" class="form-control"><?php echo $comment; ?></textarea>
                            </div>
                          </div>
                         
                        </fieldset>
                        <div class="row">
                          <div class="col-sm-6 text-left">
                            <button type="button" onclick="$('select[name=\'shipping_method\']').prop('disabled') ? $('a[href=\'#tab-payments\']').tab('show') : $('a[href=\'#tab-shipping\']').tab('show');" class="btn btn-default"><i class="fa fa-arrow-left"></i>Back</button>
                          </div>
                          <div class="col-sm-6 text-right">
                            <button type="button" id="button-refresh" data-toggle="tooltip" title="Refresh" data-loading-text="Loading..." class="btn btn-warning"><i class="fa fa-refresh"></i></button>
                            <button type="button" id="button-save" class="btn btn-primary"><i class="fa fa-check-circle"></i>Save</button>
                          </div>
                        </div>
                      </div>
                    <!-- End : tab-pane- Total -->

                   
                  </div>
                  <!-- /.tab-content -->
                </form>
              </div>
              <!-- nav-tabs-custom --> 
            </div>
          </div>
        </div>
      </div>
    </section>
    <!----------------------- Main content -------------------------------> 
  </div>
  <!------------------- End content-wrapper ---------------------------->

<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js">     </script>
<!-- page script -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/js/common.js"></script>

<script></script>


<script type="text/javascript">
  //Initializa Summernote
  $('#input-description').summernote({height: 300});
  
  //Initialize Select2 Elements
    $(".select2").select2();
  
  //Date picker
    $('#date_available').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
  

  
</script>




<script type="text/javascript">

// Disable the tabs
$('#order a[data-toggle=\'tab\']').on('click', function(e) {
  return false;
});

// Customer
$('input[name=\'customer\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo base_url('customers/customer/autocomplete');?>',
      type:'post',
      data:{filter_name:request},
      dataType: 'json',
      success: function(json) {
        json.unshift({
          customer_id: '0',
          customer_group_id: '0',
          name: '--None--',
          customer_group: '',
          firstname: '',
          lastname: '',
          email: '',
          telephone: '',
          address: []
        });

        response($.map(json, function(item) {
          return {
            category: item['customer_group'],
            label: item['name'],
            value: item['customer_id'],
            customer_group_id: item['customer_group_id'],
            firstname: item['firstname'],
            lastname: item['lastname'],
            email: item['email'],
            telephone: item['telephone'],
            address: item['address']
          }
        }));
      }
    });
  },
  'select': function(item) {
    // Reset all custom fields
    $('#tab-customer input[type=\'text\'], #tab-customer textarea').not('#tab-customer input[name=\'customer\'], #tab-customer input[name=\'customer_id\']').val('');
    $('#tab-customer select option').removeAttr('selected');
    $('#tab-customer input[type=\'checkbox\'], #tab-customer input[type=\'radio\']').removeAttr('checked');

    $('#tab-customer input[name=\'customer\']').val(item['label']);
    $('#tab-customer input[name=\'customer_id\']').val(item['value']);
    $('#tab-customer select[name=\'customer_group_id\']').val(item['customer_group_id']);
    $('#tab-customer input[name=\'firstname\']').val(item['firstname']);
    $('#tab-customer input[name=\'lastname\']').val(item['lastname']);
    $('#tab-customer input[name=\'email\']').val(item['email']);
    $('#tab-customer input[name=\'telephone\']').val(item['telephone']);
    
    html = '<option value="0">--None--</option>';

    for (i in  item['address']) {
      html += '<option value="' + item['address'][i]['address_id'] + '">' + item['address'][i]['firstname'] + ' ' + item['address'][i]['lastname'] + ', ' + item['address'][i]['address_1'] + ', ' + item['address'][i]['city'] + ', ' + item['address'][i]['country'] + '</option>';
    }
    $('select[name=\'payment_address\']').html(html);
    $('select[name=\'shipping_address\']').html(html);

    $('select[name=\'payment_address\']').trigger('change');
    $('select[name=\'shipping_address\']').trigger('change');
  }
});
//Customer tab continue button
$('#button-customer').on('click', function() {
  $.ajax({
    url: '<?php echo base_url('api/api_customer');?>',
    type: 'post',
    data: $('#tab-customer input[type=\'text\'], #tab-customer input[type=\'hidden\'], #tab-customer input[type=\'radio\']:checked, #tab-customer input[type=\'checkbox\']:checked, #tab-customer select, #tab-customer textarea'),
    dataType: 'json',
    crossDomain: true,
    beforeSend: function() {
      $('#button-customer').button('loading');
    },
    complete: function() {
       $('#button-customer').button('reset');
    },
    success: function(json) {

      $('.alert, .text-danger').remove();
      $('.form-group').removeClass('has-error');

      if (json['error']) {
        if (json['error']['warning']) {
          $('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }

        for (i in json['error']) {
          var element = $('#' +i);

          if (element.parent().hasClass('input-group')) {
                      $(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
          } else {
            $(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
          }
        }

        // Highlight any found errors
        $('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
      }
      else
      {
                // Refresh products, vouchers and totals
                var request_1 = $.ajax({
                    url: '<?php echo base_url('api/api_cart/add');?>',
                    type: 'post',
                    data: $('#cart input[name^=\'product\'][type=\'text\'], #cart input[name^=\'product\'][type=\'hidden\'], #cart input[name^=\'product\'][type=\'radio\']:checked, #cart input[name^=\'product\'][type=\'checkbox\']:checked, #cart select[name^=\'product\'], #cart textarea[name^=\'product\']'),
                    dataType: 'json',
                    crossDomain: true,
                    beforeSend: function() {
                        $('#button-product-add').button('loading');
                    },
                    complete: function() {
                        $('#button-product-add').button('reset');
                    },
                    success: function(json) {
                        $('.alert, .text-danger').remove();
                        $('.form-group').removeClass('has-error');

                        if (json['error'] && json['error']['warning']) {
                            $('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                        }
                },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });

                var request_2 = request_1.then(function() {
                    $.ajax({
                        url: '<?php echo base_url('api/api_voucher/add');?>',
                        type: 'post',
                        data: $('#cart input[name^=\'voucher\'][type=\'text\'], #cart input[name^=\'voucher\'][type=\'hidden\'], #cart input[name^=\'voucher\'][type=\'radio\']:checked, #cart input[name^=\'voucher\'][type=\'checkbox\']:checked, #cart select[name^=\'voucher\'], #cart textarea[name^=\'voucher\']'),
                        dataType: 'json',
                        crossDomain: true,
                        beforeSend: function() {
                            $('#button-voucher-add').button('loading');
                        },
                        complete: function() {
                            $('#button-voucher-add').button('reset');
                        },
                        success: function(json) {
                            $('.alert, .text-danger').remove();
                            $('.form-group').removeClass('has-error');

                            if (json['error'] && json['error']['warning']) {
                                $('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                            }
                    },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                });

                request_2.done(function() {
                  
                    $('#button-refresh').trigger('click');

                    $('a[href=\'#tab-cart\']').tab('show');
                });
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

// Currency
$('select[name=\'currency\']').on('change', function() {
  $.ajax({
    url: '<?php echo base_url('api/api_currency');?>',
    type: 'post',
    data: 'currency=' + $('select[name=\'currency\'] option:selected').val(),
    dataType: 'json',
    crossDomain: true,
    beforeSend: function() {
      $('select[name=\'currency\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('.fa-spin').remove();
    },
    success: function(json) {
      $('.alert, .text-danger').remove();
      $('.form-group').removeClass('has-error');

      if (json['error']) {
        $('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        // Highlight any found errors
        $('select[name=\'currency\']').parent().parent().addClass('has-error');
      }

    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

 $(document).ready(function() {
    $('.btnNext').click(function(){
      $('.nav-tabs > .active').next('li').find('a').trigger('click');
    });

    $('.btnPrevious').click(function(){
      
      $('.nav-tabs > .active').prev('li').find('a').trigger('click');

    });
});

 //Product Autocomplete
 $('#tab-product input[name=\'product\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo base_url('catalog/product/autocomplete');?>',
      type:'post',
      data: {product_name:request},
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['product_name'],
            value: item['product_id'],
            model: item['product_model'],
            option: item['option'],
            price: item['price']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('#tab-product input[name=\'product\']').val(item['label']);
    $('#tab-product input[name=\'product_id\']').val(item['value']);

    if (item['option'] != '') {
      html  = '<fieldset>';
            html += '  <legend>Choose Option(s)</legend>';

      for (i = 0; i < item['option'].length; i++) {
        option = item['option'][i];

        if (option['type'] == 'select') {
          html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
          html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
          html += '  <div class="col-sm-10">';
          html += '    <select name="option[' + option['product_option_id'] + ']" id="input-option' + option['product_option_id'] + '" class="form-control">';
          html += '      <option value="">--- Please Select ---</option>';

          for (j = 0; j < option['product_option_value'].length; j++) {
            option_value = option['product_option_value'][j];

            html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];

            if (option_value['price']) {
              html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
            }

            html += '</option>';
          }

          html += '    </select>';
          html += '  </div>';
          html += '</div>';
        }

        if (option['type'] == 'radio') {
          html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
          html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
          html += '  <div class="col-sm-10">';
          html += '    <select name="option[' + option['product_option_id'] + ']" id="input-option' + option['product_option_id'] + '" class="form-control">';
          html += '      <option value="">--- Please Select ---</option>';

          for (j = 0; j < option['product_option_value'].length; j++) {
            option_value = option['product_option_value'][j];

            html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];

            if (option_value['price']) {
              html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
            }

            html += '</option>';
          }

          html += '    </select>';
          html += '  </div>';
          html += '</div>';
        }

        if (option['type'] == 'checkbox') {
          html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
          html += '  <label class="col-sm-2 control-label">' + option['name'] + '</label>';
          html += '  <div class="col-sm-10">';
          html += '    <div id="input-option' + option['product_option_id'] + '">';

          for (j = 0; j < option['product_option_value'].length; j++) {
            option_value = option['product_option_value'][j];

            html += '<div class="checkbox">';

            html += '  <label><input type="checkbox" name="option[' + option['product_option_id'] + '][]" value="' + option_value['product_option_value_id'] + '" /> ' + option_value['name'];

            if (option_value['price']) {
              html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
            }

            html += '  </label>';
            html += '</div>';
          }

          html += '    </div>';
          html += '  </div>';
          html += '</div>';
        }

        if (option['type'] == 'image') {
          html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
          html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
          html += '  <div class="col-sm-10">';
          html += '    <select name="option[' + option['product_option_id'] + ']" id="input-option' + option['product_option_id'] + '" class="form-control">';
          html += '      <option value="">--- Please Select ---</option>';

          for (j = 0; j < option['product_option_value'].length; j++) {
            option_value = option['product_option_value'][j];

            html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];

            if (option_value['price']) {
              html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
            }

            html += '</option>';
          }

          html += '    </select>';
          html += '  </div>';
          html += '</div>';
        }

        if (option['type'] == 'text') {
          html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
          html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
          html += '  <div class="col-sm-10"><input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" id="input-option' + option['product_option_id'] + '" class="form-control" /></div>';
          html += '</div>';
        }

        if (option['type'] == 'textarea') {
          html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
          html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
          html += '  <div class="col-sm-10"><textarea name="option[' + option['product_option_id'] + ']" rows="5" id="input-option' + option['product_option_id'] + '" class="form-control">' + option['value'] + '</textarea></div>';
          html += '</div>';
        }

        if (option['type'] == 'file') {
          html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
          html += '  <label class="col-sm-2 control-label">' + option['name'] + '</label>';
          html += '  <div class="col-sm-10">';
          html += '    <button type="button" id="button-upload' + option['product_option_id'] + '" data-loading-text="Loading..." class="btn btn-default"><i class="fa fa-upload"></i>Upload</button>';
          html += '    <input type="hidden" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" id="input-option' + option['product_option_id'] + '" />';
          html += '  </div>';
          html += '</div>';
        }

        if (option['type'] == 'date') {
          html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
          html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
          html += '  <div class="col-sm-3"><div class="input-group date"><input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" placeholder="' + option['name'] + '" data-date-format="YYYY-MM-DD" id="input-option' + option['product_option_id'] + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
          html += '</div>';
        }

        if (option['type'] == 'datetime') {
          html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
          html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
          html += '  <div class="col-sm-3"><div class="input-group datetime"><input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" placeholder="' + option['name'] + '" data-date-format="YYYY-MM-DD HH:mm" id="input-option' + option['product_option_id'] + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
          html += '</div>';
        }

        if (option['type'] == 'time') {
          html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
          html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
          html += '  <div class="col-sm-3"><div class="input-group time"><input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" placeholder="' + option['name'] + '" data-date-format="HH:mm" id="input-option' + option['product_option_id'] + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
          html += '</div>';
        }
      }

      html += '</fieldset>';

      $('#option').html(html);

      $('.date').datetimepicker({
        pickTime: false
      });

      $('.datetime').datetimepicker({
        pickDate: true,
        pickTime: true
      });

      $('.time').datetimepicker({
        pickDate: false
      });
    } else {
      $('#option').html('');
    }
  }
});

//Product Add
$('#button-product-add').on('click', function() {
  $.ajax({
    url: '<?php echo base_url('api/api_cart/add');?>',
    type: 'post',
    data: $('#tab-product input[name=\'product_id\'], #tab-product input[name=\'quantity\'], #tab-product input[name^=\'option\'][type=\'text\'], #tab-product input[name^=\'option\'][type=\'hidden\'], #tab-product input[name^=\'option\'][type=\'radio\']:checked, #tab-product input[name^=\'option\'][type=\'checkbox\']:checked, #tab-product select[name^=\'option\'], #tab-product textarea[name^=\'option\']'),
    dataType: 'json',
    crossDomain: true,
    beforeSend: function() {
      $('#button-product-add').button('loading');
    },
    complete: function() {
      $('#button-product-add').button('reset');
    },
    success: function(json) {
      $('.alert, .text-danger').remove();
      $('.form-group').removeClass('has-error');

      if (json['error']) {
        if (json['error']['warning']) {
          $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }

        if (json['error']['option']) {
          for (i in json['error']['option']) {
            var element = $('#input-option' + i.replace('_', '-'));

            if (element.parent().hasClass('input-group')) {
              $(element).parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
            } else {
              $(element).after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
            }
          }
        }

        if (json['error']['store']) {
          $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['store'] + '</div>');
        }

        // Highlight any found errors
        $('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
      } else {
        // Refresh products, vouchers and totals
        $('#button-refresh').trigger('click');
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

// Voucher
$('#button-voucher-add').on('click', function() {
  $.ajax({
    url: '<?php echo base_url('api/api_voucher/add');?>',
    type: 'post',
    data: $('#tab-voucher input[type=\'text\'], #tab-voucher input[type=\'hidden\'], #tab-voucher input[type=\'radio\']:checked, #tab-voucher input[type=\'checkbox\']:checked, #tab-voucher select, #tab-voucher textarea'),
    dataType: 'json',
    crossDomain: true,
    beforeSend: function() {
      $('#button-voucher-add').button('loading');
    },
    complete: function() {
      $('#button-voucher-add').button('reset');
    },
    success: function(json) {
      $('.alert, .text-danger').remove();
      $('.form-group').removeClass('has-error');

      if (json['error']) {
        if (json['error']['warning']) {
          $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }

        for (i in json['error']) {
          var element = $('#input-' + i.replace('_', '-'));

          if (element.parent().hasClass('input-group')) {
            $(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
          } else {
            $(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
          }
        }

        // Highlight any found errors
        $('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
      } else {
        $('input[name=\'from_name\']').attr('value', '');
        $('input[name=\'from_email\']').attr('value', '');
        $('input[name=\'to_name\']').attr('value', '');
        $('input[name=\'to_email\']').attr('value', '');
        $('textarea[name=\'message\']').attr('value', '');
        $('input[name=\'amount\']').attr('value', '<?php echo addslashes($voucher_min); ?>');

        // Refresh products, vouchers and totals
        $('#button-refresh').trigger('click');
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$('#cart').delegate('.btn-danger', 'click', function() {
  var node = this;

  $.ajax({
    url: '<?php echo base_url('api/api_cart/remove');?>',
    type: 'post',
    data: 'key=' + encodeURIComponent(this.value),
    dataType: 'json',
    crossDomain: true,
    beforeSend: function() {
      $(node).button('loading');
    },
    complete: function() {
      $(node).button('reset');
    },
    success: function(json) {
      $('.alert, .text-danger').remove();

      // Check for errors
      if (json['error']) {
        $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      } else {
        // Refresh products, vouchers and totals
        $('#button-refresh').trigger('click');
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$('#cart').delegate('.btn-primary', 'click', function() {
    var node = this;
    // Refresh products, vouchers and totals
    $.ajax({
        url: '<?php echo base_url('api/api_cart/add');?>',
        type: 'post',
        data: $('#cart input[name^=\'product\'][type=\'text\'], #cart input[name^=\'product\'][type=\'hidden\'], #cart input[name^=\'product\'][type=\'radio\']:checked, #cart input[name^=\'product\'][type=\'checkbox\']:checked, #cart select[name^=\'product\'], #cart textarea[name^=\'product\']'),
        dataType: 'json',
        crossDomain: true,
        beforeSend: function() {
            $(node).button('loading');
        },
        complete: function() {
            $(node).button('reset');
        },
        success: function(json) {
            $('.alert, .text-danger').remove();
            $('.form-group').removeClass('has-error');

            if (json['error'] && json['error']['warning']) {
                $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            }

            if (json['success']) {
        $('.myerror').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    }).done(function() {
        $('#button-refresh').trigger('click');
    });
});

$('#button-cart').on('click', function() {
  $('a[href=\'#tab-payments\']').tab('show');
});

// Payment Address
$('select[name=\'payment_address\']').on('change', function() {
  $.ajax({
    url: '<?php echo base_url('customers/customer/address');?>',
    type: 'post',
    data:{address_id:this.value},
    dataType: 'json',
    beforeSend: function() {
      $('select[name=\'payment_address\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('#tab-payments .fa-spin').remove();
    },
    success: function(json) {
      // Reset all fields
      $('#tab-payments input[type=\'text\'], #tab-payments input[type=\'text\'], #tab-payments textarea').val('');
      $('#tab-payments select option').not('#tab-payments select[name=\'payment_address\']').removeAttr('selected');
      $('#tab-payments input[type=\'checkbox\'], #tab-payments input[type=\'radio\']').removeAttr('checked');

      $('#tab-payments input[name=\'firstname\']').val(json['firstname']);
      $('#tab-payments input[name=\'lastname\']').val(json['lastname']);
      $('#tab-payments input[name=\'company\']').val(json['company']);
      $('#tab-payments input[name=\'address_1\']').val(json['address_1']);
      $('#tab-payments input[name=\'address_2\']').val(json['address_2']);
      $('#tab-payments input[name=\'city\']').val(json['city']);
      $('#tab-payments input[name=\'postcode\']').val(json['postcode']);
      $('#tab-payments select[name=\'country_id\']').val(json['country_id']);

      payment_zone_id = json['zone_id'];

      $('#tab-payments select[name=\'country_id\']').trigger('change');
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

var payment_zone_id = '<?php echo $payment_zone_id; ?>';

$('#tab-payments select[name=\'country_id\']').on('change', function() {
  $.ajax({
    url: '<?php echo base_url("system/country/country");?>',
    type:'post',
    data:{country_id:this.value},
    dataType: 'json',
    beforeSend: function() {
      $('#tab-payment select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('#tab-payment .fa-spin').remove();
    },
    success: function(json) {
      if (json['postcode_required'] == '1') {
        $('#tab-payments input[name=\'postcode\']').parent().parent().addClass('required');
      } else {
        $('#tab-payments input[name=\'postcode\']').parent().parent().removeClass('required');
      }

      html = '<option value="">--- Please Select ---</option>';

      if (json['zone'] && json['zone'] != '') {
        for (i = 0; i < json['zone'].length; i++) {
              html += '<option value="' + json['zone'][i]['state_id'] + '"';

          if (json['zone'][i]['state_id'] == payment_zone_id) {
                html += ' selected="selected"';
            }

            html += '>' + json['zone'][i]['state_name'] + '</option>';
        }
      } else {
        html += '<option value="0" selected="selected"> --- None ---</option>';
      }

      $('#tab-payments select[name=\'zone_id\']').html(html);
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$('#tab-payments select[name=\'country_id\']').trigger('change');

$('#button-payment-address').on('click', function() {
  $.ajax({
    url: '<?php echo base_url('api/api_payment/address');?>',
    type: 'post',
    data: $('#tab-payments input[type=\'text\'], #tab-payments input[type=\'hidden\'], #tab-payments input[type=\'radio\']:checked, #tab-payments input[type=\'checkbox\']:checked, #tab-payments select, #tab-payments textarea'),
    dataType: 'json',
    crossDomain: true,
    beforeSend: function() {
      $('#button-payment-address').button('loading');
    },
    complete: function() {
      $('#button-payment-address').button('reset');
    },
    success: function(json) {
      $('.alert, .text-danger').remove();
      $('.form-group').removeClass('has-error');

      // Check for errors
      if (json['error']) {
        if (json['error']['warning']) {
          $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }

        for (i in json['error']) {
          var element = $('#input-payment-' + i.replace('_', '-'));

          if ($(element).parent().hasClass('input-group')) {
            $(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
          } else {
            $(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
          }
        }

        // Highlight any found errors
        $('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
      } else {
        // Payment Methods
        $.ajax({
          url: '<?php echo base_url('api/api_payment/methods');?>',
          type:'post',
          dataType: 'json',
          crossDomain: true,
          beforeSend: function() {
            $('#button-payment-address i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
            $('#button-payment-address').prop('disabled', true);
          },
          complete: function() {
            $('#button-payment-address i').replaceWith('<i class="fa fa-arrow-right"></i>');
            $('#button-payment-address').prop('disabled', false);
          },
          success: function(json) {
            if (json['error']) {
              $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            } else {
              html = '<option value="">--- Please Select ---</option>';
              if (json['payment_methods']) {
                for (i in json['payment_methods']) {
                  if (json['payment_methods'][i]['code'] == $('select[name=\'payment_method\'] option:selected').val()) {
                    html += '<option value="' + json['payment_methods'][i]['code'] + '" selected="selected">' + json['payment_methods'][i]['title'] + '</option>';
                  } else {
                    html += '<option value="' + json['payment_methods'][i]['code'] + '">' + json['payment_methods'][i]['title'] + '</option>';
                  }
                }
              }

              $('select[name=\'payment_method\']').html(html);
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
        }).done(function() {
                    // Refresh products, vouchers and totals
            $('#button-refresh').trigger('click');

            // If shipping required got to shipping tab else total tabs
            if ($('select[name=\'shipping_method\']').prop('disabled')) {
              $('a[href=\'#tab-total\']').tab('show');
            } else {
              $('a[href=\'#tab-shipping\']').tab('show');
            }
                });
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

// Shipping Address
$('select[name=\'shipping_address\']').on('change', function() {
  $.ajax({
     url: '<?php echo base_url('customers/customer/address');?>',
    type: 'post',
    data:{address_id:this.value},
    dataType: 'json',
    beforeSend: function() {
      $('select[name=\'shipping_address\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('#tab-shipping .fa-spin').remove();
    },
    success: function(json) {
      // Reset all fields
      $('#tab-shipping input[type=\'text\'], #tab-shipping input[type=\'text\'], #tab-shipping textarea').val('');
      $('#tab-shipping select option').not('#tab-shipping select[name=\'shipping_address\']').removeAttr('selected');
      $('#tab-shipping input[type=\'checkbox\'], #tab-shipping input[type=\'radio\']').removeAttr('checked');

      $('#tab-shipping input[name=\'firstname\']').val(json['firstname']);
      $('#tab-shipping input[name=\'lastname\']').val(json['lastname']);
      $('#tab-shipping input[name=\'company\']').val(json['company']);
      $('#tab-shipping input[name=\'address_1\']').val(json['address_1']);
      $('#tab-shipping input[name=\'address_2\']').val(json['address_2']);
      $('#tab-shipping input[name=\'city\']').val(json['city']);
      $('#tab-shipping input[name=\'postcode\']').val(json['postcode']);
      $('#tab-shipping select[name=\'country_id\']').val(json['country_id']);

      shipping_zone_id = json['zone_id'];

      $('#tab-shipping select[name=\'country_id\']').trigger('change');
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

var shipping_zone_id = '<?php echo $shipping_zone_id; ?>';

$('#tab-shipping select[name=\'country_id\']').on('change', function() {
  $.ajax({
      url: '<?php echo base_url("system/country/country");?>',
    type:'post',
    data:{country_id:this.value},
    dataType: 'json',
    beforeSend: function() {
      $('#tab-shipping select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('#tab-shipping .fa-spin').remove();
    },
    success: function(json) {
      if (json['postcode_required'] == '1') {
        $('#tab-shipping input[name=\'postcode\']').parent().parent().addClass('required');
      } else {
        $('#tab-shipping input[name=\'postcode\']').parent().parent().removeClass('required');
      }

      html = '<option value="">-- Please Select --</option>';

      if (json['zone'] && json['zone'] != '') {
       
        for (i = 0; i < json['zone'].length; i++) 
        {
              html += '<option value="' + json['zone'][i]['state_id'] + '"';

          if (json['zone'][i]['state_id'] == shipping_zone_id) {
                html += ' selected="selected"';
            }

            html += '>' + json['zone'][i]['state_name'] + '</option>';
        }
      } else {
        html += '<option value="0" selected="selected">--None--</option>';
      }

      $('#tab-shipping select[name=\'zone_id\']').html(html);
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$('#tab-shipping select[name=\'country_id\']').trigger('change');

$('#button-shipping-address').on('click', function() {
  $.ajax({
    url: '<?php echo base_url('api/api_shipping/address');?>',
    type: 'post',
    data: $('#tab-shipping input[type=\'text\'], #tab-shipping input[type=\'hidden\'], #tab-shipping input[type=\'radio\']:checked, #tab-shipping input[type=\'checkbox\']:checked, #tab-shipping select, #tab-shipping textarea'),
    dataType: 'json',
    crossDomain: true,
    beforeSend: function() {
      $('#button-shipping-address').button('loading');
    },
    complete: function() {
      $('#button-shipping-address').button('reset');
    },
    success: function(json) {
      $('.alert, .text-danger').remove();
      $('.form-group').removeClass('has-error');

      // Check for errors
      if (json['error']) {
        if (json['error']['warning']) {
          $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }

        for (i in json['error']) {
          var element = $('#input-shipping-' + i.replace('_', '-'));

          if ($(element).parent().hasClass('input-group')) {
            $(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
          } else {
            $(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
          }
        }

        // Highlight any found errors
        $('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
      } else {
        // Shipping Methods
        var request = $.ajax({
          url: '<?php echo base_url('api/api_shipping/methods');?>',
          dataType: 'json',
          beforeSend: function() {
            $('#button-shipping-address i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
            $('#button-shipping-address').prop('disabled', true);
          },
          complete: function() {
            $('#button-shipping-address i').replaceWith('<i class="fa fa-arrow-right"></i>');
            $('#button-shipping-address').prop('disabled', false);
          },
          success: function(json) {
            if (json['error']) {
              $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            } else {
              // Shipping Methods
              html = '<option value="">-- Please Select --</option>';

              if (json['shipping_methods']) {
                for (i in json['shipping_methods']) {
                  html += '<optgroup label="' + json['shipping_methods'][i]['title'] + '">';

                  if (!json['shipping_methods'][i]['error']) {
                    for (j in json['shipping_methods'][i]['quote']) {
                      if (json['shipping_methods'][i]['quote'][j]['code'] == $('select[name=\'shipping_method\'] option:selected').val()) {
                        html += '<option value="' + json['shipping_methods'][i]['quote'][j]['code'] + '" selected="selected">' + json['shipping_methods'][i]['quote'][j]['title'] + ' - ' + json['shipping_methods'][i]['quote'][j]['text'] + '</option>';
                      } else {
                        html += '<option value="' + json['shipping_methods'][i]['quote'][j]['code'] + '">' + json['shipping_methods'][i]['quote'][j]['title'] + ' - ' + json['shipping_methods'][i]['quote'][j]['text'] + '</option>';
                      }
                    }
                  } else {
                    html += '<option value="" style="color: #F00;" disabled="disabled">' + json['shipping_method'][i]['error'] + '</option>';
                  }

                  html += '</optgroup>';
                }
              }

              $('select[name=\'shipping_method\']').html(html);
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
        }).done(function() {
            // Refresh products, vouchers and totals
            $('#button-refresh').trigger('click');

                    $('a[href=\'#tab-total\']').tab('show');
                });
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

// Shipping Method
$('#button-shipping-method').on('click', function() {
  $.ajax({
    url: '<?php echo base_url('api/api_shipping/method');?>',
    type: 'post',
    data: 'shipping_method=' + $('select[name=\'shipping_method\'] option:selected').val(),
    dataType: 'json',
    crossDomain: true,
    beforeSend: function() {
      $('#button-shipping-method').button('loading');
    },
    complete: function() {
      $('#button-shipping-method').button('reset');
    },
    success: function(json) {
      $('.alert, .text-danger').remove();
      $('.form-group').removeClass('has-error');

      if (json['error']) {
        $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        // Highlight any found errors
        $('select[name=\'shipping_method\']').parent().parent().parent().addClass('has-error');
      }

      if (json['success']) {
        $('.myerror').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        // Refresh products, vouchers and totals
        $('#button-refresh').trigger('click');
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

// Payment Method
$('#button-payment-method').on('click', function() {
  $.ajax({
    url: '<?php echo base_url('api/api_payment/method');?>',
    type: 'post',
    data: 'payment_method=' + $('select[name=\'payment_method\'] option:selected').val(),
    dataType: 'json',
    crossDomain: true,
    beforeSend: function() {
      $('#button-payment-method').button('loading');
    },
    complete: function() {
      $('#button-payment-method').button('reset');
    },
    success: function(json) {
      $('.alert, .text-danger').remove();
      $('.form-group').removeClass('has-error');

      if (json['error']) {
        $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        // Highlight any found errors
        $('select[name=\'payment_method\']').parent().parent().parent().addClass('has-error');
      }

      if (json['success']) {
        $('.myerror').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        // Refresh products, vouchers and totals
        $('#button-refresh').trigger('click');
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

// Coupon
$('#button-coupon').on('click', function() {
  $.ajax({
    url: '<?php echo base_url('api/api_coupon');?>',
    type: 'post',
    data: 'coupon=' + $('input[name=\'coupon\']').val(),
    dataType: 'json',
    crossDomain: true,
    beforeSend: function() {
      $('#button-coupon').button('loading');
    },
    complete: function() {
      $('#button-coupon').button('reset');
    },
    success: function(json) {
      $('.alert, .text-danger').remove();
      $('.form-group').removeClass('has-error');

      if (json['error']) {
        $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        // Highlight any found errors
        $('input[name=\'coupon\']').parent().parent().parent().addClass('has-error');
      }

      if (json['success']) {
        $('.myerror').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        // Refresh products, vouchers and totals
        $('#button-refresh').trigger('click');
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

// Voucher
$('#button-voucher').on('click', function() {
  $.ajax({
    url: '<?php echo base_url('api/api_voucher');?>',
    type: 'post',
    data: 'voucher=' + $('input[name=\'voucher\']').val(),
    dataType: 'json',
    crossDomain: true,
    beforeSend: function() {
      $('#button-voucher').button('loading');
    },
    complete: function() {
      $('#button-voucher').button('reset');
    },
    success: function(json) {
      $('.alert, .text-danger').remove();
      $('.form-group').removeClass('has-error');

      if (json['error']) {
        $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        // Highlight any found errors
        $('input[name=\'voucher\']').parent().parent().parent().addClass('has-error');
      }

      if (json['success']) {
        $('.myerror').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        // Refresh products, vouchers and totals
        $('#button-refresh').trigger('click');
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});
// Checkout
$('#button-save').on('click', function() {
  if ($('input[name=\'order_id\']').val() == 0) {
    var url = '<?php echo base_url("api/api_order/add");?>'
  } else {
    var url = '<?php echo base_url("api/api_order/edit");?>';
  }
  //alert($('input[name=\'order_id\']').val());
  $.ajax({
    url: url,
    type: 'post',
    data: $('select[name=\'payment_method\'] option:selected,  select[name=\'shipping_method\'] option:selected,  #tab-total select[name=\'order_status_id\'], #tab-total select, #tab-total textarea[name=\'comment\'], #tab-total input[name=\'affiliate_id\'],#tab-total input[name=\'order_id\']'),
    dataType: 'json',
    crossDomain: true,
    beforeSend: function() {
      $('#button-save').button('loading');
    },
    complete: function() {
      $('#button-save').button('reset');
    },
    success: function(json) {
      $('.alert, .text-danger').remove();

      if (json['error']) {
        $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }

      if (json['success']) {
        $('.myerror').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '  <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                // Refresh products, vouchers and totals
        $('#button-refresh').trigger('click');
            }

      if (json['order_id']) {
        $('input[name=\'order_id\']').val(json['order_id']);
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

// Add all products to the cart using the api
$('#button-refresh').on('click', function()
 {
  $.ajax({
    url: '<?php echo base_url('api/api_cart/products');?>',
    type: 'post',
    dataType: 'json',
    crossDomain: true,
    success: function(json) {
      $('.alert-danger, .text-danger').remove();

      // Check for errors
      if (json['error']) {
        if (json['error']['warning']) {
          $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }

        if (json['error']['stock']) {
          $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['stock'] + '</div>');
        }

        if (json['error']['minimum']) {
          for (i in json['error']['minimum']) {
            $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['minimum'][i] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
          }
        }
      }

      var shipping = false;

      html = '';

      if (json['products'].length) {
        for (i = 0; i < json['products'].length; i++) {
          product = json['products'][i];

          html += '<tr>';
          html += '  <td class="text-left">' + product['name'] + ' ' + (!product['stock'] ? '<span class="text-danger">***</span>' : '') + '<br />';
          html += '  <input type="hidden" name="product[' + i + '][product_id]" value="' + product['product_id'] + '" />';

          if (product['option']) {
            for (j = 0; j < product['option'].length; j++) {
              option = product['option'][j];

              html += '  - <small>' + option['name'] + ': ' + option['value'] + '</small><br />';

              if (option['type'] == 'select' || option['type'] == 'radio' || option['type'] == 'image') {
                html += '<input type="hidden" name="product[' + i + '][option][' + option['product_option_id'] + ']" value="' + option['product_option_value_id'] + '" />';
              }

              if (option['type'] == 'checkbox') {
                html += '<input type="hidden" name="product[' + i + '][option][' + option['product_option_id'] + '][]" value="' + option['product_option_value_id'] + '" />';
              }

              if (option['type'] == 'text' || option['type'] == 'textarea' || option['type'] == 'file' || option['type'] == 'date' || option['type'] == 'datetime' || option['type'] == 'time') {
                html += '<input type="hidden" name="product[' + i + '][option][' + option['product_option_id'] + ']" value="' + option['value'] + '" />';
              }
            }
          }

          html += '</td>';
          html += '  <td class="text-left">' + product['model'] + '</td>';
          html += '  <td class="text-right"><div class="input-group btn-block" style="max-width: 200px;"><input type="text" name="product[' + i + '][quantity]" value="' + product['quantity'] + '" class="form-control" /><span class="input-group-btn"><button type="button" data-toggle="tooltip" title="Refresh" data-loading-text="Refresh" class="btn btn-primary"><i class="fa fa-refresh"></i></button></span></div></td>';
                    html += '  <td class="text-right">' + product['price'] + '</td>';
          html += '  <td class="text-right">' + product['total'] + '</td>';
          html += '  <td class="text-center" style="width: 3px;"><button type="button" value="' + product['cart_id'] + '" data-toggle="tooltip" title="Remove" data-loading-text="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
          html += '</tr>';

          if (product['shipping'] != 0) {
            shipping = true;
          }
        }
      }

      if (!shipping) {
        $('select[name=\'shipping_method\'] option').removeAttr('selected');
        $('select[name=\'shipping_method\']').prop('disabled', true);
        $('#button-shipping-method').prop('disabled', true);
      } else {
        $('select[name=\'shipping_method\']').prop('disabled', false);
        $('#button-shipping-method').prop('disabled', false);
      }

      if (json['vouchers'].length) {
        for (i in json['vouchers']) {
          voucher = json['vouchers'][i];

          html += '<tr>';
          html += '  <td class="text-left">' + voucher['description'];
                    html += '    <input type="hidden" name="voucher[' + i + '][code]" value="' + voucher['code'] + '" />';
          html += '    <input type="hidden" name="voucher[' + i + '][description]" value="' + voucher['description'] + '" />';
                    html += '    <input type="hidden" name="voucher[' + i + '][from_name]" value="' + voucher['from_name'] + '" />';
                    html += '    <input type="hidden" name="voucher[' + i + '][from_email]" value="' + voucher['from_email'] + '" />';
                    html += '    <input type="hidden" name="voucher[' + i + '][to_name]" value="' + voucher['to_name'] + '" />';
                    html += '    <input type="hidden" name="voucher[' + i + '][to_email]" value="' + voucher['to_email'] + '" />';
                    html += '    <input type="hidden" name="voucher[' + i + '][voucher_theme_id]" value="' + voucher['voucher_theme_id'] + '" />';
                    html += '    <input type="hidden" name="voucher[' + i + '][message]" value="' + voucher['message'] + '" />';
                    html += '    <input type="hidden" name="voucher[' + i + '][amount]" value="' + voucher['amount'] + '" />';
          html += '  </td>';
          html += '  <td class="text-left"></td>';
          html += '  <td class="text-right">1</td>';
          html += '  <td class="text-right">' + voucher['amount'] + '</td>';
          html += '  <td class="text-right">' + voucher['amount'] + '</td>';
          html += '  <td class="text-center" style="width: 3px;"><button type="button" value="' + voucher['code'] + '" data-toggle="tooltip" title="Remove" data-loading-text="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
          html += '</tr>';
        }
      }

      if (!json['products'].length && !json['vouchers'].length) {
        html += '<tr>';
        html += '  <td colspan="6" class="text-center">No result Found</td>';
        html += '</tr>';
      }
      $('#cart').html(html);

      // Totals
      html = '';

      if (json['products'].length) {
        for (i = 0; i < json['products'].length; i++) {
          product = json['products'][i];

          html += '<tr>';
          html += '  <td class="text-left">' + product['name'] + ' ' + (!product['stock'] ? '<span class="text-danger">***</span>' : '') + '<br />';

          if (product['option']) {
            for (j = 0; j < product['option'].length; j++) {
              option = product['option'][j];

              html += '  - <small>' + option['name'] + ': ' + option['value'] + '</small><br />';
            }
          }

          html += '  </td>';
          html += '  <td class="text-left">' + product['model'] + '</td>';
          html += '  <td class="text-right">' + product['quantity'] + '</td>';
          html += '  <td class="text-right">' + product['price'] + '</td>';
          html += '  <td class="text-right">' + product['total'] + '</td>';
          html += '</tr>';
        }
      }

      if (json['vouchers'].length) {
        for (i in json['vouchers']) {
          voucher = json['vouchers'][i];

          html += '<tr>';
          html += '  <td class="text-left">' + voucher['description'] + '</td>';
          html += '  <td class="text-left"></td>';
          html += '  <td class="text-right">1</td>';
          html += '  <td class="text-right">' + voucher['amount'] + '</td>';
          html += '  <td class="text-right">' + voucher['amount'] + '</td>';
          html += '</tr>';
        }
      }

      if (json['totals'].length) {
        for (i in json['totals']) {
          total = json['totals'][i];

          html += '<tr>';
          html += '  <td class="text-right" colspan="4">' + total['title'] + ':</td>';
          html += '  <td class="text-right">' + total['text'] + '</td>';
          html += '</tr>';
        }
      }

      if (!json['totals'].length && !json['products'].length && !json['vouchers'].length) {
        html += '<tr>';
        html += '  <td colspan="5" class="text-center">No Result Found</td>';
        html += '</tr>';
      }

      $('#total').html(html);
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});



$('select[name=\'currency\']').trigger('change');
</script>
