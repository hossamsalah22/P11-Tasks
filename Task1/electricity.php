<?php

if ($_POST) {
    $electricityUnit = $_POST["electricityUnit"];
    if ($electricityUnit < 0) {
        $output = "<div class='alert alert-danger'><h1>Error, You've Entered Wrong Reading</h1></div>";
    } else {
        if ($electricityUnit >= 0 && $electricityUnit < 50) {
            $charges = $electricityUnit * 0.50;
        }elseif ($electricityUnit >= 50 && $electricityUnit < 150) {
            $charges = $electricityUnit * 0.75;
        }elseif ($electricityUnit >= 150 && $electricityUnit < 250) {
            $charges = $electricityUnit * 1.20;
        } else {
            $charges = $electricityUnit * 1.50;
        }
        $surCharge = $charges * 0.2;
        $bill = $charges + $surCharge;
        // the outupt
        $output = "<div class='alert alert-dark'><h1> Your Electricity Bill Is $bill</h1></div>";
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <title>Electricity Bill</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-6 offset-3 text-center bg-dark text-white">
                <h1>Check Your Electricity Bill</h1>
            </div>
            <div class="col-6 offset-3">
                <form action="" method="post">
                    <div class="form-group">
                        <label for=""></label>
                        <input type="text" name="electricityUnit" id="" class="form-control" placeholder="Enter The Electricity Unit" required>
                    </div>
                    <div class="form-group">
                        <label for=""></label>
                        <button class="btn btn-dark form-control"> Check Bill </button>
                    </div>
                </form>
                <?php if (isset($output)) {
                    echo $output;
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>