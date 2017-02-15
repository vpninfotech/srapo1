<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Tax Rates<small></small> </h1>
     <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">  
        <a href="<?php echo $add;?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button class="btn btn-danger" onclick="confirm('Are you sure ?') ? $('#form-Tax_classes').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
				Tax Rates List
            </h2>
          
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-Tax_classes">
           <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
            <table id="theme-table" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>
					<input type="checkbox" onClick="$('input[name*=\'selected\']').prop('checked', this.checked);">
             	  </th>
                  <th class="<?php if ($sort_by == 'name') echo "sort_$sort_order";?>"><a href="<?php echo base_url('system/tax_rates/index/name/'.(($sort_order == 'ASC' && $sort_by == 'name') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Tax Name</a></th>
                  <th class="<?php if ($sort_by == 'rate') echo "sort_$sort_order";?>"><a href="<?php echo base_url('system/tax_rates/index/rate/'.(($sort_order == 'ASC' && $sort_by == 'rate') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Tax Rate</a></th>
                  <th class="<?php if ($sort_by == 'type') echo "sort_$sort_order";?>"><a href="<?php echo base_url('system/tax_rates/index/type/'.(($sort_order == 'ASC' && $sort_by == 'type') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Type</a></th>
                  <th class="<?php if ($sort_by == 'country') echo "sort_$sort_order";?>"><a href="<?php echo base_url('system/tax_rates/index/country/'.(($sort_order == 'ASC' && $sort_by == 'country') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Country</a></th>
                  <th class="<?php if ($sort_by == 'date_added') echo "sort_$sort_order";?>"><a href="<?php echo base_url('system/tax_rates/index/date_added/'.(($sort_order == 'ASC' && $sort_by == 'date_added') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Date Added</a></th>
                  <th class="<?php if ($sort_by == 'date_modified') echo "sort_$sort_order";?>"><a href="<?php echo base_url('system/tax_rates/index/date_modified/'.(($sort_order == 'ASC' && $sort_by == 'date_modified') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Date Modified</a></th>
            	  <th class="text-right">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php if(isset($records)) { ?>
			  <?php foreach($records as $row){?>
              	<tr>
                  <td><?php if (in_array($row['tax_rate_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $row['tax_rate_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $row['tax_rate_id']; ?>" />
                    <?php } ?></td>
                  <td class=""><?php echo $row['name']; ?></td>
                  <td class=""><?php echo $row['rate']; ?></td>
                  <td class=""><?php echo $row['type']; ?></td>
                  <td class=""><?php echo $row['country_name']; ?></td>
                  <td class=""><?php echo $row['date_added']; ?></td>
                  <td class=""><?php echo $row['date_modified']; ?></td>
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
  <!-- End : Main content --> 
</div>
<!-- /.content-wrapper -->