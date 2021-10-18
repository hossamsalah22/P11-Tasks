<?php
$title = "Register";
include_once "views/layouts/header.php";
include_once "middleware/guest.php";
include_once "views/layouts/nav.php";
include_once "views/layouts/breadcrumb.php";
include_once "app/request/registerRequest.php";
include_once "app/database/models/User.php";
include_once "app/mail/mail.php";

if ($_POST) {
    $regesterValidation = new registerRequest;
    $regesterValidation->setEmail($_POST["email"]);
    $emailValidationResult = $regesterValidation->emailValidation();
    $emailExistsResult = $regesterValidation->emailExists();
    $regesterValidation->setPassword($_POST["password"]);
    $regesterValidation->setConfirmPassword($_POST["confirmPassword"]);
    $passwordValidationResult = $regesterValidation->passwordValidation();
    $regesterValidation->setPhone($_POST["phone"]);
    $phoneValidation = $regesterValidation->phoneValidation();
    $phoneExistsResult = $regesterValidation->phoneExists();
    $regesterValidation->setFirst_name($_POST["first_name"]);
    $firstNameValidationResult = $regesterValidation->firstNameValidation();
    $regesterValidation->setLast_name($_POST["last_name"]);
    $lastNameValidationResult = $regesterValidation->lastNameValidation();
    $regesterValidation->setGender($_POST["gender"]);
    $genderValidationResult = $regesterValidation->genderValidation();
    if (empty($emailValidationResult) && empty($passwordValidationResult) && empty($phoneValidation)) {
        if (empty($emailExistsResult) && empty($phoneExistsResult)) {
            $code = rand(10000, 99999);
            $userObject = new User;
            $userObject->setFirst_name($_POST['first_name']);
            $userObject->setLast_name($_POST['last_name']);
            $userObject->setEmail($_POST['email']);
            $userObject->setPassword($_POST['password']);
            $userObject->setPhone($_POST['phone']);
            $userObject->setGender($_POST['gender']);
            $userObject->setCode($code);
            $createResult = $userObject->create();
            if ($createResult) {
                // Send Email To user
                $subject = "Ecommerce Verificartion Code";
                $body = "<h2>Hello {$_POST['first_name']}</h2><h3>Your Verification Code Is: <strong>{$code}</strong></h3>";
                $newMail = new mail($_POST['email'],$subject,$body);
                $mailResult = $newMail->sendMail();
                if($mailResult) {
                    $_SESSION['email'] = $_POST['email'];
                    header("Location:check-code.php?page=register");die; 
                } else {
                    $mailError = "<div class='alert alert-danger'> Something Went Wrong, Try To Verify Later </div>";
                }
                // header("Location:check-code.php");
            } else {
                $databaseError = "<div class='alert alert-danger'> Something Went Wrong </div>";
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
                        <a class="active" data-toggle="tab" href="#lg2">
                            <h4> register </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg2" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <?php
                                        if (isset($databaseError)) {
                                            echo $databaseError;
                                        }
                                        if (isset($mailError)) {
                                            echo $mailError;
                                        }
                                        ?>
                                        <input type="text" name="first_name" placeholder="First Name" value="<?php if (!empty($_POST['first_name'])) {
                                                                                                                    echo $_POST['first_name'];
                                                                                                                } ?>">
                                        <?php
                                        if (!empty($firstNameValidationResult)) {
                                            foreach ($firstNameValidationResult as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        ?>
                                        <input type="text" name="last_name" placeholder="Last Name" value="<?php if (!empty($_POST['last_name'])) {
                                                                                                                echo $_POST['last_name'];
                                                                                                            } ?>">
                                        <?php
                                        if (!empty($lastNameValidationResult)) {
                                            foreach ($lastNameValidationResult as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        ?>
                                        <input type="email" name="email" placeholder="Email" value="<?php if (!empty($_POST['email'])) {
                                                                                                        echo $_POST['email'];
                                                                                                    } ?>">
                                        <?php
                                        if (!empty($emailValidationResult)) {
                                            foreach ($emailValidationResult as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        if (!empty($emailExistsResult)) {
                                            foreach ($emailExistsResult as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?php
                                        if (isset($passwordValidationResult['password-required'])) {
                                            echo $passwordValidationResult['password-required'];
                                        }
                                        if (isset($passwordValidationResult['password-pattern'])) {
                                            echo $passwordValidationResult['password-pattern'];
                                        }
                                        ?>
                                        <input type="password" name="confirmPassword" placeholder="Confirm Password">
                                        <?php
                                        if (isset($passwordValidationResult['confirmPassword-required'])) {
                                            echo $passwordValidationResult['confirmPassword-required'];
                                        }
                                        if (isset($passwordValidationResult['password-confirm'])) {
                                            echo $passwordValidationResult['password-confirm'];
                                        }
                                        ?>
                                        <input type="tel" name="phone" placeholder="Phone Number" value="<?php if (!empty($_POST['phone'])) {
                                                                                                                echo $_POST['phone'];
                                                                                                            } ?>">
                                        <?php
                                        if (!empty($phoneValidation)) {
                                            foreach ($phoneValidation as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        if (!empty($phoneExistsResult)) {
                                            foreach ($phoneExistsResult as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        ?>
                                        <select name="gender" class="form-control">
                                            <option value="m" <?php if (isset($_POST["gender"])) {
                                                                    if ($_POST["gender"] == "m") {
                                                                        echo "selected";
                                                                    }
                                                                } ?>>Male</option>
                                            <option value="f" <?php if (isset($_POST["gender"])) {
                                                                    if ($_POST["gender"] == "f") {
                                                                        echo "selected";
                                                                    }
                                                                } ?>>Female</option>
                                        </select>
                                        <?php
                                        if (!empty($genderValidationResult)) {
                                            foreach ($genderValidationResult as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        ?>
                                        <div class="button-box mt-5">
                                            <button type="submit" class=" form-control"><span>Register</span></button>
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


<?php

include_once "views/layouts/footer.php";
?>