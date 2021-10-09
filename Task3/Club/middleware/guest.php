<?php 

if(isset($_SESSION['subscriberInfo']['subscriberName']) && isset($_SESSION['subscriberInfo']['familyCount'])) {
    if(isset($_SESSION['familyInfo'])) {
        header("location:invoice.php");
    }else {
        header("location:subscribe.php");
    }
}