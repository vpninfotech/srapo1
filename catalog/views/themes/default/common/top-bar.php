<!-- Start : top-header -->
<div class="top-header">
        <div class="container">
            <div class="support-link">
<a href="<?php echo base_url('manufacturer/common/login'); ?>"><i class="glyphicon glyphicon-level-up"></i> <span class="hidden-xs hidden-sm hidden-md">Join as Manufacturer</span></a>
                     <a href="<?php echo $header['voucher']; ?>" title="Gift Vouchers"><i class="glyphicon glyphicon-gift"></i> <span class="hidden-xs hidden-sm hidden-md">Gift Vouchers</span></a>
                <?php if ($this->session->userdata('customer_id')) { ?>
                             
                <a href="<?php echo site_url('account/account'); ?>"><i class="glyphicon glyphicon-user"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $this->session->userdata('customer_name'); ?></span></a>
                
                <a href="<?php echo site_url('account/login/logout'); ?>"><i class="glyphicon glyphicon-off"></i> <span class="hidden-xs hidden-sm hidden-md">Logout</span></a>
                <?php } else { ?>
                    <a href="#" data-toggle="modal" data-target="#register_model" class="register-user"><i class="glyphicon glyphicon-share-alt"></i> <span class="hidden-xs hidden-sm hidden-md">Sign up</span></a>
                    <a href="#" data-toggle="modal" data-target="#login_model"><i class="glyphicon glyphicon-user"></i> <span class="hidden-xs hidden-sm hidden-md">Login</span></a>
                <?php } ?>

                <?php if ($this->session->userdata('customer_id')) { ?>
                 <a href="<?php echo $header['order']; ?>" title="Order History"><i class="glyphicon glyphicon-list"></i> <span class="hidden-xs hidden-sm hidden-md">Order History</span></a>
    
                 <a href="<?php echo $header['wishlist']; ?>" id="wishlist-total" title="<?php echo $header['text_wishlist']; ?>"><i class="glyphicon glyphicon-heart"></i><span class="hidden-xs hidden-sm hidden-md"><?php echo $header['text_wishlist']; ?></span></a>
                 <?php } else { ?>
                  <a href="#" data-toggle="modal" data-target="#login_model" title="Order History"><i class="glyphicon glyphicon-list"></i> <span class="hidden-xs hidden-sm hidden-md">Order History</span></a>
    
                 <a href="#" data-toggle="modal" data-target="#login_model" id="wishlist-total" title="<?php echo $header['text_wishlist']; ?>"><i class="glyphicon glyphicon-heart"></i><span class="hidden-xs hidden-sm hidden-md"><?php echo $header['text_wishlist']; ?></span></a>
                  <?php } ?>
                <!--<a href="<?php echo site_url('account/account'); ?>">Account</a>-->
                
					
                <!--<div id="user-info-top" class="user-info">
                    <div class="dropdown">
                        <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><span>My Account</span></a>
                        <ul class="dropdown-menu mega_dropdown" role="menu">
                            <li><a href="#" data-toggle="modal" data-target="#login_model">Login</a></li>
                            <li><a href="compare.php">Compare</a></li>
                            <li><a href="wishlist.php">Wishlists</a></li>
                            <li><a href="#">Support</a></li>
                        </ul>
                    </div>
                </div>-->
            </div>

        </div>
    </div>
<!-- End : top-header -->



<!-- Modal -->
<div id="register_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
          <div class="modal-body">
          	<button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="row">
              	  <div class="col-xs-6 content-register">
                      <p class="register-label">Register now for <span class="text-success">FREE</span></p>
                      <div id="signup_status" style="margin-top: 20px;"></div>
                      <ul class="list-unstyled" style="line-height: 2">
                      	  <li class="register-img"><img src="<?php echo CATALOG_PATH;?>images/register1.png"/></li>
                          <li><span class="fa fa-check text-success"></span> See all your orders</li>
                          <li><span class="fa fa-check text-success"></span> Fast re-order</li>
                          <li><span class="fa fa-check text-success"></span> Save your favorites</li>
                          <!--<li><span class="fa fa-check text-success"></span> Fast checkout</li>-->
                          
                      </ul>
                      <!--<a href="#" class="btn btn-login" data-toggle="modal" data-target="#login_model">Already Register, Login Here!</a>-->
                  </div>
                  <div class="col-xs-6 content-form">
                      <div class="register-form">
                         
                          <form id="signupForm" name="signupForm" method="post" action="<?php echo site_url('account/register/registration'); ?>">
                              <div class="form-group">
                                  <label for="firstname" class="control-label">First Name</label>
                                  <input type="text" class="form-control" id="firstname" name="firstname" value="" placeholder="Firstname">
                                  <span class="help-block"></span>
                              </div>
                              
                              <div class="form-group">
                                  <label for="lastname" class="control-label">Last Name</label>
                                  <input type="text" class="form-control" id="lastname" name="lastname" value=""  placeholder="Lastname">
                                  <span class="help-block"></span>
                              </div>
                              
                              <div class="form-group">
                                  <label for="email" class="control-label">Email</label>
                                  <input type="text" class="form-control" id="email" name="email" value=""  placeholder="Email Address">
                                  <span class="help-block"></span>
                              </div>
                              
                              <div class="form-group">
                                  <label for="password" class="control-label">Password</label>
                                  <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password">
                                  <span class="help-block"></span>
                              </div>
                              <!--<button type="submit" name="signupSubmit" class="btn btn-register">Register</button>--><input type="submit" name="signupSubmit" id="signupSubmit" class="btn btn-register" value="Register"/><br/>
                              <a href="#" class="button btn-login" data-toggle="modal" data-dismiss="modal" data-target="#login_model">Existing User?  Sign in</a>
                          </form>
                      </div>
                  </div>
                  
              </div>
          </div>
            
    </div>
  </div>
