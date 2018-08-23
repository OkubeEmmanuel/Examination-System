<?php
  session_start();

  if (isset($_SESSION['admin'])) {
    unset($_SESSION['admin']);
  }
  if (isset($_SESSION['student'])) {
    unset($_SESSION['student']);
  }
  session_destroy();
  header('Location:index.php');
  exit;
?>
