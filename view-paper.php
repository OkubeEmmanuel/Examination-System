<?php session_start(); ?>
<?php if (isset($_SESSION['admin'])): ?>
  <?php if (isset($_GET['cc']) && isset($_GET['as'])):
    include 'db.php';
    include 'head.php';
    $session = $_GET['as'];
    $course = $_GET['cc'];
    $char = array('a.','b.','c.','d.');

    $q = $db->prepare('select date, start_time, finish_time from exam_dt where session = ? and course = ?');
    $q->bind_param('ss', $session, $course);
    $q->execute();
    $q->bind_result($exam_date, $start_time, $finish_time);
    $q->fetch();
    $q->free_result();
    $q->close();

    $q = $db->prepare('select question, question_id from Questions where session = ? and course = ?');
    $q->bind_param('ss', $session, $course);
    $q->execute();
    $q->bind_result($question, $question_id);
    $q->store_result();
    $n = $q->num_rows;
    $sn = 0;
  ?>
  <body class="bgwhite bglight">

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
          <div class="row">
            <div class="title-font text-center uppercase">
              <h4 class="mb7">Anti Malpractice System (AMES)</h4>
              <h4 class="mb7"><?php echo $session; ?> accademic session examination</h4>
              <h4 class="mb15"><?php echo $course; ?></h4>
            </div>
          </div>
          <hr>
          <div class="bgwhite space10 relative z20"></div>
          <div class="row">
            <div class="col-md-7 col-md-offset-2 titlefont mb0">
              <div class="col-md-4">
                <p class="lead"><b>Date:</b> <?php echo $exam_date; ?></p>
              </div>
              <div class="col-md-4">
                <p class="lead"><b>Start:</b> <?php echo $start_time; ?></p>
              </div>
              <div class="col-md-4">
                <p class="lead"><b>Finish: </b> <?php echo $finish_time; ?></p>
              </div>
            </div>
          </div>
          <hr>

        <div class="col-md-12">
          <form role="form">
            <?php while ($q->fetch()):
              ++$sn;
              $q0 = $db->prepare('select question_option from options where question_id = ?');
              $q0->bind_param('s', $question_id);
              $q0->execute();
              $q0->bind_result($option);
              $alpha = 0;
            ?>
            <div class="row">
              <div class="col-md-1">
                <?php echo $sn ?>
              </div>
              <div class="col-md-11">
                <div class="row">
                  <div class="form-group">
                    <label for="op"><?php echo $question; ?></label>
                      <?php while ($q0->fetch()): ?>
                        <div class="radio" id="op">
                          <label> <span class="mr10"><?php echo $char[$alpha]; ++$alpha; ?></span> <?php echo $option; ?></label>
                        </div>
                      <?php endwhile; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </form>
        </div>

      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
  </body>
</html>
  <?php else:
    header('Location:admin-home.php');
    exit;
  ?>

  <?php endif; ?>

<?php else:
  header('Location:logout.php');
  exit;
?>

<?php endif; ?>
