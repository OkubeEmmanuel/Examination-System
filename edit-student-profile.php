<?php session_start(); ?>
<?php if (isset($_SESSION['student'])):
  $matric_no = $_SESSION['student'];
  include 'head.php';
  include 'db.php';
  $q = $db->prepare('select name, matric_no, phone from student where matric_no = ?');
  $q->bind_param('s', $matric_no);
  $q->execute();
  $q->bind_result($name, $matric_no, $phone);
  $q->fetch();
  $q->free_result();
  $q->close();
  $db->close();
?>
<body class="loadmap bgwhite">

<div class="bgxlight bordertopbottom relative z20 mt70">
  <div class="container ptb40 cdark">
      <div class="container ">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                  <div class="panel panel-default" style="margin-bottom:20px;background-color:#fff;border:1px solid transparent;border-radius:4px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05);border-color:#ddd">
                      <div class="panel-heading" style="color:#333;background-color:#f5f5f5;border-color:#ddd"><b>Edit Information</b></div>
                      <div class="panel-body">

                        <?php if (isset($_SESSION['wf'])): ?>
                          <div class="alert alert-danger">
                            <strong>select a correct file type.</strong>
                          </div>
                        <?php endif; unset($_SESSION['wf']);?>

                          <form class="form-horizontal" role="form" method="POST" action="edit-student-script.php" enctype="multipart/form-data">

                              <div class="form-group">
                                  <label for="name" class="col-md-4 control-label">Full Name</label>
                                  <div class="col-md-6">
                                      <input id="fname" type="text" class="form-control" name="name" required value="<?php echo $name; ?>">
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label for="lname" class="col-md-4 control-label">Mat No.</label>
                                  <div class="col-md-6">
                                      <input id="lname" type="text" class="form-control" name="matric_no" required value="<?php echo $matric_no; ?>" readonly>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label for="phone" class="col-md-4 control-label">Phone Number</label>
                                  <div class="col-md-6">
                                      <input id="phone" type="number" class="form-control" name="phone" required value="<?php echo $phone; ?>">
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label for="image" class="col-md-4 control-label">Select an Image</label>
                                  <div class="col-md-6">
                                      <input id="image" type="file" class="form-control" name="image" value="">
                                  </div>
                              </div>

                              <input id="lname" type="hidden" class="form-control" name="id" required value="<?php echo $id; ?>">

                              <div class="form-group">
                                  <div class="col-md-2 col-md-offset-4">
                                      <input type="submit" class="btn btn-primary" name="edit-btn" value="Save">
                                  </div>
                                  <div class="col-md-2">
                                      <a href="student-home.php" class="btn btn-danger">Cancel</a>
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
    </body>
  </html>

<?php else:
  header('Location:logout.php');
  exit;
?>

<?php endif; ?>
