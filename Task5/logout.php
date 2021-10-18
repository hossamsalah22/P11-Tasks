<?php

include_once "middleware/auth.php";

session_start();
unset($_SESSION['user']);
header("Location:login.php");
