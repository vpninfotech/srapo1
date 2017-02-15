<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Orders</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  

  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/fonts/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/fonts/ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/css/AdminLTE.css">
  
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/css/skins/skin-green.css">
  
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/css/custom.css">
  
  <!-- jQuery 2.2.3 -->
  <script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
  <!-- Start : Add Dynamic CSS Using template libraries -->

<!-- End : Add Dynamic CSS Using template libraries -->
  
</head>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url('dashboard/dashboard');?>" class="logo">
      <span class="logo-mini"><img src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/logo-mini.png" style="height:40px;"/></span>
      <span class="logo-lg">SRAPO</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      
      
      <ul class="nav navbar-nav pull-left">
        <li class="dropdown hidden-xs">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/flag.png"></a>
            <ul class="dropdown-menu">
                <li><a href="#"><img src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/flag.png" class="language-img"> &nbsp;&nbsp;English</a></li>
            </ul>
        </li>
       </ul>
       
       
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="hidden-xs hidden-sm">
              <a class="clock" href="#">Tue 16 Aug 2016 12:42 PM</a>
          </li>
          <li class="hidden-xs">
              <a title="" data-placement="bottom" data-toggle="tooltip" href="index.php" data-original-title="Dashboard"><i class="fa fa-dashboard"></i></a>
          </li>
          <li class="hidden-xs">
              <a title="Settings" data-placement="bottom" data-toggle="tooltip" href="settings.php">
<i class="fa fa-cogs"></i></a>
          </li>
          <li>
              <a title="View" data-placement="bottom" data-toggle="tooltip" target="" href="#"><i class="fa fa-file-text-o"></i></a>
          </li>
          <li>
              <a title="POS" data-placement="bottom" data-toggle="tooltip" href="#"><i class="fa fa-th"></i></a>
          </li>
            
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/male.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Admin Admin</span>
            </a>
            <ul class="dropdown-menu">

              <li class="user-header">
                <img src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/male.png" class="img-circle" alt="User Image">
                <p>
                  info@admin.com
                  <small>Member since Nov. 2014 </small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
              <!-- End : Menu Footer-->
            </ul>
          </li>
          <!-- End : User Account Menu -->
        </ul>
      </div>
    </nav>
  </header>
<!-- End Main Header -->
<div class="form-group">
<div class="container panel">
    <div class="row">
        <div class="col-xs-12">
        	<div class="print col-xs-12">
            	<div class="row">
            	<div class="col-xs-6 pull-left">
                	<img src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/srapo-logo1.png" style="width:40%;margin-top:20px;">
                </div>
                <div class="col-xs-6">
                
            		<h3><button class="btn btn-default btn-sm  pull-right" onclick="window.print();">Print this page</button></h3>
                </div>
                </div>
            </div>
    		<div class="invoice-title">
    			<h2>Invoice</h2>
                <h3 class="pull-right">Order # 12345 </h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					Hitesh Patel - +91 1234-56-7890<br>
    					Flat No / Street No., Society Name,<br>
    					Near Abc, Xyz Road<br>
    					City Name - 395006.
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
    					Hitesh Patel - +91 1234-56-7890<br>
    					Flat No/ Street No., Society Name,<br>
    					Near Abc, Xyz Road<br>
    					City Name - 395006.
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Total Amount:</strong><br>
    					1094.00<br>
    					hiteshnx@gmail.com
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					Sept 14, 2016<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
   
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<tr>
    								<td><!--<img src="images/utsav-saree.jpg" style="height:5%;">--> Iphone-7- 64GB</td>
    								<td class="text-center">$999.00</td>
    								<td class="text-center">1</td>
    								<td class="text-right">$999.00</td>
    							</tr>
                                <tr>
        							<td>Iphone-7 Mobile Case</td>
    								<td class="text-center">$20.00</td>
    								<td class="text-center">3</td>
    								<td class="text-right">$60.00</td>
    							</tr>
                                <tr>
            						<td>Iphone-7 Screen Glass</td>
    								<td class="text-center">$20.00</td>
    								<td class="text-center">1</td>
    								<td class="text-right">$20.00</td>
    							</tr>
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">$1079.00</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping</strong></td>
    								<td class="no-line text-right">$15.00</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right"><h3>$1094.00</h3></td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
      	&nbsp;&nbsp;&nbsp;<label><strong>Instructions :</strong></label><br>
      	<ol>
        	<li>Ordered item you can return within 15 days after Delivered.</li>
            <li>Ordered item you can return within 15 days after Delivered.</li>
            <li>Ordered item you can return within 15 days after Delivered.</li>
            <li>Ordered item you can return within 15 days after Delivered.</li>
        </ol>
        <br><br><br><br>
      </div>
    </div>
    
</div>