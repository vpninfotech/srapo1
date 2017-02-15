<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>
<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/form-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/form-editable/js/bootstrap-editable.min.js"></script>

<!--tags input css and js and intialize in footer-->
<!--<link href="plugins/tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
  <script type="text/javascript" src="plugins/tagsinput/bootstrap-tagsinput.min.js"></script>-->
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">

<!-- Select2 -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
<!-- Select2 -->

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/all.css">
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/icheck.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Settings </h1>
    <ul class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul>
    <div class="pull-right">
            <button class="btn btn-primary" type="submit" value="save" name="settings_save" form="change_password_form"><i class="fa fa-save"></i></button>
            <!--<a href="#" class="btn btn-default"><i class="fa fa-reply"></i></a>--> 
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
      <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="change_password_form" id="change_password_form">
        <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
        <div class="box box-default">
        	<div class="box-header">
          <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> Add Settings </h2>
          
        </div>
            <div class="box-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                     <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
                  <li><a href="#tab-store" data-toggle="tab">Store</a></li>
                  <li><a href="#tab-local" data-toggle="tab">Local</a></li>
                  <li><a href="#tab-option" data-toggle="tab">Option</a></li>
                  <li><a href="#tab-image" data-toggle="tab">Image</a></li>
                  <li><a href="#tab-mail" data-toggle="tab">Mail</a></li>
                  <li><a href="#tab-social" data-toggle="tab">Social</a></li>
                </ul>
                    <div class="tab-content"> 
                  <!-- Start : tab-pane -->
                  <div class="tab-pane active" id="tab-general">
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_meta_title')!==""){echo "has-error";} ?>">
                      <label for="meta_title" class="col-sm-3 col-md-2 control-label">Meta Title</label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" class="form-control" name="config_meta_title" id="meta_title" placeholder="Meta Title" value="<?php echo $config_meta_title; ?>">
                        <?php echo form_error('config_meta_title','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- end : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="metadesc" class="col-sm-3 col-md-2 control-label">Meta Tag Description</label>
                      <div class="col-sm-9 col-md-10">
                        <textarea class="form-control" name="config_meta_description" id="metadesc" rows="5" placeholder="Meta Tag Description"><?php echo $config_meta_description; ?></textarea>
                      </div>
                    </div>
                    <!------- end : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="metakeyword" class="col-sm-3 col-md-2 control-label">Meta Tag Keywords</label>
                      <div class="col-sm-9 col-md-10">
                        <textarea class="form-control" name="config_meta_keyword" id="metakeyword" rows="5" placeholder="Meta Tag Keywords" data-role="tagsinput"><?php echo $config_meta_keyword; ?></textarea>
                      </div>
                    </div>
                    <!------- end : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for="template">Admin Template</label>
                      <div class="col-sm-9 col-md-10">
                        <select name="config_template" id="template" class="form-control">
                          <?php foreach ($templates as $template) { ?>
                          <?php if ($template == $config_template) { ?>
                          <option value="<?php echo $template; ?>" selected="selected"><?php echo $template; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $template; ?>"><?php echo $template; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select>
                        </br>
                      </div>
                    </div>
                    <!------- End : input group ------> 

                    <!------- start : input group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for="template">Site Template</label>
                      <div class="col-sm-9 col-md-10">
                        <select name="catalog_theme" id="template1" class="form-control">
                          <?php foreach ($catalog_templates as $template) { ?>
                          <?php if ($template == $catalog_templates) { ?>
                          <option value="<?php echo $template; ?>" selected="selected"><?php echo $template; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $template; ?>"><?php echo $template; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select>
                        </br>
                      </div>
                    </div>
                    <!------- End : input group ------>    
                  </div>
                  <!-- End : tab-pane-General --> 
                  
                   <!-- Start : tab-pane Store -->
                  <div class="tab-pane" id="tab-store"> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_store_name')!==""){echo "has-error";} ?>">
                      <label for="store_name" class="col-sm-3 col-md-2 control-label">Store Name</label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="store_name" name="config_store_name" class="form-control" placeholder="Store Name" value="<?php echo $config_store_name; ?>">
                        <?php echo form_error('config_store_name','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_store_owner')!==""){echo "has-error";} ?>">
                      <label for="store_owner" class="col-sm-3 col-md-2 control-label">Store Owner</label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="store_owner" name="config_store_owner" class="form-control" placeholder="Store Owner" value="<?php echo $config_store_owner; ?>">
                        <?php echo form_error('config_store_owner','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_address')!==""){echo "has-error";} ?>">
                      <label for="address" class="col-sm-3 col-md-2 control-label">Address</label>
                      <div class="col-sm-9 col-md-10">
                        <textarea class="form-control" name="config_address" id="address" rows="5" placeholder="Address" value=""><?php echo $config_address; ?></textarea>
                        <?php echo form_error('config_address','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- end : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="geocode" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Please enter your store location geocode manually.">Geocode</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" name="config_geocode" id="geocode" class="form-control" placeholder="Geocode" value="<?php echo $config_geocode; ?>">
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_email')!==""){echo "has-error";} ?>">
                      <label for="email" class="col-sm-3 col-md-2 control-label">Email</label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="email" name="config_email" class="form-control" placeholder="Email" value="<?php echo $config_email; ?>">
                        <?php echo form_error('config_email','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_telephone')!==""){echo "has-error";} ?>">
                      <label for="telephone" class="col-sm-3 col-md-2 control-label">Telephone</label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="telephone" name="config_telephone" class="form-control" placeholder="Telephone" value="<?php echo $config_telephone; ?>">
                        <?php echo form_error('config_telephone','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group ">
                      <label for="fax" class="col-sm-3 col-md-2 control-label">Fax</label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="fax" name="config_fax" class="form-control" placeholder="Fax" value="<?php echo $config_fax ?>">
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : image group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for="image">Image</label>
                      <div class="col-sm-4 col-md-4"> <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                        <input type="hidden" name="config_image" value="<?php echo $config_image; ?>" id="input-image" />
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <!------- End : image group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="opening_time" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Fill in your store's opening times.">Opening Time</span></label>
                      <div class="col-sm-9 col-md-10">
                        <textarea class="form-control" name="config_opening_time" id="opening_time" rows="5" placeholder="Opening Time" value=""><?php echo $config_opening_time; ?></textarea>
                      </div>
                    </div>
                    <!------- end : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="comment" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="This field is for any special notes you would like to tell the customer i.e. Store does not accept cheques.">Comment</span></label>
                      <div class="col-sm-9 col-md-10">
                        <textarea class="form-control" name="config_comment" id="comment" rows="5" placeholder="Comment" value=""><?php echo $config_comment; ?></textarea>
                      </div>
                    </div>
                    <!------- end : input group ------> 
                    
                  </div>
                  <!-- End : tab-pane- Store --> 
                  
                  <!-- Start : tab-local -->
                      <div class="tab-pane" id="tab-local"> 
                        <!------- start : input group ------>
                        <div class="form-group">
                          <label class="col-sm-3 col-md-2 control-label" for="country">Country</label>
                          <div class="col-sm-9 col-md-10">
                            <select name="config_country_id" id="config_country_id" class="form-control">
                            <?php
                              foreach ($country_list as $key => $value) {
                                if($value['country_id'] === $config_country_id)
                                {
                                 echo "<option value='".$value['country_id']."' selected> ".$value['country_name']." </option>";
                                }
                                else
                                {
                                  echo "<option value='".$value['country_id']."'> ".$value['country_name']." </option>"; 
                                }
                               } 
                              ?>
                              
                            </select>
                            
                          </div>
                        </div>
                        <!------- End : input group ------> 
                        
                        <!------- start : input group ------>
                        <div class="form-group">
                          <label class="col-sm-3 col-md-2 control-label" for="state">Region/State</label>
                          <div class="col-sm-9 col-md-10">
                            <select name="config_zone_id" id="config_zone_id" class="form-control" >
                                 <?php 
                           // $data = $this->Settings_model->getCountry();
                               foreach ($state_list as $key => $value) {
								    
                                if($value['state_id'] === $config_zone_id)
                                {
                                 echo "<option value='".$value['state_id']."' selected> ".$value['state_name']." </option>";
                                }
                                else
                                {
                                  echo "<option value='".$value['state_id']."'> ".$value['state_name']." </option>"; 
                                }
                               } 
                            ?>
                            </select>
                           
                          </div>
                        </div>
                        <!------- End : input group ------> 
                        
                        <!------- start : input group ------>
                        <div class="form-group">
                          <label class="col-sm-3 col-md-2 control-label" for="language">Language</label>
                          <div class="col-sm-9 col-md-10">
                            <select name="config_language" id="language" class="form-control">
                              <option value="english"> English </option>
                            </select>
                          </div>
                        </div>
                        <!------- End : input group ------> 
                        
                        <!------- start : input group ------>
                        <div class="form-group">
                          <label class="col-sm-3 col-md-2 control-label" for="admin_language">Administration Language</label>
                          <div class="col-sm-9 col-md-10">
                            <select name="config_admin_language" id="admin_language" class="form-control">
                              <option value="english"> English </option>
                            </select>
                          </div>
                        </div>
                        <!------- End : input group ------> 
                        
                        <!------- start : input group ------>
                        <div class="form-group">
                          <label class="col-sm-3 col-md-2 control-label" for="currency"><span data-toggle="tooltip" title="" data-original-title="Currency">Currency</span></label>
                          <div class="col-sm-9 col-md-10">
                            <select name="config_currency" id="config_currency" class="form-control" >
                              <?php
                              foreach ($currency_list as $key => $value) {
                                if($value['code'] === $config_currency)
                                {
                                 echo "<option value='".$value['code']."' selected> ".$value['title']." </option>";
                                }
                                else
                                {
                                  echo "<option value='".$value['code']."'> ".$value['title']." </option>"; 
                                }
                               } 
                            ?>
                            </select>
                            
                          </div>
                        </div>
                        <!------- End : input group ------> 
                        
                        <!------- start : Select group ------>
                        <div class="form-group">
                          <label class="col-sm-3 col-md-2 control-label" for=""><span data-toggle="tooltip" title="" data-original-title="Auto Update Currency">Auto Update Currency</span></label>
                          <div class="col-sm-9 col-md-10">
                            <label class="radio-inline">
                              <?php if ($config_currency_auto) { ?>
                              <input type="radio" id="currency_update" name="config_currency_auto" value="1" checked="checked" />
                              Yes
                              <?php } else { ?>
                              <input type="radio" id="currency_update" name="config_currency_auto" value="1" />
                              Yes
                              <?php } ?>
                            </label>
                            <label class="radio-inline">
                              <?php if (!$config_currency_auto) { ?>
                              <input type="radio" id="currency_update" name="config_currency_auto" value="0" checked="checked" />
                              No
                              <?php } else { ?>
                              <input type="radio" id="currency_update" name="config_currency_auto" value="0" />
                              No
                              <?php } ?>
                            </label>
                          </div>
                        </div>
                        <!------- End : Select group ------> 
                        
                       <!------- start : input group ------>
                        <div class="form-group">
                          <label class="col-sm-3 col-md-2 control-label" for="length_class">Length Class</label>
                          <div class="col-sm-9 col-md-10">
                            <select name="config_length_class_id" id="input-length-class" class="form-control">
                    <?php foreach ($length_classes as $length_class) { ?>
                    <?php if ($length_class['length_id'] == $config_length_class_id) { ?>
                    <option value="<?php echo $length_class['length_id']; ?>" selected="selected"><?php echo $length_class['title']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $length_class['length_id']; ?>"><?php echo $length_class['title']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                          </div>
                        </div>
                        <!------- End : input group ------> 
                        
                        <!------- start : input group ------>
                        <div class="form-group">
                          <label class="col-sm-3 col-md-2 control-label" for="weight_class">Weight Class</label>
                          <div class="col-sm-9 col-md-10">
                            <select name="config_weight_class_id" id="input-weight-class" class="form-control">
                    <?php foreach ($weight_classes as $weight_class) { ?>
                    <?php if ($weight_class['weight_id'] == $config_weight_class_id) { ?>
                    <option value="<?php echo $weight_class['weight_id']; ?>" selected="selected"><?php echo $weight_class['title']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $weight_class['weight_id']; ?>"><?php echo $weight_class['title']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                          </div>
                        </div>
                        <!------- End : input group ------> 
                        <!------- start : input group ------>
                        <div class="form-group required <?php if(form_error('config_date_format')!==""){echo "has-error";} ?>">
                          <label class="col-sm-3 col-md-2 control-label" for="date_format">Date Formate <a href="http://php.net/manual/en/function.date.php" target="_black"><i class="fa fa-external-link" aria-hidden="true"></i> </a></label>
                          <div class="col-sm-9 col-md-10">
                            <select name="config_date_format" id="date_format" class="form-control">
                              <option value="" <?php if($config_date_format == "") {echo 'selected="selected"';}?> > Select Date Formate </option>
                              <option value="Y/m/d" <?php if ($config_date_format == 'Y/m/d') {echo 'selected="selected"';}?> > Y/m/d </option>
                              <option value="Y-m-d" <?php if ($config_date_format == 'Y-m-d') {echo 'selected="selected"';}?> > Y-m-d </option>
                              <option value="d/m/Y" <?php if ($config_date_format == 'd/m/Y') {echo 'selected="selected"';}?> > d/m/Y </option>
                              <option value="d-m-Y" <?php if ($config_date_format == 'd-m-Y') {echo 'selected="selected"';}?> > d-m-Y </option>
                              <option value="m/d/Y" <?php if ($config_date_format == 'm/d/Y') {echo 'selected="selected"';}?> > m/d/Y </option>
                              <option value="m-d-Y" <?php if ($config_date_format == 'm-d-Y') {echo 'selected="selected"';}?> > m-d-Y </option>
                            </select>
                            <?php echo form_error('config_date_format','<div class="text-danger">', '</div>'); ?> </div>
                        </div>
                        <!------- End : input group ------> 
                        
                        <!------- start : input group ------>
                        <div class="form-group required <?php if(form_error('config_time_format')!==""){echo "has-error";} ?>">
                          <label class="col-sm-3 col-md-2 control-label" for="length_class">Time Formate</label>
                          <div class="col-sm-9 col-md-10">
                            <select name="config_time_format" id="time_format" class="form-control">
                              <option value="" <?php if($config_time_format == "") {echo 'selected="selected"';}?> > Select Time Format </option>
                              <option value="H:i:s" <?php if($config_time_format == "H:i:s") {echo 'selected="selected"';}?> > H:i:s </option>
                              <option value="H:i:sa" <?php if($config_time_format == "H:i:sa") {echo 'selected="selected"';}?> > H:i:sa </option>
                            </select>
                            <?php echo form_error('config_time_format','<div class="text-danger">', '</div>'); ?> </div>
                        </div>
                        <!------- End : input group ------> 
                      </div>
                      <!-- End : tab-panel-local --> 
                  
                  <!-- Start : tab-panel-option -->
                  <div class="tab-pane" id="tab-option"> 
                    <!------- start : Select group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for=""><span data-toggle="tooltip" title="" data-original-title="category_product_count">Category Product Count</span></label>
                      <div class="col-sm-9 col-md-10">
                        <label class="radio-inline">
                          <?php if ($config_product_count) { ?>
                          <input type="radio" class="minimal" id="category_product_count" name="config_product_count" value="1" checked="checked" />
                          Yes
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="category_product_count" name="config_product_count" value="1" />
                          Yes
                          <?php } ?>
                        </label>
                        <label class="radio-inline">
                          <?php if (!$config_product_count) { ?>
                          <input type="radio" class="minimal" id="category_product_count" name="config_product_count" value="0" checked="checked" />
                          No
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="category_product_count" name="config_product_count" value="0" />
                          No
                          <?php } ?>
                        </label>
                      </div>
                    </div>
                    <!------- End : Select group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_product_limit')!==""){echo "has-error";} ?>">
                      <label for="dipp" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Default Items Per Page (Catalog)">Default Items Per Page(Catalog)</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="dipp" name="config_product_limit" class="form-control" placeholder="Default Items Per Page(Catalog)" value="<?php echo $config_product_limit; ?>">
                        <?php echo form_error('config_product_limit','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_product_description_length')!==""){echo "has-error";} ?>">
                      <label for="dipp" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="list_description_limit">List Description Limit(Catalog)</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="list_description_limit" name="config_product_description_length" class="form-control" placeholder="List Description Limit" value="<?php echo $config_product_description_length; ?>">
                        <?php echo form_error('config_product_description_length','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_limit_admin')!==""){echo "has-error";} ?>">
                      <label for="dipp_admin" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Default Items Per Page (Admin)">Default Items Per Page(Admin)</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="dipp_admin" name="config_limit_admin" class="form-control" placeholder="Default Items Per Page(Catalog)" value="<?php echo $config_limit_admin; ?>">
                        <?php echo form_error('config_limit_admin','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- End : input group ------>
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_bestseller_limit')!==""){echo "has-error";} ?>">
                      <label for="dipp_admin" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="BestSeller Item Limit">BestSeller Item Limit</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="dipp_admin" name="config_bestseller_limit" class="form-control" placeholder="BestSeller Item Limit" value="<?php echo $config_bestseller_limit; ?>">
                        <?php echo form_error('config_bestseller_limit','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- End : input group ------>
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_latest_limit')!==""){echo "has-error";} ?>">
                      <label for="dipp_admin" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Latest Item Limit">Latest Item Limit</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="dipp_admin" name="config_latest_limit" class="form-control" placeholder="Latest Item Limit" value="<?php echo $config_latest_limit; ?>">
                        <?php echo form_error('config_latest_limit','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- End : input group ------>
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_special_limit')!==""){echo "has-error";} ?>">
                      <label for="dipp_admin" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Special Item Limit">Special Item Limit</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="dipp_admin" name="config_special_limit" class="form-control" placeholder="Special Item Limit" value="<?php echo $config_special_limit; ?>">
                        <?php echo form_error('config_special_limit','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- End : input group ------>
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_featured_limit')!==""){echo "has-error";} ?>">
                      <label for="dipp_admin" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Featured Item Limit">Featured Item Limit</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="dipp_admin" name="config_featured_limit" class="form-control" placeholder="Featured Item Limit" value="<?php echo $config_featured_limit; ?>">
                        <?php echo form_error('config_featured_limit','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- End : input group ------>
                    <legend>Reviews</legend>
                    
                    <!------- start : Select group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for=""><span data-toggle="tooltip" title="" data-original-title="Allow Reviews">Allow Reviews</span></label>
                      <div class="col-sm-9 col-md-10">
                        <label class="radio-inline">
                          <?php if ($config_review_status) { ?>
                          <input type="radio" class="minimal" id="allow_reviews" name="config_review_status" value="1" checked="checked" />
                          Yes
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="allow_reviews" name="config_review_status" value="1" />
                          Yes
                          <?php } ?>
                        </label>
                        <label class="radio-inline">
                          <?php if (!$config_review_status) { ?>
                          <input type="radio" class="minimal" id="allow_reviews" name="config_review_status" value="0" checked="checked" />
                          No
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="allow_reviews" name="config_review_status" value="0" />
                          No
                          <?php } ?>
                        </label>
                      </div>
                    </div>
                    <!------- End : Select group ------> 
                    
                    <!------- start : Select group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for=""><span data-toggle="tooltip" title="" data-original-title="All Guest Reviews">All Guest Reviews</span></label>
                      <div class="col-sm-9 col-md-10">
                        <label class="radio-inline">
                          <?php if ($config_review_guest) { ?>
                          <input type="radio" class="minimal" id="all_guest_reviews" name="config_review_guest" value="1" checked="checked" />
                          Yes
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="all_guest_reviews" name="config_review_guest" value="1" />
                          Yes
                          <?php } ?>
                        </label>
                        <label class="radio-inline">
                          <?php if (!$config_review_guest) { ?>
                          <input type="radio" class="minimal" id="all_guest_reviews" name="config_review_guest" value="0" checked="checked" />
                          No
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="all_guest_reviews" name="config_review_guest" value="0" />
                          No
                          <?php } ?>
                        </label>
                      </div>
                    </div>
                    <!------- End : Select group ------> 
                    
                    <!------- start : Select group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for=""><span data-toggle="tooltip" title="" data-original-title="New Review Alert Mail">New Review Alert Mail</span></label>
                      <div class="col-sm-9 col-md-10">
                        <label class="radio-inline">
                          <?php if ($config_review_mail) { ?>
                          <input type="radio" class="minimal" id="config_review_mail" name="config_review_mail" value="1" checked="checked" />
                          Yes
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_review_mail" name="config_review_mail" value="1" />
                          Yes
                          <?php } ?>
                        </label>
                        <label class="radio-inline">
                          <?php if (!$config_review_mail) { ?>
                          <input type="radio" class="minimal" id="config_review_mail" name="config_review_mail" value="0" checked="checked" />
                          No
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_review_mail" name="config_review_mail" value="0" />
                          No
                          <?php } ?>
                        </label>
                      </div>
                    </div>
                    <!------- End : Select group ------>
                    <legend>Vouchers</legend>
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_voucher_min')!==""){echo "has-error";} ?>">
                      <label for="voucher_min" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Voucher Min">Voucher Min</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="voucher_min" name="config_voucher_min" class="form-control" placeholder="Voucher Min" value="<?php echo $config_voucher_min; ?>">
                        <?php echo form_error('config_voucher_min','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_voucher_max')!==""){echo "has-error";} ?>">
                      <label for="voucher_max" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Voucher Max">Voucher Max</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="voucher_max" name="config_voucher_max" class="form-control" placeholder="Voucher Max" value="<?php echo $config_voucher_max; ?>">
                        <?php echo form_error('config_voucher_max','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- End : input group ------>
                    <legend>Tax</legend>
                     <!------- start : Select group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for=""><span data-toggle="tooltip" title="" data-original-title="Display Prices With Tax">Display Prices With Tax</span></label>
                      <div class="col-sm-9 col-md-10">
                        <label class="radio-inline">
                          <?php if ($config_tax) { ?>
                          <input type="radio" class="minimal" id="config_tax" name="config_tax" value="1" checked="checked" />
                          Yes
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_tax" name="config_tax" value="1" />
                          Yes
                          <?php } ?>
                        </label>
                        <label class="radio-inline">
                          <?php if (!$config_tax) { ?>
                          <input type="radio" class="minimal" id="config_tax" name="config_tax" value="0" checked="checked" />
                          No
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_tax" name="config_tax" value="0" />
                          No
                          <?php } ?>
                        </label>
                      </div>
                    </div>
                    <!------- End : Select group ------>
                    <legend>Account</legend>
                     <!------- start : input group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for="account_terms"><span data-toggle="tooltip" title="" data-original-title="Default Customer Group">Customer Group</span></label>
                      <div class="col-sm-9 col-md-10">
                        <select name="config_customer_group_id" id="config_customer_group_id" class="form-control">
                            <?php foreach($customer_group_list as $customer_group) { ?>
                            <?php if($customer_group['customer_group_id'] == $config_customer_group_id){ ?>
                            <option value="<?php echo $customer_group['customer_group_id'] ?>" selected="selected"><?php echo $customer_group['group_name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $customer_group['customer_group_id'] ?>"><?php echo $customer_group['group_name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                      </div>
                    </div>
                    <!------- End : input group ------> 

                    <!------- start : Select group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for=""><span data-toggle="tooltip" title="" data-original-title="Only show prices when a customer is logged in.">Login Display Prices</span></label>
                      <div class="col-sm-9 col-md-10">
                        <label class="radio-inline">
                          <?php if ($config_customer_price) { ?>
                          <input type="radio" class="minimal" id="config_customer_price" name="config_customer_price" value="1" checked="checked" />
                          Yes
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_customer_price" name="config_customer_price" value="1" />
                          Yes
                          <?php } ?>
                        </label>
                        <label class="radio-inline">
                          <?php if (!$config_customer_price) { ?>
                          <input type="radio" class="minimal" id="config_customer_price" name="config_customer_price" value="0" checked="checked" />
                          No
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_customer_price" name="config_customer_price" value="0" />
                          No
                          <?php } ?>
                        </label>
                      </div>
                    </div>
                    <!------- End : Select group ------>





                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="max_login_attempts" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Max Login attempts">Max Login Attempts</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="max_login_attempts" name="config_login_attempts" class="form-control" placeholder="Max Login Attempts" value="<?php echo $config_login_attempts; ?>">
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for="account_terms"><span data-toggle="tooltip" title="" data-original-title="Account Terms">Account Terms</span></label>
                      <div class="col-sm-9 col-md-10">
                        <select name="config_account_id" id="account_terms" class="form-control">
                            <option value="0"> --- None --- </option> 
                            <?php foreach($informations as $information) { ?>
                            <?php if($information['information_id'] == $config_account_id){ ?>
                            <option value="<?php echo $information['information_id'] ?>" selected="selected"><?php echo $information['title']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $information['information_id'] ?>"><?php echo $information['title']; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                      </div>
                    </div>
                    <!------- End : input group ------> 

                    
                    <!------- start : Select group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for=""><span data-toggle="tooltip" title="" data-original-title="New Account Alert Mail">New Account Alert Mail</span></label>
                      <div class="col-sm-9 col-md-10">
                        <label class="radio-inline">
                          <?php if ($config_account_mail) { ?>
                          <input type="radio" class="minimal" id="config_account_mail" name="config_account_mail" value="1" checked="checked" />
                          Yes
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_account_mail" name="config_account_mail" value="1" />
                          Yes
                          <?php } ?>
                        </label>
                        <label class="radio-inline">
                          <?php if (!$config_account_mail) { ?>
                          <input type="radio" class="minimal" id="config_account_mail" name="config_account_mail" value="0" checked="checked" />
                          No
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_account_mail" name="config_account_mail" value="0" />
                          No
                          <?php } ?>
                        </label>
                      </div>
                    </div>
                    <!------- End : Select group ------>
                    
                    <legend>Checkout</legend>
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="invoice_prefix" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Invoice Prefix">Invoice Prefix</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="invoice_prefix" name="config_invoice_prefix" class="form-control" placeholder="Invoice Prefix" value="<?php echo $config_invoice_prefix; ?>">
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : Select group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for=""><span data-toggle="tooltip" title="" data-original-title="Display Weight On Cart Page">Display Weight On Cart Page</span></label>
                      <div class="col-sm-9 col-md-10">
                        <label class="radio-inline">
                          <?php if ($config_cart_weight) { ?>
                          <input type="radio" class="minimal" id="config_cart_weight" name="config_cart_weight" value="1" checked="checked" />
                          Yes
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_cart_weight" name="config_cart_weight" value="1" />
                          Yes
                          <?php } ?>
                        </label>
                        <label class="radio-inline">
                          <?php if (!$config_cart_weight) { ?>
                          <input type="radio" class="minimal" id="config_cart_weight" name="config_cart_weight" value="0" checked="checked" />
                          No
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_cart_weight" name="config_cart_weight" value="0" />
                          No
                          <?php } ?>
                        </label>
                      </div>
                    </div>
                    <!------- End : Select group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for="checkout_terms"><span data-toggle="tooltip" title="" data-original-title="Checkout Terms">Checkout Terms</span></label>
                      <div class="col-sm-9 col-md-10">
                        <select name="config_checkout_id" id="checkout_terms" class="form-control">
                            <option value="0"> --- None --- </option> 
                            <?php foreach($informations as $information) { ?>
                            <?php if($information['information_id'] == $config_checkout_id){ ?>
                            <option value="<?php echo $information['information_id'] ?>" selected="selected"><?php echo $information['title']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $information['information_id'] ?>"><?php echo $information['title']; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for="order_status"><span data-toggle="tooltip" title="" data-original-title="Order Status">Order Status</span></label>
                      <div class="col-sm-9 col-md-10">
                        <select name="config_order_status_id" id="config_order_status_id" class="form-control">
                          <?php
                              foreach ($order_status_list as $key => $value) {
                                if($value['order_status_id'] === $config_order_status_id)
                                {
                                  echo "<option value='".$value['order_status_id']."' selected> ".$value['order_status_name']." </option>";
                                }
                                else
                                {
                                  echo "<option value='".$value['order_status_id']."'> ".$value['order_status_name']." </option>";
                                }
                               } 
                            ?>
                        </select>
                       
                      </div>
                    </div>
                     <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-process-status"><span data-toggle="tooltip" title="Set the order status the customer's order must reach before the order starts stock subtraction and coupon, voucher and rewards redemption.">Processing Order Status</span></label>
                  <div class="col-sm-10">
                    <div class="well well-sm" style="height: 150px; overflow: auto;">
                      <?php foreach ($order_status_list as $order_status) { ?>
                      <div class="checkbox">
                        <label>
                          <?php if (in_array($order_status['order_status_id'], $config_processing_status)) { ?>
                          <input type="checkbox" name="config_processing_status[]" value="<?php echo $order_status['order_status_id']; ?>" checked="checked" />
                          <?php echo $order_status['order_status_name']; ?>
                          <?php } else { ?>
                          <input type="checkbox" name="config_processing_status[]" value="<?php echo $order_status['order_status_id']; ?>" />
                          <?php echo $order_status['order_status_name']; ?>
                          <?php } ?>
                        </label>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-process-status"><span data-toggle="tooltip" title="Set the order status the customer's order must reach before they are allowed to access their downloadable products and gift vouchers.">Complete Order Status</span></label>
                  <div class="col-sm-10">
                    <div class="well well-sm" style="height: 150px; overflow: auto;">
                      <?php foreach ($order_status_list as $order_status) { ?>
                      <div class="checkbox">
                        <label>
                          <?php if (in_array($order_status['order_status_id'], $config_complete_status)) { ?>
                          <input type="checkbox" name="config_complete_status[]" value="<?php echo $order_status['order_status_id']; ?>" checked="checked" />
                          <?php echo $order_status['order_status_name']; ?>
                          <?php } else { ?>
                          <input type="checkbox" name="config_complete_status[]" value="<?php echo $order_status['order_status_id']; ?>" />
                          <?php echo $order_status['order_status_name']; ?>
                          <?php } ?>
                        </label>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
               
                    <!------- End : input group ------> 
                      <!------- start : input group ------>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-process-status"><span data-toggle="tooltip" title="Set the Category which are display on Home page.">Display Category</span></label>
                  <div class="col-sm-10">
                    <div class="well well-sm" style="height: 150px; overflow: auto;">
                      <?php foreach ($Categories as $category) { ?>
                      <div class="checkbox">
                        <label>
                          <?php if (in_array($category['category_id'], $config_display_categories)) { ?>
                          <input type="checkbox" name="config_display_categories[]" value="<?php echo $category['category_id']; ?>" checked="checked" />
                          <?php echo $category['category_name']; ?>
                          <?php } else { ?>
                          <input type="checkbox" name="config_display_categories[]" value="<?php echo $category['category_id']; ?>" />
                          <?php echo $category['category_name']; ?>
                          <?php } ?>
                        </label>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
               
                    <!------- End : input group ------> 
                    <!------- start : input group ------>
                    <!-- <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for="fraud_status"><span data-toggle="tooltip" title="" data-original-title="Fraud Status">Fraud Status</span></label>
                      <div class="col-sm-9 col-md-10">
                        <select name="config_fraud_status_id" id="fraud_status" class="form-control">
                          <option value="0"> Pending </option>
                          <option value="1"> Confirm </option>
                          <option value="2" selected="selected"> Canceled </option>
                        </select>
                      </div>
                    </div> -->
                    <!------- End : input group ------> 
                    
                    <!------- start : Select group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for=""><span data-toggle="tooltip" title="" data-original-title="New Order Alert Mail">New Order Alert Mail</span></label>
                      <div class="col-sm-9 col-md-10">
                        <label class="radio-inline">
                          <?php if ($config_order_mail) { ?>
                          <input type="radio" class="minimal" id="config_order_mail" name="config_order_mail" value="1" checked="checked" />
                          Yes
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_order_mail" name="config_order_mail" value="1" />
                          Yes
                          <?php } ?>
                        </label>
                        <label class="radio-inline">
                          <?php if (!$config_order_mail) { ?>
                          <input type="radio" class="minimal" id="config_order_mail" name="config_order_mail" value="0" checked="checked" />
                          No
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_order_mail" name="config_order_mail" value="0" />
                          No
                          <?php } ?>
                        </label>
                      </div>
                    </div>
                    <!------- End : Select group ------>

                    
                    <legend>Hot Categories</legend>
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_display_hot_categories')!==""){echo "has-error";} ?>">
                      <label for="config_display_hot_categories" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Set Display Hot Categories max value">Display Parent Category Max</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="config_display_hot_categories" name="config_display_hot_categories" class="form-control" placeholder="Category Max" value="<?php echo $config_display_hot_categories; ?>">
                        <?php echo form_error('config_display_hot_categories','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_display_hot_sub_categories')!==""){echo "has-error";} ?>">
                      <label for="config_display_hot_sub_categories" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Set Display Hot sub Categories max value">Display Sub Category Max</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="config_display_hot_sub_categories" name="config_display_hot_sub_categories" class="form-control" placeholder="Sub Category Max" value="<?php echo $config_display_hot_sub_categories; ?>">
                        <?php echo form_error('config_display_hot_sub_categories','<div class="text-danger">', '</div>'); ?> </div>
                    </div>
                    <!------- End : input group ------>
                    <legend>Stock</legend>
                    
                    <!------- start : Select group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for=""><span data-toggle="tooltip" title="" data-original-title="Display Stock">Display Stock</span></label>
                      <div class="col-sm-9 col-md-10">
                        <label class="radio-inline">
                          <?php if ($config_stock_display) { ?>
                          <input type="radio" class="minimal" id="config_stock_display" name="config_stock_display" value="1" checked="checked" />
                          Yes
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_stock_display" name="config_stock_display" value="1" />
                          Yes
                          <?php } ?>
                        </label>
                        <label class="radio-inline">
                          <?php if (!$config_stock_display) { ?>
                          <input type="radio" class="minimal" id="config_stock_display" name="config_stock_display" value="0" checked="checked" />
                          No
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_stock_display" name="config_stock_display" value="0" />
                          No
                          <?php } ?>
                        </label>
                      </div>
                    </div>
                    <!------- End : Select group ------> 
                    
                    <!------- start : Select group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for=""><span data-toggle="tooltip" title="" data-original-title="Show Out Of Stock Warning">Show Out Of Stock Warning</span></label>
                      <div class="col-sm-9 col-md-10">
                        <label class="radio-inline">
                          <?php if ($config_stock_warning) { ?>
                          <input type="radio" class="minimal" id="config_stock_warning" name="config_stock_warning" value="1" checked="checked" />
                          Yes
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_stock_warning" name="config_stock_warning" value="1" />
                          Yes
                          <?php } ?>
                        </label>
                        <label class="radio-inline">
                          <?php if (!$config_stock_warning) { ?>
                          <input type="radio" class="minimal" id="config_stock_warning" name="config_stock_warning" value="0" checked="checked" />
                          No
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_stock_warning" name="config_stock_warning" value="0" />
                          No
                          <?php } ?>
                        </label>
                      </div>
                    </div>
                    <!------- End : Select group ------> 
                    
                    <!------- start : Select group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for=""><span data-toggle="tooltip" title="" data-original-title="Stock Checkout">Stock Checkout</span></label>
                      <div class="col-sm-9 col-md-10">
                        <label class="radio-inline">
                          <?php if ($config_stock_checkout) { ?>
                          <input type="radio" class="minimal" id="config_stock_checkout" name="config_stock_checkout" value="1" checked="checked" />
                          Yes
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_stock_checkout" name="config_stock_checkout" value="1" />
                          Yes
                          <?php } ?>
                        </label>
                        <label class="radio-inline">
                          <?php if (!$config_stock_checkout) { ?>
                          <input type="radio" class="minimal" id="config_stock_checkout" name="config_stock_checkout" value="0" checked="checked" />
                          No
                          <?php } else { ?>
                          <input type="radio" class="minimal" id="config_stock_checkout" name="config_stock_checkout" value="0" />
                          No
                          <?php } ?>
                        </label>
                      </div>
                    </div>
                    <!------- End : Select group ------>
                    
                    <legend>Returns</legend>
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for="return_terms"><span data-toggle="tooltip" title="" data-original-title="Return Terms">Return Terms</span></label>
                      <div class="col-sm-9 col-md-10">
                          <select name="config_return_id" id="return_terms" class="form-control">
                            <option value="0"> --- None --- </option> 
                            <?php foreach($informations as $information) { ?>
                            <?php if($information['information_id'] == $config_return_id){ ?>
                            <option value="<?php echo $information['information_id'] ?>" selected="selected"><?php echo $information['title']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $information['information_id'] ?>"><?php echo $information['title']; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for="return_status"><span data-toggle="tooltip" title="" data-original-title="Return Status">Return Status</span></label>
                      <div class="col-sm-9 col-md-10">
                        <select name="config_return_status_id" id="return_status" class="form-control">
                          <?php
                              foreach ($return_status_list as $key => $value) {
                                if($value['return_status_id'] === $config_return_status_id)
                                {
                                 echo "<option value='".$value['return_status_id']."' selected> ".$value['return_status_name']." </option>";
                                }
                                else
                                {
                                  echo "<option value='".$value['return_status_id']."'> ".$value['return_status_name']." </option>"; 
                                }
                               } 
                            ?>
                        </select>
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                  </div>
                  <!-- End : tab-pane-option --> 
                  
                  <!-- Start tab-pane-image -->
                  <div class="tab-pane" id="tab-image"> 
                    
                    <!------- start : image group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for="image">Store Logo</label>
                      <div class="col-sm-4 col-md-4"> <a href="" id="thumb-logo" data-toggle="image" class="img-thumbnail"><img src="<?php echo $logo; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                        <input type="hidden" name="config_logo" value="<?php echo $config_logo; ?>" id="input-logo" />
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    
                    <!------- End : image group ------> 
                    
                    <!------- start : image group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for="image"><span data-toggle="tooltip" title="" data-original-title="Icon">Icon</span></label>
                      <div class="col-sm-4 col-md-4"> <a href="" id="thumb-icon" data-toggle="image" class="img-thumbnail"><img src="<?php echo $icon; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                        <input type="hidden" name="config_icon" value="<?php echo $config_icon; ?>" id="input-icon" />
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <!------- End : image group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_image_category_width')!=="" || form_error('config_image_category_height')!==""  ){echo "has-error";} ?>">
                      <label for="category_image_size" class="col-sm-3 col-md-2 control-label">Category Image Size</label>
                      <div class="col-sm-9 col-md-10">
                        <div class="row">
                          <div class="col-sm-6">
                            <input type="text" id="category_image_width" name="config_image_category_width" class="form-control" placeholder="Width" value="<?php echo $config_image_category_width; ?>">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" id="category_image_height" name="config_image_category_height" class="form-control" placeholder="Height" value="<?php echo $config_image_category_height; ?>">
                          </div>
                        </div>
                        <?php
                                      if(form_error('config_image_category_width')!==""){
        
                                        echo form_error('config_image_category_width','<div class="text-danger">', '</div>');    
                                      }
                                      else if(form_error('config_image_category_height')!==""){
                                        echo form_error('config_image_category_height','<div class="text-danger">', '</div>');
                                      }
                                      else{
        
                                      }
                                    ?>
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_image_thumb_width')!=="" || form_error('config_image_thumb_height')!==""  ){echo "has-error";} ?>">
                      <label for="product_image_thumb_size" class="col-sm-3 col-md-2 control-label">Product Image Thumb Size</label>
                      <div class="col-sm-9 col-md-10">
                        <div class="row">
                          <div class="col-sm-6">
                            <input type="text" id="product_image_thumb_width" name="config_image_thumb_width" class="form-control" placeholder="Width" value="<?php echo $config_image_thumb_width; ?>">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" id="product_image_thumb_height" name="config_image_thumb_height" class="form-control" placeholder="Height" value="<?php echo $config_image_thumb_height; ?>">
                          </div>
                        </div>
                        <?php
                                      if(form_error('config_image_thumb_width')!==""){
        
                                        echo form_error('config_image_thumb_width','<div class="text-danger">', '</div>');    
                                      }
                                      else if(form_error('config_image_thumb_height')!==""){
                                        echo form_error('config_image_thumb_height','<div class="text-danger">', '</div>');
                                      }
                                      else{
        
                                      }
                                    ?>
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_image_popup_width')!=="" || form_error('config_image_popup_height')!==""  ){echo "has-error";} ?>">
                      <label for="product_image_popup_size" class="col-sm-3 col-md-2 control-label">Product Image Popup Size</label>
                      <div class="col-sm-9 col-md-10">
                        <div class="row">
                          <div class="col-sm-6">
                            <input type="text" id="product_image_popup_width" name="config_image_popup_width" class="form-control" placeholder="Width" value="<?php echo $config_image_popup_width; ?>">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" id="product_image_popup_height" name="config_image_popup_height" class="form-control" placeholder="Height" value="<?php echo $config_image_popup_height; ?>">
                          </div>
                        </div>
                        <?php
                                      if(form_error('config_image_popup_width')!==""){
        
                                        echo form_error('config_image_popup_width','<div class="text-danger">', '</div>');    
                                      }
                                      else if(form_error('config_image_popup_height')!==""){
                                        echo form_error('config_image_popup_height','<div class="text-danger">', '</div>');
                                      }
                                      else{
        
                                      }
                                    ?>
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_image_product_width')!=="" || form_error('config_image_product_height')!==""  ){echo "has-error";} ?>">
                      <label for="product_image_list_size" class="col-sm-3 col-md-2 control-label">Product Image List Size</label>
                      <div class="col-sm-9 col-md-10">
                        <div class="row">
                          <div class="col-sm-6">
                            <input type="text" id="product_image_list_width" name="config_image_product_width" class="form-control" placeholder="Width" value="<?php echo $config_image_product_width; ?>">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" id="product_image_list_height" name="config_image_product_height" class="form-control" placeholder="Height" value="<?php echo $config_image_product_height; ?>">
                          </div>
                        </div>
                        <?php
                                      if(form_error('config_image_product_width')!==""){
        
                                        echo form_error('config_image_product_width','<div class="text-danger">', '</div>');    
                                      }
                                      else if(form_error('config_image_product_height')!==""){
                                        echo form_error('config_image_product_height','<div class="text-danger">', '</div>');
                                      }
                                      else{
        
                                      }
                                    ?>
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_image_additional_width')!=="" || form_error('config_image_additional_height')!==""  ){echo "has-error";} ?>">
                      <label for="additional_product_image_size" class="col-sm-3 col-md-2 control-label">Additional Product Image Size</label>
                      <div class="col-sm-9 col-md-10">
                        <div class="row">
                          <div class="col-sm-6">
                            <input type="text" id="additional_product_image_width" name="config_image_additional_width" class="form-control" placeholder="Width" value="<?php echo $config_image_additional_width; ?>">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" id="additional_product_image_height" name="config_image_additional_height" class="form-control" placeholder="Height" value="<?php echo $config_image_additional_height; ?>">
                          </div>
                        </div>
                        <?php
                                      if(form_error('config_image_additional_width')!==""){
        
                                        echo form_error('config_image_additional_width','<div class="text-danger">', '</div>');    
                                      }
                                      else if(form_error('config_image_additional_height')!==""){
                                        echo form_error('config_image_additional_height','<div class="text-danger">', '</div>');
                                      }
                                      else{
        
                                      }
                                    ?>
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_image_related_width')!=="" || form_error('config_image_related_height')!==""  ){echo "has-error";} ?>">
                      <label for="related_product_image_size" class="col-sm-3 col-md-2 control-label">Related Product Image Size</label>
                      <div class="col-sm-9 col-md-10">
                        <div class="row">
                          <div class="col-sm-6">
                            <input type="text" id="related_product_image_height" name="config_image_related_width" class="form-control" placeholder="Width" value="<?php echo $config_image_related_width; ?>">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" id="related_product_image_width" name="config_image_related_height" class="form-control" placeholder="Height" value="<?php echo $config_image_related_height; ?>">
                          </div>
                        </div>
                        <?php
                                      if(form_error('config_image_related_width')!==""){
        
                                        echo form_error('config_image_related_width','<div class="text-danger">', '</div>');    
                                      }
                                      else if(form_error('config_image_related_height')!==""){
                                        echo form_error('config_image_related_height','<div class="text-danger">', '</div>');
                                      }
                                      else{
        
                                      }
                                    ?>
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_image_compare_width')!=="" || form_error('config_image_compare_height')!==""  ){echo "has-error";} ?>">
                      <label for="compare_image_size" class="col-sm-3 col-md-2 control-label"> Compare Image Size</label>
                      <div class="col-sm-9 col-md-10">
                        <div class="row">
                          <div class="col-sm-6">
                            <input type="text" id="compare_image_width" name="config_image_compare_width" class="form-control" placeholder="Width" value="<?php echo $config_image_compare_width ?>">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" id="compare_image_height" name="config_image_compare_height" class="form-control" placeholder="Height" value="<?php echo $config_image_compare_height; ?>">
                          </div>
                        </div>
                        <?php
                                      if(form_error('config_image_compare_width')!==""){
        
                                        echo form_error('config_image_compare_width','<div class="text-danger">', '</div>');    
                                      }
                                      else if(form_error('config_image_compare_height')!==""){
                                        echo form_error('config_image_compare_height','<div class="text-danger">', '</div>');
                                      }
                                      else{
        
                                      }
                                    ?>
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_image_wishlist_width')!=="" || form_error('config_image_wishlist_height')!==""  ){echo "has-error";} ?>">
                      <label for="wishlist_image_size" class="col-sm-3 col-md-2 control-label">Wishlist Image Size</label>
                      <div class="col-sm-9 col-md-10">
                        <div class="row">
                          <div class="col-sm-6">
                            <input type="text" id="wishlist_image_width" name="config_image_wishlist_width" class="form-control" placeholder="Width" value="<?php echo $config_image_wishlist_width; ?>">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" id="wishlist_image_height" name="config_image_wishlist_height" class="form-control" placeholder="Height" value="<?php echo $config_image_wishlist_height; ?>">
                          </div>
                        </div>
                        <?php
                                      if(form_error('config_image_wishlist_width')!==""){
        
                                        echo form_error('config_image_wishlist_width','<div class="text-danger">', '</div>');    
                                      }
                                      else if(form_error('config_image_wishlist_height')!==""){
                                        echo form_error('config_image_wishlist_height','<div class="text-danger">', '</div>');
                                      }
                                      else{
        
                                      }
                                    ?>
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_image_cart_width')!=="" || form_error('config_image_cart_height')!==""  ){echo "has-error";} ?>">
                      <label for="cart_image_size" class="col-sm-3 col-md-2 control-label">Cart Image Size</label>
                      <div class="col-sm-9 col-md-10">
                        <div class="row">
                          <div class="col-sm-6">
                            <input type="text" id="cart_image_width" name="config_image_cart_width" class="form-control" placeholder="Width" value="<?php echo $config_image_cart_width; ?>">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" id="cart_image_height" name="config_image_cart_height" class="form-control" placeholder="Height" value="<?php echo $config_image_cart_height; ?>">
                          </div>
                        </div>
                        <?php
                                      if(form_error('config_image_cart_width')!==""){
        
                                        echo form_error('config_image_cart_width','<div class="text-danger">', '</div>');    
                                      }
                                      else if(form_error('config_image_cart_height')!==""){
                                        echo form_error('config_image_cart_height','<div class="text-danger">', '</div>');
                                      }
                                      else{
        
                                      }
                                    ?>
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group required <?php if(form_error('config_image_location_width')!=="" || form_error('config_image_location_height')!==""  ){echo "has-error";} ?>">
                      <label for="store_image_size" class="col-sm-3 col-md-2 control-label">Store Image Size</label>
                      <div class="col-sm-9 col-md-10">
                        <div class="row">
                          <div class="col-sm-6">
                            <input type="text" id="store_image_width" name="config_image_location_width" class="form-control" placeholder="Width" value="<?php echo $config_image_location_width; ?>">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" id="store_image_height" name="config_image_location_height" class="form-control" placeholder="Height" value="<?php echo $config_image_location_height; ?>">
                          </div>
                        </div>
                        <?php
                                      if(form_error('config_image_location_width')!==""){
        
                                        echo form_error('config_image_location_width','<div class="text-danger">', '</div>');    
                                      }
                                      else if(form_error('config_image_location_height')!==""){
                                        echo form_error('config_image_location_height','<div class="text-danger">', '</div>');
                                      }
                                      else{
        
                                      }
                                    ?>
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                  </div>
                  <!-- End : tab-pane- image --> 
                  
                  <!-- Start : tab-pane-mail -->
                  <div class="tab-pane" id="tab-mail"> 
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label class="col-sm-3 col-md-2 control-label" for="account_terms"><span data-toggle="tooltip" title="" data-original-title="Mail Protocol">Mail Protocol</span></label>
                      <div class="col-sm-9 col-md-10">
                        <select name="config_mail_protocol" id="mail_protocol" class="form-control">
                          <?php if ($this->common->config('config_mail_protocol') === 'mail') { ?>
                          <option value="mail" selected="selected">Mail</option>
                          <?php } else { ?>
                          <option value="mail">Mail</option>
                          <?php } ?>
                          <?php if ($this->common->config('config_mail_protocol') === 'smtp') { ?>
                          <option value="smtp" selected="selected">SMTP</option>
                          <?php } else { ?>
                          <option value="smtp">SMTP</option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="mail_parameter" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Mail Parameters">Mail Parameters</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="mail_parameter" name="config_mail_parameter" class="form-control" placeholder="Mail Parameters" value="<?php echo $config_mail_parameter; ?>">
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="smtp_hostname" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="SMTP Hostname">SMTP Hostname</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="smtp_hostname" name="config_mail_smtp_hostname" class="form-control" placeholder="SMTP Hostname" value="<?php echo $config_mail_smtp_hostname; ?>">
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="smtp_username" class="col-sm-3 col-md-2 control-label">SMTP Username</label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="smtp_username" name="config_mail_smtp_username" class="form-control" placeholder="SMTP Username" value="<?php echo $config_mail_smtp_username ?>">
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="smtp_password" class="col-sm-3 col-md-2 control-label">SMTP Password</label>
                      <div class="col-sm-9 col-md-10">
                        <input type="Password" id="smtp_password" name="config_mail_smtp_password" class="form-control" placeholder="SMTP Password" value="<?php echo $config_mail_smtp_password ?>">
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="smtp_port" class="col-sm-3 col-md-2 control-label">SMTP Port</label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="smtp_port" name="config_mail_smtp_port" class="form-control" placeholder="SMTP Port" value="<?php echo $config_mail_smtp_port ?>">
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="smtp_timeout" class="col-sm-3 col-md-2 control-label">SMTP Timeout</label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="smtp_timeout" name="config_mail_smtp_timeout" class="form-control" placeholder="SMTP Timeout" value="<?php echo $config_mail_smtp_timeout ?>">
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="additional_alert_emails" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Additional Alert E-Mails">Additional Alert E-Mails</span></label>
                      <div class="col-sm-9 col-md-10">
                        <textarea class="form-control" name="config_mail_alert" id="additional_alert_emails" placeholder="Additional Alert E-Mails" rows="5"><?php echo $config_mail_alert ?></textarea>
                      </div>
                    </div>
                    <!------- end : input group ------> 
                    
                  </div>
                  <!-- End : tab-pane-mail --> 
                  <!-- Start : tab-pane-social -->
                  <div class="tab-pane" id="tab-social"> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="facebook" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Facebook">Facebook Link</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="facebook" name="config_facebook_link" class="form-control" placeholder="Facebook" value="<?php echo $config_facebook_link; ?>">
                      </div>
                    </div>
                    <!------- End : input group ------> 
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="twitter" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Twitter">Twitter Link</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="twitter" name="config_twitter_link" class="form-control" placeholder="Twitter" value="<?php echo $config_twitter_link; ?>">
                      </div>
                    </div>
                    <!------- End : input group ------>
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="googleplus" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Google+">Google+ Link</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="googleplus" name="config_googleplus_link" class="form-control" placeholder="Google+" value="<?php echo $config_googleplus_link; ?>">
                      </div>
                    </div>
                    <!------- End : input group ------>
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="pinterest" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Pinterest">Pinterest Link</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="pinterest" name="config_pinterest_link" class="form-control" placeholder="Pinterest" value="<?php echo $config_pinterest_link; ?>">
                      </div>
                    </div>
                    <!------- End : input group ------>
                    
                    <!------- start : input group ------>
                    <div class="form-group">
                      <label for="instagram" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Instagram">Instagram Link</span></label>
                      <div class="col-sm-9 col-md-10">
                        <input type="text" id="instagram" name="config_instagram_link" class="form-control" placeholder="Instagram" value="<?php echo $config_instagram_link; ?>">
                      </div>
                    </div>
                    <!------- End : input group ------>
                    
                  </div>
                  <!-- End : tab-pane-social --> 
                </div>
                <!-- /.tab-content -->
                </div>
            <!-- nav-tabs-custom --> 
            </div>
        </div>
   </form>

</div>
</div>
</section>
<!----------------------- Main content ------------------------------->
</div>
<!------------------- End content-wrapper ----------------------------> 

<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js"> 		</script> 
<script>/*$("textarea").tagsinput('items')*/</script> 
<script type="text/javascript">
	//Initializa Summernote
	$('#input-description').summernote({height: 300});
	
	//Initialize Select2 Elements
    $(".select2").select2();
	
	//Date picker
    $('#date_available').datepicker({
      autoclose: true
    });

/* End : image preview script For Image-1 tab*/

var baseurl = "<?php print base_url(); ?>"; 	
 $(document).ready(function()
 {  
     $("#config_country_id").change(function(){  
         var html = "<option value=''> -- Please Select -- </option>";
         $.ajax({  
            url:"<?php echo  base_url();?>system/settings/getState",  
            data: {country_id:$(this).val()},
            dataType: 'json',
           type: "POST",  
            async: false,
            success:function(data){  
             
             if(data.length > 0)
             {
                $.each(data, function(index,value)
                {
                  html +="<option value='"+value.state_id+"'>"+value.state_name+"</option>";
                });
             }
             else
             {
                html +="<option value='0' selected>-- None --</option>";
             } 
              
            }  
	 
          });  
           $("#config_zone_id").html(html);  
       });  
			   
         
   
	  }); 
   function getstate(country_id)
   { 
      var html ="<option value=''> Select Region/State </option>";
	       $.ajax({  
            url:"<?php echo  base_url();?>system/settings/getState",  
            data: {country_id:country_id},
            dataType: 'json',
            type: "POST",  
            async: false,
            success:function(data){  
						if(data.length > 0)
             {
                $.each(data, function(index,value)
                {
                  html +="<option value='"+value.state_id+"'>"+value.state_name+"</option>";
                });
             }
             else
             {
                html +="<option value='0' selected>-- None --</option>";
             }
						}  
					 
					 
          }); 
	   
	   $("#config_zone_id").html(html);
   }
   
  getstate($("#config_country_id").val());

</script> 
<?php
if(isset($config_zone_id) && $config_zone_id != "")
{?>
<script type="text/javascript">
  $("#config_zone_id").val('<?php echo $config_zone_id?>');
</script>
<?php
}
?>