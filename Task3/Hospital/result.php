<?php
$title = "Hospital Survey";
include_once("layouts/header.php");
include_once("middleware/authSurvey.php");

$message = "<div class='alert alert-success'> Thank You For Your Survey</div>";
if($_SESSION['total'] < 25) {
    $message = "<div class='alert alert-danger'> We'll Call You on This Number ". $_SESSION['phoneNumber'] ."</div>";
}

$review = [];
$i=0;
foreach ($_SESSION['survey'] as $key => $value) {
    if($value == 0) {
        $review[$i] = "Bad";
        $i++;
        continue;
    }
    if($value == 3) {
        $review[$i] = "Good";
        $i++;
        continue;
    }
    if($value == 5) {
        $review[$i] = "Very Good";
        $i++;
        continue;
    }
    if($value == 10) {
        $review[$i] = "Excellent";
        $i++;
        continue;
    }
}
session_destroy();
?>

<div class="container">
    <div class="row" style="margin-top: 20vh;">
        <div class="col-12 text-center bg-dark text-white">
            <div class="h1 text-center py-5">Hospital Survey Review</div>
                <div class="col-9 offset-1">
                    <table class="table table-bordered table-hover table-dark">
                        <thead>
                            <tr>
                                <th class="text-left">Questions</th>
                                <th>Review</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-left">Are You Satisified With the level of cleanliness?</th>
                                <td>
                                    <div class="h6"><?= $review[0] ?></div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-left">Are You Satisified With the services Prices?</th>
                                <td>
                                    <div class="h6"><?= $review[1] ?></div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-left">Are You Satisified With the Nursing?</th>
                                <td>
                                    <div class="h6"><?= $review[2] ?></div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-left">Are You Satisified With the level of The Doctors?</th>
                                <td>
                                    <div class="h6"><?= $review[3] ?></div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-left">Are You Satisified With the quiet in the hospital?</th>
                                <td>
                                    <div class="h6"><?= $review[4] ?></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?= $message ?>
                </div>
        </div>
    </div>
</div>


<?php

include_once("layouts/footer.php");

?>