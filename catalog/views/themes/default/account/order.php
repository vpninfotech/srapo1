<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
        </div>
        <!-- ./breadcrumb -->
        
<div class="page-content">
    <?php if(isset($error_warning) && $error_warning!==""): ?>
            <div class="alert alert-danger alert-bold-border">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px;font-size:20px">×</button><i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error_warning;?> 
            </div>
        <?php endif; ?>
        <?php if(isset($success) && $success!==""): ?>
            <div class="alert alert-success alert-bold-border">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px;font-size:20px">×</button><i class="fa fa-check-circle"></i>&nbsp;<?php echo $success;?> 
            </div>
        <?php endif; ?>
            <h4 class="account-title">Order Information</h4>
            <br>           
            <div class="table-responsive">
                <table class="table table-bordered cart_summary list">
                  <thead>
                    <tr>
                    <td class="text-left">Order Details</td>
                    <td class="text-left">
                        <?php if ($order_cancel != 'canceled') {?>
                        <a class="btn btn-danger btn-action btn-info-custom" data-tv-cancel-order="" href="<?php echo $order_cancel; ?>" data-toggle="tooltip" title="" data-original-title="Cancel order">Cancel</a>
                        <?php } ?>
                    </td>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <tr>                        
                        <td class="text-left" style="width:50%;">
                            <?php if ($invoice_no) { ?>
                                <b>Invoice No.:</b><?php echo $invoice_no; ?><br>
                            <?php } ?>
                            <b>Order ID:</b> #<?php echo $order_id; ?><br>
                            <b>Date Added:</b> <?php echo $date_added; ?>
                        </td>
                        <td class="text-left">
                            <?php if ($payment_method) { ?>
                                <b>Payment Method:</b> <?php echo $payment_method; ?> <br>
                            <?php } ?>
                            <?php if ($shipping_method) { ?>
                                <b>Shipping Method:</b> <?php echo $shipping_method; ?> <br>
                            <?php } ?>
                        </td>
                    </tr>
                  </tbody>
                </table>
                </div>
                <br>
                <div class="table-responsive">
                <table class="table table-bordered cart_summary list">
                  <thead>
                    <tr>
                    <td class="text-left" style="width: 50%;">Payment Address</td>
                    <?php if ($shipping_address) { ?>
                    <td class="text-left" style="width: 50%;">Shipping Address</td>
                    <?php } ?>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <tr>
                        <td class="text-left" style="width:50%;">
                            <?php foreach($payment_address as $pay_address) {?>
                                <?php if($pay_address['name']) {?>
                                <?php echo $pay_address['name']; ?>
                                <br>
                                <?php } ?>
                                
                                <?php if($pay_address['company']) {?>
                                <?php echo $pay_address['company']; ?>
                                <br>
                                <?php } ?>
                                
                                <?php if($pay_address['address_1']) {?>
                                <?php echo $pay_address['address_1']; ?>
                                <br>
                                <?php } ?>
                                
                                <?php if($pay_address['address_2']) {?>
                                <?php echo $pay_address['address_2']; ?>
                                <br>
                                <?php } ?>
                                
                                <?php if($pay_address['city']) {?>
                                <?php echo $pay_address['city']." ".$pay_address['postcode']; ?>
                                <br>
                                <?php } ?>
                                
                                <?php if($pay_address['state_id']) {?>
                                <?php echo $pay_address['state_id']; ?>
                                <br>
                                <?php } ?>
                                
                                <?php if($pay_address['country_id']) {?>
                                <?php echo $pay_address['country_id']; ?>
                                <br>
                                <?php } ?>
                            <?php } ?>
                        </td>
                        <?php if ($shipping_address) { ?>
                        <td class="text-left" style="width:50%;">
                            <?php foreach($shipping_address as $ship_address) {?>
                                <?php if($ship_address['name']) {?>
                                <?php echo $ship_address['name']; ?>
                                <br>
                                <?php } ?>
                                
                                <?php if($ship_address['company']) {?>
                                <?php echo $ship_address['company']; ?>
                                <br>
                                <?php } ?>
                                
                                <?php if($ship_address['address_1']) {?>
                                <?php echo $ship_address['address_1']; ?>
                                <br>
                                <?php } ?>
                                
                                <?php if($ship_address['address_2']) {?>
                                <?php echo $ship_address['address_2']; ?>
                                <br>
                                <?php } ?>
                                
                                <?php if($ship_address['city']) {?>
                                <?php echo $ship_address['city']." ".$ship_address['postcode']; ?>
                                <br>
                                <?php } ?>
                                
                                <?php if($ship_address['state_id']) {?>
                                <?php echo $ship_address['state_id']; ?>
                                <br>
                                <?php } ?>
                                
                                <?php if($ship_address['country_id']) {?>
                                <?php echo $ship_address['country_id']; ?>
                                <br>
                                <?php } ?>
                            <?php } ?>
                        </td>
                        <?php } ?>
                    </tr>
                  </tbody>
                </table>
                </div>
                
                
                <br>
                
                
                
                
                <div class="table-responsive">
                <table class="table table-bordered cart_summary list">
                  <thead>
                    <tr>
                    <td class="text-center">Product Image</td>
                    <td class="text-left">Product Name</td>
                    <td class="text-left">Model</td>
                    <!--<td class="text-left">Brand</td>-->
                    <td class="text-right">Quantity</td>
                    <td class="text-right">Price</td>
                    <td class="text-right">Total</td>
                    <?php if ($order_cancel != 'canceled') {?>
                    <td class="text-right">Action</td>
                    <?php } ?>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php 
                        //echo "<pre>";
                        //print_r($products);
                    ?>
                    <?php foreach ($products as $product) { ?>
                    <tr>
                        <td class="text-center"><img class="img-small img-thumbnail" src="<?php echo $product['image']; ?>"></td>
                        <td>
                            <?php echo $product['name']; ?>
                            <?php foreach ($product['option'] as $option) { ?>
                            <br>
                            &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                            <?php } ?>
                        </td>
                    	
                        <td class="text-left"><?php echo $product['model']; ?></td>
                        <!--<td class="text-left">ABC</td>-->
                        <td class="text-right"><?php echo $product['quantity']; ?></td>
                        <td class="text-right"><?php echo $product['price']; ?></td>
                        <td class="text-right"><?php echo $product['total']; ?></td>
                        <?php if ($order_cancel != 'canceled') {?>
                        <td class="text-right">
                        	<a class="btn btn-primary btn-margin btn-action btn-reorder-custom" href="<?php echo $product['reorder']; ?>" data-toggle="tooltip" title="" data-original-title="Reorder"><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-danger btn-margin btn-action btn-info-custom" href="<?php echo $product['return'] ?>" data-toggle="tooltip" title="" data-original-title="Return"><i class="fa fa-reply"></i></a>
                         </td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                    
                    <?php foreach ($vouchers as $voucher) { ?>
                        <tr>
                            <td class="text-center"><img class="img-small img-thumbnail" src="<?php echo $voucher['image']; ?>" alt="gift_voucher"/></td>
                            <td class="text-left"><?php echo $voucher['description']; ?></td>
                            <td class="text-left"></td>
                            <td class="text-right">1</td>
                            <td class="text-right"><?php echo $voucher['amount']; ?></td>
                            <td class="text-right"><?php echo $voucher['amount']; ?></td>
                            <?php if ($products) { ?>
                            <td></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                      <?php foreach ($totals as $total) { ?>
                      <tr>
                            <td colspan="4"></td>
                            <td class="text-right"><b><?php echo $total['title']; ?></b></td>
                            <td class="text-right"><?php echo $total['text']; ?></td>
                            <?php if ($products) { ?>
                            <td></td>
                            <?php } ?>
                      </tr>
                      <?php } ?>
                  </tfoot>
                </table>
                </div>
                <?php if ($comment) { ?>
                <div class="table-responsive">
                    <table class="table table-bordered cart_summary list">
                        <thead>
                          <tr>
                            <td class="text-left">Order Comments</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-left"><?php echo $comment; ?></td>
                          </tr>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
                <?php if ($histories) { ?>
                <h4 class="account-title">Order History</h4>
                <br>
                <div class="table-responsive">
                <table class="table table-bordered cart_summary list">
                  <thead>
                    <tr>
                    <td class="text-left">Date Added</td>
                    <td class="text-left">Order Status</td>
                    <td class="text-left">Comment</td>
                    </tr>
                  </thead>
                  
                  <tbody>
                      <?php if ($histories) { ?>
                      <?php foreach($histories as $history) { ?>
                      <tr>
                        <td class="text-left"><?php echo $history['date_added']; ?></td>
                        <td class="text-left"><?php echo $history['status']; ?></td>
                        <td class="text-left"><?php echo $history['comment']; ?></td>
                      </tr>
                      <?php } ?>
                      <?php } else { ?>
                        <tr>
                            <td colspan="3" class="text-center">No result found!</td>
                        </tr>
                      <?php } ?>
                  </tbody>
                </table>
                   
                </div>
                 <?php } ?>
                <div class="buttons">
                    <div class="pull-right">
                        <a class="btn btn-primary button btn-continue" href="<?php echo site_url('account/order'); ?>">Back</a>
                    </div>
                </div>
                

            </div></div></div>