</div>




<!-- Modal -->
<div id="login_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
          <div class="modal-body">
          	<button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="row">
              	  <div class="col-xs-6 content-register">
                      <p class="register-label">Login Now</p>
                       <div id="login_status" style="margin-top:20px;"></div>
                      <ul class="list-unstyled" style="line-height: 2">
                            <!--<li>User Login From Here. </li>-->
                            <li class="login-img"><img src="<?php echo CATALOG_PATH;?>images/login_lock.png"/></li>
                      </ul>
                      <!--<p><a href="#" class="btn btn-register1">New User, register now!</a></p>-->
                  </div>
                  <div class="col-xs-6 content-form">
                      <div class="register-form">
                         
                          <form id="loginForm" name="loginForm" method="post" action="<?php echo site_url('account/login'); ?>">
                          <input type="hidden" name="request_url" value="<?php echo $_SERVER['REQUEST_URI'];?>">
                              <div class="form-group">
                                  <label for="email" class="control-label">Email</label>
                                  <input type="text" class="form-control" id="email" name="email" value="" placeholder="example@gmail.com">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Password</label>
                                  <input type="password" class="form-control" id="password" name="password" value="">
                                  <span class="help-block"></span>
                              </div>
                              
                              <div class="forgot-pass">
                                  <!--<label>
                                      <input type="checkbox" name="remember" id="remember"> Remember login
                                  </label>-->
                                  <a id="forgot_password" href="#" data-toggle="modal" data-dismiss="modal" data-target="#forgot_password_model">
                                      <i class="fa fa-angle-right "></i>
                                      Forgot Password
                                  </a>
                              </div>
                              <input type="submit" name="loginSubmit" id="loginSubmit" class="btn btn-login1" value="Login" />
                              <a href="#" class="button btn-login" data-toggle="modal" data-dismiss="modal" data-target="#register_model">New User?  Register</a>
                          </form>
                      </div>
                  </div>
                  
              </div>
          </div>
            
    </div>
  </div>
</div>





<!-- Modal -->
<div id="forgot_password_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
          <div class="modal-body">
          	<button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="row">
              	  <div class="col-xs-6 content-register">
                      <p class="register-label">Forgot Password.</p>
                     <div id="forgot_status" style="margin-top: 20px"></div>
                      <ul class="list-unstyled" style="line-height: 2">
                           <!--<li>Enter Email </li>-->
                           <li class="register-img"><img src="<?php echo CATALOG_PATH;?>images/register1.png"/></li>
                      </ul>
                      <!--<p><a href="#" class="btn btn-register1">New User, register now!</a></p>-->
                  </div>
                  <div class="col-xs-6 content-form">
                      <div class="register-form">
                          
                          <form id="forgotForm" name="forgotForm" method="post" action="<?php echo site_url('account/login/forgotPassword'); ?>">
                              <div class="form-group">
                                  <label for="email" class="control-label">Email</label>
                                  <input type="text" class="form-control" id="email" name="email" value="" placeholder="example@gmail.com">
                                  <span class="help-block"></span>
                              </div>
                              <div class="checkbox">
                                  <!--<label>
                                      <input type="checkbox" name="remember" id="remember"> Remember login
                                  </label>-->
                                 
                              </div>
                              <!--<button type="submit" class="btn btn-login1">Submit</button>-->
                              <input type="submit" name="forgotSubmit" id="forgotSubmit" class="btn btn-login1" value="Submit" />
                              <button type="button" class="button btn-login"  data-toggle="modal" data-dismiss="modal" data-target="#login_model">New User? Sign In</button>
                          </form>
                      </div>
                  </div>
                  
              </div>
          </div>
            
    </div>
  </div>
</div>

