<?php
@$go = $_REQUEST['go'];
if (empty($go)) {
 header('Location: dismis');
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

require 'php/db.php';

$mobile   = mysqli_real_escape_string($db, $_SESSION['regmobile']);
$password = mysqli_real_escape_string($db, $_SESSION['regpass']);

$sql    = "SELECT * FROM reg WHERE mobile = '$mobile' AND pass = '$password'";
$result = mysqli_query($db, $sql);
$count  = mysqli_num_rows($result);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

 //access code
 unset($_SESSION["firstpage"]);
 unset($_SESSION["secondpage"]);

 ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disqualify - 1st National Constructional Law Olympiad (AG + BURADiO)</title>
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
            <p style="font-size: 16px;"><strong><?php echo $row['name']; ?></strong></p>
            <p style="font-size: 14px;"><?php echo $row['mobile']; ?></p>
            <p style="font-size: 14px;"><?php echo $row['email']; ?></p>
        </div>
        <div id="navitem">
            <ul>
                <li><a class="liactive" href="#">নোটিশ</a></li>
            </ul>
        </div>
        <div id="containbody">
            <div id="quizbody">
                <p>কুইজ পর্বে অংশগ্রহনের শর্তগুলা না মানায় বা ইচ্ছাকৃত অমান্য করায় কুইজটি আপনার জন্য বাতিল করা হলো।</p>
            </div>
        </div>

    </div>
    <?php
}
?>
</body>

</html>