 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Categories</h1>
      
       <!-- Start : Breadcrumb -->
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <!-- End : Breadcrumb -->

      <div class="pull-right"> 
          <a href="<?php echo $add;?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
          <button class="btn btn-danger" id="button-delete"><i class="fa fa-trash-o"></i></button>
      </div>
    </section>
    
    <!-- Start : Main content -->
    <section class="content">
    <!--<div class="col-xs-12">-->
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
    <!--</div>-->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title col-sm-6">
            	<i class="fa fa-list"></i>Category List
            </h3>
            
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <!-- Start : Data Listing in table -->
            <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-category">
            <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('Dtoken'); ?>" />
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="text-center">
					           <input type="checkbox" onClick="$('input[name*=\'selected\']').prop('checked', this.checked);">
             	  </th>
                  
                  <th class="<?php if ($sort_by == 'category_name') echo "sort_$sort_order";?>"><a href="<?php echo base_url('catalog/category/index/category_name/'.(($sort_order == 'ASC' ) ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Category Name</a></th>
                   <th class="text-right <?php if ($sort_by == 'sort_order') echo "sort_$sort_order";?>"><a href="<?php echo base_url('catalog/category/index/sort_order/'.(($sort_order == 'ASC' ) ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Sort Order</a></th>
                  <th class="col-xs-6 col-sm-3 text-right">Actions</th>
                </tr>
              </thead>
              <tbody>
                  
              	<?php
				if(isset($records)){
					foreach($records as $row){
                                            
				?>   		
                <tr>
                    <td class="text-center">
                    <?php if (in_array($row['category_id'], $selected)) { ?>
                        <input type="checkbox" name="selected[]" value="<?php echo $row['category_id']; ?>" checked="checked" />
                        <?php } else { ?>
                        <input type="checkbox" name="selected[]" value="<?php echo $row['category_id']; ?>" />
                    <?php } ?>
                    </td>
                      <td class="text-left" style="<?php if(($row['is_deleted'] == 1)) { echo "color: red"; } ?>">
                        <?php
                        echo $row['category_name'];                        
                        ?>
                      </td>
                      <td class="text-right"><?php echo $row['sort_order']; ?></td>
                    <td class="text-right">
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
			    <td colspan="4" align="center"> No Records </td>
			  </tr>
			  <?php
			  }
			  ?>
              </tbody>
            </table>
          </form>
            <!-- End : Data Listing in table -->
          </div>
          <!-- /.box-body --> 
        </div>
        <!-- /.box --> 
      </div>
    </div>

    <!-- Start : Paggination -->
    <div class="row">
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
    </div>
    <!-- End : Paggination -->

    </section>
  <!-- End : Main content --> 
</div>
<!-- End :.content-wrapper -->

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