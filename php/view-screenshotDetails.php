<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty($_POST["imageID"])) {
        die();
    }

    include "db.php";

    $imageID = $_POST["imageID"];
    $pageID = $_POST["pageID"];

    $sql = "SELECT * FROM reg WHERE {$pageID} = '$imageID'";
    $result = mysqli_query($db, $sql) or die("Not Found!");
    $output = '';

    if (mysqli_num_rows($result) == 1) {

        while ($row = mysqli_fetch_assoc($result)) {

            $output .= "
            <div>
            <img src='finalRound/{$row[$pageID]}'>
            </div>
        ";
        }

        echo $output;
    } else {
        echo "<div style='margin-top: 200px; text-align: center;'><p style='font-size: 24px; color: #cccccc;'><i class='fa fa-warning fa-2x'></i><br/>Empty</p></div>";
        exit();
    }


} else {
    exit();
}


?>