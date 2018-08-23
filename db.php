<?php
  $host = "localhost";
  $username = "root";
  $password = "emmy";
  $dbname = "video";

  $db = new mysqli($host, $username, $password, $dbname);
  $connection_error = $db->connect_error;

  if($connection_error != null){
    echo "<p> Error connecting to database ".$connection_error."</p>";
    exit();
  }
?>
