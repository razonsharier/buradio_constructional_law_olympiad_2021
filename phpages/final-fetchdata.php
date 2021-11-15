<?php
session_start();
?>

<?php
include '../php/db.php';

if (isset($_SESSION['checkpgck'])) {

 $mobile   = mysqli_real_escape_string($db, $_SESSION['regmobile']);
 $password = mysqli_real_escape_string($db, $_SESSION['regpass']);

 $query     = "SELECT * FROM final_quiz ORDER BY RAND() LIMIT 5";
 $query_run = mysqli_query($db, $query);

 $sqlds    = "UPDATE reg SET status ='dis' WHERE mobile = '$mobile' AND pass = '$password'";
 $resultds = mysqli_query($db, $sqlds);

 date_default_timezone_set('Asia/Dhaka');
 $timestamp  = date('G:i:s A');
 $sqlqsrt    = "UPDATE reg SET questart2 = '$timestamp' WHERE mobile = '$mobile' AND pass = '$password'";
 $resultqsrt = mysqli_query($db, $sqlqsrt);

 if ($query_run) {
  while ($row = mysqli_fetch_array($query_run, MYSQLI_ASSOC)) {

   echo "<h4>";
   echo "<a>" . @$snr += 1;"</a>";
   echo "<a>. $row[que]</a>";
   echo "</h4>";
   echo "<ul>";
   echo "<li><input type=radio value=1 name=$row[userans]>$row[option1]</li>";
   echo "<li><input type=radio value=2 name=$row[userans]>$row[option2]</li>";
   echo "<li><input type=radio value=3 name=$row[userans]>$row[option3]</li>";
   echo "<li><input type=radio value=4 name=$row[userans]>$row[option4]</li>";
   echo "</ul>";
  }
 } else {
  echo "Error!";
 }

} else {
 echo "congratulations!";
}

unset($_SESSION["checkpgck"]);
