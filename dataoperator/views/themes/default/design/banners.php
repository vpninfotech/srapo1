 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1> Banner </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
                <button class="btn btn-primary" type="submit" value="save" name="customers_save" form="banner_form"><i class="fa fa-save"></i></button>
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
        <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="banner_form" id="banner_form">
        <input type="hidden" name="banner_id" value="<?php echo $banner_id;?>">
        <input type="hidden" name="H_select_layout" value="<?php echo $select_layout;?>">
          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> <?php echo $text_form ?></h2>
              
            </div>
            <div class="box-body"> 
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('select_page')!==""){echo "has-error";} ?>" >
                <label for="select_page" class="col-sm-2 control-label">Select Page</label>
                <div class="col-sm-10">
                  <select name="select_page" id="select_page" class="form-control">
                    <option value="">Select Page</option>
                    <option value="home">Home</option>
                    <option value="category">Category</option>
                    <option value="product">Product</option>
                  </select>
                     <?php echo form_error('select_page','<div class="text-danger">', '</div>'); ?>
                     <script type="text/javascript">
                       $('#select_page').val('<?php echo $select_page;?>');
                     </script>
                </div>
              </div>
              <!-- End : input Group -->
               <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('select_layout')!==""){echo "has-error";} ?>" >
                <label for="select_layout" class="col-sm-2 control-label">Select Layout</label>
                <div class="col-sm-10">
                  <select name="select_layout" id="select_layout" class="form-control">
                    <option value="">Select Layout</option>
                  </select>
                     <?php echo form_error('select_layout','<div class="text-danger">', '</div>'); ?>
                      
                </div>
              </div>
              <!-- End : input Group -->
              <!-- Start : input Group -->
              <div class="form-group category required <?php if(form_error('select_category')!==""){echo "has-error";} ?>">
                <label for="select_category" class="col-sm-2 control-label">Select Category</label>
                <div class="col-sm-10">
                  <select name="select_category" id="select_category" class="form-control">
                    <option value="">Select Category</option>
                    <?php
                    foreach ($category as $key => $value) {
                      echo '<option value="'.$value['category_id'].'">'.$value['category_name'].'</option>';
                    }
                    ?>
                  </select>
                     <?php echo form_error('select_category','<div class="text-danger">', '</div>'); ?>
                      <script type="text/javascript">
                       $('#select_category').val('<?php echo $select_category;?>');

                     </script>
                </div>
              </div>
              <!-- End : input Group -->
            
              <!-- Start : input Group -->
              <div class="form-group category required <?php if(form_error('select_position')!==""){echo "has-error";} ?>" >
                <label for="select_block" class="col-sm-2 control-label">Select Position</label>
                <div class="col-sm-10">
                  <select name="select_position" id="select_position" class="form-control">
                    <option value="">Select Position</option>
                    <option value="top left">Top Left</option>
                    <option value="top right">Top Right</option>
                    <option value="left">Left</option>
                  </select>
                     <?php echo form_error('select_position','<div class="text-danger">', '</div>'); ?>
                      <script type="text/javascript">
                       $('#select_position').val('<?php echo $select_position;?>');
                     </script>
                </div>
              </div>
              <!-- End : input Group -->
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('banner_name')!==""){echo "has-error";} ?>" >
                <label for="banner_name" class="col-sm-2 control-label">Banner Name</label>
                <div class="col-sm-10">
                    <input type="text" name="banner_name" id="banner_name" class="form-control" placeholder="Banner Name" value="<?php echo $banner_name; ?>">
                     <?php echo form_error('banner_name','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              
              <!------- start : input group ------>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="status">Status</label>
                  <div class="col-sm-10">
                    <select name="status" id="status" class="form-control">
                        <option value="1"  > Enabled </option>
                        <option value="0" > Disabled </option>
                    </select>
                      <script type="text/javascript">
                       $('#status').val('<?php echo $status;?>');
                     </script>
                  </div>
              </div>
              <!------- End : input group ------>
              
              <!-- Start : Table -->
              <div class="table-responsive table-padding">
                <table class="table table-striped table-bordered table-hover table-padding" id="banner-value">
                <thead>
                    <tr>
                      <td class="text-left ">Title</td>
                      <td class="text-left ">Link</td>
                      <td class="text-left ">Image</td>
                      <td class="text-left ">Sort Order</td>
                      <td></td>
                    </tr>
                </thead>
                <tbody>
                <?php

                

                if(count($banner_value)>0){
                  // echo "<pre>";
                  // print_r($banner_value);

                  foreach ($banner_value as $key => $value) {
                     $i=$key;
                     ?>
                    <tr id="banner-value-row<?php echo $i;?>">
                      <td class="text-left">
                        <input type="hidden" name="banner_value[<?php echo $i;?>][banner_id]" value="<?php echo $banner_value[$i]['banner_id']; ?>" />
                        <div class="input-group">
                          <span class="input-group-addon">
                            <img title="English" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/gb.png">
                          </span>
                            <input type="text" name="banner_value[<?php echo $i;?>][title]" value="<?php echo $banner_value[$i]['title']; ?>"  placeholder="Banner Title" class="form-control" value="<?php echo $banner_value[$i]['title']; ?>"/>
                        </div>
                        <?php echo form_error('banner_value['.$i.'][title]','<div class="text-danger">', '</div>'); ?>
                      </td>
                      <td class="text-right">
                        <input type="text" name="banner_value[<?php echo $i;?>][link]" value="<?php echo $banner_value[$i]['link'];?>" placeholder="Link" class="form-control" style="width:200px;"/>
                      </td>
                      <td>
                          <a href="" id="thumb-image<?php echo $i;?>" data-toggle="image" class="img-thumbnail">
                          <img src="<?php echo $banner_value[$i]['src'];?>" alt="" title="" data-placeholder="<?php echo $banner_value[$i]['placeholder'];?>" /></a>
                        <input type="hidden" name="banner_value[<?php echo $i; ?>][image]" value="<?php echo $banner_value[$i]['image'];?>" id="input-image<?php echo $i; ?>" />
                        </td>
                      <td class="text-right">
                        <input type="text" name="banner_value[<?php echo $i;?>][sort_order]" value="<?php echo $banner_value[$i]['sort_order'];?>" placeholder="Sort Order" class="form-control" style="width:90px;"/>
                        <?php echo form_error('banner_value['.$i.'][sort_order]','<div class="text-danger">', '</div>'); ?>
                      </td>
                      <td class="text-left">
                        <button type="button" onclick="$('#banner-value-row<?php echo $i;?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i>
                        </button>
                      </td>
                    </tr>
                     <?php
                    }
                }
                ?>
                </tbody>
                <tfoot>
                    <td colspan="4"></td>
                    <td class="text-left">
                        <button class="btn btn-primary" id="add" name="add" type="button" data-original-title="Add" data-toggle="tooltip" onClick="addBanner()">
                        <i class="fa fa-plus-circle"></i>
                        </button>
                    </td>
                </tfoot>
                </table>
              </div>
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
	var elem = '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
  $('#opt-image').popover({animation:true, content:elem, html:true}); 
  
  
</script> 
  <?php
  if(count($banner_value)>0){
    $row = count($banner_value);
  }
  else
  {
    $row = 0;
  }
  ?>
<script>
var banner_value_row = "<?php echo $row;?>";
$(".category").hide();
function addBanner() {
    var img_val="<?php echo $this->image->resize('no_image-100x100.png', 100, 100);?>";
	html  = '<tr id="banner-value-row' + banner_value_row + '">';	
    html += '<td class="text-left"><input type="hidden" name="banner_value[' + banner_value_row + '][banner_id]" value="" />';
	html += '<div class="input-group">';
	html += '<span class="input-group-addon"><img title="English" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/gb.png"></span><input type="text" name="banner_value[' + banner_value_row + '][title]" value=""  placeholder="Banner Title" class="form-control" />';
    html += '</div>';
	html += '</td>';
	
	html += '<td class="text-right"><input type="text" name="banner_value[' + banner_value_row + '][link]" value="" placeholder="Link" class="form-control" /></td>';
				  
   html+='<td><a href="" id="thumb-image' + banner_value_row + '" data-toggle="image" class="img-thumbnail"><img src="'+img_val+'" alt="" title="" data-placeholder="'+img_val+'" /></a><input type="hidden" name="banner_value[' + banner_value_row + '][image]" value="" id="input-image' + banner_value_row + '" /></td>'
	
	html += '<td class="text-right"><input type="text" name="banner_value[' + banner_value_row + '][sort_order]" value="" placeholder="Sort Order" class="form-control" /></td>';
	
	html += '<td class="text-left"><button type="button" onclick="$(\'#banner-value-row' + banner_value_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';	
	
	$('#banner-value tbody').append(html);
	$(":file").filestyle();
	banner_value_row++;
	
	
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
<script type="text/javascript">
    $('select[name=\'select_page\']').on('change', function() {

    var page = $(this).val();
    var html = '<option value="">Select Layout</option>';
    if(page == 'home')
    {
        html += '<option value="main banner">Main Banner</option>';
        html += '<option value="main banner right">Main Banner Right</option>';
        html += '<option value="bottom left">Bottom Left</option>';
        html += '<option value="bottom right">Bottom Right</option>';
        html += '<option value="category">Category</option>';
    }
     if(page == 'category')
    {
        html += '<option value="main banner top">Main Banner Top</option>';
        html += '<option value="main banner left">Main Banner Left</option>';
      
    }
     if(page == 'product')
    {
        html += '<option value="right column">Right Column</option>';
        
    }
    $('select[name=\'select_layout\']').html(html);
    $(".category").hide();
    
});

$('select[name=\'select_page\']').trigger('change');
$('select[name=\'select_layout\']').on('change', function() {
  var layout = $(this).val();
  if(layout == 'category')
  {
      $(".category").show();
  }
  else
  {
    $(".category").hide();
    $('#select_category').val('');
    $('#select_position').val('');
  }
  });

</script>
 <script type="text/javascript">
   $('#select_layout').val('<?php echo $select_layout;?>');
   $('select[name=\'select_layout\']').trigger('change');
 </script>

