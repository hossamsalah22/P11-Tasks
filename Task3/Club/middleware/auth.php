<?php 

if(!isset($_SESSION['subscriberInfo']['subscriberName']) && !isset($_SESSION['subscriberInfo']['familyCount'])) {
    header("location:enterData.php");
}else {
    if(isset($_SESSION['familyInfo'])) {
        header("location:invoice.php");
    }
}