<!-- JAVA SCRIPT -->
<script src="<?php echo CATALOG_PATH; ?>/lib/jquery-validation/jquery.validate.js"></script> <!-- Form Validation --> 
<script src="<?php echo CATALOG_PATH;?>js/jquery-validate.bootstrap-tooltip.js"></script>
<script type="text/javascript">
$(document).ready(function () {
//======= SIGN UP VALIDATION =============
$('#signupForm').validate({
     highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        // $(".input-group").after();
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        $(element).closest('.error').remove();
    },
    //ignore:[],
    rules: {
        firstname: {
            required: true,
        },
        lastname: {
            required: true,
        },
        email: {
            required: true,
            remote: {
                url: "<?php echo site_url('account/register/Check_email_exist'); ?>",
                type: "post"
            },
            email:true
        },
        password: {
            required: true,
        }
    },
    messages: {
        firstname: {
            required: "Please Provide Firstname",
        },
        lastname: {
            required: "Please Provide Lastname",
        },
        email: {
            required: "Please Provide Email.",
            remote: "Email Address Already Exists",
            email:"Please Enter Valid Email Address"
        },
        password: {
            required: "Please Provide Password."
        }
    },
    submitHandler: function(form){ 
        $('#signupSubmit').val('Processing...');
         $.post($(form).attr('action'),$(form).serialize(),function(data){
                 if(data)
                 {
                         $('#signup_status').html('<div class="alert alert-success">We have sent you a account activation link on your email. please check it and active your account.</div>');
                         $("#signupForm")[0].reset();
                         $('#signupSubmit').val('Register');
                 }
         });
          return false;
   }
}); 

//========== LOGIN VALIDATION ========

$('#loginForm').validate({
     highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        // $(".input-group").after();
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        $(element).closest('.error').remove();
    },
    ignore:[],
    rules: {
        email: {
            required: true,
            email:true
        },
        password: {
            required: true,
        }
    },
    messages: {
        email: {
            required: "Please Provide Email.",
            email:"Please enter valid Email Address"
        },
        password: {
            required: "Please Provide Password."
        }
    },
    submitHandler: function(form){ 
        $('#loginSubmit').val('Processing...');
        var data="";
        $.ajax({
                url:$(form).attr('action'),
                type:'POST',
                data:$(form).serialize(),
                 dataType: 'json',
                success:function(json){
                  if(json['msg']=='invalid')
                  {
                      $('#login_status').html('<div class="alert alert-danger">Invalid email address or password.<span class="close"></span></div>');
                      $(form)[0].reset();
                      $('#loginSubmit').val('Login');
                  }
                  else if(json['msg']=='inactive')
                  {
                      $('#login_status').html('<div class="alert alert-danger">Your account is not actived yet, please active your account by verifying your email address.<span class="close"></span></div>');

                      $(form)[0].reset();
                      $('#loginSubmit').val('Login');
                  }
                  else
                  { 
                      //location.reload();
                      if(json['url'])
                      {
                        window.location=json['url'];
                      }
                      else
                      {
                        window.location='<?php echo site_url('common/home');?>';
                      }
                      
                  }
                }

        });
        // $.post($(form).attr('action'),$(form).serialize(),function(data){
        
        // if(data=='invalid')
        // {
        //     $('#login_status').html('<div class="alert alert-danger">Invalid email address or password.<span class="close"></span></div>');
        //     $(form)[0].reset();
        //     $('#loginSubmit').val('Login');
        // }
        // else if(data=='inactive')
        // {
        //     $('#login_status').html('<div class="alert alert-danger">Your account is not actived yet, please active your account by verifying your email address.<span class="close"></span></div>');

        //     $(form)[0].reset();
        //     $('#loginSubmit').val('Login');
        // }
        // else
        // { 
        //     //location.reload();
        //     window.location='<?php echo site_url('common/home');?>';
        // }
        // });
        return false;
    }
}); 

//========== FORGOT PASSWORD VALIDATION ==============
$('#forgotForm').validate({
     highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        // $(".input-group").after();
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        $(element).closest('.error').remove();
    },
    ignore:[],
    rules: {
        email: {
            required: true,
            email:true
        },
    },
    messages: {
        email: {
            required: "Please Provide Email.",
            email:"Please enter valid Email Address"
        },
    },
    submitHandler: function(form){ 
        $('#forgotSubmit').val('Processing...');
        $.post($(form).attr('action'),$(form).serialize(),function(data){
        if(data==1)
        {
            $('#forgot_status').html('<div class="alert alert-success">An email with a confirmation link has been sent your Register email address!<span class="close"></span></div>');
            $(form)[0].reset();
            $('#forgotSubmit').val('Submit');
        }
        else if(data==0)
        {
            $('#forgot_status').html('<div class="alert alert-danger">The E-Mail Address was not found in our records, please try again!<span class="close"></span></div>');

            $(form)[0].reset();
            $('#forgotSubmit').val('Submit');
        }
        });
        return false;
    }
}); 

});


</script>