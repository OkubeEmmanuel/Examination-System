<?php session_start(); error_reporting(E_ALL); ini_set('display_errors', 'on');?>
<?php if (isset($_SESSION['student'])):
  include 'head.php';
  include 'db.php';

  $id = $_SESSION['student'];
  $q = $db->prepare('select name, phone, image from student where matric_no = ?');
  $q->bind_param('s', $id);
  $q->execute();
  $q->bind_result($name, $phone, $image);
  $q->fetch();
  $q->free_result();
  $q->close();

  $todays_date = date('Y-m-d');
  $q = $db->prepare('select course, session, date, start_time, finish_time from exam_dt where date >= ?');
  $q->bind_param('s', $todays_date);
  $q->execute();
  $q->store_result();
  $n = $q->num_rows;
?>
    <body class="bgwhite">
      <div class="space60"></div>
      <div class="container">
          <div class="col-md-7">
            <div class="panel panel-primary" style="border: 1px solid #337ab7; border-radius:5px; borde">
              <div class="panel-heading mb30">Profile <a href="logout.php" class="pull-right btn btn-lg btn-primary ml10"> <span class="glyphicon glyphicon-log-out" title="logout"></span></a><a href="edit-student-profile.php" class="btn btn-lg btn-primary pull-right"><span class="glyphicon glyphicon-cog" title="Edit Profile"></span></a></div>
                <?php if ($image == 'dummy'): ?>
                  <center><span class="glyphicon glyphicon-user img-rounded" style="margin:auto; font-size:200px"></span></center>
                <?php else: ?>
                  <div class="row mb20">
                    <div class="col-md-6 col-md-offset-3">
                      <img src="students/<?php echo $image; ?>" alt="<?php echo $name; ?>" class="img-thumbnail img-responsive">
                    </div>
                  </div>
                <?php endif; ?>
                <p class="text-center lead mt20"><b>NAME:</b> <?php echo $name; ?></p>
                <p class="text-center lead"><b>MATRICULATION NUMBER:</b> <?php echo $id; ?></p>
                <p class="text-center lead mb20"><b>PHONE:</b> <?php echo $phone; ?></p>
            </div>
          </div>
          <div class="col-md-5">
            <div class="Panel panel-default" style="margin-bottom:20px;background-color:#fff;border:1px solid transparent;border-radius:4px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05);border-color:#ddd">
              <div class="panel-heading bold" style="color:#333;background-color:#f5f5f5;border-color:#ddd">  EXAMS</div>
              <div class="panel-body">
                <?php if ($n < 1): $q->free_result(); $q->close();?>
                  <p class="lead">There are no exams</p>
                <?php else:
                  $q->bind_result($course, $session, $edate, $st, $ft);
                  $hour = date('h');
                  if ( (date('a') == "pm") && (date('h') != 12) ) {
                    $hour +=12;
                  }
                  $time = $hour.date(':i:s');
                  $tdate = date('Y-m-d');
                ?>
                <table class="table table-responsive table-hover">
                  <thead>
                    <tr>
                      <th>Course</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php while ($q->fetch()):
                    $qc = $db->prepare('select id from results where regno = ? and course = ? and session = ?');
                    $qc->bind_param('sss', $id, $course, $session);
                    $qc->execute();
                    $qc->store_result();
                    $cn = $qc->num_rows;
                    $qc->free_result();
                    $qc->close();
                  ?>

                    <?php if ($cn < 1): ?>
                      <tr>
                        <td><?php echo $course; ?></td>
                        <td><?php echo $edate; ?></td>
                        <td><?php echo $st; ?></td>
                        <?php if ($tdate == $edate): ?>
                          <?php if ( ($time >= $st) && ($time < $ft) ): ?>
                            <td><a href="exam.php?cc=<?php echo $course; ?>&as=<?php echo $session; ?>">write</a></td>
                          <?php endif; ?>
                        <?php endif; ?>
                      </tr>
                    <?php endif; ?>

                  <?php endwhile; ?>
                </tbody>
              </table>
                  <?php $q->free_result(); $q->close(); ?>
                <?php endif; ?>
              </div>
            </div>
              <div class="panel panel-default" style="margin-bottom:20px;background-color:#fff;border:1px solid transparent;border-radius:4px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05);border-color:#ddd">
                <div class="panel-heading bold" style="color:#333;background-color:#f5f5f5;border-color:#ddd">RESULTS</div>
                <div class="panel-body">

              <?php
                $q = $db->prepare('select course, session from results where regno = ?');
                $q->bind_param('s', $id);
                $q->execute();
                $q->store_result();
                $n = $q->num_rows;
              ?>
              <?php if ($n < 1): ?>
                <p class="lead">You have no result at the moment</p>
              <?php else:
                $q->bind_result($c, $s);
              ?>
                <table class="table table-responsive table-hover">
                  <thead>
                    <tr>
                      <th>Course</th>
                      <th>Session</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                <?php while ($q->fetch()): ?>
                    <tr>
                      <td><?php echo $c; ?></td>
                      <td><?php echo $s; ?></td>
                      <td></td>
                      <td><a href="result.php?session=<?php echo $s; ?>&course=<?php echo $c; ?>" target="_blank">View</a></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
              </table>
              <?php endif; ?>
              </div>
            </div>
          </div>
      </div>
    </body>
    <?php include 'footer.php'; ?>
  </html>
<?php else:
  header('Location:logout.php');
  exit;
?>

<?php endif; ?>
