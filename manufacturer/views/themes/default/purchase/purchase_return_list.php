<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Sale Return<small></small> </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
       <div class="pull-right">
          <!-- <a href="<?php echo $add;?>" class="btn btn-primary"><i class="fa fa-plus"></i></a> -->
          <!--<button class="btn btn-default"><i class="fa fa-copy"></i></button>-->
          <button class="btn btn-danger" id="button-delete"><i class="fa fa-trash-o"></i></button>
       </div>
    </section>
    
    <!-- Start : Main content -->
    <section class="content">   

     	<?php if(isset($error) && $error!==""): ?>
        <div class="col-xs-12">
            <div class="alert alert-danger alert-bold-border">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
               <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error;?>
            </div>
        </div>
        <?php endif; ?>
        <?php if(isset($success) && $success!==""): ?>
        <div class="col-xs-12">
            <div class="alert alert-success alert-bold-border">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
              <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success;?>
            </div>
        </div>
        <?php endif; ?>
      <div class="row">
    
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h2 class="box-title col-sm-6">
            	<i class="fa fa-list"></i>
				Sale Return List
            </h2>            
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
          <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-category">
          		<input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
    		
            <table id="theme-table" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="text-center">
					           <input type="checkbox" onClick="$('input[name*=\'selected\']').prop('checked', this.checked);">
             	  </th>
                   <th class="<?php if ($sort_by == 'date_added') echo "sort_$sort_order";?>"><a href="<?php echo base_url('purchase/purchase_return/index/date_added/'.(($sort_order == 'ASC' && $sort_by == 'date_added') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Date</a></th> 
                   <th class="<?php if ($sort_by == 'purchase_return_id') echo "sort_$sort_order";?>"><a href="<?php echo base_url('purchase/purchase_return/index/purchase_return_id/'.(($sort_order == 'ASC' && $sort_by == 'purchase_return_id') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Purchase Return ID</a></th>  
                  <th class="<?php if ($sort_by == 'purchase_id') echo "sort_$sort_order";?>"><a href="<?php echo base_url('purchase/purchase_return/index/purchase_id/'.(($sort_order == 'ASC' && $sort_by == 'purchase_id') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Purchase ID</a></th> 
                 
                  
                  <th class="<?php if ($sort_by == 'manufacturer_id') echo "sort_$sort_order";?>"><a href="<?php echo base_url('purchase/purchase_return/index/manufacturer_id/'.(($sort_order == 'ASC' && $sort_by == 'manufacturer_id') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Manufacturer</a></th>                
                  <th class="<?php if ($sort_by == 'product_name') echo "sort_$sort_order";?>"><a href="<?php echo base_url('purchase/purchase_return/index/product_name/'.(($sort_order == 'ASC' && $sort_by == 'product_name') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Product Name</a></th> 
                  <th class="<?php if ($sort_by == 'model') echo "sort_$sort_order";?>"><a href="<?php echo base_url('purchase/purchase_return/index/model/'.(($sort_order == 'ASC' && $sort_by == 'model') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Product Model</a></th> 
                  <th class="<?php if ($sort_by == 'return_reason_name') echo "sort_$sort_order";?>"><a href="<?php echo base_url('purchase/purchase_return/index/return_reason_name/'.(($sort_order == 'ASC' && $sort_by == 'return_reason_name') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Return Reason</a></th> 
                  <th class="<?php if ($sort_by == 'opened') echo "sort_$sort_order";?>"><a href="<?php echo base_url('purchase/purchase_return/index/opened/'.(($sort_order == 'ASC' && $sort_by == 'opened') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Product Opened?</a></th>
                   <th class="<?php if ($sort_by == 'comment') echo "sort_$sort_order";?>"><a href="<?php echo base_url('purchase/purchase_return/index/comment/'.(($sort_order == 'ASC' && $sort_by == 'comment') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Comment</a></th>  
                                  
                  <th class="col-xs-1 text-right">Actions</th>
                </tr>
              </thead>
              <tbody>
              
			  <?php if(isset($records)){
					foreach($records as $row){
                ?>
              	<tr class="<?php //if(($row['is_deleted'] == 1)) { echo "bg-danger"; } ?>">
					<td class="text-center">
                    <?php if (in_array($row['purchase_return_id'], $selected)) { ?>
                        <input type="checkbox" name="selected[]" value="<?php echo $row['purchase_return_id']; ?>" checked="checked" />
                        <?php } else { ?>
                        <input type="checkbox" name="selected[]" value="<?php echo $row['purchase_return_id']; ?>" />
                    <?php } ?>
                    </td>
                    <td class=""><?php echo $row['date_ordered']; ?></td>
                    <td class=""><?php echo $row['purchase_return_id']; ?></td>
                    <td class=""><?php echo $row['purchase_id']; ?></td>
                    <td class="col-sm-2"><?php echo $row['manufacturer_name']; ?></td>
                    <td class=""><?php echo $row['product_name']; ?><input type="hidden" name="product_id" id="product_id" value="<?php echo $row['product_id']; ?>" /></td>
                    <td class=""><?php echo $row['model']; ?></td>
                    <td class="col-sm-2"><?php echo $row['return_reason_name']; ?><input type="hidden" name="return_reason_id" id="return_reason_id" value="<?php echo $row['return_reason_id']; ?>" /></td>
                    <td class=""><?php echo $row['opened']; ?></td>
                    <td class=""><?php echo $row['comment']; ?></td>
					<td>
                    <div class="text-right">
                       <a href="<?php echo $row['view']; ?>" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i>
                     </a>
                       
                  		<!-- <a href="<?php echo $row['edit']; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a> -->
                    </div>
                    </td>
                </tr>
			  <?php }?>
              <?php
			  }
			  else
			  {
			  ?>
			  <tr>
			    <td colspan="11" align="center"> No Records </td>
			  </tr>
			  <?php
			  }
			  ?>
              </tbody>
            </table>
            
            <!--<table id="theme-table" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="col-xs-1">
					<input type="checkbox" class="minimal" id="SelectAll">
             	  </th>
                  <th class="col-xs-2 col-sm-2">Date</th>
                  <th class="col-xs-1 col-sm-1">Reference</th>
                  <th class="col-xs-1 col-sm-1">Amount</th>
                  <th class="col-xs-2 col-sm-2">Note</th>
                  <th class="col-xs-2 col-sm-2">Created By</th>
                  <th class="col-xs-1 col-sm-1 text-center"><i class="fa fa-chain"></i></th>
                  <th class="col-xs-3 col-sm-3">Actions</th>
                </tr>
              </thead>
              <tbody>
			  <?php for($i=0;$i<=4;$i++){?>
              		<tr>
					<td><input type="checkbox" class="minimal"></td>
					<td class="">Mon 23 May 2016 05:27 AM</td>
                    <td class="">PO/REF/01</td>
                    <td class="text-right">200.00</td>
                    <td class="">This is test purchase</td>
                    <td class="">VPN</td>
                    <td class="text-center"><a class="btn btn-primary btn-sm" href="#" target="_blank">
                    <i class="fa fa-chain"></i>
                    </a></td>
					<td>
                    <div class="text-center">
                        <div class="btn-group">
                        <a href="#" class="btn btn-primary" onClick="window.open('http://localhost/srapo/list_expense_detail.php', 'popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,screenx=0,screeny=0'); return false;">
                        <i class="fa fa-picture-o"></i>
                        </a>
                        </div>
                        
                        <div class="btn-group">
                        <a href="#" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        </div>
                        
                        <div class="btn-group">
                        <a href="" onclick="return confirm('You are going to delete category, please click ok to delete.')" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </div>
                    </td>
                </tr>
			  <?php }?>
              </tbody>
            </table>-->
            
            
            </form>
          </div>
          <!-- /.box-body --> 
        </div>
        <!-- /.box --> 
   
    </div>
  </div>
  
   <!-- Start : Paggination -->
   <!--<div class="row">
    	<div class="col-sm-6 col-xs-12 text-left">
    		<?php echo $pagination; ?>
    	</div>
        <div class="col-sm-6 col-xs-12 text-right">
			<?php 
            if(isset($records))
            {
            ?>
				<?php $count = count($records); ?>
                Showing <?php echo (int)$range; ?> to <?php echo (int)($range+$count-1); ?> of <?php echo (int)$totals; ?> (<?php echo (int)$pages; ?> Pages)
            <?php
            }
            ?>
        </div>
    </div>-->
    <!-- End : Paggination -->
  
  </section>
  <!-- End : Main content --> 

<script type="text/javascript">
$('#button-delete').click(function(){
  if($('form input[type=checkbox]:checked').size() > 0)
  {
    var res = confirm('Are you sure ?');
    if(res)
    {
      $('form').submit();
    }  
  }
  else
  {
    alert("Please select atleast one value")
  }

});

</script>