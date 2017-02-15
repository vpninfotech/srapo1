  <div class="content-wrapper"> 
      <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="form-download" id="form-download"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Downloads </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">        
        <button class="btn btn-primary" type="submit" value="save" name="download_save" form="form-download" title="Save"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" class="btn btn-default" title="Back"><i class="fa fa-reply"></i></a>
      </div>
    </section>
    <!------------------ End Content Header (Page header) ---------------------> 
    <!-------------------------- Main content --------------------------------->
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
            <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
            <input type="hidden" name="download_id" value="<?php echo $download_id; ?>" />
          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h2>
            </div>
            <div class="box-body">               
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('download_name')!==""){echo "has-error";} ?>">
                <label for="download_name" class="col-sm-3 col-md-2 control-label">Download Name</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="download_name" id="download_name" class="form-control" value="<?php echo $download_name; ?>" placeholder="Download Name">
                    <?php echo form_error('download_name','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->    
             
              
             
             <!------- start : image group ------>
              <div class="form-group <?php if(form_error('filename')!==""){echo "has-error";} ?>">
                <label class="col-sm-3 col-md-2 control-label" for="input-filename"><span data-toggle="tooltip" title="" data-original-title="You can upload via the upload button or use FTP to upload to the download directory and enter the details below.">Filename</span></label>
                 <div class="col-sm-10">
                    <div class="input-group">
                      <input type="text" name="filename" value="<?php echo $filename; ?>" placeholder="Filename" id="input-filename" class="form-control" readonly />
                      <span class="input-group-btn">
                      <button type="button" id="button-upload" data-loading-text="" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
                      </span> 
                    </div>
                     <?php echo form_error('filename','<div class="text-danger">', '</div>'); ?>
                  </div>
              </div>
              <!------- End : image group ------>
              
              
               <!-- Start : input Group -->
              <div class="form-group <?php if(form_error('mask')!==""){echo "has-error";} ?>">
                <label for="mask" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="It is recommended that the filename and the mask are different to stop people trying to directly link to your downloads.">Mask</span></label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="mask" id="mask" value="<?php echo $mask; ?>" class="form-control" placeholder="Mask" readonly>
                    <?php echo form_error('mask','<div class="text-danger">', '</div>'); ?>
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
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js"></script>

<script type="text/javascript">
$('#button-upload').on('click', function() {
    $('#form-upload').remove();
	
    $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

    $('#form-upload input[name=\'file\']').trigger('click');
    
    if (typeof timer != 'undefined') {
        clearInterval(timer);
    }
    timer = setInterval(function() {
        if ($('#form-upload input[name=\'file\']').val() != '') {
            clearInterval(timer);
            
            $.ajax({
				url: '<?php echo base_url('catalog/downloads/upload'); ?>',
				type: 'post',		
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,		
				beforeSend: function() {
					$('#button-upload').html('Loading...');
				},
				complete: function() {
					$('#button-upload').html('<i class="fa fa-upload"></i> Upload');
				},	
				success: function(json) {
                                    
					if (json['error']) {
						alert(json['error']);
					}
								
					if (json['success']) {
						alert(json['success']);
						
						$('input[name=\'filename\']').attr('value', json['filename']);
						$('input[name=\'mask\']').attr('value', json['mask']);
					}
				},			
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
            
});

	//Initialize Select2 Elements
        //$(".select2").select2();
	
	
	/* Start : image preview script */

function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#show-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(".img-select-data").change(function () {
    readURL1(this);
});
/* End : image preview script */

</script>



