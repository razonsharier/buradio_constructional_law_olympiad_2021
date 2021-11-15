<?php
require('../php/db.php');

if (empty($_POST["id"])) {
    die();
}

$applicant_id = $_POST["id"];

$sql = "SELECT * FROM reg WHERE id = {$applicant_id}";
$result = mysqli_query($db, $sql) or die("ajax failed");
$output = '';

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $output .= "<h2><u>Applicant Details</u></h2>
        <div style='margin-top: -15px;'>
        <b><i>({$row['payment_status']})</i></b>
        </div>
        <br/>
        <div class='reg_data_container'>
        <div class='tdata'>
            <p class='ttitle'>Name:</p>
            <p class='tvalue'>{$row['name']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Mobile:</p>
            <p class='tvalue'>{$row['mobile']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Email:</p>
            <p class='tvalue'>{$row['email']}</p>
        </div>
        <div class='tdata'>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Department:</p>
            <p class='tvalue'>{$row['university']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Department:</p>
            <p class='tvalue'>{$row['dept']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Semester/Year:</p>
            <p class='tvalue'>{$row['semester']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Transaction ID:</p>
            <p class='tvalue'>{$row['transaction_id']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Student/Hall ID:</p>
            <p class='tvalue'>
            <img style='max-width: 200px;height: auto;width: 100%;' src='studentID/{$row['studentID']}'/>
            </p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Formal Pic:</p>
            <p class='tvalue'>
            <img style='max-width: 200px;height: auto;width: 100%;' src='proPic/{$row['proPic']}'/>
            </p>
        </div>
    </div>";
    }

    echo $output;
} else {
    echo 'No Data Found!';
}
