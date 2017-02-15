 <!-- Select2 -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
  <!-- Select2 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
     <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="form-tax_classes" id="form-tax_classes">
    <section class="content-header">
      <h1> Tax Classes </h1>
       <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
        <button class="btn btn-primary" type="submit" value="save" name="form-tax_classes" id="form-tax_classes">
        <i class="fa fa-save"></i>
        </button>
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
        <!-- <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="form-tax_classes" id="form-tax_classes">-->

          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i><?php echo $text_form; ?></h2>
              
            </div>
            <div class="box-body"> 
            <input type="hidden" name="tax_class_id" value="<?php echo $tax_class_id; ?>" />
            
              <!-- Start : input Group -->
              <!--<div class="form-group required <?php if(form_error('title')!==""){echo "has-error";} ?>">
                <label for="attribute_group_type_name" class="col-sm-2 control-label">Tax Class Title</label>             
                <div class="col-sm-10">
                	<div class="input-group">
                 	 <span class="input-group-addon"><img title="English" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/gb.png"></span>
                 	 <input type="text" name="tax_title" id="tax_title" class="form-control" placeholder="Tax Title" value="<?php echo $title; ?>">
               		</div>
                    <?php echo form_error('title','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>-->
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('tax_class_title')!==""){echo "has-error";} ?>">
                <label for="sort_order" class="col-sm-2 control-label">Tax Class Title</label>
                <div class="col-sm-10">
                    <input type="text" name="tax_class_title" id="tax_class_title" class="form-control" placeholder="Tax Class Title" value="<?php echo $tax_class_title; ?>">
                    <?php echo form_error('tax_class_title','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('description')!==""){echo "has-error";} ?>">
                <label for="sort_order" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <input type="text" name="description" id="description" class="form-control" placeholder="Description" value="<?php echo $description; ?>">
                    <?php echo form_error('description','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
             
              <?php if($this->session->userdata('role_id')== 1) { ?>
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
              
              <!-- Start : Table -->
              <div class="table-responsive table-padding">
                <table class="table table-striped table-bordered table-hover table-padding" id="tax-rule">
                <thead>
                    <tr>
                      <td class="text-left col-sm-5">Tax Rate</td>
                      <td class="text-left col-sm-5">Based On</td>
                      <td class="text-left col-sm-5">Priority</td>
                      <td class="text-left col-sm-2"></td>
                      <td></td>
                    </tr>
                </thead>
                <tbody>
               
              <?php 
			  $tax_rule_row = 0; 
			  /*echo "<pre>";
			  print_r($tax_rules);
			  echo "</pre>";*/
			  ?>
              <?php if(count($tax_rules) > 0){
				  foreach ($tax_rules as $tax_rule) { ?>
              <tr id="tax-rule-row<?php echo $tax_rule_row; ?>">
                <td class="text-left"><select name="tax_rule[<?php echo $tax_rule_row; ?>][tax_rate_id]" class="form-control">
                    <?php foreach ($tax_rates as $tax_rate) { ?>
                    <?php  if ($tax_rate['tax_rate_id'] == $tax_rule['tax_rate_id']) { ?>
                    <option value="<?php echo $tax_rate['tax_rate_id']; ?>" selected="selected"><?php echo $tax_rate['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $tax_rate['tax_rate_id']; ?>"><?php echo $tax_rate['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
                <td class="text-left"><select name="tax_rule[<?php echo $tax_rule_row; ?>][based]" class="form-control">
                    <?php  if ($tax_rule['based'] == 'shipping') { ?>
                    <option value="shipping" selected="selected"><?php echo 'Shipping'; ?></option>
                    <?php } else { ?>
                    <option value="shipping"><?php  echo 'Shipping'; ?></option>
                    <?php } ?>
                    <?php  if ($tax_rule['based'] == 'payment') { ?>
                    <option value="payment" selected="selected"><?php echo 'Payment'; ?></option>
                    <?php } else { ?>
                    <option value="payment"><?php echo 'Payment'; ?></option>
                    <?php } ?>                    
                  </select></td>
                <td class="text-left"><input type="text" name="tax_rule[<?php echo $tax_rule_row; ?>][priority]" value="<?php echo $tax_rule['priority']; ?>" placeholder="<?php echo 'Priority'; ?>" class="form-control" /></td>
                <td class="text-left"><button type="button" onclick="$('#tax-rule-row<?php echo $tax_rule_row; ?>').remove();" data-toggle="tooltip" title="<?php echo 'Remove'; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
              </tr>
              <?php $tax_rule_row++; ?>
              <?php } 
			  }
			  ?>

                </tbody>
                <tfoot>
                    <td colspan="3"></td>
                    <td class="text-left">
                        <button class="btn btn-primary" id="add" name="add" type="button" data-original-title="Add" data-toggle="tooltip" onClick="addRule()">
                        <i class="fa fa-plus-circle"></i>
                        </button>
                    </td>
                </tfoot>
                </table>
              </div>
              <!-- End : Table -->
              <!------- End : Select group ------>
              </div>
              </div>
            <!--</form>-->
            </div>
           </div>
       
    </section>
    </form>
    <!----------------------- Main content -------------------------------> 
  </div>
  <!------------------- End content-wrapper ---------------------------->
  
<!--<script type="text/javascript" src="plugins/bootstrap-filestyle/bootstrap-filestyle.js"> 		</script>-->
<script type="text/javascript">
	//Initialize Select2 Elements
    $(".select2").select2();
</script>
<?php
if(count($tax_rule_row)>0)
{
  $tax_rule_row = count($tax_rule_row);
}
else
{
  $tax_rule_row = 0;
}
?>
<script type="text/javascript">
var tax_rule_row = <?php echo $tax_rule_row; ?>;

function addRule() {
	html  = '<tr id="tax-rule-row' + tax_rule_row + '">';
	html += '  <td class="text-left"><select name="tax_rule[' + tax_rule_row + '][tax_rate_id]" class="form-control">';
    <?php foreach ($tax_rates as $tax_rate) { ?>
    html += '    <option value="<?php echo $tax_rate['tax_rate_id']; ?>"><?php echo addslashes($tax_rate['name']); ?></option>';
    <?php } ?>
    html += '  </select></td>';
	html += '  <td class="text-left"><select name="tax_rule[' + tax_rule_row + '][based]" class="form-control">';
    html += '    <option value="shipping"><?php echo 'shipping'; ?></option>';
    html += '    <option value="payment"><?php echo 'payment'; ?></option>';    
    html += '  </select></td>';
	html += '  <td class="text-left"><input type="text" name="tax_rule[' + tax_rule_row + '][priority]" value="" placeholder="<?php echo 'Priority'; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#tax-rule-row' + tax_rule_row + '\').remove();" data-toggle="tooltip" title="<?php echo 'Remove'; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';
	
	$('#tax-rule tbody').append(html);
	
	tax_rule_row++;
}
</script>
