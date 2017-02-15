<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Srapo</title>
    <!-- Animation CSS -->
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/css/animate.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/css/style.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/lib/owl/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/lib/owl/owl.theme.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top"><img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/img/srapos.png" width="150px"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <!--<li class="hidden">
                        <a href="#page-top"></a>
                    </li>-->
                    <li class="page-scroll">
                        <a href="#page-top">Home</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#work">How it Works</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">ABOUT</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#faq">BENEFIT</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container-fluid bg-img animated fadeIn">
            <div class="row">
            	<div class="col-md-12">
            	<h3 class="page-heading">
                <span class="page-heading-title2">Register / Login</span>
                </h3>
                </div>
                <div class="col-lg-6">
                    <div class="box-authentication">
                    	<h2 class="text-center">A new Way Off selling More!</h2>
                        
                    <div class="intro-text">
                        <!--<hr class="star-light">-->
                        <span class="skills text-center">
                        	A New and Faster Way of Growing your Sales you’re in driving seat, now determine the number of sales you make.
                            <img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/banner.png">
                        </span>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6 animated fadeInRight" id="register-form">
                    <div class="box-authentication custom-box-authentication register-form">
                    <form action="<?php echo base_url('common/register/add');?>" method="post" id="form_register" name="form_register">
                        <h3>Register Today</h3>
                        <h5>Already have an account ?  <a href="<?php echo base_url('common/login');?>" class="login">Login</a>  from here.</h5>
                        <div class="row">
                            <?php if(isset($error) && $error!==""): ?>
                              <div class="alert alert-danger alert-bold-border">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
                                
                                   <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error;?>
                                
                              </div>
                              <?php endif; ?>
                               <?php if(isset($success) && $success!==""): ?>
                              <div class="alert alert-success alert-bold-border">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
                                
                                  <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success;?>
                                
                              </div>
                              <?php endif; ?>
                        </div>
                        <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input id="firstname" name="firstname" data-rules-required="true" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input id="lastname" name="lastname" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                        <label for="email">Email address</label>
                        <input id="email" name="email" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" class="form-control">
                        </div>
                        <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input id="confirm_password" name="confirm_password" type="password" class="form-control">
                        </div>
                        <div class="form-group">
                        
                        <input id="condition" class="inline-checkbox" name="condition" type="Checkbox">
						Accept
						<a href="#" title="Terms & Conditions" target="_blank"  data-toggle="modal" data-target="#terms" class="terms">Terms & Conditions.</a>
                        </div>
                        <div class="form-group">
                        <button type="submit" id="btn-submit" name="form-submit" class="button"><i class="fa fa-lock"></i> Submit</button>
                        </div>
                      </form>  
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="work">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>How it Works</h2>
                    <!--<hr class="star-primary">-->
                    <p class="work-desc">Easy steps to be a part of Srapo, start selling with us. </p>
                </div>
                
                <div class="col-lg-12 text-center">
                    <div class="frame" id="story-board">
                        <ul class="clearfix">
                            <li id="step-1">
                                <img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/img/process.png">
                            </li>
                            <li></li>
                            <li></li>
                            <li></li>
                            
                            
                        </ul>
                    </div>
                    <!-------------------------------------------------------------------------- -->
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8">
                            <div class="row">
                                <div class="col-md-offset-1 col-sm-offset-1 col-md-10 col-sm-10">
                                    <div class="scrollbar">
                                        <div class="handle">
                                            <div class="mousearea"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center">
                            	<div class="col-md-offset-1 col-sm-offset-1">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <span class="step_name" id="0">Register</span>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <span class="step_name" id="1">Upload</span>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <span class="step_name" id="2">Order Process</span>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <span class="step_name" id="3">QA & Feedback</span>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
            
            
            
        </div>
    </section>
    
    
    
    
    
    

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About Srapo</h2>
                    <!--<hr class="star-light">-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 about_desc">
                    <p>Srapo.com is a simple concept, an innovative way in online shopping. Ultimately the goal is to save you the buyer money but also to provide a Manufacture platform to excel their business in. We would call this a healthy relationship but inevitably we called it srapo.com</p>

					<p>In Few Days Our website is available to you via home computers, laptops and all smart devices however in the First quarter of 2017. we will be introducing the Srapo app for both apple and google play app stores and yes it will be free.
