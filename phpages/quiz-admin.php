

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
header('Cache-control: no-cache, must-revalidate, max-age=0');

require('php/db.php');

if (isset($_POST['receive'])) {
    $getid = $_POST['receive'];
    $recqury = "UPDATE reg SET payment_status = 'Paid' WHERE id = '$getid'";
    mysqli_query($db, $recqury);
} else {
}
if (isset($_POST['undorec'])) {
    $getid = $_POST['undorec'];
    $recunqury = "UPDATE reg SET payment_status = 'Checking' WHERE id = '$getid'";
    mysqli_query($db, $recunqury);
} else {
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status - 1st National Constructional Law Olympiad (AG + BURADiO)</title>
    <link rel="shortcut icon" href="media/logo2.png">


    <style>
        body,
        html {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #fafafa;
        }

        header > a > img {
            margin-left: 5px;
            margin-top: 5px;
        }
        .header-background {
            background-color: #ffffff;
            border-bottom: 1px solid #dadada;
            height: 60px;
            top: 0;
            width: 100%;
            z-index: 1;
        }
        .header-container {
            max-width: 1100px;
            margin: auto;
        }
        header > a > img {
            margin-top: 7px;
            float: left;
        }
        .home-btn {
            float: right;
            opacity: 0.6;
            margin-right: 5px;
            margin-top: 7px;
            cursor: pointer;
        }
        .home-btn:hover {
            opacity: 0.8;
        }

        select,
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
            max-width: 1050px;
            min-height: 80px;
            background-color: #ffffff;
            overflow: auto;
            text-align: center;
            padding: 0px 5px;
            border: 1px solid #dddddd;
            margin-top: 10px;
            border-radius: 4px;
        }

        .abutton {
            padding: 0;
            border: 0;
            width: 40px;
            height: 20px;
            border: 1px solid #ddd;
            font-size: 12px;
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            font-size: 13px;
            width: 400px;
        }

        td,
        th {
            padding: 10px;
            max-width: 400px;
            border: 1px solid #D9E4E6;
        }

        .responstable {
            margin: 1em 0;
            width: 100%;
            overflow: hidden;
            background: #FFF;
            color: #024457;
            margin-bottom: 50px;
        }

        .responstable tr {
            border: 1px solid #D9E4E6;
            height: 30px;
            width: 400px;
            width: 100%;
            text-align: left;
            padding: 10px;
        }

        .responstable th {
            border: 1px solid #D9E4E6;
            background-color: rgb(92, 187, 224);
            color: #ffffff;
        }

        .responstable tr:nth-child(odd) {
            background-color: #EAF3F3;

        }

        .responstable td:first-child {
            display: table-cell;
            text-align: left;
            border-right: 1px solid #D9E4E6;
        }

        select {
            color: #44443d;
            padding: 0px;
            border: 1px solid rgb(203, 203, 203);
            height: 30px;
            width: 100%;
            outline: none;
            font-size: 14px;
            text-align: left;
            background-color: #f5f5f5;
            max-width: 250px;
            border-radius: 7px;
            margin-top: 3px;
            margin-left: 3px;
        }

        option {
            padding: 10px;
        }

        #modal {
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

        #modal-form {
            background: #fff;
            max-width: 700px;
            position: relative;
            top: 5%;
            padding: 15px;
            border-radius: 4px;
            margin: 0 auto;
            overflow: auto;
            margin-bottom: 10px;
        }

        #close-btn {
            background: orangered;
            color: white;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            cursor: pointer;
            float: right;
            margin-top: -10px;
            margin-right: -10px;
        }

        .reg_data_container {
            max-width: 700px;
        }

        .tdata {
            border-left: 2px solid blueviolet;
            max-width: 337px;
            display: inline-table;
            margin-bottom: 10px;
            padding-left: 3px;
            margin-right: 5px;
        }

        .ttitle {
            font-size: 12px;
            text-decoration: underline;
        }

        .tvalue {
            margin-top: -10px;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 0px;
            width: 337px;
        }

        .ajax_loader {
            display: none;
        }

        .loader-wrapper {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background-color: #242f3f;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .loader {
            display: inline-block;
            width: 30px;
            height: 30px;
            position: relative;
            border: 4px solid #Fff;
            animation: loader 2s infinite ease;
        }

        .loader-inner {
            vertical-align: top;
            display: inline-block;
            width: 100%;
            background-color: #fff;
            animation: loader-inner 2s infinite ease-in;
        }

        @keyframes loader {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(180deg);
            }

            50% {
                transform: rotate(180deg);
            }

            75% {
                transform: rotate(360deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes loader-inner {
            0% {
                height: 0%;
            }

            25% {
                height: 0%;
            }

            50% {
                height: 100%;
            }

            75% {
                height: 100%;
            }

            100% {
                height: 0%;
            }
        }








        @media (max-width:745px) {
            .tdata {
                border-left: 0px;
                border-bottom: 1px solid #eee;
                max-width: 500px;
                width: 100%;
                display: inline-block;
                margin-bottom: 0px;
            }

            .ttitle {
                text-decoration: none;
            }

            .tvalue {
                max-width: 500px;
                width: 100%;
            }
        }





        @media (max-width:600px) {
            .dis_non {
                display: none;
            }
        }

    </style>
</head>

<body>

<div id="header" class="header-background">
    <div class="header-container">
        <header>
            <a href="./"><img style="border-radius: 4px;" src="media/logo.jpg" alt="site logo" height="45px"></a>
        </header>
    </div>
</div>

<div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
</div>

<div id="containbody">
    <h3 style="text-align: center;"><strong>1st National Constructional Law Olympiad (AG + BURADiO)<br/>(Payment Status)</h3></strong></h2>
    <br/>

    <table class="responstable">
        <tbody>
        <tr>
            <th style="width: 20px;">Serial</th>
            <th>Name</th>
            <th style='width: 120px'>Mobile</th>
            <th style='width: 120px'>Transaction ID</th>
            <th style='width: 120px'>Payment Status</th>
            <th style='width: 100px'>Details</th>
        </tr>

        <?php
        $sqlr = "SELECT * FROM reg ORDER BY id ASC";
        $resultr = mysqli_query($db, $sqlr);
        $countr = mysqli_num_rows($resultr);
        while ($rowr = mysqli_fetch_array($resultr, MYSQLI_ASSOC)) {

            if ($rowr['payment_status'] == "Paid") {
                $statusb = "display: none"; //hide button
                $statust = "display: block"; //show text
            } else {
                $statusb = "display: block"; //show button
                $statust = "display: none"; //hide text
            }

            ?>
            <tr>
                <td><?php echo @$snr += 1; ?></td>
                <td>
                    <b><?php echo $rowr['name'] ?></b>
                    <br/>
                    <i><?php echo $rowr['email'] ?></i>
                </td>
                <td><?php echo $rowr['mobile'] ?></td>
                <td><?php echo $rowr['transaction_id'] ?></td>
                <form action="" method="post">
                    <td>
                        <div>
                            <p title="<?php echo $rowr['id'] ?>" style="<?php echo $statust ?>"><?php echo $rowr['payment_status'] ?><br/> -<button class="abutton" value="<?php echo $rowr['id'] ?>" type="submit" name="undorec"><em>Undo</em></button></p>
                            <button style="<?php echo $statusb ?>" value="<?php echo $rowr['id'] ?>" title="<?php echo $rowr['id'] ?>" type="submit" name="receive">Pending</button>
                        </div>
                    </td>
                </form>
                <td><button class="edit-btn" data-eid='<?php echo $rowr["id"] ?>' value="<?php echo $rowr['id'] ?>" type="submit" name="details" title="<?php echo $rowr['id'] ?>">Details</button></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<div id="modal">
    <div id="modal-form">
        <div id="close-btn">X</div>
        <div class="ajax_loader">
            <img src="media/abc.gif" alt="" style="width: 50px;height:50px;">
        </div>
        <div id="details">

        </div>
    </div>
    <br/><br/>
</div>


<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>

<script>
    $(window).on("load", function() {
        $(".loader-wrapper").fadeOut("slow");
    });
</script>

<script type="text/javascript">
    $(document).on("click", ".edit-btn", function() {
        $("#modal").fadeIn('fast');
        var applicantId = $(this).data("eid");

        $.ajax({
            url: "phpages/details.php",
            type: "POST",
            data: {
                id: applicantId
            },
            beforeSend: function() {
                $('.ajax_loader').show();
                $('#details').hide();
            },
            success: function(data) {
                $("#modal-form #details").html(data);
                $('.ajax_loader').hide();
                $('#details').show();
            }
        })
    });

    $("#close-btn").on("click", function() {
        $("#modal").fadeOut('fast');
    });
</script>

</body>

</html>