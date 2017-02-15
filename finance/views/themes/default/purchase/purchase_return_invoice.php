<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>

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
  <style type="text/css">
    .table thead td {
    font-weight: bold;
}
  </style>
</head>
<body>
<div class="container">
	<input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
	<input type="hidden" name="purchase_id" id="purchase_id" value="<?php echo $purchase_id; ?>" />
	<input type="hidden" name="purchase_return_id" id="purchase_return_id" value="<?php echo $purchase_return_id; ?>" />
	<input type="hidden" name="purchase_order_id" id="purchase_order_id" value="<?php echo $purchase_order_id; ?>" />
	<input type="hidden" name="manufacturer_id" id="manufacturer_id" value="<?php echo $manufacturer_id; ?>" />
				
  <?php foreach ($purchases as $purchase) { ?>
  <div style="page-break-after: always;">
    <h1><?php echo $text_invoice; ?> #<?php echo $purchase['purchase_id']; ?></h1>
   <a class="pull-right" style="font-size:20px;" target="_blank" onClick="javascript:print()"><i class="fa fa-print"></i></a>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td colspan="2"><?php echo $text_purchase_detail; ?></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="width: 50%;"><address>
            <strong><?php echo $purchase['store_name']; ?></strong><br />
            <?php echo $purchase['store_address']; ?>
            </address>
            <b><?php echo $text_telephone; ?></b> <?php echo $purchase['store_telephone']; ?><br />
            <?php if ($purchase['store_fax']) { ?>
            <b><?php echo $text_fax; ?></b> <?php echo $purchase['store_fax']; ?><br />
            <?php } ?>
            <b><?php echo $text_email; ?></b> <?php echo $purchase['store_email']; ?><br />
            </td>
          <td style="width: 50%;"><b><?php echo $text_date_added; ?></b> <?php echo $purchase['date_added']; ?><br />
            <?php if ($purchase['invoice_no']) { ?>
            <b><?php echo $text_invoice_no; ?></b> <?php echo $purchase['invoice_no']; ?><br />
            <?php } ?>
            <!--<b><?php echo $text_order_id; ?></b> <?php echo $purchase['order_id']; ?><br />--> 
		   <?php if ($purchase['manufacturer_name']) { ?>
            <b><?php echo 'Manufacturer Name:'; ?></b> <?php echo $purchase['manufacturer_name']; ?><br />
            <?php } ?>
			<?php if ($purchase['manufacturer_email']) { ?>
            <b><?php echo 'Manufacturer Email:'; ?></b> <?php echo $purchase['manufacturer_email']; ?><br />
            <?php } ?>
			<?php if ($purchase['manufacturer_mobile']) { ?>
            <b><?php echo 'Manufacturer Mobile:'; ?></b> <?php echo $purchase['manufacturer_mobile']; ?><br />
            <?php } ?>
			<?php if ($purchase['manufacturer_address']) { ?>
            <b><?php echo 'Manufacturer Address:'; ?></b> <?php echo $purchase['manufacturer_address']; ?><br />
            <?php } ?>
        </tr>
      </tbody>
    </table>
	
  </div>
  <?php } ?>
  
  <!------------             Table          ------------------->
	<table class="table table-bordered">
		<tbody>
		  <!--<tr>
			  <td class="col-xs-2"><strong>Purchase Return Date</strong></td>
			  <td class="col-xs-10">                                      	
				<?php 
				//echo $purchase_return_date;                                        
				?>                                      
			  </td>
		  </tr>-->		 
		 
		  <tr>                                 
			  <td class="col-xs-2" colspan="2" style="padding:15px;"><strong>Product Return Reason / Action / Status:-</strong></td>                            
		  </tr>
		  <tr>
			  <td class="col-xs-2"><strong>Product Return Reason</strong></td>
			  <td class="col-xs-10">                                     
			  <?php 
				echo $return_reason;
			  ?>
			  </td>
		  </tr>
		  <tr>
			  <td class="col-xs-2"><strong>Product Return Action</strong></td>
			  <td class="col-xs-10">                                     
			  <?php 
				echo $return_action;
			  ?>
			  </td>
		  </tr>
		  <tr>
			  <td class="col-xs-2"><strong>Product Return Status</strong></td>
			  <td class="col-xs-10">                                     
			  <?php 
				echo $return_status;
			  ?>
			  </td>
		  </tr>                                  
		  <tr>
			  <td class="col-xs-2" colspan="2" style="padding:15px;"><strong>Product Return Details:-</strong></td>                            
		  </tr>
		  <tr>
			  <td class="col-xs-2"><strong>Product Name</strong></td>
			  <td class="col-xs-10"><?php echo $product_name; ?></td>
		  </tr>
		  <tr>
			  <td class="col-xs-2"><strong>Product Model Name</strong></td>
			  <td class="col-xs-10"><?php echo $product_model; ?></td>
		  </tr>
		  <tr>
			  <td class="col-xs-2"><strong>Product Quantity</strong></td>
			  <td class="col-xs-10"><?php echo $product_quantity; ?></td>
		  </tr>
		  <tr>
			  <td class="col-xs-2"><strong>Product Options</strong></td>
			  <td class="col-xs-10" id="text_product_options"></td>
		  </tr>
		  <tr>
			  <td class="col-xs-2"><strong>Total Price</strong></td>
			  <td class="col-xs-10"><?php echo $total; ?></td>
		  </tr>
           <tr>
			  <td class="col-xs-2"><strong>Comment</strong></td>
			  <td class="col-xs-10">                                     
			  <?php 
				echo $comment;
			  ?>
			  </td>
		  </tr>
	   </tbody>
	</table>
	<!------------             //Table          ------------------->
  
</div>
</body>
</html>
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/js/common.js"></script>
<div style="display:none;">      
	<input type="hidden" name="manufacturer_id" id="manufacturer_id" value="<?php echo $manufacturer_id; ?>">                
    <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id; ?>">
    <input type="hidden" name="purchase_product_id" class="form-control" id="purchase_product_id"  value="<?php echo $purchase_product_id; ?>"> 
    <select name="select_product_name" id="select_product_name" class="form-control">                  
        <option value="">Select Product Name</option>
    </select>
    <input type="hidden" name="product_options" class="form-control" id="product_options">
</div>
<script>
$(document).ready(function() {	
	var product_id=$('#product_id').val();
	var purchase_product_id=$('#purchase_product_id').val();	
	//console.log($('#purchase_id').val());
		productOptions(purchase_product_id,product_id);
		function productOptions(purchase_product_id,product_id)
		{	
			$.ajax({
				type:'POST',			
				url:"<?php echo base_url('purchase/purchase_return/productOptions'); ?>",
				data:{							
					'manufacturer_id':$('#manufacturer_id').val(),
					'purchase_id':$('#purchase_id').val(),
					'purchase_product_id':purchase_product_id,
					'product_id': product_id
				},
				dataType:"json",
				success: function(json){
					console.log('product_options:'+json);
					var str='';
					//console.log(json.length);
					if(json.length > 1)
					{					
						$.each(json,function(index,value){
							str+=value.name+':'+value.value+', ';						
						});
					}
					else
					{					
						$.each(json,function(index,value){
							if(value.name == null || value.value == null)
							{								
								str+='';
							}
							else
							{								
								str+=value.name+':'+value.value;
							}
						});					
					}	
					
					$('#product_options').val(str);
					$('#text_product_options').text(str);
				}
			});
		}
});
</script>
