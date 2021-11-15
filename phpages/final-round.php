<?php
@$go = $_REQUEST['go'];
if (empty($go)) {
    header('Location: final-round');
    exit;
}
?>

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

require('php/db.php');
$mobile = mysqli_real_escape_string($db, $_SESSION['regmobile']);
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

if ("" == $rowck['step1']) {
 echo "<script type='text/javascript'> document.location = 'dashboard'; </script>";
 exit;
}

if ("fail" == $rowck['step1']) {
 echo "<script type='text/javascript'> document.location = 'dashboard'; </script>";
 exit;
}

$sql = "SELECT * FROM reg WHERE mobile = '$mobile' AND pass = '$password'";
$result = mysqli_query($db, $sql);
$count = mysqli_num_rows($result);
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

if ("pass" == $row["status"]) {
    $_SESSION['step1final']    = "pass";
    $_SESSION["step1inifinal"] = "display: none";
} elseif ("fail" == $row["status"]) {
    $_SESSION['step11final']   = "fail";
    $_SESSION["step1inifinal"] = "display: none";
} else {
    echo $tx = "";
    unset($_SESSION["step1inifinal"]);
    unset($_SESSION["step1final"]);
    unset($_SESSION["step11final"]);
}

if (empty($_SESSION['step1final'])) {
    $_SESSION["step1final"] = "display: none";
}

if ("fail" == $row["status"]) {
    $_SESSION['step11final']   = "fail";
    $_SESSION["step1final"]    = "display: none";
    $_SESSION["step1inifinal"] = "display: none";
} else {
    echo $tx = "";
    unset($_SESSION["step11final"]);
}

if (empty($_SESSION['step11final'])) {
    $_SESSION["step11final"] = "display: none";
}

if (empty($_SESSION['step1inifinal'])) {
    $_SESSION["step1inihidfinal"] = "display: none";
} else {
    unset($_SESSION["step1inihidfinal"]);
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
            <p style="font-size: 16px;"><strong><?php echo $row['name'] ?></strong></p>
            <p style="font-size: 14px;"><?php echo $row['mobile'] ?></p>
            <p style="font-size: 14px;"><?php echo $row['email'] ?></p>
        </div>
        <div id="navitem">
            <ul>
                <li><a href="dashboard">১ম রাউন্ড</a></li>
                <li><a class="liactive" href="final-round">২য় রাউন্ড</a></li>
            </ul>
        </div>
        <div id="containbody">
            <div id="quizbody">




                <p style="<?php echo $_SESSION['step11']; ?>">

                </p>


                <p style="<?php echo $_SESSION['step1inihidfinal']; ?>">
                    <b>আপনার ফাইনাল রাউন্ড সফলভাবে সম্পন্ন হয়েছে।</b><br /><br /><br/>
                    ফলাফল জানতে চোখ রাখুন <a href="https://www.facebook.com/buradio.org" target="_blank">BU RADiO</a> এবং <a href="https://www.facebook.com/AmicusGuild.BD" target="_blank">Amicus Guild</a> এর ফেইসবুক পেইজে।
                </p>


                <p style="display: none;"><u>২রা নভেম্বর, রাত ০৯ঃ০০ টায়</u> অলিম্পিয়াডের ফাইনাল রাউন্ড অনুষ্ঠিত হবে।</p>
                <div>
                    <div style="<?php echo $_SESSION['step1inifinal']; ?>">

                        <p>অলিম্পিয়াডের ফাইনাল রাউন্ডে অংশগ্রহন করতে নিচের বাটনে ক্লিক করুন।</p>
                        <br /><br />
                        <a class="quizbutton" href="final-quiz">প্রবেশ করুন!</a>

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