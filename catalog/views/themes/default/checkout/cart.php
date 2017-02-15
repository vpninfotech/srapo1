<!-- page wapper-->
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
        </div>
        <!-- ./breadcrumb -->
        <?php if ($attention) { ?>
  <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $attention; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
        <!-- page heading-->
        <h2 class="page-heading no-line">
            <span class="page-heading-title2"><?php echo $heading_title; ?>
        <?php if ($weight) { ?>
        &nbsp;(<?php echo $weight; ?>)
        <?php } ?></span>
        </h2>
        <!-- ../page heading-->
        <div class="page-content page-order">
            <!--<ul class="step">
                <li class="current-step"><span>01. Summary</span></li>
                <li><span>02. Sign in</span></li>
                <li><span>03. Address</span></li>
                <li><span>04. Shipping</span></li>
                <li><span>05. Payment</span></li>
            </ul>-->
            <div class="heading-counter warning">Your shopping cart contains:
                <span><?php echo count($products);?> Product</span>
            </div>
            <div class="order-detail-content">
             <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <table class="table table-bordered table-responsive cart_summary">
                    <thead>
                        <tr>
                            <th class="cart_product"><?php echo $column_image; ?></th>
                            <th><?php echo $column_name; ?></th>
                            <th><?php echo $column_model; ?></th>
                            <th><?php echo $column_quantity; ?></th>
                            <th><?php echo $column_price; ?></th>
                            <th><?php echo $column_total; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($products as $product) { ?>
                        <tr>
                            <td class="cart_product"><?php if ($product['thumb']) { ?>
                                <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"></a>
                             <?php } ?></td>
                            <td class="cart_description">
                            <?php if($product['catalog_product']==1){ ?>
                                <p class="product-name"><a><?php echo $product['name']; ?></a><?php } else { ?><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a><?php } ?><?php if (!$product['stock']) { ?>
                  <span class="text-danger">***</span>
                  <?php } ?>
                  <?php if ($product['option']) { ?>
                  <?php foreach ($product['option'] as $option) { ?>
                  <br />
                  <small><?php echo ucfirst($option['name'])?>: <?php echo ucfirst($option['value']); ?></small><br>
                  <?php } ?>
                  <?php } ?></p>
                            </td>
                            <td class="qty"><?php echo $product['model']; ?></td>
                           
                            <td class="qty text-center"  style="min-width: 200px;">
                            <input class="form-control input-sm qty-text" type="text" name="quantity[<?php echo $product['cart_id']; ?>]" value="<?php echo $product['quantity']; ?>" id="number" />
                            	<button class="btn btn-quantity" type="submit" data-toggle="tooltip" title="<?php echo $button_update; ?>"><i class="fa fa-refresh"></i></button>
                                
                                <button class="btn btn-quantity" data-toggle="tooltip" title="<?php echo $button_remove; ?>" onclick="cart.remove('<?php echo $product['cart_id']; ?>');" ><i class="fa fa-times-circle"></i></button>
                            </td>
                             <td class="price"><span><?php echo $product['price']; ?></span></td>
                            <td class="price">
                                <span><?php echo $product['total']; ?></span>
                            </td>
                            
                        </tr>
                        <?php } ?>
                        <?php foreach ($vouchers as $voucher) { ?>
              <tr>
                <td></td>
                <td class="text-left"><?php echo $voucher['description']; ?></td>
                <td class="text-left"></td>
                <td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
                    <input type="text" name="" value="1" size="1" disabled="disabled" class="form-control" />
                    <span class="input-group-btn">
                    <button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" onclick="voucher.remove('<?php echo $voucher['key']; ?>');"><i class="fa fa-times-circle"></i></button>
                    </span></div></td>
                <td class="text-right"><?php echo $voucher['amount']; ?></td>
                <td class="text-right"><?php echo $voucher['amount']; ?></td>
              </tr>
              <?php } ?>
                    </tbody>
                    <tfoot>
                     <?php foreach ($totals as $total) { ?>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2"><?php echo $total['title']; ?>:</td>
                            <td colspan="2"><?php echo $total['text']; ?></td>
                        </tr>
                     <?php } ?>
                    </tfoot>    
                </table>
                 </form>
                <div class="cart_navigation">
                    <a class="prev-btn" href="<?php echo $continue; ?>"><?php echo $button_shopping; ?></a>
                     <?php 
                    if($this->customer->isLogged())
                    {
                      ?>
                      <a class="next-btn" href="<?php echo $checkout; ?>"><?php echo $button_checkout; ?></a>
                   <?php
                    }
                    else
                    {
                      ?>
                      <a data-toggle="modal" data-target="#login_model" class="next-btn"> <?php echo $button_checkout; ?></a>
                   <?php }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ./page wapper-->