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
            <span class="page-heading-title2"><?php echo $heading_title; ?></span>
        </h2>
        <!-- ../page heading-->
        <div class="page-content">
            <?php if (isset($error_warning) && $error_warning !== ""): ?>

                <div class="alert alert-danger alert-bold-border">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px;font-size:20px">×</button>
                    <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error_warning; ?> </div>

            <?php endif; ?>
            <?php if (isset($success) && $success !== ""): ?>

                <div class="alert alert-success alert-bold-border">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px;font-size:20px">×</button>
                    <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success; ?> </div>

            <?php endif; ?>
            <div class="table_scroll">
                <?php if ($products) { ?>
                <table class="table table-bordered table-compare">
                    <thead>
                        <tr>
                            <td colspan="<?php echo count($products) + 1; ?>"><strong><?php echo $text_product; ?></strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Product</td>
                            <?php foreach($products as $product) { ?>
                            <td><a href="<?php echo $product['href']; ?>"><strong><?php echo $product['name']; ?></strong></a></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Image</td>
                            <?php foreach($products as $product) { ?>
                            <td class="text-center">
                                <?php if ($product['thumb']) { ?>
                                <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumbnail" />
                                <?php } ?>
                            </td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <?php foreach($products as $product) { ?>
                            <td>
                            <?php if ($product['price']) { ?>
                                <?php if (!$product['special']) { ?>
                                     <?php echo $product['price']; ?>
                                <?php } else { ?>
                                    <strike><?php echo $product['price']; ?></strike> <?php echo $product['special']; ?>
                                <?php } ?>
                            <?php } ?>
                            </td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Model</td>
                            <?php foreach($products as $product) { ?>
                            <td><?php echo $product['model']; ?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Availability</td>
                            <?php foreach($products as $product) { ?>
                            <td><?php echo $product['availability']; ?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Rating</td>
                            <?php foreach($products as $product) { ?>
                            <td class="product-star">
                            <?php if ($product['rating']) { ?>
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <?php if ($product['rating'] < $i) { ?>
                                        <i class="fa fa-star-o"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-star"></i>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            <br />
                            <?php echo $product['reviews']; ?>
                            </td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Summery</td>
                            <?php foreach($products as $product) { ?>
                            <td><?php echo $product['description']; ?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Weight</td>
                            <?php foreach($products as $product) { ?>
                            <td><?php echo $product['weight']; ?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Dimensions(L x W x H)</td>
                            <?php foreach($products as $product) { ?>
                            <td><?php echo $product['length']; ?> x <?php echo $product['width']; ?> x <?php echo $product['height']; ?></td>
                            <?php } ?>
                        </tr>
                    </tbody>
                    
                    <?php foreach ($attribute_groups as $attribute_group) { ?>
                    <thead>
                        <tr>
                            <td colspan="<?php echo count($products) + 1; ?>"><strong><?php echo $attribute_group['name']; ?></strong></td>
                        </tr>
                    </thead>
                    <?php foreach ($attribute_group['attribute'] as $key => $attribute) { ?>
                    <tbody>
                        <tr>
                            <td><?php echo $attribute['name']; ?></td>
                            <?php foreach ($products as $product) { ?>
                                <?php if (isset($product['attribute'][$key])) { ?>
                                    <td><?php echo $product['attribute'][$key]; ?></td>
                                <?php } else { ?>
                                    <td></td>
                                <?php } ?>
                            <?php } ?>
                        </tr>
                    </tbody>
                    <?php } ?>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <?php foreach ($products as $product) { ?>
                            <td><input type="button" value="Add to Cart" class="btn btn-quantity btn-block" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');" /><a href="<?php echo $product['remove']; ?>" class="btn btn-danger btn-block" style="border-radius:0px;">Remove</a></td>
                        <?php } ?>
                    </tr>
                </table>
                <?php } else { ?>
                    <p><?php echo $text_empty; ?></p>
                    <div class="buttons">
                        <div class="pull-right">
                            <a class="btn btn-primary button btn-continue" href="<?php echo site_url('common/home'); ?>">Back</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>