<?php
$title = "Invoice";
include_once("layouts/header.php");
include_once("middleware/subscriber.php");


function detailedPrice() {
    $footballPricing = 0;
    $swimmingPricing = 0;
    $volleyballPricing = 0;
    $othersPricing = 0;
    for ($i = 1; $i <= $_SESSION['subscriberInfo']['familyCount']; $i++) {
        if(isset($_SESSION['familyInfo']["football$i"])){
            $footballPricing += $_SESSION['familyInfo']["football$i"];
        }
        if(isset($_SESSION['familyInfo']["swimming$i"])){
            $swimmingPricing += $_SESSION['familyInfo']["swimming$i"];
        }
        if(isset($_SESSION['familyInfo']["volleyball$i"])){
            $volleyballPricing += $_SESSION['familyInfo']["volleyball$i"];
        }
        if(isset($_SESSION['familyInfo']["others$i"])){
            $othersPricing += $_SESSION['familyInfo']["others$i"];
        }
    }
    return array($footballPricing,$swimmingPricing, $volleyballPricing,$othersPricing);
}

?>

<div class="container">
    <div class="row mt-5">
        <div class="col-12 text-center">
            <div class="h1 text-primary font-weight-bolder text-uppercase">Checking price</div>
            <form action="" method="post">
                <div class="col-9 offset-1 text-left mt-5">
                    <table class="table">
                        <!-- Information Section -->
                        <tr class="text-center bg-dark text-primary">
                            <th>Subscriber</th>
                            <th colspan="5" class="text-center"><?= $_SESSION['subscriberInfo']['subscriberName'] ?></th>
                        </tr>
                        <?php
                        for ($i = 1; $i <= $_SESSION['subscriberInfo']['familyCount']; $i++) {
                            $price[$i-1] = 0;
                            $memberInfo = "<tr class='text-center'><th>";
                            $memberInfo .= $_SESSION['familyInfo']["member$i"];
                            $memberInfo .= "</th><td>";
                            if(isset($_SESSION['familyInfo']["football$i"])){
                                $memberInfo .= "Football";
                                $price[$i-1] += $_SESSION['familyInfo']["football$i"];
                            }
                            $memberInfo .= "</td><td>";
                            if(isset($_SESSION['familyInfo']["swimming$i"])){
                                $memberInfo .= "Swimming";
                                $price[$i-1] += $_SESSION['familyInfo']["swimming$i"];
                            }
                            $memberInfo .= "</td><td>";
                            if(isset($_SESSION['familyInfo']["volleyball$i"])){
                                $memberInfo .= "Volleyball";
                                $price[$i-1] += $_SESSION['familyInfo']["volleyball$i"];
                            }
                            $memberInfo .= "</td><td>";
                            if(isset($_SESSION['familyInfo']["others$i"])){
                                $memberInfo .= "Others";
                                $price[$i-1] += $_SESSION['familyInfo']["others$i"];
                            }
                            $memberInfo .= "</td><td>";
                            $memberInfo .= $price[$i-1];
                            $memberInfo .= " EGP</td><td></tr>";
                            echo $memberInfo;
                        }
                        ?>
                        <!-- Pricing  -->
                        <tr class="text-center bg-dark text-primary">
                            <th>Total Price</th>
                            <td colspan="4"></td>
                            <th class="text-center"><?php 
                            $totalPrice = 0;
                                foreach($price AS $index=>$value) {
                                    $totalPrice += $value;
                                }
                                echo $totalPrice . " EGP";
                            ?></th>
                        </tr>
                        <!-- Pricing in Details -->
                        <tr class="text-center">
                            <th>Football Club</th>
                            <td colspan="4"></td>
                            <td><?= detailedPrice()[0] ?></td>
                        </tr>
                        <tr class="text-center">
                            <th>Swimming Club</th>
                            <td colspan="4"></td>
                            <td><?= detailedPrice()[1] ?></td>
                        </tr>
                        <tr class="text-center">
                            <th>VolleyBall Club</th>
                            <td colspan="4"></td>
                            <td><?= detailedPrice()[2] ?></td>
                        </tr>
                        <tr class="text-center">
                            <th>Others Club</th>
                            <td colspan="4"></td>
                            <td><?= detailedPrice()[3] ?></td>
                        </tr>
                        <!-- Total Subscribtion Price -->
                        <tr class="text-center bg-dark text-primary">
                            <th>Club Subscription</th>
                            <td colspan="4"></td>
                            <th><?php 
                                $memberPrice = $_SESSION['subscriberInfo']['familyCount'] * 2500;
                                $clubSubscription = 10000 + $memberPrice + $totalPrice;
                                echo $clubSubscription . " EGP";
                            ?></th>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
session_destroy();
include_once("layouts/footer.php");
?>