<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Start : image zoom Div -->
    <div id="large" class="large"></div>   
    <div id="background"></div>
<!-- End : image zoom Div -->

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Products</h1>
      
      <ul class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul>
    <!--<div class="pull-right"> 
      <a href="<?php echo $add;?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
      <button class="btn btn-danger" id="button-delete"><i class="fa fa-trash-o"></i></button>
    </div>-->
    </section>
    <!--End : Content Header (Page header) -->
    
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
<div class="well well-sm sales_report">
    <div class="row">
      <form action="<?php echo base_url("catalog/product/search"); ?>" method="post">
        <!-- start : left column -->
        <div class="col-sm-4"> 
          <!------- start : input group ------>
          <div class="form-group">
            <label for="filter_name" class="col-sm-12 control-label">Product Name</label>
            <div class="col-sm-12 input-padding">
              <input type="text" name="filter_name" id="filter_name" class="form-control" placeholder="Product Name" value="<?php echo $filter_name; ?>">
            </div>
          </div>
          <!------- end : input group ------> 
          
          <!------- start : input group ------>
          <div class="form-group">
            <label for="filter_model" class="col-sm-3 col-md-2 control-label">Model</label>
            <div class="col-sm-12 input-padding">
              <input type="text" name="filter_model" id="filter_model" class="form-control" placeholder="Model" value="<?php echo $filter_model; ?>">
            </div>
          </div>
          <!------- end : input group ------> 
          
        </div>
        <!-- End : Left column --> 
        
        <!-- start : right column -->
        <div class="col-sm-4"> 
          <!------- start : input group ------>
          <div class="form-group">
            <label for="filter_price" class="col-sm-3 col-md-2 control-label">Price</label>
            <div class="col-sm-12 input-padding">
              <input type="text" name="filter_price" id="filter_price" class="form-control" placeholder="Price" value="<?php echo $filter_price; ?>">
            </div>
          </div>
          <!------- end : input group ------> 
          <!------- start : input group ------>
          <div class="form-group">
            <label for="filter_quantity" class="col-sm-3 col-md-2 control-label">Quantity</label>
            <div class="col-sm-12 input-padding">
              <input type="text" name="filter_quantity" id="filter_quantity" class="form-control" placeholder="Quantity" value="<?php echo $filter_quantity; ?>">
            </div>
          </div>
          <!------- end : input group ------>           
        </div>
        <!-- End : Total -->
        <div class="col-sm-4">
        <!-- Start : Date Picker Group -->
        <div class="form-group">
            <label for="filter_status" class="col-sm-3 col-md-2 control-label">Status</label>
            <div class="col-sm-12 input-padding">
              <select name="filter_status" id="filter_status" class="form-control">
                <option value="*"> </option>
                <option value="1"> Enabled </option>
                <option value="0"> Disabled </option>
              </select>
              <script>
                $("#filter_status").val(<?php echo $filter_status; ?>);
              </script> 
            </div>
          </div>
        <!------ End : Date Picker Group ------> 
        
        <!--Start : Filter Button-->
      
    </div>
    <div class="col-md-12">
      <div class="col-md-3 col-lg-3 pull-right">
         <button type="submit" id="button-filter" name="button_filter" class="btn btn-primary" value="search"> <i class="fa fa-search"></i> Filter </button>
         <button type="submit" id="button-all" name="button_all" class="btn btn-primary" value="all"> <i class="fa fa-search"></i> All </button>
      </div>
    </div>
              </form>

    <!--End : Filter Button--> 
  </div>
  <!-- End : right column --> 
  
