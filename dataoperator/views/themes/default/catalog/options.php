<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1> Options </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
                <button class="btn btn-primary" type="submit" value="save" name="option_save" form="option_form"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
              </div>
    </section>
    <!------------------ End Content Header (Page header) ---------------------> 
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
        <form class="form-horizontal" name="options_form" id="option_form" action="<?php echo $form_action;?>" method="post">
        <input type="hidden" name="option_id" value="<?php echo $option_id; ?>" />
          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> Add Option</h2>
             
            </div>
            <div class="box-body"> 
            
            
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('option_name')!==""){echo "has-error";} ?>">
                <label for="option_name" class="col-sm-3 col-md-2 control-label">Option Name</label>
                <div class="col-sm-9 col-md-10">
                <div class="input-group">
                  <span class="input-group-addon"><img title="English" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/gb.png"></span>
                  <input type="text" name="option_name" id="option_name" class="form-control" placeholder="Option Name" value="<?php echo $option_name; ?>">
                </div>
                <?php echo form_error('option_name','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!------- start : input group ------>
              <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label" for="type">Type</label>
                  <div class="col-sm-9 col-md-10">
                    <select name="type" id="type" class="form-control">
                      <optgroup label="Choose">
                        <option value="select" <?php if($type == "select"){ echo "selected";}?> > Select </option>
                        <option value="radio" <?php if($type == "radio"){ echo "selected";}?>> Radio </option>
                        <option value="checkbox" <?php if($type == "checkbox"){ echo "selected";}?>> Checkbox </option>
                        <option value="image" <?php if($type == "image"){ echo "selected";}?>> Image </option>
                      </optgroup>
                      <optgroup label="Input">
                      	<option value="text" <?php if($type=="text"){ echo "selected";}?>> Text </option>
                        <option value="textarea" <?php if($type=="textarea"){ echo "selected";}?>> Textarea </option>
                      </optgroup>
                      <optgroup label="File">
                      	<option value="file" <?php if($type=="file"){ echo "selected";}?>> File </option>
                      </optgroup>
                      <optgroup label="Date">
                      	<option value="date" <?php if($type=="date"){ echo "selected";}?>> Date </option>
                        <option value="time" <?php if($type=="time"){ echo "selected";}?>> Time </option>
                        <option value="datetime" <?php if($type=="datetime"){ echo "selected";}?>> Date & Time </option>
                      </optgroup>
                    </select>
                  </div>
              </div>
              <!------- End : input group ------>
              
              <!-- Start : input Group -->
              <div class="form-group">
                <label for="sort_order" class="col-sm-3 col-md-2 control-label">Sort Order</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="sort_order" id="sort_order" class="form-control" placeholder="Sort Order" value="<?php echo $sort_order; ?>">
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : Table -->
              <div class="table-responsive table-padding">
                <table class="table table-striped table-bordered table-hover table-padding" id="option-value">
                <thead>
                    <tr>
                      <td class="text-left col-sm-4  required">Option Value Name</td>
                      <td class="text-left col-sm-3">Image</td>
                      <td class="text-left col-sm-4">Sort Order</td>
                      <td></td>
                    </tr>
                </thead>
                <tbody>

                <?php

                if(count($option_value1)>0){
                  
                  foreach ($option_value1 as $key => $value) {
                     # code...
                    $i=$key;
                    $option_value = $value;
                   ?>
                   <tr id="option-value-row<?php echo $i;?>">
                        <td class="text-left">
                          <input type="hidden" name="option_value[<?php echo $i;?>][option_id]" value="<?php echo $option_value['option_id'];?>" />
                          <div class="input-group">
                            <span class="input-group-addon">
                              <img src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/gb.png" title="English" />
                            </span>
                            <input type="text" name="option_value[<?php echo $i;?>][name]" placeholder="Option Value Name" class="form-control" value="<?php echo $option_value['name'];?>" />
                          </div>
                          <?php echo form_error('option_value['.$i.'][name]','<div class="text-danger">', '</div>'); ?>
                        </td>
                        <td>
                          <a href="" id="thumb-image<?php echo $i;?>" data-toggle="image" class="img-thumbnail">
                          <img src="<?php echo $option_value['src'];?>" alt="" title="" data-placeholder="<?php echo $option_value['placeholder'];?>" /></a>
                        <input type="hidden" name="option_value[<?php echo $i; ?>][image]" value="<?php echo $option_value['image'];?>" id="input-image<?php echo $i; ?>" />
                        </td>
                        <td class="text-right">
                          <input type="text" name="option_value[<?php echo $i; ?>][sort_order]" value="<?php echo $option_value['sort_order'];?>" placeholder="Sort Order" class="form-control" />
                        </td>
                        <td class="text-left">
                          <button type="button" onclick="$('#option-value-row<?php echo $i;?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                        </td>
                      </tr>
                        
                <?php
                    }
                }
                ?>
                 </tbody>
                <tfoot>
                    <td colspan="3"></td>
                    <td class="text-left">
                        <button class="btn btn-primary" id="add" name="add" type="button" data-original-title="Add" data-toggle="tooltip" onClick="addOptionValue()">
                        <i class="fa fa-plus-circle"></i>
                        </button>
                    </td>
                </tfoot>
                </table>
              </div>
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
              <!-- End : Table -->
              </form>
            </div>
            </div>
        </div>
      </div>
    </section>
    <!----------------------- Main content -------------------------------> 
  </div>
  <!------------------- End content-wrapper ---------------------------->
  
  <script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js"> 		</script>
<script type="text/javascript">
	//Initialize Select2 Elements
   // $(".select2").select2();

	var elem = '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
  $('#opt-image').popover({animation:true, content:elem, html:true}); 
  
  
</script> 
  <?php
  if(count($option_value1)>0)
  {
    $row = count($option_value);
  }
  else
  {
    $row = 0;
  }
  ?>
<script>
$('select[name=\'type\']').on('change', function() {
	if (this.value == 'select' || this.value == 'radio' || this.value == 'checkbox' || this.value == 'image') {
		$('#option-value').show();
	} else {
		$('#option-value').hide();
	}
});

$('select[name=\'type\']').trigger('change');
var option_value_row = "<?php echo $row;?>";

function addOptionValue() {
  var img_val="<?php echo $this->image->resize('no_image-100x100.png', 100, 100);?>";
	html  = '<tr id="option-value-row' + option_value_row + '">';	
    html += '<td class="text-left"><input type="hidden" name="option_value[' + option_value_row + '][option_id]" value="" />';
	html += '<div class="input-group">';
	html += '<span class="input-group-addon"><img src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/gb.png" title="English" /></span><input type="text" name="option_value[' + option_value_row + '][name]" value="" placeholder="Option Value Name" class="form-control" />';
    html += '</div>';
	html += '</td>';
	
	html+='<td><a href="" id="thumb-image' + option_value_row + '" data-toggle="image" class="img-thumbnail"><img src="'+img_val+'" alt="" title="" data-placeholder="'+img_val+'" /></a><input type="hidden" name="option_value[' + option_value_row + '][image]" value="" id="input-image' + option_value_row + '" /></td>'
	html += '<td class="text-right"><input type="text" name="option_value[' + option_value_row + '][sort_order]" value="" placeholder="Sort Order" class="form-control"/></td>';
	
	html += '<td class="text-left"><button type="button" onclick="$(\'#option-value-row' + option_value_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';	
	
	$('#option-value tbody').append(html);
	$(":file").filestyle();
	option_value_row++;
	
	
	/* Start : image preview script */
	
	function readURL(input,imgid) {
	/*alert (imgid);*/
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#'+imgid).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(".img-select").change(function(){
	//alert ($(this).data("imgid"));
	var imgid=$(this).data("imgid");
    readURL(this,imgid);
});
	/* End : image preview script */
}
</script>
<script type="text/javascript">
  
  
  
/* End : image preview script For Image-1 tab*/
var baseurl = "<?php print base_url(); ?>";   


</script>

