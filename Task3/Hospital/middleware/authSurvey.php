<?php 


if (!isset($_SESSION['total'])) {
    header("location:questions.php");
}