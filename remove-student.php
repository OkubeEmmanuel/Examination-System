<?php
  session_start();
  if ( ( isset($_SESSION['admin']) ) && ( isset($_GET['studentid']) ) ) {
    include 'db.php';
    $id = $_GET['studentid'];
    $q = $db->prepare('delete from student where matric_no = ?');
    $q->bind_param('s', $id);
    $q->execute();
    $_SESSION['ssr'] = 1;
    $q->close();
    $db->close();
    header('Location:view-students.php');
    exit;
  }
  else {
    header('Location:logout.php');
    exit;
  }
?>
