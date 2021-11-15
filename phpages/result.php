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
@$a10 = mysqli_real_escape_string($db, $_POST['a10']);
@$a11 = mysqli_real_escape_string($db, $_POST['a11']);
@$a12 = mysqli_real_escape_string($db, $_POST['a12']);
@$a13 = mysqli_real_escape_string($db, $_POST['a13']);
@$a14 = mysqli_real_escape_string($db, $_POST['a14']);
@$a15 = mysqli_real_escape_string($db, $_POST['a15']);
@$a16 = mysqli_real_escape_string($db, $_POST['a16']);
@$a17 = mysqli_real_escape_string($db, $_POST['a17']);
@$a18 = mysqli_real_escape_string($db, $_POST['a18']);
@$a19 = mysqli_real_escape_string($db, $_POST['a19']);
@$a20 = mysqli_real_escape_string($db, $_POST['a20']);
@$a21 = mysqli_real_escape_string($db, $_POST['a21']);
@$a22 = mysqli_real_escape_string($db, $_POST['a22']);
@$a23 = mysqli_real_escape_string($db, $_POST['a23']);
@$a24 = mysqli_real_escape_string($db, $_POST['a24']);
@$a25 = mysqli_real_escape_string($db, $_POST['a25']);
@$a26 = mysqli_real_escape_string($db, $_POST['a26']);
@$a27 = mysqli_real_escape_string($db, $_POST['a27']);
@$a28 = mysqli_real_escape_string($db, $_POST['a28']);
@$a29 = mysqli_real_escape_string($db, $_POST['a29']);
@$a30 = mysqli_real_escape_string($db, $_POST['a30']);

$fetchqry2 = "INSERT INTO quizans (userid, a1, a2, a3, a4, a5, a6, a7, a8, a9, a10, a11, a12, a13, a14, a15, a16, a17, a18, a19, a20, a21, a22, a23, a24, a25, a26, a27, a28, a29, a30) VALUES ('$userid', '$a1', '$a2', '$a3', '$a4', '$a5', '$a6', '$a7', '$a8', '$a9', '$a10', '$a11', '$a12', '$a13', '$a14', '$a15', '$a16', '$a17', '$a18', '$a19', '$a20', '$a21', '$a22', '$a23', '$a24', '$a25', '$a26', '$a27', '$a28', '$a29', '$a30')";
mysqli_query($db, $fetchqry2);

$qry31    = "SELECT * FROM quizans WHERE userid='$userid'";
$qry32    = "SELECT * FROM quizallans";
$result31 = mysqli_query($db, $qry31);
$result32 = mysqli_query($db, $qry32);
$row31    = mysqli_fetch_array($result31, MYSQLI_ASSOC);
$row32    = mysqli_fetch_array($result32, MYSQLI_ASSOC);

