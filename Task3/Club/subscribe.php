<?php
$title = "family subscription";
include_once("layouts/header.php");
include_once("middleware/auth.php");
if ($_POST) {
    $errors = [];
    for ($i = 1; $i <= $_SESSION['subscriberInfo']['familyCount']; $i++) {
        if (empty($_POST["member$i"])) {
            $errors["member$i"] = "<div class='alert alert-danger'> Please Enter This member's Name </div>";
        }
    }
    if(empty($errors)) {
        foreach($_POST AS $key=>$value) {
            $_SESSION['familyInfo'][$key] = $value;
        }
        header("location:invoice.php");
    }
}
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-12 text-center">
            <div class="h1 text-primary font-weight-bolder text-uppercase">Family Subscribtion</div>
            <form action="" method="post">
                <div class="col-6 offset-3 text-left mt-5">
                    <!-- Form for Each Member in the Family -->
                    <?php
                    for ($i = 1; $i <= $_SESSION['subscriberInfo']['familyCount']; $i++) {
                        $sub =  "<div class='form-group'> 
                                <label for=''>Member $i</label>
                                <input type='text' name='member$i' id='' value='";
                        if (!empty($_POST["member$i"])) {
                            $sub .= $_POST["member$i"];
                        }
                        $sub .= "' class='form-control' placeholder='member name' aria-describedby='helpId'>
                                <input type='checkbox' name='football$i' value='300' ";
                        if (isset($_POST["football$i"])) {
                            $sub .= "checked";
                        }
                        $sub .= " id='football$i'>&nbsp;&nbsp;<label for='football$i'>Football (350EGP)</label><br>
                                <input type='checkbox' name='swimming$i' value='250' ";
                        if (isset($_POST["swimming$i"])) {
                            $sub .= "checked";
                        }
                        $sub .= " id='swimming$i'>&nbsp;<label for='swimming$i'>Swimming (250EGP)</label><br>
                                <input type='checkbox' name='volleyball$i' value='150' ";
                        if (isset($_POST["volleyball$i"])) {
                            $sub .= "checked";
                        }
                        $sub .= " id='volleyball$i'>&nbsp;<label for='volleyball$i'>Volleyball (150EGP)</label><br>
                                <input type='checkbox' name='others$i' value='100' ";
                        if (isset($_POST["others$i"])) {
                            $sub .= "checked";
                        }
                        $sub .= " id='others$i'>&nbsp;<label for='others$i'>Others (100EGP)</label><br>
                                </div>";
                        echo $sub;
                        if (!empty($errors["member$i"])) {
                            echo $errors["member$i"];
                        }
                    }
                    ?>
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