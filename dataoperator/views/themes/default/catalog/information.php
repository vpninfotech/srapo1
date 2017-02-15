<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>

  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
  <!-- Select2 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/all.css">
<!-- iCheck 1.0.1 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/icheck.min.js"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
   <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="information_form" id="form-information">
    <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('Dtoken'); ?>" />
    <input type="hidden" name="information_id" id="information_id" value="<?php echo $information_id; ?>" />
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Information </h1>
     <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
       <div class="pull-right">
         <button class="btn btn-primary" type="submit" name="information_save" value="save" form="form-information"><i class="fa fa-save"></i></button>
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
          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> <?php echo $text_form; ?> </h2>
            </div>
            <div class="box-body"> 
           
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('title')!==""){echo "has-error";} ?>">
                <label for="info_title" class="col-sm-3 col-md-2 control-label">Information Title</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="title" id="title" class="form-control" placeholder="Information Title" value="<?php echo $title;  //echo set_value('title'); ?>">
                     <?php echo form_error('title','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
             <!------- start : text area group ------>
              <div class="form-group required <?php if(form_error('description')!==""){echo "has-error";} ?>">
                <label for="description" class="col-sm-3 col-md-2 control-label">Description</label>
                <div class="col-sm-9 col-md-10">
                  <textarea class="form-control" name="description" id="input-description"><?php echo $description; ?></textarea>
                  <?php echo form_error('description','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!------- End : text area group ------>
              
              <!------- start : input group ------>
              <div class="form-group required <?php if(form_error('meta_title')!==""){echo "has-error";} ?>">
                <label for="metatag" class="col-sm-3 col-md-2 control-label">Meta Tag Title</label>
                <div class="col-sm-9 col-md-10">
                  <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Meta Tag Title" value="<?php echo $meta_title; ?>">
                   <?php echo form_error('meta_title','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!------- end : input group ------>
              
              <!------- start : input group ------>
              <div class="form-group">
                <label for="metadesc" class="col-sm-3 col-md-2 control-label">Meta Tag Description</label>
                <div class="col-sm-9 col-md-10">
                  <textarea class="form-control" name="meta_description" id="meta_description" rows="5" placeholder="Meta Tag Description"><?php echo $meta_description; ?></textarea>
                </div>
              </div>
              <!------- end : input group ------>
              
              <!------- start : input group ------>
              <div class="form-group">
                <label for="metakeyword" class="col-sm-3 col-md-2 control-label">Meta Tag Keywords</label>
                <div class="col-sm-9 col-md-10">
                  <textarea class="form-control" name="meta_keyword" id="meta_keyword" rows="5" placeholder="Meta Tag Keywords"><?php echo $meta_keyword; ?></textarea>
                </div>
              </div>
              <!------- end : input group ------>
                <!------- start : input group ------>
                    <div class="form-group required <?php if (form_error('seo_keywords') !== "") { echo "has-error"; } ?>"">
                      <label for="seo_keyword" class="col-sm-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Do not use spaces, instead replace spaces with - and make sure the SEO URL is globally unique.">SEO Keywords</span></label>
                      <div class="col-sm-10">
                        <input type="text" id="seo_keywords" name="seo_keywords" class="form-control" placeholder="SEO Keyword" value="<?php echo $seo_keywords; ?>">
                        <?php echo form_error('seo_keywords','<div class="text-danger">', '</div>'); ?>
                      </div>
                    </div>
                    <!------- End : input group ------>
              <!------- start : input group ------>
              <div class="form-group">
                <label for="bottom" class="col-sm-3 col-md-2 control-label">Bottom</label>
                <div class="col-sm-9 col-md-10 store-checkbox">
                    <input type="checkbox" id="bottom" name="bottom" onclick="checkBottom(this)"  value="<?php echo $bottom; ?>" <?php if($bottom==1) echo 'checked'; ?>>
                    
                        <script type="text/javascript">
                            function checkBottom(checkbox)
                            {
                                if (checkbox.checked)
                                {
                                    $("#bottom").val("1");
                                }
                                else
                                {
                                    $("#bottom").val("0");
                                }
                            }
                        </script>
                </div>                 
              </div>
              <!------- End : input group ------>
              <!------- start : input group ------>
              <div class="form-group">
                <label for="column" class="col-sm-3 col-md-2 control-label">Column</label>
                <div class="col-sm-9 col-md-10">
                  <input type="text" name="column" id="column" class="form-control" placeholder="Column" value="<?php echo $column; ?>">
                </div>
              </div>
              <!------- end : input group ------>
              <!------- start : Select group ------>
              <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label" for="status">Status</label>
                  <div class="col-sm-9 col-md-10">
                    <select name="status" id="status" class="form-control">
                        <?php if ($status) { ?>
                        <option value="0">Disabled</option>
                        <option value="1" selected="selected">Enabled</option>
                        <?php } else { ?>
                        <option value="0" selected="selected">Disabled</option>
                        <option value="1">Enabled</option>
                        <?php } ?>
                    </select>
                    <script>
                        $("#status").val(<?=isset($status)?$status:''?>);
                    </script> 
                  </div>                  
              </div>
              <!------- End : Select group ------>
              
              <!-- Start : input Group -->
              <div class="form-group">
                <label for="info_title" class="col-sm-3 col-md-2 control-label">Sort Order</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="sort_order" id="sort_order" class="form-control" placeholder="Sort Order" value="<?php echo $sort_order; ?>">
                </div>
              </div>
              <!-- End : input Group -->
              
              <?php if($this->session->userdata('Drole_id')== 1) { ?>
              <!------- start : Select group ------>
              <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label" for="status">Soft Deleted</label>
                  <div class="col-sm-9 col-md-10">
                    <input type="checkbox" name="is_deleted" onclick="checkAddress(this)" value="<?php echo $is_deleted; ?>" <?php if($is_deleted == 1) echo 'checked'; ?> id="is_deleted"/>   
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
            <!-- End : box-body -->
          </div>
        </div>
      </div>
    </section>
    <!----------------------- Main content -------------------------------> 
    </form>
  </div>
  <!------------------- End content-wrapper ---------------------------->
  
<script type="text/javascript">
var baseurl = "<?php print base_url(); ?>"; 
    //Initializa Summernote
	$('#input-description').summernote({height: 300});
	
	//Initialize Select2 Elements
    $(".select2").select2();
	
	//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
</script>


