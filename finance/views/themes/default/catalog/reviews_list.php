<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
 <style>
		.sort_ASC:after {
			content: "▲";
		}
		.sort_DESC:after {
			content: "▼";
		}
	</style>
        
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Reviews<small></small> </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
       <div class="pull-right">  
        <a href="<?php echo $add;?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button class="btn btn-danger" id="button-delete"><i class="fa fa-trash-o"></i></button>
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
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h2 class="box-title col-sm-6">
            	<i class="fa fa-list"></i>
				Reviews List
            </h2>
            
          </div>
          <!-- /.box-header -->
      <div class="box-body">
          <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-reviews">
           <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('Dtoken'); ?>" />
            <table id="theme-table" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>
					 <input type="checkbox" onClick="$('input[name*=\'selected\']').prop('checked', this.checked);">
             	  </th>
               <!--   <th class="<?php if ($sort_by == 'product_id') echo "sort_$sort_order";?>"><a href="<?php echo base_url('catalog/reviews/index/product_id/'.(($sort_order == 'ASC' ) ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Product</a></th>-->
                  <th class="<?php if ($sort_by == 'author') echo "sort_$sort_order";?>"><a href="<?php echo base_url('catalog/reviews/index/author/'.(($sort_order == 'ASC' ) ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Author</a></th>
                  <th class="<?php if ($sort_by == 'rating') echo "sort_$sort_order";?>"><a href="<?php echo base_url('catalog/reviews/index/rating/'.(($sort_order == 'ASC' ) ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Rating</a></th>
                  <th class="<?php if ($sort_by == 'status') echo "sort_$sort_order";?>"><a href="<?php echo base_url('catalog/reviews/index/status/'.(($sort_order == 'ASC' ) ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Status</a></th>
                  <th class="<?php if ($sort_by == 'date_added') echo "sort_$sort_order";?>"><a href="<?php echo base_url('catalog/reviews/index/date_added/'.(($sort_order == 'ASC' ) ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Data Added</a></th>
                 
              
                  <th class="col-xs-2 col-md-2 text-right">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php if(isset($records)) { ?>
			  <?php foreach($records as $row){?>
              
              	<tr>
                  <td><?php if (in_array($row['review_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $row['review_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $row['review_id']; ?>" />
                    <?php } ?></td>
			      <!--<td class=""><?php echo $row['product_id']; ?></td>-->
                  <td class=""><?php echo $row['author']; ?></td>
			      <td class=""><?php echo $row['rating']; ?></td>
                  <td class=""><?php echo $row['status']; ?></td>
                  <td class=""><?php echo $row['date_added']; ?></td>
                  <td class="text-right">
                     <a href="<?php echo $row['edit']; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                    </td>
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
      <div class="col-sm-6 col-xs-12 text-left">
        <?php echo $pagination; ?>
      </div>
       <div class="col-sm-6 col-xs-12 text-right"><?php if(isset($records)){$count = count($records);}else {$count=0;} ?>Showing <?php echo (int)$range; ?> to <?php echo (int)($range+$count-1); ?> of <?php echo (int)$totals; ?> (<?php echo (int)$pages; ?> Pages)</div>
    </div>
    <!-- End Pagination -->
    </section>
  </div>
  <!-- End : Main content --> 

<script>

	//Date picker
    $('#start_date').datepicker({
      autoclose: true
    });
	
	//Date picker
    $('#date_added').datepicker({
      autoclose: true
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