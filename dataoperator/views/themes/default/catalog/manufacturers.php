<link href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>

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
    <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="form-manufacturers" id="form-manufacturers">
        <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('Dtoken'); ?>" />
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
        <!------------------ End Content Header (Page header) ---------------------> 
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
                                <input type="hidden" name="manufacturer_id" value="<?php echo $manufacturer_id; ?>" />
                                <!-- Start : input Group -->
                                <div class="form-group required <?php
                                if (form_error('firstname') !== "") {
                                    echo "has-error";
                                }
                                ?>">
                                    <label for="firstname" class="col-sm-3 col-md-2 control-label">First Name</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" value="<?php echo $firstname; ?>">
<?php echo form_error('firstname', '<div class="text-danger">', '</div>'); ?> </div>
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
<?php echo form_error('middlename', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                                <!-- End : input Group --> 

                                <!-- Start : input Group -->
                                <div class="form-group required <?php
if (form_error('lastname') !== "") {
    echo "has-error";
}
?>">
                                    <label for="lastname" class="col-sm-3 col-md-2 control-label">Last Name</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" value="<?php echo $lastname; ?>">
                                <?php echo form_error('lastname', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                                <!-- End : input Group --> 

                                <!-- Start : input Group -->
                                <div class="form-group required  <?php
                                if (form_error('email') !== "") {
                                    echo "has-error";
                                }
                                ?>">
                                    <label for="email" class="col-sm-3 col-md-2 control-label">Email</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
<?php echo form_error('email', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                                <!-- End : input Group --> 

                                <!-- Start : input Group -->
                                <div class="form-group required <?php
if (form_error('password') !== "") {
    echo "has-error";
}
?>">
                                    <label for="password" class="col-sm-3 col-md-2 control-label">Password</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?php echo $password; ?>">
                                        <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                                <!-- End : input Group --> 

                                <!------- start : input group ------>
                                <div class="form-group  <?php
                                        if (form_error('c_password') !== "") {
                                            echo "has-error";
                                        }
                                        ?>">
                                    <label for="c_password" class="col-sm-3 col-md-2 control-label">Confirm Password</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="password" class="form-control" name="c_password" id="c_password" placeholder="Confirm Password" value="<?php echo $c_password; ?>">
<?php echo form_error('c_password', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                                <!------- end : input group ------> 

                                <!-- Start : input Group -->
                                <div class="form-group  <?php
                                     if (form_error('telephone') !== "") {
                                         echo "has-error";
                                     }
                                     ?>">
                                    <label for="password" class="col-sm-3 col-md-2 control-label">Telephone</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="text" name="telephone" id="telephone" class="form-control" placeholder="Telephone" value="<?php echo $telephone; ?>">
<?php echo form_error('telephone', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                                <!-- End : input Group --> 

                                <!-- Start : input Group -->
                                <div class="form-group  <?php
                                        if (form_error('mobile') !== "") {
                                            echo "has-error";
                                        }
                                        ?>">
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
                                        <input type="radio" name="gender" value="male" <?php
if ($gender == "male") {
    echo "checked";
}
?>>
                                        Male
                                        </input>
                                        <input type="radio" name="gender" value="female" <?php
if ($gender == "female") {
    echo "checked";
}
?>>
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
                                            <input id="dob" name="dob" placeholder="Date of Birth" class="form-control pull-right" type="text" value="<?php
                                            if ($dob !== "") {
                                                echo date('d-m-Y', strtotime($dob));
                                            }
                                            ?>">
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
                                <div class="form-group <?php
                                if (form_error('bank_address') !== "") {
                                    echo "has-error";
                                }
                                ?>">
                                    <label for="bank_address" class="col-sm-3 col-md-2 control-label">Bank Address</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="text" name="bank_address" id="bank_address" class="form-control" placeholder="BankAddress" value="<?php echo $bank_address; ?>">
<?php echo form_error('bank_address', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                                <!-- End : input Group --> 

                                <!-- Start : input Group -->
                                <div class="form-group <?php
                                 if (form_error('bank_ifsc_code') !== "") {
                                     echo "has-error";
                                 }
                                 ?>">
                                    <label for="bank_ifsc_code" class="col-sm-3 col-md-2 control-label">Bank Ifsc Code</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="text" name="bank_ifsc_code" id="bank_ifsc_code" class="form-control" placeholder="Bank Ifsc Code" value="<?php echo $bank_ifsc_code; ?>">
<?php echo form_error('bank_ifsc_code', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                                <!-- End : input Group --> 

                                <!-- Start : input Group -->
                                <div class="form-group <?php
if (form_error('account_no') !== "") {
    echo "has-error";
}
?>">
                                    <label for="account_no" class="col-sm-3 col-md-2 control-label">Bank Account Number</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="text" name="account_no" id="account_no" class="form-control" placeholder="Bank Account Number" value="<?php echo $account_no; ?>">
                            <?php echo form_error('account_no', '<div class="text-danger">', '</div>'); ?> </div>
                                </div>
                            
                            <!-- End : input Group --> 

                            <!-- Start : input Group -->
                            <div class="form-group <?php
                            if (form_error('account_name') !== "") {
                                echo "has-error";
                            }
                            ?>">
                                <label for="account_name" class="col-sm-3 col-md-2 control-label">Account Name</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="account_name" id="account_name" class="form-control" placeholder="Account Name" value="<?php echo $account_name; ?>">
                                </div>
                            </div>
                            <!-- End : input Group --> 

                            <!-- Start : input Group -->
                            <div class="form-group  <?php
                                 if (form_error('membership_fee') !== "") {
                                     echo "has-error";
                                 }
                            ?>">
                                <label for="membership_fee" class="col-sm-3 col-md-2 control-label">Membership Fee</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="membership_fee" id="membership_fee" class="form-control" placeholder="Membership Fee" value="<?php echo $membership_fee; ?>">
                                    <?php echo form_error('membership_fee', '<div class="text-danger">', '</div>'); ?> </div>
                            </div>
                            <!-- End : input Group --> 

                            <!-- Start : input Group -->
                            <div class="form-group <?php
                                    if (form_error('wallet_balance') !== "") {
                                        echo "has-error";
                                    }
                                    ?>">
                                <label for="wallet_balance" class="col-sm-3 col-md-2 control-label">Wallet_Balance</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="wallet_balance" id="wallet_balance" class="form-control" placeholder="Wallet Balance " value="<?php echo $wallet_balance; ?>">
                                        <?php echo form_error('wallet_balance', '<div class="text-danger">', '</div>'); ?> </div>
                            </div>
                            <!-- End : input Group --> 

                            <!-- Start : input Group -->
                            <div class="form-group <?php
                                        if (form_error('upload_register_no') !== "") {
                                            echo "has-error";
                                        }
                                        ?>">
                                <label for="upload_register_no" class="col-sm-3 col-md-2 control-label">Upload Register No</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="upload_register_no" id="upload_register_no" class="form-control" placeholder="Upload Register No" value="<?php echo $upload_register_no; ?>">
<?php echo form_error('upload_register_no', '<div class="text-danger">', '</div>'); ?> </div>
                            </div>
                            <!-- End : input Group --> 

                            <!-- Start : input Group -->
                            <div class="form-group <?php
if (form_error('company_name') !== "") {
    echo "has-error";
}
?>">
                                <label for="company_name" class="col-sm-3 col-md-2 control-label">Company Name</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company Name" value="<?php echo $company_name; ?>">
<?php echo form_error('company_name', '<div class="text-danger">', '</div>'); ?> </div>
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
                                        $("#status").val(<?= isset($status) ? $status : '' ?>);
                                    </script> 
                                </div>                  
                            </div>
                           
                            <!------- End : Select group ------>

<?php if ($this->session->userdata('Drole_id') == 1) { ?>
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
                            </div>
                                <!------- End : Select group ------>
<?php } ?>
                        </div>                    
                </div>
                <!-- End : box-body -->
            </div>
        </section>
        </form>
</div>
        <!----------------------- Main content ------------------------------->

        <!------------------- End content-wrapper ----------------------------> 

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


        </script> 
