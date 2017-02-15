 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Payment Methods<small></small> </h1>
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
				Payment Method List
            </h2>           
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="<?php //echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-zone">
            <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
            <table id="theme-table" class="table table-bordered table-hover">
              <thead>
                <tr>
                	<th class="">Payment Method</th>
                    <th class="text-center">Logo</th>
                    <th class="">Status</th>
                    <th class="text-right">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php if(isset($records)){ //echo "<pre>"; print_r($records); echo "</pre>";?>
                    <?php foreach($records as $row){?>
                 
                <tr class="">
                <td class="col-xs-3 col-md-3"><?php echo $row['payment_method_name']; ?></td>
                    <td class="col-xs-3 col-md-3 text-center">
                    <?php if($row['icon']!=''){?>
                    <img src="<?php echo ADMIN_PATH.$this->common->config('admin_theme').'/images/'.$row['icon']; ?>" />
                    <?php } ?>
                    </td>
                    
                    <td class="col-xs-3 col-md-3" style="width:10%">
                       <?php if(($this->common->config($row['payment_code'].'_status'))=='1') { ?>
                                <span class="label label-success">Enabled</span>
                        <?php } else { ?>
                         <span class="label label-danger">Disabled</span>
                       <?php } ?>
                    </td>
                    <td class="col-xs-3 col-md-3 text-right" style="width:10%">
                     <a href="<?php echo $row['edit']; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
			  <?php }?>
			  <?php } else { ?>
              <tr>
              	<td colspan="5" align="center">No Records</td>
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
  <!-- End : Main content --> 
</div>
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