<?php session_start(); ?>
<?php if (isset($_SESSION['admin'])):
  include 'head.php';
?>
<body class="loadmap bgwhite">

<!-- Navigation -->
<div ID="navoffset" class="secpage shadow-off bgwhite">

<div class="navigation dark">

  <div class="container">
    <div class="logo"><a href="./admin-home.php">AMES</a></div>

    <?php include 'admin-nav.php';?>

  </div>
</div>

</div>
<!-- End of Navigation -->
<div class="bgwhite space20 relative z20"></div>
<div class="bgxlight bordertopbottom relative z20">
  <div class="container ptb40 cdark">
      <div class="container mid">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <?php if (isset($_SESSION['rnae'])): ?>
                  <div class="alert alert-info bold text-center">
                    The matriculation number belongs to someone already.
                  </div>
                <?php endif; unset($_SESSION['rnae']);?>
                  <div class="panel panel-default" style="margin-bottom:20px;background-color:#fff;border:1px solid transparent;border-radius:4px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05);border-color:#ddd">
                      <div class="panel-heading" style="color:#333;background-color:#f5f5f5;border-color:#ddd"><b>Register</b></div>
                      <div class="panel-body">
                          <form class="form-horizontal" role="form" method="POST" action="regstudent.php">

                              <div class="form-group">
                                  <label for="name" class="col-md-4 control-label">Full Name</label>
                                  <div class="col-md-6">
                                      <input id="fname" type="text" class="form-control" name="name" required autofocus placeholder="Enter students full name.">
                                  </div>
                              </div>

    													<div class="form-group">
                                  <label for="matno" class="col-md-4 control-label">Mat No.</label>
                                  <div class="col-md-6">
                                      <input id="matno" type="text" class="form-control" name="matric_no" required placeholder="Enter students matriculation number.">
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label for="phone" class="col-md-4 control-label">Phone Number</label>
                                  <div class="col-md-6">
                                      <input id="phone" type="text" class="form-control" name="phone" required placeholder="Enter students phone number">
                                  </div>
                              </div>

                              <div class="form-group">
                                  <div class="col-md-6 col-md-offset-4">
                                      <input type="submit" class="btn btn-primary" name="reg_btn" value="Save">
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
</div>
  <?php include 'footer.php'; ?>
    </body>
  </html>
<?php else:
  header('Location:logout.php');
  exit;
?>

<?php endif; ?>
