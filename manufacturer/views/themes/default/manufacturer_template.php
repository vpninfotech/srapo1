<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/bootstrap/css/bootstrap.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/fonts/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/fonts/ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/css/AdminLTE.css">

        <link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/css/skins/skin-green.css">

        <link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/css/custom.css">

        <!-- jQuery 2.2.3 -->
        <script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
        <!-- Start : Add Dynamic CSS Using template libraries -->
        <?php
        /** -- Copy from here -- */
        if (isset($meta) && count($meta) > 0)
            foreach ($meta as $name => $content) {
                echo "\n\t\t";
                ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
            }
        echo "\n";

        if (isset($canonical) && $canonical !== "") {
            echo "\n\t\t";
            ?><link rel="canonical" href="<?php echo $canonical ?>" /><?php
        }
        echo "\n\t";

        foreach ($css as $file) {
            echo "\n\t\t";
            ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
        } echo "\n\t";


        /** -- to here -- */
        ?>
        <!-- End : Add Dynamic CSS Using template libraries -->

    </head>

    <body class="hold-transition skin-green sidebar-mini">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="<?php echo base_url('dashboard/dashboard'); ?>" class="logo">
                    <span class="logo-mini"><img src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/images/logo-mini.png" style="height:40px;"/></span>
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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/images/flag.png"></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><img src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/images/flag.png" class="language-img"> &nbsp;&nbsp;English</a></li>
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

<?php
$user_id = $this->session->userdata('manufacturer_user_id');

$user_data = $this->common->getUser($user_id);
?>  

                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
<?php
if ($user_data['image']) {
    ?>
                                        <img src="<?php echo $this->common->getSmallUserProfile($user_data['image']); ?>" class="user-image" alt="User Image">   
                                        <?php
                                    } else {
                                        ?>
                                        <img src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/images/male.png" class="user-image" alt="User Image">
                                        <?php
                                    }
                                    ?>
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs"><?php echo $user_data['firstname'] . " " . $user_data['lastname']; ?></span>

                                </a>
                                <ul class="dropdown-menu">

                                    <li class="user-header">

<?php
if ($user_data['image']) {
    ?>
                                            <img src="<?php echo $this->common->getUserProfile($user_data['image']); ?>" class="img-circle" alt="User Image">   
                                            <?php
                                        } else {
                                            ?>
                                            <img src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/images/male.png" class="img-circle" alt="User Image">
                                            <?php
                                        }
                                        ?>

                                        <p>
<?php echo $user_data['email']; ?>
                                            <small>Member since <?php echo date('M. Y', strtotime($user_data['date_added'])) ?> </small>
                                        </p>
                                    </li>

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo base_url('common/profile'); ?>" class="btn btn-default btn-flat">Profile</a>
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
                        <li class="<?php if ($this->uri->segment(1) == 'dashboard') {
    echo 'active';
} ?>">
                            <a href="<?php echo base_url('dashboard/dashboard'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <!-- End : Dashboard Tab  -->

                        <!-- Start : Catalog Tab  --> 
                        <li class="treeview <?php if ($this->uri->segment(1) == 'catalog') {
    echo 'active';
} ?>">
                            <a href="#">
                                <i class="fa fa-tags"></i> <span>Catalog </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu" >

                                <li class="<?php if ($this->uri->segment(2) == 'product') {
    echo 'active';
} ?>">
                                    <a href="<?php echo base_url('catalog/product'); ?>"><i class="fa fa-angle-double-right"></i> Product</a>
                                </li>


                            </ul>
                        </li>
                        <!-- End : Catalog Tab  -->
                         <!-- Start : Purcahse Tab  --> 
        <li class="treeview <?php if($this->uri->segment(1)=='sales'){ echo 'active';}?>">
          <a href="#">
            <i class="fa fa-shopping-cart fa-fw"></i>
            <span>Sales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(2)=='sale'){ echo 'active';}?>">
                <a href="<?php echo base_url('sales/sale');?>"><i class="fa fa-angle-double-right"></i>Sales</a>
            </li>   
             <li class="<?php if($this->uri->segment(2)=='sale_return'){ echo 'active';}?>">
                <a href="<?php echo base_url('sales/sale_return');?>"><i class="fa fa-angle-double-right"></i>Sales Return</a>
            </li>          
          </ul>
        </li>
        <!-- End : Purcahse Tab  -->
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
              <li class="<?php if($this->uri->segment(2)=='billing_paid_report' || $this->uri->segment(2)=='billing_pending_report'){ echo 'active';}?>">
                  <a href="#"><i class="fa fa-angle-double-right"></i> Billing
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li class="<?php if($this->uri->segment(2)=='billing_pending_report'){ echo 'active';}?>">
                        <a href="<?php echo base_url('reports/billing_pending_report');?>"><i class="fa fa-angle-double-right"></i> Billing Pending</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='billing_paid_report'){ echo 'active';}?>">
                        <a href="<?php echo base_url('reports/billing_paid_report');?>"><i class="fa fa-angle-double-right"></i> Billing Paid</a>
                    </li>
                  </ul>                  
              </li>
              <li class="<?php if($this->uri->segment(2)=='sales_report' ||$this->uri->segment(2)=='sales_return_report'){ echo 'active';}?>">
                  <a href="#"><i class="fa fa-angle-double-right"></i> Sales
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li class="<?php if($this->uri->segment(2)=='sales_report' ){ echo 'active';}?>"><a href="<?php echo base_url('reports/sales_report');?>"><i class="fa fa-angle-double-right"></i> Sales</a></li>
                   <li class="<?php if($this->uri->segment(2)=='sales_return_report' ){ echo 'active';}?>"><a href="<?php echo base_url('reports/sales_return_report');?>"><i class="fa fa-angle-double-right"></i> Sales Return </a></li>
                  </ul>
             </li>
          </ul>
        </li>
       <!-- End : Reports Tab  --> 
                        <!-- Start : Ticket Support Tab  --> 
                        <li class="treeview <?php if ($this->uri->segment(1) == 'support') {
    echo 'active';
} ?>">
                            <a href="#">
                                <i class="fa fa-support"></i> <span>Ticket Support</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu" >

                                <li class="<?php if ($this->uri->segment(2) == 'tickets') {
    echo 'active';
} ?>">
                                    <a href="<?php echo base_url('support/tickets'); ?>"><i class="fa fa-angle-double-right"></i> Tickets</a>
                                </li>


                            </ul>
                        </li>
                        <!-- End : Ticket Support Tab  -->



                        <!-- Start : system Tab  --> 
                        <li class="treeview <?php if ($this->uri->segment(1) == 'system') {
    echo 'active';
} ?>">
                            <a href="#">
                                <i class="fa fa-cog fa-fw"></i>
                                <span>System</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">


                                <li class="<?php if ($this->uri->segment(2) == 'change_password') {
    echo 'active';
} ?>">
                                    <a href="<?php echo base_url('system/change_password'); ?>"><i class="fa fa-angle-double-right"></i>Change Password</a>
                                </li>
                            </ul>
                        </li>
                        <!-- End : system Tab  -->        


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
foreach ($js as $file) {
    echo "\n\t\t";
    ?><script src="<?php echo $file; ?>"></script><?php
} echo "\n\t";
?>
        <!-- Theme App -->
        <script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/js/app.js"></script>
        <script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/js/filemanager.js"></script>
    </body>
</html>
