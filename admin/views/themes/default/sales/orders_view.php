<!-- Select2 -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
<!-- Select2 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/all.css">
<!-- iCheck 1.0.1 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/icheck.min.js"></script>


<!-- DataTables -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datatables/dataTables.bootstrap.css">
<!-- DataTables --> 
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datatables/dataTables.bootstrap.min.js"></script> 

<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
<!-- DataTables --> 
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Orders </h1>
        <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </section>
    <!------------------ End Content Header (Page header) ---------------------> 
    <!-------------------------- Main content ------------------------------- -->
    <section class="content">
      <h3 class="print-page">
		<a href="<?php echo base_url('sales/orders/order_print');?>" target="_blank"><button class="btn btn-primary btn-md">Print Invoice</button></a>
</h3>
		<div class="clearfix"></div>
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <div class="box box-default">
          	<div class="box-header">
            	<h3 class="box-title col-sm-12">
                  <i class="fa fa-shopping-cart"></i>
                  Order Details
                </h3>
          	</div>
            <table class="table">
              <tbody>
              	<tr>
                	<td style="width:1%;">
                      <button class="btn btn-primary btn-xs" title="" data-toggle="tooltip" data-original-title="Store">
						<i class="fa fa-shopping-cart"></i>
					  </button>
                    </td>
                    <td>
                      <a target="_blank" href="#">Srapo</a>
                    </td>
                </tr>
                <tr>
                	<td style="width:1%;">
                      <button class="btn btn-primary btn-xs" title="" data-toggle="tooltip" data-original-title="Date Added">
						<i class="fa fa-calendar"></i>
</button>
                    </td>
                    <td>20/09/2016</td>
                </tr>
                <tr>
                	<td style="width:1%;">
                      <button class="btn btn-primary btn-xs" title="" data-toggle="tooltip" data-original-title="Payment Method">
						<i class="fa fa-credit-card"></i>
</button>
                    </td>
                    <td>Free Checkout</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="box box-default">
          	<div class="box-header">
            	<h3 class="box-title col-sm-12">
                  <i class="fa fa-user"></i>
                  Customer Details
                </h3>
          	</div>
            <table class="table">
              <tbody>
              	<tr>
                	<td style="width:1%;">
                      <button class="btn btn-primary btn-xs" title="" data-toggle="tooltip" data-original-title="Customer">
						<i class="fa fa-user"></i>
</button>
                    </td>
                    <td>
                      <a target="_blank" href="#">User Test</a>
                    </td>
                </tr>
                <tr>
                	<td style="width:1%;">
                      <button class="btn btn-primary btn-xs" title="" data-toggle="tooltip" data-original-title="Customer Group">
						<i class="fa fa-group"></i>
</button>
                    </td>
                    <td>Default</td>
                </tr>
                <tr>
                	<td style="width:1%;">
                      <button class="btn btn-primary btn-xs" title="" data-toggle="tooltip" data-original-title="E-mail">
						<i class="fa fa-envelope-o"></i>
</button>
                    </td>
                    <td>
                      <a target="_blank" href="#">rv@vpninfotech.com</a>
                    </td>
                </tr>
                <tr>
                	<td style="width:1%;">
                      <button class="btn btn-primary btn-xs" title="" data-toggle="tooltip" data-original-title="Telephone">
						<i class="fa fa-phone"></i>
