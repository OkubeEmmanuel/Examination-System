<?php session_start(); ?>
<?php if (isset($_SESSION['student'])):?>
  <?php if (isset($_GET['cc']) && isset($_GET['as'])):
    include 'db.php';

    $course = $_GET['cc'];
    $session = $_GET['as'];
    $q = $db->prepare('select date, start_time, finish_time from exam_dt where session = ? and course = ?');
    $q->bind_param('ss', $session, $course);
    $q->execute();
    $q->bind_result($date, $st, $ft);
    $q->fetch();
    $q->close();
    ?>

    <?php if ( ($date == date('Y-m-d')) && ( (strtotime(date('h:i:sa')) >= strtotime($st)) && (strtotime(date('h:i:sa')) <= strtotime($ft))) ):
      include 'head.php';
      $q = $db->prepare('select question, question_id from Questions where session = ? and course = ?');
      $q->bind_param('ss', $session, $course);
      $q->execute();
      $q->store_result();
      $q->bind_result($question, $qid);
      $td = date('d/m/Y');

      //Timing stuff
      $mon = array('Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
      $m = $mon[(date('m')-1)];
      $fnt = $m.' '.date('d, Y ').$ft;
    ?>
    <body class="bgwhite bglight">
      <script type="text/javascript" src="js/RecordRTC.js"></script>

    <!-- Navigation -->

    <div class="bgwhite space10 relative z20"></div>
      <div class="bgxlight bordertopbottom relative z20">
      <div class="container ptb40 cdark">
        <div class="container">
          <div class="col-md-12">
            <div class="col-md-10">
              <div class="row">
                <div class="title-font text-center uppercase">
                  <h4 class="mb7">nigerian army institute of technology and environmental studies (NAITES)</h4>
                  <h4 class="mb7"><?php echo $session; ?> accademic session examination</h4>
                  <h4 class="mb15"><?php echo $course; ?></h4>
                </div>
              </div>
                <hr>
                <div class="bgwhite space10 relative z20"></div>
                <div class="row">
                  <div class="col-md-8 col-md-offset-2 titlefont mb0">
                    <div class="col-md-4">
                      <p class="lead"><b>Date:</b> <?php echo $td; ?></p>
                    </div>
                    <div class="col-md-4">
                      <p class="lead"><b>Start:</b> <?php echo $st; ?></p>
                    </div>
                    <div class="col-md-4">
                      <p class="lead"><b>Finish: </b> <?php echo $ft; ?></p>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="col-md-12">
                  <form role="form" id="myForm" action="submit-exam.php" method="post">
                    <?php while ($q->fetch()):
                      ++$sn;
                      $q0 = $db->prepare('select question_option from options where question_id = ?');
                      $q0->bind_param('s', $qid);
                      $q0->execute();
                      $q0->bind_result($option);
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
                                  <label><input type="radio" name="<?php echo $qid; ?>" value="<?php echo $option; ?>"><?php echo $option; ?></label>
                                </div>
                              <?php endwhile; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endwhile; ?>
                  <?php
                    $id = $_SESSION['student'];
                    $cc = preg_replace('/\s+/', '', $course);
                    $name = $id.$cc.date('Ymd').'.'.'webm';
                  ?>
                  <input type="hidden" name="course" value="<?php echo $course; ?>">
                  <input type="hidden" name="session" value="<?php echo $session; ?>">
                  <input type="hidden" name="se" value="1">
                  <input type="hidden" name="video-filename" value="<?php echo $name; ?>">
                  <div class="col-md-3 col-md-offset-1 mt20">
                    <button type="submit" name="sbex" class="btn btn-primary btn-lg disable">SUBMIT</button>
                  </div>
                </form>
                </div>
            </div>
            <div class="col-md-2"  style="position:fixed;	top:2; right: 0;">
              <div class="row">
                <div>
                  <button data-toggle="collapse" data-target="#demo" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-time"></span></button>
                </div>
                <div id="demo" class="collapse lead size25 bold cmaincolor">

                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include 'footer.php'; ?>

    <script>
      // Set the date we're counting down to
      var countDownDate = new Date("<?php echo $fnt; ?>").getTime();

      // Update the count down every 1 second
      var x = setInterval(function() {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = hours + "h "
        + minutes + "m " + seconds + "s ";

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "Stop writing";
        }
      }, 1000);
    </script>

    <script type="text/javascript">
    // Set the date we're counting down to
    var countDown = new Date("<?php echo $fnt; ?>").getTime();

      // Get todays date and time
      var no = new Date().getTime();

      // Find the distance between now an the count down date
      var dis = countDown - no;

      // Time calculations for days, hours, minutes and seconds
      var h = Math.floor((dis % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var m = Math.floor((dis % (1000 * 60 * 60)) / (1000 * 60));
      var s = Math.floor((dis % (1000 * 60)) / 1000);

      var videoLength = (h * 60 * 60 * 1000)+(m * 60 * 1000) + (s * 1000);
      var mediaConstraints = {
          audio: true,
          video: true
      };

      // capture camera and/or microphone
            navigator.mediaDevices.getUserMedia(mediaConstraints).then(function(camera) {

                // recording configuration/hints/parameters
                var recordingHints = {
                    type: 'video'
                };

                // initiating the recorder
                var recorder = RecordRTC(camera, recordingHints);

                // starting recording here
                recorder.startRecording();

                // auto stop recording after exam time elapses.

                setTimeout(function() {

                  // stop recording
                  recorder.stopRecording(function() {

                      // get recorded blob
                      var blob = recorder.getBlob();

                      // generating file name
                      var fileName = getFileName(<?php echo "'$name'"; ?>);

                      // we need to upload "File" --- not "Blob"
                      var fileObject = new File([blob], fileName, {
                          type: 'video/webm'
                      });

                      uploadToPHPServer(fileObject, function(response, fileDownloadURL) {
                          if(response == 'ended') {
                              alert('Time Up.');
                              myForm.submit();
                          }
                          else {
                            return;
                          }
                      });

                      // release camera
                      camera.getTracks().forEach(function(track) {
                          track.stop();
                      });

                    });

                }, videoLength);
            });

            function uploadToPHPServer(blob, callback) {
                // create FormData
                var formData = new FormData();
                formData.append('video-filename', blob.name);
                formData.append('video-blob', blob);
                callback('Uploading recorded-file to server.');
                makeXMLHttpRequest('save.php', formData, function(progress) {
                    if (progress !== 'upload-ended') {
                        callback(progress);
                        return;
                    }
                    var initialURL = 'recorder/exam-videos/' + blob.name;
                    callback('ended', initialURL);
                });
            }

            function makeXMLHttpRequest(url, data, callback) {
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() {
                    if (request.readyState == 4 && request.status == 200) {
                        if (request.responseText === 'success') {
                            callback('upload-ended');
                            return;
                        }
                        alert(request.responseText);
                        return;
                    }
                };
                request.upload.onloadstart = function() {
                    callback('PHP upload started...');
                };
                request.upload.onprogress = function(event) {
                    callback('PHP upload Progress ' + Math.round(event.loaded / event.total * 100) + "%");
                };
                request.upload.onload = function() {
                    callback('progress-about-to-end');
                };
                request.upload.onload = function() {
                    callback('PHP upload ended. Getting file URL.');
                };
                request.upload.onerror = function(error) {
                    callback('PHP upload failed.');
                };
                request.upload.onabort = function(error) {
                    callback('PHP upload aborted.');
                };
                request.open('POST', url);
                request.send(data);
            }

            // this function is used to generate random file name
            function getFileName(name) {
                return name;
            }
    </script>
    </body>
  </html>
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

<?php else:
  header('Location:logout.php');
  exit;
?>

<?php endif; ?>
