<?php
$title = "Login";
include_once "views/layouts/header.php";
include_once "middleware/guest.php";
include_once "views/layouts/nav.php";
include_once "views/layouts/breadcrumb.php";
include_once "app/request/registerRequest.php";
include_once "app/request/loginRequest.php";
include_once "app/database/models/User.php";
include_once "app/mail/mail.php";

if (isset($_POST['login'])) {
    $errors = [];
    // email Valdidation
    $emailValidation = new registerRequest;
    $emailValidation->setEmail($_POST['email']);
    $emailValidationResult = $emailValidation->emailValidation();
    // password Validation
    $passwordValidation = new loginRequest;
    $passwordValidation->setPassword($_POST['password']);
    $passwordValidationResult = $passwordValidation->passwordValidation();
    // Validation Success
    if (empty($emailValidationResult) && empty($emailValidationResult)) {
        $userData = new User;
        $userData->setEmail($_POST['email']);
        $userData->setPassword($_POST['password']);
        $loginResult = $userData->login();
        // if attempt success
        if ($loginResult) {
            $user = $loginResult->fetch_object();
            // check user status
            if ($user->status != 1) {
                $subject = "Ecommerce Verificartion Code";
                $body = "<h2>Hello {$user->first_name}</h2><h3>Your Verification Code Is: <strong>{$user->code}</strong></h3>";
                $newMail = new mail($_POST['email'], $subject, $body);
                $mailResult = $newMail->sendMail();
                // if user not verified send mail again and goto check-code page
                if ($mailResult) {
                    $_SESSION['email'] = $_POST['email'];
                    header("Location:check-code.php?page=login");
                    die;
                } else {
                    $errors['mail-error'] = "<div class='alert alert-danger'> Something Went Wrong </div>";
                }
                // if user Verified goto home page
            } else {
                $_SESSION['user'] = $user;
                header("Location:index.php");
                die;
            }
        } else {
            $errors['wrong-attempt'] = "<div class='alert alert-danger'> Wrong Data </div>";
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
                            <h4> login </h4>
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
                                        ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?php
                                        if (!empty($passwordValidationResult)) {
                                            foreach ($passwordValidationResult as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        if (isset($errors)) {
                                            foreach ($errors as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        ?>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <a href="verify-email.php">Forgot Password?</a>
                                            </div>
                                            <button type="submit" name="login"><span>Login</span></button>
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