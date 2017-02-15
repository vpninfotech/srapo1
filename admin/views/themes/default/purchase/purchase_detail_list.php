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
      <h1>Purchase<small></small> </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
         <!--<button class="btn btn-primary" onClick="printDiv()" target="_blank"><i class="fa fa-print"></i> Print</button>-->
         <a href="<?php echo $invoice; ?>" target="_blank" data-toggle="tooltip" class="btn btn-info"><i class="fa fa-print"></i></a> 
         <a href="<?php echo $edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>        
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
                    <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> <?php echo $text_purchase_detail; ?></h3>
                  </div>
                  <table class="table">
                    <tbody>
                      <tr>
                        <td style="width: 1%;"><button data-toggle="tooltip" title="Store Name" class="btn btn-info btn-xs"><i class="fa fa-shopping-cart fa-fw"></i></button></td>
                        <td><?php echo $this->common->config('config_store_name'); ?></td>
                      </tr>
                      <tr>
                        <td><button data-toggle="tooltip" title="<?php echo $text_date_added; ?>" class="btn btn-info btn-xs"><i class="fa fa-calendar fa-fw"></i></button></td>
                        <td><?php echo $purchase_date2; ?></td>
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
                          <!--<table class="table table-bordered">
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
                          </table>-->
                          
                          <!---------------------------------------- table ---->
                          <table class="table table-bordered">
      <thead>
        <tr>
          <td><b><?php echo $column_product; ?></b></td>
          <td><b><?php echo $column_model; ?></b></td>
          <td class="text-right"><b><?php echo $column_quantity; ?></b></td>
          <td class="text-right"><b><?php echo $column_price; ?></b></td>
          <td class="text-right"><b><?php echo $column_total; ?></b></td>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($purchases as $purchase) { ?>
        <?php foreach ($purchase['product'] as $product) { ?>
        <tr>
          <td><?php echo $product['name']; ?>
            <?php foreach ($product['option'] as $option) { ?>
            <br />
            &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
            <?php } ?></td>
          <td><?php echo $product['model']; ?></td>
          <td class="text-right"><?php echo $product['quantity']; ?></td>
          <td class="text-right"><?php echo $product['price']; ?></td>
          <td class="text-right"><?php echo $product['total']; ?></td>
        </tr>
        <?php } ?>        
        <?php foreach ($purchase['total'] as $total) { ?>
        <tr>
          <td class="text-right" colspan="4"><b><?php echo $total['title']; ?></b></td>
          <td class="text-right"><?php echo $total['text']; ?></td>
        </tr>
        <?php } ?>
      <?php } ?>
      </tbody>
    </table>
    
    <!---------------- new table -->
        
                         
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
	
	var strHtml = "<html>\n<head>\n <link rel=\"stylesheet\" type=\"text/css\" href=\"assets/admin/themes/default/css/AdminLTE.css\" media=\"print\">\n</head><body><center><h2>Purchase Details</h2><center>\n<div style=\"border: 2px solid black !important;\">"
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