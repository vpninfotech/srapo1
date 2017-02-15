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
        <!--<div class="breadcrumb clearfix">
            <a class="home" href="#" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Your Wishlist</span>
        </div>
        <!-- ./breadcrumb -->
        
        <div class="page-content page-order">
            <div class="row">
                <!-- Left colunm -->
                <div class="column col-xs-12 col-sm-3" id="left_column">

                </div>
              
                <!-- Center colunm-->
                <div class="center_column col-xs-12 col-sm-6" id="center_column">
                    <?php echo $this->load->get_section('content');?>   
                </div>
              
            </div>
        </div>
    </div>
</div>