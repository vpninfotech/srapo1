<link href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>

<link href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/form-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/form-editable/js/bootstrap-editable.min.js">
</script>
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/all.css">
<!-- iCheck 1.0.1 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/icheck.min.js"></script>

<!-- Select2 -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
<!-- Select2 -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="form-manufacturers" id="form-manufacturers" enctype="multipart/form-data">
        <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Manufacturers </h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                    <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
            <div class="pull-right">
                <button class="btn btn-primary" type="submit" value="save" name="manufacturers_save" form="form-manufacturers"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a> </div>
        </section>
        <!------------------ End Content Header (Page header) ------------------- --> 
        <!-------------------------- Main content ------------------------------- -->
        <section class="content">
            <div class="row">
                <?php if (isset($error) && $error !== ""): ?>
                    <div class="col-xs-12">
                        <div class="alert alert-danger alert-bold-border">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
                            <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error; ?> </div>
                    </div>
                <?php endif; ?>
                <?php if (isset($success) && $success !== ""): ?>
                    <div class="col-xs-12">
                        <div class="alert alert-success alert-bold-border">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
                            <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success; ?> </div>
                    </div>
                <?php endif; ?>
                <div class="col-xs-12">
                        <div class="box box-default">
                            <div class="box-header">
                                <h2 class="box-title col-sm-6" ><i class="fa fa-pencil"></i><?php echo $text_form ?></h2>
                            </div>
                            <div class="box-body">
                            
                              <!-- Start: Custom Tabs -->
                              <div class="nav-tabs-custom">
                               
                                  <ul id="manufactuer-tab" class="nav nav-tabs">
                                    <li class="active"><a href="#tab-manufacturer-details" data-toggle="tab">Manufacturer Details</a></li>
                                    <li><a href="#tab-address-details" data-toggle="tab">Address Details</a></li>                                    
                                  </ul>
                                  <div class="tab-content">
                                      <!-- Start : tab-pane manufacturer-details-->
                                      <div class="tab-pane active" id="tab-manufacturer-details">
                                      
                                <input type="hidden" name="manufacturer_id" value="<?php echo $manufacturer_id; ?>" />
                                <!-- Start : input Group -->
                                <div class="form-group required <?php if (form_error('firstname') !== "") { echo "has-error";} ?>">
                                    <label for="firstname" class="col-sm-3 col-md-2 control-label">First Name</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" value="<?php echo $firstname; ?>">
<?php echo form_error('firstname', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                                <!-- End : input Group --> 

                                <!-- Start : input Group -->
                                <div class="form-group required <?php if (form_error('middlename') !== "") {
    echo "has-error";
} ?>">
                                    <label for="middlename" class="col-sm-3 col-md-2 control-label">Middle Name</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="text" name="middlename" id="middlename" class="form-control" placeholder="Middle Name" value="<?php echo $middlename; ?>">
<?php echo form_error('middlename', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                                <!-- End : input Group --> 

                                <!-- Start : input Group -->
                                <div class="form-group required <?php if (form_error('lastname') !== "") {
    echo "has-error";
} ?>">
                                    <label for="lastname" class="col-sm-3 col-md-2 control-label">Last Name</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" value="<?php echo $lastname; ?>">
<?php echo form_error('lastname', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                                <!-- End : input Group --> 

                                <!-- Start : input Group -->
                                <div class="form-group required  <?php if (form_error('email') !== "") {
    echo "has-error";
} ?>">
                                    <label for="email" class="col-sm-3 col-md-2 control-label">Email</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
                                        <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                                <!-- End : input Group --> 

                                <!-- Start : input Group -->
                                <div class="form-group required <?php if (form_error('password') !== "") {
                                            echo "has-error";
                                        } ?>">
                                    <label for="password" class="col-sm-3 col-md-2 control-label">Password</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?php echo $password; ?>">
<?php echo form_error('password', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                                <!-- End : input Group --> 

                                <!------- start : input group ------>
                                <div class="form-group  <?php if (form_error('c_password') !== "") {
    echo "has-error";
} ?>">
                                    <label for="c_password" class="col-sm-3 col-md-2 control-label">Confirm Password</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="password" class="form-control" name="c_password" id="c_password" placeholder="Confirm Password" value="<?php echo $c_password; ?>">
