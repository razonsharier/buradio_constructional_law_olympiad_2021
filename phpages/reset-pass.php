<?php

session_start();


if (empty($_SESSION['error_login'])) {
    $_SESSION["error_login_div"] = "display: none";
}



    include "../php/db.php";

    $type_id = strip_tags($_GET['typeId']);
    $type_id = htmlspecialchars($type_id);
    $type_id = mysqli_real_escape_string($db, $type_id);

    $user_id = strip_tags($_GET['userId']);
    $user_id = htmlspecialchars($user_id);
    $user_id = mysqli_real_escape_string($db, $user_id);

    $request_id = strip_tags($_GET['requestId']);
    $request_id = htmlspecialchars($request_id);
    $request_id = mysqli_real_escape_string($db, $request_id);

    if ($type_id == "password") {

        $sql_pass = "SELECT * FROM recov_pass_request WHERE (user_id='$user_id' AND request_id='$request_id')";
        $resultPass = mysqli_query($db, $sql_pass);
        $countPass = mysqli_num_rows($resultPass);
        $rowPass = mysqli_fetch_array($resultPass);
        $rowEmail = $rowPass['email'];

        if ($countPass == 1) {
            if ($rowPass['status'] != "checked") {





                if (isset($_POST['passCng'])) {

                    if (!$_POST["newPass"]) {
                        $_SESSION['error_login'] = "আপনার পাসওয়ার্ডটি দিন!";
                        unset($_SESSION["error_login_div"]);
                    } elseif (!$_POST["conPass"]) {
                        $_SESSION['error_login'] = "আপনার পাসওয়ার্ডটি পুনরায় দিন!";
                        unset($_SESSION["error_login_div"]);
                    } elseif ($_POST["newPass"] != $_POST["conPass"]) {
                        $_SESSION['error_login'] = "পাসওয়ার্ড দুটি মেলেনি! আবার চেষ্টা করুন...";
                        unset($_SESSION["error_login_div"]);
                    } elseif (!empty($_POST["newPass"]) && !empty($_POST["conPass"])) {

                        require '../php/db.php';
                        $newPass = mysqli_real_escape_string($db, $_POST['newPass']);
                        $conPass = mysqli_real_escape_string($db, $_POST['conPass']);
                        $newPass = md5($newPass);


                        $status_update = "UPDATE reg SET pass = '$newPass' WHERE (userid='$user_id' AND email='{$rowEmail}')";

                        if (mysqli_query($db, $status_update)) {


                            $status_updateT = "UPDATE recov_pass_request SET status = 'checked' WHERE (user_id='$user_id' AND request_id='$request_id')";

                            if (mysqli_query($db, $status_updateT)) {


                                $_SESSION['regdonepass'] = "পাসওয়ার্ড পরিবর্তন সম্পন্ন হয়েছে।";
                                echo "<script type='text/javascript'> document.location = '../../login'; </script>";
                                exit();

                            }

                        }

                    }

                }






                $msg_main = "";
                $recov_form = "
                                <style>#msgField{display: none;}</style> 
                                <h3>নতুন পাসওয়ার্ড সেট করুনঃ</h3>                              
                                <form id='formwidth' action='' method='post'>
                                    <p style='font-size: 16px;'><b>ইমেইলঃ</b> {$rowPass['email']}</p>
                                    <div style='{$_SESSION['error_login_div']}' class='errormsg'>
                                        <p>{$_SESSION['error_login']}</p>
                                    </div>
                                    <label>নতুন পাসওয়ার্ডটি দিনঃ</label>
                                    <input name='newPass' type='password' autocomplete='off'>
                                    <label>পুনরায় পাসওয়ার্ডটি দিনঃ</label>
                                    <input name='conPass' type='password' autocomplete='off'>
                                    <button class='quizbutton' type='submit' name='passCng'>পরিবর্তন করুন</button>
                                </form>
                                      ";


            } else {
                $msg_main = "<style>#msgField{display: block;}</style>";
                $msg_details = "<p class='regdonepass'>পাসওয়ার্ড পরিবর্তন সম্পন্ন হয়েছে।</p>";
            }

        } else {
            $msg_main = "";
            $msg_details = "<p>আপনি প্রক্রিয়াটির আওতাধীন নন।</p>";
        }


    } else {
        $msg_main = "";
        $msg_details = "<p></p>";
    }







?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>বঙ্গবন্ধু অলিম্পিয়াড (সিজন-২) - BURADiO</title>
    <link rel="shortcut icon" href="../../media/logo2.png">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <div id="bodycontainer">
        <!-- body container to centralize elements-->
        <div id="header">
            <!-- header nav bar -->
            <div id="navmenu">
                <div class="left">
                    <a href="../../home"><img class="logo" src="../../media/logo.jpg"></a>
                </div>
                <div class="right">
                    <a class="logbutton" href="../../login">লগইন করুন</a>
                </div>
            </div>
        </div>
        <div id="containbody" style="margin-top: 100px;border-radius: 10px;">
            <div id="quizbody">


                <div id="msgField">

                    <div class="notify">
                        <h2><?php echo $msg_main; ?></h2>
                    </div>
                    <br /><br />
                    <div class="text-container">
                        <?php echo $msg_details; ?>
                    </div>
                    <br/>


                </div>

                <div id="recovField">
                    <?php echo $recov_form; ?>
                </div>


            </div>
        </div>

</body>

</html>


<?php

unset($_SESSION["error_login"]);
unset($_SESSION["regdonepass"]);

?>
