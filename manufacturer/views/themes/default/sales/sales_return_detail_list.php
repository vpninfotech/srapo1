<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
  <!-- Select2 -->
  <script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>
  <!-- bootstrap datepicker -->
  <script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
  
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 

          		<input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
                <input type="hidden" name="purchase_id" id="purchase_id" value="<?php echo $purchase_id; ?>" />
                <input type="hidden" name="purchase_return_id" id="purchase_return_id" value="<?php echo $purchase_id; ?>" />
                <input type="hidden" name="purchase_order_id" id="purchase_order_id" value="<?php echo $purchase_order_id; ?>" />
                <input type="hidden" name="manufacturer_id" id="manufacturer_id" value="<?php echo $manufacturer_id; ?>" />
                <input type="hidden" name="view_keyword" id="view_keyword" value="<?php echo $view_keyword; ?>" />
                
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Sales Return<small></small> </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
         <!--<button class="btn btn-primary" onClick="printDiv()"><i class="fa fa-print"></i> Print</button>-->
         <a href="<?php echo $invoice; ?>" target="_blank" data-toggle="tooltip" class="btn btn-info"><i class="fa fa-print"></i></a> 
         <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
    </section>
    
    <!-- Start : Main content -->
    <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h2 class="box-title col-sm-6">
            	<!--<i class="fa fa-list"></i>-->
                <?php echo $text_form; ?>				
            </h2>           
          </div>
          <!-- /.box-header -->
          <div class="box-body" id="invoice">
              <div class="row">
              <!-- start Purchase details -->
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> <?php echo $text_purchase_return_detail; ?></h3>
                  </div>
                  <table class="table">
                    <tbody>
                      <tr>
                        <td style="width: 1%;"><button data-toggle="tooltip" title="Store Name" class="btn btn-info btn-xs"><i class="fa fa-shopping-cart fa-fw"></i></button></td>
                        <td><?php echo $this->common->config('config_store_name'); ?></td>
                      </tr>
                      <tr>
                        <td><button data-toggle="tooltip" title="<?php echo $text_date_added; ?>" class="btn btn-info btn-xs"><i class="fa fa-calendar fa-fw"></i></button></td>
                        <td><?php echo $purchase_return_date1; ?></td>
                      </tr>
                      <tr>
                        <td><button data-toggle="tooltip" title="<?php echo $text_invoice; ?>" class="btn btn-info btn-xs"><i class="fa fa-envelope"></i></button></td>
                        <td><?php echo $invoice_prefix.$invoice_no; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
      		  <!-- end Purchase details -->
              
              <!-- start Manufacturer details -->
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-user"></i> <?php echo $text_manufacturer; ?></h3>
                  </div>
                  <table class="table">
                    <tr>
                      <td style="width: 1%;"><button data-toggle="tooltip" title="<?php echo $text_manufacturer; ?>" class="btn btn-info btn-xs"><i class="fa fa-user fa-fw"></i></button></td>
                      <td><?php if ($manufacturer_name) { ?>
                        <?php echo $firstname; ?> <?php echo $lastname; ?>
                        <?php } else { ?>
                        <?php echo $firstname; ?> <?php echo $lastname; ?>
                        <?php } ?></td>
                    </tr>                   
                    <tr>
                      <td><button data-toggle="tooltip" title="<?php echo $text_email; ?>" class="btn btn-info btn-xs"><i class="fa fa-envelope-o fa-fw"></i></button></td>
                      <td><?php echo $manufacturer_email; ?></td>
                    </tr>
                    <tr>
                      <td><button data-toggle="tooltip" title="<?php echo $text_telephone; ?>" class="btn btn-info btn-xs"><i class="fa fa-phone fa-fw"></i></button></td>
                      <td><?php echo $manufacturer_telephone; ?></td>
                    </tr>
                  </table>
                </div>
              </div>
      		  <!-- end Manufacturer details -->
                  <div class="col-md-12">
                      <div class="table-responsive">
                          <table class="table table-bordered">
                              <tbody>                                 
                                  <tr>
                                      <td class="col-xs-2"><strong>Comment</strong></td>
                                      <td class="col-xs-10">                                     
                                      <?php 
									  	echo $comment;
									  ?>
                                      </td>
                                  </tr>
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
                                      <td class="col-xs-10" id="text_product_name"></td>
                                  </tr>
                                  <tr>
                                      <td class="col-xs-2"><strong>Product Model Name</strong></td>
                                      <td class="col-xs-10" id="text_product_model_name"></td>
                                  </tr>
                                  <tr>
                                      <td class="col-xs-2"><strong>Product Quantity</strong></td>
                                      <td class="col-xs-10" id="text_product_quantity"></td>
                                  </tr>
                                  <tr>
                                      <td class="col-xs-2"><strong>Product Options</strong></td>
                                      <td class="col-xs-10" id="text_product_options"></td>
                                  </tr>
                                  <tr>
                                      <td class="col-xs-2"><strong>Total Price</strong></td>
                                      <td class="col-xs-10" id="text_product_options"><?php echo $currency_symbol.$total; ?></td>
                                  </tr>
                                  
                               </tbody>
                          </table>
                       </div>
                      
                  </div>
                  
          </div>
          <!-- /.box-body --> 
        </div>
        <!-- /.box --> 
      </div>
    </div>
  </div>
  </section>

  <!-- End : Main content --> 
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

