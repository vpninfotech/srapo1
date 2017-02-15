<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>

  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
  <!-- Select2 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
  
    <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Currencies </h1>
       <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
     <div class="pull-right">
                 <button class="btn btn-primary" type="submit" value="save" name="expense_category_save" form="form-expense_category"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
              </div>
    </section>
    <!------------------ End Content Header (Page header) ---------------------> 
    <!-------------------------- Main content ------------------------------- -->
    <section class="content">
     <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="expense_category_form" id="form-expense_category">
     <?php if(isset($error) && $error!==""): ?>
        
        <div class="alert alert-danger alert-bold-border">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
          
            <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error;?>
          
        </div>
       
        <?php endif; ?>
        <?php if(isset($success) && $success!==""): ?>
          
        <div class="alert alert-success alert-bold-border">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
          
           <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success;?>
          
        </div>
        
        <?php endif; ?>
      <div class="row">
        <div class="col-xs-12">
       
          <div class="box box-default">
            <div class="box-header">
              <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i><?php echo $text_form; ?></h2>
            </div>
            <div class="box-body"> 
              
             <div class="col-md-8">
              <input type="hidden" name="expense_category_id" value="<?php echo $expense_category_id; ?>" />
              <!-- Start : input Group -->
              <div class="form-group required <?php if(form_error('title')!==""){echo "has-error";} ?>">
                <label for="expense_category_name" class="col-sm-3 col-md-2 control-label">Expense Category Name</label>
                <div class="col-sm-9 col-md-10">
                    <input type="text" name="expense_category_name" id="expense_category_name" class="form-control" placeholder="Expense Category Name" value="<?php echo $expense_category_name; ?>">
                    <?php echo form_error('expense_category_name','<div class="text-danger">', '</div>'); ?>
                </div>
              </div>
              <!-- End : input Group -->
               <!------- start : Select group ------>
              <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label" for="status">Transaction</label>
                  <div class="col-sm-9 col-md-10">
                    <select name="transaction" id="transaction" class="form-control">
                        <option value="credit">Credit</option>
                        <option value="debit">Debit</option>
                    </select>
                    <script>
                        $("#transaction").val("<?=isset($transaction)?$transaction:''?>");
                    </script> 
                  </div>                  
              </div>
              <!------- End : Select group ------>
              
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
         </div>
         </form>
    </section>
    <!----------------------- Main content -------------------------------> 
  </div>
  <!------------------- End content-wrapper ---------------------------->
 
<script type="text/javascript">
	//Initializa Summernote
	$('#input-description').summernote({height: 300});
	
	//Initialize Select2 Elements
    $(".select2").select2();


    $('.trigger').tooltip({
      position: { my: 'center bottom' , at: 'center top-10' },
      tooltipClass: "myclass",
      disabled: true,
      close: function( event, ui ) { 
          $(this).tooltip('disable'); 
          /* instead of $(this) you could also use $(event.target) */
      }
    });

$('.trigger').on('click', function () {
     $(this).tooltip('enable').tooltip('open');
});
</script>