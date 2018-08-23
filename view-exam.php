<?php session_start(); error_reporting(E_ALL); ini_set('display_errors', 'on'); ?>
<?php if (isset($_SESSION['admin'])):
  include 'db.php';
  include 'head.php';

  $q = $db->prepare('select course, session, date, start_time, finish_time from exam_dt order by date desc');
  $q->execute();
  $q->store_result();
  $n = $q->num_rows;
?>
  <body class="bgwhite">
  <!-- Navigation -->
  <div ID="navoffset" class="secpage shadow-off bgwhite">
    <div class="navigation dark">
      <div class="container">
        <div class="logo"><a href="./admin-home.php">AMES</a></div>
        <?php include 'admin-nav.php';?>
      </div>
    </div>
  </div>

  <div class="bgwhite space20 relative z20"></div>
  <div class="bgxlight bordertopbottom relative z20">
    <div class="container ptb40 cdark">

      <div class="container">
        <div class="col-md-7">

          <?php if (isset($_SESSION['qas'])):
            $cc = $_GET['cc'];
            $as = $_GET['as'];
          ?>
            <div class="alert alert-info text-center bold uppercase">
              <?php echo $cc; ?> questions for <?php echo $as; ?> accademic session is already set!
            </div>
          <?php endif; unset($_SESSION['qas']);?>

          <?php if ($n > 0):
            $q->bind_result($course, $session, $edate, $st, $ft);
          ?>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Course</th>
                  <th>Session</th>
                  <th>Date</th>
                  <th>Starts</th>
                  <th>Finishes</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
            <?php while ($q->fetch()): ?>
              <tr>
                <td><?php echo $course; ?></td>
                <td><?php echo $session; ?></td>
                <td><?php echo $edate; ?></td>
                <td><?php echo $st; ?></td>
                <td><?php echo $ft; ?></td>
                  <?php if (isset($_SESSION['admin'])): ?>
                    <td><a href="view-paper.php?cc=<?php echo $course; ?>&as=<?php echo $session; ?>">view</a></td>
                  <?php elseif(isset($_SESSION['student'])):
                    $hour = date('h');
                    if (date('a') == "pm") {
                      $hour +=12;
                    }
                    $time = $hour.date(':i:s');
                    $tdate = date('Y-m-d');
                  ?>
                    <?php if ($tdate == $edate): ?>
                      <?php if ( ($time >= $st) && ($time < $ft) ): ?>
                        <td><a href="write-exam.php">write exam</a></td>
                      <?php endif; ?>
                    <?php endif; ?>
                  <?php endif; ?>
              </tr>
            <?php endwhile; ?>
            <?php $q->free_result(); $q->close(); $db->close(); ?>
              </tbody>
            </table>
          <?php else: $q->close(); $db->close();?>
            <h1>No exam has been set yet.</h1>
          <?php endif; ?>
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
