<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Expense<small></small> </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
     	  <button class="btn btn-primary" onClick="printDiv()"><i class="fa fa-print"></i> Print</button>
          <a href="<?php echo $add;?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
          <!--<button class="btn btn-default"><i class="fa fa-copy"></i></button>-->
          
          <button class="btn btn-danger" onclick="confirm('Are you sure ?') ? $('#form-information').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
    </section>
    
    <!-- Start : Main content -->
    <section class="content">
    <div class="row">
    <div class="col-xs-12">
		  <?php if ($error_warning) { ?>
          <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
          </div>
          <?php } ?>
          <?php if ($success) { ?>
          <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
          </div>
          <?php } ?>
        </div>
      </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h2 class="box-title col-sm-6">
            	<i class="fa fa-list"></i>
				Expense List
            </h2>           
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-information">
           <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
           
            <table id="theme-table" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>
                   <input type="checkbox" onClick="$('input[name*=\'selected\']').prop('checked', this.checked);">
             	  </th>             
                  <th class="<?php if ($sort_by == 'expense_date') echo "sort_$sort_order";?>"><a href="<?php echo base_url('expense/expense/index/expense_date/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Expense Date</a></th>
                  <th class="<?php if ($sort_by == 'reference') echo "sort_$sort_order";?>"><a href="<?php echo base_url('expense/expense/index/reference/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Reference</a></th>                  
                   <th class="<?php if ($sort_by == 'expense_amount') echo "sort_$sort_order";?>"><a href="<?php echo base_url('expense/expense/index/expense_amount/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Expense Amount</a></th>
                   <th class="<?php if ($sort_by == 'note') echo "sort_$sort_order";?>"><a href="<?php echo base_url('expense/expense/index/note/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Note</a></th>
                   <th class="<?php if ($sort_by == 'created_by') echo "sort_$sort_order";?>"><a href="<?php echo base_url('expense/expense/index/created_by/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">User Name</a></th>
                  <th class="col-xs-3 col-md-3 text-right">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
			  if(isset($records)){				
			  ?>
			  <?php foreach($records as $row){?>
              	<tr class="<?php //if(($row['is_deleted'] == 1)) { echo "bg-danger"; } ?>">
                  <td><?php if (in_array($row['expense_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $row['expense_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $row['expense_id']; ?>" />
                    <?php } ?>
                  </td>
                  <td class=""><?php echo $row['expense_date']; ?></td>
                  <td class=""><?php echo $row['reference']; ?></td>
                  <td class=""><?php echo $row['expense_amount']; ?></td>
                  <td class=""><?php echo $row['note']; ?></td> 
                  <td class=""><?php echo $row['user_name']; ?></td>                              
                  <td class="text-right">
                 	<a href="<?php echo $row['view']; ?>" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i>
                     </a>
                  <a href="<?php echo $row['edit']; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>                  
                  </td>
                </tr>
			  <?php }?>
              <?php
			  }
			  else
			  {
				  ?>
				  <tr>
                  	<td colspan="6" align="center">
						No Records
                    </td>
                  </tr>
                  <?php
			  }
			  ?>
              </tbody>
            </table>
            </form>           
          </div>
          <!-- /.box-body --> 
        </div>
        <!-- /.box --> 
    
    </div>
  </div>
  <!-- Start Pagination -->
    <div class="row">
      <div class="col-sm-6 col-xs-12 text-left"> <?php echo $pagination; ?> </div>
      <div class="col-sm-6 col-xs-12 text-right">
        <?php if(isset($records)){$count = count($records);}else {$count=0;} ?>
        Showing <?php echo (int)$range; ?> to <?php echo (int)($range+$count-1); ?> of <?php echo (int)$totals; ?> (<?php echo (int)$pages; ?> Pages)</div>
    </div>
  <!-- End Pagination -->
    
  </section>
  <!-- End : Main content --> 
  <!-- print report -->
  <div id="expense_report" style="display:none;">
  	<center><h1>Expense Report</h1>
    <table id="theme-table" class="table table-bordered table-hover">
      <thead>
        <tr>                              
          <th>Expense Date</th>
          <th>Reference</th>                  
          <th>Expense Amount</th>
          <th>Note</th>
          <th>User Name</th> 
        </tr>
      </thead>
      <tbody>
      <?php
      if(isset($records)){				
      ?>
      <?php foreach($records as $row){?>
        <tr>                
          <td><?php echo $row['expense_date']; ?></td>
          <td><?php echo $row['reference']; ?></td>
          <td><?php echo $row['expense_amount']; ?></td>
          <td><?php echo $row['note']; ?></td> 
          <td><?php echo $row['user_name']; ?></td> 
        </tr>
      <?php }?>
      <?php
      }
      else
      {
          ?>
          <tr>
            <td colspan="6" align="center">
                No Records
            </td>
          </tr>
          <?php
      }
      ?>
      </tbody>
    </table>
    </center>
  </div>
<script type="text/javascript">

function printDiv() 
{
	
	var DocumentContainer = document.getElementById('expense_report');
	var WindowObject = window.open('', 'PrintWindow', 'width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes');
	/*var strHtml = "<html>\n<head>\n <link rel=\"stylesheet\" type=\"text/css\" href=\"test.css\">\n</head><body><div style=\"testStyle\">\n"
	+ DocumentContainer.innerHTML + "\n</div>\n</body>\n</html>";*/
	
	var strHtml = "<html>\n<head>\n <link rel=\"stylesheet\" type=\"text/css\" href=\"assets/admin/themes/default/css/AdminLTE.css\" media=\"print\">\n</head><body>\n"
	+ DocumentContainer.innerHTML + "\n</body>\n</html>";
	
	WindowObject.document.writeln(strHtml);
	WindowObject.document.close();
	WindowObject.focus();
	WindowObject.print();
	WindowObject.close();
}

</script>