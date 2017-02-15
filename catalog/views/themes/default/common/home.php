<link rel="stylesheet" type="text/css" href="<?php echo CATALOG_PATH;?>lib/jquery.bxslider/jquery.bxslider.css" />
	<?php echo $this->load->get_section('slider');?>
    <!-- End: Content-top  -->
    <div class="content-top">
    	<?php echo $this->load->get_section('content_top');?>
    </div>
    <!-- End: Content-top  -->
    
    <!-- Start: Main Content  -->
    <div class="content-page">
    	<div class="container">
        	<?php echo $this->load->get_section('content');?>
    	</div>
    </div>
    <!-- End: Main Content  -->
    
    <!-- Start: Content-bottom  -->
    <div class="content-bottom">
     	<?php echo $this->load->get_section('content_bottom');?>
    </div>
    <!-- Start: Content-bottom  -->   
<!--Bootstrap Main Js-->
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>lib/jquery.bxslider/jquery.bxslider.js"></script>
