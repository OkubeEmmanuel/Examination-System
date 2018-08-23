<?php session_start(); error_reporting(E_ALL); ini_set('display_errors', 'on');?>
<?php if (isset($_SESSION['admin'])):
  include 'db.php';
  include 'head.php';

  $q = $db->prepare('select distinct session, course from results order by session desc');
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
          <?php if ($n > 0):
            $q->bind_result($session, $course);
          ?>
            <table class="table table-hover">
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
                <td><?php echo $course; ?></td>
                <td><?php echo $session; ?></td>
                <td><a href="view-students-performance.php?cc=<?php echo $course; ?>&as=<?php echo $session; ?>">View</a></td>
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
