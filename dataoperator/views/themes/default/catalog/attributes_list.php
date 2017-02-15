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
    <h1>Attributes<small></small> </h1>
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
          <h2 class="box-title col-sm-6"><i class="fa fa-list"></i>Attribute List</h2>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        	<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-attributes_groups">
            <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('Dtoken'); ?>" />
          <table id="theme-table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th> <input type="checkbox" onClick="$('input[name*=\'selected\']').prop('checked', this.checked);">
                </th>
                <!--<th class="col-xs-5 col-md-5">Attribute Name</th>
                <th class="col-xs-3 col-md-3">Attribute Group</th>
                <th class="col-xs-1 col-md-1 text-right">Sort Order</th>-->
                <th class="<?php if ($sort_by == 'attribute_name') echo "sort_$sort_order";?>"><a href="<?php echo base_url('catalog/attributes/index/attribute_name/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Attribute Name</a></th>
                 <th class="<?php if ($sort_by == 'attribute_group_id') echo "sort_$sort_order";?>"><a href="<?php echo base_url('catalog/attributes/index/attribute_group_id/'.(($sort_order == 'ASC' ) ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Attribute Group</a></th>
                 <th class="text-right <?php if ($sort_by == 'sort_order') echo "sort_$sort_order";?>"><a href="<?php echo base_url('catalog/attributes/index/sort_order/'.(($sort_order == 'ASC' ) ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Sort Order</a></th>
                <th class="col-xs-3 col-md-2 text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
            	<?php
				/*if(isset($records)){	
				echo "<pre>";
				print_r($records);
				echo "</pre>";
				}
				else
				{
					echo "undefine records";
				}*/
				if(isset($records)){
					foreach($records as $row){
				?>
              
              <tr>
                <td>
                <?php if (in_array($row['attribute_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $row['attribute_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $row['attribute_id']; ?>" />
                <?php } ?>
                </td>
                <td class=""><?php echo $row['attribute_name']; ?></td>
                <td class=""><?php echo $row['attribute_group_name']; ?></td>
                <td class="text-right"><?php echo $row['sort_order']; ?></td>
                <td class="text-right"><a href="<?php echo $row['edit']; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
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
