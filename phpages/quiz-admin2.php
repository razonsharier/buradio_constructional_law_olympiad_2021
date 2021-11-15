
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
header('Cache-control: no-cache, must-revalidate, max-age=0');

require 'php/db.php';

if(isset($_POST['rsltswitch'])){ 
    $rsltswitch    = "UPDATE settings SET switch = '$_POST[rsltswitch]' WHERE sw_type = 'result_publish'";
 $rsltswitchqry = mysqli_query($db, $rsltswitch);
}

if(isset($_POST['vivascr']) && isset($_POST['getvivaid'])){ 
    $vivascr    = "UPDATE reg SET marks3 = '$_POST[vivascr]' WHERE id = '$_POST[getvivaid]'";
 $vivascrqry = mysqli_query($db, $vivascr);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - 1st National Constructional Law Olympiad (AG + BURADiO)</title>
    <link rel="shortcut icon" href="media/logo2.png">
    <link rel="stylesheet" href="css/style.css">

    <style>
        hr {
            border-top: 1px solid #007CC7;
            border-bottom: 0;
            border-left: 0;
            border-right: 0;
            padding: 0;
            margin: 0;
        }
        button {
            margin: 0 auto;
            max-width: 120px;
            width: 100%;
            position: relative;
            cursor: pointer;
        }

        input {
            width: 30px;
        }

        #containbody {
            margin: 0 auto;
            max-width: 1000px;
            font-family: Arial, Helvetica, sans-serif;
            min-height: 80px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            overflow: auto;
            text-align: center;
        }

        .abutton {
            padding: 0;
            border: 0;
            width: 40px;
            height: 20px;
            border: 1px solid #ddd;
            font-size: 12px;
        }

        table {
            font-size: 14px;
        }

        select {
            width: 100px;
        }


        .image-modal {
            margin: 0 auto;
            background: rgba(0, 0, 0, 0.7);
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 100;
            display: none;
            overflow: auto;
        }
        .image-modal-form {
            /*background: #fff;*/
            width: 100%;
            height: 100%;
            position: relative;
            top: 0;
            padding: 0px;
            border-radius: 4px;
            margin: 0 auto;
            overflow: auto;
            margin-bottom: 0px;
        }
        .image-modal-title {
            float: left;
            padding: 5px 0px 5px 10px;
            /*max-width: 1000px;*/
            width: 100%;
            box-sizing: border-box;
            position: fixed;
            /*background-color: #FFFFFF;*/
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
        }
        .image-close-btn {
            background: orangered;
            color: white;
            width: 27px;
            height: 27px;
            line-height: 27px;
            text-align: center;
            border-radius: 2px;
            cursor: pointer;
            float: right;
            margin-top: 0px;
            margin-right: 20px;
            font-size: 16px;
            font-family: Arial, bangla, sans-serif;
        }
        .image-ajax_loader {
            display: none;
            max-width: 200px; /* as image width */
            width: 100%;
            margin: 0 auto;
        }
        #image-details {
            margin-top: 25px;
            padding: 10px;
            text-align: center;
        }
        #image-details img {
            max-width: 100%;
            height: auto;
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
                    <a href="index.php"><img class="logo" src="media/logo.jpg"></a>
                </div>
                <div class="right">
                    <a class="quizbutton" href="home">হোম পেইজ</a>
                </div>
            </div>
        </div>

        <div id="containbody">

            <div id="scorebody">
                <h3><strong><u>Admin Panel - 1st National Constructional Law Olympiad (AG + BURADiO)</u></strong></h3>
                <div style="text-align: left;">
                    <i
                        style="background-color: #ffffff; padding: 5px 15px; font-size: 12px; border-radius: 4px; border: 1px solid #D9E4E6">pass</i>
                    <i
                        style="background-color: #e0aaaa; padding: 5px 15px; font-size: 12px; border-radius: 4px;">dis</i>
                    <i
                        style="background-color: #e0dfaa; padding: 5px 15px; font-size: 12px; border-radius: 4px;">fail</i>
                    <i
                        style="background-color: #aae0ba; padding: 5px 15px; font-size: 12px; border-radius: 4px;">new</i>
                </div>

                <br/>

                <!--
                <div style="float: right; margin-top: -25px; font-size: 14px;">
                    <?php
                $sqlcksw    = "SELECT * FROM settings WHERE sw_type = 'result_publish'";
                $resultcksw = mysqli_query($db, $sqlcksw);
                $rowcksw    = mysqli_fetch_array($resultcksw, MYSQLI_ASSOC);
                ?>
                    <a>Result Publish: </a>
                    <form method="POST">
                        <select name="rsltswitch" onchange='this.form.submit()'>
                            <option value="<?php echo $rowcksw['switch'] ?>" hidden selected>
                                <?php echo $rowcksw['switch'] ?></option>
                            <option value="on"><b>on</b></option>
                            <option value="off">off</option>
                        </select>
                    </form>
                </div>
                -->

                <table class="responstable">
                    <tbody>
                        <tr>
                            <th style="width: 30px;">ক্রমিক</th>
                            <th>নাম</th>
                            <th>ডিটেইলস</th>
                            <th style="width: 70px;">প্রথম রাউন্ড</th>
                            <th style="width: 70px;">দ্বিতীয় রাউন্ড</th>
                        </tr>

                        <?php


