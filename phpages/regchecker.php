
<?php
header('Cache-control: no-cache, must-revalidate, max-age=0');

$_SESSION["searchfield"] = "display: none";
$_SESSION["buffiderror"] = "display: none";

require('php/db.php');

if (isset($_POST['mobile'])) {
    $getid = mysqli_real_escape_string($db, $_POST['mobile']);
    $_SESSION["getid"] = $getid;

    $sqlbuffid = "SELECT * FROM reg WHERE mobile = '$getid'";
    $resultbuffid = mysqli_query($db, $sqlbuffid) or die(mysqli_error($db));
    $countbuffid = mysqli_num_rows($resultbuffid);


    if ($countbuffid > 0) {

        $databuffid = mysqli_fetch_array($resultbuffid, MYSQLI_ASSOC);
        unset($_SESSION["searchfield"]);

        if ($databuffid['payment_status'] == "Paid") {
            $paydue = "display: none;";
        } else {
            $paydone = "display: none;";
        }
    } else {
        unset($_SESSION["buffiderror"]);
    }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Status Checker</title>
    <link rel="shortcut icon" href="media/logo2.png">
    <link rel="stylesheet" type="text/css" href="css/regChecker-style.css">
</head>
<body>
<div id="header" class="header-background">
    <div class="header-container">
        <header>
            <a href="./"><img src="media/logo.jpg" alt="site logo" height="45px"></a>
        </header>
    </div>
</div>
<div class="body-container">
    <div style="margin-top: 10px;"></div>

    <div class="about-container">
        <div class="about-content">

            <div class="blog-content">
                <div style="margin: auto; max-width: 480px; text-align:center">
                    <h2><u>Check Your Registration Status</u></h2>
                    <div style="margin-top: 50px;">
                        <div class="buffid">
                            <form action="" method="post" enctype="form-data">
                                <label style="color: #666655; text-align: left; text-align: left; margin-left: 5px; font-size: 14px;">Mobile Number</label>
                                <input class="search_icon" style="clear:both;" type="text" name="mobile" required />
                                <button style="min-width: 120px; border-radius: 5px; margin-top: 10px; margin-left: 5px;" type="submit" name="regcheck">Check Status</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top: 50px;<?php echo $_SESSION['searchfield']; ?>">
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <div>
                                <p class="ttitle">Name:</p>
                                <p class="tvalue"><?php echo $databuffid['name'] ?></p>
                            </div>
                        </td>
                        <td style="width: 120px">
                            <div>
                                <p class="ttitle">Mobile:</p>
                                <p class="tvalue"><?php echo $databuffid['mobile'] ?></p>
                            </div>
                        </td>
                        <td style="width: 120px">
                            <div>
                                <p class="ttitle">Transaction ID:</p>
                                <p class="tvalue"><?php echo $databuffid['transaction_id'] ?></p>
                            </div>
                        </td>
                        <td style="width: 155px;">
                            <div>
                                <p class="ttitle">Reg. Status:</p>
                                <p style="<?php echo $paydue ?>;" class="tvalue pay_chk">Payment Checking</p>
                                <p style="<?php echo $paydone ?>;" class="tvalue pay_done">Successful</p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div style="<?php echo $_SESSION['buffiderror']; ?>" class="errormsg">
                <a>Not Found!</a>
            </div>


        </div>
    </div>
</div>


<?php
unset($_SESSION["getid"]);
?>


</body>
</html>