<link href="plugins/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="plugins/summernote/summernote.js"></script>
  <link href="plugins/form-editable/css/bootstrap-editable.css" rel="stylesheet" />
  <script type="text/javascript" src="plugins/form-editable/js/bootstrap-editable.min.js"></script>
  
  <!--tags input css and js and intialize in footer-->
  <!--<link href="plugins/tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
  <script type="text/javascript" src="plugins/tagsinput/bootstrap-tagsinput.min.js"></script>-->
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
   <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="reviews_form" id="form_reviews">
   <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Reviews </h1>
     <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
	   <div class="pull-right">
                <button class="btn btn-primary" type="submit" name="reviews_save" value="save" ><i class="fa fa-save"></i></button>
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
         <form class="form-horizontal" name="reviewsform" action="<?php echo $form_action; ?>" method="post">
          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> <?php echo $text_form ?></h2>
             
            </div>
            <div class="box-body"> 
            <form class="form-horizontal">
             <input type="hidden" name="review_id" value="<?php echo $review_id; ?>" /> 
			 
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('author')!==""){echo "has-error";} ?>">
                <label for="author" class="col-sm-3 col-md-2 control-label">Author</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="author" id="author" class="form-control" placeholder="Author" value="<?php echo $author; ?>">
                    <?php echo form_error('author','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('product')!==""){echo "has-error";} ?>">
                <label for="product" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Product Name">Product</span></label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="product" id="product" value="<?php echo $product; ?>" class="form-control" placeholder="Product">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                    <?php echo form_error('product','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!------- start : input group ------>
              <div class="form-group required <?php if(form_error('text')!==""){echo "has-error";} ?>">
                <label for="text" class="col-sm-3 col-md-2 control-label">Text</label>
                <div class="col-sm-9 col-md-10">
                  <textarea class="form-control" name="text" id="text" rows="5" placeholder="Text"><?php echo $text; ?></textarea>
                  <?php echo form_error('text','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!------- end : input group ------>
              
              <!------- start : input group ------>
              <div class="form-group required <?php if(form_error('rating')!==""){echo "has-error";} ?>">
                <label for="rating" class="col-sm-3 col-md-2 control-label">Rating</label>
                <div class="col-sm-9 col-md-10" >
                <label>
               <input type="radio" id="rate_1" name="rating" class="minimal" value="1"<?php if($rating=="1"){ echo "checked";}?>>&nbsp;&nbsp;1&nbsp;&nbsp; 
                </label>
                <label>
                  <input type="radio" id="rate_2" name="rating" class="minimal" value="2"<?php if($rating=="2"){ echo "checked";}?>>&nbsp;&nbsp;2&nbsp;&nbsp; 
                </label>
                <label>    
				<input type="radio" id="rate_3" name="rating" class="minimal" value="3"<?php if($rating=="3"){ echo "checked";}?>>&nbsp;&nbsp;3&nbsp;&nbsp; 
                </label>
                <label>
                  <input type="radio" id="rate_4" name="rating" class="minimal" value="4"<?php if($rating=="4"){ echo "checked";}?>>&nbsp;&nbsp;4&nbsp;&nbsp; 
                </label>
                <label>
                  <input type="radio" id="rate_5" name="rating" class="minimal" value="5"<?php if($rating=="5"){ echo "checked";}?>>&nbsp;&nbsp;5&nbsp;&nbsp; 
                </label>
				    <?php echo form_error('rating','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!------- End : input group ------>
              
              <!------- start : input group ------>
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
              <!------- End : input group ------>
              <?php if($this->session->userdata('role_id')== 1) { ?>
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
            </form>
            </div>
            <!-- End : box-body -->
          </div>
        </div>
      </div>
    </section>
    <!----------------------- Main content -------------------------------> 
  </div>
  <!------------------- End content-wrapper ---------------------------->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/js/common.js"></script> 
<script type="text/javascript">
$('input[name=\'product\']').autocomplete({
    'source': function(request, response) {
        $.ajax({
            url: "<?php echo base_url('catalog/reviews/autocomplete/') ?>",
            dataType: 'json',
                    type:'POST',
                    data : {'product':request},
            success: function(json) {
                response($.map(json, function(item) {
                    return {
                        label: item['firstname'],
                        value: item['product_id']
                    }
                }));
            }
        });
    },
    'select': function(item) {
        $('input[name=\'product\']').val(item['label']);
        $('input[name=\'product_id\']').val(item['value']);		
    }	
}); 
</script>
<script type="text/javascript">
	//Initialize Select2 Elements
    $(".select2").select2();
	
	//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
</script>


