 <!-- Select2 -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
  <!-- Select2 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Filter </h1>
       <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
                <button class="btn btn-primary" type="submit" value="save" name="filter_save" form="form-filter"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
              </div>
    </section>
    <!------------------ End Content Header (Page header) ------------------- --> 
    <!-------------------------- Main content ------------------------------- -->
    <section class="content">
      <div class="row">

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

        <div class="col-xs-12">
         <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="filter_name" id="form-filter">

          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i><?php echo $text_form; ?></h2>
              
            </div>
            <div class="box-body"> 
            <input type="hidden" name="filter_group_id" value="<?php echo $filter_group_id; ?>" />
            
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('filter_group_name')!==""){echo "has-error";} ?>">
                <label for="attribute_group_type_name" class="col-sm-2 control-label">Filter Group Name</label>
                <div class="col-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><img title="English" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/gb.png"></span>
                  <input type="text" name="filter_group_name" id="filter_group_name" class="form-control" placeholder="Filter Group Name" value="<?php echo $filter_group_name; ?>">
                 
                </div>
                 <?php echo form_error('filter_group_name','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group">
                <label for="sort_order" class="col-sm-2 control-label">Sort Order</label>
                <div class="col-sm-10">
                    <input type="text" name="sort_order" id="sort_order" class="form-control" placeholder="Sort Order" value="<?php echo $sort_order; ?>">
                </div>
              </div>
              <!-- End : input Group -->
              
              
              <!-- Start : Table -->
              <div class="table-responsive table-padding">
                <table class="table table-striped table-bordered table-hover table-padding" id="filter">
                <thead>
                    <tr>
                      <td class="text-left col-sm-9">Filter Name</td>
                      <td class="text-left col-sm-9">Sort Order</td>
                      <td class="text-left col-sm-2"></td>
                      <td></td>
                    </tr>
                </thead>
                <tbody>
                <?php

             
                if(count($filter)>0)
                {
                   
                  foreach($filter as $key=>$value) {
                      $i = $key;
                    ?>
                    <tr id="filter-row<?php echo $i;?>">
                      <td class="text-left">
                        <input type="hidden" name="hfilter[<?php echo $i;?>]" value="" />
                        <div class="input-group">
                        <span class="input-group-addon"><img src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/gb.png" title="English" /></span>
                        <input type="text" name="filter_name[<?php echo $i;?>][name]" id="filter_name[<?php echo $i;?>]"  placeholder="Filter Name" class="form-control" value="<?php echo $value['name']; ?>"/>
                        </div>
                        <?php echo form_error('filter_name['.$i.'][name]','<div class="text-danger">', '</div>'); ?>
                      </td>
                      <td class="text-right">
                        <input type="text" name="filter_name[<?php echo $i;?>][sort_order]"  placeholder="Sort Order" id="sort_orde[<?php echo $i;?>]" class="form-control" value="<?php echo $value['sort_order']; ?>"/>
                      </td>
                      <td class="text-left">
                        <button type="button" onclick="$('#filter-row<?php echo $i;?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                      </td>
                    </tr>
                        
                <?php
                    }
                }
                ?>
                    
                </tbody>
                <tfoot>
                    <td colspan="2"></td>
                    <td class="text-left">
                        <button class="btn btn-primary" id="add" name="add" type="button" data-original-title="Add" data-toggle="tooltip" onClick="addFilterRow()">
                        <i class="fa fa-plus-circle"></i>
                        </button>
                    </td>
                </tfoot>
                </table>
              </div>
              <!-- End : Table -->
              <!------- End : Select group ------>
              <?php if($this->session->userdata('Drole_id')== 1) { ?>
                    <!------- start : Select group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for="status">Soft Deleted</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="checkbox" name="is_deleted" onclick="checkAddress(this)" id="is_deleted" value="<?php echo $is_deleted; ?>" <?php if($is_deleted==1) echo 'checked'; ?> />                 
                            <script type="text/javascript">
                                  function checkAddress(checkbox)
                                  {
                                      if (checkbox.checked)
                                      {
                                          $("#is_deleted").val("1");
                                      }
                                      else
                                      {
                                          $("#is_deleted").val("0");
                                      }
                                  }
                            </script>
                        </div>
                    </div>
                    <!------- End : Select group ------>
                    <?php } ?>
            </form>
            </div>
           </div>
        </div>
      </div>
    </section>
    <!----------------------- Main content -------------------------------> 
  </div>
  <!------------------- End content-wrapper ---------------------------->
  
<!--<script type="text/javascript" src="plugins/bootstrap-filestyle/bootstrap-filestyle.js"> 		</script>-->
<script type="text/javascript">
	//Initialize Select2 Elements
    $(".select2").select2();
</script>
<?php
if(count($filter)>0)
{
  $row = count($filter);
}
else
{
  $row = 0;
}
?>
<script type="text/javascript">

var filter_row = "<?php echo $row;?>";

function addFilterRow() {
	html  = '<tr id="filter-row' + filter_row + '">';	
    html += '<td class="text-left"><input type="hidden" name="hfilter[' + filter_row + ']" value="" />';
	html += '<div class="input-group">';
	html += '<span class="input-group-addon"><img src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/gb.png" title="English" /></span><input type="text" name="filter_name[' + filter_row + '][name]" id="filter_name[' + filter_row + ']"  placeholder="Filter Name" class="form-control" />';
    html += '</div>';
    html += "";
	html += '</td>';
	html += '<td class="text-right"><input type="text" name="filter_name[' + filter_row + '][sort_order]"  placeholder="Sort Order" id="sort_orde[' + filter_row + ']" class="form-control" /></td>';
	html += '<td class="text-left"><button type="button" onclick="$(\'#filter-row' + filter_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';	
	
	$('#filter tbody').append(html);
	
	filter_row++;
}

</script>
