<?php session_start(); ?>

<?php if (isset($_SESSION['admin'])):
  header('Location:admin-home.php');
  exit;
?>

<?php elseif(isset($_SESSION['student'])):
  header('Location:student-home.php');
  exit;
?>

<?php else:
  include 'head.php';
?>
    <body>
      <div class="sspacing">
      		<div class="container">

        <div class="container">
          <div class="georgia size60 bold text-center">
            AM EXAMINATION SYSTEM
          </div>
          <div class="space30"></div>
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default" style="margin-bottom:20px;background-color:#fff;border:1px solid transparent;border-radius:4px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05);border-color:#ddd">
                        <div class="panel-heading" style="color:#333;background-color:#f5f5f5;border-color:#ddd"><b>Login</b></div>
                        <div class="panel-body">
                          <form class="form-horizontal" role="form" method="POST" action="auth.php">

      											<?php if (isset($_SESSION["wu"])): ?>
      												<div class="alert alert-danger text-center bold">
      													 Wrong username.
      												</div>
      											<?php unset($_SESSION["wu"]); endif; ?>

      											<?php if (isset($_SESSION["wp"])): ?>
      												<div class="alert alert-danger text-center">
      													 Wrong Password.
      												</div>
      											<?php unset($_SESSION["wp"]); endif; ?>

                            <div class="form-group">
                                  <label for="phn" class="col-md-4 control-label">Username</label>
                                  <div class="col-md-6">
                                      <input id="phn" type="text" class="form-control" name="username" required autofocus>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label for="password" class="col-md-4 control-label">Password</label>

                                  <div class="col-md-6">
                                      <input id="password" type="password" class="form-control" name="password" required>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <div class="col-md-8 col-md-offset-4">
                                      <input type="submit" class="btn btn-primary" value="Login" name="login_btn">
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
<?php endif; ?>
