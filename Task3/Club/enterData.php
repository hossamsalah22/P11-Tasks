<?php
$title = "Information";
include_once("layouts/header.php");
include_once("middleware/guest.php");
if($_POST) {
    $errors = [];
    if(empty($_POST['subscriberName'])) {
        $errors['subscriberName'] = "<div class='alert alert-danger'> Please Enter Your Name</div>";
    }
    if(empty($_POST['familyCount']) || $_POST['familyCount'] <= 0 ) {
        $errors['familyCount'] = "<div class='alert alert-danger'> Please Enter Your Family Count</div>";
    }

    if(empty($errors)) {
        foreach($_POST AS $key=>$value) {
            $_SESSION['subscriberInfo'][$key] = $value;
        }
        header("location:subscribe.php");
    }
}
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-12 text-center">
            <div class="h1 text-primary font-weight-bolder text-uppercase">Welcome TO the Club</div>
            <form action="" method="post">
                <div class="col-6 offset-3 text-left mt-5">
                    <div class="form-group">
                        <label for="">Subscriber Name</label>
                        <input type="text" name="subscriberName" id="" class="form-control" placeholder="Please Enter your Name" value="<?php if(!empty($_POST['subscriberName'])){echo $_POST['subscriberName'];} ?>" aria-describedby="helpId">
                        <small id="helpId" class="text-primary">Club Subscribtion Starts With 10,000 EGP</small>
                    </div>
                    <?php if(!empty($errors['subscriberName'])){echo $errors['subscriberName'];} ?>
                    <div class="form-group">
                        <label for="">Count Of Family Members</label>
                        <input type="number" name="familyCount" id="" class="form-control" placeholder="Count of family members" value="<?php if(!empty($_POST['familyCount'])){echo $_POST['familyCount'];} ?>" aria-describedby="helpId">
                        <small id="helpId" class="text-primary">Club Subscribtion for Each Member is 2500 EGP</small>
                    </div>
                    <?php if(!empty($errors['familyCount'])){echo $errors['familyCount'];} ?>
                    <div class="form-group">
                        <label for=""></label>
                        <button class="btn btn-primary form-control">Subscribe</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once("layouts/footer.php");
?>