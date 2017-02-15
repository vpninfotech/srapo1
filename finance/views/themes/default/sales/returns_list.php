<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Product Returns<small></small> </h1>
    <ul class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul>
    <div class="pull-right"> 
      <!--<a href="<?php echo $add;?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
      <button class="btn btn-danger" id="button-delete"><i class="fa fa-trash-o"></i></button>-->
    </div>
  </section>
  
  <!-- Start : Main content -->
  <section class="content">
  <div class="well well-sm sales_report">
    <div class="row"> 
    <form action="<?php echo base_url("sales/returns/search"); ?>" method="post">
      <!-- start : left column -->
      <div class="col-sm-3"> 
        <!------- start : input group ------>
        <div class="form-group">
          <label for="product" class="col-sm-12 control-label">Return Id</label>
          <div class="col-sm-12 input-padding">
              <input type="text" name="return_id" id="return_id" value="<?php echo $return_id; ?>" class="form-control" placeholder="Return Id">
          </div>
        </div>
        <!------- end : input group ------> 
        
        <!------- start : input group ------>
        <div class="form-group">
          <label for="product" class="col-sm-12 control-label">Order Id</label>
          <div class="col-sm-12 input-padding">
              <input type="text" name="order_id" id="order_id" value="<?php echo $order_id; ?>" class="form-control" placeholder="Order Id">
          </div>
        </div>
        <!------- end : input group ------> 
        
        <!------- start : input group ------> 
        
      </div>
      <!-- End : Left column --> 
      
      <!-- start : right column -->
      <div class="col-sm-3"> 
        <!-- Start : input Group -->
        <div class="form-group">
          <label for="author" class="col-sm-3 col-md-2 control-label">Customer</label>
          <div class="col-sm-12 input-padding">
            <input type="text" name="customer" id="customer" class="form-control" placeholder="Customer" value="<?php echo $customer;?>">
            
          </div>
        </div>
        <!------- end : input group ------> 
        <!-- Start : Total -->
        <div class="form-group">
          <label for="author" class="col-sm-3 col-md-2 control-label">Product</label>
          <div class="col-sm-12 input-padding">
            <input type="text" name="product" id="product" class="form-control" placeholder="Product" value="<?php echo $product;?>">
            
          </div>
        </div>
      </div>
      <!-- End : Total -->
      <div class="col-sm-3"> 
        <!-- Start : Total -->
        <div class="form-group">
          <label for="author" class="col-sm-3 col-md-2 control-label">Model</label>
          <div class="col-sm-12 input-padding">
            <input type="text" name="model" id="model" class="form-control" placeholder="Model" value="<?php echo $model;?>">
          </div>
        </div>
        
        <!-- End : Total --> 
        <!-- Start : input Group -->
        <div class="form-group">
          <label for="group_by" class="col-sm-12 control-label">Return Status</label>
          <div class="col-sm-12 input-padding">
            <select name="return_status_id" id="return_status_id" class="form-control">
            <option value=""></option>            
                <?php
				foreach($status as $return_status)
				{
					?>
					<option value="<?php echo $return_status['return_status_id']; ?>"> <?php echo $return_status['return_status_name']; ?></option>
					<?php
				}
			  	?>  
            </select> 
            <script>
                $("#return_status_id").val(<?php echo $return_status_id; ?>);
              </script>            
          </div>
        </div>
        <!-- End : input Group --> 
      </div>
      <div class="col-sm-3"> 
        <!-- Start : Date Picker Group -->
        <div class="form-group">
          <label for="date_added" class="col-sm-12 control-label">Date Added</label>
          <div class="col-sm-12 input-padding">
            <div class="input-group date">
              <input id="date_added" name="date_added" placeholder="Date Added" class="form-control pull-right" type="text" value="<?php echo $date_added;?>">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            </div>
          </div>
        </div>
        <!------ End : Date Picker Group ------> 
        <!-- Start : Date Picker Group -->
        <div class="form-group">
          <label for="date_added" class="col-sm-12 control-label">Date Modified</label>
          <div class="col-sm-12 input-padding">
            <div class="input-group date">
              <input id="date_modified" name="date_modified" placeholder="Date Modified" class="form-control pull-right" type="text" value="<?php echo $date_modified;?>">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            </div>
          </div>
        </div>
        <!------ End : Date Picker Group ------> 
        
        <!--Start : Filter Button-->
        <div class="col-md-12">
           <div class="pull-right">
         <button type="submit" id="button-filter" name="button_filter" class="btn btn-primary" value="search"> <i class="fa fa-search"></i> Filter </button>
         <button type="submit" id="button-all" name="button_all" class="btn btn-primary" value="all"> <i class="fa fa-search"></i> All </button>
      </div>
        </div>
        <!--End : Filter Button--> 
      </div>
      <!-- End : right column --> 
      </form>
    </div>   
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h2 class="box-title col-sm-6"> <i class="fa fa-list"></i> Product Return List </h2>
        </div>
        <!-- /.box-header -->        
        <div class="box-body">
         <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-returns">
           <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />       
          <table id="theme-table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <!--<th> <input type="checkbox" onClick="$('input[name*=\'selected\']').prop('checked', this.checked);">
                </th>-->                
                <th class="<?php if ($sort_by == 'return_id') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/returns/index/return_id/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Return ID</a></th>
                <th class="<?php if ($sort_by == 'order_id') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/returns/index/order_id/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Order ID</a></th>
                 <th class="<?php if ($sort_by == 'customer') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/returns/index/customer/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Customer</a></th>
                 <th class="<?php if ($sort_by == 'product') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/returns/index/product/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Product</a></th>
                 <th class="<?php if ($sort_by == 'model') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/returns/index/model/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Model</a></th>
                 <th class="<?php if ($sort_by == 'return_status_id') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/returns/index/return_status_id/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Status</a></th>
                 <th class="<?php if ($sort_by == 'date_added') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/returns/index/date_added/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Date Added</a></th>
                 <th class="<?php if ($sort_by == 'date_modified') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/returns/index/date_modified/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Date Modified</a></th>
                <!--<th>Actions</th>-->
              </tr>
            </thead>
            <tbody>
             <?php if(isset($records)){ ?>
			  <?php foreach($records as $row){?>
              <tr class="<?php if(($row['is_deleted'] == 1)) { echo "bg-danger"; } ?>">
                <!--<td>
                <?php if (in_array($row['return_id'], $selected)) { ?>
                	<input type="checkbox" name="selected[]" value="<?php echo $row['return_id']; ?>" checked="checked" />
                <?php } else { ?>
                	<input type="checkbox" name="selected[]" value="<?php echo $row['return_id']; ?>" />
                <?php } ?>
                </td>-->
                <td class=""><?php echo $row['return_id']; ?></td>
                <td class=""><?php echo $row['order_id']; ?></td>
                <td class=""><?php echo $row['customer']; ?></td>
                <td class=""><?php echo $row['product']; ?></td>
                <td class=""><?php echo $row['model']; ?></td>
                <td class=""><?php echo $row['return_status_id']; ?></td>
                <td class=""><?php echo $row['date_added']; ?></td>
                <td class=""><?php echo $row['date_modified']; ?></td>
                <!--<td class="text-right"><a href="<?php echo $row['edit']; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>-->
              </tr>
              <?php }?>
              <?php } else {?>
                <tr>
               	 <td class="" colspan="10" align="center">No Results!</td>
            	</tr>
            <?php } ?>
            </tbody>
          </table>
          </form>
        </div>
        <!-- /.box-body --> 
      </div>
      <!-- /.box --> 
    </div>    
  </div>
