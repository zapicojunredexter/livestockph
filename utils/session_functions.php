<?php
    session_start();
    function checkSubscriberSession(){
        if(sizeof($_SESSION) > 0 && isset($_SESSION['subscriber_id'])){
            return true;
        }
        return false;
    }
    function checkCustomerSession(){
        if(sizeof($_SESSION) > 0 && !isset($_SESSION['subscriber_id'])){
            return true;
        }
        return false;
    }
    function logout(){
        session_destroy();
    }
    function isLoggedIn(){
        return sizeof($_SESSION) > 0;
    }
?>