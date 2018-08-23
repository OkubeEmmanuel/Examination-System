<?php
  session_start();
  if (isset($_SESSION['admin'])) {
    if (isset($_POST['reg_btn'])) {
      include 'db.php';
      $matric_no = $_POST['matric_no'];
      $q0 = $db->prepare('select id from student where matric_no = ?');
      $q0->bind_param('s',$matric_no);
      $q0->execute();
      $q0->store_result();
      $n = $q0->num_rows;
      if ($n > 0) {
        $_SESSION['rnae'] = 1;
        header('Location:register-student.php');
        exit;
      }

      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $password = sha1($matric_no);

      $q = $db->prepare('insert into student (name, matric_no, phone, password) values (?, ?, ?, ?)');
      $q->bind_param('ssss', $name, $matric_no, $phone, $password);
      $q->execute();
      $q->close();
      $db->close();
      $_SESSION['rs'] = 1;
      header('Location:view-students.php');
      exit;
    }
    else {
      header('Location:register-student.php');
      exit;
    }
  }
  else {
    header('Location:logout.php');
    exit;
  }
?>
