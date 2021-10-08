<?php
$title = "Super Market";
include_once("layouts/header.php");

if (isset($_POST['action'])) {
    $errors = [];
    // Check Errors Of User Data Entry 
    if (empty($_POST["userName"])) {
        $errors['userName'] = "<div class='alert alert-danger'> Please enter your name </div>";
    }
    if (empty($_POST["city"])) {
        $errors['city'] = "<div class='alert alert-danger'> Please Select Your City </div>";
    }
    if (empty($_POST["productsAmount"]) || $_POST['productsAmount'] <= 0) {
        $errors['productsAmount'] = "<div class='alert alert-danger'> Please enter A Valid Number Of Products You Want To Buy </div>";
    }
    if (empty($errors)) {

    // Check Errors Of Products Entry 
        if ($_POST['action'] == 'calculate') {
            for ($i = 1; $i <= $_POST['productsAmount']; $i++) {
                if (empty($_POST["productName$i"])) {
                    $error['products']['productAmount'] = "<div class='alert alert-danger'> Please enter products name </div>";
                }
                if (empty($_POST["productPrice$i"]) || $_POST["productPrice$i"] <= 0) {
                    $error['products']['productPrice'] = "<div class='alert alert-danger'> Please enter A Valid Products Price </div>";
                }
                if (empty($_POST["productQuantity$i"]) || $_POST["productQuantity$i"] <= 0) {
                    $error['products']['productQuantity'] = "<div class='alert alert-danger'> Please enter A Valid Number Of The Product Quantity </div>";
                }
            }
            // Claculations Of The Bill
            if (empty($error['products'])) {
                // Calculate Deliver Fess Due To City
                function deliveryFees()
                {
                    switch ($_POST['city']) {
                        case "1":
                            return 0;
                        case "2":
                            return 30;
                        case "3":
                            return 50;
                        case "4":
                            return 100;
                    }
                }
                // Total Amount Of Money For Each Product
                function subPrice()
                {
                    $price = [];
                    for ($i = 1; $i <= $_POST["productsAmount"]; $i++) {
                        $price[$i] = $_POST["productPrice$i"] * $_POST["productQuantity$i"];
                    }
                    return $price;
                }
                // Calculate The Bill
                function totalPrice()
                {
                    $totalPrice = 0;
                    for ($i = 1; $i <= $_POST["productsAmount"]; $i++) {
                        $price = $_POST["productPrice$i"] * $_POST["productQuantity$i"];
                        $totalPrice += $price;
                    }
                    if ($totalPrice < 1000) {
                        $discountValue = 0;
                    } elseif ($totalPrice >= 1000 && $totalPrice < 3000) {
                        $discountValue = 0.1;
                    } elseif ($totalPrice >= 3000 && $totalPrice < 4500) {
                        $discountValue = 0.15;
                    } elseif ($totalPrice >= 4500) {
                        $discountValue = 0.2;
                    }
                    $discountAmount = $discountValue * $totalPrice;
                    $priceAfterDiscount = $totalPrice - $discountAmount;
                    $netTotal = $priceAfterDiscount + deliveryFees();
                    return array($totalPrice, $discountAmount, $priceAfterDiscount, $netTotal);
                }
            }
        }
    }
}
?>

