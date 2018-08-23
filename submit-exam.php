<?php
  session_start();
  error_reporting(E_ALL); ini_set('display_errors', 'on');

  if (isset($_SESSION['student'])) {
    if (isset($_POST['sbex']) || isset($_POST['se'])) {
      include 'db.php';
      $session = $_POST['session'];
      $course = $_POST['course'];
      $regno = $_SESSION['student'];
      $fileName = $_POST['video-filename'];

      $q = $db->prepare('select question_id from Questions where course = ? and session = ?');
      $q->bind_param('ss', $course, $session);
      $q->execute();
      $q->store_result();
      $tq = $q->num_rows;
      $q->bind_result($qid);

      $qa = 0;
      $score = 0;

      while ($q->fetch()) {
        if (isset($_POST["$qid"])) {
          ++$qa;
          $q0 = $db->prepare('select question_option from options where correct = ? and question_id = ? and course = ? and session = ?');
          $status = '1';
          $q0->bind_param('ssss', $status, $qid, $course, $session);
          $q0->execute();
          $q0->bind_result($cop);
          $q0->fetch();
          $q0->free_result();
          $q0->close();

          if ($_POST["$qid"] == $cop) {
            ++$score;
          }
        }
      }
      $q->close();

      $filePath = 'exam-videos/' . $fileName;

      // make sure that one can upload only allowed audio/video files
      $allowed = array(
          'webm',
          'wav',
          'mp4',
          'mp3',
          'ogg'
      );

      $q = $db->prepare('insert into results (regno, session, course, score, tq, ta, video) values (?, ?, ?, ?, ?, ?, ?)');

      $q->bind_param('sssssss', $regno, $session, $course, $score, $tq, $qa, $fileName);
      if (!$q->execute()) {
        echo "$q->error<br>";
        echo "$db->error";
        exit;
      };
      $q->close();
      $db->close();
      header("Location:result.php?course=$course&session=$session");
      exit;
    }
    else {
      header('Location:student-home.php?fns=1');
      exit;
    }
  }
  else {
    header('Location:logout.php');
    exit;
  }

?>
