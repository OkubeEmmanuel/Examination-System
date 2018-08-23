<?php
  session_start();
   error_reporting(E_ALL); ini_set('display_errors', 'on');
  if (isset($_SESSION['student'])) {
    if (isset($_POST['edit-btn'])) {
      include 'db.php';

      $name = $_POST['name'];
      $phn = $_POST['phone'];
      $matno = $_POST['matric_no'];

      if ($_FILES['image']['error'] == 0) {
        if ( (($_FILES['image']['type'] != 'image/png') && ($_FILES['image']['type'] != 'image/jpg') && ($_FILES['image']['type'] != 'image/jpeg') && ($_FILES['image']['type'] != 'JPG') ) ) {
          //Do something like setting a session to alert the user that he/she has to fill every field in the form correctly.
          $_SESSION['wf'] = 1;
          header('Location:edit-student-profile.php');
          exit;
        }
        else {
          $imageType = $_FILES['image']['type'];
          $image = $_FILES['image']['tmp_name'];
          if ($imageType == 'image/jpg' || $imageType == 'image/jpeg' || $imageType == 'image/JPG') {
            $imageType = 'jpg';
          }
          elseif ($imageType == 'image/png') {
            $imageType = 'png';
          }
          $imageName = $matno.".".$imageType;
          $loc = "students/".$imageName;
          
          if (move_uploaded_file($image, $loc)) {
            $q = $db->prepare('update student set name = ?, phone = ?, image = ? where matric_no = ?');
            $q->bind_param('ssss', $name, $phn, $imageName, $matno);
            $q->execute();
            $q->close();
            $db->close();
            header('Location:student-home.php');
            exit;
          }
        }
      }
       else {
        $q = $db->prepare('update student set name = ?, phone = ? where matric_no = ?');
        $q->bind_param('sss', $name, $phn, $matno);
        $q->execute();
        $q->close();
        $db->close();
        header('Location:student-home.php');
        exit;
      }
    }
    else {
      header('Location:student-home.php');
      exit;
    }
  }
  else {
    header('Location:logout.php');
    exit;
  }

?>
