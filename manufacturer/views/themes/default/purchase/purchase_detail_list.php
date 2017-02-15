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
                <input type="hidden" name="manufacturer_id" id="manufacturer_id" value="<?php echo $manufacturer_id; ?>" />
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Sale<small></small> </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
         <button class="btn btn-primary" onClick="printDiv()"><i class="fa fa-print"></i> Print</button>
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
                  <div class="col-md-12">
                      <div class="table-responsive">
                          <table class="table table-bordered">
                              <tbody>
                                  <tr>
                                      <td class="col-xs-2"><strong>Purchase Date</strong></td>
                                      <td class="col-xs-10">                                      	
										<?php 
                                        echo $purchase_date;                                    
                                        ?>                                      
                                      </td>
                                  </tr>
                                  <tr>
                                      <td class="col-xs-2"><strong>Manufacturer Name</strong></td>
                                      <td class="col-xs-10">
                                      <?php 
									  	echo $manufacturer_name;
									  ?>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td class="col-xs-2"><strong>Manufacturer Email</strong></td>
                                      <td class="col-xs-10">
                                      <?php 
									  	echo $manufacturer_email;
									  ?>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td class="col-xs-2"><strong>Manufacturer Contact</strong></td>
                                      <td class="col-xs-10">
                                      <?php 
									  
									  	echo $manufacturer_contact;
									  ?>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td class="col-xs-2"><strong>Note</strong></td>
                                      <td class="col-xs-10">                                     
                                      <?php 
									  	echo $note;
									  ?>
                                      </td>
                                  </tr>
                               </tbody>
                          </table>
                          <div class="table-responsive">
                              <table class="table table-striped table-bordered">
                                  <thead>
                                      <tr class="active">
                                          <th>Product</th>
                                          <th class="col-xs-2">Model</th>
                                          <th class="col-xs-2">Quantity</th>
                                          <th class="col-xs-2">Unit Cost</th>
                                          <th class="col-xs-2 text-right">Subtotal</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  	<?php
									if(isset($purchase_products))
									{
										for ($i = 0; $i < count($purchase_products['purchase_product']); $i++) {
											$product = $purchase_products['purchase_product'][$i];
											?>
                                            <tr>
                                            <td class="text-left"><?php echo $product['product_name']; ?><br />
                                            <?php
											 /*echo "<pre>";
										  print_r($product['product_option']['options']);
										  echo "</pre>";*/
											//echo 'count:'.count($product['product_option']['options']);
											foreach($product['product_option']['options'] as $option){
												?>
                                                 - <small><?php echo $option['option_name'].':'.$option['option_value']; ?></small><br />
                                                <?php
											}
											?>
                                            </td>
                                            <td class="text-left">
											<?php echo $product['product_model']; ?>
                                            </td>
                                            <td class="text-left">
											<?php echo $product['product_quantity']; ?>
                                            </td>
                                            <td class="text-left">
											<?php echo $currency_symbol.$product['product_price']; ?>
                                            </td>
                                            <td class="text-right">
											<?php echo $currency_symbol.$product['product_total']; ?>
                                            </td>
                                            
                                            </tr>
                                            <?php
										}
									}
									?>
                                  </tbody>
                              </table>
                              <table class="table table-striped table-bordered">
                                  <!--<thead>
                                      <tr class="active">
                                          <th>Total</th>                                        
                                      </tr>
                                  </thead>-->
                                  <tbody>
                                 	 <tr>
                                         <td class="text-left" colspan="4"><b>Total:</b></td>
                                         <td class="text-right"><b><?php echo $currency_symbol.$total; ?></b></td>
                                     </tr>
                                  </tbody>
                                </table>
                          </div>
                          <?php 
						 /* echo "<pre>";
						  print_r($purchase_products);
						  echo "</pre>";*/
						  ?>
                          <!--<div class="table-responsive">
                              <table class="table table-striped table-bordered">
                                  <thead>
                                      <tr class="active">
                                          <th>Product</th>
                                          <th class="col-xs-2">Model</th>
                                          <th class="col-xs-2">Quantity</th>
                                          <th class="col-xs-2">Unit Cost</th>
                                          <th class="col-xs-2">Subtotal</th>
                                      </tr>
                                  </thead>
                                  <tbody id="total">
                                  </tbody>
                              </table>
                          </div>-->
                         
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
	
	var strHtml = "<html>\n<head>\n <link rel=\"stylesheet\" type=\"text/css\" href=\"assets/admin/themes/default/css/AdminLTE.css\" media=\"print\">\n</head><body><center><h2>Expense Details</h2><center>\n<div style=\"border: 2px solid black !important;\">"
	+ DocumentContainer.innerHTML + "</div>\n</body>\n</html>";
	
	WindowObject.document.writeln(strHtml);
	WindowObject.document.close();
	WindowObject.focus();
	WindowObject.print();
	WindowObject.close();
}
//console.log('purchase_id: '+$('#purchase_id').val());
//console.log('manufacturer_id: '+$('#manufacturer_id').val());

