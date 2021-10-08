<?php
$title = "Bank";
include_once("layouts/header.php");

if ($_POST) {
  $errors = [];
  if (empty($_POST["clientName"])) {
    $errors['clientName'] = "<div class='alert alert-danger'> Please enter your name </div>";
  }
  if (empty($_POST["loanAmount"]) || $_POST['loanAmount'] <= 0) {
    $errors['loanAmount'] = "<div class='alert alert-danger'> Please enter A Valid Number Of Money </div>";
  }
  if (empty($_POST["loanYears"]) || $_POST['loanYears'] <= 0) {
    $errors['loanYears'] = "<div class='alert alert-danger'> Please enter A Valid Number Of Years </div>";
  }
  // Calculate Interests
  function calculateInterest()
  {
    $money = $_POST['loanAmount'];
    $years = $_POST['loanYears'];
    if ($years < 3) {
      $interest = $money * 0.1 * $years;
    } else {
      $interest = $money * 0.15 * $years;
    }
    return $interest;
  }
  // Calculate The Loan After Adding Interest
  function calculateRepayment()
  {
    return $_POST['loanAmount'] + calculateInterest();
  }
  // Calculate The Monthly Payments
  function calculateMonthlyPayment()
  {
    $months = $_POST['loanYears'] * 12;
    return calculateRepayment() / $months;
  }
  if (empty($errors)) {
    // Table Of Final Result
    $calcs =  "<div class='form-group'>
    <table class='table mt-5 text-center text-white'>
      <thead>
        <tr>
          <th>Interest Rate</th>
          <th>Loan after interest</th>
          <th>Monthly Payment</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>" . calculateInterest() . "</td>
          <td>" .  calculateRepayment() . "</td>
          <td>" . calculateMonthlyPayment() . "</td>
        </tr>
      </tbody>
    </table>
  </div>";
  }
}
?>

<div class="container bg-dark text-white">
  <div class="row mt-5">
    <div class="col-12">
      <div class="h1 text-center my-3">Bank Loan Calculator</div>
      <form action="" method="post">
        <div class="col-6 offset-3">
          <div class="form-group">
            <label for="clientName" class="text-left font-weight-bold">Client Name</label>
            <input type="text" name="clientName" id="clientName" class="form-control" value="<?php if (!empty($_POST['clientName'])) {
                                                                                                echo $_POST['clientName'];
                                                                                              } ?>" placeholder="Please Enter Your Name">
          </div>
          <?php if (!empty($errors['clientName'])) {
            echo $errors['clientName'];
          } ?>
          <div class="form-group">
            <label for="loanAmount" class="text-left font-weight-bold">Loan Amount</label>
            <input type="number" name="loanAmount" id="loanAmount" class="form-control" value="<?php if (!empty($_POST['loanAmount'])) {
                                                                                                  echo $_POST['loanAmount'];
                                                                                                } ?>" placeholder="Please Enter Your Name">
          </div>
          <?php if (!empty($errors['loanAmount'])) {
            echo $errors['loanAmount'];
          } ?>
          <div class="form-group">
            <label for="loanYears" class="text-left font-weight-bold">Loan Years</label>
            <input type="number" name="loanYears" id="loanYears" class="form-control" value="<?php if (!empty($_POST['loanYears'])) {
                                                                                                echo $_POST['loanYears'];
                                                                                              } ?>" placeholder="Please Enter Your Name">
          </div>
          <!-- printing Errors -->
          <?php if (!empty($errors['loanYears'])) {
            echo $errors['loanYears'];
          } ?>
          <div class="form-group">
            <label></label>
            <button class="btn btn-success form-control rounded">Calculate</button>
          </div>
          <!-- printing Final Result Table -->
          <?php if(!empty($calcs)) {echo $calcs;} ?>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
include_once("layouts/footer.php");
?>