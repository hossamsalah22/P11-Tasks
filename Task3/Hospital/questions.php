<?php
$title = "Hospital Survey";
include_once("layouts/header.php");

include_once("middleware/authPhone.php");

if ($_POST) {
    $errors = [];
    if(!isset($_POST['cleanliness']) 
    || !isset($_POST['servicePrices'])
    || !isset($_POST['nursing'])
    || !isset($_POST['doctors'])
    || !isset($_POST['quiteness'])) {
        $errors = "<div class='alert alert-danger'>Please Answer All Questions</div>";
    }

    if(empty($errors)) {
        $_SESSION['total'] = $_POST['cleanliness'] + $_POST['servicePrices'] + $_POST['nursing'] + $_POST['doctors']
        +$_POST['quiteness'];
        foreach($_POST as $key=>$value) {
            $_SESSION["survey"][$key] = $value;
        }
        header("location:result.php");
    }
}

?>

<div class="container">
    <div class="row" style="margin-top: 20vh;">
        <div class="col-12 text-center bg-dark text-white">
            <div class="h1 text-center py-5">Hospital Survey</div>
            <form action="" method="POST">
                <div class="col-9 offset-1">
                    <table class="table table-bordered table-hover table-dark">
                        <thead>
                            <tr>
                                <th class="text-left">Questions</th>
                                <th>Bad</th>
                                <th>Good</th>
                                <th>Very Good</th>
                                <th>Excellent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-left">Are You Satisified With the level of cleanliness?</th>
                                <td>
                                    <input type="radio" name="cleanliness" id="" value="0">
                                </td>
                                <td>
                                    <input type="radio" name="cleanliness" id="" value="3">
                                </td>
                                <td>
                                    <input type="radio" name="cleanliness" id="" value="5">
                                </td>
                                <td>
                                    <input type="radio" name="cleanliness" id="" value="10">
                                </td>
                            </tr>
                            <tr>
                                <th class="text-left">Are You Satisified With the services Prices?</th>
                                <td>
                                    <input type="radio" name="servicePrices" id="" value="0">
                                </td>
                                <td>
                                    <input type="radio" name="servicePrices" id="" value="3">
                                </td>
                                <td>
                                    <input type="radio" name="servicePrices" id="" value="5">
                                </td>
                                <td>
                                    <input type="radio" name="servicePrices" id="" value="10">
                                </td>
                            </tr>
                            <tr>
                                <th class="text-left">Are You Satisified With the Nursing?</th>
                                <td>
                                    <input type="radio" name="nursing" id="" value="0">
                                </td>
                                <td>
                                    <input type="radio" name="nursing" id="" value="3">
                                </td>
                                <td>
                                    <input type="radio" name="nursing" id="" value="5">
                                </td>
                                <td>
                                    <input type="radio" name="nursing" id="" value="10">
                                </td>
                            </tr>
                            <tr>
                                <th class="text-left">Are You Satisified With the level of The Doctors?</th>
                                <td>
                                    <input type="radio" name="doctors" id="" value="0">
                                </td>
                                <td>
                                    <input type="radio" name="doctors" id="" value="3">
                                </td>
                                <td>
                                    <input type="radio" name="doctors" id="" value="5">
                                </td>
                                <td>
                                    <input type="radio" name="doctors" id="" value="10">
                                </td>
                            </tr>
                            <tr>
                                <th class="text-left">Are You Satisified With the quiet in the hospital?</th>
                                <td>
                                    <input type="radio" name="quiteness" id="" value="0">
                                </td>
                                <td>
                                    <input type="radio" name="quiteness" id="" value="3">
                                </td>
                                <td>
                                    <input type="radio" name="quiteness" id="" value="5">
                                </td>
                                <td>
                                    <input type="radio" name="quiteness" id="" value="10">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php if (!empty($errors)) {
                        echo $errors;
                    } ?>
                    <div class="form-group row">
                        <button class="btn btn-warning form-control">Submit Survey</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php

include_once("layouts/footer.php");

?>