<?php session_start(); ?>
<?php if (isset($_SESSION['admin'])): ?>
  <?php if (isset($_GET['cc']) && isset($_GET['as'])):
    include 'db.php';
    include 'head.php';
    $course = $_GET['cc'];
    $session = $_GET['as'];
    $q = $db->prepare('select regno, score, ta, video from results where course = ? and session = ?');
    $q->bind_param('ss', $course, $session);
    $q->execute();
    $q->store_result();
    $n = $q->num_rows;
  ?>

  <body class="bgwhite">
    <script type="text/javascript" src="./js/confirm-delete.js"></script>
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
        <p class="title-font size20 uppercase mb15"><?php echo $course; ?> result <?php echo $session; ?> accademic session.</p>
  <?php if ($n > 0):
    $q->bind_result($regno, $score, $noa, $video_filename);
    $x = 1;
  ?>
  <table class="table table-hover table-bordered">
    <thead>
      <th>Sn</th>
      <th>Matriculation number</th>
      <th>Name</th>
      <th>Phone number</th>
      <th>Attempts</th>
      <th>Score</th>
      <th></th>
    </thead>
    <tbody>
    <?php while ($q->fetch()):
      $q0 = $db->prepare('select name, phone from student where matric_no = ?');
      $q0->bind_param('s', $regno);
      $q0->execute();
      $q0->bind_result($name, $phone);
      $q0->fetch();
      $q0->free_result();
      $q0->close();
    ?>
      <tr>
        <td><?php echo $x; ++$x;?></td>
        <td><?php echo $regno; ?></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $phone; ?></td>
        <td><?php echo $noa; ?></td>
        <td><?php echo $score; ?></td>
        <td><a href="exam-recording.php?videoid=<?php echo "$video_filename&studentname=$name&cc=$course&as=$session";?>" target="_blank">Watch recording</a></td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
  <?php else: ?>
      <h2 class="text-center uppercase bold size30 mt40">There are no results on this course yet.</h2>
  <?php endif; ?>
  <?php $q->free_result(); $q->close(); $db->close(); ?>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
  </body>
</html>

  <?php else:
    header('Location:view-results.php');
    exit;
  ?>

  <?php endif; ?>

<?php else:
  header('Location:logout.php');
  exit;
?>

<?php endif; ?>