</p>
                </div>
                
               <!-- <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="#" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Read More
                    </a>
                </div>-->
            </div>
            
        </div>
    </section>
    
    
    
    
    <!-- About Section -->
    <section class="faq animated fadeInRight" id="faq">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>MANUFACTURE'S BENEFIT</h2>
                    <!--<hr class="star-primary">-->
                </div>
            </div>
            <div class="row faq-content">
                <div class="col-lg-6">
                	<img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/verify-user.png">
                	<h4>Our 100% customers are verified </h4>
                    
                    <img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/payment.png">
                    <h4>No Wait For Payment more days</h4>
                    
                </div>
                
                <div class="col-lg-6">
                	<img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/wait.png">
                	<h4>No Wait for customers and Orders</h4>
                    
                    <img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/return.png">
                    <h4>No Return Policy*</h4>
                    
                </div>
                
                <!--<div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="#" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Read More
                    </a>
                </div>-->
            </div>
           
            
            
            
        </div>
    </section>

    
    
    <section class="documents" id="docs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Registration NEEDS?</h2>
                    <!--<hr class="star-primary">-->
                </div>
                <div class="col-md-12 text-center">
                    <h4>Register in less than 10 Minutes.</h4>
                </div>
            </div>
            <div class="row registration">
            	
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="square">
                    	<img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/user.png">
                    	
                    </div>
                    <h3>Register ID</h3>
                </div>
                
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="square">
                    	<img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/vat.png">
                    	
                    </div>
                    <h3>VAT ID</h3>
                </div>
                <!--<div class="col-md-2">
                    <div class="plus text-center">
                    	<img src="img/plus.png">
                    </div>
                </div>-->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="square">
                    	<img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/pan.png">
                    	
                    </div>
                    <h3>PANCARD</h3>
                </div>
                <!--<div class="col-md-2">
                   <div class="plus text-center">
                    	<img src="img/plus.png">
                    </div>
                </div>-->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="square">
                    	<img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/bank.png">
                    	
                    </div>
                    <h3>BANK DETAIL</h3>
                </div>
                
                
               <!-- <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="#" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Read More
                    </a>
                </div>-->
            </div>
            
        </div>
    </section>
    
    
    <section class="partner">
    
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
            	<div class="col-md-12 text-center">
                    <h2 class="channel">Our Channel Partner's</h2>
                    <!--<hr class="star-primary">-->
                </div>
                <div id="owl-demo">
                          
                  <div class="item"><img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/mayloz.png" alt="Owl Image"></div>
                  <div class="item"><img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/kabirking.png" alt="Owl Image"></div>
                  <div class="item"><img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/maylozbiz.png" alt="Owl Image"></div>
                  <div class="item"><img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/kanchan.png" alt="Owl Image"></div>
                  <div class="item"><img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/mayloz.png" alt="Owl Image"></div>
                  <div class="item"><img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/kabirking.png" alt="Owl Image"></div>
                  <div class="item"><img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/maylozbiz.png" alt="Owl Image"></div>
                  <div class="item"><img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/kanchan.png" alt="Owl Image"></div>
                 
                </div>
            </div>
        </div>
    </div>

    </section>

    <!-- Footer -->
   	<section id="footer">
    	<div class="container">
        	<div id="introduce-box" class="row">
            
              <div class="col-md-3">
                <div id="address-box">
                    <a href="#"><img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$admin_theme;?>/img/logo.png" alt=""></a>
                    <!--<div id="address-list">
                        <div class="tit-name">Address:</div>
                        <div class="tit-contain">Example Street 68, Mahattan, New York, USA.</div>
                        <div class="tit-name">Phone:</div>
                        <div class="tit-contain">+00 123 456 789</div>
                        <div class="tit-name">Email:</div>
                        <div class="tit-contain">support@business.com</div>
                    </div>-->
                </div>
              </div>
              
              <div class="col-md-6">
				<div class="row">
                	<div class="col-xs-6 col-sm-4 col-md-4">
						<div class="introduce-title">Company</div>
                        <ul id="introduce-company" class="introduce-list">
                            <li><a href="#">Shipping</a></li>
                            <li><a href="#">Return</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Delivery Info</a></li>
                            <li><a href="#">Sitemap</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-4">
						<div class="introduce-title">My Account</div>
                        <ul id="introduce-company" class="introduce-list">
                            <li><a href="#">My Order</a></li>
                            <li><a href="#">My Wishlist</a></li>
                            <li><a href="#">My Credit Slip</a></li>
                            <li><a href="#">My Address</a></li>
                            <li><a href="#">My Personal In</a></li>
                        </ul>
                    </div>
                    <!--<div class="clearfix footer-adjust"></div>-->
                    <div class="col-xs-6 col-sm-4 col-md-4">
						<div class="introduce-title">Support</div>
                        <ul id="introduce-company" class="introduce-list">
                            <li><a href="#">About us</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Payment</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Contact us</a></li>
                        </ul>
                    </div>
                </div>
              </div>
              
              <div class="col-md-3">
                <div id="contact-box">
                <div class="introduce-title">Newsletter</div>
                </div>
                <div id="mail-box" class="input-group">
                    <input placeholder="Your Email Address" type="text">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">OK</button>
                    </span>
                </div>
                <div class="introduce-title">Let's Socialize</div>
                <div class="social-link">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-pinterest-p"></i></a>
					<a href="#"><i class="fa fa-vk"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-google-plus"></i></a>
				</div>


            </div>
        </div>
        
        <div id="footer-menu-box">
        	<p class="text-center">Copyrights © 2015 Srapo. All Rights Reserved.</p>
        </div>
    </section>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

