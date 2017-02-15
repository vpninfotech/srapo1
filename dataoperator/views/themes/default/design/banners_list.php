<!-- DataTables --> 
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Banners<small></small> </h1>
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
    </div>
    
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h2 class="box-title col-sm-6">
            	<i class="fa fa-list"></i>
				Banner List
            </h2>
           
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-banner">
          <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('Dtoken'); ?>" />
            <table id="theme-table" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>
          <input type="checkbox" onClick="$('input[name*=\'selected\']').prop('checked', this.checked);">
                </th>
                  <th class="<?php if ($sort_by == 'banner_name') echo "sort_$sort_order";?>"><a href="<?php echo base_url('design/banners/index/banner_name/'.(($sort_order == 'ASC' ) ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Banner Name</a></th>
                  <th class="<?php if ($sort_by == 'status') echo "sort_$sort_order";?>"><a href="<?php echo base_url('design/banners/index/status/'.(($sort_order == 'ASC' ) ?'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Status</a></th>
                 
                  <th class="col-xs-2 col-md-2 text-right">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php if (isset($records)) { 
                ?>

        <?php foreach($records as $row){?>
                <tr>
                  <td><?php if (in_array($row['banner_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $row['banner_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $row['banner_id']; ?>" />
                    <?php } ?></td>
                  <td class=""><?php echo $row['banner_name']; ?></td>
                  <td class=""><?php  if($row['status']==1){ echo "Enabled";}else{ echo "Disabled"; } ?></td>
                 
                  <td class="text-right">
                     <a href="<?php echo $row['edit']; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
        <?php }?>
               <?php } else {?>
                <tr>
                        <td colspan="6" align="center">No Results!</td>
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
    <!-- Start Pagination -->
    <div class="row">
      <div class="col-sm-6 col-xs-12 text-left">
        <?php echo $pagination; ?>
      </div>
        <div class="col-sm-6 col-xs-12 text-right"><?php if(isset($records)){$count = count($records);}else {$count=0;} ?>Showing <?php echo (int)$range; ?> to <?php echo (int)($range+$count-1); ?> of <?php echo (int)$totals; ?> (<?php echo (int)$pages; ?> Pages)</div>
    </div>
    <!-- End Pagination -->
  </div>
  </section>
  <!-- End : Main content --> 

<!-- /.content-wrapper -->
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