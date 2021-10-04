<?php

if ($_POST) {
  function getRoot($firstNumber, $rootNumber)
  {
    if ($firstNumber < 0) {
      return $output = "<div class='alert alert-danger'><h1>Error, Number is Negative<br> Negative Number  </h1></div>";
    }else {
      $res = $firstNumber ** (1 / $rootNumber);
      return $output = "<div class='alert alert-dark'><h1> Root Of $firstNumber is $res  </h1></div>";
    }
  }
}

?>


<!doctype html>
<html lang="en">

<head>
  <title>Calculate The Root Of Any Number</title>
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
        <h1>Calculate The Root Of Any Number</h1>
      </div>
      <div class="col-6 offset-3">
        <form action="" method="post">
          <div class="form-group">
            <label for=""></label>
            <input type="text" name="firstNumber" id="" class="form-control" placeholder="Enter First Number" required>
          </div>
          <div class="form-group">
            <label for=""></label>
            <input type="text" name="rootNumber" id="" class="form-control" placeholder="Enter Root Number">
          </div>
          <div class="form-group">
            <label for=""></label>
            <button class="btn btn-dark form-control"> Calculate The Root </button>
          </div>
        </form>
        <?php 
          echo getRoot($_POST['firstNumber'],$_POST['rootNumber']);
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