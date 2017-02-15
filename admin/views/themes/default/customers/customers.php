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
        <h1> Customers </h1>
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
        </ul>
        <div class="pull-right">
            <button class="btn btn-primary" type="submit" value="save" name="customers_save" form="form_customers"><i class="fa fa-save"></i></button>
            <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
        </div>
    </section>
    <!------------------ End Content Header (Page header) ---------------------> 
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
                        <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i><?php echo $text_form ?></h2>

                    </div>
                    <div class="box-body"> 
                        <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="customers_form" id="form_customers">
                            <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" /> 
                            <div class="tab-content">
                                <div id="tab-general">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <ul class="nav nav-pills nav-stacked" id="address">
                                                <li class="active"><a href="#tab-customer" data-toggle="tab">General</a></li>
                                                <?php $address_row = 1; ?>
                                                <?php foreach ($addresses as $address) { ?>
                                                <li><a href="#tab-address<?php echo $address_row; ?>" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$('#address a:first').tab('show'); $('#address a[href=\'#tab-address<?php echo $address_row; ?>\']').parent().remove(); $('#tab-address<?php echo $address_row; ?>').remove();"></i><?php echo "Address" . ' ' . $address_row; ?></a></li>
                                                <?php $address_row++; ?>
                                                <?php } ?>
                                                <li id="address-add"><a onclick="addAddress();"><i class="fa fa-plus-circle"></i> Add Address</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab-customer">
                                                    <!-- Start : input Group -->
                                                    <div class="form-group">
                                                        <label for="group_id" class="col-sm-3 col-md-2 control-label">Customer Group</label>
                                                        <div class="col-sm-9 col-md-10">
                                                            <select name="group_id" id="group_id" class="form-control">
                                                                <!--<option value="*">  </option> --> 
                                                                <?php if (isset($customer_group)) { ?>
                                                                    <?php foreach ($customer_group as $row) {
                                                                        ?>
                                                                        <option value="<?php echo $row['customer_group_id']; ?>" <?php
                                                                        if ($row['customer_group_id'] == $group_id) {
                                                                            echo "selected";
                                                                        }
                                                                        ?>><?php echo $row['group_name']; ?> </option>
                                                                            <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- End : input Group -->   
                                                    <!-- Start : input Group -->
                                                    <div class="form-group required <?php
                                                    if (form_error('first_name') !== "") {
                                                        echo "has-error";
                                                    }
                                                    ?>">
                                                        <label for="first_name" class="col-sm-3 col-md-2 control-label">First Name</label>
                                                        <div class="col-sm-9 col-md-10">
                                                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="<?php echo $firstname; ?>">
<?php echo form_error('first_name', '<div class="text-danger">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <!-- End : input Group -->

                                                    <!-- Start : input Group -->
                                                    <div class="form-group required <?php
                                                    if (form_error('middlename') !== "") {
                                                        echo "has-error";
                                                    }
                                                    ?>">
                                                        <label for="middlename" class="col-sm-3 col-md-2 control-label">Middle Name</label>
                                                        <div class="col-sm-9 col-md-10">
                                                            <input type="text" name="middlename" id="middlename" class="form-control" placeholder="Middle Name" value="<?php echo $middlename; ?>">
<?php echo form_error('middlename', '<div class="text-danger">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <!-- End : input Group -->

                                                    <!------- start : input group ------>
                                                    <div class="form-group required <?php
                                                    if (form_error('last_name') !== "") {
                                                        echo "has-error";
                                                    }
                                                    ?>">
                                                        <label for="last_name" class="col-sm-3 col-md-2 control-label">Last Name</label>
                                                        <div class="col-sm-9 col-md-10">
                                                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="<?php echo $lastname; ?>">
<?php echo form_error('last_name', '<div class="text-danger">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <!------- End : input group ------>

                                                    <!------- start : input group ------>
                                                    <div class="form-group required  <?php
                                                    if (form_error('gender') !== "") {
                                                        echo "has-error";
                                                    }
                                                    ?>">
                                                        <label class="col-sm-3 col-md-2 control-label" for="gender">Gender</label>
                                                        <div class="col-sm-9 col-md-10">
                                                            <select name="gender" id="gender" class="form-control" value="<?php echo $gender; ?>">
                                                                <option value=""> Select </option>
                                                                <option value="1"> Male </option>
                                                                <option value="0"> Female </option>  
                                                            </select>
                                                            <script>
                                                                $("#gender").val(<?= isset($gender) ? $gender : '' ?>);

                                                            </script> 

<?php echo form_error('gender', '<div class="text-danger">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <!------- End : input group ------>

                                                    <!------- start : input group ------>
                                                    <div class="form-group required <?php
                                                    if (form_error('email') !== "") {
                                                        echo "has-error";
                                                    }
                                                    ?>">
                                                        <label for="email" class="col-sm-3 col-md-2 control-label">Email</label>
                                                        <div class="col-sm-9 col-md-10">
                                                            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>">
<?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <!------- end : input group ------>

                                                    <!-- Start : Date Picker Group -->
                                                    <div class="form-group">
                                                        <label for="dob" class="col-sm-3 col-md-2 control-label">Date Of Birth</label>
                                                        <div class="col-sm-3">
                                                            <div class="input-group date">
                                                                <input id="date_added" name="dob" placeholder="Date Of Birth" class="form-control pull-right" type="text" value="<?php echo $dob; ?>">
                                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!------ End : Date Picker Group ------>

                                                    <!------- start : input group ------>
                                                    <div class="form-group required <?php
                                                    if (form_error('telephone') !== "") {
                                                        echo "has-error";
                                                    }
                                                    ?>">
                                                        <label for="telephone" class="col-sm-3 col-md-2 control-label">Telephone</label>
                                                        <div class="col-sm-9 col-md-10">
                                                            <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Telephone" value="<?php echo $telephone; ?>" autocomplete="off">
<?php echo form_error('telephone', '<div class="text-danger">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <!------- end : input group ------>

                                                    <!------- start : input group ------>
                                                    <div class="form-group required <?php
                                                    if (form_error('password') !== "") {
                                                        echo "has-error";
                                                    }
                                                    ?>">
                                                        <label for="password" class="col-sm-3 col-md-2 control-label">Password</label>
                                                        <div class="col-sm-9 col-md-10">
                                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>">
<?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <!------- end : input group ------>

                                                    <!------- start : input group ------>
                                                    <div class="form-group required <?php
                                                    if (form_error('c_password') !== "") {
                                                        echo "has-error";
                                                    }
                                                    ?>">
                                                        <label for="c_password" class="col-sm-3 col-md-2 control-label">Confirm Password</label>
                                                        <div class="col-sm-9 col-md-10">
                                                            <input type="password" class="form-control" name="c_password" id="c_password" placeholder="Confirm Password" value="<?php echo $c_password; ?>">
<?php echo form_error('c_password', '<div class="text-danger">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <!------- end : input group ------>

                                                    <!------- start : Select group ------>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 col-md-2 control-label" for="user_status">Newsletter</label>
                                                        <div class="col-sm-9 col-md-10">
                                                            <input type="checkbox" name="newsletter" onclick="checkNewsletter(this)" id="newsletter" value="<?php echo $newsletter; ?>" <?php if ($newsletter == 1) echo 'checked'; ?> />                 
                                                            <script type="text/javascript">
                                                                function checkNewsletter(checkbox)
                                                                {
                                                                    if (checkbox.checked)
                                                                    {
                                                                        $("#newsletter").val("1");
                                                                    }
                                                                    else
                                                                    {
                                                                        $("#newsletter").val("0");
                                                                    }
                                                                }
                                                            </script>
                                                        </div>
                                                    </div>
                                                    <!------- End : Select group ------>

                                                    <!------- start : Select group ------>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 col-md-2 control-label" for="user_status">Status</label>
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
                                                                $("#status").val(<?= isset($status) ? $status : '' ?>);
                                                            </script> 
                                                        </div>
                                                    </div>
                                                    <!------- End : Select group ------>

                                                    <!------- start : Select group ------>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 col-md-2 control-label" for="approve">Approve</label>
                                                        <div class="col-sm-9 col-md-10">
                                                            <select name="approve" id="approve" class="form-control">
<?php if ($approve) { ?>
                                                                    <option value="0">No</option>
                                                                    <option value="1" selected="selected">Yes</option>
<?php } else { ?>
                                                                    <option value="0" selected="selected">No</option>
                                                                    <option value="1">Yes</option>
<?php } ?>
                                                            </select>
                                                            <script>
                                                                $("#status").val(<?= isset($status) ? $status : '' ?>);
                                                            </script> 
                                                        </div>
                                                    </div>
                                                    <!------- End : Select group ------>
<?php if ($this->session->userdata('role_id') == 1) { ?>
                                                        <!------- start : Select group ------>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 col-md-2 control-label" for="user_status">Soft Deleted</label>
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
                                                </div>
                                                <?php $address_row = 1; ?>
                                                <?php foreach ($addresses as $address) { ?>
                                                
                                                <div class="tab-pane" id="tab-address<?php echo $address_row; ?>">
                                                    <input type="hidden" name="address[<?php echo $address_row; ?>][address_id]" value="<?php echo $address['address_id']; ?>" />
                                                    
                                                    <div class="form-group required <?php if(form_error('address['.$address_row.'][firstname]') !== "") { echo "has-error"; } ?>">
                                                        <label class="col-sm-2 control-label" for="input-firstname<?php echo $address_row; ?>">First Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="address[<?php echo $address_row; ?>][firstname]" value="<?php echo $address['firstname']; ?>" placeholder="First Name" id="input-firstname<?php echo $address_row; ?>" class="form-control" />
                                                            <?php echo form_error('address['.$address_row.'][firstname]', '<div class="text-danger">', '</div>'); ?>
                
                                                        </div>
                                                    </div>

                                                    <div class="form-group required <?php if(form_error('address['.$address_row.'][lastname]') !== "") { echo "has-error"; } ?>">
                                                        <label class="col-sm-2 control-label" for="input-lastname<?php echo $address_row; ?>">Last Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="address[<?php echo $address_row; ?>][lastname]" value="<?php echo $address['lastname']; ?>" placeholder="Last Name" id="input-lastname<?php echo $address_row; ?>" class="form-control" />
                                                            <?php echo form_error('address['.$address_row.'][lastname]', '<div class="text-danger">', '</div>'); ?>
                
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="input-company<?php echo $address_row; ?>">Company</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="address[<?php echo $address_row; ?>][company]" value="<?php echo $address['company']; ?>" placeholder="Company" id="input-company<?php echo $address_row; ?>" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group required <?php if(form_error('address['.$address_row.'][address_1]') !== "") { echo "has-error"; } ?>">
                                                        <label class="col-sm-2 control-label" for="input-address-1<?php echo $address_row; ?>">Address 1</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="address[<?php echo $address_row; ?>][address_1]" value="<?php echo $address['address_1']; ?>" placeholder="Address 1" id="input-address-1<?php echo $address_row; ?>" class="form-control" />
                                                            <?php echo form_error('address['.$address_row.'][address_1]', '<div class="text-danger">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="input-address-2<?php echo $address_row; ?>">Address 2</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="address[<?php echo $address_row; ?>][address_2]" value="<?php echo $address['address_2']; ?>" placeholder="Address 2" id="input-address-2<?php echo $address_row; ?>" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group required <?php if(form_error('address['.$address_row.'][city]') !== "") { echo "has-error"; } ?>">
                                                        <label class="col-sm-2 control-label" for="input-city<?php echo $address_row; ?>">City</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="address[<?php echo $address_row; ?>][city]" value="<?php echo $address['city']; ?>" placeholder="City" id="input-city<?php echo $address_row; ?>" class="form-control" />
                                                             <?php echo form_error('address['.$address_row.'][city]', '<div class="text-danger">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="input-postcode<?php echo $address_row; ?>">Postcode</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="address[<?php echo $address_row; ?>][postcode]" value="<?php echo $address['postcode']; ?>" placeholder="Postcode" id="input-postcode<?php echo $address_row; ?>" class="form-control" />
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group required <?php if(form_error('address['.$address_row.'][country_id]') !== "") { echo "has-error"; } ?>">
                                                        <label class="col-sm-2 control-label" for="input-country<?php echo $address_row; ?>">Country</label>
                                                        <div class="col-sm-10">
                                                            <select name="address[<?php echo $address_row; ?>][country_id]" id="input-country<?php echo $address_row; ?>" onchange="country(this, '<?php echo $address_row; ?>', '<?php echo $address['state_id']; ?>');"  class="form-control">';
                                                                <option value=""> --- Please Select --- </option>
                                                                <?php foreach($countries as $country) { ?>
                                                                    <?php if ($country['country_id'] == $address['country_id']) { ?>
                                                                 <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo addslashes($country['country_name']); ?></option>
                                                                    <?php } else { ?>
                                                                 <option value="<?php echo $country['country_id']; ?>" ><?php echo addslashes($country['country_name']); ?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                            <?php echo form_error('address['.$address_row.'][country_id]', '<div class="text-danger">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group required <?php if(form_error('address['.$address_row.'][state_id]') !== "") { echo "has-error"; } ?>">
                                                        <label class="col-sm-2 control-label" for="input-zone<?php echo $address_row; ?>">Region/State</label>
                                                        <div class="col-sm-10">
                                                            <select name="address[<?php echo $address_row; ?>][state_id]" id="input-zone<?php echo $address_row; ?>" class="form-control">
                                                            </select>
                                                            <?php echo form_error('address['.$address_row.'][state_id]', '<div class="text-danger">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Default Address</label>
                                                        <div class="col-sm-10">
                                                            <label class="radio">
                                                                <?php if (($address['address_id'] == $address_id) || !$addresses) { ?>
                                                                    <input type="radio" name="address[<?php echo $address_row; ?>][default]" value="<?php echo $address_row; ?>" checked="checked" />
                                                                <?php } else { ?>
                                                                    <input type="radio" name="address[<?php echo $address_row; ?>][default]" value="<?php echo $address_row; ?>" />
                <?php } ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $address_row++; ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End : box-body -->
            </div>
        </div>
    </section>
    <!----------------------- Main content -------------------------------> 
</div>
<!------------------- End content-wrapper ---------------------------->

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

    //Datepicker
    $('#date_added').datepicker({
        todayHighlight:true,
        autoclose: true,
        format: "yyyy-mm-dd",
    });
</script>
<script>

    var address_row = <?php echo $address_row; ?>;

    function addAddress() {

        html = '<div class="tab-pane" id="tab-address' + address_row + '">';
        html += '  <input type="hidden" name="address[' + address_row + '][address_id]" value="" />';

        html += '  <div class="form-group required">';
        html += '    <label class="col-sm-2 control-label" for="input-firstname' + address_row + '">First Name</label>';
        html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][firstname]" value="" placeholder="First Name" id="input-firstname' + address_row + '" class="form-control" /></div>';
        html += '  </div>';

        html += '  <div class="form-group required">';
        html += '    <label class="col-sm-2 control-label" for="input-lastname' + address_row + '">Last Name</label>';
        html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][lastname]" value="" placeholder="Last Name" id="input-lastname' + address_row + '" class="form-control" /></div>';
        html += '  </div>';

        html += '  <div class="form-group">';
        html += '    <label class="col-sm-2 control-label" for="input-company' + address_row + '">Company</label>';
        html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][company]" value="" placeholder="Company" id="input-company' + address_row + '" class="form-control" /></div>';
        html += '  </div>';

        html += '  <div class="form-group required">';
        html += '    <label class="col-sm-2 control-label" for="input-address-1' + address_row + '">Address 1</label>';
        html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][address_1]" value="" placeholder="Address 1" id="input-address-1' + address_row + '" class="form-control" /></div>';
        html += '  </div>';

        html += '  <div class="form-group">';
        html += '    <label class="col-sm-2 control-label" for="input-address-2' + address_row + '">Address 2</label>';
        html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][address_2]" value="" placeholder="Address 2" id="input-address-2' + address_row + '" class="form-control" /></div>';
        html += '  </div>';

        html += '  <div class="form-group required">';
        html += '    <label class="col-sm-2 control-label" for="input-city' + address_row + '">City</label>';
        html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][city]" value="" placeholder="City" id="input-city' + address_row + '" class="form-control" /></div>';
        html += '  </div>';


        html += '  <div class="form-group ">';
        html += '    <label class="col-sm-2 control-label" for="input-postcode' + address_row + '">Postcode</label>';
        html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][postcode]" value="" placeholder="Postcode" id="input-postcode' + address_row + '" class="form-control" /></div>';
        html += '  </div>';

        html += '  <div class="form-group required">';
        html += '    <label class="col-sm-2 control-label" for="input-country' + address_row + '">Country</label>';
        html += '    <div class="col-sm-10"><select name="address[' + address_row + '][country_id]" id="input-country[' + address_row + '][country_id]" onchange="country(this, \'' + address_row + '\', \'0\');" class="form-control">';
        html += '         <option value=""> --- Please Select --- </option>';
        <?php foreach($countries as $country) { ?>
        html += '         <option value="<?php echo $country['country_id']; ?>"><?php echo addslashes($country['country_name']); ?></option>';
        <?php } ?>
        html += '      </select></div>';
        html += '  </div>';

        html += '  <div class="form-group required">';
        html += '    <label class="col-sm-2 control-label" for="input-zone' + address_row + '">Region / State</label>';
        html += '    <div class="col-sm-10"><select name="address[' + address_row + '][state_id]" id="input-zone' + address_row + '" class="form-control"><option value=""> --- None --- </option></select></div>';
        html += '  </div>';

        // Custom Fields

        html += '  <div class="form-group">';
        html += '    <label class="col-sm-2 control-label">Default Address</label>';
        html += '    <div class="col-sm-10"><label class="radio"><input type="radio" name="address[' + address_row + '][default]" value="1" /></label></div>';
        html += '  </div>';

        html += '</div>';

        $('#tab-general .tab-content').append(html);
        $('select[name=\'customer_group_id\']').trigger('change');

        $('select[name=\'address[' + address_row + '][country_id]\']').trigger('change');

        $('#address-add').before('<li><a href="#tab-address' + address_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'#address a:first\').tab(\'show\'); $(\'a[href=\\\'#tab-address' + address_row + '\\\']\').parent().remove(); $(\'#tab-address' + address_row + '\').remove();"></i> Address ' + address_row + '</a></li>');

        $('#address a[href=\'#tab-address' + address_row + '\']').tab('show');


        $('#tab-address' + address_row + ' .form-group[data-sort]').detach().each(function () {
            if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#tab-address' + address_row + ' .form-group').length) {
                $('#tab-address' + address_row + ' .form-group').eq($(this).attr('data-sort')).before(this);
            }

            if ($(this).attr('data-sort') > $('#tab-address' + address_row + ' .form-group').length) {
                $('#tab-address' + address_row + ' .form-group:last').after(this);
            }

            if ($(this).attr('data-sort') < -$('#tab-address' + address_row + ' .form-group').length) {
                $('#tab-address' + address_row + ' .form-group:first').before(this);
            }
        });
        address_row++;
    }
</script>

<script type="text/javascript">
function country(element, index, state_id) {
//alert(element.value);
//alert(index);
//alert(state_id);
    $.ajax({
       url:"<?php echo base_url('system/country/get_zone_by_country_id') ?>",
       dataType:'json',
                type:'post',
                data:{'country_id': element.value},
        beforeSend: function() {
            $('select[name=\'address[' + index + '][country_id]\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
        },
        complete: function() {
            $('.fa-spin').remove();
        },
        success: function(json) {
            html = '<option value=""> ---Please Select--- </option>';
            
            if (json['zone'] && json['zone'] != '') {
                for (i = 0; i < json['zone'].length; i++) {
                    html += '<option value="' + json['zone'][i]['state_id'] + '"';

                    if (json['zone'][i]['state_id'] == state_id) {
                        html += ' selected="selected"';
                    }

                    html += '>' + json['zone'][i]['state_name'] + '</option>';
                }
            } else {
                    html += '<option value="0"> ---None--- </option>';
            }
            $('select[name=\'address[' + index + '][state_id]\']').html(html);
        }
    });
}
$('select[name$=\'[country_id]\']').trigger('change');
</script>