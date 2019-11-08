<?php
  session_start();
  $imagetocpy = $_POST['id'];
  copy($imagetocpy, "../images/profiles/" . $_SESSION['flag'] . ".png");
  header("Location: ./profile.php")
?>