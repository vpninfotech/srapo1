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
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-12" id="center_column">
                <!-- page heading-->
                <h2 class="page-heading">
                    <span class="page-heading-title2">Site Map</span>
                </h2>
                <!-- Content page -->
                <div class="row">
                    <div class="col-sm-6 site_map">
                        <ul>
                            <?php foreach ($header['categories'] as $category_1) { ?>
                            <li>
                                <a href="<?php echo $category_1['href']; ?>"><?php echo $category_1['name']; ?></a>
                                <?php if ($category_1['children']) { ?>
                                <ul>
                                    <?php foreach ($category_1['children'] as $category_2) { ?>
                                    <li>
                                        <a href="<?php echo $category_2['href']; ?>"><?php echo $category_2['name']; ?></a>
                                        <?php if ($category_2['children']) { ?>
                                        <ul>
                                            <?php foreach ($category_2['children'] as $category_3) { ?>
                                            <li>
                                                <a href="<?php echo $category_3['href']; ?>"><?php echo $category_3['name']; ?></a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                        <?php } ?>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <?php } ?>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col-sm-6 site_map">
                        <ul>
                            <li>
                                Information
                                <ul>
                                    <?php foreach ($header['informations'] as $information) { ?>
                                    <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>   
                                    <?php } ?>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ./Content page -->

            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>