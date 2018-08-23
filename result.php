<?php session_start(); error_reporting(E_ALL); ini_set('display_errors', 'on');?>
<?php if (isset($_SESSION['student'])): ?>

  <?php if (isset($_GET['session']) && isset($_GET['course'])):
    include 'db.php';
    include 'head.php';

    $regno = $_SESSION['student'];
    $course = $_GET['course'];
    $session = $_GET['session'];
    $q = $db->prepare('select score, ta, tq from results where course = ? and session = ? and regno = ?');
    $q->bind_param('sss', $course, $session, $regno);
    $q->execute();
    $q->store_result();
    $n = $q->num_rows;
  ?>
  <body class="bgwhite">

  <!-- Navigation -->

  <div class="bgwhite space10 relative z20"></div>
    <div class="bgxlight bordertopbottom relative z20">
    <div class="container ptb40 cdark">
      <div class="container">
        <div class="col-md-12">
          <div class="col-md-10">
            <div class="row">
              <div class="title-font text-center uppercase">
                <h4 class="mb7">Anti Malpractice System (AMES)</h4>
                <h4 class="mb7"><?php echo $session; ?> accademic session result</h4>
                <h4 class="mb15"></h4>
              </div>
            </div>
              <hr>
              <div class="bgwhite space10 relative z20"></div>
            <div class="row">
                <?php if ($n > 0):
                  $q->bind_result($score, $qa, $tq);
                  $q->fetch();
                  $q->close();

                  $q = $db->prepare('select name, phone, image from student where matric_no = ?');
                  $q->bind_param('s', $regno);
                  $q->execute();
                  $q->bind_result($name, $phone, $image);
                  $q->fetch();
                  $q->close();
                ?>
                <div class="row">
                  <div class="col-md-8">
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="2" class="title-font uppercase bold">Student details</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th class="uppercase">Name</th>
                          <td><?php echo $name; ?></td>
                        </tr>
                        <tr>
                          <th class="uppercase">Matriculation number</th>
                          <td><?php echo $regno; ?></td>
                        </tr>
                        <tr>
                          <th class="uppercase">phone number</th>
                          <td><?php echo $phone; ?></td>
                        </tr>
                      </tbody>
                    </table>
                    <hr>
                  </div>

                    <?php if ($image != "dummy"): ?>
                      <div class="col-md-2 col-md-offset-2  pull-left">
                        <img src="./students/<?php echo $image; ?>" alt="<?php echo $name; ?>" class="img-thumbnail img-responsive">
                      </div>
                    <?php endif; ?>
                </div>
                <div class="space20"></div>
                <div class="row">
                  <div class="col-md-7">
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th colspan="2" class="title-font uppercase bold ml40">result</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th class="uppercase">Course</th>
                          <td><?php echo $course; ?></td>
                        </tr>
                        <tr>
                          <th class="uppercase">Number of questions</th>
                          <td><?php echo $tq; ?></td>
                        </tr>
                        <tr>
                          <th class="uppercase">Number of attempts</th>
                          <td><?php echo $qa; ?></td>
                        </tr>

                        <tr>
                          <th class="uppercase">Score</th>
                          <td><?php echo $score; ?></td>
                        </tr>
                      </tbody>
                    </table>
                    <hr>
                  </div>
                </div>

                <?php else: $q->close(); ?>
                  <div class="prlx-on tp-caption georgia size60 ls-1 bold customout tp-resizeme text-center">
                     Result not found.
                  </div>
                <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <?php include 'footer.php'; ?>
  </body>
  <?php else:
    header('Location:student-home.php');
    exit;
  ?>

  <?php endif; ?>

<?php else:
  header('Location:student-home.php');
  exit;
?>

<?php endif; ?>