<!-- Modal -->
<div id="terms" class="modal fade animated fadeInDown" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Terms &amp; Condition</h4>
      </div>
      <div class="modal-body">
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
      </div>
    </div>

  </div>
</div>
</body>

</html>
    <!-- jQuery -->
    <script src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/lib/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/lib/bootstrap/js/bootstrap.min.js"></script>
     <script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/jquery-validation/jquery.validate.js"></script> <!-- Form Validation --> 
       <script src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/js/jquery-validate.bootstrap-tooltip.js"></script>
    <!-- Plugin JavaScript -->
    <script src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/js/jquery.easing.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/js/style.min.js"></script>
    <!-- Proces diagram JavaScript -->
    <script src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/js/sly.min.js"></script>

    <script src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/lib/owl/owl.carousel.min.js"></script>
   
<script>

	/* Start : Script For Story board */
	var $frame  = $('#story-board');
	var $slidee = $frame.children('ul').eq(0);

	var $wrap   = $frame.parent();
    
	$frame.sly({
		horizontal: 1,
		itemNav: 'basic',
		smart: 1,
		mouseDragging: 1,
		touchDragging: 1,
		releaseSwing: 1,
		startAt: 0,
		scrollBar: $wrap.find('.scrollbar'),
		scrollBy: 1,
		speed: 500,
		moveBy:0,
		elasticBounds: 1,
		easing: 'easeOutExpo',
		dragHandle: 1,
		dynamicHandle: 1,
		clickBar: 1,
	
	});
	$('.step_name').click(function(){
		$frame.sly('toCenter', $(this).attr('id'));
	});	
	
	/* End : Script For Story board */
	function forgot(){
	var html='<div class="box-authentication custom-box-authentication forgot-form animated fadeInRight">'+
                        '<h3>Enter E-mail</h3>'+
                        '<h5> Already Register?  <a href="#" onclick="login()">Login</a>  from here.</h5>'+
                        
                        '<label for="email_login">Email address</label>'+
                        '<input id="email_login" type="text" class="form-control">'+
                        
                        '<button class="button"><i class="fa fa-lock"></i> Submit</button>'+
                        
                        
                    '</div>';
		
		$('#register-form').html(html);
	}	
