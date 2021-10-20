<?php
$title = "My Account";
include_once "views/layouts/header.php";
include_once "middleware/auth.php";
include_once "app/database/models/User.php";
include_once "app/request/registerRequest.php";
include_once "app/services/uploadImage.php";
include_once "app/request/loginRequest.php";
include_once "app/request/changePasswordRequest.php";
include_once "app/request/changeEmailRequest.php";
include_once "app/mail/mail.php";

// Get User From Database with Id
$userData = new User;
$userData->setId($_SESSION['user']->id);
define('notVerified', 0);
if ($_SESSION['user']->image != "defualt.png") {
    $oldImage = $_SESSION['user']->image;
}

// Update User in DB Validation
if (isset($_POST['update-profile'])) {
    $errors = [];
    $success = [];
    // Data Validation
    $validationRequest = new registerRequest;
    $validationRequest->setFirst_name($_POST['first_name']);
    $firstNameValidation = $validationRequest->firstNameValidation();
    $validationRequest->setLast_name($_POST['last_name']);
    $lastNameValidation = $validationRequest->lastNameValidation();
    $validationRequest->setPhone($_POST['phone']);
    $PhoneValidation = $validationRequest->PhoneValidation();
    $validationRequest->setGender($_POST['gender']);
    $genderValidation = $validationRequest->genderValidation();
    if (empty($firstNameValidation) && empty($lastNameValidation) && empty($PhoneValidation) && empty($genderValidation)) {
        // pass data from Form to user model
        $userData->setFirst_name($_POST['first_name']);
        $userData->setLast_name($_POST['last_name']);
        $userData->setPhone($_POST['phone']);
        $userData->setGender($_POST['gender']);
        // image upload if exists
        if ($_FILES['image']['error'] == 0) {
            $directory = "assets/img/users/";
            $uploadImage = new uploadImage($_FILES['image'], $directory);
            $sizeValidation = $uploadImage->sizeValidation();
            $extensionValidation = $uploadImage->extensionValidation();

            if (empty($sizeValidation) && empty($extensionValidation)) {
                // upload photo if image Validation Success 
                $photoName = $uploadImage->uploadPhoto();
                $_SESSION['user']->image = $photoName;
                $userData->setImage($photoName);
            }
        }
        // update User in Database
        if (empty($sizeValidation) && empty($extensionValidation)) {
            $updateResult = $userData->update();
            if ($updateResult) {
                // Delete old photo 
                if (isset($oldImage)) {
                    unlink($directory . $oldImage);
                }
                // update Session if update was successful 
                $_SESSION['user']->first_name = $_POST['first_name'];
                $_SESSION['user']->last_name = $_POST['last_name'];
                $_SESSION['user']->phone = $_POST['phone'];
                $_SESSION['user']->gender = $_POST['gender'];
                $success['success-update'] = "<div class= 'alert alert-success'> Updated Successfully</div>";
            } else {
                // if update Failed
                $errors['failed-update'] = "<div class= 'alert alert-danger'> Something Went Wrong</div>";
            }
        }
    }
}
// Change User's Password in DB Validation
if (isset($_POST['change-password'])) {
    $errors = [];
    $success = [];
    // old Password Validation
    $oldPasswordValidation = new loginRequest;
    $oldPasswordValidation->setPassword($_POST['oldPassword']);
    $oldPasswordValidationResult = $oldPasswordValidation->passwordValidation();
    // if old password Validation Success
    if (empty($oldPasswordValidationResult)) {
        // check if old password is the user's Password
        $userData->setPassword($_POST['oldPassword']);
        if ($userData->getPassword() != $_SESSION['user']->password) {
            $errors['wrong-old'] = "<div class='alert alert-danger'> Wrong Password </div>";
            // if the old password is correct
        } else {
            // validation on new password and new password confirm
            $newPasswordValidation = new registerRequest;
            $newPasswordValidation->setPassword($_POST['newPassword']);
            $newPasswordValidation->setConfirmPassword($_POST['confirmNewPassword']);
            $newPasswordValidationResult = $newPasswordValidation->passwordValidation();
            // if validation success
            if (empty($newPasswordValidationResult)) {
                // check if the new password is not the old passsword
                $passwordChanged = new changePasswordRequest;
                $passwordChanged->setOldPassword($_POST['oldPassword']);
                $passwordChanged->setNewPassword($_POST['newPassword']);
                $passwordChangedResult = $passwordChanged->checkIfSamePassword();
                // if new password is not the old password
                if (empty($passwordChangedResult)) {
                    // update user's password in DB
                    $userData->setPassword($_POST['newPassword']);
                    $userData->setEmail($_SESSION['user']->email);
                    $updatePassword = $userData->updatePassword();
                    if ($updatePassword) {
                        $success['password-updated'] = "<div class='alert alert-success'> Password Updated Successfully </div>";
                    } else {
                        $errors['password-failed'] = "<div class='alert alert-danger'> Something Went Wrong </div>";
                    }
                }
            }
        }
    }
}

