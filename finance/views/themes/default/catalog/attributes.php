 <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
  <!-- Select2 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
 
   <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="attributes_form" id="form-attributes">
    <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('Dtoken'); ?>" />
    <input type="hidden" name="attribute_id" id="attribute_id" value="<?php echo $attribute_id; ?>" />
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Attributes </h1>
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
        <!--<form class="form-horizontal" name="attributes_form" action="<?php echo $form_action;?>" method="post">-->
          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h2>
            </div>
            <div class="box-body"> 
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('attribute_name')!==""){echo "has-error";} ?>">
                <label for="attribute_name" class="col-sm-3 col-md-2 control-label">Attribute Name</label>
                <div class="col-sm-9 col-md-10">
                <div class="input-group">
                  <span class="input-group-addon"><img title="English" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/gb.png">
                  </span>
                  <input type="text" name="attribute_name" id="attribute_name" class="form-control" placeholder="Attribute Name" value="<?php echo $attribute_name; ?>">
                </div>
                <?php echo form_error('attribute_name','<div class="text-danger">', '</div>'); ?>
                
                </div>
              </div>
              <!-- End : input Group -->
              
              <!------- start : input group ------>
              <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label" for="attribute_group">Attribute Group</label>
                  <div class="col-sm-9 col-md-10">                 
                    <select name="attribute_group_id" id="attribute_group_id" class="form-control">
                    <?php 
					foreach($get_attribute_group_name as $attribute_group_name)
					{
					?>
                      <option value="<?php echo $attribute_group_name['attribute_group_id']; ?>"> <?php echo $attribute_group_name['attribute_group_name']; ?> </option>
                    <?php
					}
					?>
                    </select>
                    <script>
					  $("#attribute_group_id").val(<?=isset($attribute_group_id)?$attribute_group_id:''?>);
					</script> 
                  </div>
              </div>
              <!------- End : input group ------>
              
              <!-- Start : input Group -->
              <div class="form-group">
                <label for="sort_order" class="col-sm-3 col-md-2 control-label">Sort Order</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="sort_order" id="sort_order" class="form-control" placeholder="Sort Order" value="<?php echo $sort_order; ?>">
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
              
              <?php if($this->session->userdata('Drole_id')== 1) { ?>
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
	//Initialize Select2 Elements
    $(".select2").select2();
    
</script>


