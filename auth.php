<?php
  session_start();
  if (isset($_SESSION['admin'])) {
    header('Location:admin-home.php');
    exit;
  }
  elseif (isset($_SESSION['student'])) {
    header('Location:student-home.php');
    exit;
  }
  elseif (isset($_POST['login_btn'])) {
    include 'db.php';
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $q = $db->prepare('select password from Admin where username = ?');
    $q->bind_param('s', $username);
    $q->execute();
    $q->store_result();
    $n = $q->num_rows;
    if ($n < 1) {
      $q->free_result();
      $q->close();

      $q1 = $db->prepare('select password from student where matric_no = ?');
      $q1->bind_param('s', $username);
      $q1->execute();
      $q1->store_result();
      $n = $q1->num_rows;
      if ($n < 1) {
        $q1->close();
        $db->close();
        $_SESSION['wu'] = 1;
        header('Location:index.php?');
        exit;
      }
      else {
        $q1->bind_result($pwd);
        $q1->fetch();
        $q1->close();
        if ($password == $pwd) {
          $db->close();
          $_SESSION['student'] = $username;
          header('Location:student-home.php');
          exit;
        }
        else {
          $db->close();
          $_SESSION['wp'] = 1;
          header('Location:index.php?');
          exit;
        }
      }
    }
    else {
      $q->bind_result($pwd);
      $q->fetch();
      $q->close();
      if ($password == $pwd) {
        $db->close();
        $_SESSION['admin'] = 1;
        header('Location:admin-home.php');
        exit;
      }
      else {
        $db->close();
        $_SESSION['wp'] = 1;
        header('Location:index.php?n=2');
        exit;
      }
    }
  }
  else {
    header('Location:index.php?n=1');
    exit;
  }
?>
