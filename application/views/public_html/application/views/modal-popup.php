<?php include("header.php"); ?>


<div class="modal-forms modal-content section-bg-grey">
  <div class="modal-body food-modal pattern-bg p-0">
    <div class="section-bg-grey p-4">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      <div class="modal-food-item-logo"> <img src="<?php echo base_url() . 'statics/images/logo-colored.png' ?>" class="img-fluid" alt="pizza-img"> </div>
      <section class="section-padtop-10 section-padbottom-10">
        <form class="login-form" method="post">
          <h3 class="rpg-h3 rpg-bold rpg-gold text-center">Sign In</h3>
          <div class="form-group">
            <label>Email Address</label>
            <input type="email" class="form-control" placeholder="Email address here" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="email" class="form-control" placeholder="Enter password here" required>
          </div>
          <div class="row">
            <div class="col-6"> <a href="javascript:void(0);" class="forget-password-link" id="forget-password">Forgot your password?</a> </div>
            <div class="col-6 text-right"> <a href="javascript:void(0);" id="lnkNewSignUp" class="signup-link">Create Account</a> </div>
          </div>
          <br>
          <div class="form-group">
            <button class="btn pmax-btn pmax-btn-lg w-100">Login</button>
          </div>
          <br>
        </form>
        <form class="forget-form display-hide" method="post">
          <div class="text-left form-back-btn"> <a href="javascript:void(0);" id="back-btn"><i class="fa fa-angle-left"></i> Back</a> </div>
          <h3 class="rpg-h3 rpg-bold rpg-gold text-center">Forgot your password ?</h3>
          <p class="text-center">Enter your email below to reset your password.</p>
          <div class="form-group">
            <label>Email Address</label>
            <input type="email" class="form-control" placeholder="Email address here" required>
          </div>
          <br>
          <div class="text-center">
            <button type="submit" class="btn pmax-btn pmax-btn-lg w-100">Submit</button>
          </div>
        </form>
        <form class="signup-form display-hide" method="post">
          <div class="text-left form-back-btn"> <a href="javascript:void(0);" id="signUpback-btn"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</a> </div>
          <h3 class="rpg-h3 rpg-bold rpg-gold text-center">Create an account</h3>
          <div class="form-group">
            <label>Name</label>
            <input type="email" class="form-control" placeholder="Full name here" required>
          </div>
          <div class="form-group">
            <label>Mobile Number</label>
            <input type="email" class="form-control" placeholder="Mobile number here" required>
          </div>
          <div class="form-group">
            <label>Email Address</label>
            <input type="email" class="form-control" placeholder="Email address here" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" placeholder="Create password" required>
          </div>
          <div class="form-group">
            <label>Re-enter Password</label>
            <input type="password" class="form-control" placeholder="Re-enter password here" required>
          </div>
          <br>
          <div class="text-center">
            <button type="submit" class="btn pmax-btn pmax-btn-lg w-100">Register</button>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>





<?php include("footer.php"); ?>
<script type="text/javascript">
  // Login, Signup, Forget password forms
  $('#forget-password').click(function() {
    $('.login-form').slideUp('slow', function() {
      $('.forget-form').slideDown('slow', function() {

        $('.forget-form .form-group .help-block').slideUp('slow', function() {
          $(this).remove();
        });

        $('.forget-form .alert').slideUp('slow');
        $('.forget-form .form-group').removeClass('has-error').slideDown('slow');
        $('.login-form .form-group input').val('');
      });
    });
  });
  $('#lnkNewSignUp').click(function() {
    $('.login-form').slideUp('slow', function() {
      $('.signup-form').slideDown('slow', function() {

        $('.signup-form .form-group .help-block').slideUp('slow', function() {
          $(this).remove();
        });

        $('.signup-form .alert').slideUp('slow');
        $('.signup-form .form-group').removeClass('has-error').slideDown('slow');
        $('.login-form .form-group input').val('');
      });
    });
  });

  $('#signUpback-btn').click(function() {
    $('.signup-form').slideUp('slow', function() {
      $('.login-form').slideDown('slow', function() {
        $('.login-form .form-group').removeClass('has-error');
        $('.login-form .form-group .help-block').slideUp('slow', function() {
          $(this).remove();
        });

        $('.login-form .alert-danger').slideUp('slow');
      });
    });
  });

  $('#back-btn').click(function() {
    $('.forget-form').slideUp('slow', function() {
      $('.login-form').slideDown('slow', function() {
        $('.login-form .form-group').removeClass('has-error');
        $('.login-form .form-group .help-block').slideUp('slow', function() {
          $(this).remove();
        });

        $('.login-form .alert-danger').slideUp('slow');
      });
    });
  });
</script>