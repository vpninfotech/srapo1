<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
  <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="attributes_groups_form" id="form-attributes_groups">
    <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
    <input type="hidden" name="attribute_group_id" id="attribute_group_id" value="<?php echo $attribute_group_id; ?>" />
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Attribute Groups </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
        <button class="btn btn-primary" type="submit" name="attributes_save" value="save"><i class="fa fa-save"></i></button>
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
        <form class="form-horizontal" name="attributes_form" action="<?php echo $form_action;?>" method="post">
          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h2>
              
            </div>
            <div class="box-body"> 
           
            
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('attribute_group_name')!==""){echo "has-error";} ?>">
                <label for="attribute_group_name" class="col-sm-3 col-md-2 control-label">Attribute Group Name</label>
                <div class="col-sm-9 col-md-10">
                <div class="input-group">
                  <span class="input-group-addon"><img title="English" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/gb.png"></span>
                  <input type="text" name="attribute_group_name" id="attribute_group_name" class="form-control" placeholder="Attribute Group Name" value="<?php echo $attribute_group_name; ?>">
                </div>
                 <?php echo form_error('attribute_group_name','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
              <!-- Start : input Group -->
              <div class="form-group">
                <label for="sort_order" class="col-sm-3 col-md-2 control-label">Sort Order</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="sort_order" id="sort_order" class="form-control col-sm-10" placeholder="Sort Order" value="<?php echo $sort_order; ?>">
                     <?php echo form_error('sort_order','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
              
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

            
            </div>
			<!-- End : Box-body -->
          </div>
          
        </div>
        
      </div>
      
    </section>
    </form>
    <!----------------------- Main content -------------------------------> 
  </div>
  
  <!------------------- End content-wrapper ---------------------------->
  
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js"> 		</script>
<script type="text/javascript">
	//Initialize Select2 Elements
    $(".select2").select2();
</script>