$sqlr    = "SELECT * FROM reg ORDER BY marks1 DESC";
$resultr = mysqli_query($db, $sqlr);
$countr  = mysqli_num_rows($resultr);
while ($rowr = mysqli_fetch_array($resultr, MYSQLI_ASSOC)) {

    if ($rowr['step1'] == "dis") {
        $statuspd = "background-color: #e0aaaa;";
        $vivascrhid = "display: none;";
    } elseif ($rowr['step1'] == "pass") {
        $statuspd = "";
        $vivascrhid = "";
    } elseif ($rowr['step1'] == "fail") {
        $statuspd = "background-color: #e0dfaa";
        $vivascrhid = "display: none;";
    } else {
        $statuspd = "background-color: #aae0ba";
        $vivascrhid = "display: none;";
    }

 ?>
                        <tr style="<?php echo $statuspd; ?>">
                            <td>
                                <?php echo @$snr += 1; ?>


                            </td>
                            <td>
                                <b><?php echo $rowr['name']; ?></b><br/>
                                <i><?php echo $rowr['email']; ?></i><br/>
                                <?php echo $rowr['mobile']; ?>
                            </td>
                            <td>
                                <?php echo $rowr['university']; ?> <br />
                                <?php echo $rowr['dept']; ?> <br/>
                                <?php echo $rowr['semester']; ?>
                            </td>
                            <td>
                                <b><?php echo $rowr['marks1']; ?></b><hr/> <br/>
                                <a style="font-size: 12px; display: inline-block; margin-top: -10px;"><?php echo $rowr['questart']; ?> <br /> <?php echo $rowr['quend']; ?></a>
                            </td>
                            <td>
                                <?php
                                if (!empty($rowr['page1'])){
                                echo "<button type='button' class='view-screenshot' data-imageid='$rowr[page1]' data-pageid='page1'>Page 1</button>";
                                }
                                if (!empty($rowr['page2'])){
                                echo "<button type='button' class='view-screenshot' data-imageid='$rowr[page2]' data-pageid='page2'>Page 2</button>";
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
}
?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>


    <div class="image-modal">
        <div class="image-modal-form">
            <a class="image-modal-title" style="font-size: 16px; padding: 5px;"><p style="margin-top: 5px; display: inline-block; font-size: 14px; font-weight: 600; color: #333333;"></p>
                <div class="image-close-btn">X</div>
            </a>
            <div class="image-ajax_loader" style="margin-top: 20%;">
                <img src="media/abc.gif" alt="loading icon" width="150">
            </div>
            <div id="image-details">

            </div>
        </div>
    </div>


    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>

    <script type="text/javascript">
        $(document).on("click", ".view-screenshot", function() {
            document.body.style.overflow = "hidden";
            $(".image-modal").fadeIn('fast');
            var imageID = $(this).data("imageid");
            var pageID = $(this).data("pageid");

            $.ajax({
                url: "admin_screenshotDetails",
                type: "POST",
                data: {
                    imageID: imageID,
                    pageID: pageID
                },
                beforeSend: function() {
                    $('.image-ajax_loader').show();
                    $('#image-details').hide();
                },
                success: function(data) {
                    $(".image-modal-form #image-details").html(data);
                    $('.image-ajax_loader').hide();
                    $('#image-details').show();
                }
            })
        });

        $(".image-close-btn").on("click", function() {
            $(".image-modal").fadeOut('fast');
            document.body.style.overflow = "auto";
        });

        var modal = document.querySelector('.image-modal')
        window.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                $(".image-modal").fadeOut('fast');
                document.body.style.overflow = "auto";
            }
        })

    </script>

</body>

</html>