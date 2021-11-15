<?php
@$go = $_REQUEST['go'];
if ("" == $go) {
 include_once 'final-quiz';
}

?>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php

$_SESSION['checkpgck'] = "check";

require 'php/db.php';

if (empty($_SESSION['regmobile']) && empty($_SESSION['regpass'])) {
 $_SESSION["error_login"] = "প্রথমে লগইন করুন!";
 echo "<script type='text/javascript'> document.location = 'login'; </script>";
 exit;
}

$mobile   = mysqli_real_escape_string($db, $_SESSION['regmobile']);
$password = mysqli_real_escape_string($db, $_SESSION['regpass']);

$sqlck    = "SELECT * FROM reg WHERE mobile = '$mobile' AND pass = '$password'";
$resultck = mysqli_query($db, $sqlck);
$rowck    = mysqli_fetch_array($resultck, MYSQLI_ASSOC);
if ("pass" == $rowck['status']) {
 echo "<script type='text/javascript'> document.location = 'final-round'; </script>";
 exit;
}

if ("fail" == $rowck['status']) {
 echo "<script type='text/javascript'> document.location = 'final-round'; </script>";
 exit;
}

if ("dis" == $rowck['status']) {
 echo "<script type='text/javascript'> document.location = 'dismis'; </script>";
 exit;
}


if ("fail" == $rowck['step1']) {
    echo "<script type='text/javascript'> document.location = 'dashboard'; </script>";
    exit;
}
if ("" == $rowck['step1']) {
    echo "<script type='text/javascript'> document.location = 'dashboard'; </script>";
    exit;
}

if ("dis" == $rowck['step1']) {
    echo "<script type='text/javascript'> document.location = 'dismis'; </script>";
    exit;
}

$sql    = "SELECT * FROM reg WHERE mobile = '$mobile' AND pass = '$password'";
$result = mysqli_query($db, $sql);
$count  = mysqli_num_rows($result);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
 $_SESSION['userid'] = $row['userid'];

 //access code
 unset($_SESSION["firstpage"]);
 $_SESSION['secondpage'] = $row['userid'];


if (isset($_POST['click'])) {


        $filenameChk = $_FILES["page1"]["name"];
        $ext = pathinfo($filenameChk, PATHINFO_EXTENSION);
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        if (array_key_exists($ext, $allowed)) {

            $fileName = $row['userid'] . "-" . uniqid() . time() . rand(1000, 100000);
            $fileType = pathinfo($_FILES['page1']['name'], PATHINFO_EXTENSION);
            $new_fileName = $fileName . "." . $fileType;
            $folder = "finalRound/";
            $final_fileName = $folder . strtolower($new_fileName);
            $fileNameForDB = strtolower($new_fileName);


            if (move_uploaded_file($_FILES['page1']['tmp_name'], $final_fileName)) {
                $proPic = "uploaded";

            }
        }


        $filenameChk2 = $_FILES["page2"]["name"];
        $ext2 = pathinfo($filenameChk2, PATHINFO_EXTENSION);
        $allowed2 = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        if (array_key_exists($ext2, $allowed2)) {

            $fileName2 = $row['userid'] . "-" . uniqid() . time() . rand(1000, 100000);
            $fileType2 = pathinfo($_FILES['page2']['name'], PATHINFO_EXTENSION);
            $new_fileName2 = $fileName2 . "." . $fileType2;
            $folder2 = "finalRound/";
            $final_fileName2 = $folder2 . strtolower($new_fileName2);
            $fileNameForDB2 = strtolower($new_fileName2);


            if (move_uploaded_file($_FILES['page2']['tmp_name'], $final_fileName2)) {
                $proPic2 = "uploaded";
            }

        }



        if (isset($proPic) || isset($proPic2)) {

            $sql2 = "UPDATE reg SET page1 ='$fileNameForDB', page2 ='$fileNameForDB2', status ='pass', selectionround3 ='selected' WHERE mobile = '$mobile' AND pass = '$password'";

            if (mysqli_query($db, $sql2)) {
                echo "<script type='text/javascript'> document.location = 'final-round'; </script>";
                exit;
            } else {
                $_SESSION['error_reg1final'] = "রেজিস্ট্রেশন সম্পূর্ণ হয়নি! আবার চেষ্টা করুন।";
            }
        } else {
            $_SESSION['error_reg1final'] = "রেজিস্ট্রেশন সম্পূর্ণ হয়নি! আবার চেষ্টা করুন।";
        }

}


 ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Round - 1st National Constructional Law Olympiad (AG + BURADiO)</title>
    <?php
    require ('php/og-tags.php');
    ?>
    <link rel="shortcut icon" href="media/logo2.png">
    <link rel="stylesheet" href="css/quiz.css">
    <script src="js/jquery-3.5.1.min.js"></script>

    <style>
        body {
            -webkit-user-select: none;
            -webkit-touch-callout: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        #quizpretext p {
            margin: 5px;
        }

        @media screen and (max-width: 425px) {
            #quizquebody {
                font-size: 16px;
            }
        }

    </style>

    <script type="text/javascript">
        function mousehandler(e) {
            var myevent = (isNS) ? e : event;
            var eventbutton = (isNS) ? myevent.which : myevent.button;
            if ((eventbutton == 2) || (eventbutton == 3)) return false;
        }
        document.oncontextmenu = mischandler;
        document.onmousedown = mousehandler;
        document.onmouseup = mousehandler;

        function disableCtrlKeyCombination(e) {
            var forbiddenKeys = new Array("a", "s", "c", "x", "u");
            var key;
            var isCtrl;
            if (window.event) {
                key = window.event.keyCode;
                //IE
                if (window.event.ctrlKey)
                    isCtrl = true;
                else
                    isCtrl = false;
            } else {
                key = e.which;
                //firefox
                if (e.ctrlKey)
                    isCtrl = true;
                else
                    isCtrl = false;
            }
            if (isCtrl) {
                for (i = 0; i < forbiddenKeys.length; i++) {
                    //case-insensitive comparation
                    if (forbiddenKeys[i].toLowerCase() == String.fromCharCode(key).toLowerCase()) {
                        return false;
                    }
                }
            }
            return true;
        }

    </script>