</div>

    <div class="row">
      <div class="col-xs-12">
      	<!-- Start : box -->
        <div class="box">
        	<!-- Start : box-header -->
          <div class="box-header">
            <h2 class="box-title col-sm-6"><i class="fa fa-list"></i>Product List</h2>
            
          </div>
          <!-- End : box-header -->
          <!-- start : box-body -->
          <div class="box-body">
            <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-product">
                <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('Mtoken'); ?>" />
             
          <table id="theme-table" class="table table-bordered table-hover">
            <thead>
              <tr>
               
                 <th class="col-xs-2 col-md-2 text-center">Image</th>
                <th class="<?php if ($sort_by == 'product_name') echo "sort_$sort_order";?>"><a href="<?php echo base_url('catalog/product/index/product_name/'.(($sort_order == 'ASC' ) ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Product Name</a></th>
                <th class="<?php if ($sort_by == 'model') echo "sort_$sort_order";?>"><a href="<?php echo base_url('catalog/product/index/model/'.(($sort_order == 'ASC' ) ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Model</a></th>
                <th class="text-right <?php if ($sort_by == 'price') echo "sort_$sort_order";?>"><a href="<?php echo base_url('catalog/product/index/price/'.(($sort_order == 'ASC' ) ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Price</a></th>
                <th class="text-right <?php if ($sort_by == 'quantity') echo "sort_$sort_order";?>"><a href="<?php echo base_url('catalog/product/index/quantity/'.(($sort_order == 'ASC'  ) ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Quantity</a></th>
                <th class="<?php if ($sort_by == 'status') echo "sort_$sort_order";?>"><a href="<?php echo base_url('catalog/product/index/status/'.(($sort_order == 'ASC' ) ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Status</a></th>
                
                <th class="col-xs-2 col-md-2 text-right">Action</th>
              </tr>
            </thead>

              <tbody>
                 
              <?php if(isset($records)) { ?>
              <?php foreach($records as $row){?>
              <tr>
                
                  <td class="text-center">
                     
                    <a href="<?php echo $row['image']; ?>" >
                    <img src="<?php echo $row['image']; ?>" alt="clothing" rel="<?php echo $row['product_name']; ?>" class="img-small img-thumbnail">
                    </a>
                    </td>
                <td class=""><?php echo $row['product_name']; ?></td>
                <td class=""><?php echo $row['model']; ?></td>
                <td class="text-right">
                    <?php if($row['special']) { ?>
                        <span style="text-decoration: line-through;"><?php echo $row['price']; ?></span><br/>
                        <div class="text-danger"><?php echo $row['special']; ?></div>
                    <?php } else { ?>
                        <?php echo $row['price']; ?>
                    <?php } ?>
                </td>
                <td class="text-right">
                    <?php if($row['quantity'] <= 0) { ?>
                        <span class="label label-warning"><?php echo $row['quantity']; ?></span>
                    <?php } elseif($row['quantity'] <= 5) { ?>
                        <span class="label label-danger"><?php echo $row['quantity']; ?></span>
                    <?php } else { ?>
                        <span class="label label-success"><?php echo $row['quantity']; ?></span>
                    <?php } ?>
                    
                </td>
                <td class=""><?php echo $row['user_status']; ?></td>
                <td class="text-right"><a href="<?php echo $row['edit']; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
              </tr>
              <?php }?>
              <?php } else {?>
              <tr>
                <td align="center" colspan="8">No Records</td>
              </tr>
              <?php }?>
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
</div>
<!-- /.content-wrapper -->
<!-- page script -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/js/common.js"></script>
<script>
//Product Name
$('input[name=\'filter_name\']').autocomplete({
    'source': function (request, response) {
        $.ajax({
            url: "<?php echo base_url('catalog/product/autocomplete/') ?>",
            dataType: 'json',
            type: 'POST',
            data: {'product_name': request},
            success: function (json) {
                response($.map(json, function (item) {
                    return {
                        label: item['product_name'],
                        value: item['product_id']
                    }
                }));
            }
        });
    },
    'select': function (item) {
        $('input[name=\'filter_name\']').val(item['label']);
        $('input[name=\'product_id\']').val(item['value']);
    }
});
   
//Product Model
$('input[name=\'filter_model\']').autocomplete({
    'source': function (request, response) {
        $.ajax({
            url: "<?php echo base_url('catalog/product/autocomplete/') ?>",
            dataType: 'json',
            type: 'POST',
            data: {'product_model': request},
            success: function (json) {
                response($.map(json, function (item) {
                    return {
                        label: item['product_model'],
                        value: item['product_id']
                    }
                }));
            }
        });
    },
    'select': function (item) {
        $('input[name=\'filter_model\']').val(item['label']);
        $('input[name=\'product_id\']').val(item['value']);
    }
});
</script>
<script>

	
    
	
	
	
	/* Start : Aftre pagination fire image zoom script another time */
	jQuery.fn.center = function () {
		this.css("position","absolute");
		this.css("top", ( $(window).height() - this.height() ) / 2+$(window).scrollTop() + "px");
		this.css("left", ( $(window).width() - this.width() ) / 2+$(window).scrollLeft() + "px");
		return this;
	}

	$(document).ready(function() {		
		$(".img-thumbnail").click(function(e){
		
			$("#background").css({"opacity" : "0.7"})
							.fadeIn("slow");			
						
			$("#large").html("<img src='"+$(this).parent().attr("href")+"' alt='"+$(this).attr("alt")+"' /><br/>"+$(this).attr("rel")+"")
					   .center()
					   .fadeIn("slow");			
			
			return false;
		});
			
		$(document).keypress(function(e){
			if(e.keyCode==27){
				$("#background").fadeOut("slow");
				$("#large").fadeOut("slow");
			}
		});
		
		$("#background").click(function(){
			$("#background").fadeOut("slow");
			$("#large").fadeOut("slow");
		});
		
		$("#large").click(function(){
			$("#background").fadeOut("slow");
			$("#large").fadeOut("slow");
		});
		
	});
	
			
			
			
</script>


<!--<script>
$('select').select2({
    minimumResultsForSearch: -1
});
</script>
-->

<!-- Start :image zoom script -->
<script type="text/javascript" language="javascript">
	jQuery.fn.center = function () {
		this.css("position","absolute");
		this.css("top", ( $(window).height() - this.height() ) / 2+$(window).scrollTop() + "px");
		this.css("left", ( $(window).width() - this.width() ) / 2+$(window).scrollLeft() + "px");
		return this;
	}

	$(document).ready(function() {		
		$(".img-thumbnail").click(function(e){
		
			$("#background").css({"opacity" : "0.7"})
							.fadeIn("slow");			
						
			$("#large").html("<img src='"+$(this).parent().attr("href")+"' alt='"+$(this).attr("alt")+"' /><br/>"+$(this).attr("rel")+"")
					   .center()
					   .fadeIn("slow");			
			
			return false;
		});
			
		$(document).keypress(function(e){
			if(e.keyCode==27){
				$("#background").fadeOut("slow");
				$("#large").fadeOut("slow");
			}
		});
		
		$("#background").click(function(){
			$("#background").fadeOut("slow");
			$("#large").fadeOut("slow");
		});
		
		$("#large").click(function(){
			$("#background").fadeOut("slow");
			$("#large").fadeOut("slow");
		});
		
	});
</script>
<script>
//Date picker
$('#filter_date_added').datepicker({
   autoclose: true,
   format : 'dd-mm-yyyy',
   todayHighlight:true,
   pickTime: false
});


</script>
<!-- End : image zoom script -->
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