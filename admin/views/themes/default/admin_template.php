<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
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
<?php
  /** -- Copy from here -- */
  if(isset($meta) && count($meta)>0)
  foreach($meta as $name=>$content){
    echo "\n\t\t";
    ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
       }
  echo "\n";

  if(isset($canonical) && $canonical!=="")
  {
    echo "\n\t\t";
    ?><link rel="canonical" href="<?php echo $canonical?>" /><?php

  }
  echo "\n\t";

  foreach($css as $file){
    echo "\n\t\t";
    ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
  } echo "\n\t";
  

  
  /** -- to here -- */
?>
<!-- End : Add Dynamic CSS Using template libraries -->
<style>

</style> 
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
              <a class="clock" href="#"><i class="fa fa-clock-o"></i>&nbsp;
            <?php
                $tz = 'Asia/Kolkata';
                $timestamp = time();
                $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
                $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
                echo $dt->format('D d M Y H:i A');
            ?>
            </a>
          </li>
          <li class="hidden-xs">
              <a title="" data-placement="bottom" data-toggle="tooltip" href="<?php echo base_url('dashboard/dashboard'); ?>" data-original-title="Dashboard"><i class="fa fa-dashboard"></i></a>
          </li>
          <li class="hidden-xs">
              <a title="Settings" data-placement="bottom" data-toggle="tooltip" href="<?php echo base_url('system/settings'); ?>">
