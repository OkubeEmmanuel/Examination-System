<?php session_start(); ?>
<?php if (isset($_SESSION['admin'])): ?>
  <?php if ( (isset($_GET['cc']) && isset($_GET['as'])) ):
    include 'db.php';
    $cc = $_GET['cc'];
    $as = $_GET['as'];
    $q0 = $db->prepare('select id from exam_dt where session = ? and course = ?');
    $q0->bind_param('ss', $as, $cc);
    $q0->execute();
    $q0->store_result();
    $n = $q0->num_rows;

    if ($n > 0) {
      $_SESSION['qas'] = 1;
      $q0->close();
      $db->close();
      header("Location:view-exam.php?as=$as&cc=$cc");
      exit;
    }
    include 'head.php';
    $q = $db->prepare('select count(question) from Questions where course = ? and session = ?');
    $q->bind_param('ss', $cc, $as);
    $q->execute();
    $q->bind_result($n);
    $q->fetch();
    $q->close();
    $db->close();
    ++$n;
    $cc2 = preg_replace('/\s+/', '', $cc);
    $id = $cc2.$n;
  ?>
  <body class="bgwhite">
    <!-- Navigation -->
    <div ID="navoffset" class="secpage shadow-off bgwhite">
      <div class="navigation dark">
        <div class="container">
          <div class="logo"><a href="admin-home.php">NAITES</a></div>
          <?php include 'admin-nav.php';?>
        </div>
      </div>
    </div>

    <div class="bgwhite space20 relative z20"></div>
    <div class="bgxlight bordertopbottom relative z20">
      <div class="container ptb40 cdark">

        <div class="container">
        <div class="cover-center-text col-sm-12 col-md-12">
          <form method="post" action="store-questions.php">

            <div class="container">
                <div class="col-md-12 mt30">
                    <label for="reg_number" class="size30 cblue">Enter question <?php echo $n; ?> and its options</label>
                </div>
                <div class="col-md-12 mt20">
                    <textarea name="question" rows="4" placeholder="Enter Question..." class="form-control formlarge" autofocus></textarea>
                </div>
                <div class="col-md-3 mt20">
                    <input type="text" class="form-control formlarge input-lg" name="op1" placeholder="Enter option 1..." required>
                </div>
                <div class="col-md-3 mt20">
                    <input type="text" class="form-control formlarge input-lg" name="op2" placeholder="Enter option 2..." required>
                </div>
                <div class="col-md-3 mt20">
                    <input type="text" class="form-control formlarge input-lg" value="" name="op3" placeholder="Enter option 3...">
                </div>
                <div class="col-md-3 mt20">
                    <input type="text" class="form-control formlarge input-lg" value="" name="op4" placeholder="Enter option 4...">
                </div>

                <input type="hidden" name="cc" value="<?php echo $cc; ?>">
                <input type="hidden" name="as" value="<?php echo $as; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="col-md-6 mt20">
                  <div class="form-group">
                    <label for="cop">Pick the correct option.</label><br>
                    <label class="radio-inline" id="cop">
                      <input type="radio" name="cop" required value="op1">Option 1
                    </label>
                    <label class="radio-inline" id="cop">
                      <input type="radio" name="cop" required value="op2">Option 2
                    </label>
                    <label class="radio-inline" id="cop">
                      <input type="radio" name="cop" required value="op3">Option 3
                    </label>
                    <label class="radio-inline" id="cop">
                      <input type="radio" name="cop" required value="op4">Option 4
                    </label>
                  </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-success size20 form-control formlarge input-lg mt20 col-md-4" id="btn" name="cont_btn">Continue</button>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary size20 form-control formlarge input-lg mt20 col-md-4" id="btn" name="finish_btn">Finish</button>
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
  <?php else:
    header('Location:set-exam.php');
    exit;
  ?>

  <?php endif; ?>

<?php else:
  header('Location:logout.php');
  exit;
?>

<?php endif; ?>