</section>
  <!-- Start Pagination -->
  <div class="row">
    <div class="col-sm-6 col-xs-12 text-left">
      		<?php echo $pagination; ?>
       	</div>
      
       <div class="col-sm-6 col-xs-12 text-right">
	   	<?php if(isset($records)){$count = count($records);}else {$count=0;} ?>Showing <?php echo (int)$range; ?> to <?php echo (int)($range+$count-1); ?> of <?php echo (int)$totals; ?> (<?php echo (int)$pages; ?> Pages)
       </div>
  </div>
  <!-- End Pagination --> 
  </div>
<!-- End : Main content -->

<!-- /.content-wrapper --> 

<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js"> 		</script>
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/js/common.js"></script> 
<script>

  //Date picker
    $('#date_added').datepicker({
        todayHighlight:true,
        autoclose: true
    });
  
  //Date picker
    $('#date_modified').datepicker({
        todayHighlight:true,
        autoclose: true
    });
  
  
// Customer Name AutoComplate	
	$('input[name=\'customer\']').autocomplete({		
		'source': function(request, response) {			
			console.log(request);
			$.ajax({
				type:'POST',
				url: "<?php echo base_url('customers/customer/autocomplete/'); ?>",				
				data : {'filter_name':request},
				dataType: 'json',			
				success: function(json) {
					response($.map(json, function(item) {
						return {
							label: item['firstname']+' '+item['lastname'],
							value: item['customer_id']										
						}						
					}));
				}				
			});
		},
		'select': function(item) {
			$('input[name=\'customer\']').val(item['label']);
			$('input[name=\'customer_id\']').val(item['value']);								
		}
	});	
  
// Product Name AutoComplate	
$('input[name=\'product\']').autocomplete({		
	'source': function(request, response) {			
		console.log(request);
		$.ajax({
			type:'POST',
			url: "<?php echo base_url('catalog/product/autocomplete/'); ?>",				
			data : {'product_name':request},
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['product_name'],
						value: item['product_id']											
					}						
				}));
			}				
		});
	},
	'select': function(item) {
		$('input[name=\'product\']').val(item['label']);
		$('input[name=\'product_id\']').val(item['value']);									
	}	
});	
// Model Name AutoComplate	
$('input[name=\'model\']').autocomplete({		
	'source': function(request, response) {			
		console.log(request);
		$.ajax({
			type:'POST',
			url: "<?php echo base_url('catalog/product/autocomplete/'); ?>",				
			data : {'product_model':request},
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['product_model'],
						value: item['product_id']												
					}						
				}));
			}				
		});
	},
	'select': function(item) {
		$('input[name=\'model\']').val(item['label']);								
	}
});	
</script>
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