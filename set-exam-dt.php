<?php
  session_start();
  if (isset($_SESSION['admin'])) {
    if (isset($_POST['set_btn'])) {
      include 'db.php';
      $date = $_POST['date'];
      $stime = $_POST['stime'];
      $ftime = $_POST['ftime'];
      $course = $_POST['cc'];
      $session = $_POST['as'];

      $q = $db->prepare('insert into exam_dt (course, session, date, start_time, finish_time) values (?, ?, ?, ?, ?)');
      $q->bind_param('sssss', $course, $session, $date, $stime, $ftime);
      $q->execute();
      $q->close();
      $db->close();
      header("Location:view-paper.php?cc=$course&as=$session");
      exit;
    }
    else {
      header('Location:store-questions.php');
      exit;
    }
  }
  else {
    header('Location:logout.php');
    exit;
  }
?>
