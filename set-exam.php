<?php session_start(); ?>
<?php if (isset($_SESSION['admin'])):
  include 'head.php';
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
        <div class="cover-center-text col-sm-12 col-md-12">
          <form method="get" action="set-questions.php">

            <div class="container">
                <div class="col-md-12 mt30">
                    <label for="reg_number" class="size30 cblue">Enter Course code and Accademic session</label>
                </div>

                <div class="col-md-4 mt20">
                    <input type="text" class="form-control formlarge input-lg" value="" name="cc" placeholder="Course code" required>
                </div>
                <div class="col-md-4 mt20">
                    <input type="text" class="form-control formlarge input-lg" value="" name="as" placeholder="Accademic session" required>
                </div>


                <div class="col-md-4">
                    <button type="submit" class="btn btn-success size20 form-control formlarge mt20 col-md-4 input-lg" id="btn" name="ss_btn">Continue</button>
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
  <?php include 'footer.php'; ?>
  </body>
</html>
<?php else:
  header('Location:logout.php');
  exit;
?>

<?php endif; ?>
