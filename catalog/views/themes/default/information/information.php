<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <!--<div class="column col-xs-12 col-sm-3" id="left_column">
                <!-- block category -->
                <!--<div class="block left-module">
                    <p class="title_block"><?php echo $heading_title; ?></p>
                    <div class="block_content">
                        <!-- layered -->
                        <?php //echo $description; ?>
                        <!-- ./layered -->
                    <!--</div>
                </div>
                <!-- ./block category  -->
                <!-- Banner silebar -->
                <!--<div class="block left-module text-center">
                    <div class="banner-opacity">
                        <a href="#"><img src="images/slide-left.jpg" alt="ads-banner"></a>
                    </div>
                </div>
                <!-- ./Banner silebar -->
            <!--</div>-->
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-12" id="center_column">
                <!-- page heading-->
                <h2 class="page-heading">
                    <span class="page-heading-title2"><?php echo $heading_title; ?></span>
                </h2>
                <!-- Content page -->
                <div class="content-text clearfix">
                    <?php echo $description; ?>
                </div>
                <!-- ./Content page -->
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>
