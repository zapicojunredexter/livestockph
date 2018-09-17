<?php
    if($_SESSION['account_expiry']<date('Y-m-d')){
        echo '<div id="screen-overlay" onclick="off()"></div>';
    }
?>
    