if ($row32['ar1'] == $row31['a1']) {
 $a1a = "1";
} else {
 $a1a = "0";
}
if ($row32['ar2'] == $row31['a2']) {
 $a2a = "1";
} else {
 $a2a = "0";
}
if ($row32['ar3'] == $row31['a3']) {
 $a3a = "1";
} else {
 $a3a = "0";
}
if ($row32['ar4'] == $row31['a4']) {
 $a4a = "1";
} else {
 $a4a = "0";
}
if ($row32['ar5'] == $row31['a5']) {
 $a5a = "1";
} else {
 $a5a = "0";
}
if ($row32['ar6'] == $row31['a6']) {
 $a6a = "1";
} else {
 $a6a = "0";
}
if ($row32['ar7'] == $row31['a7']) {
 $a7a = "1";
} else {
 $a7a = "0";
}
if ($row32['ar8'] == $row31['a8']) {
 $a8a = "1";
} else {
 $a8a = "0";
}
if ($row32['ar9'] == $row31['a9']) {
 $a9a = "1";
} else {
 $a9a = "0";
}
if ($row32['ar10'] == $row31['a10']) {
 $a10a = "1";
} else {
 $a10a = "0";
}
if ($row32['ar11'] == $row31['a11']) {
 $a11a = "1";
} else {
 $a11a = "0";
}
if ($row32['ar12'] == $row31['a12']) {
 $a12a = "1";
} else {
 $a12a = "0";
}
if ($row32['ar13'] == $row31['a13']) {
 $a13a = "1";
} else {
 $a13a = "0";
}
if ($row32['ar14'] == $row31['a14']) {
 $a14a = "1";
} else {
 $a14a = "0";
}
if ($row32['ar15'] == $row31['a15']) {
 $a15a = "1";
} else {
 $a15a = "0";
}
if ($row32['ar16'] == $row31['a16']) {
 $a16a = "1";
} else {
 $a16a = "0";
}
if ($row32['ar17'] == $row31['a17']) {
 $a17a = "1";
} else {
 $a17a = "0";
}
if ($row32['ar18'] == $row31['a18']) {
 $a18a = "1";
} else {
 $a18a = "0";
}
if ($row32['ar19'] == $row31['a19']) {
 $a19a = "1";
} else {
 $a19a = "0";
}
if ($row32['ar20'] == $row31['a20']) {
 $a20a = "1";
} else {
 $a20a = "0";
}
if ($row32['ar21'] == $row31['a21']) {
 $a21a = "1";
} else {
 $a21a = "0";
}
if ($row32['ar22'] == $row31['a22']) {
 $a22a = "1";
} else {
 $a22a = "0";
}
if ($row32['ar23'] == $row31['a23']) {
 $a23a = "1";
} else {
 $a23a = "0";
}
if ($row32['ar24'] == $row31['a24']) {
 $a24a = "1";
} else {
 $a24a = "0";
}
if ($row32['ar25'] == $row31['a25']) {
 $a25a = "1";
} else {
 $a25a = "0";
}
if ($row32['ar26'] == $row31['a26']) {
 $a26a = "1";
} else {
 $a26a = "0";
}
if ($row32['ar27'] == $row31['a27']) {
 $a27a = "1";
} else {
 $a27a = "0";
}
if ($row32['ar28'] == $row31['a28']) {
 $a28a = "1";
} else {
 $a28a = "0";
}
if ($row32['ar29'] == $row31['a29']) {
 $a29a = "1";
} else {
 $a29a = "0";
}
if ($row32['ar30'] == $row31['a30']) {
 $a30a = "1";
} else {
 $a30a = "0";
}

$totalmarksc        = ($a1a + $a2a + $a3a + $a4a + $a5a + $a6a + $a7a + $a8a + $a9a + $a10a + $a11a + $a12a + $a13a + $a14a + $a15a + $a16a + $a17a + $a18a + $a19a + $a20a + $a21a + $a22a + $a23a + $a24a + $a25a + $a26a + $a27a + $a28a + $a29a + $a30a);
@$_SESSION['score'] = $totalmarksc;
$intodata           = @$_SESSION['score'];
if (isset($intodata)) {
 //passing marks
 $intodata2 = "UPDATE reg SET marks1 ='$intodata', step1 ='pass', selectionround2 ='selected' WHERE mobile = '$mobile' AND pass = '$password'";

 date_default_timezone_set('Asia/Dhaka');
 $timestamp  = date('g:i:s A');
 $sqlqend    = "UPDATE reg SET quend = '$timestamp' WHERE mobile = '$mobile' AND pass = '$password'";
 $resultqend = mysqli_query($db, $sqlqend);

}
/*
 else {
 $intodata2 = "UPDATE reg SET marks1 ='$intodata', step1 ='fail' WHERE mobile = '$mobile' AND pass = '$password'";

 date_default_timezone_set('Asia/Dhaka');
 $timestamp  = date('G:i:s A');
 $sqlqend    = "UPDATE reg SET quend = '$timestamp' WHERE mobile = '$mobile' AND pass = '$password'";
 $resultqend = mysqli_query($db, $sqlqend);
 
}
*/
mysqli_query($db, $intodata2);
echo "<script type='text/javascript'> document.location = 'dashboard'; </script>";

?>


<?php
$_SESSION['score'] = "";
?>