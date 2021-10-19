<?php


session_start();
include_once "middleware/auth.php";
unset($_SESSION['user']);
header("Location:login.php");
