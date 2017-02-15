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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Expense </h1>
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
          		
             <div class="table-responsive" >
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>Expense Date</strong></td>
                            <td>
                            	<strong class="text-right">
									<?php 
									echo $expense_date;                                    
                                    ?>
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Expense Name</strong></td>
                            <td>
                            	<strong class="text-right">
									<?php 
									echo $expense_name;                                    
                                    ?>
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Reference</strong></td>
                            <td>
                            	<strong class="text-right">
									<?php echo $expense_reference; ?>
                                </strong>
                             </td>
                        </tr>
                        <tr>
                            <td><strong>Amount</strong></td>
                            <td>
                            	<strong class="text-right">
                                	<?php echo $expense_amount; ?>
                            	</strong>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Tax</strong></td>
                            <td>
                            	<strong class="text-right">
                                
                                	<?php 
									echo $tax_symbol.$tax_payable_amount.'('.$expense_tax_name.') - '.$currency_symbol.$payable_amount; 
									/*if($tax_type == 'F')
									{
										echo $tax_symbol.$tax_payable_amount.'('.$expense_tax_name.') - '.$currency_symbol.$payable_amount; 
									}
									else
									{
										echo $tax_payable_amount.$tax_symbol.'('.$expense_tax_name.') - '.$currency_symbol.$payable_amount; 
									}*/
									?>
                            	</strong>
                            </td>
                        </tr>                       
                        <tr>
                            <td><strong>Customer</strong></td>
                            <td>
                            	<strong class="text-right">
                                	<?php echo $expense_user_name; ?>
                            	</strong>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Note</strong></td>
                            <td>
                            	<strong class="text-right">
                                	<?php echo $expense_note; ?>
                            	</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
             </div>
          </div>
          <!-- /.box-body --> 
        </div>
        <!-- /.box --> 
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
	
	var strHtml = "<html>\n<head>\n <link rel=\"stylesheet\" type=\"text/css\" href=\"assets/admin/themes/default/css/AdminLTE.css\" media=\"print\">\n</head><body><center><h2>Expense Details</h2><center>\n"
	+ DocumentContainer.innerHTML + "\n</body>\n</html>";
	
	WindowObject.document.writeln(strHtml);
	WindowObject.document.close();
	WindowObject.focus();
	WindowObject.print();
	WindowObject.close();
}

</script>