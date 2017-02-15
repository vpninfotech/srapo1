<style>
    .order_success p {
        margin: 0 0 10px;
    }
</style>
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
        <!-- Start : page heading-->
        <div class="page-content order_success">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $text_message; ?>
                </div>
            </div>
        </div>
        <!-- End : page heading-->
        <div class="buttons">
            <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-quantity"><?php echo $button_continue; ?></a></div>
        </div>
    </div>
</div>