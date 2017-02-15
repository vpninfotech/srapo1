<div class="columns-container">
   <div class="container" id="columns"> 
      <!-- breadcrumb -->
      <div class="breadcrumb clearfix">
         <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
         </ul>
      </div>
      <!-- ./breadcrumb -->
      <?php if ($success) { ?>
      <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
         <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
      <?php } ?>
      <!-- page heading-->
      <h2 class="page-heading no-line"> <span class="page-heading-title2"><?php echo $heading_title; ?></span> </h2>
      <!-- ../page heading-->
      <div class="page-content page-order">
         <div class="order-detail-content">
            <?php if ($products) { ?>
            <table class="table table-bordered table-responsive cart_summary">
               <thead>
                  <tr>
                     <td class="text-center"><?php echo $column_image; ?></td>
                     <td class="text-left"><?php echo $column_name; ?></td>
                     <td class="text-left"><?php echo $column_model; ?></td>
                     <td class="text-right"><?php echo $column_stock; ?></td>
                     <td class="text-right"><?php echo $column_price; ?></td>
                     <td class="text-right"><?php echo $column_action; ?></td>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($products as $product) { ?>
                  <tr>
                     <td class="cart_product"><?php if ($product['thumb']) { ?>
                        <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a> <?php } ?></td>
                     <td class="cart_description"><p class="product-name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></p></td>
                     <td class="qty text-center"><span><?php echo $product['model']; ?></span></td>
                     <td class="price"><span><?php echo $product['stock']; ?></span></td>
                     <td class="price"><?php if ($product['price']) { ?>
                        <div class="price">
                           <?php if (!$product['special']) { ?>
                           <?php echo $product['price']; ?>
                           <?php } else { ?>
                           <b><?php echo $product['special']; ?></b> <s><?php echo $product['price']; ?></s>
                           <?php } ?>
                        </div>
                        <?php } ?></td>
                     <td class="qty text-center"><button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');" data-toggle="tooltip" title="<?php echo $button_cart; ?>" class="btn btn-quantity"><i class="fa fa-shopping-cart"></i></button>

                     
                        <a href="<?php echo $product['remove']; ?>" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-quantity"> <i class="fa fa-close"></i></a></td>
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
            <?php } else { ?>
            <p><?php echo $text_empty; ?></p>
            <?php } ?>
            <div class="cart_navigation"> <a class="next-btn" href="<?php echo $continue; ?>"><?php echo $button_continue; ?></a> </div>
         </div>
      </div>
   </div>
</div>
