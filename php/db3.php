<?php
error_reporting(0);

$db = mysqli_connect("localhost", "buradioo_admin2", "[4*i.-4&.~~D", "buradioo_constructional_law_olympiad");
mysqli_set_charset($db, 'utf8');
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>