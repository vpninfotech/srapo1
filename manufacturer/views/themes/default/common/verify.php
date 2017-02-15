<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Srapo</title>
    <!-- Animation CSS -->
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/css/components.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/css/animate.css" rel="stylesheet">
    <!-- Theme CSS -->
    <!-- Custom Fonts -->
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/css/icons/icomoon/styles.css" rel="stylesheet">
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/css/style.css" rel="stylesheet">
    <!-- Owl Corousel -->
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/lib/owl/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/lib/owl/owl.theme.css" rel="stylesheet">
    
    <link href="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/lib/datepicker/datepicker3.css" rel="stylesheet">
</head>
<body id="page-top" class="index">
    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom box-shadow">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top"><img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/img/srapos.png" width="150px"></a>
            </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            	<div class="default-msg">Welcome, <?php echo $this->session->userdata('manufacturer_name');?></div>
                <ul class="nav navbar-nav navbar-right">
                    <!--<li class="hidden">
                        <a href="#page-top"></a>
                    </li>-->
                    <li class="page-scroll active">
                        <a href="<?php echo base_url('common/login/logout');?>">Logout</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
<section>
    <div class="container personal-detail">
        <?php if (isset($error) && $error !== ""): ?>
                    <div class="row">
                        <div class="alert alert-danger alert-bold-border">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
                            <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error; ?> </div>
                    </div>
                <?php endif; ?>
                <?php if (isset($success) && $success !== ""): ?>
                    <div class="row">
                        <div class="alert alert-success alert-bold-border">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
                            <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success; ?> </div>
                    </div>
                <?php endif; ?>
        <div class="row alert alert-danger">
            Your account is pending, please complete the information required for approval.
        </div>
	   <div class="row">
            <div class="col-md-12">
            <!--steps-basic-->
            <form class="steps-validation" method="post" action="<?php echo base_url('common/register/edit');?>" enctype="multipart/form-data">
            <input type="hidden" name="manufacturer_id" value="<?php echo $this->session->userdata('manufacturer_user_id');?>">
							<h6>Manufacturer details</h6>
							<fieldset>
								<div class="row">
									<div class="col-md-6">
                                    	<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>First name:</label>
                                                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" data-rule-required="true" data-msg-required="First Name Required" value="<?php echo $firstname;?>">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Middle name:</label>
                                                    <input type="text" name="middlename" id="middlename" class="form-control" placeholder="Middle Name" data-rule-required="true" data-msg-required="Middle Name Required" value="<?php echo $middlename;?>">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Last name:</label>
                                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" data-rule-required="true" data-msg-required="Last Name Required" value="<?php echo $lastname;?>">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Email address:</label>
                                                    <input type="email" name="email" id="email"" class="form-control" placeholder="your@email.com" data-rule-required="true" data-rule-email="true" data-msg-required="Email Required" value="<?php echo $email;?>">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Mobile:</label>
                                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number" data-rule-required="true" data-msg-required="Mobile Number Required" data-rule-minlength="6" data-rule-maxlength="15" data-rule-number="true" value="<?php echo $mobile;?>">
                                                </div>
                                                
                                                <div class="form-group">
                                                	<label>Gender:</label>
                                                    <label class="radio-inline">
                                                	<input name="gender" type="radio" value="male" class="radio-inline" <?php if($gender == 'male'){echo 'checked="checked"';}?> data-rule-required="true" data-msg-required="Gender Required"> Male
                                                    </label>
                                                    <label class="radio-inline">
                                        			<input name="gender" value="female" <?php if($gender == 'female'){echo 'checked="checked"';}?>type="radio"> Female
                                                    </label>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Date Of Birth:</label>
                                                    <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" name="dob" class="form-control" id="datepicker" data-rule-required="true" data-msg-required="Date of Birth Required" value="<?php echo $dob;?>">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                         </div>
									</div>
                                     <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                               <div class="form-group">
                                                    <label>Address:</label>
                                                    <textarea name="address" id="address" data-rule-required="true" data-msg-required="Address Required"class="form-control" placeholder="Address" rows="4" cols="4"><?php echo $address;?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label><span data-toggle="tooltip" title="" data-original-title="Enter City Name">City :</span></label>
                                                    <input type="text" name="city" class="form-control" placeholder="City" data-rule-required="true" data-msg-required="City Required"  value="<?php echo $city;?>">
                                                </div>
                                                <div class="form-group">
                                                    <label><span data-toggle="tooltip" title="" data-original-title="Enter Postcode">Postcode :</span></label>
                                                    <input type="text" name="postcode" class="form-control" placeholder="Postcode" data-rule-required="true" data-msg-required="Postcode Required" value="<?php echo $postcode;?>">
                                                </div>
                                                <div class="form-group">
                                                    <label><span data-toggle="tooltip" title="" data-original-title="Select Country">Country :</span></label>
                                                   <select id="country" name="country" class="form-control" data-rule-required="true" data-msg-required="Please select Country" onchange="javascript:getstate(this.value);">
                                                       <option value="">Please select Country</option>
                                                       <?php foreach($countries as $country) { ?>
                                                        <?php if ($country['country_id'] == $country_id) { ?>
                                                     <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo addslashes($country['country_name']); ?></option>
                                                        <?php } else { ?>
                                                     <option value="<?php echo $country['country_id']; ?>" ><?php echo addslashes($country['country_name']); ?></option>
                                                        <?php } ?>
                                                    <?php }  ?>
                                                   </select>
                                                </div>
                                                <div class="form-group">
                                                    <label><span data-toggle="tooltip" title="" data-original-title="Select State">State :</span></label>
                                                    <select id="state" name="state" class="form-control" data-rule-required="true" data-msg-required="Please select state">
                                                       <option value="">Please select State</option>
                                                   </select>
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                    
                                    
								</div>
							</fieldset>
                            <h6>Company details</h6>
                            <fieldset>
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Company name:</label>
                                                    <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company Name" data-rule-required="true" data-msg-required="Company Name Required" value="<?php echo $company_name;?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Company Address:</label>
                                                    <textarea name="company_address" id="company_address" data-rule-required="true" data-msg-required="Company Address Required"class="form-control" placeholder="Company Address" rows="4" cols="4"><?php echo $company_address;?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label><span data-toggle="tooltip" title="" data-original-title="Enter Company Telephone Number">Telephone :</span></label>
                                                    <input type="text" id="telephone" name="telephone" class="form-control" placeholder="Telephone Number" data-rule-required="true" data-msg-required="Telephone Required" data-rule-minlength="6" data-rule-maxlength="15" data-rule-number="true" value="<?php echo $telephone;?>">
                                                </div>
                                                <div class="form-group">
                                                    <label><span data-toggle="tooltip" title="" data-original-title="Enter Company Logo">Logo:</span></label>
                                                   
                                                    <input type="file" data-rule-MaxSize="true" data-rule-extension="jpeg|png" name="company_logo" id="company_logo" class="filestyle"/>
                                                    <input type="hidden" name="H_company_logo" value="<?php echo $company_logo;?>"/>
                                                    <span class="help-block">Accepted formats: png. Max file size 5 MB</span>
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                            </fieldset>
							<h6>Bank Details</h6>
							<fieldset>
								<div class="row">
									<div class="col-md-6">
                                    	<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Bank name:</label>
                                                    <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Bank Name" data-rule-required="true" data-msg-required="Bank Name Required" value="<?php echo $bank_name;?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Account No:</label>
                                                    <input type="text" name="account_no" id="account_no" class="form-control" placeholder="Account Number" data-rule-required="true" data-msg-required="Account Number Required" data-rule-minlength="6" data-rule-maxlength="15" data-rule-number="true" value="<?php echo $account_no;?>">
                                                </div>
                                                <div class="form-group">
                                                    <label><span data-toggle="tooltip" title="" data-original-title="Bank Account Name">Account name:</span></label>
                                                    <input type="text" name="account_name" id="account_name" class="form-control" placeholder="Account name" data-rule-required="true" data-msg-required="Acount Name Required" value="<?php echo $account_name;?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Bank Address:</label>
                                                    <textarea name="bank_address" id="bank_address" class="form-control" placeholder="Bank Address" rows="4" cols="4"><?php echo $bank_address;?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label><span data-toggle="tooltip" title="" data-original-title="Enter Branch Code">IFSC Code:</span></label>
                                                    <input type="text" name="bank_ifsc_code" id="bank_ifsc_code" class="form-control" placeholder="IFSC Code" data-rule-required="true" data-msg-required="IFSC Code Required" value="<?php echo $bank_ifsc_code;?>">
                                                </div>
                                            </div>
                                         </div>
									</div>
                                    <div class="col-md-6">
                                    	<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label><span data-toggle="tooltip" title="" data-original-title="Upload GST Document" data-placement = "bottom">GST:</span></label>
                                                    <input type="file" name="gst" id="fileInput" data-rule-extension="pdf|doc|docx" class="filestyle"/>
                                                    <input type="hidden" name="H_gst" value="<?php echo $gst;?>"/>
                                                    <span class="help-block">Accepted formats: pdf/doc/docx. Max file size 5MB</span>
                                                </div>
                                                <div class="form-group">
                                                    <label><span data-toggle="tooltip" title="" data-original-title="Upload CST Document">CST:</span></label>
                                                    <input type="file" name="cst" id="fileInput" data-rule-extension="pdf|doc|docx"  class="filestyle" />
                                                    <input type="hidden" name="H_cst" value="<?php echo $cst;?>"/>
                                                    <span class="help-block">Accepted formats: pdf/doc/docx. Max file size 5MB</span>
                                                </div>
                                                <div class="form-group">
                                                    <label><span data-toggle="tooltip" title="" data-original-title="Upload Company Pancard Document">Upload Pan:</span></label>
                                                    <input type="file" name="upload_pancard" id="fileInput" data-rule-extension="pdf|doc|docx"  class="filestyle"/>
                                                    <input type="hidden" name="H_upload_pancard" value="<?php echo $upload_pancard;?>"/>
                                                    <span class="help-block">Accepted formats: pdf/doc/docx.. Max file size 5MB</span>
                                                </div>
                                                <div class="form-group">
                                                    <label><span data-toggle="tooltip" title="" data-original-title="Upload Any One Bank Document">Bank Document:</span></label>
                                                    <input type="file" name="upload_bank_doc" id="fileInput" data-rule-extension="pdf|doc|docx"  class="filestyle" />
                                                    <input type="hidden" name="H_upload_bank_doc" value="<?php echo $upload_bank_doc;?>"/>
                                                    <span class="help-block">Accepted formats: pdf/doc/docx. Max file size 5MB</span>
                                                </div>
                                            </div>
                                         </div>
									</div>
								</div>
							</fieldset>
                            <h6>Preview</h6>
							<fieldset>
								<div class="row">
									<div class="col-md-4  overview">
                                    	<a onClick="javascript:goBack(3);"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    	<h2>Manufacturer Detail</h2>
                                    	<div>
                                            <table>
                                            	<tr>
                                                    <td><b> Name </b></td>
                                                    <td id="details_manufacturer_name"></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Email </b></td>
                                                    <td id="details_manufacturer_email"></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Contact </b></td>
                                                    <td id="details_manufacturer_mobile"></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Date Of Birth </b></td>
                                                    <td id="details_manufacturer_dob"></td>
                                                </tr>
                                            </table>
	                                    </div>
                                    </div>
                                    
                                    <div class="col-md-4  overview">
                                        <a onClick="javascript:goBack(2);"><i class="fa fa-pencil" aria-hidden="true"></i></a>   
                                        <h2>Company Details</h2>
                                        <div>
                                             <table>
                                                <tr>
                                                    <td><b>Company Name </b></td>
                                                    <td id="details_manufacturer_company_name"></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Company Address </b></td>
                                                    <td id="details_manufacturer_company_adress"></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Telephone</b></td>
                                                    <td id="details_manufacturer_telephone"></td>
                                                </tr>
                                                
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3  overview">
                                    	<a onClick="javascript:goBack(1);"><i class="fa fa-pencil" aria-hidden="true"></i></a>	
                                    	<h2>Bank Detail</h2>
                                    	<div>
                                             <table>
                                            	<tr>
                                                    <td><b>Bank Name </b></td>
                                                    <td id="details_manufacturer_bank_name"></td>
                                                </tr>
                                                <tr>
                                                    <td><b>A/C No </b></td>
                                                    <td id="details_manufacturer_bank_ac_no"></td>
                                                </tr>
                                                <tr>
                                                    <td><b>A/C Name </b></td>
                                                    <td id="details_manufacturer_bank_ac_name"></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Bank Address </b></td>
                                                    <td id="details_manufacturer_bank_address"></td>
                                                </tr>
                                                <tr>
                                                    <td><b>IFSC Code </b></td>
                                                    <td id="details_manufacturer_bank_ifcs_code"></td>
                                                </tr>
                                            </table>
	                                    </div>
                                    </div>
                                </div>
							</fieldset>

							<h6>Choose Plan</h6>
							<fieldset>
                            	<div class="row">
									<div class="col-md-4 col-md-offset-1 plan">
                                    	<h2>Membership Fee Pay Now</h2>
                                    	<div class="plan-content">
                                            <img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/img/payment.png">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy <a href="#" data-toggle="modal" data-target="#payment1">Read More</a></p>
                                            
                                            <p><b>Amount : 1500 INR</b></p>
                                             
                                             <div class="col-xs-12 test btn-plan">
                                                
                                                <button type="button" id="btn_pay_now" class="btn btn-primary btn-radio">Select</button>
                                                <input type="radio" id="pay-now" name="select_plan" value="pay_now" class="hidden">
                                            </div>
										
	                                    </div>
                                        
                                    </div>
                                    	<div class="col-md-1">
                                        </div>
                                    <div class="col-md-4 col-md-offset-1 plan">
                                    	<h2>Membership Fee Pay Letter</h2>
                                    	<div class="plan-content">
                                            <img src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/img/pay_letter.png">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy <a href="#" data-toggle="modal" data-target="#payment2">Read More</a></p>
                                            <p><b>Pay Letter</b></p>
                                            <div class="col-xs-12 test btn-plan">
                                                <button type="button" id="btn_pay_later" class="btn btn-primary btn-radio">Select</button>
                                                <input type="radio" id="pay-letter" name="select_plan" value="pay_later" class="hidden">
                                            </div>
										
	                                    </div>
                                    </div>
                                </div>
								
							</fieldset>
						</form>
	</div>
    </div>

	</div>
    </section>

        
        <div id="footer-menu-box">
        	<p class="text-center">Copyrights © 2015 Srapo. All Rights Reserved.</p>
        </div>
    <!--</section>-->
    

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>


    <!-- jQuery -->
    <script src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/lib/jquery/jquery.min.js"></script>
    
    
    <!-- jQuery  For Wizard-->
	<script src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/js/wizard_steps.js"></script>

    <script src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/js/steps.min.js"></script>
    <script src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/js/validate.min.js"></script>
   
    <!-- jQuery  For Datepicker -->
    <script src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/lib/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/lib/bootstrap-filestyle/bootstrap-filestyle.js"> </script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/lib/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/js/jquery.easing.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/js/style.min.js"></script>
    <script src="<?php echo HTTP_CATALOG.'assets/manufacturer/themes/'.$this->common->config('admin_theme');?>/js/sly.min.js"></script>

