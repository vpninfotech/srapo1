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
            <h4 class="account-title"><?php echo $heading_title; ?></h4>
            <p class="form-group" style="margin: 10px 0px 10px; color: #666;"><?php echo $text_error; ?></p>
                
                <div class="buttons">
                    <div class="pull-right">
                        <a class="btn btn-primary button btn-continue" href="<?php echo $back; ?>">Back</a>
                    </div>
                </div>
            </div></div></div>