<?php session_start(); ?>
<?php if (isset($_SESSION['admin'])):
  include 'head.php';
?>
<?php if (isset($_GET['id'])):
  include 'db.php';
  $id = $_GET['id'];
  $q = $db->prepare('select name, matric_no, phone from student where matric_no = ?');
  $q->bind_param('s', $id);
  $q->execute();
  $q->store_result();
  $n = $q->num_rows;
?>

<?php if ($n > 0):
  $q->bind_result($name, $matric_no, $phone);
  $q->fetch();
  $q->free_result();
  $q->close();
  $db->close();
?>
  <body class="loadmap bgwhite">

  <!-- Navigation -->
  <div ID="navoffset" class="secpage shadow-off bgwhite">

  <div class="navigation dark">

    <div class="container">
      <div class="logo"><a href="admin-home.php">NAITES</a></div>

      <?php include 'admin-nav.php';?>

    </div>
  </div>

  </div>
  <!-- End of Navigation -->
  <div class="bgwhite space20 relative z20"></div>
  <div class="bgxlight bordertopbottom relative z20">
    <div class="container ptb40 cdark">
        <div class="container ">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default" style="margin-bottom:20px;background-color:#fff;border:1px solid transparent;border-radius:4px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05);border-color:#ddd">
                        <div class="panel-heading" style="color:#333;background-color:#f5f5f5;border-color:#ddd"><b>Edit Information</b></div>
                        <div class="panel-body">
                          <?php if (isset($_SESSION['mnae'])): ?>
                            <div class="alert alert-danger text-center bold">
                              The number you chose is already in use.
                            </div>
                          <?php endif; unset($_SESSION['mnae']);?>
                            <form class="form-horizontal" role="form" method="POST" action="edit-script.php?id=<?php echo $id; ?>">

                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">Full Name</label>
                                    <div class="col-md-6">
                                        <input id="fname" type="text" class="form-control" name="name" required value="<?php echo $name; ?>">
                                    </div>
                                </div>

      													<div class="form-group">
                                    <label for="lname" class="col-md-4 control-label">Mat No.</label>
                                    <div class="col-md-6">
                                        <input id="lname" type="text" class="form-control" name="matric_no" required value="<?php echo $matric_no; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="col-md-4 control-label">Phone Number</label>
                                    <div class="col-md-6">
                                        <input id="phone" type="number" class="form-control" name="phone" required value="<?php echo $phone; ?>">
                                    </div>
                                </div>
                                <input id="lname" type="hidden" class="form-control" name="id" required value="<?php echo $id; ?>">


                                <div class="form-group">
                                    <div class="col-md-2 col-md-offset-4">
                                        <input type="submit" class="btn btn-primary" name="edit_btn" value="Save">
                                    </div>
                                    <div class="col-md-2">
                                        <a href="view-students.php" class="btn btn-danger">Cancel</a>
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
    <?php include 'footer.php'; ?>

<?php else:
  $q->free_result();
  $q->close();
  $db->close();
  header('location:view-student.php');
  exit;
?>
<?php endif; ?>

<?php else:
  header('location:view-student.php');
  exit;
?>

<?php endif; ?>
<?php else:
  header('Location:logout.php');
  exit;
?>

<?php endif; ?>
