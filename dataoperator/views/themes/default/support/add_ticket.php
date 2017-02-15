<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 

   <!-- Start :Page header -->
   <section class="content-header">
      <h1> <?php echo $text_form; ?> </h1>
      <ul class="breadcrumb">
         <?php foreach ($breadcrumbs as $breadcrumb) { ?>
         <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
         <?php } ?>
      </ul>
      
      <div class="pull-right">
         <button class="btn btn-primary" type="submit" value="save" name="add_tickets_save" form="form-add_tickets" id="add-ticket"><i class="fa fa-save"></i></button>
         <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a> 
      </div>
   </section>
    <!-- End :Page header -->
    
   <section class="content">
      <?php if(isset($error) && $error!==""): ?>
      <div class="alert alert-danger alert-bold-border">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
         <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error;?> </div>
      <?php endif; ?>
      <?php if(isset($success) && $success!==""): ?>
      <div class="alert alert-success alert-bold-border">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
         <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success;?> </div>
      <?php endif; ?>
      <div class="row">
         <div class="col-xs-12">
            <div class="box box-default">
               <div class="box-header">
                  <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i><?php echo $text_form; ?></h2>
               </div>
               <div class="box-body">
                  <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo $form_action; ?>" method="post" name="return_add_tickets" id="form-add_tickets">
                     
                     <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
                     <input type="hidden" name="ticket_id" id="ticket_id" value="<?php if(!empty($ticket_id)){ echo $ticket_id; } ?>" />
                     <div class="form-group">
                        <label class="col-sm-3 col-md-2 control-label">Title :</label>
                        <div class="col-sm-9 col-md-10">
                           <input type="text" name="Title" class="form-control" value="<?php echo $Title; ?>">
                           <?php echo form_error('Title','<div class="text-danger">', '</div>'); ?> </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-3 col-md-2 control-label">Serverity :</label>
                        <div class="col-sm-9 col-md-10">
                           <select class="selectpicker form-control" name="Priority">
                              <option value="High" <?php if($Priority == "High") {?> selected="selected" <?php }?>>High</option>
                              <option value="Medium" <?php if($Priority == "Medium") {?> selected="selected" <?php }?>>Medium</option>
                              <option value="Low" <?php if($Priority == "Low") {?> selected="selected" <?php }?>>Low</option>
                           </select>
                           <?php //echo form_error('Priority','<div class="text-danger">', '</div>'); ?>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-3 col-md-2 control-label">Description :</label>
                        <div class="col-sm-9 col-md-10">
                           <textarea name="Description" class="form-control"><?php if(isset($Description)){echo $Description;} ?>
</textarea>
                        </div>
                     </div>
                     <div class="form-group myclass">
                        <label for="fileInput1" class="col-sm-3 col-md-2 control-label">Attachment</label>
                        <div class="col-sm-9 col-md-10">
                           <input type="file" id="fileInput1" name="Attachments" class="filestyle img-select-data ">
                           <br/>
                           <label class="text-muted">Only 5 MB File Size are Allowed </label>
                        </div>
                     </div>
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

jQuery.validator.addMethod('filesize123', function(value, element, param) {
    // param = size (en bytes) 
    // element = element to validate (<input>)
    // value = value of the element (file name)
    return false; 
});
jQuery.validator.addMethod(
    "MaxSize",
    function(value, element) {

        console.log("file="+value);
        if(value)
        {
            var size = element.files[0].size;
           if (size > 5242880)// checks the file more than 1 MB
           {
                return false;
           } else {
               return true;
           }   
        }
        else
        {
            return true;
        }
        
    },
    "Please upload less than 5 MB file."
);
</script>