<?php echo form_error('c_password', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                                <!------- end : input group ------> 

                                <!-- Start : input Group -->
                                <div class="form-group  <?php if (form_error('telephone') !== "") {
    echo "has-error";
} ?>">
                                    <label for="password" class="col-sm-3 col-md-2 control-label">Telephone</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="text" name="telephone" id="telephone" class="form-control" placeholder="Telephone" value="<?php echo $telephone; ?>">
<?php echo form_error('telephone', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                                <!-- End : input Group --> 

                                <!-- Start : input Group -->
                                <div class="form-group  <?php if (form_error('mobile') !== "") {
    echo "has-error";
} ?>">
                                    <label for="mobile" class="col-sm-3 col-md-2 control-label">Mobile</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="mobile" name="mobile" id="mobile" class="form-control" placeholder="Mobile" value="<?php echo $mobile; ?>">
<?php echo form_error('mobile', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                                <!-- End : input Group --> 

                                <!-- Start : input Group -->
                                <div class="form-group">
                                    <label for="gender" class="col-sm-3 col-md-2 control-label">Gender</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="radio" name="gender" value="male" <?php if ($gender == "male") {
    echo "checked";
} ?>>
                                        Male
                                        </input>
                                        <input type="radio" name="gender" value="female" <?php if ($gender == "female") {
    echo "checked";
} ?>>
                                        Female
                                        </input>
<?php echo form_error('gender', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                            
                            <!-- End : input Group --> 

                            <!-- Start : Date Picker Group -->
                            <div class="form-group">
                                <label for="dob" class="col-sm-3 col-md-2 control-label">Date of Birth</label>
                                <div class="col-sm-9 col-md-10">
                                    <div class="input-group date">
                                        <input id="dob" name="dob" placeholder="Date of Birth" class="form-control pull-right" type="text" value="<?php if ($dob !== "") {
    echo date('d-m-Y', strtotime($dob));
} ?>">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- End : Date Picker Group --> 

                            <!------- start : Select group ------>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-2 control-label" for="bank_name">Bank Name</label>
                                <div class="col-sm-9 col-md-10">
                                    <select name="bank_name" id="bank_name" name="bank_name" class="form-control" value="<?php echo $bank_name; ?>">
                                        <option value=""> --- Select --- </option>
                                                <?php
                                                foreach ($bank_list as $key => $value) {
                                                    if ($value['bank_name'] == $bank_name) {
                                                        echo "<option value='" . $value['bank_name'] . "' selected>" . $value['bank_name'] . "</option>";
                                                    } else {
                                                        echo "<option value='" . $value['bank_name'] . "'>" . $value['bank_name'] . "</option>";
                                                    }
                                                }
                                                ?>

                                    </select>
                                </div>
                            </div>
                            <!------- End : Select group ------> 

                            <!-- Start : input Group -->
                            <div class="form-group <?php if (form_error('bank_address') !== "") {
    echo "has-error";
} ?>">
                                <label for="bank_address" class="col-sm-3 col-md-2 control-label">Bank Address</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="bank_address" id="bank_address" class="form-control" placeholder="BankAddress" value="<?php echo $bank_address; ?>">
<?php echo form_error('bank_address', '<div class="text-danger">', '</div>'); ?> </div>
                            </div>
                            <!-- End : input Group --> 

                            <!-- Start : input Group -->
                            <div class="form-group <?php if (form_error('bank_ifsc_code') !== "") {
    echo "has-error";
} ?>">
                                <label for="bank_ifsc_code" class="col-sm-3 col-md-2 control-label">Bank Ifsc Code</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="bank_ifsc_code" id="bank_ifsc_code" class="form-control" placeholder="Bank Ifsc Code" value="<?php echo $bank_ifsc_code; ?>">
