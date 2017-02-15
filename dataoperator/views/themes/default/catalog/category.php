<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>
<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/form-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/form-editable/js/bootstrap-editable.min.js">
</script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/all.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
<!-- Select2 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/icheck.min.js"></script>
<style>
#category_list>li
{
	list-style:none;
	margin-left: -35px;
}
#category_list
{
	position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 160px;
    padding: 5px 0;
    margin: 2px 0 0;
    list-style: none;
    font-size: 12px;
    text-align: left;
    background-color: #fff;
    border: 1px solid #ccc;
    border: 1px solid rgba(0, 0, 0, .15);
    border-radius: 3px;
    -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
    box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
    background-clip: padding-box;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
<form class="form-horizontal" name="categoryform" action="<?php echo $form_action;?>" method="post" id="form-category">
<input type="hidden" name="category_id" value="<?php echo $category_id; ?>" />
<input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('Dtoken'); ?>" />
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Categories </h1>
     <ul class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul>
    <div class="pull-right">
      <button class="btn btn-primary" name="category_save" id="save" value="save" type="submit"><i class="fa fa-save"></i></button>
      <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
    </div>
  </section>
  <!------------------ End Content Header (Page header) ---------------------> 
  <!-------------------------- Main content ------------------------------- -->
  <section class="content">
    <div class="row">
    	<div class="col-xs-12">
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
      </div>
     
      <div>
      	<div class="col-xs-12">
        	<div class="box box-default">
          
          		<div class="box-header">
            		<h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h2>            
          		</div>
          		<div class="box-body">
         			<div class="nav-tabs-custom">              
                		<ul class="nav nav-tabs">
                  			<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
                  			<li><a href="#tab-data" data-toggle="tab">Data</a></li>                 
                		</ul>	
                		<div class="tab-content">
                		<!-- Start : tab-pane -->
                  		<div class="tab-pane active" id="tab-general">
                    	<!------- start : input group ------>
                    	<div class="form-group required <?php if(form_error('category_name')!==""){echo "has-error";} ?>">
                      		<label for="category_name" class="col-sm-2 control-label">Category Name</label>
                      		<div class="col-sm-10">
                        		<input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category Name" value="<?php echo $category_name; ?>">
                        		<?php echo form_error('category_name','<div class="text-danger">', '</div>'); ?>
                      		</div>
                    	</div>
                    	<!------- end : input group ---------->
                    
                    	<!------- start : text area group ------>
                   		<div class="form-group">
                      		<label for="description" class="col-sm-2 control-label">Description</label>
                      		<div class="col-sm-10">
                        		<textarea class="form-control" name="description" id="input-description"><?php echo $description; ?></textarea>
                      		</div>
                        </div>
                        <!------- End : text area group ------>
                  
					    <!------- start : input group ------>
                        <div class="form-group required <?php if(form_error('metatag')!==""){echo "has-error";} ?>">
                        	<label for="metatag" class="col-sm-2 control-label">Meta Tag Title</label>
                        	<div class="col-sm-10">
                        		<input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Meta Tag Title" value="<?php echo $meta_title; ?>">
                        		<?php echo form_error('meta_title','<div class="text-danger">', '</div>'); ?>
                        	</div>
                    	</div>
                    	<!------- end : input group ------>
                    
                    	<!------- start : input group ------>
                    	<div class="form-group">
                      		<label for="metadesc" class="col-sm-2 control-label">Meta Tag Description</label>
                      		<div class="col-sm-10">
                        		<textarea class="form-control" name="meta_description" id="meta_description" rows="5" placeholder="Meta Tag Description"><?php echo $meta_description; ?></textarea>
                      		</div>
                    	</div>
                    	<!------- end : input group ------>
                    
                    	<!------- start : input group ------>
                    	<div class="form-group">
                      		<label for="meta_keyword" class="col-sm-2 control-label">Meta Tag Keywords</label>
                      		<div class="col-sm-10">
                        		<textarea class="form-control" name="meta_keyword" id="meta_keyword" rows="5" placeholder="Meta Tag Keywords"><?php echo $meta_keyword; ?></textarea>
                      		</div>
                        </div>
                        <!------- end : input group ------>                    
                    
          		</div>
                <!-- End : tab-pane- General -->
                  
                  <!-- Start : tab-pane -->
                  <div class="tab-pane" id="tab-data">
                  
                <!-- Start : tab-pane -->
                    <div class="tab-pane" id="tab-links"> 
                        <!------- Start : input group ------>
                        <div class="form-group">
                            <label for="input-parent" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="(Auto Complete)">Parent</span></label>
                            <div class="col-sm-9 col-md-10">
                                <input type="text" name="parent" value="<?php echo $parent ?>" placeholder="Parent" id="input-parent" class="form-control" />
                                <input type="hidden" name="parent_id" value="<?php echo $parent_id ?>" />
                            </div>
                        </div>
                <!------- End : input group ------> 
                    <!------- Start : input group ------>
                    <div class="form-group">
                        <label for="filters" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="(Auto Complete)">Filters</span></label>
                        <div class="col-sm-9 col-md-10">
                            <input type="text" id="filter_name" name="filter_name" class="form-control" placeholder="Filters">
                            <div id="product-filter" class="well well-sm" style="height: 150px; overflow: auto;">
<?php foreach ($product_filters as $product_filter) { ?>
                                    <div id="product-category<?php echo $product_filter['filter_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_filter['filter_name']; ?>
                                        <input type="hidden" name="product_filter[]" value="<?php echo $product_filter['filter_id']; ?>" />
                                    </div>
                               
<?php } ?>
                            </div>
                        </div>
                    </div>
                    <!------- End : input group ------> 
                               
                    <!------- start : input group ------>
                    <div class="form-group required <?php if (form_error('seo_keywords') !== "") { echo "has-error"; } ?>"">
                      <label for="seo_keyword" class="col-sm-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Do not use spaces, instead replace spaces with - and make sure the SEO URL is globally unique.">SEO Keywords</span></label>
                      <div class="col-sm-10">
                        <input type="text" id="seo_keywords" name="seo_keywords" class="form-control" placeholder="SEO Keyword" value="<?php echo $seo_keywords; ?>">
                        <?php echo form_error('seo_keywords','<div class="text-danger">', '</div>'); ?>
                      </div>
                    </div>
                    <!------- End : input group ------>
                    
                    
                    <!------- start : image group ------>
                    <div class="form-group">
                        <label class="col-sm-3 col-md-2 control-label" for="image">Image</label>
                        <div class="col-sm-4 col-md-4"> <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                          <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                        </div>
                        <div class="clearfix"></div>
                     </div>
                     <!------- End : image group ------>
                    
                       <div class="form-group ">
                      <label class="col-sm-2 control-label" for="input-top"><span data-toggle="tooltip" title="Display in the top menu bar. Only works for the top parent categories.">Top</span></label>
                      <div class="col-sm-10">
                        <div class="checkbox">
                          <label>
                            <?php if ($top) { ?>
                            <input type="checkbox" name="top" value="1" checked="checked" id="input-top" />
                            <?php } else { ?>
                            <input type="checkbox" name="top" value="1" id="input-top" />
                            <?php } ?>
                            &nbsp; </label>
                        </div>
                      </div>
                    </div>                 
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="Columns" class="col-sm-2 control-label"><span data-toggle="tooltip" data-placement="auto" title="" data-original-title="Number of columns to use for the bottom 3 categories. Only works for the top parent categories.">Columns</span></label>
                      <div class="col-sm-10">
                        <input type="text" id="columns" name="columns" class="form-control" placeholder="Columns" value="<?php echo $columns; ?>">
                      </div>
                    </div>
                    <!------- End : input group ------>
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="sort_order" class="col-sm-2 control-label">Sort Order</label>
                      <div class="col-sm-10">
                        <input type="text" id="sort_order" name="sort_order" class="form-control" placeholder="Sort Order" value="<?php echo $sort_order; ?>">
                      </div>
                    </div>
                    <!------- End : input group ------>
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="Status">Status</label>
                      <div class="col-sm-10">
                        <select name="status" id="status" class="form-control">
                            <?php if ($status) { ?>
                                <option value="0">Disabled</option>
                                <option value="1" selected="selected">Enabled</option>
                            <?php  } else { ?>
                                <option value="0" selected="selected">Disabled</option>
                                <option value="1">Enabled</option>
                            <?php  } ?>
                        </select>
                        <script>
                            $("#status").val(<?= isset($status) ? $status : '' ?>);
                        </script> 
                      </div>
                    </div>
                    <!------- End : input group ------>
                    
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
                    
          		</div>
                  <!-- End : tab-pane -->
                  
                  
                  <!-- Start : tab-pane -->
                   
          	</div>
          </div>
        </div>
      </div>
     </div>
    </div>
   </div>
  </section>
  </form>
  <!----------------------- Main content -------------------------------> 
</div>
<!------------------- End content-wrapper ---------------------------->

<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js"> 		</script>
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/js/common.js"></script> 
<script type="text/javascript">
	//Initializa Summernote
	$('#input-description').summernote({height: 300});
	
	//Initialize Select2 Elements
    $(".select2").select2();
   
    //Date picker
    $('#date_available').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
	
	var baseurl = "<?php print base_url(); ?>"; 
	
	var elem = '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
  $('[data-toggle="popover"]').popover({animation:true, content:elem, html:true}); 
  

	/* Start : image preview script */

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            $('#show-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(".img-select").change(function () {
    readURL(this);
});
/* End : image preview script */

