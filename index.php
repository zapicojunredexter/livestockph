<?php
    include_once('./utils/session_functions.php');

    if(isLoggedIn()){
        if(checkSubscriberSession()){
            header('location: ./views/containers/subscribers/');
            return;
        }
        header('location: ./views/containers/customers/');
    }else{
        header('location: ./views/containers/generic/landing_page.php');
    }
?>