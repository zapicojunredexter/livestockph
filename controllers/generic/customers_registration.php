<?php
    require_once('../../utils/db_conn.php');
    $response = new stdClass();
    $response->Status = "Failed";
    if(sizeof($_POST)>0){
        $buyerFName = $_POST['BuyerFName'];
        $buyerLName = $_POST['BuyerLName'];
        $buyerContactNo = $_POST['ContactNo'];
        $city = $_POST['City'];
        $province = $_POST['Province'];
        $street = $_POST['Street'];
        $zipCode = $_POST['ZipCode'];
        $ownerId = setRecord("INSERT INTO livestockbuyers (BuyerFName,BuyerLName,ContactNo,City,Province,Street,ZipCode)
            VALUES ('$buyerFName','$buyerLName','$buyerContactNo','$city','$province','$street','$zipCode')");
        $username = $_POST['Username'];
        $password = $_POST['Password'];
        $accountType = "Customer";
        $accountId = setRecord("INSERT INTO accounts (Username,Password,AccountType,OwnerId) VALUES ('$username','$password','$accountType',$ownerId)");
        
        $_SESSION['account_id'] = $accountId;
        $_SESSION['account_name'] = $buyerFName;
        
        $response->Status = "Success";
    }
    
    echo json_encode($response);
?>