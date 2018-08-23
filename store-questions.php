<?php session_start(); error_reporting(E_ALL); ini_set('display_errors', 'on');?>
<?php if (isset($_SESSION['admin'])):?>

  <?php if (isset($_POST['finish_btn'])):
    include 'db.php';
    include 'head.php';
    include 'admin-nav.php';

    $question = $_POST['question'];
    $id = $_POST['id'];
    $cc = $_POST['cc'];
    $as = $_POST['as'];

    $q0 = $db->prepare('insert into Questions (question, question_id, course, session) values (?, ?, ?, ?)');
    $q0->bind_param('ssss', $question, $id, $cc, $as);
    $q0->execute();
    $q0->close();

    $cop1 = '0';
    $cop2 = '0';
    $cop3 = '0';
    $cop4 = '0';

    if ($_POST['cop'] == "op1") {
      $cop1 = '1';
    }
    $op1 = $_POST['op1'];
    $q = $db->prepare('insert into options (course, session, question_id, question_option, correct) values (?, ?, ?, ?, ?)');
    $q->bind_param('sssss', $cc, $as, $id, $op1, $cop1);
    $q->execute();

    if ($_POST['cop'] == "op2") {
      $cop2 = '1';
    }
    $op2 = $_POST['op2'];
    $q->bind_param('sssss',$cc, $as, $id, $op2, $cop2);
    $q->execute();

    if ($_POST['op3'] != "") {
      if ($_POST['cop'] == "op3") {
        $cop3 = '1';
      }
      $op3 = $_POST['op3'];
      $q->bind_param('sssss', $cc, $as, $id, $op3, $cop3);
      $q->execute();
    }

    if ($_POST['op4'] != "") {
      if ($_POST['cop'] == "op4") {
        $cop4 = '1';
      }
      $op4 = $_POST['op4'];
      $q->bind_param('sssss',$cc, $as, $id, $op4, $cop4);
      $q->execute();
    }
    $q->close();
    $db->close();

  ?>

  <body class="bglight">

    <section class="bglight  borderbottom relative sspacing">
      <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="row">
      <div class="container cus-pos-abs">
        <div class="cover-center-text col-sm-12 col-md-12">
          <form method="post" action="set-exam-dt.php">

            <div class="container">
                <div class="col-md-12 mt30">
                    <label for="reg_number" class="size30 cblue">Set Exam date and time for <?php echo $cc; ?>, <?php echo $as; ?> accademic session exam.</label>
                </div>
                <div class="col-md-3 mt20">
                  <div class="form-group">
                    <label for="date" class="size20">Examination date</label>
                    <input type="date" id="date" class="form-control formlarge input-lg" name="date" placeholder="Start date..." required>
                  </div>
                </div>

                <div class="col-md-3 mt20">
                  <div class="form-group">
                    <label for="date" class="size20">Start time</label>
                    <input type="time" class="form-control formlarge input-lg" name="stime" placeholder="Start time..." required>
                  </div>
                </div>

                <div class="col-md-3 mt20">
                  <div class="form-group">
                    <label for="date" class="size20">Finish time</label>
                    <input type="time" class="form-control formlarge input-lg" value="" name="ftime" placeholder="Finish time..." required>
                  </div>
                </div>

                <input type="hidden" name="cc" value="<?php echo $cc; ?>">
                <input type="hidden" name="as" value="<?php echo $as; ?>">

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="btn" class="">. </label>
                    <button type="submit" class="btn btn-primary size20 form-control formlarge input-lg mt20 col-md-4" id="btn" name="set_btn">Submit</button>
                  </div>
                </div>
                <div >
                  <strong id="msg"></strong>
               </div>
            </div>
        </form>


    </div>
    </div>
    </div>
    </div>
  </section>
      <?php include 'footer.php'; ?>
    </body>
    </html>

  <?php elseif (isset($_POST['cont_btn'])):
    include 'db.php';
    $question = $_POST['question'];
    $id = $_POST['id'];
    $cc = $_POST['cc'];
    $as = $_POST['as'];

    $q0 = $db->prepare('insert into Questions (question, question_id, course, session) values (?, ?, ?, ?)');
    $q0->bind_param('ssss', $question, $id, $cc, $as);
    $q0->execute();
    $q0->close();

    $cop1 = '0';
    $cop2 = '0';
    $cop3 = '0';
    $cop4 = '0';

    if ($_POST['cop'] == "op1") {
      $cop1 = '1';
    }
    $op1 = $_POST['op1'];
    $q = $db->prepare('insert into options (course, session, question_id, question_option, correct) values (?, ?, ?, ?, ?)');
    $q->bind_param('sssss', $cc, $as, $id, $op1, $cop1);
    $q->execute();

    if ($_POST['cop'] == "op2") {
      $cop2 = '1';
    }
    $op2 = $_POST['op2'];
    $q->bind_param('sssss',$cc, $as, $id, $op2, $cop2);
    $q->execute();

    if ($_POST['op3'] != "") {
      if ($_POST['cop'] == "op3") {
        $cop3 = '1';
      }
      $op3 = $_POST['op3'];
      $q->bind_param('sssss', $cc, $as, $id, $op3, $cop3);
      $q->execute();
    }

    if ($_POST['op4'] != "") {
      if ($_POST['cop'] == "op4") {
        $cop4 = '1';
      }
      $op4 = $_POST['op4'];
      $q->bind_param('sssss',$cc, $as, $id, $op4, $cop4);
      $q->execute();
    }
    $q->close();
    $db->close();

    header("Location:set-questions.php?cc=$cc&as=$as");
    exit;
  ?>

  <?php else:
    header('location:set-question.php');
    exit;
  ?>

  <?php endif; ?>

<?php else:
  header('location:logout.php');
  exit;
?>

<?php endif; ?>
