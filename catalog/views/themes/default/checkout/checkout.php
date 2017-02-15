<div class="columns-container">
    <div class="container" id="columns">
       <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
        </div>
        <!-- ./breadcrumb -->

        <!-- page heading-->
        <h2 class="page-heading">
            <span class="page-heading-title2">Checkout</span>
        </h2>
         <?php if ($error_warning) { ?>
          <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
          </div>
          <?php } ?>
        <!-- Start : page heading-->
        <div class="page-content">
            <div class="row">
            	<!-- Start : col-md-4 Left Column -->
              <div class="col-md-4">
               <?php if (!$logged && $account != 'guest') { ?>
              	<div class="login-btn-group">
                  <div class="btn-group btn-group-justified">
                    <div class="btn-group" role="group">
                        <label class="btn btn-primary active btn-register-account">
                        <input id="register" class="hidden" name="account" value="register" checked="checked" type="radio">
                        Register Account
                        </label>
                    </div>
                    <div class="btn-group" role="group">
                        <button id="login_button_popup btn-login" class="btn btn-default login-btn" type="button" data-toggle="modal" data-target="#login_model">Login</button>
                    </div>
                  </div>
                </div>
                <?php }?>
                <!-- Start : payment address -->
                <div class="payment_address" id="collapse-payment-address">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <span class="icon">
                            <i class="fa fa-book"></i>
                            </span>
                            <span class="text">Payment details</span>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <form>
                         <?php if ($logged) { ?>
                        <div class="radio-input">
                        	<div class="col-xs-12">
								<input id="payment_address_exists" class="payment-address" name="payment_address_exists" value="exists" checked="checked" data-refresh="2" autocomplete="off" type="radio">
								<label for="payment_address_exists">I want to use an existing address </label>
                             </div>
						</div>
                        
                        <!-- start : input Group -->
                        <div id="payment_address_div" class="text-input form-group required">
                            <div class="col-xs-12">
                                <select id="payment_address" class="form-control required  form-group" name="payment_address">
                               
                                <?php foreach ($addresses as $key => $address) { ?>
                                  <option value="<?php echo $address['address_id']; ?>"><?php echo $address['firstname'] . ' ' . $address['lastname'] . ', ' . $address['address_1'] . ', ' . $address['city'] . ', ' . $address['country']; ?></option>
                                <?php
                                    }
                                ?>
                                   
                                </select>
                             </div>
                        </div>
                        <!-- End : input Group -->
                        
                        <div class="radio-input">
                        	<div class="col-xs-12">
								<input id="payment_address_new" class="payment-address" name="payment_address_exists" value="new" type="radio">
								<label for="payment_address_exists"> I want to use a new address </label>
                             </div>
						</div>
                          <?php 
                            }
                            else
                            {
                                ?>

                          <div class="clearfix"></div> 
                        <!-- start : input Group -->
                        <div id="payment_address_firstname" class="text-input form-group required">
                            <div class="col-xs-5">
                                <label class="control-label" for="payment_address_firstname">
                                <span class="text" title="">First Name</span>
                                </label>
                            </div>
                            <div class="col-xs-7">
                                <input id="payment_address_firstname" class="form-control form-group" name="payment_address_firstname" placeholder="First Name" type="text">
                               
                             </div>
                        </div>
                        <!-- End : input Group -->
                        
                        <!-- start : input Group -->
                        <div id="payment_address_lastname" class="text-input form-group required">
                            <div class="col-xs-5">
                                <label class="control-label" for="payment_address_lastname">
                                <span class="text" title="">Last Name</span>
                                </label>
                            </div>
                            <div class="col-xs-7">
                                <input id="payment_address_lastname" class="form-control form-group" name="payment_address_lastname" placeholder="Last Name" type="text">
                             </div>
                        </div>
                        <!-- End : input Group -->
                        
                       
                        
                        <!-- start : input Group -->
                        <div class="text-input form-group required">
                            <div class="col-xs-5">
                                <label class="control-label margin-label" for="payment_address_contact">
                                <span class="text" title="">Contact</span>
                                </label>
                            </div>
                            <div class="col-xs-7">
                                <input id="payment_address_contact" class="form-control form-group" name="payment_address_contact" placeholder="Contact" type="text">
                             </div>
                        </div>
                        <!-- End : input Group -->
                         <!-- start : input Group -->
                        <div id="payment_address_email" class="text-input form-group required">
                            <div class="col-xs-5">
                                <label class="control-label" for="payment_address_email">
                                <span class="text" title="">E-Mail</span>
                                </label>
                            </div>
                            <div class="col-xs-7">
                                <input id="payment_address_email" class="form-control form-group" name="payment_address_email" placeholder="E-Mail" type="text">
                             </div>
                        </div>
                        <!-- End : input Group -->
                        <div id="payment_address_heading_heading" class="sort-item heading ">
                            Your Password
                            <hr>
                        </div>
                         <!-- start : input Group -->
                        <div class="text-input form-group required">
                            <div class="col-xs-5">
                                <label class="control-label" for="payment_address_firstname">
                                <span class="text" title="">Password</span>
                                </label>
                            </div>
                            <div class="col-xs-7">
                                <input id="payment_address_password" class="form-control form-group" name="payment_address_password" placeholder="Password" type="password">
                             </div>
                        </div>
                        <!-- End : input Group -->
                         <!-- start : input Group -->
                        <div class="text-input form-group required">
                            <div class="col-xs-5">
                                <label class="control-label" for="payment_address_confirm_password">
                                <span class="text" title="">Confirm Password</span>
                                </label>
                            </div>
                            <div class="col-xs-7">
                                <input id="payment_address_confirm_password" class="form-control form-group" name="payment_address_confirm_password" placeholder="Confirm Password" type="password">
                             </div>
                        </div>
                        <!-- End : input Group -->

                        <div id="payment_address_heading_heading" class="sort-item heading ">
                            Your Address
                            <hr>
                        </div>
                         <?php  }
                          ?>
                        <div class="clearfix"></div>
                         <div id="payment_address_details">
                             
                         
                        <?php if ($logged) { ?>
                        
                          <!-- start : input Group -->
                        <div class="text-input form-group required">
                            <div class="col-xs-4">
                                <label class="control-label" for="input-payment-firstname">
                                <span class="text" title="">First Name</span>
                                </label>
                            </div>
                            <div class="col-xs-8">
                                 <input type="text" name="firstname" value="" placeholder="First Name" id="input-payment-firstname" class="form-control form-group" />
                             </div>
                        </div>
                        <!-- End : input Group -->
                        
                        <!-- start : input Group -->
                        <div id="payment_address_lastname" class="text-input form-group required">
                            <div class="col-xs-4">
                                <label class="control-label" for="payment_address_lastname">
                                <span class="text" title="">Last Name</span>
                                </label>
                            </div>
                            <div class="col-xs-8">
                               <input type="text" name="lastname" value="" placeholder="Last Name" id="input-payment-lastname" class="form-control form-group" />
                             </div>
                        </div>
                        <!-- End : input Group -->
                        <?php  }
                          ?>
                        <!-- start : input Group -->
                        <div id="payment_address_add_1" class="text-input form-group required">
                            <div class="col-xs-4">
                                <label class="control-label" for="payment_address_address_1">
                                <span class="text" title="">Address 1</span>
                                </label>
                            </div>
                            <div class="col-xs-8">
                                 <input type="text" name="address_1" value="" placeholder="Address 1" id="input-payment-address-1" class="form-group form-control" />
                             </div>
                        </div>
                        <!-- End : input Group -->
                        
                        <!-- start : input Group -->
                        <div class="text-input form-group required">
                            <div class="col-xs-4">
                                <label class="control-label" for="input-payment-city">
                                <span class="text" title="">City</span>
                                </label>
                            </div>
                            <div class="col-xs-8">
                                <input type="text" name="city" value="" placeholder="City" id="input-payment-city" class="form-control form-group" />
                             </div>
                        </div>
                        <!-- End : input Group -->
                        
                        <!-- start : input Group -->
                        <div id="payment_address_postcode" class="text-input form-group required">
                            <div class="col-xs-4">
                                <label class="control-label" for="payment_address_postcode">
                                <span class="text" title="">Postcode</span>
                                </label>
                            </div>
                            <div class="col-xs-8">
                                <input type="text" name="postcode" value="" placeholder="Postcode" id="input-payment-postcode" class="form-control form-group" />
                             </div>
                        </div>
                        <!-- End : input Group -->
                        
                        <!-- start : input Group -->
                        <div  class="text-input form-group required">
                            <div class="col-xs-4">
                                <label class="control-label" for="input-payment-country">
                                <span class="text">Country</span>
                                </label>
                            </div>
                            <div class="col-xs-8">
                                <select id="input-payment-country" class="form-control required  form-group" name="country_id">
                                     <option value="">--- Please Select ---</option>
                                        <?php foreach ($countries as $country) { ?>
                                       
                                        <option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
                                        <?php } ?>
                                       
                                </select>
                             </div>
                        </div>
                        <!-- End : input Group -->
                        
                        <!-- start : input Group -->
                        <div class="text-input form-group required">
                            <div class="col-xs-4">
                                <label class="control-label" for="payment_address_state">
                                <span class="text">State</span>
                                </label>
                            </div>
                            <div class="col-xs-8">
                                <select id="input-payment-zone" class="form-control required form-group" name="state_id">
                                  
                                </select>
                             </div>
                        </div>
                        <!-- End : input Group -->
                        </div>
                         <div class="col-xs-12">

                            <label class="control-label margin-label" for="payment_address_delivery">
                            <input id="payment_address_delivery" name="payment_address_delivery" value="1" type="checkbox" checked="checked">
                                My delivery and billing addresses are the same.
                            </label>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End : payment address -->
               
                <!-- Start : delivery address -->
                <div class="delivery_address" id="collapse-shipping-address">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <span class="icon">
                            <i class="fa fa-book"></i>
                            </span>
                            <span class="text">Delivery details</span>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <form>
                        
                         <?php if ($logged) { ?>
                        <div class="radio-input">
                        	<div class="col-xs-12">
								<input id="delivery_address_exists" class="payment-address" name="delivery_address_exists" value="exists" checked="checked" data-refresh="2" autocomplete="off" type="radio">
								<label for="delivery_address_exists">I want to use an existing address </label>
                             </div>
						</div>
                        
                        <!-- start : input Group -->
                        <div id="delivery_payment_address_div" class="text-input form-group required">
                            <div class="col-xs-12">
                                <select id="delivery_payment_address" class="form-control required  form-group" name="delivery_payment_address">
                                    
                                <?php foreach ($addresses as $key => $address) { ?>
                                  <option value="<?php echo $address['address_id']; ?>"><?php echo $address['firstname'] . ' ' . $address['lastname'] . ', ' . $address['address_1'] . ', ' . $address['city'] . ', ' . $address['country']; ?></option>
                                <?php
                                    }
                                ?>
                                   
                                </select>
                             </div>
                        </div>
                        <!-- End : input Group -->
                        
                        <div class="radio-input">
                        	<div class="col-xs-12">
								<input id="delivery_address_new" class="payment-address" name="delivery_address_exists" value="new"  type="radio">
								<label for="delivery_address_exists"> I want to use a new address </label>
                             </div>
						</div>
                         <div class="clearfix"></div>

                        
                         
                        <?php 
                            }
                         ?>
                        <div class="clearfix"></div>
                         <div id="delivery_address_details">
                              <?php if ($logged) { ?>
                           <!-- start : input Group -->
                        <div class="text-input form-group required">
                            <div class="col-xs-4">
                                <label class="control-label" for="input-shipping-firstname">
                                <span class="text" title="">First Name</span>
                                </label>
                            </div>
                            <div class="col-xs-8">
                                <input type="text" name="firstname" value="" placeholder="First Name" id="input-shipping-firstname" class="form-control form-group" />
                             </div>
                        </div>
                        <!-- End : input Group -->
                        
                        <!-- start : input Group -->
                        <div class="text-input form-group required">
                            <div class="col-xs-4">
                                <label class="control-label" for="input-shipping-lastname">
                                <span class="text" title="">Last Name</span>
                                </label>
                            </div>
                            <div class="col-xs-8">
                                <input type="text" name="lastname" value="" placeholder="Last Name" id="input-shipping-lastname" class="form-control form-group" />
                             </div>
                        </div>
                        <!-- End : input Group -->
                         <?php 
                            }
                         ?>
                        <!-- start : input Group -->
                        <div class="text-input form-group required">
                            <div class="col-xs-4">
                                <label class="control-label" for="input-shipping-address-1">
                                <span class="text" title="">Address 1</span>
                                </label>
                            </div>
                            <div class="col-xs-8">
                                <input type="text" name="address_1" value="" placeholder="Address 1" id="input-shipping-address-1" class="form-control form-group" />
                             </div>
                        </div>
                        <!-- End : input Group -->
                        
                        <!-- start : input Group -->
                        <div class="text-input form-group required">
                            <div class="col-xs-4">
                                <label class="control-label" for="input-shipping-city">
                                <span class="text" title="">City</span>
                                </label>
                            </div>
                            <div class="col-xs-8">
                                <input type="text" name="city" value="" placeholder="City" id="input-shipping-city" class="form-control form-group" />
                             </div>
                        </div>
                        <!-- End : input Group -->
                        
                        <!-- start : input Group -->
                        <div class="text-input form-group required">
                            <div class="col-xs-4">
                                <label class="control-label" for="delivery_address_postcode">
                                <span class="text" title="">Postcode</span>
                                </label>
                            </div>
                            <div class="col-xs-8">
                               <input type="text" name="postcode" value="" placeholder="Postcode" id="input-shipping-postcode" class="form-control form-group" />
                             </div>
                        </div>
                        <!-- End : input Group -->
                        
                        <!-- start : input Group -->
                        <div class="text-input form-group required">
                            <div class="col-xs-4">
                                <label class="control-label" for="input-shipping-country">
                                <span class="text">Country</span>
                                </label>
                            </div>
                            <div class="col-xs-8">
                                <select id="input-shipping-country" class="form-control required  form-group" name="country_id">
                                   <option value="">--- Please Select ---</option>
                                        <?php foreach ($countries as $country) { ?>
                                       
                                        <option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
                                        <?php } ?>
                                </select>
                             </div>
                        </div>
                        <!-- End : input Group -->
                        
                        <!-- start : input Group -->
                        <div class="text-input form-group required">
                            <div class="col-xs-4">
                                <label class="control-label" for="input-shipping-zone">
                                <span class="text">State</span>
                                </label>
                            </div>
                            <div class="col-xs-8">
                                <select id="input-shipping-zone" class="form-control required form-group" name="state_id">
                                   
                                </select>
                             </div>
                        </div>
                        <!-- End : input Group -->  
                    </div>
                        </form>
                    </div>
                    
                  </div>
                  
                </div>
                <!-- End : delivery address -->
              </div>
              <!--End : col-md-4 Left Column -->
              <!-- start : col-md-8 Rignt Column -->
              <div class="col-md-8">
                <div class="row">
                	<div class="col-md-6">
                    	<div class="Shipping_method">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <span class="icon">
                                    <i class="fa fa-truck"></i>
                                    </span>
                                    <span class="text">Shipping Method</span>
                                </h4>
                            </div>
                          
                			<!-- Start : Panel Body-->
                            <div class="panel-body">
                              <div id="shipping_method_list">
                                
                              </div>
                            </div>
                            <!-- End : Panel Body-->
                          </div>
                        </div>
               			 <!-- End : Shipping method -->
              		</div>
              		<!-- End : col-md-6-->
                    
                    <!-- Start : col-md-6-->
                    <div class="col-md-6">
                    	<div class="Payment_method">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <span class="icon">
                                    <i class="fa fa-credit-card"></i>
                                    </span>
                                    <span class="text">Payment Method</span>
                                </h4>
                            </div>
                          
                			<!-- Start : Panel Body-->
                            <div class="panel-body">
                              <div class="payment_method_list" id="payment_method_list">
                               
                              </div>
                            </div>
                            <!-- End : Panel Body-->
                          </div>
                        </div>
                    </div>
                    <!-- End : col-md-6-->
                </div>
                <!-- End : Row-->
                
                <div class="row">
                	<div class="col-md-12">
                    	<div class="Shopping_cart">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <span class="icon">
                                    <i class="fa fa-shopping-cart"></i>
                                    </span>
                                    <span class="text">Shopping Cart</span>
                                </h4>
                            </div>
                          
                			<!-- Start : Panel Body-->
                            <div class="panel-body">
                              <div id="shipping_method_list">
                              	<div class="table_scroll">
                                <table class="table table-bordered cart_summary">
                                
                                <thead>
                                <tr>
                                    <td class="">Image</td>
                                    <td class="">Product Name</td>
                                     <td class="">Model</td>
                                    <td class="">Quantity</td>
                                    <td class="">Unit Price</td>
                                    <td class="">Total</td>
                                </tr>
                                </thead>
                                <tbody id="total">
                                
                                </tbody>
                                </table>
                                </div>
                                
                                <div class="form-horizontal">
									<div class=" form-group coupon">
                                    <label class="col-sm-4 control-label"> Use Coupon Code </label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                        <input id="coupon" class="form-control" value="" name="coupon" placeholder="Use Coupon Code" type="text">
                                        <span class="input-group-btn">
                                        <button id="button-coupon" class="btn btn-coupan" type="button">
                                        <i class="fa fa-check"></i>
                                        </button>
                                        </span>
                                        </div>
                                    </div>
                                    </div>
                                    
                                    
                                    <div class=" form-group voucher">
                                    <label class="col-sm-4 control-label"> Use Gift Voucher </label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                        <input id="voucher" class="form-control" value="" name="voucher" placeholder="Use Gift Voucher" type="text">
                                        <span class="input-group-btn">
                                        <button id="button-voucher" class="btn btn-coupan" type="button">
                                        <i class="fa fa-check"></i>
                                        </button>
                                        </span>
                                        </div>
                                    </div>
                                    
                             
                                    </div>
                                    
                                </div>
                              </div>
                            </div>
                            <!-- End : Panel Body-->
                          </div>
                        </div>
                    	
                    </div>
                </div>
                
                <div class="row" id="collapse-confirm">
                	<div class="col-md-12">
                    	<div class="panel panel-default">
                        	<div class="panel-body">
                                <div id="payment_form">
                                    
                                </div>
                            	<form >
                                <div id="confirm_comment_input" class="text-input form-group sort-item " data-sort="0">
                                    <div class="col-xs-12">
                                        <label class="control-label" for="confirm_comment">
                                        <span class="text" title=""> Add Comments About Your Order</span>
                                        </label>
                                        </div>
                                        <div class="col-xs-12">
                                        <textarea id="confirm_comment" class="form-control textarea comment" name="comment" placeholder=" Add Comments About Your Order"></textarea>
                                    </div>
                                </div>



                                <div id="confirm_agree_input" class="checkbox-input form-group sort-item required">
                                    <div class="col-xs-12">
                                        <label class="control-label  condition" for="confirm_agree">
                                        <input name="confirm.agree" type="hidden">
                                        <input id="confirm_agree" class="validate required" name="agree" required type="checkbox" value="1">
                                        <span title="">
                                        	I have read and agree to the
                                            <a class="agree" href="" data-toggle="modal" data-target="#agree_modal">
                                            <b>Terms & Conditions</b>
                                            </a>
                                        </span>
                                        </label>
                                    </div>
                                </div>
                                
                                </form>
								
                                <button id="confirm_order" class="btn btn-lg btn-md btn-block btn-checkout">Confirm Order</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
              </div>
              <!-- End : col-md-8 Rignt Column-->
            </div>
        </div>
        <!-- End : page heading-->
    </div>
