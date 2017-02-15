<!DOCTYPE html>
<html>
<head>
	<!-- Meta Tag -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $header['title']; ?></title>
    <base href="<?php echo $header['base']; ?>" />
    <?php if ($header['description']) { ?>
        <meta name="description" content="<?php echo $header['description']; ?>" />
    <?php } ?>
    <?php if ($header['keywords']) { ?>
        <meta name="keywords" content= "<?php echo $header['keywords']; ?>" />
    <?php } ?>
    <!-- /meta Tag -->
   
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="<?php echo $header['favicon']; ?>"/>
    <!-- /favicon -->
	
    <!-- Global stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo CATALOG_PATH;?>lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo CATALOG_PATH;?>lib/font-awesome/css/font-awesome.min.css" />
     <link rel="stylesheet" type="text/css" href="<?php echo CATALOG_PATH;?>lib/jquery-ui/jquery-ui.css" />
     <link rel="stylesheet" type="text/css" href="<?php echo CATALOG_PATH;?>
css/reset.css" />
<!-- PNOTIFY -->
 <link rel="stylesheet" type="text/css" href="<?php echo CATALOG_PATH;?>lib/pnotify/src/pnotify.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo CATALOG_PATH;?>lib/pnotify/src/pnotify.brighttheme.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo CATALOG_PATH;?>lib/pnotify/src/pnotify.mobile.css" />   
    <link rel="stylesheet" type="text/css" href="<?php echo CATALOG_PATH;?>
css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo CATALOG_PATH;?>css/responsive.css" />
    <!-- /global stylesheets -->
	 
    <!-- Common Page stylesheets -->
	<link rel="stylesheet" type="text/css" href="<?php echo CATALOG_PATH;?>lib/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo CATALOG_PATH;?>lib/jquery.bxslider/jquery.bxslider.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo CATALOG_PATH;?>lib/owl.carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo CATALOG_PATH;?>lib/fancyBox/jquery.fancybox.css" />
    <!-- Common Page stylesheets -->
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>lib/jquery/jquery-1.11.2.min.js"></script> 
 <link rel="stylesheet" type="text/css" href="<?php echo CATALOG_PATH;?>lib/bootcomplete/bootcomplete.css" />
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>lib/bootcomplete/jquery.bootcomplete.js"></script> 
<style>
//pnotify
.ui-pnotify-title {
  font-weight: 700;
  font-style: normal;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 1px;
  background-color: #DE0E5C !important;
  color: #FFFFFF;
}
.ui-pnotify-closer {
    color: #000000;
 }

 
.list_item_container {
    width:auto;
    height: 60px;
    padding: 5px 0;
    color: red;
}
.image {
    width: 60px;
    height: 60px;
    margin-right: 10px;
    float: left;
}
.description {
    font-style: italic;
    font-size: 0.8em;
    color: gray;
}
.label
{
    color: #DE0E5C !important;
}
</style> 
</head>
<body class="home">

    <!-- Start: Header  -->
    <div id="header" class="header" >
        <?php $this->load->view('themes/default/common/top-bar');?>
        <?php $this->load->view('themes/default/common/header');?>
        <?php $this->load->view('themes/default/common/main-menu');?>
    </div>
    <!-- End: Header  -->
    
    <!-- Start: Main Content  -->
    <div class="main-content">
     <?php echo $output; ?>
    </div>
    <!-- End: Main Content  -->
    
    <!-- Start: Footer  -->
	<?php $this->load->view('themes/default/common/footer');?>
    <!-- End: Footer  -->
    
    <!-- Start: Scroll To Top  -->
	<a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">
    	Scroll
    </a>
	<!-- End: Scroll To Top  -->
<script>
var baseurl = "<?php print base_url(); ?>"; 
</script>
<!-- Global JS files -->

<script type="text/javascript" src="<?php echo CATALOG_PATH;?>lib/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>lib/slimScroll/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>js/jquery.actual.min.js"></script>
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>js/common.js"></script>
<!-- /global JS files -->

<!-- Common Js stylesheets -->
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>lib/jquery.bxslider/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>lib/owl.carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>lib/jquery.countdown/jquery.countdown.min.js"></script>
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>lib/select2/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>lib/fancyBox/jquery.fancybox.js"></script>
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>
js/theme-script.js"></script>
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>lib/jquery.elevatezoom.js"></script>
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>lib/pnotify/src/pnotify.js"></script> 
<script type="text/javascript" src="<?php echo CATALOG_PATH;?>lib/pnotify/src/pnotify.mobile.js"></script> 
<!-- /Common Js stylesheets -->
<!-- color selection script -->
<script>var selector = '.list-color li';
$(selector).on('click', function(){
    $(selector).removeClass('active');
    $(this).addClass('active');
});



</script>
<script type="text/javascript">
    $('#search_product').bootcomplete({
        url:'<?=base_url('product/search/autocomplete')?>'
    });
	
</script>
</body>
</html>