<script>
//Date picker
	$('#datepicker').datepicker({
      autoclose: true
    });
/*$(document).ready(function() {
    $("input[id$='payment_now']").click(function() {
		$("div.payletter").hide();
        $("div.paynow").show();
    });
});
$(document).ready(function() {
    $("input[id$='payment_letter']").click(function() {
		$("div.paynow").hide();
		$("div.payletter").show();
        
		
    });
});*/
function goBack(val)
{
    var len = val;
    for (var i = 0; i < len; i++) 
    {
        $('.steps-validation').steps('previous');
    }
     
	
}
function getdetails()
{
    var manufacturer_name = $('#firstname').val()+' '+ $('#lastname').val();
    var company_name = $('#company_name').val()
    var company_address = $('#company_address').val()
    var telephone = $('#telephone').val();
    var email = $('#email').val();
    var dob = $('#datepicker').val();
    var mobile = $('#mobile').val();
    var bank_name = $('#bank_name').val();
    var bank_ac_no = $('#account_no').val();
    var bank_ac_name = $('#account_name').val();
    var bank_address = $('#bank_address').val();
    var bank_ifsc_code = $('#bank_ifsc_code').val();

    $('#details_manufacturer_name').text(manufacturer_name);
    $('#details_manufacturer_company_name').text(company_name);
    $('#details_manufacturer_company_adress').text(company_address);
    $('#details_manufacturer_telephone').text(telephone);
    $('#details_manufacturer_email').text(email);
    $('#details_manufacturer_mobile').text(mobile);
    $('#details_manufacturer_dob').text(dob);
    $('#details_manufacturer_bank_name').text(bank_name);
    $('#details_manufacturer_bank_ac_no').text(bank_ac_no);
    $('#details_manufacturer_bank_ac_name').text(bank_ac_name);
    $('#details_manufacturer_bank_address').text(bank_address);
    $('#details_manufacturer_bank_ifcs_code').text(bank_ifsc_code);
}
$(function () {
    $('.btn-radio').click(function(e) {
        $('.btn-radio').not(this).removeClass('active')
    		.siblings('input').prop('checked',false)
            .siblings('.img-radio').css('opacity','0.5');
    	$(this).addClass('active')
            .siblings('input').prop('checked',true)
    		.siblings('.img-radio').css('opacity','1');
    });
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});


 /*  Script for Bootstrap popup open in center of screen */
 
 
 $(document).ready(function(){

    function alignModal(){

        var modalDialog = $(this).find(".modal-dialog");

        /* Applying the top margin on modal dialog to align it vertically center */

        modalDialog.css("margin-top", Math.max(30, ($(window).height() - modalDialog.height()) / 2));

    }

    // Align modal when it is displayed

    $(".modal").on("shown.bs.modal", alignModal);

    

    // Align modal when user resize the window

    $(window).on("resize", function(){

        $(".modal:visible").each(alignModal);

    });   

});

 /*  End :Script for Bootstrap popup open in center of screen */
 
