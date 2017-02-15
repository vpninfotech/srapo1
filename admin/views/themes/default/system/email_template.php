<link href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/select2/select2.min.js"></script>
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/iCheck/all.css">
<!-- iCheck 1.0.1 -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/iCheck/icheck.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Email Templates </h1>
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
        </ul>

        <div class="pull-right">
            <button class="btn btn-primary" type="submit" value="save" name="template_save" form="form-template" title="Save"><i class="fa fa-save"></i></button>
            <a href="<?php echo $cancel; ?>" class="btn btn-default" title="Back"><i class="fa fa-reply"></i></a>
        </div>
    </section>
    <!------------------ End Content Header (Page header) ------------------- --> 
    
    <!-------------------------- Main content ------------------------------- -->
    <section class="content">
        <div class="row">
        <?php if (isset($error) && $error !== ""): ?>
        <div class="col-xs-12">
            <div class="alert alert-danger alert-bold-border">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>

                <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error; ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if (isset($success) && $success !== ""): ?>
            <div class="col-xs-12">
                <div class="alert alert-success alert-bold-border">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>

                    <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success; ?>

                </div>
            </div>
        <?php endif; ?>

                <div class="col-xs-12">
                    <div class="box box-default">

                        <div class="box-header">
                            <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i><?php echo $text_form; ?></h2>
                            <div class="pull-right">
                                <a href="<?php echo $restore_data; ?>" class="btn btn-default" title="Restore Default Text"><i class="fa fa-undo"></i></a>
                                <!--<a href="<?php echo $cancel; ?>" class="btn btn-default" title="Send Test Email"><i class="fa fa-send-o"></i></a>-->
                                <a data-toggle="modal" data-target="#colored-header" class="btn btn-default"  title="Send Test Email"><i class="fa fa-send-o"></i></a>
                                <a href="<?php echo $view_template.$template_code; ?>" class="btn btn-default" target="_blank" title="Preview Email"><i class="fa fa-newspaper-o"></i></a>
                            </div>
                        </div> 
                        
                        <div class="box-body">
                            <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="form-template" id="form-template"> 
            
            
                <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
                <input type="hidden" name="template_id" value="<?php echo $template_id; ?>" />
                            
                            <!------- start : input group ------>
                            <div class="form-group">
                                <label for="title" class="col-sm-3 col-md-2 control-label">Template Title</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Template Title" value="<?php echo $template_name; ?>" readonly="readonly">
                                </div>
                            </div>
                            <!------- end : input group ------>
                            
                            
                            <!------- start : input group ------>
                            <div class="form-group">
                                <label for="title" class="col-sm-3 col-md-5 control-label"><b>Use these following Keywords in Email Message Content.</b></label>
                                
                                <div class="col-md-12">
                                <label for="title" class="col-sm-3 col-md-1 control-label"></label>
                                <div class="col-sm-3 col-md-11">
                                    <?php foreach(explode("|",$hints) as $hint) { ?>
                                    <?php $h = explode("$",$hint); ?>
                                    <li><span class="text-warning"><?=$h[0]?></span>
                                    &nbsp;:&nbsp;
                                    <span class="text-muted"><?=$h[2]?></span></li>
                                    <?php } ?> 
                                </div>
                                </div>
                            </div> 
                            
                            <!------- end : input group ------>
                            
                            <!------- start : input group ------>
                            <div class="form-group required <?php if (form_error('subject') !== "") { echo "has-error"; } ?>">
                                <label for="subject" class="col-sm-3 col-md-2 control-label">Subject</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" value="<?php echo $subject; ?>">
                                    <?php echo form_error('subject', '<div class="text-danger">', '</div>'); ?> 
                                </div>
                            </div>
                            <!------- end : input group ------> 

                            <!------- start : text area group ------>
                            <div class="form-group">
                                <label for="message" class="col-sm-3 col-md-2 control-label">Message</label>
                                <div class="col-sm-9 col-md-10">
                                    <textarea class="form-control" name="message" id="input-description"><?php echo $message; ?></textarea>
                                </div>
                            </div>
                            <!------- End : text area group ------> 
                            </form>
                        </div>
                                        
                    </div>        
                </div>         
            </div>
           
        
    </section>
    <!----------------------- Main content ------------------------------->
</div>

<!-- ----------------------------- Model ---------------- -->
<div class="modal fade" id="colored-header" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
        <h4 class="modal-title" style="color:#FFF;"><strong>Send</strong> Test Email</h4>
      </div>
      <form action="<?=base_url('system/email_template/send_test_email/'.$this->commons->encode($template_id))?>" role="form"  method="post">
      <div class="modal-body">
        <div class="row m-t-30">
              <div class="col-md-12">
                <div class="form-group">
                  <input required="required" type="email" class="form-control floating-label autosize" placeholder="Email Address" name="EmailId" />
                </div>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <input type="submit" name="submit" value="Send Test Email" class="btn btn-primary btn-square">
      </div>
      </form>
    </div>
  </div>
</div>

<!-- --------------------------- End Model-------------- -->
<!------------------- End content-wrapper ----------------------------> 


<script type="text/javascript" src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js"></script> 
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/js/common.js"></script>

<script>/*$("textarea").tagsinput('items')*/</script> 
<script type="text/javascript">
    //Initializa Summernote
    $('#input-description').summernote({height: 300});
    
    var baseurl = "<?php print base_url(); ?>";

    //Initialize Select2 Elements
    $(".select2").select2();
    
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });


    var elem = '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
    $('[data-toggle="popover"]').popover({animation: true, content: elem, html: true});


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