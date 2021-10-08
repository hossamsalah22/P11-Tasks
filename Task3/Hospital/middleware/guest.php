<?php 


if (isset($_SESSION['phoneNumber'])) {
    header("location:questions.php");
}