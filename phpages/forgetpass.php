<?php
@$go = $_REQUEST['go'];
if (empty($go)) {
 header('Location: forgetpass');
 exit;
}
?>

<?php

if (empty($_SESSION['regdonepass'])) {
    $_SESSION["regdonepass_div"] = "display: none";
}
if (empty($_SESSION['error_login'])) {
    $_SESSION["error_login_div"] = "display: none";
}


use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['recover'])) {

    if (!$_POST["email"]) {
        $_SESSION['error_login'] = "আপনার মোবাইল নাম্বারটি দিন!";
    } elseif (!empty($_POST["email"])) {

        require 'php/db.php';
        $email   = mysqli_real_escape_string($db, $_POST['email']);
        $sql      = "SELECT * FROM reg WHERE email = '$email'";
        $result   = mysqli_query($db, $sql) or die(mysqli_error($db));
        $row      = mysqli_num_rows($result);
        $row_data = mysqli_fetch_assoc($result);
        $user_id = $row_data["userid"];

        if (1 == $row) //find data into database
        {
            /* send email from here */


            $requestId = rand(100000, 1000000000);
            $ip = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');
            date_default_timezone_set('Asia/Dhaka');
            $datetime = date('d-m-Y; g:i:s A');

            $subject = "Reset Your Password";

            $message = "
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout:fixed;background-color:#f9f9f9'>
                    <tbody>
                        <tr>
                            <td style='padding-right:0px;padding-left:0px;padding-top:0px;' align='center' valign='top'>
                                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px'>
                                    <tbody>
                                        <tr>
                                            <td align='left' valign='top'>
                                                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:1px 1px 1px 1px;'>
                                                    <tbody>
                                                        <tr>
                                                            <td style='margin-left: 10px; padding-left: 10px; padding-bottom: 0px; border-bottom: 1px solid #e5e5e5;' align='left' valign='left'>
                                                                <a href='http://olympiad.buradio.org/' style='text-decoration:none' target='_blank'>
                                                                    <img alt='' border='0' src='http://olympiad.buradio.org/media/logo.jpg' style='width:auto;max-height:50px;height:auto;display:block' height='50'>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style='padding-top: 30px; padding-bottom: 5px; padding-left: 10px;' align='left' valign='top'>
                                                                <p style='color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:14px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:25px;text-transform:none;text-align:left;padding:0;margin:0'>Hello,<br/>
                                                                We have received a password recovery request from your account.
                                                                <a style='margin-top: 10px;display: inline-block;'>To reset your password click on the button below-</a>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style='padding-left:10px;padding-right:20px' align='left' valign='top'>
                                                                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style='padding-top:10px;padding-bottom:10px' align='left' valign='top'>
                                                                                <table border='0' cellpadding='0' cellspacing='0' align='left'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style='background-color: #298ac7; padding: 5px 20px; border-radius: 2px;' align='left'> <a href='http://olympiad.buradio.org/reset/{$user_id}/{$requestId}' style='color:#fff;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:14px;font-weight:600;font-style:normal;letter-spacing:1px;line-height:20px;text-decoration:none;display:block' target='_blank'>Reset Password</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style='padding-top: 0px; padding-bottom: 5px; padding-left: 10px;' align='left' valign='top'>
                                                                <p style='color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:14px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:25px;text-transform:none;text-align:left;padding:0;margin:0'>Or, copy/paste the link below into the browser address bar.<br/>
                                                                <a style='color:#007CC7;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0;text-decoration:none;' href='http://olympiad.buradio.org/reset/{$user_id}/{$requestId}' target='_blank'>http://olympiad.buradio.org/reset/{$user_id}/{$requestId}</a>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style='padding-top: 20px; padding-bottom: 5px; padding-left: 10px;' align='left' valign='top'>
                                                                <p class='text' style='color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:14px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:25px;text-transform:none;text-align:left;padding:0;margin:0'>Thank you,<br/>
                                                                BURADiO Team
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style='padding-top: 20px; padding-bottom: 15px; padding-left: 10px;' align='left' valign='top'>
                                                                <p style='color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:14px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:25px;text-transform:none;text-align:left;padding:0;margin:0'>(Please do not reply to this email.)</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                ";

            require_once "PHPMailer/PHPMailer.php";
            require_once "PHPMailer/SMTP.php";
            require_once "PHPMailer/Exception.php";

            $mail = new PHPMailer();

            //SMTP Settings
            $mail->isSMTP();
            $mail->Host = "mail.buradio.org";
            $mail->SMTPAuth = true;
            $mail->SMTPAutoTLS = true;
            $mail->Username = "no-reply@olympiad.buradio.org";
            $mail->Password = 'yH_ALB0yTF^t';
            $mail->Port = 465;
            $mail->SMTPSecure = "ssl";

            //Email Settings
            $mail->isHTML(true);
            $mail->setFrom('info@buradio.com', 'National Constitution Law Olympiad');
            $mail->addAddress($email); //enter you email address
            $mail->Subject = ($subject);
            $mail->Body = $message;

            if ($mail->send()) {
                //echo "Email is sent!";


                $request_sql = "INSERT INTO recov_pass_request (request_id, user_id, email, ip, datetime, status) VALUES ('{$requestId}', '{$user_id}', '{$email}', '{$ip}', '{$datetime}', 'uncheck')";

                if (mysqli_query($db, $request_sql)) {


                    $_SESSION['regdonepass'] = "আপনার ইমেইলে পাসওয়ার্ড পরিবর্তনের একটি লিংক পাঠানো হয়েছে!";
                    unset($_SESSION["error_login"]);
                    unset($_SESSION["regdonepass_div"]);

                } else {
                    $_SESSION['error_login'] = "আবার চেষ্টা করুন!";
                    unset($_SESSION["regdonepass"]);
                    unset($_SESSION["error_login_div"]);
                }

            } else {
                $_SESSION['error_login'] = "আবার চেষ্টা করুন!";
                unset($_SESSION["regdonepass"]);
                unset($_SESSION["error_login_div"]);
            }

        } else {
            $_SESSION['error_login'] = "ইমেইল ঠিকানাটি খুঁজে পাওয়া যায় নি!";
            unset($_SESSION["regdonepass"]);
            unset($_SESSION["error_login_div"]);
        }
    }


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - 1st National Constructional Law Olympiad (AG + BURADiO)</title>
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
                    <a class="logbutton" href="login">লগইন করুন</a>
                </div>
            </div>
        </div>
        <div id="containbody" style="margin-top: 100px;border-radius: 10px;">
            <div id="quizbody">
                <p><b>পাসওয়ার্ড পরিবর্তন করুনঃ</b></p>

                <div style="<?php echo $_SESSION['regdonepass_div']; ?>" class="regdonepass">
                    <p><?php echo $_SESSION['regdonepass']; ?></p>
                </div>
                <div style="<?php echo $_SESSION['error_login_div']; ?>" class="errormsg">
                    <p><?php echo $_SESSION['error_login']; ?></p>
                </div>
                <form id="formwidth" action="" method="post">
                    <label>রেজিস্ট্রেশনে ব্যবহৃত ইমেইলটি দিনঃ</label>
                    <input name="email" type="email" autocomplete="off" required>
                    <button class="quizbutton" type="submit" name="recover">সাবমিট করুন</button>
                </form>

            </div>
        </div>

</body>

</html>

<?php
unset($_SESSION["error_login"]);
unset($_SESSION["regdonepass"]);
?>