/* Start : parent autocomplete script */  
// Parent AutoComplate
//Parent Id
            $('input[name=\'parent\']').autocomplete({
                'source': function (request, response) {
                    $.ajax({
                        url: "<?php echo base_url('catalog/category/autocomplete/') ?>",
                        dataType: 'json',
                        type: 'POST',
                        data: {'category_name': request},
                        success: function (json) {
                            response($.map(json, function (item) {
                                return {
                                    label: item['category_name'],
                                    value: item['category_id']
                                }
                            }));
                        }
                    });
                },
                'select': function (item) {
                    $('input[name=\'parent\']').val(item['label']);
                    $('input[name=\'parent_id\']').val(item['value']);
                }
            });
/* End : parent autocomplete script */

/* Start : Filter autocomplete script */  
// Filter
            $('input[name=\'filter_name\']').autocomplete({
                'source': function (request, response) {
                    $.ajax({
                        url: "<?php echo base_url('catalog/filter/filter_autocomplete/') ?>",
                        dataType: 'json',
                        type: 'POST',
                        data: {'filter_name': request},
                        success: function (json) {
                            response($.map(json, function (item) {
                                return {
                                    label: item['filter_name'],
                                    value: item['filter_id']
                                }
                            }));
                        }
                    });
                },
                'select': function (item) {
                    $('input[name=\'filter_name\']').val('');

                    $('#product-filter' + item['value']).remove();

                    $('#product-filter').append('<div id="product-filter' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_filter[]" value="' + item['value'] + '" /></div>');
                }
            });

            $('#product-filter').delegate('.fa-minus-circle', 'click', function () {
                $(this).parent().remove();
            });
            
/* End : Filter autocomplete script */

/* Start : set parent null */
$('#save').click(function(){
	var parent=$('#parent').val();
	if(parent == "")
	{		
		$('#parent_id').val("");
	}
});	
/* End : set parent null */

</script>
