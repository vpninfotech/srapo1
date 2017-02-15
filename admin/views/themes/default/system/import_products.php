<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>
  <link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/form-editable/css/bootstrap-editable.css" rel="stylesheet" />
  <script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/form-editable/js/bootstrap-editable.min.js"></script>
  
  <!--tags input css and js and intialize in footer-->
  <!--<link href="plugins/tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
  <script type="text/javascript" src="plugins/tagsinput/bootstrap-tagsinput.min.js"></script>-->
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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
<?php 
/* echo "<pre>";
print_r($params);
echo "</pre>"; */  
?>
<?php if ($params['step'] == 1) { ?> 
  <form class="form-horizontal" action="<?php echo $form_action; ?>" method="post" name="csv_product_import_form" enctype="multipart/form-data" id="csv_product_import_form">
  <input type="hidden" name="mode" />
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> CSV Product Import </h1>
    <ul class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul>
    <div class="pull-right">
      <button class="btn btn-primary" type="submit" value="save" name="csv_product_import" id="csv_product_import1" form="csv_product_import_form"><!--<i class="fa fa-save"></i>--> Next</button>
    </div>
  </section>
  <!-- ---------------- End Content Header (Page header) ------------------- --> 
  <!-------------------------- Main content ------------------------------- -->
   
  <section class="content">
  
    <div class="row">
      <?php if(isset($error) && $error!==""): ?>
      <div class="col-xs-12">
        <div class="alert alert-danger alert-bold-border">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
          <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error;?> </div>
      </div>
      <?php endif; ?>
      <?php if(isset($success) && $success!==""): ?>
      <div class="col-xs-12">
        <div class="alert alert-success alert-bold-border">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
          <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success;?> </div>
      </div>
      <?php endif; ?>      
      <div class="col-xs-12">
        <div class="box box-default">
          <div class="box-header">
            <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> CSV Product Import: STEP 1 </h2>
          </div>
          <div class="box-body">  
                             
			<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
                  <li><a href="#tab-advanced" data-toggle="tab">Advanced</a></li>
                  <li><a href="#tab-downloads" data-toggle="tab">Downloads</a></li>               
                </ul>
				<div class="tab-content"> 
					<!-- Start : tab-pane -->
					<div class="tab-pane active" id="tab-general">
						<!-- Start : input Group -->                        
						<div class="form-group required <?php if(form_error('file')!==""){echo "has-error";} ?>">
						<!--<div class="form-group">-->
							<label for="file" class="col-sm-3 col-md-2 control-label">File</label>
							<!--<div class="col-sm-3 col-md-2 control-label">
								<label for="file" class="control-label">
									<span data-toggle="popover" data-content="A csv file is widely used data format.&lt;br/&gt;&lt;br/&gt;For opencart stores we recommend CSV files generated by '&lt;a href=&quot;http://www.opencart.com/index.php?route=extension/extension/info&amp;extension_id=20085&quot; target=&quot;_blank&quot;&gt;CSV Product Export&lt;/a&gt;' extension because their structure and columns are fully supported." data-original-title="" title="">File</span>
								</label>  
							</div>-->
							<div class="col-sm-9 col-md-10">
								<input type="file" name="file" id="file" />
								<span>Max. file size (server limit): <?php echo $upload_file_size;//echo ini_get('upload_max_filesize'); ?></span>
								<div class="filename"></div>
                                <div class="filesize"></div>
								<?php echo form_error('file','<div class="text-danger">', '</div>'); ?>
								<div class="text-danger" id="file_type"></div>
							</div>
                        </div>                      
						<!-- End : input Group -->
						
						<!-- Start : input Group -->
						<div class="form-group">                        
							<label for="field_delimiter" class="col-sm-3 col-md-2 control-label">Field Delimiter</label>
                            
                            <input type="hidden" id="delimiter_option" name="delimiter_option" value="<?php echo $params['delimiter_option']; ?>" />
							<div class="col-sm-9 col-md-10">
								<select name="field_delimiter" id="field_delimiter" class="form-control">
									<option value="	" <?php if($params['field_delimiter']==""){ ?> selected="selected" <?php } ?>>tab</option>
									<option value=";" <?php if($params['field_delimiter']==";"){ ?> selected="selected" <?php } ?>>semicolon ";"</option>
									<option value="," <?php if($params['field_delimiter']==","){ ?> selected="selected" <?php } ?>>comma ","</option>
									<option value="|" <?php if($params['field_delimiter']=="|"){ ?> selected="selected" <?php } ?>>pipe "|"</option>
									<option value=" " <?php if($params['field_delimiter']==" "){ ?> selected="selected" <?php } ?>>space " "</option>
								</select>
								<?php echo form_error('field_delimiter','<div class="text-danger">', '</div>'); ?>							  
							</div>
						</div>
						<!-- End : input Group --> 
						
						<!-- Start : input Group -->
						<div class="form-group">
							<!--<label for="import_mode" class="col-sm-3 col-md-2 control-label" title="Import Mode">Import Mode</label>-->
							<div class="col-sm-3 col-md-2 control-label">
								<label class="control-label">
									<span data-toggle="popover" data-content="The mode affects only data with multiple records (categories, specials, discounts, etc.).&lt;br/&gt;&lt;br/&gt; In the &lt;b&gt;'Add'&lt;/b&gt; mode all related information is added to the product.&lt;br /&gt;&lt;br /&gt;In the &lt;b&gt;'Replace'&lt;/b&gt; mode old records related to the product are deleted first. It might be useful for updating special prices, discounts." data-original-title="" title="">Import Mode</span>
								</label>
							</div>
							<div class="col-sm-9 col-md-10">
								<select name="import_mode" id="import_mode" class="form-control">
									<option <?php if ($params['import_mode'] == 'add') { ?>selected="selected" <?php } ?> value="add" selected="selected">Add new records (safe) </option>
									<option <?php if ($params['import_mode'] == 'replace') { ?>selected="selected" <?php } ?> value="replace" >Replace old records </option>
								</select>
								<?php echo form_error('import_mode','<div class="text-danger">', '</div>'); ?> 
							</div>
						</div>
						<!-- End : input Group -->
						
					</div>
					<!-- End : tab-pane-General --> 
					
					<!-- Start : tab-pane Advanced -->
					<div class="tab-pane" id="tab-advanced"> 
						<!------- start : input group ------>
						<div class="form-group">
						  <!--<label for="store_name" class="col-sm-3 col-md-2 control-label">Sub-Category Separator</label>-->
						  <div class="col-sm-3 col-md-2">
							<!--<label for="sub-category_seperator" class="control-label">Sub-Category Separator</label>-->
							<label for="sub-category_seperator" class="control-label">
								<span data-toggle="popover" data-content="It is a sub-category separator. A separator of multiple product categories can be defined.Example: category///subcategory1///subcategory2" data-original-title="" title="">Sub-Category Separator</span>
							</label>
						  </div>
						  <div class="col-sm-9 col-md-10">
							<input type="text" id="cat_separator" name="cat_separator" class="form-control" placeholder="" value="<?php echo $params['cat_separator']; ?>">							
						  </div>
						</div>
						<!------- End : input group ------> 
						
						<!------- start : input group ------>
						<div class="form-group">
						  <!--<label for="store_name" class="col-sm-3 col-md-2 control-label">Path to Images Directory</label>-->
						  <div class="col-sm-3 col-md-2">
							<label for="path_to_image_directory" class="control-label">
								<span data-toggle="popover" data-content="IMPORTANT: File names must consist of Latin characters only. Files with national characters in names will not be imported." data-original-title="" title="" aria-describedby="popover881669">Path to Images Directory</span>
							</label>
						  </div>
						  <div class="col-sm-9 col-md-10">
							<?php 
								//echo 'http://'.$_SERVER['HTTP_HOST'].'/images/';
								echo '/images/catalog/';
							?>
							<input type="text" id="images_dir" name="images_dir" class="form-control" placeholder="" value="">
							
						  </div>
						</div>
						<!------- End : input group ------> 
						
						<!------- start : input group ------>
						<div class="form-group">
						  <!--<label for="store_name" class="col-sm-3 col-md-2 control-label">Price Multiplier</label>-->
						  <div class="col-sm-3 col-md-2">
							  <label for="price_multiplier" class="control-label">
								<span data-toggle="popover" data-content="Regular product price multiplier (leave empty or set to 1 if the price should not be updated)" data-original-title="" title="" aria-describedby="popover453538">Price Multiplier</span>
							  </label>
						  </div>
						  <div class="col-sm-9 col-md-10">
							<input type="text" id="price_multiplier" name="price_multiplier" class="form-control" placeholder="" value="">							
						  </div>
						</div>
						<!------- End : input group ------> 
						
					</div>
					<!-- End : tab-pane Advanced -->
					
					<!-- Start : tab-pane downloads -->
					<div class="tab-pane" id="tab-downloads"> 
						<!------- start : input group ------>
						<div class="form-group">
						  <!--<label for="store_name" class="col-sm-3 col-md-2 control-label">Path to Source Directory</label>-->
						  <div class="col-sm-3 col-md-2">
							<label for="path_to_source_directory" class="control-label">
								<span data-toggle="popover" data-content="IMPORTANT: File names must consist of Latin characters only. Files with national characters in names will not be imported." data-original-title="" title="">Path to Source Directory</span>
							</label>
						  </div>
						  <div class="col-sm-9 col-md-10">
							<?php 
								//echo 'http://'.$_SERVER['HTTP_HOST'].'/system/storage/download/';
								echo '/system/storage/download/';
							?>
							<input type="text" id="download_source_dir" name="download_source_dir" class="form-control" placeholder="" value="<?php echo $params['download_source_dir']; ?>">
						  </div>
						</div>
						<!------- End : input group ------> 
						
						<!-- Start : input Group -->
						<div class="form-group">
							<!--<label for="file_name_postfix" class="col-sm-3 col-md-2 control-label">Where to Get File Postfix</label>-->
							<div class="col-sm-3 col-md-2">
								<label for="file_name_postfix" class="control-label">
									<span data-toggle="popover" data-content="where to get file prefix" data-original-title="" title="">Where to Get File Postfix</span>
								</label>
							</div>
								<div class="col-sm-9 col-md-10">
									<select name="file_name_postfix" id="file_name_postfix" class="form-control">
										<option <?php if ($params['file_name_postfix'] == 'generate') { ?>selected="selected" <?php } ?> value="generate" selected="selected">Generate Random Postfixes</option>
										<option <?php if ($params['file_name_postfix'] == 'detect') { ?>selected="selected" <?php } ?> value="detect">Detect Postfixes in File Names</option>
										<option <?php if ($params['file_name_postfix'] == 'skip') { ?>selected="selected" <?php } ?> value="skip">Do Not Use Postfixes</option>										
									</select>
									<?php echo form_error('field_delimiter','<div class="text-danger">', '</div>'); ?>
							   </div>
						</div>
						<!-- End : input Group --> 
						
					</div>
					<!-- End : tab-pane downloads -->
				</div>
				<!-- End : tab-pane -->	
				
			</div>
            
          </div>          
          <!-- End : box-body --> 
        </div>
      </div>
    </div>
  </section>
   <!----------------------- Main content ------------------------------->
  </form> 
</div>
<!------------------- End content-wrapper ---------------------------->  
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js"> 		</script>
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/js/common.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		
		$('[data-toggle="popover"]').popover();  
	});	
	
	var fileName = $(this).val();
    var fileSize = this.files[0].size;	
    var fileType = this.files[0].type;
	var ack=0; //not allow for redirect	   
	
	
	  $(function() {
		 $("input:file").change(function (){
			
		   fileName = $(this).val();
		   fileSize = this.files[0].size;	
		   fileType = this.files[0].type;			   
		   var server_capacity="<?php echo $upload_file_size; ?>";
		   
		   //$(".filename").html(fileName);
		 
		   var formData = new FormData($('#csv_product_import_form')[0]);
		  /* var file = URL.createObjectURL(event.target.files[0]);
		   console.log('file:'+file);*/
		   if(fileSize > server_capacity)
		   {
			   $(".filesize").html("Please upload file size below <?php echo $upload_file_size; ?>");
		   }	
		   else if(fileType.match('text/comma-separated-values')!="text/comma-separated-values")
		   {
			   $("#file_type").html("File is not allowed");
		   }
		   else
		   {
			   $.ajax({
				   type:"POST",
				   url:"<?php echo base_url()."system/import_product/get_delimiter"; ?>",
					data: formData,			  	
					async: false,
				   
				   success: function(response)
				   {
					  if(response == ';')
					  {
						  $('#field_delimiter').val(';');
					  }
					  else if(response == '|')
					  {
						  $('#field_delimiter').val('|');
					  }
					  else if(response == ',')
					  {
						  $('#field_delimiter').val(',');
					  }
					  else if(response == '')
					  {
						  $('#field_delimiter').val('');
					  }
					  else if(response == '	')
					  {
						  $('#field_delimiter').val('	');
					  }
					  
				   },
					cache: false,
					contentType: false,
					processData: false
			   });
			  ack=1;  //allow for redirect 
		   }
		  
		 });
	});
	
	$('#csv_product_import1').click(function (){
		
		alert(ack);
		//alert('ok');
	});
	
		//////////
		/* function loadProfile() {

		  $("#form-input input[name='mode']").prop('value', 'load_profile');
		  $("#form-input").submit();
		}
		
		
		function deleteProfile() {
		
		  $("#form-input input[name='mode']").prop('value', 'delete_profile');
		  $("#form-input").submit();
		}
		
		function saveProfile() {
		
		  $("#form-input input[name='mode']").prop('value', 'save_profile');
		  $("#form-input").submit();
		}
		
		function resetFile() {
			$('#file_uploaded').hide();
			$('#file_uploaded > input').prop('disabled', true);
			
			$('#file_upload').show();
		} */
		////////////

	</script>
  
  <?php 
  } else if ($params['step'] == 2) { 
  ?>
  
	<form class="form-horizontal" action="<?php echo $form_action; ?>" method="post" name="csv_product_import_form" enctype="multipart/form-data" id="csv_product_import_form">
  <input type="hidden" name="mode" />
  <!--<input type="hidden" name="params[]" value="<?php //echo $params; ?>" id="get_params"/>-->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> CSV Product Import </h1>
    <ul class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul>
    <div class="pull-right">
      <button class="btn btn-primary" type="submit" value="save" name="csv_product_import2" id="csv_map" form="csv_product_import_form"><!--<i class="fa fa-save"></i>--> Next</button>
    </div>
  </section>
  <!-- ---------------- End Content Header (Page header) ------------------- --> 
  <!-------------------------- Main content ------------------------------- -->   
	<section class="content">  
		<div class="row">
		
			<div id="err_step2" style="display:none;">
				<div class="col-xs-12">
					<div class="alert alert-danger alert-bold-border" >
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
					  <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo 'Model is required';?> </div>
				</div>
			</div>
			<div id="err_step2_product_name" style="display:none;">
				<div class="col-xs-12">
					<div class="alert alert-danger alert-bold-border" >
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
					  <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo 'Product Name is required';?> </div>
				</div>
			</div>			
			<div id="err_step2_seo_url" style="display:none;">
				<div class="col-xs-12">
					<div class="alert alert-danger alert-bold-border" >
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
					  <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo 'SEO URL is required';?> </div>
				</div>
			</div>
			<div class="col-xs-12" id="loading" style="display:none;">
				CSV File Import Under Proccess Please Wait...
			</div>
		  <?php if(isset($error) && $error!==""): ?>
		  <div class="col-xs-12">
			<div class="alert alert-danger alert-bold-border" >
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
			  <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error;?> </div>
		  </div>
		  <?php endif; ?>
		  <?php if(isset($success) && $success!==""): ?>
		  <div class="col-xs-12">
			<div class="alert alert-success alert-bold-border">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
			  <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success;?> </div>
		  </div>
		  <?php endif; ?>
		  <div class="col-xs-12">
			<div id="backup_warning" class="alert alert-warning alert-bold-border">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
			  <strong>Caution!</strong>&nbsp;<?php echo "It is recommended to create "; ?><a href="<?php echo base_url('system/backup'); ?>" target="_blank">a database backup</a><?php echo " before starting the import procedure because these chagnes are irreversible."; ?>
			</div>
		  </div>
		  
			<div class="col-xs-12">
				<div class="box box-default">
				  <div class="box-header">
					<h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> CSV Product Import: STEP 2 </h2>
				  </div>
				  <div class="box-body"> 
					
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
						<li><a href="#tab-attributes" data-toggle="tab">Attributes</a></li>
						<li><a href="#tab-filters" data-toggle="tab">Filters</a></li>
						<li><a href="#tab-options" data-toggle="tab">Options</a></li>
						<li><a href="#tab-discounts" data-toggle="tab">Discounts</a></li>
						<li><a href="#tab-specials" data-toggle="tab">Specials</a></li>
						<!--<li><a href="#tab-reward_points" data-toggle="tab">Reward Points</a></li>
						<li><a href="#tab-product_profiles" data-toggle="tab">Product Profiles</a></li>
						<li><a href="#tab-reviews" data-toggle="tab">Reviews</a></li>-->
					</ul>
					
					<div class="tab-content"> 
					<!-- Start : tab-pane -->
					
						<div class="tab-pane active" id="tab-general">
						<!-- Start : tab-general -->
							<br /><br />
							Select corresponding columns for product fields on all tabs. It is OK to skip fields or columns.
							<br /><br />
							
							<table class="table table-condensed table-condensed table-striped table-hover">
								<thead>
									<tr>
										<td class="left" width="25%">Product Field</td>
										<td>Column in File</td>
										<td width="50%">Notes</td>
									</tr>
								</thead>
								<tbody>	
								
								<?php foreach($matches['fields'] as $fk => $fv) { ?>
									<tr>
										<td width="25%" <?php if (!empty($fv['must'])) { ?>class="required" <?php } ?>>
											<label class="control-label">
											<?php 
												if (!empty($fv['tip'])) { 
													echo '<span data-toggle="popover" data-content="' . $fv['tip'] . '">';
												}
											?>
											<?php echo $fv['name'] ?>
											<?php if (!empty($fv['tip'])) { echo '</span>'; } ?>
											</label>
										</td>
										<td>										
											<?php 
												$val = (isset($fv['column'])) ? $fv['column']:0;
												//echo KaElements::showSelector("fields[$fv[field]]", $columns, $val);
											?>
											<?php
												//get columns from csv file
												$general_columns=array("");
												foreach($params['columns'] as $col)
												{
													$general_columns[]=$col;
												}		
											?>
											<select name="fields[<?php echo $fv['field']; ?>]" class="getfields"  id="<?php echo $fv['field']; ?>" data-<?php echo $fv['field']; ?>="<?php echo $fv['field']; ?>">
												<?php
												for($general=0;$general<count($general_columns);$general++)
												{													
													?>
													<!--<option value="<?php echo $general; ?>" <?php if($fv['field'] == $general_columns[$general]) {?>selected="selected"<?php }else{} ?> data-val="<?php echo $fv['field']; ?>"><?php echo $general_columns[$general]; ?></option>-->
													<?php
													if($fv['field'] == $general_columns[$general])
													{
														?>
														<option value="<?php echo $general; ?>" selected="selected" data-field="<?php echo $fv['field']; ?>"><?php echo $general_columns[$general]; ?></option>
														<?php
													}
													else
													{
														?>
														<option value="<?php echo $general; ?>" data-field="<?php echo $general_columns[$general]; ?>"><?php echo $general_columns[$general]; ?></option>
														<?php
													}													
													
												}
												?>
											</select>
											
											<input type="hidden" name="set_field-<?php echo $fv['field']; ?>" id="set_field" class="set_field-<?php echo $fv['field']; ?>" data-set_<?php echo $fv['field']; ?>="<?php echo $fv['field']; ?>" value="">											
										</td>
										<td width="50%"><span class="help"><?php echo $fv['descr']; ?></span></td>
									</tr>
									
								<?php } ?>
								</tbody>
							</table>
							<!-- End : tab-general -->
						</div>
						
						
						<div class="tab-pane" id="tab-attributes">
						<!-- Start : tab-attributes -->
							Only attributes declared in the store will be imported. Create new attributes <a href="<?php //echo $attribute_page_url; ?>">here</a><br /><br />
							
							<table class="table table-condensed table-striped table-hover">
								<thead>
									<tr>
										<td class="left" width="25%">Attribute Name</td>
										<td>Column in File</td>
										<td width="50%">Attribute Group</td>
									</tr>
								</thead>
								<tbody>
								<?php
								/* echo "<pre>";
								print_r($matches['attributes']);
								echo "</pre>"; */
								?>
								<?php foreach($matches['attributes'] as $ak => $av) { ?>
									<tr>
										<td width="25%"><label class="control-label"><?php echo $av['attribute_name'] ?></label></td>
										<td>
											<?php //echo KaElements::showSelector("attributes[$av[attribute_id]]", $columns, $av['column']); ?>
											<?php	
										
												//get columns from csv file
												$general_columns=array("");
												foreach($params['columns'] as $col)
												{
													$general_columns[]=$col;
												}		
											?>
											<select name="attributes[<?php echo $av['attribute_id']; ?>]">
												<?php
												for($general=0;$general<count($general_columns);$general++)
												{													
													?>
													<option value="<?php echo $general; ?>" <?php if($av['attribute_name'] == $general_columns[$general]) {?>selected="selected"<?php }else{} ?>><?php echo $general_columns[$general]; ?></option>
													<?php
												}
												?>
											</select>
										</td>
										<td width="50%"><?php echo $av['attribute_group']; ?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						<!-- End : tab-attributes -->
						</div>
						
						<div class="tab-pane" id="tab-filters">
						<!-- Start : tab-filters -->
							Available filter groups are listed below. You can create new filter groups <a href="<?php //echo $filter_page_url; ?>">here</a><br /><br />
							<table class="table table-condensed table-striped table-hover">
								<thead>
									<tr>
										<td class="left" width="25%">Filter Group</td>
										<td>Column in File</td>
										<td width="50%">Notes</td>
									</tr>
								</thead>

								<tbody>
								
								<?php foreach($matches['filter_groups'] as $fk => $fv) { ?>
									<tr>
										<td width="25%"><label class="control-label"><?php echo $fv['filter_group_name']; ?></label></td>
										<td>
											<?php //echo KaElements::showSelector("filter_groups[$fv[filter_group_id]]", $columns, $fv['column']); ?>
											<?php												
												//get columns from csv file
												$general_columns=array("");
												foreach($params['columns'] as $col)
												{
													$general_columns[]=$col;
												}		
											?>
											<select name="filter_groups[<?php echo $fv['filter_group_id']; ?>]">
												<?php
												for($general=0;$general<count($general_columns);$general++)
												{													
													?>
													<option value="<?php echo $general; ?>" <?php if($fv['filter_group_name'] == $general_columns[$general]) {?>selected="selected"<?php }else{} ?>><?php echo $general_columns[$general]; ?></option>
													<?php
												}
												?>
											</select>
										</td>
										<td width="50%">&nbsp;</td>
									</tr>
									
								<?php } ?>
								</tbody>
							</table>
							<!-- End : tab-filters -->
						</div>
						
						<div class="tab-pane" id="tab-options">
						<!-- Start : tab-options -->
							There are two option formats available for importing the options. The <b>simple format</b> is used when your options
							have option values only without any extended data like quantity, price, weight, etc. Both formats can be combined in single import.
							
							<br /><br />
							
							<ul class="nav nav-tabs">
								<li class="active"><a href="#otab-simple_format" data-toggle="tab">Simple Format</a></li>
								<!--<li><a href="#otab-extended_format" data-toggle="tab">Extended Format</a></li>-->
							</ul>

							<div class="tab-content">
								<div class="tab-pane active" id="otab-simple_format">
									Select the columns containg simple option values (without weight, price, etc.). New options should be created beforehand at <a href="<?php //echo $option_page_url; ?>">the options page</a>.
									You can import multiple values from one cell if you define the 'options separataor' on the extension settings page. <a href="javascript: void(0)" onclick="javascript: $('#simple_options_example').show()">See example</a>
									<div id="simple_options_example" style="display:none; color: green">
										<br />If you define the '|' character as a separator then you can define option values like shown below:<br />
										<br />Header line :...,Size,...
										<br />Product line:...,"S|M|L|XL",...
										<br /><br />
										The cell will add 4 option values to the product.						
									</div>
									<br /><br />
									<table class="table table-condensed table-striped table-hover">
										<thead>
											<tr>
												<td class="left" width="25%">Option Name</td>
												<td>Column in File</td>
												<td width="5%">Required</td>
												<td width="5%">Type</td>
											</tr>
										</thead>
										<tbody>
										<?php
										/* echo "<pre>";
										print_r($matches['options']);
										echo "</pre>";  */ 
										?>
										<?php foreach($matches['options'] as $ok => $ov) { ?>
											<tr>
												<td width="25%"><label class="control-label"><?php echo $ov['name'] ?></label></td>
												<td>
													<?php //echo KaElements::showSelector("options[$ov[option_id]]", $columns, $ov['column']); ?>
													<?php												
													//get columns from csv file
													$general_columns=array("");
													foreach($params['columns'] as $col)
													{
														$general_columns[]=$col;
													}		
													?>
													<select name="options[<?php echo $ov['option_id']; ?>]">
														<?php
														for($general=0;$general<count($general_columns);$general++)
														{													
															?>
															<option value="<?php echo $general; ?>" <?php if($ov['name'] == $general_columns[$general]) {?>selected="selected"<?php }else{} ?>><?php echo $general_columns[$general]; ?></option>
															<?php
														}
														?>
													</select>
												</td>
												<td width="5%"><input type="checkbox" name="required_options[<?php echo $ov['option_id'];?>]" value="Y" <?php if (!empty($params['matches']['required_options'][$ov['option_id']])) { ?> checked="checked" <?php } ?> /></td>
												<td width="45%"><?php echo $ov['type']; ?></td>
											</tr>
										<?php } ?>
									</table>
								</div>
								
								<div class="tab-pane" id="otab-extended_format">

									If you need to import extra option properties like weight, price, quantity please use <a href="javascript: void(0)" onclick="javascript: $('#option_format').show()">reserved columns</a>. Options from <b>the resered columns</b> are pre-selected automatically.<br />

									<div id="option_format" style="display:none">
		<pre>
		COLUMN           | DESCRIPTION
		-----------------------------------------------------------------------------
		option:name      | option name (required)
		option:type      | option type (required)
		option:value     | option value (required)
		option:required  | option is required or not (Y/1 - yes, N/0 - no) (optional)
		option:image     | file path or URL (optional)
		option:sort_order| sort order of option value (optional)

		The following fields define options with extra attributes.

		option:quantity  | quantity (optional)
		option:subtract  | subtract flag (optional)
		option:price     | price (the value can be negative)
		option:points    | points (the value can be negative)
		option:weight    | weight (the value can be negative)
		</pre>
									</div>

									<br />

									<table class="table table-condensed table-striped table-hover">
										<thead>
											<tr>
												<td class="left" width="25%">Field</td>
												<td>Column in File</td>
												<td width="50%">Notes</td>
											</tr>
										</thead>

										<tbody>
										
										<?php foreach($matches['ext_options'] as $dk => $dv) { ?>
											<tr>
												<td width="25%"><label class="control-label"><?php echo $dv['name'] ?></label></td>
												<td>
													<?php //echo KaElements::showSelector("ext_options[$dv[field]]", $columns, $dv['column']); ?>
													<?php												
													//get columns from csv file
													$general_columns=array("");
													foreach($params['columns'] as $col)
													{
														$general_columns[]=$col;
													}											
													?>
													<select name="ext_options[<?php echo $dv['field']; ?>]">
														<?php
														for($general=0;$general<count($general_columns);$general++)
														{													
															?>
															<option value="<?php echo $general; ?>" <?php if($dv['name'] == $general_columns[$general]) {?>selected="selected"<?php }else{} ?>><?php echo $general_columns[$general]; ?></option>
															<?php
														}
														?>
													</select>
												</td>
												<td width="50%"><span class="help"><?php echo $dv['descr']; ?></span></td>
											</tr>
										<?php } ?>

									</table>
								</div>        
							</div>
							<!-- End : tab-options -->
						</div>
						
						<div class="tab-pane" id="tab-discounts">
						<!-- Start : tab-discounts -->
							Product Discounts. You should specify at least 'quantity' and 'price' values to add new discount records.<br /><br />

							<table class="table table-condensed table-striped table-hover">
								<thead>
									<tr>
										<td class="left" width="25%">Field</td>
										<td>Column in File</td>
										<td width="50%">Notes</td>
									</tr>
								</thead>
								<tbody>
								<?php
								/* echo "<pre>";
								print_r($matches['discounts']);
								echo "</pre>";  */ 
								?>
								<?php foreach($matches['discounts'] as $dk => $dv) { ?>
									<tr>
										<td width="25%"><label class="control-label"><?php echo $dv['name'] ?></label></td>
										<td>
											<?php //echo KaElements::showSelector("discounts[$dv[field]]", $columns, $dv['column']); ?>
											<?php												
												//get columns from csv file
												$general_columns=array("");
												foreach($params['columns'] as $col)
												{
													$general_columns[]=$col;
												}											
											?>
											<select name="discounts[<?php echo $dv['field']; ?>]">
												<?php
												for($general=0;$general<count($general_columns);$general++)
												{													
													?>
													<option value="<?php echo $general; ?>" <?php if($dv['name'] == $general_columns[$general]) {?>selected="selected"<?php }else{} ?>><?php echo $general_columns[$general]; ?></option>
													<?php
												}
												?>
											</select>
										</td>
										<td width="50%"><span class="help"><?php echo $dv['descr']; ?></span></td>
									</tr>
								<?php } ?>
							</table>
							<!-- End : tab-discounts -->
						</div>
						
						<div class="tab-pane" id="tab-specials">
						<!-- Start : tab-specials -->
							Product Special Prices. You should specify at least 'price' value to add new special price records.<br /><br />

							<table class="table table-condensed table-striped table-hover">
								<thead>
									<tr>
										<td class="left" width="25%">Field</td>
										<td>Column in File</td>
										<td width="50%">Notes</td>
									</tr>
								</thead>
								<tbody>
								<?php foreach($matches['specials'] as $dk => $dv) { ?>
									<tr>
										<td width="25%"><label class="control-label"><?php echo $dv['name'] ?></label></td>
										<td>
											<?php //echo KaElements::showSelector("specials[$dv[field]]", $columns, $dv['column']); ?>
											<?php												
												//get columns from csv file
												$general_columns=array("");
												foreach($params['columns'] as $col)
												{
													$general_columns[]=$col;
												}											
											?>
											<select name="specials[<?php echo $dv['field']; ?>]">
												<?php
												for($general=0;$general<count($general_columns);$general++)
												{													
													?>
													<option value="<?php echo $general; ?>" <?php if($dv['name'] == $general_columns[$general]) {?>selected="selected"<?php }else{} ?>><?php echo $general_columns[$general]; ?></option>
													<?php
												}
												?>
											</select>
										</td>
										<td width="50%"><span class="help"><?php echo $dv['descr']; ?></span></td>
									</tr>
								<?php } ?>
							</table>
						<!-- End : tab-specials -->
						</div>

					<!-- End : tab-pane -->
					</div>
				  </div>
				</div>  
			</div>	  
		</div>
	</section>
  </form> 
</div>
<!------------------- End content-wrapper ---------------------------->  	
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js"> 		</script>
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/js/common.js"></script>
	<script type="text/javascript">
		
		$(document).ready(function() {

			$('[data-toggle=\'popover\']').popover({
					html: true,
					trigger:'click hover focus',
					delay: {show:"300", "hide": 1500}
			});
			
			//var step="<?php echo $params['step']; ?>";
			//var model=$('.getfields').data('model');
			
			
			//For model name
			var check_model=$('#model').val();				
			var model=$('option:selected', this).attr('data-field');
			var setmodel=$('.set_field-model').data('set_model');
			$('.set_field-model').val(setmodel);			
			console.log('check_model:'+check_model);
			$('#model').change(function(){				
				//model=$('#model').val();	
				check_model=$('#model').val();					
				model=$('option:selected', this).attr('data-field');			
				setmodel=$('.set_field-model').data('set_model');					
				$('.set_field-model').val(model);	
				if(check_model == 0)
				{
					$('#err_step2').show();
				}
				else
				{
					$('#err_step2').hide();
				}
			});		
			//console.log('model:'+model);
			//console.log('set-model:'+setmodel);
			//console.log('check_model:'+check_model);
			
			//For Product name
			var check_product_name=$('#product_name').val();
			var product_name=$('option:selected', this).attr('data-field');
			var setproduct_name=$('.set_field-product_name').data('set_product_name');
			$('#product_name').change(function(){	
				check_product_name=$('#product_name').val();
				product_name=$('option:selected', this).attr('data-field');
				setproduct_name=$('.set_field-product_name').data('set_product_name');
				$('.set_field-product_name').val(product_name);	
				if(check_product_name == 0)
				{
					$('#err_step2_product_name').show();
				}
				else
				{
					$('#err_step2_product_name').hide();
				}				
			});
			
			//For seo url
			var check_seo_url=$('#seo_url').val();
			var seo_url=$('option:selected', this).attr('data-field');
			var setseo_url=$('.set_field-seo_url').data('set_product_name');
			$('#seo_url').change(function(){	
				check_seo_url=$('#seo_url').val();
				seo_url=$('option:selected', this).attr('data-field');
				setseo_url=$('.set_field-seo_url').data('set_product_name');
				$('.set_field-seo_url').val(seo_url);	
				if(check_seo_url == 0)
				{
					$('#err_step2_seo_url').show();
				}
				else
				{
					$('#err_step2_seo_url').hide();
				}				
			});
			
			$('#csv_map').click(function(event){					
				//event.preventDefault();
				$("#loading").show();
				$("#loading").html("<h2>CSV File Import is under proccess please wait...<h2>");
				//alert("Ok");
				console.log('check_model:'+check_model);
				if(check_model == 0 || check_product_name == 0 || check_seo_url == 0)
				{
					event.preventDefault();
					if(check_model == 0)
					{
						$('#err_step2').show();
					}
					if(check_product_name == 0)
					{
						$('#err_step2_product_name').show();
					}
					if(check_seo_url == 0)
					{
						$('#err_step2_seo_url').show();
					}
				}
				else
				{	
					if(check_model == 0)
					{
						$('#err_step2').hide();	
					}
					if(check_product_name == 0)
					{
						$('#err_step2_product_name').hide();	
					}
					if(check_seo_url == 0)
					{
						$('#err_step2_seo_url').hide();	
					}
					
					/* $.ajax({
						//global: false,
						type:"POST",
						url:"<?php echo base_url('system/import_product/step3'); ?>",						
						data:{							
							'model':model,							
							'set_field-model':setmodel							
						},						
						success:function(){
							
						}
					}); */ 
				}
				
			}); 		
		});		
		
	</script>

  <?php
  }
  elseif($params['step'] == 3)
  {
	?>
	<!--<form class="form-horizontal" action="<?php //echo $form_action; ?>" method="post" name="csv_product_import_form" enctype="multipart/form-data" id="csv_product_import_form">-->
	<section class="content-header">
    <h1> CSV Product Import </h1>
    <ul class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul> 
	<!--<div class="pull-right">
      <button class="btn btn-primary" type="submit" value="save" name="csv_product_import2" id="csv_map" form="csv_product_import_form"> Done</button>
    </div>-->
	</section>
	<!-- ---------------- End Content Header (Page header) ------------------- --> 
	<!-------------------------- Main content ------------------------------- -->
	<section class="content">
		<div class="row">
		  <?php if(isset($error) && $error!==""): ?>
		  <div class="col-xs-12">
			<div class="alert alert-danger alert-bold-border">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
			  <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error;?> </div>
		  </div>
		  <?php endif; ?>
		  <?php if(isset($success) && $success!==""): ?>
		  <div class="col-xs-12">
			<div class="alert alert-success alert-bold-border">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
			  <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success;?> </div>
		  </div>
		  <?php endif; ?>
		  
			  <div class="col-xs-12">
				<div class="box box-default">
				  <div class="box-header">
					<h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> CSV Product Import: STEP 3 </h2>
				  </div>
					<div class="box-body"> 
						<?php 
						if($status == 'completed')
						{
							?>
							<h2 id="import_status">Import is completed</h2>
							<?php 
						}
						else
						{
							?>
							<h2 id="import_status">Import is in progress</h2>
							<?php
						}
						?>
						
						<table class="table table-striped table-hover">
						  <tr>
							<td colspan="2">The import statistics updates every <? echo $update_interval; ?> seconds. Please do not close the window.</td>
						  </tr>
						  <tr>
							<td width="25%">CSV file contain total records</td>
							<td><?php echo $params['csv_total_record']; ?></td>
						  </tr>
						  <tr>
							<td width="25%">Time Passed</td>
							<td><?php echo $params['take_time_proccessed']; ?>seconds</td>
						  </tr>					  
						  <tr>
							<td width="25%">Total products inserted</td>
							<td><?php echo $params['total_record_inserted']; ?></td>
						  </tr>
						  <tr>
							<td width="25%">Total products updated</td>
							<td><?php echo $params['total_record_updated']; ?></td>
						  </tr>	
						  <tr>
							<td width="25%">Total records processed</td>
							<td><?php echo $params['total_record_proccessed']; ?></td>
						  </tr>
						  
						</table>	
				
					</div>
				</div>
			  </div>
		</div>
	</section>
</div>
	<!--</form>-->
	<?php
  }
?>
