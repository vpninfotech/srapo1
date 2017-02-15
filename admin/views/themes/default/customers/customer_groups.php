<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/all.css">
<!-- iCheck 1.0.1 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/icheck.min.js"></script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
      <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="form-customer-group" id="form-customer-group"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> User Groups </h1>
        <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
          
         
        <button class="btn btn-primary" type="submit" value="save" name="customer_group_save" form="form-customer-group" title="Save"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" class="btn btn-default" title="Back"><i class="fa fa-reply"></i></a>
      </div>
    </section>
    <!------------------ End Content Header (Page header) ---------------------> 
    <!-------------------------- Main content ------------------------------- -->
    <section class="content">
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
            <input type="hidden" name="customer_group_id" value="<?php echo $customer_group_id; ?>" />
          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h2>
              
            </div>
            <div class="box-body"> 
            
              
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('group_name')!==""){echo "has-error";} ?>">
                <label for="group_name" class="col-sm-3 col-md-2 control-label">Customer Group Name</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="group_name" id="customer_group_name" class="form-control" placeholder="Customer Group Name" value="<?php echo $group_name; ?>">
                    <?php echo form_error('group_name','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group">
                <label for="description" class="col-sm-3 col-md-2 control-label">Description</label>
                <div class="col-sm-9 col-md-10">
                    <textarea class="form-control" name="group_description" id="description" rows="5" placeholder="Description"><?php echo $group_description; ?></textarea>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group">
                  <label for="description" class="col-sm-3 col-md-2 control-label">
                      <span data-toggle="tooltip" title="" data-original-title="Customers must be approved by an administrator before they can login.">Approve New Customers</span>
                  </label>
                <div class="col-sm-9 col-md-10">
                    <label class="radio-inline">
                        <?php if ($approve_customer) { ?>
                        <input type="radio" name="approve_customer" value="1" checked="checked" />
                        &nbsp;&nbsp;Yes&nbsp;&nbsp;
                        <?php } else { ?>
                        <input type="radio" name="approve_customer" value="1" />
                        &nbsp;&nbsp;Yes&nbsp;&nbsp;
                        <?php } ?>
                    </label>
                    <label class="radio-inline">
                        <?php if (!$approve_customer) { ?>
                        <input type="radio" name="approve_customer" value="0" checked="checked" />
                        &nbsp;&nbsp;No&nbsp;&nbsp;
                        <?php } else { ?>
                        <input type="radio" name="approve_customer" value="0" />
                        &nbsp;&nbsp;No&nbsp;&nbsp;
                        <?php } ?>
                    </label>
                  
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group">
                <label for="sort_order" class="col-sm-3 col-md-2 control-label">Sort Order</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="sort_order" id="sort_order" class="form-control" placeholder="Sort Order" value="<?php echo $sort_order; ?>">
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
    </section>
     </form> 

    <!----------------------- Main content -------------------------------> 
  </div>
  <!------------------- End content-wrapper ---------------------------->
<script type="text/javascript">
    
        //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
</script>