<div class="container bg-dark text-white">
    <div class="row mt-5">
        <div class="col-12">
            <div class="h1 text-center my-3">Super Market</div>
            <form action="" method="post">
                <div class="col-6 offset-3">
                    <!-- User Info Table -->
                    <div class="form-group">
                        <label for="userName" class="text-left font-weight-bold">User Name</label>
                        <input type="text" name="userName" id="userName" class="form-control" value="<?php if (!empty($_POST['userName'])) {
                                                                                                            echo $_POST['userName'];
                                                                                                        } ?>" placeholder="Please Enter Your Name">
                    </div>
                    <?php if (!empty($errors['userName'])) {
                        echo $errors['userName'];
                    } ?>
                    <div class="form-group">
                        <label for="city" class="text-left font-weight-bold">City</label>
                        <select name="city" id="city" class="form-control">
                            <option value="0" selected disabled>Select Your City</option>
                            <option value="1" <?php if (!empty($_POST['city']) && $_POST['city'] == 1) {
                                                    echo "selected";
                                                } ?>>Cairo</option>
                            <option value="2" <?php if (!empty($_POST['city']) && $_POST['city'] == 2) {
                                                    echo "selected";
                                                } ?>>Giza</option>
                            <option value="3" <?php if (!empty($_POST['city']) && $_POST['city'] == 3) {
                                                    echo "selected";
                                                } ?>>Alexandria</option>
                            <option value="4" <?php if (!empty($_POST['city']) && $_POST['city'] == 4) {
                                                    echo "selected";
                                                } ?>>Other</option>
                        </select>
                    </div>
                    <?php if (!empty($errors['city'])) {
                        echo $errors['city'];
                    } ?>
                    <div class="form-group">
                        <label for="productsAmount" class="text-left font-weight-bold">Number Of Products</label>
                        <input type="number" name="productsAmount" id="productsAmount" class="form-control" value="<?php if (!empty($_POST['productsAmount'])) {
                                                                                                                        echo $_POST['productsAmount'];
                                                                                                                    } ?>" placeholder="Please Enter Your Name">
                    </div>
                    <!-- printing Errors -->
                    <?php if (!empty($errors['productsAmount'])) {
                        echo $errors['productsAmount'];
                    } ?>
                    <div class="form-group">
                        <label></label>
                        <button class="btn btn-success form-control rounded" name="action" value="enterProducts">Enter Products</button>
                    </div>
                </div>
                <?php if (isset($_POST['action']) && empty($errors)) {
                    if ($_POST['action'] == 'calculate' && empty($error)) { ?>
                    <!-- Products Review Table -->
                        <div class="col-6 offset-3">
                            <div class="form-group">
                                <div class="h1 text-center text-white">Products Review</div>
                                <table class='table mt-5 text-center text-white'>
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantites</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 1; $i <= $_POST['productsAmount']; $i++) {
                                            echo "<tr><td>" . $_POST["productName$i"] . "</td>
                                    <td>" . $_POST["productPrice$i"] . "</td>
                                    <td>" . $_POST["productQuantity$i"] . "</td>
                                    <td>" . subPrice()[$i] . "</td>
                                    </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Bill Review Table -->
                        <div class="h1 text-center text-warning">Bill Review</div>
                        <table class='table mt-5 text-white'>
                                    <thead>
                                        <tr>
                                            <th>Client Name :- </th>
                                            <td class="text-center"><?= $_POST['userName'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>City :- </th>
                                            <td class="text-center"><?php switch($_POST['city']){
                                                case "1": echo "Cairo";break;
                                                case "2": echo "Giza";break;
                                                case "3": echo "Alexandria";break;
                                                case "4": echo "Other";break;
                                            } ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total :- </th>
                                            <td class="text-center"><?php echo totalPrice()[0] . " EGP"; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Discount :- </th>
                                            <td class="text-center"><?php echo totalPrice()[1] . " EGP"; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total After Discount :- </th>
                                            <td class="text-center"><?php echo totalPrice()[2] . " EGP"; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Delivery :- </th>
                                            <td class="text-center"><?php echo deliveryFees() . " EGP"; ?></td>
                                        </tr>
                                        <tr class=" text-warning">
                                            <th>Net Total :- </th>
                                            <td class="text-center"><?php echo totalPrice()[3] . " EGP"; ?></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                    <?php } else { ?>
                        <!-- Products Entring Table -->
                        <div class="col-6 offset-3">
                            <div class='form-group'>
                                <table class='table mt-5 text-center text-white'>
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantites</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 1; $i <= $_POST['productsAmount']; $i++) {
                                            echo "<tr><td> <input type='text' value='";
                                            if (!empty($_POST["productName$i"])) {
                                                echo $_POST["productName$i"];
                                            }
                                            echo "' name='productName$i' id='productName$i' class='form-control' placeholder='Product $i'></td>
                                        <td><input type='number' value='";
                                            if (!empty($_POST["productPrice$i"])) {
                                                echo $_POST["productPrice$i"];
                                            }
                                            echo "' name='productPrice$i' id='productPrice$i' class='form-control' placeholder='Price $i'></td>
                                        <td><input type='number' value='";
                                            if (!empty($_POST["productQuantity$i"])) {
                                                echo $_POST["productQuantity$i"];
                                            }
                                            echo "' name='productQuantity$i' id='productQuantity$i' class='form-control' placeholder='Quantity $i'></td>
                                        </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                                if (!empty($error['products'])) {
                                    foreach ($error['products'] as $key => $value) {
                                        echo $value;
                                    }
                                } ?>
                            </div>
                            <div class='form-group'>
                                <label></label>
                                <button class='btn btn-success form-control rounded' name='action' value='calculate'>Calculate</button>
                            </div>
                        </div>
                <?php
                    }
                } ?>
            </form>
        </div>
        </form>
    </div>
</div>

<?php
include_once("layouts/footer.php");
?>