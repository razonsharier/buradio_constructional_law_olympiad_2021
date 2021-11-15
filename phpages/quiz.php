<?php
@$go = $_REQUEST['go'];
if ("" == $go) {
 include_once 'quiz';
}

?>

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
if ("pass" == $rowck['step1']) {
 echo "<script type='text/javascript'> document.location = 'dashboard'; </script>";
 exit;
}

if ("fail" == $rowck['step1']) {
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

 ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - 1st National Constructional Law Olympiad (AG + BURADiO)</title>
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
                <div class="right">
                    <div id="counttimer">
                        <p><strong style="font-size: 28px;"><span id="timer"></span></strong></p>
                    </div>
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
            <h3><u>শতর্কতাঃ</u></h3>
            <p>১. পূর্ববর্তী পেইজে ফিরে যেতে <a style="font-weight: 600;">"ফিরে যান"</a> বাটনে ক্লিক করুন।</p>
            <p>২. উপরের ডান পাশে প্রদত্ত নির্দিষ্ট সময়ের মধ্যে কুইজ সম্পন্ন করতে হবে।</p>
            <p>৩. আপনার উত্তরের পাশের বৃত্ততে ট্যাপ করে উত্তর চিহ্নিত করুন।</p>
            <p>৪. কুইজের উত্তর করা হয়ে গেলে "সাবমিট করুন" বাটনে ক্লিক করবেন অথবা সময় পার হয়ে গেলে অটো সাবমিট হয়ে যাবে।
            </p>
            <p>৫. <strong>কুইজ শুরু করার পূর্বে নিরবচ্ছিন্ন ইন্টারনেট সংযোগের ব্যবস্থা করুন।</strong></p>
            <p>৬. <strong>কুইজ শুরু করার পর পেইজ রিফ্রেশ করলে কুইজ বাতিল বলে গণ্য হবে।</strong></p>

            <p>৭. প্রতিটি প্রশ্নের মান ১। পূর্ণ মানঃ ৩০।</p>
            <button class="quizbutton" type="button" id="mybut" onclick="myFunction()">শুরু করুন!</button>
            <button type="button" href="javascript:void(0)" onclick="location.href='dashboard'" class="outbutton" id="mybut2">ফিরে যান</button>
            <br/><br/>
            <div id="myDIV" style="padding: 10px;">
                <form action="result" method="POST" id="form">
                    <h2>প্রশ্ন: (৩০টি)</h2>
                    <hr />

                    <div id="sub"></div>
                    <img style="display: none;" src="media/abc.gif" width="100px" />
                    <div id="messagedisplay"></div>


                    <br /><br />
                    <button class="quizbutton" name="click">সাবমিট করুন</button>
                    <br /><br /><br /><br /><br />


                </form>
            </div>
        </div>

    </div>

    <?php
}
?>




    <script>
        function myFunction() {
            var x = document.getElementById("myDIV");
            var b = document.getElementById("mybut");
            var b2 = document.getElementById("mybut2");
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                b.style.visibility = 'hidden';
                b2.style.visibility = 'hidden';
                x.style.display = "block";
                startTimer();
            }

        }
        window.onload = function() {
            document.getElementById('myDIV').style.display = 'none';
        };

    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mybut').click(function(e) {
                e.preventDefault();
                $.ajax({
                    method: "post",
                    url: "questions",
                    data: $('#displaydata').serialize(),
                    dataType: "html",
                    beforeSend: function() {
                        $("#sub").html('<img src="media/abc.gif" width="100px" />');
                    },
                    success: function(response) {
                        $("#sub").hide();
                        $('#messagedisplay').html(response);
                    }
                })
            })
        })

    </script>
    <?php $fetchtime = "SELECT `timer` FROM `timer` WHERE id=1";
$fetched             = mysqli_query($db, $fetchtime);
$time                = mysqli_fetch_array($fetched, MYSQLI_ASSOC);
$settime             = $time['timer'];
?>
    <script type="text/javascript">
        document.getElementById('timer').innerHTML = '<?php echo $settime; ?>';
        //03 + ":" + 00 ;


        function startTimer() {
            var presentTime = document.getElementById('timer').innerHTML;
            var timeArray = presentTime.split(/[:]+/);
            var m = timeArray[0];
            var s = checkSecond((timeArray[1] - 1));
            if (s == 59) {
                m = m - 1
            }
            if (m == 0 && s == 0) {
                document.getElementById("form").submit();
            }
            document.getElementById('timer').innerHTML =
                m + ":" + s;
            setTimeout(startTimer, 1000);

        }

        function checkSecond(sec) {
            if (sec < 10 && sec >= 0) {
                sec = "0" + sec
            }; // add zero in front of numbers < 10
            if (sec < 0) {
                sec = "59"
            };
            return sec;
            if (sec == 0 && m == 0) {
                alert('stop it')
            };
        }

    </script>


    <script src="js/jquery-3.5.1.min.js"></script>
</body>

</html>
