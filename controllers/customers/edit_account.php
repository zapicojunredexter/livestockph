<?php
    print_r($_POST);
    require_once('../../utils/db_conn.php');
    require_once('../../utils/session_functions.php');
    if(sizeof($_POST) > 0){
        $street = $_POST['Street'];
        $province = $_POST['Province'];
        $city = $_POST['City'];
        $zipCode = $_POST['ZipCode'];
        $firstName = $_POST['BuyerFName'];
        $lastName = $_POST['BuyerLName'];
        $userId = $_SESSION['account_id'];

        setRecord("UPDATE livestockbuyers SET Street = '$street',
        Province = '$province', City = '$city', ZipCode = '$zipCode'
        ,BuyerFName = '$firstName', BuyerLName = '$lastName'
        WHERE BuyerNo = $userId");

        header("location:../../views/containers/customers/profile.php?message=Success");
        // header("location:".parse_url($_SERVER["REQUEST_URI"]));

    }
    
    header("location:../../views/containers/customers/profile.php?message=Failed");
?>