</button>
                    </td>
                    <td>0123456789</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="box box-default">
          	<div class="box-header">
            	<h3 class="box-title col-sm-12">
                  <i class="fa fa-cog"></i>
                  Options
                </h3>
          	</div>
            <table class="table">
              <tbody>
              	<tr>
                    <td>Invoice</td>
                    <td class="text-right">0</td>
                    <td style="width:1%;">
                    	<button id="button-invoice" name="button-invoice" class="btn btn-success btn-xs" data-toggle="tooltip" data-original-title="Generate">
							<i class="fa fa-cog"></i>
						</button>
                    </td>
                </tr>
                <tr>
                    <td>Reward Point</td>
                    <td class="text-right">0.00</td>
                    <td style="width:1%;">
                        <button class="btn btn-success btn-xs" disabled="disabled">
                            <i class="fa fa-plus-circle"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>Affiliate</td>
                    <td class="text-right">Rs. 0.00</td>
                    <td style="width:1%;">
                    	<button class="btn btn-success btn-xs" disabled="disabled">
                        	<i class="fa fa-plus-circle"></i>
                        </button>
                    </td>
                </tr>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
 
      
      <!--start : order table-->
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header">
              <h3 class="box-title col-sm-6"><i class="fa fa-pencil"></i>Order (#77)</h2>
            </div>
            <div class="box-body"> 
 
              <!-- Start : product add to cart table --> 
              <div class="table-responsive table-padding">
                <table class="table table-striped table-bordered table-hover table-padding" id="attribute">
                <thead>
                    <tr>
                      <td class="text-left">Payment Address</td>                              </tr>
                </thead>
                <tbody>
                    <tr id="attribute-row">
                      <td class="text-left">
                      VPN Infotech
                      <br>
                      302,Proton Plus
                      <br>
                      Near Star Bazaar,L.P.Savani Road,
                      <br>
                      Adajan
                      <br>
                      Surat
                      </td>
                    </tr>
                    
                </tbody>
                </table>
              </div>
             <!-- End : product add to cart table -->

             <!-- Start : product add to cart table --> 
              <div class="table-responsive table-padding">
                <table class="table table-striped table-bordered table-hover table-padding" id="attribute">
                <thead>
                    <tr>
                      <td class="text-left">Product</td>
                      <td class="text-left">Model</td>
                      <td class="text-left">Quantity</td>
                      <td class="text-left">Unit Price</td>
                      <td class="text-left">Total</td>
                      </tr>
                </thead>
                <tbody>
                    <tr id="attribute-row">
                      <td class="text-left">
                      <a href="#">SLR-012</a><br><small> - size: 20</small></td>
                      <td class="text-left">SLR-012</td>
                      <td class="text-left">1</td>
                      <td class="text-right">Rs.0.00</td>
                      <td class="text-right">Rs.0.00</td>
                    </tr>
                    <tr id="attribute-row">
                      <td class="text-right" colspan="4">Sub-Total</td>
                      <td class="text-right">Rs.0.00</td>
                    </tr>
                    <tr id="attribute-row">
                      <td class="text-right" colspan="4">Shipping Charges</td>
                      <td class="text-right">Rs.0.00</td>
                    </tr>
                    <tr id="attribute-row">
                      <td class="text-right" colspan="4">Total</td>
                      <td class="text-right">Rs.0.00</td>
                    </tr>
                </tbody>
                </table>
              </div>
             <!-- End : product add to cart table --> 
           
            </div>
            <!-- End : box-body -->
          </div>
        </div>
      </div>
      
      <!--End : Order Table-->
      
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header">
              <h3 class="box-title col-sm-6"><i class="fa fa-comment-o"></i> Order History</h2>
            </div>
            <div class="box-body"> 
            <form class="form-horizontal">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
                    <li><a href="#tab-data" data-toggle="tab">Data</a></li>
                  </ul>
                  <div class="tab-content">
                  	<!-- Start : tab-pane general-->
                    <div class="tab-pane active" id="tab-general">
                      <!-- Start : product add to cart table --> 
                        <!--<div class="table-responsive table-padding">
                          <table class="table table-striped table-bordered table-hover table-padding" id="attribute">
                          <thead>
                              <tr>
                                <td class="text-left">Date Added</td>
                                <td class="text-left">Comment</td>
                                <td class="text-left">Status</td>
                                <td class="text-left">Customer Notified</td>
                              </tr>
                          </thead>
                          <tbody>
                              <tr id="attribute-row">
                                <td>20/09/2016 </td>
                                <td>Add Comment here...</td>
                                <td class="">Pending</td>
                                <td>No</td>
                              </tr>
                               <tr id="attribute-row">
                                <td>20/09/2016 </td>
                                <td>Add Comment here...</td>
                                <td class="">Pending</td>
                                <td>No</td>
                              </tr>
                              
                          </tbody>
                          </table>
                        </div>-->
                        <table id="theme-table" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="col-xs-3 col-sm-3">Date Added</th>
                  <th class="col-xs-5 col-sm-5">Comment</th>
                  <th class="col-xs-2 col-sm-2">Status</th>
                  <th class="col-xs-2 col-sm-2">Customer Notified</th>
                </tr>
              </thead>
              <tbody>
			  <?php for($i=0;$i<=5;$i++){?>
              	<tr>
                  <td class="">20/09/2016</td>
                  <td>add comment Here...</td>
                  <td>Pending</td>
                  <td>No</td>
                </tr>
			  <?php }?>
              </tbody>
            </table>
                       <!-- End : product add to cart table -->
                    </div>
                    <!-- End : tab-pane-General -->
                    
                    <!-- Start : tab-pane data-->
                    <div class="tab-pane" id="tab-data">
                       <!-- Start : product add to cart table --> 
                        <div class="table-responsive table-padding">
                          <table class="table table-striped table-bordered table-hover" id="attribute">
                          <thead>
                              <tr>
                                <td class="text-left">Browser</td>
                              </tr>
                          </thead>
                          <tbody>
                              <tr id="attribute-row">
                                <td>IP Address</td>
                                <td>175.100.147.58</td>
                              </tr>
                              <tr id="attribute-row">
                                <td>User Accept</td>
                                <td>Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36</td>
                              </tr>
                              <tr id="attribute-row">
                                <td>Accept Language</td>
                                <td>en-US,en;q=0.8,und;q=0.6</td>
                              </tr>
                              
                          </tbody>
                          </table>
                        </div>
                       <!-- End : product add to cart table -->
                    </div>
                    <!-- End : tab-pane-data -->
                    
                    
                    <br/>
              <legend>Add Order History</legend>
             
                 <!------- start : Select group ------>
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label" for="order_status">Order Status</label>
                    <div class="col-sm-9 col-md-10">
                      <select name="order_status" id="order_status" class="form-control">
                        <option value="0"> Canceled </option>
                        <option value="0"> Canceled Reversal </option>
                        <option value="0"> Chargeback </option>
                        <option value="0"> Complete </option>
                        <option value="0"> denied </option>
                        <option value="0"> Expired </option>
                        <option value="0"> Failed </option>
                        <option value="0" selected="selected"> Pending </option>
                        <option value="0"> Processed </option>
                        <option value="0"> Processing </option>
                        <option value="0"> Refunded </option>
                        <option value="0"> Reversed </option>
                        <option value="0"> Shipped </option>
                         <option value="0"> Voided </option>
                      </select>
                    </div>
                </div>
                <!------- End : Select group ------>
                 
                 <!------- start : Select group ------>
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label" for="override">Override</label>
                    <div class="col-sm-9 col-md-10">
                       <input type="checkbox" class="minimal" id="override" name="override">
                    </div>
                </div>
                <!------- End : Select group ------>
                
                <!------- start : Select group ------>
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label" for="notify">Notify Customer</label>
                    <div class="col-sm-9 col-md-10">
                      <input type="checkbox" class="minimal" id="notify" name="notify">
                    </div>
                </div>
                <!------- End : Select group ------>
                <!------- start : input group ------>
                <div class="form-group">
                  <label for="comment" class="col-sm-3 col-md-2 control-label">Comment</label>
                  <div class="col-sm-9 col-md-10">
                    <textarea class="form-control" name="comment" id="comment" rows="5"></textarea>
                  </div>
                </div>
                <!------- end : input group ------>
                <!--Start : Button-->
                <div class="form-group">
                <div class="col-sm-12 text-right">
                  <button id="button-customer" class="btn btn-primary" type="button">
                  <i class="fa fa-plus-circle"></i>
                  Add History
                  </button>
                </div>
                </div>
                <!-- End : Button-->  
              </form>
            </div>
            <!-- End : box-body -->
          </div>
        </div>
      </div>
      
    </section>
    <!----------------------- Main content -------------------------------> 
  </div>
  <!------------------- End content-wrapper ---------------------------->
  
<script type="text/javascript">
	
	//Initialize Select2 Elements
    $(".select2").select2();
	
	//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
</script>