<?php echo form_error('bank_ifsc_code', '<div class="text-danger">', '</div>'); ?> </div>
                            </div>
                            <!-- End : input Group --> 

                            <!-- Start : input Group -->
                            <div class="form-group <?php if (form_error('account_no') !== "") {
    echo "has-error";
} ?>">
                                <label for="account_no" class="col-sm-3 col-md-2 control-label">Bank Account Number</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="account_no" id="account_no" class="form-control" placeholder="Bank Account Number" value="<?php echo $account_no; ?>">
<?php echo form_error('account_no', '<div class="text-danger">', '</div>'); ?> </div>
                            </div>
                        
                        <!-- End : input Group --> 

                        <!-- Start : input Group -->
                        <div class="form-group <?php if (form_error('account_name') !== "") {
    echo "has-error";
} ?>">
                            <label for="account_name" class="col-sm-3 col-md-2 control-label">Account Name</label>
                            <div class="col-sm-9 col-md-10">
                                <input type="text" name="account_name" id="account_name" class="form-control" placeholder="Account Name" value="<?php echo $account_name; ?>">
                            </div>
                        </div>
                        <!-- End : input Group --> 
                        <!------- start : Select group ------>
                         <div class="form-group">
                                <label class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Upload GST Document">GST:</span></label>
                                <div class="col-sm-9 col-md-10">
                                <input type="file"  name="gst" id="gst" class="filestyle"/>
                                <input type="hidden" name="H_gst" value="<?php echo $gst;?>"/>
                                <span class="help-block">Accepted formats: pdf/doc/docx. Max file size 5MB</span>
                                <?php echo form_error('gst', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                           
                            <!-- End : input Group -->
                              <!------- start : Select group ------>
                         <div class="form-group">
                                <label class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Upload GST Document">CST:</span></label>
                                <div class="col-sm-9 col-md-10">
                                <input type="file"  name="cst" id="cst" class="filestyle"/>
                                <input type="hidden" name="H_cst" value="<?php echo $cst;?>"/>
                                <span class="help-block">Accepted formats: pdf/doc/docx. Max file size 5MB</span>
                                <?php echo form_error('cst', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                            
                            <!-- End : input Group -->
                            <!------- start : Select group ------>
                         <div class="form-group">
                                <label class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Upload GST Document">Upload Pan:</span></label>
                                <div class="col-sm-9 col-md-10">
                                <input type="file"  name="upload_pancard" id="upload_pancard" class="filestyle"/>
                                <input type="hidden" name="H_upload_pancard" value="<?php echo $upload_pancard;?>"/>
                                <span class="help-block">Accepted formats: pdf/doc/docx. Max file size 5MB</span>
                                <?php echo form_error('upload_pancard', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                           
                            <!-- End : input Group -->

                             <!------- start : Select group ------>
                         <div class="form-group">
                                <label class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Upload GST Document">Upload Bank Document:</span></label>
                                <div class="col-sm-9 col-md-10">
                                <input type="file"  name="upload_bank_doc" id="upload_bank_doc" class="filestyle"/>
                                <input type="hidden" name="H_upload_bank_doc" value="<?php echo $upload_bank_doc;?>"/>
                                <span class="help-block">Accepted formats: pdf/doc/docx. Max file size 5MB</span>
                                <?php echo form_error('upload_bank_doc', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                           
                            <!-- End : input Group -->

                           
                          

                        <!-- Start : input Group -->
                        <div class="form-group  <?php if (form_error('membership_fee') !== "") {
    echo "has-error";
} ?>">
                            <label for="membership_fee" class="col-sm-3 col-md-2 control-label">Membership Fee</label>
                            <div class="col-sm-9 col-md-10">
                                <input type="text" name="membership_fee" id="membership_fee" class="form-control" placeholder="Membership Fee" value="<?php echo $membership_fee; ?>">
<?php echo form_error('membership_fee', '<div class="text-danger">', '</div>'); ?> </div>
                        </div>
                        <!-- End : input Group --> 

                        <!-- Start : input Group -->
                        <div class="form-group <?php if (form_error('wallet_balance') !== "") {
    echo "has-error";
} ?>">
                            <label for="wallet_balance" class="col-sm-3 col-md-2 control-label">Wallet_Balance</label>
                            <div class="col-sm-9 col-md-10">
                                <input type="text" name="wallet_balance" id="wallet_balance" class="form-control" placeholder="Wallet Balance " value="<?php echo $wallet_balance; ?>">
                                    <?php echo form_error('wallet_balance', '<div class="text-danger">', '</div>'); ?> </div>
                        </div>
                        <!-- End : input Group --> 

                        <!-- Start : input Group -->
                        <div class="form-group required <?php if (form_error('upload_register_no') !== "") {
                                        echo "has-error";
                                    } ?>">
                            <label for="upload_register_no" class="col-sm-3 col-md-2 control-label">Upload Register No</label>
                            <div class="col-sm-9 col-md-10">
                                <input type="text" name="upload_register_no" id="upload_register_no" class="form-control" placeholder="Upload Register No" value="<?php echo $upload_register_no; ?>">
                        <?php echo form_error('upload_register_no', '<div class="text-danger">', '</div>'); ?> </div>
                        </div>
                        <!-- End : input Group --> 

                      
                        <!-- Start : input Group -->
                        <div class="form-group  <?php if (form_error('company_name') !== "") { echo "has-error";} ?>">
                            <label for="company_name" class="col-sm-3 col-md-2 control-label">Company Name</label>
                            <div class="col-sm-9 col-md-10">
                                <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company Name" value="<?php echo $company_name; ?>">
<?php echo form_error('company_name', '<div class="text-danger">', '</div>'); ?> </div>
                        </div>
                        <!-- End : input Group -->
                          <!-- Start : input Group -->
                        <div class="form-group  <?php if (form_error('company_address') !== "") { echo "has-error";} ?>">
                            <label for="company_address" class="col-sm-3 col-md-2 control-label">Company Adress</label>
                            <div class="col-sm-9 col-md-10">
                               <textarea  name="company_address" id="company_address" class="form-control" placeholder="Company Address" rows="4" cols="4"><?php echo $company_address;?></textarea>
<?php echo form_error('company_address', '<div class="text-danger">', '</div>'); ?> </div>
                        </div>
                        <!-- End : input Group -->
                        <!------- start : Select group ------>
                         <div class="form-group">
                                <label class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Enter Company Logo">Logo:</span></label>
                                <div class="col-sm-9 col-md-10">
                                <input type="file" data-rule-MaxSize="true" data-rule-extension="jpeg|png" name="company_logo" id="company_logo" class="filestyle"/>
                                <input type="hidden" name="H_company_logo" value="<?php echo $company_logo;?>"/>
                                <span class="help-block">Accepted formats: png. Max file size 5 MB</span>
                                <?php echo form_error('company_logo', '<div class="text-danger">', '</div>'); ?> 
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
                                        <option value="2">Verify</option>
<?php } else { ?>
                                        <option value="0" selected="selected">Disabled</option>
                                        <option value="1">Enabled</option>
                                        <option value="2">Verify</option>
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
                                <label class="col-sm-3 col-md-2 control-label" for="status">Soft Deleted</label>
                                <div class="col-sm-9 col-md-10">

                                    <input type="checkbox" name="is_deleted" onclick="checkAddress(this)" value="<?php echo $is_deleted; ?>" <?php if ($is_deleted == 1) echo 'checked'; ?> id="is_deleted"/>   
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
                                      <!-- End : tab-pane manufacturer-details--> 

                                        <!-- Start : tab-pane Address-details--> 
                                         <div class="tab-pane" id="tab-address-details">    
                                            <!------- start : input group ------>
                                            <div class="form-group required <?php
                                            if (form_error('address_1') !== "") { echo "has-error";} ?>">
                                                <label for="address_1" class="col-sm-3 col-md-2 control-label">Address 1</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" name="address_1" id="address_1" class="form-control" placeholder="Address 1" value="<?php echo $address_1; ?>">
                                                        <?php echo form_error('address_1', '<div class="text-danger">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <!------- End : input group ------>
                                            <!------- start : input group ------>
                                            <div class="form-group required <?php
                                            if (form_error('city') !== "") {
                                                echo "has-error";
                                            }
                                            ?>">
                                                <label for="city" class="col-sm-3 col-md-2 control-label">City</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" name="city" id="city" class="form-control" placeholder="City" value="<?php echo $city; ?>">
                                                    <?php echo form_error('city', '<div class="text-danger">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <!------- End : input group ------>

                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label for="postcode" class="col-sm-3 col-md-2 control-label">Postcode</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" name="postcode" id="postcode" class="form-control" placeholder="Postcode" value="<?php echo $postcode; ?>">
                    <?php echo form_error('postcode', '<div class="text-danger">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <!------- End : input group ------>

                                            <!------- start : input group ------>
                                            <div class="form-group required <?php if(form_error('country') !== "") { echo "has-error"; } ?>">
                                                <label class="col-sm-3 col-md-2 control-label" for="country">Country</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <select name="country" id="country" onchange="getstate(this.value);" class="form-control">';
                                                        <option value=""> --- Please Select --- </option>
                                                        <?php foreach($countries as $country) { ?>
                                                            <?php if ($country['country_id'] == $address_country) { ?>
                                                         <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo addslashes($country['country_name']); ?></option>
                                                            <?php } else { ?>
                                                         <option value="<?php echo $country['country_id']; ?>" ><?php echo addslashes($country['country_name']); ?></option>
                                                            <?php } ?>
                                                        <?php }  ?>
                                                    </select>
                                                    <?php echo form_error('country', '<div class="text-danger">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <!------- end : input group ------>

                                            <!------- start : input group ------>
                                            <div class="form-group required <?php if(form_error('state') !== "") { echo "has-error"; } ?>">
                                                <label class="col-sm-3 col-md-2 control-label" for="state">State</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <select name="state" id="state" class="form-control">';
                                                        <option value=""> --- Please Select --- </option>
                                                    </select>
                                                    <input type="hidden" name="state_id" id="state_id" value="<?php echo $state; ?>">
                                                    <?php echo form_error('state', '<div class="text-danger">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <!------- end : input group ------>

                                         </div>
                                         <!-- End : tab-pane Address-details-->
</div>
                        
                      
                                </div><!-- End: tab-content -->
                             
  
                        </div>
                        </div>
                </div>
            </div>
                <!-- End : box-body -->
          
        </section>
         </form>
        </div>
        <!----------------------- Main content ------------------------------->

        <!------------------- End content-wrapper ----------------------------> 
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js">     </script>
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/js/common.js"></script> 
        <script type="text/javascript">
            //Initialize Select2 Elements
            $(".select2").select2();
        </script> 
        <script>
         $(document).ready(function () {
                //Date picker
                $('#dob').datepicker({
                    todayHighlight: true,
                    autoclose: true,
                    format: 'dd-mm-yyyy'
                });
            });
function getstate(country_id)
{
    var state_id='<?php echo $state;?>';
    $.ajax({
        type:"POST",
        url:"<?php echo base_url('system/country/get_zone_by_country_id') ?>",
        data:{
            'country_id':country_id
        },
        dataType:"json",
        success:function(json){
            
           var html='';
                            if(country_id=="")
                            {
                                html += '<option value="0"> ---None--- </option>';
                                $('select[name=\'state\']').html(html); 
                            }
                            else
                            {
                                html = '<option value=""> ---Please Select--- </option>';
                                
                                if (json['zone'] && json['zone'] != '') {
                                    for (i = 0; i < json['zone'].length; i++) {
                                        if(state_id != "")
                                        {
                                            html += '<option value="' + json['zone'][i]['state_id'] + '"';
                                        
                                        
                                            if (json['zone'][i]['state_id'] == state_id) {
                                                html += ' selected="selected"';
                                            }
                                        
                                            html += '>' + json['zone'][i]['state_name'] + '</option>';
                                            
                                        }
                                        else                                        
                                        {
                                            html += '<option value="' + json['zone'][i]['state_id'] + '"';
                                        
                                            html += '>' + json['zone'][i]['state_name'] + '</option>';
                                        }
                                    }
                                } else {
                                        html += '<option value="0"> ---None--- </option>';
                                }
                                
                                $('select[name=\'state\']').html(html); 
                            }
        }
    });
} 
              
getstate('<?php echo $address_country;?>'); 
        
        </script> 
