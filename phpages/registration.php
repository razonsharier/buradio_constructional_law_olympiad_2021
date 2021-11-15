

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php

header('Cache-control: no-cache, must-revalidate, max-age=0');

if (empty($_SESSION['error_reg1'])) {
 $_SESSION["error_reg1"] = "display: none";
}

if (isset($_POST['registration'])) {

    require 'php/db.php';
    $pname = htmlspecialchars($_POST['name']);
    $pmobile = htmlspecialchars($_POST['mobile']);
    $pemail = htmlspecialchars($_POST['email']);
    $puni = htmlspecialchars($_POST['university']);
    $pdept = htmlspecialchars($_POST['dept']);
    $psemes = htmlspecialchars($_POST['semester']);
    $ptrans = htmlspecialchars($_POST['transaction']);
    $ppass = htmlspecialchars($_POST['password']);

    $name = mysqli_real_escape_string($db, $pname);
    $mobile = mysqli_real_escape_string($db, $pmobile);
    $email = mysqli_real_escape_string($db, $pemail);
    $uni = mysqli_real_escape_string($db, $puni);
    $dept = mysqli_real_escape_string($db, $pdept);
    $semes = mysqli_real_escape_string($db, $psemes);
    $trans = mysqli_real_escape_string($db, $ptrans);
    $password = mysqli_real_escape_string($db, $ppass);
    $password = md5($password);
    $sql = "SELECT * FROM reg WHERE mobile = '$mobile' or email = '$email'";
    $result = mysqli_query($db, $sql) or die(mysqli_error($db));
    $row = mysqli_fetch_array($result);


    $ip = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');


    if (!$name) {
        $_SESSION['error_reg1'] = "আপনার পূর্ণ নামটি দিন!";
    } elseif (!$mobile) {
        $_SESSION['error_reg1'] = "আপনার মোবাইল নাম্বারটি দিন!";
    } elseif (!$email) {
        $_SESSION['error_reg1'] = "আপনার ইমেইলটি দিন!";
    } elseif (!$uni) {
        $_SESSION['error_reg1'] = "আপনার বিশ্ববিদ্যালয়ের নাম লিখুন!";
    } elseif (!$dept) {
        $_SESSION['error_reg1'] = "আপনার বিভাগের নাম লিখুন!";
    } elseif (!$semes) {
        $_SESSION['error_reg1'] = "আপনার সেমিস্টার/ বর্ষ লিখুন!";
    } elseif (!$trans) {
        $_SESSION['error_reg1'] = "পেমেন্টের ট্রানজেকশন আইডি লিখুন!";
    } elseif (!$_FILES["studentID"]) {
        $_SESSION['error_reg1'] = "স্টুডেন্ট আইডি/ হল আইডির ছবি দিন!";
    } elseif (!$_FILES["proPic"]) {
        $_SESSION['error_reg1'] = "ফর্মাল/ সেমিফর্মাল ছবি দিন!";
    } elseif (!$password) {
        $_SESSION['error_reg1'] = "আপনার পাসওয়ার্ডটি দিন!";
    } elseif ($row['mobile'] == $mobile) {
        $_SESSION['error_reg1'] = "এই মোবাইল নাম্বারটি পূর্বেই ব্যবহৃত হয়েছে!";
    } elseif ($row['email'] == $email) {
        $_SESSION['error_reg1'] = "এই ইমেইলটি পূর্বেই ব্যবহৃত হয়েছে!!";
    } elseif ($row['mobile'] != $mobile && $row['email'] != $email) {

        $uid = rand(1000, 1000000);
        $sql = "SELECT userid FROM reg WHERE userid = '$uid'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if ($uid == $row['userid']) {
            $again = rand(1000, 1000000);
            $uid = $again;

            if ($uid == $row['userid']) {
                header("registration");
            }
        }


    $filenameChk = $_FILES["studentID"]["name"];
    $ext = pathinfo($filenameChk, PATHINFO_EXTENSION);
    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    if (array_key_exists($ext, $allowed)) {

        $fileName = $uid . "-" . uniqid() . time() . rand(1000, 100000);
        $fileType = pathinfo($_FILES['studentID']['name'], PATHINFO_EXTENSION);
        $new_fileName = $fileName . "." . $fileType;
        $folder = "studentID/";
        $final_fileName = $folder . strtolower($new_fileName);
        $fileNameForDB = strtolower($new_fileName);


        if (move_uploaded_file($_FILES['studentID']['tmp_name'], $final_fileName)) {
            $proPic = "uploaded";

        }
    }


    $filenameChk2 = $_FILES["proPic"]["name"];
    $ext2 = pathinfo($filenameChk2, PATHINFO_EXTENSION);
    $allowed2 = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    if (array_key_exists($ext2, $allowed2)) {

        $fileName2 = $uid . "-" . uniqid() . time() . rand(1000, 100000);
        $fileType2 = pathinfo($_FILES['proPic']['name'], PATHINFO_EXTENSION);
        $new_fileName2 = $fileName2 . "." . $fileType2;
        $folder2 = "proPic/";
        $final_fileName2 = $folder2 . strtolower($new_fileName2);
        $fileNameForDB2 = strtolower($new_fileName2);


        if (move_uploaded_file($_FILES['proPic']['tmp_name'], $final_fileName2)) {
            $proPic2 = "uploaded";
        }

    }



        if (isset($proPic) && isset($proPic2)) {

            $sql2 = "INSERT INTO reg (userid, ip, name, mobile, email, university, dept, transaction_id, semester, pass, step1, marks1, selectionround2, topic, status, marks2, selectionround3, time, link, marks3, questart, quend, payment_status, studentID, proPic) VALUES ('$uid','$ip', '$name', '$mobile', '$email', '$uni', '$dept', '$trans', '$semes', '$password', '', '0', '', '', '', '0', '', '', '', '0', '', '', 'Checking', '$fileNameForDB', '$fileNameForDB2')";
            $sql22 = "INSERT INTO rank (userid, totalmarks) VALUES ('$uid', '0')";

            if (mysqli_query($db, $sql2)) {
                mysqli_query($db, $sql22);
                $_SESSION['regdonepass'] = "আপনার তথ্য জমা নেওয়া হয়েছে!<br/>রেজিস্ট্রেশন স্ট্যাটাস চেক করতে <a href='regChecker'>এখানে</a> ক্লিক করুন।";
                echo "<script type='text/javascript'> document.location = 'login'; </script>";
                exit;
            } else {
                $_SESSION['error_reg1'] = "রেজিস্ট্রেশন সম্পূর্ণ হয়নি! আবার চেষ্টা করুন।";
            }
        } else {
            $_SESSION['error_reg1'] = "রেজিস্ট্রেশন সম্পূর্ণ হয়নি! আবার চেষ্টা করুন।";
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - 1st National Constructional Law Olympiad (AG + BURADiO)</title>
    <link rel="shortcut icon" href="media/logo2.png">
    <link rel="stylesheet" href="css/style.css">
    <style>
        @media screen and (max-width: 425px) {

            .regbutton {
                padding: 10px 15px;
                margin-right: 10px;
            }

            .logbutton {
                padding: 10px 15px;
            }

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
                    <a class="logbutton" href="login">লগইন করুন</a>
                </div>
            </div>
        </div>
        <div id="notice">
            <div class="noticetext">
                <p><b>"১ম জাতীয় সাংবিধানিক আইন অলিম্পিয়াড ২০২১"</b> এ অংশগ্রহণ করতে রেজিস্ট্রেশন করুন।</p>
            </div>
        </div>
        <div id="loginfield">
            <div id="formcontainer">
                <h3 style="font-size: 28px;color: #178e17;">রেজিস্ট্রেশন</h3>
                <div style="<?php echo $_SESSION['error_reg1']; ?>" class="errormsg">
                    <p><?php echo $_SESSION['error_reg1']; ?></p>
                </div>
                <form id="formwidth" method="post" enctype="multipart/form-data">
                    <label>পূর্ণ নামঃ</label>
                    <input name="name" type="text" autocomplete="off">
                    <label>মোবাইল নাম্বারঃ (১১ সংখ্যার)</label>
                    <input name="mobile" type="number" autocomplete="off" maxlength="11">
                    <label>ইমেইলঃ</label>
                    <input name="email" type="email" autocomplete="off">
                    <label>আপনার বিশ্ববিদ্যালয়ের নামঃ</label>
                    <input name="university" type="text" autocomplete="off">
                    <label>আপনার বিভাগের নামঃ</label>
                    <input name="dept" type="text" autocomplete="off">
                    <label>আপনি যে সেমিস্টার/ বর্ষে পড়ছেনঃ</label>
                    <input name="semester" type="text" autocomplete="off">
                    <br/>
                    <a style="color: #4c61ff; font-size: 16px; float: left; margin-bottom: -15px; margin-top: 15px;">(বিকাশে ১০০ টাকা 'সেন্ড মানি' করুন - <b>01739607100</b>)</a>
                    <label>বিকাশ পেমেন্টের ট্রানজেকশন আইডিঃ</label>
                    <input name="transaction" type="text" autocomplete="off">
                    <br/>
                    <label>আপনার স্টুডেন্ট আইডি/ হল আইডির ছবিঃ</label>
                    <input name="studentID" id="studentID" type="file" accept=".jpg, .jpeg, .png, .gif">
                    <label>আপনার ফর্মাল/ সেমিফর্মাল ছবিঃ</label>
                    <input name="proPic" id="proPic" type="file" accept=".jpg, .jpeg, .png, .gif">
                    <label>পাসওয়ার্ডঃ</label>
                    <input name="password" type="password" autocomplete="off">
                    <button class="quizbutton" name="registration" type="submit">সাবমিট করুন</button>
                </form>
            </div>
        </div>

    </div>
    <?php
unset($_SESSION["error_reg1"]);
?>
</body>

</html>