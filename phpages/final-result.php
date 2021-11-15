<?php
session_start();
?>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php

if (empty($_SESSION['regmobile']) && empty($_SESSION['regpass'])) {
 $_SESSION["error_login"] = "প্রথমে লগইন করুন!";
 echo "<script type='text/javascript'> document.location = 'login'; </script>";
 exit;
}

include '../php/db.php';
$mobile   = mysqli_real_escape_string($db, $_SESSION['regmobile']);
$password = mysqli_real_escape_string($db, $_SESSION['regpass']);
$userid   = mysqli_real_escape_string($db, $_SESSION['userid']);

@$a1  = mysqli_real_escape_string($db, $_POST['a1']);
@$a2  = mysqli_real_escape_string($db, $_POST['a2']);
@$a3  = mysqli_real_escape_string($db, $_POST['a3']);
@$a4  = mysqli_real_escape_string($db, $_POST['a4']);
@$a5  = mysqli_real_escape_string($db, $_POST['a5']);
@$a6  = mysqli_real_escape_string($db, $_POST['a6']);
@$a7  = mysqli_real_escape_string($db, $_POST['a7']);
@$a8  = mysqli_real_escape_string($db, $_POST['a8']);
@$a9  = mysqli_real_escape_string($db, $_POST['a9']);

$fetchqry2 = "INSERT INTO final_quizans (userid, a1, a2, a3, a4, a5, a6, a7, a8, a9) VALUES ('$userid', '$a1', '$a2', '$a3', '$a4', '$a5', '$a6', '$a7', '$a8', '$a9')";
mysqli_query($db, $fetchqry2);

$qry31    = "SELECT * FROM final_quizans WHERE userid='$userid'";
$qry32    = "SELECT * FROM final_quizallans";
$result31 = mysqli_query($db, $qry31);
$result32 = mysqli_query($db, $qry32);
$row31    = mysqli_fetch_array($result31, MYSQLI_ASSOC);
$row32    = mysqli_fetch_array($result32, MYSQLI_ASSOC);

if ($row32['ar1'] == $row31['a1']) {
 $a1a = "3";
} else {
 $a1a = "0";
}
if ($row32['ar2'] == $row31['a2']) {
 $a2a = "3";
} else {
 $a2a = "0";
}
if ($row32['ar3'] == $row31['a3']) {
 $a3a = "3";
} else {
 $a3a = "0";
}
if ($row32['ar4'] == $row31['a4']) {
 $a4a = "3";
} else {
 $a4a = "0";
}
if ($row32['ar5'] == $row31['a5']) {
 $a5a = "3";
} else {
 $a5a = "0";
}
if ($row32['ar6'] == $row31['a6']) {
 $a6a = "3";
} else {
 $a6a = "0";
}
if ($row32['ar7'] == $row31['a7']) {
 $a7a = "3";
} else {
 $a7a = "0";
}
if ($row32['ar8'] == $row31['a8']) {
 $a8a = "3";
} else {
 $a8a = "0";
}
if ($row32['ar9'] == $row31['a9']) {
 $a9a = "3";
} else {
 $a9a = "0";
}

$totalmarksc        = ($a1a + $a2a + $a3a + $a4a + $a5a + $a6a + $a7a + $a8a + $a9a);
@$_SESSION['score'] = $totalmarksc;
$intodata           = @$_SESSION['score'];

 //passing marks
 $intodata2 = "UPDATE reg SET marks2 ='$intodata', status ='pass', selectionround3 ='selected' WHERE mobile = '$mobile' AND pass = '$password'";

 date_default_timezone_set('Asia/Dhaka');
 $timestamp  = date('G:i:s A');
 $sqlqend    = "UPDATE reg SET quend2 = '$timestamp' WHERE mobile = '$mobile' AND pass = '$password'";
 $resultqend = mysqli_query($db, $sqlqend);

mysqli_query($db, $intodata2);
echo "<script type='text/javascript'> document.location = 'final-round'; </script>";

?>


<?php
$_SESSION['score'] = "";
?>