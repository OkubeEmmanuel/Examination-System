<?php
  session_start();
  if (isset($_SESSION['admin'])) {
    if (isset($_POST['edit_btn'])) {
      include 'db.php';
      $id = $_GET['id'];
      $name = $_POST['name'];
      $matric_no = $_POST['matric_no'];
      $phone = $_POST['phone'];
      $password = md5($matric_no);
      $id = $_POST['id'];
      $q0 = $db->prepare('select * from student where matric_no = ?');
      $q0->bind_param('s', $matric_no);
      $q0->execute();
      $q0->store_result();
      $n = $q0->num_rows;
      if ($n > 0) {
        $_SESSION['mnae'] = 1;
        header("Location:edit-student.php?id=$id");
        exit;
      }
      $q = $db->prepare('update student set name = ?, matric_no = ?, phone = ?, password = ? where matric_no = ?');
      $q->bind_param('sssss', $name, $matric_no, $phone, $password, $id);
      $q->execute();
      $q->close();
      $db->close();
      $_SESSION['us'] = 1;
      header('Location:view-students.php');
      exit;
    }
    else {
      header('Location:view-students.php');
      exit;
    }
  }
  else {
    header('Location:logout.php');
    exit;
  }
?>