</div>


<div id="agree_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Terms & Condition</h4>
      </div>
      <div class="modal-body">
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        
        </p>
      </div>
      
    </div>

  </div>
</div>
<script>
var payment_zone_id = '';
$('#input-payment-country').on('change', function() {
  $.ajax({
    url: '<?php echo base_url("checkout/checkout/country");?>',
    type:'post',
    data:{country_id:this.value},
    dataType: 'json',
    beforeSend: function() {
      $('#input-payment-country').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('.fa-spin').remove();
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

      $('#input-payment-zone').html(html);
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$('#input-payment-country').trigger('change');
var delivery_zone_id = '';
$('#input-shipping-country').on('change', function() {
  $.ajax({
    url: '<?php echo base_url("checkout/checkout/country");?>',
    type:'post',
    data:{country_id:this.value},
    dataType: 'json',
    beforeSend: function() {
      $('#input-shipping-country').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('.fa-spin').remove();
    },
    success: function(json) {
      html = '<option value="">--- Please Select ---</option>';

      if (json['zone'] && json['zone'] != '') {
        for (i = 0; i < json['zone'].length; i++) {
              html += '<option value="' + json['zone'][i]['state_id'] + '"';
              if (json['zone'][i]['state_id'] == delivery_zone_id) {
                html += ' selected="selected"';
            }
            html += '>' + json['zone'][i]['state_name'] + '</option>';
        }
      } else {
        html += '<option value="0" selected="selected"> --- None ---</option>';
      }

      $('#input-shipping-zone').html(html);
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$('#input-shipping-country').trigger('change');

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
        $('.page-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        // Highlight any found errors
        $('input[name=\'coupon\']').parent().parent().parent().addClass('has-error');
      }

      if (json['success']) {
        $('.page-content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        // Refresh products, vouchers and totals
       getCart();
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
        $('.page-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        // Highlight any found errors
        $('input[name=\'voucher\']').parent().parent().parent().addClass('has-error');
      }

      if (json['success']) {
        $('.page-content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        // Refresh products, vouchers and totals
       getCart();
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});
//Add payment Adress
 $('select[name=\'payment_address\']').on('change', function() {
    var address_id = $(this).val();
  $.ajax({
    url: '<?php echo base_url('api/api_payment/add_address');?>',
    type: 'post',
    data: {address_id:$(this).val()},
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
          $('.page-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }

      } else {
        // Payment Methods
        $.ajax({
          url: '<?php echo base_url('api/api_payment/methods');?>',
          type:'post',
          dataType: 'json',
          crossDomain: true,
          beforeSend: function() {
            $('#payment_method_list').html('<i class="fa fa-circle-o-notch fa-spin"></i>');
          },
          complete: function() {
           $('#payment_method_list .fa-spin').remove();
          },
          success: function(json) {
            html='';
            if (json['error']) {
              $('.page-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            } else {
              if (json['payment_methods']) {
                for (i in json['payment_methods']) {
                    if (typeof(json['payment_methods'][i]['code']) != "undefined")
                    {
                       html += '<div class="radio">';
                        html += '<label for="payment_method' + i + '" class="payment_method">';
                        html += '<input id="payment_method' + i + '" name="payment_method" value="' + json['payment_methods'][i]['code'] + '"  type="radio" onclick=setPaymentMethod("' + json['payment_methods'][i]['code'] + '")>';
                        html += '<div class="row">';
                            html += '<div class="col-md-12 col-xs-12">';
                                html += '<span class="text">' + json['payment_methods'][i]['title'] + '';
                            html += '</div>';
                        html += '</div>';
                        html += '</label>';
                    html += '</div>';  
                    }
                  
                }
              }

              $('#payment_method_list').html(html);
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
        }).done(function() {
                    // Refresh products, vouchers and totals
           getCart();

            // If shipping required got to shipping tab else total tabs
            if ($('select[name=\'shipping_method\']').prop('disabled')) {
              $('a[href=\'#tab-total\']').tab('show');
            } else {
              $('a[href=\'#tab-shipping\']').tab('show');
            }
                });
        if($("#payment_address_delivery").is(":checked")) {


            setShippingAddress(address_id);
        }
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

 
//add Shipping Address
$('select[name=\'delivery_payment_address\']').on('change', function() {
  $.ajax({
    url: '<?php echo base_url('api/api_shipping/add_address');?>',
    type: 'post',
    data: {address_id:$(this).val()},
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
            $('#shipping_method_list').html('<i class="fa fa-circle-o-notch fa-spin"></i>');
            
          },
          complete: function() {
            $('#shipping_method_list .fa-spin').remove();
           
          },
          success: function(json) {
            if (json['error']) {
              $('.page-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            } else {
              // Shipping Methods
              html ="";
              if (json['shipping_methods']) {
                for (i in json['shipping_methods']) {
                  

                  if (!json['shipping_methods'][i]['error']) {
                    for (j in json['shipping_methods'][i]['quote']) {

                        html += '<div class="">';
                                 html += '   <label for="shipping_method" class="shipping_method">';
                                    
                                   html += ' <div class="row">';
                                   html += '<div class="col-md-1 col-xs-1">';
                                            html += '<input id="shipping_method'+j+'" name="shipping_method" value="' + json['shipping_methods'][i]['quote'][j]['code'] + '" onclick=setShippingMethod("' + json['shipping_methods'][i]['quote'][j]['code'] + '") type="radio">';
                                        html += '</div>';
                                        html += '<div class="col-md-7 col-xs-7">';
                                            html += '<span class="text">' + json['shipping_methods'][i]['quote'][j]['title'] + '</span>';
                                        html += '</div>';
                                        html += '<div class="col-md-4 col-xs-4 text-center">';
                                            html += '<span class="price">' + json['shipping_methods'][i]['quote'][j]['text'] + '</span>';
                                        html += '</div>';
                                    html += '</div>';
                                    html += '</label>';
                                html += '</div>';


                     
                    }
                  } 
                 
                }
              }

              $('#shipping_method_list').html(html);
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
        }).done(function() {
            // Refresh products, vouchers and totals
           getCart();

                    $('a[href=\'#tab-total\']').tab('show');
                });
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

function setShippingAddress(address_id)
{
    $.ajax({
    url: '<?php echo base_url('api/api_shipping/add_address');?>',
    type: 'post',
    data: {address_id:address_id},
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
            $('#shipping_method_list').html('<i class="fa fa-circle-o-notch fa-spin"></i>');
            
          },
          complete: function() {
            $('#shipping_method_list .fa-spin').remove();
           
          },
          success: function(json) {
            if (json['error']) {
              $('.page-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            } else {
              // Shipping Methods
              html ="";
              if (json['shipping_methods']) {
                for (i in json['shipping_methods']) {
                  

                  if (!json['shipping_methods'][i]['error']) {
                    for (j in json['shipping_methods'][i]['quote']) {

                        html += '<div class="">';
                                 html += '   <label for="shipping_method" class="shipping_method">';
                                    
                                   html += ' <div class="row">';
                                    html += '<div class="col-md-1 col-xs-1">';
                                            html += '<input id="shipping_method'+j+'" name="shipping_method" value="' + json['shipping_methods'][i]['quote'][j]['code'] + '" onclick=setShippingMethod("' + json['shipping_methods'][i]['quote'][j]['code'] + '") type="radio">';
                                        html += '</div>';
                                        html += '<div class="col-md-7 col-xs-7">';
                                            html += '<span class="text">' + json['shipping_methods'][i]['quote'][j]['title'] + '</span>';
                                        html += '</div>';
                                        html += '<div class="col-md-4 col-xs-4 text-center">';
                                            html += '<span class="price">' + json['shipping_methods'][i]['quote'][j]['text'] + '</span>';
                                        html += '</div>';
                                    html += '</div>';
                                    html += '</label>';
                                html += '</div>';


                     
                    }
                  } 
                 
                }
              }

              $('#shipping_method_list').html(html);
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
        }).done(function() {
            // Refresh products, vouchers and totals
           getCart();

                    $('a[href=\'#tab-total\']').tab('show');
                });
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}
// Payment Address
$('#input-payment-zone').on('change', function() {
    $.ajax({
        url: '<?php echo base_url('checkout/payment_address/save');?>',
        type: 'post',
        data: $('#collapse-payment-address input[type=\'text\'], #collapse-payment-address input[type=\'date\'], #collapse-payment-address input[type=\'datetime-local\'], #collapse-payment-address input[type=\'time\'], #collapse-payment-address input[type=\'password\'], #collapse-payment-address input[type=\'checkbox\']:checked, #collapse-payment-address input[type=\'radio\']:checked, #collapse-payment-address input[type=\'hidden\'], #collapse-payment-address textarea, #collapse-payment-address select'),
        dataType: 'json',
        beforeSend: function() {
            $('#button-save-payment-address').button('loading');
        },
        complete: function() {
            $('#button-save-payment-address').button('reset');
        },
        success: function(json) {
            $('.alert, .text-danger').remove();

            if (json['redirect']) {
                location = json['redirect'];
            } else if (json['error']) {
                if (json['error']['warning']) {
                    $('#collapse-payment-address .panel-body').prepend('<div class="alert alert-warning">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
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
                $('.text-danger').parent().parent().addClass('has-error');
            } 
            else 
            {
                 if (json['success']) 
                 {
                    $('.page-content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    getpaymentMethods($('#input-payment-country').val());
                    getShippingMethods($('#input-payment-country').val());
                   
                  }
                           
              
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// Shipping Address
$('#input-shipping-zone').on('change', function() {
    $.ajax({
        url: '<?php echo base_url('checkout/shipping_address/save');?>',
        type: 'post',
        data: $('#collapse-shipping-address input[type=\'text\'], #collapse-shipping-address input[type=\'date\'], #collapse-shipping-address input[type=\'datetime-local\'], #collapse-shipping-address input[type=\'time\'], #collapse-shipping-address input[type=\'password\'], #collapse-shipping-address input[type=\'checkbox\']:checked, #collapse-shipping-address input[type=\'radio\']:checked, #collapse-shipping-address input[type=\'hidden\'], #collapse-shipping-address textarea, #collapse-shipping-address select'),
        dataType: 'json',
        beforeSend: function() {
            $('#button-save-payment-address').button('loading');
        },
        complete: function() {
            $('#button-save-payment-address').button('reset');
        },
        success: function(json) {
            $('.alert, .text-danger').remove();

            if (json['redirect']) {
                location = json['redirect'];
            } else if (json['error']) {
                if (json['error']['warning']) {
                    $('#collapse-shipping-address .panel-body').prepend('<div class="alert alert-warning">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
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
                $('.text-danger').parent().parent().addClass('has-error');
            } 
            else 
            {
                 if (json['success']) 
                 {
                    $('.page-content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    getShippingMethods($('#input-shipping-country').val());
                   
                  }
                           
              
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// Confirm Order
$('#confirm_order').on('click', function() {
    
 $.ajax({
          url: '<?php echo base_url('checkout/confirm');?>',
          type:'post',
          dataType: 'json',
          data:$('#shipping_method_list input[type=\'radio\']:checked,#payment_method_list input[type=\'radio\']:checked,#collapse-confirm input[type=\'radio\']:checked, #collapse-confirm input[type=\'checkbox\']:checked, #collapse-confirm textarea'),
          crossDomain: true,
          beforeSend: function() {
            $('#confirm_order').button('loading');
        },
          complete: function() {
           $('#confirm_order').button('reset');
          },
          success: function(json) {
             $('.alert, .text-danger').remove();
            if (json['error']) {

                if (json['error']['warning']) {
                    $('.page-content').prepend('<div class="alert alert-warning">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }
                else{
                    $('.page-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                  }
                   $('body,html').animate({scrollTop:0},400);
            }
            else
            {
               payment_method = $('#payment_method_list input[type=\'radio\']:checked').val();
               $.ajax({
              url: '<?php echo base_url('payment/');?>'+payment_method,
              type:'post',
              dataType: 'html',
              crossDomain: true,
              beforeSend: function() {
                $('#button-payment-method').button('loading');
            },
              complete: function() {
               $('#button-payment-method').button('reset');
              },
              success: function(html) {
                $('#payment_form').html(html);
                $('#payment-form').submit();
                $('body,html').animate({scrollTop:0},400);
               
              },
              error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
              }
            });
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
        });

    });
// Add all products to the cart using the api
 function getCart()
 {
  $.ajax({
    url: '<?php echo base_url('api/api_cart/products');?>',
    type: 'post',
    dataType: 'json',
    crossDomain: true,
    beforeSend: function() {
            $('#total').html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        },
          complete: function() {
            $('#total .fa-spin').remove();
          },
    success: function(json) {
      $('.alert-danger, .text-danger').remove();

      // Check for errors
      if (json['error']) {
        if (json['error']['warning']) {
          $('.page-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }

        if (json['error']['stock']) {
          $('.page-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['stock'] + '</div>');
        }

        if (json['error']['minimum']) {
          for (i in json['error']['minimum']) {
            $('.page-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['minimum'][i] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
          }
        }
      }

      var shipping = false;

      if (!shipping) {
        $('select[name=\'shipping_method\'] option').removeAttr('selected');
        $('select[name=\'shipping_method\']').prop('disabled', true);
        $('#button-shipping-method').prop('disabled', true);
      } else {
        $('select[name=\'shipping_method\']').prop('disabled', false);
        $('#button-shipping-method').prop('disabled', false);
      }


      // Totals
      html = '';

      if (json['products'].length) {
        for (i = 0; i < json['products'].length; i++) {
          product = json['products'][i];

          html += '<tr>';
           html += '  <td class="text-left"><a href="'+product['href']+'"><img src="' +product['thumb']+ '" alt="'+product['name']+'" title="'+product['name']+'"></a></td>';
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
          html += '  <td class="text-right" colspan="5">' + total['title'] + ':</td>';
          html += '  <td class="text-right">' + total['text'] + '</td>';
          html += '</tr>';
        }
      }

      if (!json['totals'].length && !json['products'].length && !json['vouchers'].length) {
        html += '<tr>';
        html += '  <td colspan="6" class="text-center">No Result Found</td>';
        html += '</tr>';
      }

      $('#total').html(html);
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}


    

$('#payment_address_details').hide();
 $('#delivery_address_details').hide();

$('input[name=\'payment_address_delivery\']').change(function() {
        if($(this).is(":checked")) {
         $("#collapse-shipping-address" ).hide();
        }
        else
        {
           $("#collapse-shipping-address" ).show();
        }
        
    });



$('input[name=\'payment_address_exists\']').change(function() {

        if($(this).val() =="exists") 
        {
         $( "#payment_address_details" ).hide();
            $('select[name=\'payment_address\']').prop('disabled', false);
        }
        else
        {
           $( "#payment_address_details" ).show();
             $('select[name=\'payment_address\']').prop('disabled', true);
        }
        
    });


$('input[name=\'delivery_address_exists\']').change(function() {

        if($(this).val() =="exists") 
        {
            
         $( "#delivery_address_details" ).hide();
          $('select[name=\'delivery_payment_address\']').prop('disabled', false);
        }
        else
        {
           $( "#delivery_address_details" ).show();
            $('select[name=\'delivery_payment_address\']').prop('disabled', true);
        }
        
    });
 // Shipping Method
function setShippingMethod(shipping_method)
{

  $.ajax({
    url: '<?php echo base_url('api/api_shipping/method');?>',
    type: 'post',
    data: 'shipping_method=' + shipping_method,
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
        $('.page-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
       $("input:radio[name='shipping_method']").each(function(i) {
               this.checked = false;
        });
      }

      if (json['success']) {
        $('.page-content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        // Refresh products, vouchers and totals
        getCart();
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });

}
function setPaymentMethod(payment_method)
{
    $.ajax({
    url: '<?php echo base_url('api/api_payment/method');?>',
    type: 'post',
    data: 'payment_method=' + payment_method,
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
        $('.page-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }

      if (json['success']) {
        $('.page-content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
         

        // Refresh products, vouchers and totals
        getCart();
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
    
}

function getpaymentMethods(country_id)
{
    $.ajax({
          url: '<?php echo base_url('api/api_payment/methods/');?>'+country_id,
          type:'post',
          dataType: 'json',
          crossDomain: true,
          beforeSend: function() {
            $('#payment_method_list').html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        },
          complete: function() {
            $('#payment_method_list .fa-spin').remove();
          },
          success: function(json) {
            html='';
            if (json['error']) {
              $('.page-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            } else {
              if (json['payment_methods']) {
                for (i in json['payment_methods']) {
                    if (typeof(json['payment_methods'][i]['code']) != "undefined")
                    {
                       html += '<div class="radio">';
                        html += '<label for="payment_method' + i + '" class="payment_method">';
                        html += '<input id="payment_method' + i + '" name="payment_method" value="' + json['payment_methods'][i]['code'] + '"  type="radio" class="radio-button-payment-method" onclick=setPaymentMethod("' + json['payment_methods'][i]['code'] + '")>';
                        html += '<div class="row">';
                            html += '<div class="col-md-12 col-xs-12">';
                                html += '<span class="text">' + json['payment_methods'][i]['title'] + '';
                            html += '</div>';
                        html += '</div>';
                        html += '</label>';
                    html += '</div>';  
                    }
                  
                }
              }

              $('#payment_method_list').html(html);
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
        });

}

function getShippingMethods(country_id)
{
    $.ajax({
          url: '<?php echo base_url('api/api_shipping/methods/');?>'+country_id,
          dataType: 'json',
          beforeSend: function() {
            $('#shipping_method_list').html('<i class="fa fa-circle-o-notch fa-spin"></i>');

            
          },
          complete: function() {
            $('#shipping_method_list .fa-spin').remove();
            
          },
          success: function(json) {
            if (json['error']) {
              $('.page-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            } else {
              // Shipping Methods
              html ="";
              if (json['shipping_methods']) {
                for (i in json['shipping_methods']) {
                  

                  if (!json['shipping_methods'][i]['error']) {
                    for (j in json['shipping_methods'][i]['quote']) {

                        html += '<div class="">';
                                 html += '   <label for="shipping_method" class="shipping_method">';
                                  
                                   html += ' <div class="row">';
                                    html += '<div class="col-md-1 col-xs-1">';
                                             html += '<input id="shipping_method'+j+'" name="shipping_method" value="' + json['shipping_methods'][i]['quote'][j]['code'] + '" onclick=setShippingMethod("' + json['shipping_methods'][i]['quote'][j]['code'] + '") type="radio">';
                                        html += '</div>';
                                        html += '<div class="col-md-7 col-xs-7">';
                                            html += '<span class="text">' + json['shipping_methods'][i]['quote'][j]['title'] + '</span>';
                                        html += '</div>';
                                        html += '<div class="col-md-4 col-xs-4 text-center">';
                                            html += '<span class="price">' + json['shipping_methods'][i]['quote'][j]['text'] + '</span>';
                                        html += '</div>';
                                    html += '</div>';
                                    html += '</label>';
                                html += '</div>';


                     
                    }
                  } 
                 
                }
              }

              $('#shipping_method_list').html(html);
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
        });
}

getpaymentMethods('<?php echo $country_id;?>');

getShippingMethods('<?php echo $country_id;?>');

// Refresh products, vouchers and totals
getCart();

$( "#collapse-shipping-address").hide();
</script>