function printDiv() 
{
	var DocumentContainer = document.getElementById('invoice');
	var WindowObject = window.open('', 'PrintWindow', 'width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes');
	/*var strHtml = "<html>\n<head>\n <link rel=\"stylesheet\" type=\"text/css\" href=\"test.css\">\n</head><body><div style=\"testStyle\">\n"
	+ DocumentContainer.innerHTML + "\n</div>\n</body>\n</html>";*/
	
	var strHtml = "<html>\n<head>\n <link rel=\"stylesheet\" type=\"text/css\" href=\"assets/admin/themes/default/css/AdminLTE.css\" media=\"print\">\n</head><body><center><h2>Purchase Return Details</h2><center>\n<div style=\"border: 2px solid black !important;\">"
	+ DocumentContainer.innerHTML + "</div>\n</body>\n</html>";
	
	WindowObject.document.writeln(strHtml);
	WindowObject.document.close();
	WindowObject.focus();
	WindowObject.print();
	WindowObject.close();
}
</script>
<div style="display:none;">                      
    <input type="text" name="product_id" id="product_id" value="<?php echo $product_id; ?>">
    <input type="hidden" name="purchase_product_id" class="form-control" id="purchase_product_id" > 
    <select name="select_product_name" id="select_product_name" class="form-control">                  
        <option value="">Select Product Name</option>
    </select>
    <input type="text" name="product_options" class="form-control" id="product_options">
</div>
<script>
$(document).ready(function() {	
	
	if($('#view_keyword').val() == 1)
	{		
		$('#product_id').val("<?php echo $product_id; ?>");
		$('#purchase_id').val("<?php echo $purchase_id; ?>");
		$('#select_purchase_id').val("<?php echo $purchase_id; ?>");
		$('#purchase_product_id').val("<?php echo $purchase_product_id; ?>");
		var purchase_product_id="<?php echo $purchase_product_id; ?>";
		var product_id = "<?php echo $product_id; ?>";
		
		$.ajax({
			type:'POST',
			url:"<?php echo base_url('sales/sale_return/getProductList'); ?>",
			data:{
				'purchase_id':$('#select_purchase_id').val(),
				'manufacturer_id':$('#manufacturer_id').val()
			},
			dataType:"json",
			success: function(json){
				console.log('pn: '+json);
				
				var html="";
				product_id=$('#product_id').val();			
				var json_data=JSON.stringify(json);
				
				html+="<option value=''>Select Product Name</option>";
				$.each(json,function(index,value){
				
					if(product_id > 0)
					{
						if(value.product_id == product_id)
						{
							html+="<option value='"+value.product_id+"' data-id='"+value.purchase_product_id+"' data-model='"+value.model+"' data-quantity='"+value.quantity+"' selected='selected'>"+value.name+"</option>";
											
							product_id=value.product_id;
							$('#purchase_product_id').val(value.purchase_product_id);
							$('#product_model_name').val(value.model);
							$('#model_name').val(value.model);
							$('#product_quantity').val(value.quantity);
							$('#quantity').val(value.quantity);	
							$('#text_product_name').text(value.name);
							$('#text_product_model_name').text(value.model);
							$('#text_product_quantity').text(value.quantity);							
						}
						else
						{
							html+="<option value='"+value.product_id+"' data-id='"+value.purchase_product_id+"' data-model='"+value.model+"' data-quantity='"+value.quantity+"'>"+value.name+"</option>";
						}
					}
					else
					{
						
						html+="<option value='"+value.product_id+"' data-id='"+value.purchase_product_id+"' data-model='"+value.model+"' data-quantity='"+value.quantity+"'>"+value.name+"</option>";
					}
					
				});
				
				$("#select_product_name").html(html);
				console.log(purchase_product_id);
				productOptions(purchase_product_id,product_id);
				//$("#select_product_name").select2();
					
			}
		});
		
		
		function productOptions(purchase_product_id,product_id)
		{	
			$.ajax({
				type:'POST',			
				url:"<?php echo base_url('sales/sale_return/ProductOptions'); ?>",
				data:{							
					'manufacturer_id':$('#manufacturer_id').val(),
					'purchase_id':$('#purchase_id').val(),
					'purchase_product_id':purchase_product_id,
					'product_id': product_id
				},
				dataType:"json",
				success: function(json){
					//console.log('product_options:'+json);
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
								
	}
});
</script>