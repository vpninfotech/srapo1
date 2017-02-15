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
      <h1>Email Templates</h1>
      
      <ul class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul>
    
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

    <div class="row">
      <div class="col-xs-12">
      	<!-- Start : box -->
        <div class="box">
        	<!-- Start : box-header -->
          <div class="box-header">
            <h2 class="box-title col-sm-6"><i class="fa fa-list"></i>Email Template List</h2>
            
          </div>
          <!-- End : box-header -->
          <!-- start : box-body -->
          <div class="box-body">
            <form action="" method="post" enctype="multipart/form-data" id="form-product">
            <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
             
            <table id="theme-table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <!--<th> <input type="checkbox" onClick="$('input[name*=\'selected\']').prop('checked', this.checked);"></th>-->                
                <th class="<?php if ($sort_by == 'template_name') echo "sort_$sort_order";?>"><a href="<?php echo base_url('system/email_template/index/template_name/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Template Name</a></th>
                <th class="<?php if ($sort_by == 'subject') echo "sort_$sort_order";?>"><a href="<?php echo base_url('system/email_template/index/subject/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Subject</a></th>
                <th class="col-xs-2 col-md-2 text-right">Action</th>
              </tr>
            </thead>

            <tbody>                 
                <?php if(isset($records)) { ?>
                <?php foreach($records as $row){?>
                <tr>
                    <!--<td><?php if (in_array($row['template_id'], $selected)) { ?>
                  <input type="checkbox" name="selected[]" value="<?php echo $row['template_id']; ?>" checked="checked" />
                  <?php } else { ?>
                  <input type="checkbox" name="selected[]" value="<?php echo $row['template_id']; ?>" />
                  <?php } ?></td>-->
                    <td class=""><?php echo $row['template_name']; ?></td>
                    <td class=""><?php echo $row['subject']; ?></td>
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