<link href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- Select2 -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
<!-- Select2 -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/iCheck/all.css">
<!-- iCheck 1.0.1 -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/iCheck/icheck.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Gift Voucher </h1>
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
        </ul>
        <div class="pull-right">
            <?php if ($this->uri->segment(3) == 'edit') { ?>
                <button type="button" id="button-send" data-toggle="tooltip" title="Send" class="btn btn-primary"><i class="fa fa-envelope"></i></button>
            <?php } ?>
            <button class="btn btn-primary" type="submit" value="save" name="gift_vouchers_save" form="form_gift_vouchers"><i class="fa fa-save"></i></button>
            <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
        </div>
    </section>
    <!------------------ End Content Header (Page header) ---------------------> 
    <!-------------------------- Main content ------------------------------- -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12" id="emailStatus">
                <?php if (isset($error) && $error !== ""): ?>

                    <div class="alert alert-danger alert-bold-border">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>

                        <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error; ?>

                    </div>

                <?php endif; ?>
                <?php if (isset($success) && $success !== ""): ?>

                    <div class="alert alert-success alert-bold-border">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>

                        <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success; ?>

                    </div>

                <?php endif; ?>
            </div>
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header">
                        <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i><?php echo $text_form ?></h2>

                    </div>
                    <div class="box-body"> 
                        <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="gift_vouchers_form" id="form_gift_vouchers">
                            <input type="hidden" name="voucher_id" value="<?php echo $voucher_id; ?>" /> 


                            <!-- Start : input Group -->
                            <div class="form-group required <?php if (form_error('code') !== "") {
                    echo "has-error";
                } ?>">
                                <label for="code" class="col-sm-3 col-md-2 control-label">Code</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="code" id="code" class="form-control" placeholder="Code" value="<?php echo $code; ?>">
<?php echo form_error('code', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                            <!-- End : input Group -->
                            <!-- Start : input Group -->
                            <div class="form-group required <?php if (form_error('from_name') !== "") {
    echo "has-error";
} ?>">
                                <label for="from_name" class="col-sm-3 col-md-2 control-label">From Name</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="from_name" id="from_name" class="form-control" placeholder="From Name" value="<?php echo $from_name; ?>">
<?php echo form_error('from_name', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                            <!-- End : input Group -->
                            <!-- Start : input Group -->
                            <div class="form-group required <?php if (form_error('from_email') !== "") {
    echo "has-error";
} ?>">
                                <label for="from_email" class="col-sm-3 col-md-2 control-label">From E-mail</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="from_email" id="from_email" class="form-control" placeholder="From Email" value="<?php echo $from_email; ?>">
<?php echo form_error('from_email', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                            <!-- End : input Group -->
                            <!-- Start : input Group -->
                            <div class="form-group required <?php if (form_error('to_name') !== "") {
    echo "has-error";
} ?>">
                                <label for="to_name" class="col-sm-3 col-md-2 control-label">To Name</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="to_name" id="to_name" class="form-control" placeholder="To Name" value="<?php echo $to_name; ?>">
                                    <?php echo form_error('to_name', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                            <!-- End : input Group -->
                            <!-- Start : input Group -->
                            <div class="form-group required <?php if (form_error('to_email') !== "") {
                                        echo "has-error";
                                    } ?>">
                                <label for="to_email" class="col-sm-3 col-md-2 control-label">To E-mail</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="to_email" id="to_email" class="form-control" placeholder="To Email" value="<?php echo $to_email; ?>">
                                        <?php echo form_error('to_email', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                            <!-- End : input Group -->
                            <!------- start : input group ------>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-2 control-label" for="voucher_theme_id">Themes</label>
                                <div class="col-sm-9 col-md-10">
                                    <select name="voucher_theme_id" id="voucher_theme_id" class="form-control">

<?php foreach ($voucher_theme as $voucher_theme) { ?>
    <?php if ($voucher_theme['voucher_theme_id'] == $voucher_theme_id) { ?>
                                                <option value="<?php echo $voucher_theme['voucher_theme_id']; ?>" selected="selected"><?php echo $voucher_theme['name']; ?></option>

    <?php } else { ?>
                                                <option value="<?php echo $voucher_theme['voucher_theme_id']; ?>"><?php echo $voucher_theme['name']; ?></option>

    <?php } ?>
<?php } ?>


                                    </select>

                                </div>
                            </div>
                            <!------- End : input group ------> 
                            <!-- Start : input Group -->
                            <div class="form-group required <?php if (form_error('message') !== "") {
    echo "has-error";
} ?>">
                                <label for="message" class="col-sm-3 col-md-2 control-label">Message</label>
                                <div class="col-sm-9 col-md-10">
                                    <textarea name="message" id="message" class="form-control" rows="4" placeholder="Message" ><?php echo $message; ?></textarea>
<?php echo form_error('message', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                            <!-- End : input Group -->
                            <!-- Start : input Group -->
                            <div class="form-group  required <?php if (form_error('amount') !== "") {
    echo "has-error";
} ?>">
                                <label for="amount" class="col-sm-3 col-md-2 control-label">Amount</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount" value="<?php echo $amount; ?>">
<?php echo form_error('amount', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                            <!-- End : input Group -->
                            <!------- start : Select group ------>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-2 control-label" for="status">Status</label>
                                <div class="col-sm-9 col-md-10">
                                    <select name="status" id="status" class="form-control">
                                        <option value="1"> Enabled </option>
                                        <option value="0"> Disabled </option>
                                    </select>
                                    <script>
                                        $("#status").val(<?= isset($status) ? $status : '' ?>);
                                    </script> 
                                </div>
                            </div>
                            <!------- End : Select group ------>


                            <!------- End : Select group ------>
<?php if ($this->session->userdata('role_id') == 1) { ?>
                                <!------- start : Select group ------>
                                <div class="form-group">
                                    <label class="col-sm-3 col-md-2 control-label" for="is_deleted">Soft Deleted</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="checkbox" name="is_deleted" onclick="checkAddress(this)" id="is_deleted" value="<?php echo $is_deleted; ?>" <?php if ($is_deleted == 1) echo 'checked'; ?> />

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
<script type="text/javascript">
    $('#button-send').on('click', function () {
        $.ajax({
            url: "<?php echo base_url('sales/gift_vouchers/send/') ?>",
            type: 'post',
            dataType: 'json',
            data: 'voucher_id=<?php echo $voucher_id; ?>',
            beforeSend: function () {
                $('#button-send i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                $('#button-send').prop('disabled', true);
            },
            complete: function () {
                $('#button-send i').replaceWith('<i class="fa fa-envelope"></i>');
                $('#button-send').prop('disabled', false);
            },
            success: function (json) {
                $('.alert').remove();

                if (json['error']) {
                    $('#emailStatus').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                }

                if (json['success']) {
                    $('#emailStatus').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    })
</script>  
<script type="text/javascript">
    //Initializa Summernote
    $('#input-description').summernote({height: 300});

    //Initialize Select2 Elements
    $(".select2").select2();

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
    $('#date_added').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
    });
</script>
<script type="text/javascript">

    /* End : image preview script For Image-1 tab*/
    var baseurl = "<?php print base_url(); ?>";


</script> 



