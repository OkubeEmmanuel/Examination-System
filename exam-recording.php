<?php session_start(); ?>
<?php if (isset($_SESSION['admin'])): ?>
  <?php if ( (isset($_GET['videoid'])) && ((isset($_GET['studentname']))) && (isset($_GET['cc'])) && (isset($_GET['as'])) ):
    include 'head.php';
    $video_filename = $_GET['videoid'];
    $name = $_GET['studentname'];
    $course = $_GET['cc'];
    $session = $_GET['as'];
    $session = $_GET['as'];
  ?>

  <body class="bgwhite">
  <!-- Navigation -->
  <div class="bgwhite space20 relative z20"></div>
  <div class="bgxlight bordertopbottom relative z20">
    <div class="container ptb40 cdark">
      <div class="container">
        <p class="title-font size20"><i><?php echo "$name recording during $course examination, $session"; ?> accademic session.</i></p>
        <div class="row">
          <div class="col-md-7 col-md-offset-2 mt0">
            <video class="embed-responsive-item" controls autoplay>
              <source src="exam-videos/<?php echo $video_filename; ?>" type="video/webm">
              Your browser does not support HTML5 video.
            </video>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
  </body>
</html>

  <?php else:
    $url = $_SERVER['HTTP_REFERER'];
    header("$url");
    exit;
  ?>

  <?php endif; ?>

<?php else:
  header('Location:logout.php');
  exit;
?>

<?php endif; ?>
