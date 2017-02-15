<style>
#left_column .block .title_block {
    font-size: 14px;
    font-weight: bold;
    border-bottom: 1px solid #eaeaea;
    padding-left: 28px;
    text-transform: uppercase;
    padding-top: 10px;
    padding-bottom: 10px;
}
</style>

<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
            <!--<a class="home" href="#" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Your Wishlist</span>-->
        </div>
        <!-- ./breadcrumb -->
                     <?php if(isset($error) && $error!==""): ?>
    
      <div class="alert alert-danger alert-bold-border">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px;font-size:20px">×</button>
        <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error;?> </div>
    
    <?php endif; ?>
    <?php if($this->session->userdata('success')!==NULL): ?>
    
      <div class="alert alert-success alert-bold-border">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px;font-size:20px">×</button>
        <i class="fa fa-check-circle"></i>&nbsp;<?php echo $this->session->userdata('success');?> </div>
    
    <?php endif; ?>
        <div class="page-content page-order">
        	<div class="row">
            	<!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3 menu-hidden4" id="left_column">
                <!-- block My Account -->
                <div class="block left-module" style="margin-bottom: 5px;">
                    <p class="title_block">My Account</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-category">
                            <div class="layered-content">
                                <ul class="tree-menu">
									<li><span></span><a href="<?php echo site_url('account/edit_account'); ?>">Edit Account information</a></li>
                                    <li><span></span><a href="<?php echo site_url('account/change_password'); ?>">Change Password</a></li>
                                    <li><span></span><a href="<?php echo site_url('account/address_book'); ?>">Modify your address book entries</a></li>
                                    <li><span></span><a href="<?php echo site_url('account/wishlist'); ?>">Modify your wish list</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- ./layered -->
                    </div>
                </div>
                <!-- ./block My Account  -->
                
                <!-- block My Orders -->
                <div class="block left-module" style="margin-bottom: 5px;">
                    <p class="title_block">My Orders</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-category">
                            <div class="layered-content">
                                <ul class="tree-menu">
                                 <li><span></span><a href="<?php echo site_url('account/order'); ?>">View your order history</a></li>
                                    <li><span></span><a href="#">Downloads</a></li>
                                    <li><span></span><a href="<?php echo site_url('account/return_order'); ?>">View your return requests</a></li>
                                    <li><span></span><a href="<?php echo site_url('account/transaction'); ?>">Your Transactions</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- ./layered -->
                    </div>
                </div>
                <!-- ./block My Orders  -->
                
                <!-- block Newsletter -->
                <div class="block left-module">
                    <p class="title_block">Newsletter</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-category">
                            <div class="layered-content">
                                <ul class="tree-menu">
									
                                    <li><span></span><a href="<?php echo site_url('account/newsletter'); ?>">Subscribe/Unsubscribe  Newsletter</a></li>
                                  
                                </ul>
                            </div>
                        </div>
                        <!-- ./layered -->
                    </div>
                </div>
                <!-- ./block Newsletter  -->
                </div>
              
               <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">

                
             <?php echo $this->load->get_section('content');?>   
            </div>
              
            </div>
        </div>
    </div>
</div>