</script>

</div>
</body>


<!-- Modal- 1 -->
<div id="payment1" class="modal fade" role="dialog">
  <div class="modal-dialog animated fadeInDown">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Terms &amp; Condition For Pay Now</h4>
      </div>
      <div class="modal-body">
        <p>Payment - 1 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Payment - 1 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Payment - 1 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
      </div>
    </div>

  </div>
</div>


<!-- Modal-2 -->
<div id="payment2" class="modal fade" role="dialog">
  <div class="modal-dialog animated fadeInDown">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Terms &amp; Condition For Pay Letter</h4>
      </div>
      <div class="modal-body">
        <p>Payment - 2 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Payment - 1 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Payment - 1 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
      </div>
    </div>

  </div>
</div>
</html>
<script type="text/javascript">
function getstate(country_id)
{
    var state_id='<?php echo $state_id;?>';
    $.ajax({
        type:"POST",
        url:"<?php echo base_url('common/register/get_zone_by_country_id') ?>",
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
              
getstate('<?php echo $country_id;?>');   

$(document).ready(function(){
    var plan = '<?php echo $select_plan;?>';
    if(plan == "pay_now")
    {
        $("#btn_pay_now").trigger('click');     
    }

    if(plan == "pay_later")
    {
         $("#btn_pay_later").trigger('click'); 
    }
    
});         
</script>