</head>

<body onload="hidder();" oncontextmenu="return false" onmousedown="return false" onselectstart="return false">
    <div id="bodycontainer">
        <!-- body container to centralize elements-->
        <div id="header">
            <!-- header nav bar -->
            <div id="navmenu">
                <div class="left">
                    <a href="home"><img class="logo" src="media/logo.jpg"></a>
                </div>
            </div>
        </div>
    </div>
    <div id="userdtls">
        <p style="font-size: 14px;"><strong><?php echo $row['name']; ?></strong></p>
        <p style="font-size: 12px;"><?php echo $row['mobile']; ?></p>
        <p style="font-size: 12px;"><?php echo $row['email']; ?></p>
    </div>

    <div id="quizquebody">
        <div id="quizpretext">
            <h3><u>নিয়মাবলীঃ</u></h3>
            <p>১. A4 সাইজের পেপার/খাতায় উত্তর লিখতে হবে।</p>
            <p>২. খাতার উপরের দিকে আপনার ID নং লিখতে হবে।</p>
            <p>৩. সর্বোচ্চ ২ পৃষ্ঠায় লেখা শেষ করতে হবে।</p>
            <p>৪. যেকোনো একটি প্রশ্নের উত্তর করতে হবে।</p>
            <p>৫. প্রশ্নের নং উল্লেখ করতে হবে।</p>
            <p>৬. নিরবিচ্ছিন্ন ইন্টারনেট নিশ্চিত রাখতে হবে।</p>
            <p>৭. উত্তর নিজের হাতে লিখতে হবে৷</p>
            <p>৮. টাইপ করা লেখা গ্রহনযোগ্য হবে না।</p>
            <p><b><u>বি.দ্র.</u> </b>১৫ মিনিটের মধ্যে ছবি তুলে উত্তর সাবমিট করতে হবে। পিডিএফ করার প্রয়োজন নেই৷ উত্তর ২ পৃষ্ঠা হলে ২ টি ছবি ২ ঘরে জমা দিবেন। 'Page 1' এর ঘরে ১ম পৃষ্ঠার ছবি আর 'Page 2' এর ঘরে ২য় পৃষ্ঠার ছবি আপলোড করে সাবমিট করবেন। আপনার লেখা শুধুমাত্র ১ পৃষ্ঠা হলে 'Page 1' এ আপলোড করে সাবমিট করলেই হবে।</p>

            <br/>
            <h3><u>ফাইনাল রাউন্ডঃ</u></h3>
            <p><u>যেকোনো একটি প্রশ্নের উত্তর দিন। প্রশ্নের মান ১০।</u></p>
            <p>১. বাংলাদেশের সংবিধান সংশোধনের নিয়ম ব্যাখা করুন।</p>
            <p>২. মৌলিক অধিকার কি? বাংলাদেশের সংবিধান অনুযায়ী মৌলিক অধিকারের তালিকাটা লিখুন।</p>
            <p>৩. বাংলাদেশ সংবিধানে রাষ্ট্র পরিচালনার মূলনীতিগুলো ও প্রয়োগক্ষেত্র কয়টি ও কি কি?</p>
            <p>৪. বাংলাদেশ সংবিধানের ১০টি বৈশিষ্ট ১০ বাক্যে লিখুন।</p>

            <br/>


            <div style="padding: 10px;">
                <form id="formwidth" method="post" enctype="multipart/form-data">

                    <h3><u>উত্তর জমা দিনঃ</u></h3>
                    <label>Page 1:</label>
                    <input name="page1" id="page1" type="file">
                    <label>Page 2:</label>
                    <input name="page2" id="page2" type="file">


                    <br />
                    <button class="quizbutton" name="click" type="submit">সাবমিট করুন</button>
                    <button type="button" href="javascript:void(0)" onclick="location.href='final-round'" class="outbutton" id="mybut2">ফিরে যান</button>
                    <br /><br /><br />


                </form>
            </div>
        </div>

    </div>

    <?php
}
?>




    <script src="js/jquery-3.5.1.min.js"></script>
</body>

</html>


