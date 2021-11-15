<?php
@$go = $_REQUEST['go'];
if (empty($go)) {
 header('Location: home');
 exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - 1st National Constructional Law Olympiad (AG + BURADiO)</title>
    <?php
    require ('php/og-tags.php');
    ?>
    <link rel="shortcut icon" href="media/logo2.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
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
                    <a class="regbutton" href="registration">রেজিস্ট্রেশন করুন</a>
                    <a class="logbutton" href="login">লগইন করুন</a>
                </div>
            </div>
        </div>

        <div class="hidswbtn">
            <div class="subtwbtn" style="margin-top: 80px; margin-bottom: -50px;">
                <a class="regbutton" href="registration">রেজিস্ট্রেশন করুন</a>
                <a class="logbutton" href="login">লগইন করুন</a>
            </div>
        </div>

        <div id="notice">
            <div class="noticetext">
                <p><b>"১ম জাতীয় সাংবিধানিক আইন অলিম্পিয়াড ২০২১"</b> এ অংশগ্রহণ করতে প্রথমে <a href="registration">রেজিস্ট্রেশন</a> করুন।<br/> <u>১লা নভেম্বর</u> নিজ একাউন্টে <a href="login">লগইন</a> করে কুইজ প্রতিযোগিতায় অংশগ্রহণ করা যাবে।</p>
                </p>
            </div>
        </div>
        <div style="padding: 20px;margin: 0 auto;text-align: center; margin-top: 10px;">
            <a class="scorebutton" href="regChecker">রেজিস্ট্রেশন স্ট্যাটাস চেক করুন</a>
        </div>
        <div id="banner">
            <!-- banner elements -->
            <div id="bannerpic">
                <a href="https://www.facebook.com/events/908840973394961?active_tab=about" target="_blank"><img src="media/banner.jpg" /></a>
            </div>
        </div>
    </div>
</body>

</html>