if (isset($_POST['change-email'])) {
    $emailValidation = new registerRequest;
    $emailValidation->setEmail($_POST['email']);
    $emailValidationResult = $emailValidation->emailValidation();
    if (empty($emailValidationResult)) {
        $checkEmail = new changeEmailRequest;
        $checkEmail->setEmail($_POST['email']);
        $checkEmailResult = $checkEmail->checkIfSameEmail();
        if (empty($checkEmailResult)) {
            $emailExists = $emailValidation->emailExists();
            if (empty($emailExists)) {
                $code = rand(10000, 99999);
                $userData->setEmail($_POST['email']);
                $userData->setStatus(notVerified);
                $userData->setVerified_at('NULL');
                $userData->setCode($code);
                $updateEmailResult = $userData->updateEmail();
                if ($updateEmailResult) {
                    $subject = "Ecommerce Email Changed Successfully";
                    $body = "<h2>Hello {$_SESSION['user']->first_name}</h2><h3>Your Verification Code Is: <strong>{$code}</strong></h3>";
                    $mail = new mail($_POST['email'], $subject, $body);
                    $mailResult = $mail->sendMail();
                    if ($mailResult) {
                        unset($_SESSION['user']);
                        $_SESSION['email'] = $_POST['email'];
                        header("Location:check-code.php?page=change-email");
                        die;
                    } else {
                        $errors['email-failed'] = "<div class='alert alert-danger'> Something Went Wrong </div>";
                    }
                } else {
                    $errors['email-failed'] = "<div class='alert alert-danger'> Something Went Wrong </div>";
                }
            }
        }
    }
}
// Fetch The User
$userDataResult = $userData->getUserById();
$user = $userDataResult->fetch_object();
include_once "views/layouts/nav.php";
include_once "views/layouts/breadcrumb.php";
?>