<i class="fa fa-cogs"></i></a>
          </li>
          <!--<li>
              <a title="View" data-placement="bottom" data-toggle="tooltip" target="" href="#"><i class="fa fa-file-text-o"></i></a>
          </li>
          <li>
              <a title="POS" data-placement="bottom" data-toggle="tooltip" href="#"><i class="fa fa-th"></i></a>
          </li>-->
          <?php 
                $user_id = $this->session->userdata('user_id');
                $user_data = $this->common->getUser($user_id); 
          ?> 
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
                 <?php 
                    if($user_data['image']) {
                      if(is_file(DIR_IMAGE . $user_data['image']))
                      { ?>
                       <img src="<?php echo $this->common->getSmallUserProfile($user_data['image']); ?>" class="user-image" alt="User Image">  
                      <?php }
                      else
                      { ?>
                        <img src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/male.png" class="user-image" alt="User Image">
                      <?php }
                ?>
                         
                <?php   
                    } else {
                ?>
                        <img src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/male.png" class="user-image" alt="User Image">
                <?php
                    }
                ?>
              
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $user_data['firstname']." ".$user_data['lastname']; ?></span>
              
            </a>
            <ul class="dropdown-menu">

              <li class="user-header">
                  
               <?php 
                    if($user_data['image']) {
                      if(is_file(DIR_IMAGE . $user_data['image']))
                      { ?>
                       <img src="<?php echo $this->common->getUserProfile($user_data['image']); ?>" class="img-circle" alt="User Image">  
                      <?php }
                      else
                      { ?>
                        <img src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/male.png" class="img-circle" alt="User Image">
                      <?php }
                ?>
                          
                <?php   
                    } else {
                ?>
                        <img src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/male.png" class="img-circle" alt="User Image">
                <?php
                    }
                ?>
                
                <p>
                  <?php echo $user_data['email']; ?>
                  <small>Member since <?php echo date('M. Y', strtotime($user_data['date_added']))?> </small>
                </p>
              </li>
              
             <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                    
                  <a href="<?php echo base_url('common/profile')?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('common/login/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
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
<!-- Start: Left Menubar -->
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
        <!-- Start : Dashboard Tab  --> 
        <li class="<?php if($this->uri->segment(1)=='dashboard'){ echo 'active';}?>">
          <a href="<?php echo base_url('dashboard/dashboard');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <!-- End : Dashboard Tab  -->

    <!-- Start : Catalog Tab  --> 
        <li class="treeview <?php if(($this->uri->segment(1)=='catalog')&&($this->uri->segment(2)!='manufacturers')){ echo 'active';}?>">
          <a href="#">
            <i class="fa fa-tags"></i> <span>Catalog </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li class="<?php if($this->uri->segment(2)=='category'){ echo 'active';}?>">
              <a href="<?php echo base_url('catalog/category');?>"><i class="fa fa-angle-double-right"></i> Category</a>
            </li>
            <li class="<?php if($this->uri->segment(2)=='product'){ echo 'active';}?>">
              <a href="<?php echo base_url('catalog/product');?>"><i class="fa fa-angle-double-right"></i> Product</a>
            </li>
            <li class="<?php if($this->uri->segment(2)=='filter'){ echo 'active';}?>">
              <a href="<?php echo base_url('catalog/filter');?>"><i class="fa fa-angle-double-right"></i> Filter</a>
            </li>
            <li class=" <?php if($this->uri->segment(2)=='attributes' || $this->uri->segment(2)=='attributes_groups'){ echo 'active';}?>">
              <a href="#"><i class="fa fa-angle-double-right"></i> Attribute
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if($this->uri->segment(2)=='attributes'){ echo 'active';}?>">
                  <a href="<?php echo base_url('catalog/attributes');?>"><i class="fa fa-angle-double-right"></i> Attribute</a>
                </li>
                <li class="<?php if($this->uri->segment(2)=='attributes_groups'){ echo 'active';}?>">
                  <a href="<?php echo base_url('catalog/attributes_groups');?>"><i class="fa fa-angle-double-right"></i> Attribute Groups</a>
                </li>
              </ul>
            </li>
            <li class="<?php if($this->uri->segment(2)=='options'){ echo 'active';}?>">
              <a href="<?php echo base_url('catalog/options');?>"><i class="fa fa-angle-double-right"></i> Options</a>
            </li>
            
            <li class="<?php if($this->uri->segment(2)=='downloads'){ echo 'active';}?>">
              <a href="<?php echo base_url('catalog/downloads');?>"><i class="fa fa-angle-double-right"></i> Downloads</a>
            </li>
            <li class="<?php if($this->uri->segment(2)=='reviews'){ echo 'active';}?>">
              <a href="<?php echo base_url('catalog/reviews');?>"><i class="fa fa-angle-double-right"></i> Reviews</a>
            </li>
            <li class="<?php if($this->uri->segment(2)=='information'){ echo 'active';}?>">
              <a href="<?php echo base_url('catalog/information');?>"><i class="fa fa-angle-double-right"></i> Information</a>
            </li>
          </ul>
        </li>
       <!-- End : Catalog Tab  -->
        
         <!-- Start : Design Tab  --> 
        <li class="treeview <?php if($this->uri->segment(1)=='design'){ echo 'active';}?>">
          <a href="#">
            <i class="fa fa-television fa-fw"></i>
            <span>Design</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(2)=='banners'){ echo 'active';}?>">
                <a href="<?php echo base_url('design/banners');?>"><i class="fa fa-angle-double-right"></i>Banners</a>
            </li>
          </ul>
        </li>
        <!-- End : Design Tab  -->
       
       <!-- Start : Manufacturer Tab  --> 
        <li class="treeview <?php if(($this->uri->segment(1)=='catalog') && ($this->uri->segment(2)=='manufacturers')){ echo 'active';}?>">
          <a href="#">
            <i class="fa fa-user-plus fa-fw"></i>
            <span>Manufacturers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">           
           <li class="<?php if($this->uri->segment(2)=='manufacturers'){ echo 'active';}?>">
              <a href="<?php echo base_url('catalog/manufacturers');?>"><i class="fa fa-angle-double-right"></i> Manufacturer List</a>
            </li>
            <li class="<?php if($this->uri->segment(2)=='manu'){ echo 'active';}?>">
              <a href="<?php echo base_url('manufacturer/manufacturers');?>"><i class="fa fa-angle-double-right"></i> Pay to Manufacturer</a>
            </li>
          </ul>
        </li>
        <!-- End : Manufacturer Tab  -->
        
       <!-- Start : Expense Tab  --> 
        <li class="treeview <?php if($this->uri->segment(1)=='expense'){ echo 'active';}?>">
          <a href="#">
            <i class="fa fa-money fa-fw"></i>
            <span>Expenses</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">           
            <li class="<?php if($this->uri->segment(2)=='expense'){ echo 'active';}?>">
                <a href="<?php echo base_url('expense/expense');?>"><i class="fa fa-angle-double-right"></i>Expenses</a>
            </li>
            <li class="<?php if($this->uri->segment(2)=='expense_category'){ echo 'active';}?>">
                <a href="<?php echo base_url('expense/expense_category');?>"><i class="fa fa-angle-double-right"></i>Expense Category</a>
            </li>
          </ul>
        </li>
        <!-- End : Expense Tab  -->
         <!-- Start : Purcahse Tab  --> 
        <li class="treeview <?php if($this->uri->segment(1)=='purchase'){ echo 'active';}?>">
          <a href="#">
            <i class="fa fa-shopping-cart fa-fw"></i>
            <span>Purchase</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(2)=='purchase'){ echo 'active';}?>">
                <a href="<?php echo base_url('purchase/purchase');?>"><i class="fa fa-angle-double-right"></i>Purchase</a>
            </li>   
             <li class="<?php if($this->uri->segment(2)=='purchase_return'){ echo 'active';}?>">
                <a href="<?php echo base_url('purchase/purchase_return');?>"><i class="fa fa-angle-double-right"></i>Purchase Return</a>
            </li>          
          </ul>
        </li>
        <!-- End : Purcahse Tab  -->
        <!-- Start : Sales Tab  --> 
        <li class="treeview <?php if($this->uri->segment(1)=='sales'){ echo 'active';}?>">
          <a href="#">
            <i class="fa fa-shopping-cart fa-fw"></i>
            <span>Sales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(2)=='orders'){ echo 'active';}?>">
              <a href="<?php echo base_url('sales/orders');?>"><i class="fa fa-angle-double-right"></i>Orders</a>
            </li>
            <li class="<?php if($this->uri->segment(2)=='returns'){ echo 'active';}?>">
              <a href="<?php echo base_url('sales/returns');?>"><i class="fa fa-angle-double-right"></i>Returns</a>
            </li>
            <li class="<?php if($this->uri->segment(2)=='gift_vouchers' || $this->uri->segment(2)=='voucher_themes'){ echo 'active';}?>">
              <a href="#"><i class="fa fa-angle-double-right"></i> Gift Vouchers
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if($this->uri->segment(2)=='gift_vouchers'){ echo 'active';}?>">
                  <a href="<?php echo base_url('sales/gift_vouchers');?>"><i class="fa fa-angle-double-right"></i> Gift Vouchers</a>
                </li>
                <li class="<?php if($this->uri->segment(2)=='voucher_themes'){ echo 'active';}?>">
                  <a href="<?php echo base_url('sales/voucher_themes');?>"><i class="fa fa-angle-double-right"></i> Voucher Themes</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <!-- End : sales Tab  -->

        <!-- Start : Customers Tab  --> 
        <li class="treeview <?php if($this->uri->segment(2)=='customer' || $this->uri->segment(2)=='customer_groups'){ echo 'active';}?>">
            <a href="#">
                <i class="fa fa-users fa-fw"></i>
                <span>Customers</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a> 
            <ul class="treeview-menu">
                <li class="<?php if($this->uri->segment(2)=='customer'){ echo 'active';}?>">
                    <a href="<?php echo base_url('customers/customer');?>"><i class="fa fa-angle-double-right"></i>Customers</a>
                </li>
                <li class="<?php if($this->uri->segment(2)=='customer_groups'){ echo 'active';}?>">
                    <a href="<?php echo base_url('customers/customer_groups');?>"><i class="fa fa-angle-double-right"></i>Customer Groups</a>
                </li>
            </ul>
        </li>
        <!-- End : Customers Tab  --> 

        <!-- Start : Marketing Tab  --> 
        <li class="treeview <?php if($this->uri->segment(1)=='marketing'){ echo 'active';}?>">
          <a href="#">
            <i class="fa fa-share-alt fa-fw"></i>
            <span>Marketing</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(2)=='coupons'){ echo 'active';}?>">
              <a href="<?php echo base_url('marketing/coupons');?>"><i class="fa fa-angle-double-right"></i>Coupons</a>
            </li>
          
            <li class="<?php if($this->uri->segment(2)=='contact_send_mail'){ echo 'active';}?>">
              <a href="<?php echo base_url('marketing/contact_send_mail');?>"><i class="fa fa-angle-double-right"></i>Mail</a>
            </li>
          </ul>
        </li>
        <!-- End : Marketing Tab  -->   
          <!-- Start : Support Tab  --> 
        <li class="treeview <?php if($this->uri->segment(1)=='support'){ echo 'active';}?>">
          <a href="#">
            <i class="fa fa-support"></i>
            <span>Ticket Support</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(2)=='tickets'){ echo 'active';}?>">
                <a href="<?php echo base_url('support/tickets');?>"><i class="fa fa-angle-double-right"></i>Tickets</a>
            </li>
          </ul>
        </li>
        <!-- End : Support Tab  -->
         <!-- Start : system Tab  --> 
        <li class="treeview <?php if($this->uri->segment(1)=='system'){ echo 'active';}?>">
          <a href="#">
            <i class="fa fa-cog fa-fw"></i>
            <span>System</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li class="<?php if($this->uri->segment(2)=='settings'){ echo 'active';}?>  <?php if($this->uri->segment(1)=='payment'){ echo 'active';}?> <?php if($this->uri->segment(1)=='shipping'){ echo 'active';}?>">
              <a href="<?php echo base_url('system/settings');?>"><i class="fa fa-angle-double-right"></i>Settings</a>
            </li>
            <li class="<?php if($this->uri->segment(2)=='users' || $this->uri->segment(2)=='user_groups'){ echo 'active';}?>">
                <a href="#"><i class="fa fa-angle-double-right"></i> Users
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a> 
                <ul class="treeview-menu">
                    <li class="<?php if($this->uri->segment(2)=='users'){ echo 'active';}?>">
                        <a href="<?php echo base_url('system/users');?>"><i class="fa fa-angle-double-right"></i>Users</a>
                    </li>
                    <?php if($this->session->userdata('role_id')== 1) { ?>
                    <li class="<?php if($this->uri->segment(2)=='user_groups'){ echo 'active';}?>">
                        <a href="<?php echo base_url('system/user_groups');?>"><i class="fa fa-angle-double-right"></i> User Groups</a>
                    </li>
                    <?php } ?>
                </ul>
            </li>

            <li class="<?php if( $this->uri->segment(2)=='currency' || $this->uri->segment(2)=='stock_status' || $this->uri->segment(2)=='order_status' || $this->uri->segment(2)=='return_status' || $this->uri->segment(2)=='return_actions' || $this->uri->segment(2)=='return_reason' || $this->uri->segment(2)=='country' || $this->uri->segment(2)=='zone' || $this->uri->segment(2)=='tax_classes' || $this->uri->segment(2)=='tax_rates' || $this->uri->segment(2)=='length' || $this->uri->segment(2)=='weight'){ echo 'active';}?>">
              <a href="#"><i class="fa fa-angle-double-right"></i> Localisation
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if($this->uri->segment(2)=='currency'){ echo 'active';}?>">
                  <a href="<?php echo base_url('system/currency');?>"><i class="fa fa-angle-double-right"></i>Currencies</a>
                </li>
                <li class="<?php if($this->uri->segment(2)=='stock_status'){ echo 'active';}?>">
                  <a href="<?php echo base_url('system/stock_status');?>"><i class="fa fa-angle-double-right"></i> Stock Statuses</a>
                </li>
                <li class="<?php if($this->uri->segment(2)=='order_status'){ echo 'active';}?>">
                  <a href="<?php echo base_url('system/order_status');?>"><i class="fa fa-angle-double-right"></i> Order Statuses</a>
                </li>

                <li class="<?php if($this->uri->segment(2)=='return_status' || $this->uri->segment(2)=='return_actions' || $this->uri->segment(2)=='return_reason'){ echo 'active';}?>">
                  <a href="#"><i class="fa fa-angle-double-right"></i> Returns
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li class="<?php if($this->uri->segment(2)=='return_status'){ echo 'active';}?>">
                      <a href="<?php echo base_url('system/return_status');?>"><i class="fa fa-angle-double-right"></i> Return Statuses</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='return_actions'){ echo 'active';}?>">
                      <a href="<?php echo base_url('system/return_actions');?>"><i class="fa fa-angle-double-right"></i> Return Actions</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='return_reason'){ echo 'active';}?>">
                      <a href="<?php echo base_url('system/return_reason');?>"><i class="fa fa-angle-double-right"></i> Return Reasons</a>
                    </li>
                  </ul>
                </li>
                <li class="<?php if($this->uri->segment(2)=='country'){ echo 'active';}?>">
                  <a href="<?php echo base_url('system/country');?>"><i class="fa fa-angle-double-right"></i> Countries</a>
                </li>
                <li class="<?php if($this->uri->segment(2)=='zone'){ echo 'active';}?>">
                  <a href="<?php echo base_url('system/zone');?>"><i class="fa fa-angle-double-right"></i> Zones</a>
                </li>
                <!-- Taxes -->
                <li class="<?php if($this->uri->segment(2)=='tax_classes' || $this->uri->segment(2)=='tax_rates'){ echo 'active';}?>">
                  <a href="#"><i class="fa fa-angle-double-right"></i> Taxes
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li class="<?php if($this->uri->segment(2)=='tax_classes'){ echo 'active';}?>">
                      <a href="<?php echo base_url('system/tax_classes');?>"><i class="fa fa-angle-double-right"></i> Tax Classes</a>
                    </li>                  
                    <li class="<?php if($this->uri->segment(2)=='tax_rates'){ echo 'active';}?>">
                      <a href="<?php echo base_url('system/tax_rates');?>"><i class="fa fa-angle-double-right"></i> Tax Rates</a>
                    </li>
                  </ul>
                </li>
                
                <li class="<?php if($this->uri->segment(2)=='length'){ echo 'active';}?>">
                  <a href="<?php echo base_url('system/length');?>"><i class="fa fa-angle-double-right"></i>Length Classes</a>
                </li>
                
                <li class="<?php if($this->uri->segment(2)=='weight'){ echo 'active';}?>">
                  <a href="<?php echo base_url('system/weight');?>"><i class="fa fa-angle-double-right"></i>Weight Classes</a>
                </li>
                <!-- //Taxes -->
              </ul>
            </li>
            <!-- Tools -->
            <li class="<?php if($this->uri->segment(2)=='tools' || $this->uri->segment(2)=='import_product'){ echo 'active';}?>">
                <a href="#"><i class="fa fa-angle-double-right"></i> Tools
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a> 
                <ul class="treeview-menu">
                    <li class="<?php if($this->uri->segment(2)=='import_product'){ echo 'active';}?>">
                        <a href="<?php echo base_url('system/import_product');?>"><i class="fa fa-angle-double-right"></i>CSV import products</a>
                    </li>                    
                </ul>
            </li>
            <!-- //Tools -->
            <li class="<?php if($this->uri->segment(2)=='payments'){ echo 'active';}?>">
              <a href="<?php echo base_url('payment/payments');?>"><i class="fa fa-angle-double-right"></i>Payments</a>
            </li>

            <li class="<?php if($this->uri->segment(2)=='shipping'){ echo 'active';}?>">
              <a href="<?php echo base_url('shipping/shipping');?>"><i class="fa fa-angle-double-right"></i>Shipping</a>
            </li>

             <li class="<?php if($this->uri->segment(2)=='email_template'){ echo 'active';}?>">
              <a href="<?php echo base_url('system/email_template');?>"><i class="fa fa-angle-double-right"></i>Email Template</a>
            </li>
            <li class="<?php if($this->uri->segment(2)=='change_password'){ echo 'active';}?>">
              <a href="<?php echo base_url('system/change_password');?>"><i class="fa fa-angle-double-right"></i>Change Password</a>
            </li>
          </ul>
        </li>
        <!-- End : system Tab  -->        
 <!-- Start : Reports Tab  --> 
        <li class="treeview <?php if($this->uri->segment(1)=='reports'){ echo 'active';}?>">
          <a href="#">
            <i class="fa fa-bar-chart-o fa-fw"></i>
            <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li class="<?php if($this->uri->segment(2)=='sales_report' || $this->uri->segment(2)=='sales_return_report' || $this->uri->segment(2) == 'sale_tax_report' || $this->uri->segment(2) == 'sale_shipping_report' || $this->uri->segment(2)=='coupons_report'){ echo 'active';}?>">
                  <a href="#"><i class="fa fa-angle-double-right"></i> Sales
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li class="<?php if($this->uri->segment(2)=='sales_report'){ echo 'active';}?>">
                        <a href="<?php echo base_url('reports/sales_report');?>"><i class="fa fa-angle-double-right"></i> Orders</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='sale_tax_report'){ echo 'active';}?>">
                        <a href="<?php echo base_url('reports/sale_tax_report');?>"><i class="fa fa-angle-double-right"></i> Tax</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='sale_shipping_report'){ echo 'active';}?>">
                        <a href="<?php echo base_url('reports/sale_shipping_report');?>"><i class="fa fa-angle-double-right"></i> Shipping</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='sales_return_report'){ echo 'active';}?>">
                        <a href="<?php echo base_url('reports/sales_return_report');?>"><i class="fa fa-angle-double-right"></i> Returns</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='coupons_report'){ echo 'active';}?>">
                        <a href="<?php echo base_url('reports/coupons_report');?>"><i class="fa fa-angle-double-right"></i> Coupons</a>
                    </li>
                    
                  </ul>
              </li>
              <li class="<?php if($this->uri->segment(2)=='product_purchased_report' ){ echo 'active';}?>">
                  <a href="#"><i class="fa fa-angle-double-right"></i> Products
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li class="<?php if($this->uri->segment(2)=='product_purchased_report' ){ echo 'active';}?>"><a href="<?php echo base_url('reports/product_purchased_report');?>"><i class="fa fa-angle-double-right"></i> Purchased</a></li>
                   
                  </ul>
              </li>
              <li class="<?php if($this->uri->segment(2)=='customer_order_report' ){ echo 'active';}?>">
                  <a href="#"><i class="fa fa-angle-double-right"></i> Customers
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li class="<?php if($this->uri->segment(2)=='customer_order_report' ){ echo 'active';}?>"><a href="<?php echo base_url('reports/customer_order_report');?>"><i class="fa fa-angle-double-right"></i> Orders</a></li>
                    
                  </ul>
              </li>
              <li class="<?php if($this->uri->segment(2)=='purchase_report' || $this->uri->segment(2)=='purchase_return_report'){ echo 'active';}?>">
                  <a href="#"><i class="fa fa-angle-double-right"></i> Purchase
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li class="<?php if($this->uri->segment(2)=='purchase_report' ){ echo 'active';}?>"><a href="<?php echo base_url('reports/purchase_report');?>"><i class="fa fa-angle-double-right"></i> Purchase</a></li>
                   <li class="<?php if($this->uri->segment(2)=='purchase_return_report' ){ echo 'active';}?>"><a href="<?php echo base_url('reports/purchase_return_report');?>"><i class="fa fa-angle-double-right"></i> Purchase Return </a></li>
                  </ul>
              </li>
            
          </ul>
        </li>
       <!-- End : Reports Tab  --> 
        
      </ul>
    </section>
  </aside>
  <!-- End: Left Menubar -->
  <!-- Start: Content Page -->
  <?php echo $output;
  
  ?>
  <!-- End: Content Page -->


  <!-- Start :  Footer -->
  <footer class="main-footer">
    <a href="#">Srapo.com</a> © 2015-2016 All Rights Reserved.<br>Version 1.0.0.0
  </footer>
  <!-- End :  Footer -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- Bootstrap 3.3.6 -->
 <?php 
  foreach($js as $file){
      echo "\n\t\t";
      ?><script src="<?php echo $file; ?>"></script><?php
  } echo "\n\t";
  ?>
<!-- Theme App -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/js/app.js"></script>
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/js/filemanager.js"></script>
<script>
var w = $(window).width();

 $('.ui-autocomplete').css('width', w);
</script>
</body>
</html>