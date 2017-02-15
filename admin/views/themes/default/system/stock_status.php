<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
     
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Stock Statuses </h1>
        <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
          
         
        <button class="btn btn-primary" type="submit" value="save" name="stock_status_save" form="form-stock-status" title="Save"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" class="btn btn-default" title="Back"><i class="fa fa-reply"></i></a>
      </div>
    </section>
    <!------------------ End Content Header (Page header) ---------------------> 
    <!-------------------------- Main content ------------------------------- -->
    <section class="content">
     <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="form-stock-status" id="form-stock-status"> 
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
      <div class="row">
       
        <div class="col-xs-12">
       
        
            <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
              <input type="hidden" name="stock_status_id" value="<?php echo $stock_status_id; ?>" />
          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h2>
              
            </div>
            <div class="box-body"> 
            
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('stock_status_name')!==""){echo "has-error";} ?>">
                <label for="stock_status_name" class="col-sm-3 col-md-2 control-label">Stock Status Name</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="stock_status_name" id="stock_status_name" class="form-control" placeholder="Stock Status Name" value="<?php echo $stock_status_name; ?>">
                    <?php echo form_error('stock_status_name','<div class="text-danger">', '</div>'); ?>
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
            
            </div>
            <!-- End : box-body -->
          </div>
        
             </div>
    </div>
     </form>
    </section>
     

    <!----------------------- Main content -------------------------------> 
  </div>
  <!------------------- End content-wrapper ---------------------------->
<script type="text/javascript">
	//Initialize Select2 Elements
    //$(".select2").select2();
</script>