<!-- my account start -->
<div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h5>
                            </div>
                            <div id="my-account-1" class="panel-collapse collapse <?php if (isset($_POST['update-profile'])) {
                                                                                        echo "show";
                                                                                    } ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Change Your Account Information</h4>
                                        </div>
                                        <form method="post" enctype="multipart/form-data">

                                            <div class="row">
                                                <div class="col-12">
                                                    <?php
                                                    if (isset($errors['failed-update'])) {
                                                        echo $errors['failed-update'];
                                                    }
                                                    if (isset($success['success-update'])) {
                                                        echo $success['success-update'];
                                                    }
                                                    ?>

                                                </div>
                                                <div class="col-lg-6 col-md-6 offset-3 mb-5">
                                                    <div class="billing-info">
                                                        <img src="assets/img/users/<?= $user->image ?>" alt="<?= $user->first_name . ' ' . $user->last_name ?>" class="rounded-circle mb-3 w-100">
                                                        <input type="file" name="image">
                                                    </div>
                                                    <?php
                                                    if (!empty($sizeValidation)) {
                                                        foreach ($sizeValidation as $key => $value) {
                                                            echo $value;
                                                        }
                                                    }
                                                    if (!empty($extensionValidation)) {
                                                        foreach ($extensionValidation as $key => $value) {
                                                            echo $value;
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>First Name</label>
                                                        <input type="text" name="first_name" value="<?= $user->first_name ?>">
                                                    </div>
                                                    <?php
                                                    if (!empty($firstNameValidation)) {
                                                        foreach ($firstNameValidation as $key => $value) {
                                                            echo $value;
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Last Name</label>
                                                        <input type="text" name="last_name" value="<?= $user->last_name ?>">
                                                    </div>
                                                    <?php
                                                    if (!empty($lastNameValidation)) {
                                                        foreach ($lastNameValidation as $key => $value) {
                                                            echo $value;
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Phone</label>
                                                        <input type="text" name="phone" value="<?= $user->phone ?>">
                                                    </div>
                                                    <?php
                                                    if (!empty($PhoneValidation)) {
                                                        foreach ($PhoneValidation as $key => $value) {
                                                            echo $value;
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Gender</label>
                                                        <select name="gender">
                                                            <option value="m" <?= $user->gender == "m" ? 'selected' : '' ?>>Male</option>
                                                            <option value="f" <?= $user->gender == "f" ? 'selected' : '' ?>>Female</option>
                                                        </select>
                                                    </div>
                                                    <?php
                                                    if (!empty($genderValidation)) {
                                                        foreach ($genderValidation as $key => $value) {
                                                            echo $value;
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="update-profile">Update Profile</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                            </div>
                            <div id="my-account-2" class="panel-collapse collapse  <?php if (isset($_POST['change-password'])) {
                                                                                        echo "show";
                                                                                    } ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Change Password</h4>
                                        </div>
                                        <form method="post">

                                            <div class="row">
                                                <div class="col-12">
                                                    <?php
                                                    if (isset($errors['password-failed'])) {
                                                        echo $errors['password-failed'];
                                                    }
                                                    if (isset($success['password-updated'])) {
                                                        echo $success['password-updated'];
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Old Password</label>
                                                        <input type="password" name="oldPassword">
                                                    </div>
                                                    <?php
                                                    if (!empty($oldPasswordValidationResult)) {
                                                        foreach ($oldPasswordValidationResult as $key => $value) {
                                                            echo $value;
                                                        }
                                                    }

                                                    if (isset($errors['wrong-old'])) {
                                                        echo $errors['wrong-old'];
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>New Password</label>
                                                        <input type="password" name="newPassword">
                                                    </div>
                                                    <?php
                                                    if (isset($newPasswordValidationResult['password-required'])) {
                                                        echo $newPasswordValidationResult['password-required'];
                                                    }
                                                    if (isset($newPasswordValidationResult['password-pattern'])) {
                                                        echo $newPasswordValidationResult['password-pattern'];
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Confirm New Password</label>
                                                        <input type="password" name="confirmNewPassword">
                                                    </div>
                                                    <?php
                                                    if (isset($newPasswordValidationResult['confirmPassword-required'])) {
                                                        echo $newPasswordValidationResult['confirmPassword-required'];
                                                    }
                                                    if (isset($newPasswordValidationResult['password-confirm'])) {
                                                        echo $newPasswordValidationResult['password-confirm'];
                                                    }

                                                    if (!empty($passwordChangedResult)) {
                                                        foreach ($passwordChangedResult as $key => $value) {
                                                            echo $value;
                                                        }
                                                    }

                                                    ?>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="change-password">Change Password</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>3</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Change Your Email</a></h5>
                            </div>
                            <div id="my-account-3" class="panel-collapse collapse  <?php if (isset($_POST['change-email']) || isset($_SESSION['email-updated'])) {
                                                                                        echo "show";
                                                                                    } ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Change Email</h4>
                                        </div>
                                        <div class="entries-wrapper">
                                            <div class="row">
                                                <form method="post">

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <?php
                                                            if (isset($_SESSION['email-updated'])) {
                                                                echo $_SESSION['email-updated'];
                                                                unset($_SESSION['email-updated']);
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="billing-info">
                                                                <label>Email</label>
                                                                <input type="email" name="email" value="<?= $user->email ?>">
                                                            </div>
                                                            <?php
                                                            if (!empty($emailValidationResult)) {
                                                                foreach ($emailValidationResult as $key => $value) {
                                                                    echo $value;
                                                                }
                                                            }
                                                            if (!empty($checkEmailResult)) {
                                                                foreach ($checkEmailResult as $key => $value) {
                                                                    echo $value;
                                                                }
                                                            }
                                                            if (!empty($emailExists)) {
                                                                foreach ($emailExists as $key => $value) {
                                                                    echo $value;
                                                                }
                                                            }
                                                            if (isset($errors['email-failed'])) {
                                                                echo $errors['email-failed'];
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="billing-back-btn">
                                                        <div class="billing-btn">
                                                            <button type="submit" name="change-email">Change Email</button>
                                                        </div>
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
        </div>
    </div>
</div>
<!-- my account end -->

<?php
include_once "views/layouts/footer.php";
?>