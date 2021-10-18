<?php
$title = "Verify Email";
include_once "views/layouts/header.php";
include_once "middleware/guest.php";
include_once "app/request/checkCodeRequest.php";
include_once "app/database/models/User.php";
include_once "app/request/registerRequest.php";
include_once "app/mail/mail.php";

if (isset($_POST['verify-email'])) {
    $errors = [];
    $emailValidation = new registerRequest;
    $emailValidation->setEmail($_POST['email']);
    $emailValidationResult = $emailValidation->emailValidation();
    if (empty($emailValidationResult)) {
        $emailExistsResult = $emailValidation->emailExists();
        if (!empty($emailExistsResult)) {
            $code = rand(10000, 99999);
            $userData = new User;
            $userData->setCode($code);
            $userData->setEmail($_POST['email']);
            $updateCodeResult = $userData->updateCode();
            if ($updateCodeResult) {
                $checkIfEmailExistsResult = $userData->checkifEmailExists();
                $user = $checkIfEmailExistsResult->fetch_object();
                $subject = "Ecommerce Foreget Password Verification Code";
                $body = "<h2>Hello {$user->first_name}</h2><h3>Your Verification Code Is: <strong>{$code}</strong></h3>";
                $newMail = new mail($_POST['email'], $subject, $body);
                $mailResult = $newMail->sendMail();
                if ($mailResult) {
                    $_SESSION['email'] = $_POST['email'];
                    header("Location:check-code.php?page=verify");die;
                } else {
                    $mailError = "<div class='alert alert-danger'> Something Went Wrong</div>";
                }
            } else {
                $errors['update-error'] = "<div class='alert alert-danger'> Something Went Wrong</div>";
            }
        }
    }
}

?>


<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> <?= $title ?> </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="email" name="email" placeholder="Email" value="<?php if (isset($_POST['email'])) {
                                                                                                        echo $_POST['email'];
                                                                                                    } ?>">
                                        <?php
                                        if (!empty($emailValidationResult)) {
                                            foreach ($emailValidationResult as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        if (!empty($errors)) {
                                            foreach ($errors as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        if (isset($emailExistsResult) && empty($emailExistsResult)) {
                                            echo "<div class='alert alert-danger'> Email Not Found </div>";
                                        }
                                        ?>
                                        <div class="button-box">
                                            <button type="submit" name="verify-email" class="form-control"><span><?= $title ?></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include_once "views/layouts/footer.php"; ?>