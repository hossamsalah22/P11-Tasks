<?php
$title = "Hospital";
include_once("layouts/header.php");
include_once("middleware/guest.php");
if($_POST) {
    $errors = "";
    if(empty($_POST['phoneNumber'])) {
        $errors = "<div class='alert alert-danger'> Please Enter Your phone number</div>";
    }

    if(empty($errors)) {
        $_SESSION['phoneNumber'] = $_POST['phoneNumber'];
        header("location:questions.php");
    }
}
?>


<div class="container">
    <div class="row">
        <div class="col-12 text-center bg-dark text-white">
            <div class="h1 text-center py-5">Hospital</div>
            <form action="" method="POST">
                <div class="col-6 offset-3">
                    <div class="form-group row py-1">
                        <input type="text" name="" id="" class="form-control col-3" placeholder="Phone Number" readonly aria-describedby="helpId">
                        <input type="text" name="phoneNumber" id="" class="form-control col-9" placeholder="Please enter your Phone Number" aria-describedby="helpId">
                        <small id="helpId" class="text-danger">Notice: Your Number will only be used by the Hospital to get contact with you</small>
                    </div>
                    <?php if(!empty($errors)) { echo $errors;} ?>
                    <div class="form-group row">
                        <button class="btn btn-warning form-control">Start Survey</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php

include_once("layouts/footer.php");

?>