var manufacturer_id=$('#manufacturer_id').val();
var purchase_id=$('#purchase_id').val();
	
/*$.ajax({
	type: 'POST',
	url: "<?php echo base_url()."api/api_purchasecart/getViewPurchaseProduct"; ?>",			
	//dataType: 'json',	
	data:{
		'manufacturer_id':manufacturer_id,
		'purchase_id':purchase_id
	},
	success: function(json) {
		console.log(json);
	
		// Totals
		html = '';

		if (json['purchase_product'].length) {
			for (i = 0; i < json['purchase_product'].length; i++) {
				product = json['purchase_product'][i];

				html += '<tr>';
				//html += '  <td class="text-left">' + product['name'] + ' ' + (!product['stock'] ? '<span class="text-danger">***</span>' : '') + '<br />';
				html += '  <td class="text-left">' + product['name'] + '<br />';
				if (product['option']) {
					for (j = 0; j < product['option'].length; j++) {
						option = product['option'][j];

						html += '  - <small>' + option['name'] + ': ' + option['value'] + '</small><br />';
					}
				}

				html += '  </td>';
				html += '  <td class="text-left">' + product['model'] + '</td>';
				html += '  <td class="text-right">' + product['quantity'] + '</td>';
				html += '  <td class="text-right">' + product['price'] + '</td>';
				html += '  <td class="text-right">' + product['total'] + '</td>';
				html += '</tr>';
			}
		}
			
		//console.log(json['totals']);
		if (json['totals'].length) {
			for (i in json['totals']) {
				total = json['totals'][i];

				html += '<tr>';
				html += '  <td class="text-left" colspan="4"><b>' + total['title'] + ':</b></td>';
				html += '  <td class="text-right"><b>' + total['text'] + '</b>';
				//html += '  <input type="hidden" name="getTotal" id="getTotal" value="'+ total['value'] +'">';
				html += '  </td>';
				html += '</tr>';
			}
		}

		if (!json['totals'].length && !json['products'].length) {
			html += '<tr>';
			html += '  <td colspan="5" class="text-center"><?php echo $text_no_results; ?></td>';
			html += '</tr>';
		}

		$('#total').html(html);
	},
	error: function(xhr, ajaxOptions, thrownError) {
		alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	}
});	*/	
	
	
	
	
	
	//console.log('manufacturer_id:'+manufacturer_id);
	/*$.ajax({
		type:"POST",
		url: "<?php echo base_url()."api/api_manufacturer"; ?>",			
		data:{
			'manufacturer_id':manufacturer_id,
		},
		dataType: 'json',
		//async:false,			
		success: function(json) {
			console.log('session set ack:'+json);
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url()."api/api_purchasecart/products"; ?>",			
				dataType: 'json',
				//crossDomain: true,
				//data:$('#tab-product input[name=\'select_manufacturers\']'),
				data:{
					'manufacturer_id':manufacturer_id,
					'purchase_id':purchase_id
				},
				success: function(json) {
					console.log(json);
				
					// Totals
					html = '';
		
					if (json['products'].length) {
						for (i = 0; i < json['products'].length; i++) {
							product = json['products'][i];
		
							html += '<tr>';
							//html += '  <td class="text-left">' + product['name'] + ' ' + (!product['stock'] ? '<span class="text-danger">***</span>' : '') + '<br />';
							html += '  <td class="text-left">' + product['name'] + '<br />';
							if (product['option']) {
								for (j = 0; j < product['option'].length; j++) {
									option = product['option'][j];
		
									html += '  - <small>' + option['name'] + ': ' + option['value'] + '</small><br />';
								}
							}
		
							html += '  </td>';
							html += '  <td class="text-left">' + product['model'] + '</td>';
							html += '  <td class="text-right">' + product['quantity'] + '</td>';
							html += '  <td class="text-right">' + product['price'] + '</td>';
							html += '  <td class="text-right">' + product['total'] + '</td>';
							html += '</tr>';
						}
					}
						
					//console.log(json['totals']);
					if (json['totals'].length) {
						for (i in json['totals']) {
							total = json['totals'][i];
		
							html += '<tr>';
							html += '  <td class="text-left" colspan="4"><b>' + total['title'] + ':</b></td>';
							html += '  <td class="text-right"><b>' + total['text'] + '</b>';
							//html += '  <input type="hidden" name="getTotal" id="getTotal" value="'+ total['value'] +'">';
							html += '  </td>';
							html += '</tr>';
						}
					}
		
					if (!json['totals'].length && !json['products'].length) {
						html += '<tr>';
						html += '  <td colspan="5" class="text-center"><?php echo $text_no_results; ?></td>';
						html += '</tr>';
					}
	
					$('#total').html(html);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});	
		}
	});*/
	
	


</script>