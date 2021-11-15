
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php

header('Cache-control: no-cache, must-revalidate, max-age=0');

if (empty($_SESSION['regmobile']) && empty($_SESSION['regpass'])) {
 $_SESSION["error_login"] = "প্রথমে লগইন করুন!";
 echo "<script type='text/javascript'> document.location = 'login'; </script>";
 exit;
}

require 'php/db.php';

//update scoreboard
$sqltm    = "SELECT * FROM reg t1 INNER JOIN rank t2 ON t1.userid = t2.userid";
$resulttm = mysqli_query($db, $sqltm);
$counttm  = mysqli_num_rows($resulttm);
while ($rowtm = mysqli_fetch_array($resulttm, MYSQLI_ASSOC)) {
 if ($rowtm['userid'] == $rowtm['userid']) {
  $uid        = $rowtm['userid'];
  $marks1     = $rowtm["marks1"];
  $marks2     = $rowtm["marks2"];
  $marks3     = $rowtm["marks3"];
  $totalmarks = ($marks1 + $marks2 + $marks3);
  $tmqury     = "UPDATE rank SET totalmarks = '$totalmarks' WHERE userid = $uid";
  mysqli_query($db, $tmqury);
 }
}

$mobile   = mysqli_real_escape_string($db, $_SESSION['regmobile']);
$password = mysqli_real_escape_string($db, $_SESSION['regpass']);

$sqlck    = "SELECT * FROM reg WHERE mobile = '$mobile' AND pass = '$password'";
$resultck = mysqli_query($db, $sqlck);
$rowck    = mysqli_fetch_array($resultck, MYSQLI_ASSOC);
if ("dis" == $rowck['step1']) {
 echo "<script type='text/javascript'> document.location = 'dismis'; </script>";
 exit;
}
if ("dis" == $rowck['status']) {
 echo "<script type='text/javascript'> document.location = 'dismis'; </script>";
 exit;
}
/*
if ("pass" == $rowck['step1']) {
 echo "<script type='text/javascript'> document.location = 'final-round'; </script>";
 exit;
}
*/

$sql    = "SELECT * FROM reg WHERE mobile = '$mobile' AND pass = '$password'";
$result = mysqli_query($db, $sql);
$count  = mysqli_num_rows($result);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

$sqlcksw    = "SELECT * FROM settings WHERE sw_type = 'result_publish'";
$resultcksw = mysqli_query($db, $sqlcksw);
$rowcksw    = mysqli_fetch_array($resultcksw, MYSQLI_ASSOC);

/*
if (isset($row["step1"])) {
    if ("off" == $rowcksw["switch"]) {
        $sw_control_on = "display: none";
       } else {
        $sw_control_off = "display: none";
       }
   }
*/

 //access code
 $useridac = $row['userid'];
 unset($_SESSION["secondpage"]);
 $_SESSION["firstpage"] = "$useridac";

 if ("pass" == $row["step1"]) {
  $_SESSION['step1']    = "pass";
  $_SESSION["step1ini"] = "display: none";
 } elseif ("fail" == $row["step1"]) {
  $_SESSION['step11']   = "fail";
  $_SESSION["step1ini"] = "display: none";
 } else {
  echo $tx = "";
  unset($_SESSION["step1ini"]);
  unset($_SESSION["step1"]);
  unset($_SESSION["step11"]);
 }

 if (empty($_SESSION['step1'])) {
  $_SESSION["step1"] = "display: none";
 }

 if ("fail" == $row["step1"]) {
  $_SESSION['step11']   = "fail";
  $_SESSION["step1"]    = "display: none";
  $_SESSION["step1ini"] = "display: none";
 } else {
  echo $tx = "";
  unset($_SESSION["step11"]);
 }

 if (empty($_SESSION['step11'])) {
  $_SESSION["step11"] = "display: none";
 }

 if (empty($_SESSION['step1ini'])) {
    $_SESSION["step1inihid"] = "display: none";
   } else {
    unset($_SESSION["step1inihid"]);
   }

 ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - 1st National Constructional Law Olympiad (AG + BURADiO)</title>
    <?php
    require ('php/og-tags.php');
    ?>
    <link rel="shortcut icon" href="media/logo2.png">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            margin: 0;
        }
    </style>
</head>

<body>
    <div id="bodycontainer">
        <!-- body container to centralize elements-->
        <div id="header">
            <!-- header nav bar -->
            <div id="navmenu">
                <div class="left">
                    <a href="home"><img class="logo" src="media/logo.jpg"></a>
                </div>
                <div class="right">
                    <a class="outbutton" href="logout">লগআউট করুন</a>
                </div>
            </div>
        </div>
        <div id="userdtls">
            <p style="font-size: 16px;"><strong><?php echo $row['name']; ?></strong></p>
            <p style="font-size: 14px;"><?php echo $row['mobile']; ?></p>
            <p style="font-size: 14px;"><?php echo $row['email']; ?></p>
        </div>
        <div id="navitem">
            <ul>
                <li><a class="liactive" href="dashboard">১ম রাউন্ড</a></li>
                <li><a href="final-round">২য় রাউন্ড</a></li>
            </ul>
        </div>
        <div id="containbody">
            <div id="quizbody">

                <div style="<?php echo $_SESSION['step1inihid']; ?>">
                    <p style="margin-top: 10px;">
                        <b>আপনার প্রিলিমিনারি রাউন্ড সফলভাবে সম্পন্ন হয়েছে।</b><br /><br /><br/>
                        ফলাফল জানতে চোখ রাখুন <a href="https://www.facebook.com/buradio.org" target="_blank">BU RADiO</a> এবং <a href="https://www.facebook.com/AmicusGuild.BD" target="_blank">Amicus Guild</a> এর ফেইসবুক পেইজে আজ রাত ১২টার মধ্যে।
                    </p>
                </div>



                <p style="display: none;"><u>১লা নভেম্বর, রাত ০৯ঃ০০ টায়</u> অলিম্পিয়াডের প্রথম রাউন্ডের কুইজ অনুষ্ঠিত হবে।</p>
                <p style="display: none;">প্রথম রাউন্ডের কুইজে অংশগ্রহনের সময়সীমা শেষ হয়েছে।</p>
                <div style="display: none;">
                    <div style="<?php echo $_SESSION['step1ini']; ?>">
                        <p>কুইজ পর্বে অংশগ্রহন করতে নিচের বাটনে ক্লিক করুন।</p>
                        <br /><br />
                        <a class="quizbutton" href="quiz">কুইজে প্রবেশ
                            করুন!</a>
                        <p style="color:red;">(কুইজের সতর্কতা গুলো ভালো ভাবে পড়ে
                            দেখবেন)
                        </p>
                    </div>
                </div>


            </div>
        </div>

    </div>
    <?php
}
?>
</body>

</html>