</script>

<script>
    $(document).ready(function() {
     
      $("#owl-demo").owlCarousel({
     
          autoPlay: 3000, //Set AutoPlay to 3 seconds
     
          items : 4,
          itemsDesktop : [1199,3],
          itemsDesktopSmall : [979,3]
     
      });
     
    });


/*  Script for Bootstrap popup open in center of screen */
 
 
 $(document).ready(function(){

    function alignModal(){

        var modalDialog = $(this).find(".modal-dialog");

        /* Applying the top margin on modal dialog to align it vertically center */

        modalDialog.css("margin-top", Math.max(30, ($(window).height() - modalDialog.height()) / 2));

    }

    // Align modal when it is displayed

    $(".modal").on("shown.bs.modal", alignModal);

    

    // Align modal when user resize the window

    $(window).on("resize", function(){

        $(".modal:visible").each(alignModal);

    });   

});

 /*  End :Script for Bootstrap popup open in center of screen */
 
 
 /*start : navbar box-shadow script*/
 $(window).scroll(function() {     
    var scroll = $(window).scrollTop();
	
    if (scroll > 0) {
        $(".navbar").addClass("box-shadow");
    }
    else {
        $(".navbar").removeClass("box-shadow");
    }
});
 /*End : navbar box-shadow script*/

</script>

<script type="text/javascript">
$(document).ready(function () {
    //======================================================================================
$('#form_register').validate({
     highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        // $(".input-group").after();
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        $(element).closest('.error').remove();
    },
    ignore:[],
    rules: {
            firstname: {
                required: true,
            },
            lastname: {
                required: true,
            },
            email: {
                required: true,
                 remote: {
                        url: "<?php echo base_url('common/register/check_exits_email')?>",
                        type: "post",
                        data: {
                            email: function(){ return $("#email").val(); }
                        }
                    }
                
            },
            password: {
                required: true,
            },
            confirm_password: {
               equalTo: "#password"
              
            },
            condition:{
                required: true, 
            }
    },
    messages: {
            firstname: {
                    required: "Please Provide First Name."
            },
            lastname: {
                    required: "Please Provide Last Name."
            },
            email: {
                    required: "Please Provide Email.",
                    remote: "Email already exists, please provide a different email address"
            },
            password: {
                required: "Please Provide Password."
            },
            confirm_password:{
                equalTo: "Password does not match."
            },
            condition:{
                required: "Please Read Terms & Conditions.", 
            }
    },
        tooltip_options: {
           condition: { placement: 'left' }
        }
}); 
});
function myvalidate()
{
   $('#form_register').validate({
     highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        // $(".input-group").after();
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        $(element).closest('.error').remove();
    },
    ignore:[],
    rules: {
            firstname: {
                required: true,
            },
            lastname: {
                required: true,
            },
            email: {
                required: true,
                remote: {
                        url: "<?php echo base_url('common/register/check_exits_email')?>",
                        type: "post",
                        data: {
                            email: function(){ return $("#email").val(); }
                        }
                    }
                
            },
            password: {
                required: true,
            },
            confirm_password: {
               equalTo: "#password"
              
            },
            condition:{
                required: true, 
            }
    },
    messages: {
            firstname: {
                    required: "Please Provide First Name."
            },
            lastname: {
                    required: "Please Provide Last Name."
            },
            email: {
                    required: "Please Provide Email.",
                    remote: "Email already exists, please provide a different email address"
            },
            password: {
                required: "Please Provide Password."
            },
            confirm_password:{
                equalTo: "Password does not match."
            },
            condition:{
                required: "Please Read Terms & Conditions.", 
            }
    },
        tooltip_options: {
           condition: { placement: 'left' }
        }
}); 
}

</script>