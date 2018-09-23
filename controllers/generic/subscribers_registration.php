<?php
    require_once('../../utils/db_conn.php');
    $response = new stdClass();
    $response->Status = "Failed";
    if(sizeof($_POST)>0){
        $supplierName = $_POST['SupplierName'];
        $contactNo = $_POST['ContactNo'];
        $city = $_POST['City'];
        $province = $_POST['Province'];
        $street = $_POST['Street'];
        $zipCode = $_POST['ZipCode'];
        $accountExpiry = date('Y-m-d', strtotime("+3 months", strtotime(date('Y-m-d'))));
        $email = $_POST['Email'];
        $deliveryFee = $_POST['DeliveryFee'];
        print_r($_POST);
        $supplierId = setRecord("INSERT INTO livestocksuppliers (SupplierName,ContactNo,City,Province,Street,ZipCode,AccountExpiry)
            VALUES ('$supplierName','$contactNo','$city','$province','$street','$zipCode','$accountExpiry')");
        return;
        $employeeFName = $_POST['EmpFName'];
        $employeeLName = $_POST['EmpLName'];
        $ownerId = setRecord("INSERT INTO employees (EmpFName,EmpLName,SupplierNo) VALUES ('$employeeFName','$employeeLName',$supplierId)");
        
        $username = $_POST['Username'];
        $password = $_POST['Password'];
        $accountType = "Subscriber";
        $accountId = setRecord("INSERT INTO accounts (Username,Password,AccountType,OwnerId) VALUES ('$username','$password','$accountType',$ownerId)");
        
        session_start();
        $_SESSION['account_company'] = $supplierId;
        $_SESSION['account_id'] = $accountId;
        $_SESSION['subscriber_id'] = $ownerId;
        $_SESSION['account_name'] = $employeeFName;
        $_SESSION['account_expiry'] = $accountExpiry;

        $response->Status = "Successq";
    }
    
    echo json_encode($response);
?>