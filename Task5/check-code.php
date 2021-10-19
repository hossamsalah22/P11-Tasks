<?php
$title = "Check Code";
include_once "views/layouts/header.php";
include_once "app/request/checkCodeRequest.php";
include_once "app/database/models/User.php";

if ($_GET) {
    if (!isset($_GET['page'])) {
        header("Location:views/errors/404.php");
        die;
    } else {
        if (!in_array($_GET['page'], ['login', 'register', 'verify','change-email'])) {
            header("Location:views/errors/404.php");
            die;
        }
    }
} else {
    header("Location:views/errors/404.php");
}

if (isset($_POST['check-code'])) {
    $errors = [];
    $checkCode = new checkCodeRequest;
    $checkCode->setCode($_POST['code']);
    $codeValidationResult = $checkCode->codeValidation();
    if (empty($codeValidationResult)) {
        // check if code is correct in Database
        $userData = new User;
        $userData->setEmail($_SESSION['email']);
        $userData->setCode($_POST['code']);
        $checkCodeResult = $userData->checkCode();
        if ($checkCodeResult) {
            $userData->setStatus(1);
            $userData->setVerified_at(date('Y-m-d H:i:s'));
            $verifyUserResult = $userData->verifyUser();
            if ($verifyUserResult) {
                switch ($_GET['page']) {
                    case 'login':
                        $_SESSION['user'] = $checkCodeResult->fetch_object();
                        header("Location:index.php");
                        unset($_SESSION['email']);
                        die;
                    case 'register':
                        header("Location:login.php");
                        unset($_SESSION['email']);
                        die;
                    case 'verify':
                        header("Location:new-password.php");
                        die;
                    case 'change-email':
                        $_SESSION['user'] = $checkCodeResult->fetch_object();
                        header("Location:my-account.php");
                        unset($_SESSION['email']);
                        die;
                    default:
                        header("Location:views/errors/404.php");
                        die;
                }
            } else {
                $errors['serverError'] = "<div class='alert alert-danger'> SomeThing went wrong, Try Again</div>";
            }
        } else {
            $errors['checkValid'] = "<div class='alert alert-danger'> Code is Invalid</div>";
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
                            <h4> Check Code </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="number" name="code" placeholder="Code" value="<?php if (isset($_POST['code'])) {
                                                                                                        echo $_POST['code'];
                                                                                                    } ?>">
                                        <?php
                                        if (!empty($codeValidationResult)) {
                                            foreach ($codeValidationResult as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        if (!empty($errors)) {
                                            foreach ($errors as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        ?>
                                        <div class="button-box">
                                            <button type="submit" name="check-code" class="form-control"><span>Check Code</span></button>
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