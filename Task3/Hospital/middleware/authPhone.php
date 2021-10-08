<?php 


if (!isset($_SESSION['phoneNumber'])) {
    header("location:phone.php");
}